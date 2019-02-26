<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	
	function __construct()
    {
        parent::__construct();
        $this->load->model(['Vendor_category_model', 'Documents_model', 'Supplier_model', 'Director_model', 'Contact_model', 'Equipment_model', 'Supplier_document_model', 'Settings_model', 'Login_model']);
        $this->load->library(['form_validation', 'upload']);
        
    }
    
	public function index()
	{
        $category_data = $this->Vendor_category_model->get_all();
        $document_data = $this->Documents_model->get_all();
        $data = array(
       'category_data' => $category_data,
        'document_data' => $document_data,
      );
		$this->load->view('users/register', $data);
	}
    
    public function get_document(){ 
        $document_data = $this->Documents_model->get_all();
         echo '<option value="">Select Document</option>';
                foreach($document_data as $row)
                { 
                 echo "<option value='".$row->id."'>".$row->name."</option>";
                }
        }
    
    public function post(){

       //Load email library
        $this->load->library('email');
         $host=$this->Settings_model->get_all();
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $host->server,
            'smtp_port' =>  4500,
            'smtp_user' => $host->username,
            'smtp_pass' => $host->password,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'smtp_crypto'=>'tls'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
             $this->session->set_flashdata('error', 'Check and fill all fields with error messages');
            $this->index();
        } 
        else {
            
        //Insert Vendor Details into database 
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $passcode = substr(str_shuffle($chars),0,8);
        $options = [
            'cost' => 11,
            ];
        $pass= password_hash($passcode, PASSWORD_BCRYPT, $options);
        $reference='VEN-'.uniqid();
        if(count($this->input->post('specialty',TRUE)) < 1 || count($this->input->post('specialty',TRUE)) > 3){
             $this->session->set_flashdata('error', 'Specialty needed and must not exceed 3 area of specialization');
             $this->index();
        }else{
        $array_specialty = $this->input->post('specialty',TRUE);
        $array_specialty = implode(",", $array_specialty);
        $email_code=md5($this->input->post('comp_email'));
            $em=$this->input->post('comp_email');
            
        //Insert Vendors
        $data_vendor = array(
        'company_name' =>  strtoupper($this->input->post('company_name',TRUE)),
        'address' =>  strtoupper($this->input->post('comp_address',TRUE)),
		'reference_num' => strtoupper($reference),
		'registration_no' => $this->input->post('reg_no',TRUE),
		'primary_phone' => $this->input->post('comp_phone',TRUE),
		'email' => $this->input->post('comp_email',TRUE),
		'work_done' => $this->input->post('summary',TRUE),
        'specialty' => $array_specialty,
        'email_code' => $email_code,
        );
            
         $data3 = array(
                        'company_name' => $this->input->post('company_name',TRUE),
                        'email' => $this->input->post('comp_email',TRUE),
                        'phone' => $this->input->post('comp_phone',TRUE),
                        'password' => $passcode,
                        'code'=>$email_code,
                    );
                    $option = array(
                        'subject'   => 'Vendor Login Details',
                        'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'to'        => $this->input->post('comp_email',TRUE),
                        'data'      => $data3,
                    );
                    
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/email_password', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    if($this->email->send()){
                        
                $phone = "234".substr($this->input->post('comp_phone',TRUE), 1);
                $msg = "Dear ".$this->input->post('company_name',TRUE).", Activate Account here http://procure.lfcww.org/registration/activate/".$email_code.", Usrn:".$em.", Psw:".$passcode;
                    $this->sms($msg, $phone);

                       $supplier_id = $this->Supplier_model->insert($data_vendor);
            
                         //Insert Vendors Login
                         $data_login = array(
                            'supplier_id'=>$supplier_id,
                            'password' =>$pass,
                        );
                         $this->Login_model->insert($data_login); 
                         $this->session->set_flashdata('message', 'Registration successful, kindly check your email for account activation and login details to complete and update registration'); 
                         redirect(site_url('registration'));
                    }else{
                    $this->session->set_flashdata('error', 'Registration not successful, try again later'); 
                         redirect(site_url('registration'));
        }
            
    }
  }
}
    
    public function activate($id){
        $new_id = $id;
        $row= $this->Supplier_model->check_code($new_id);
        if($row){ 
            if($row->status_verification == 1){
                $this->session->set_flashdata('error', 'Account already activated, kindly login to access profile'); 
                redirect(site_url('home'));
            }
            if($row->status_verification == 0){      
            $data= array(
            'status_verification' =>1,
               );
            $this->Supplier_model->update($row->supplier_id, $data);
            $this->session->set_flashdata('message', 'Account Activated successfully, kindly login to update profile'); 
            redirect(site_url('home')); 
            }
            
        }else{
           $this->session->set_flashdata('error', 'Account Activation not successful, Try again later!'); 
            redirect(site_url('home'));
        }
    }
    
      public function _rules()
    {
         //Supplier Information Validation
	   $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|is_unique[e_vendor.company_name]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
       $this->form_validation->set_rules('reg_no', 'Registration number', 'trim|required');
	   $this->form_validation->set_rules('comp_email', 'Company email', 'trim|required|valid_email|is_unique[e_vendor.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
	   $this->form_validation->set_rules('comp_phone', 'Company phone', 'trim|required');
        $this->form_validation->set_rules('comp_address', 'Company Address', 'trim|required');
	   $this->form_validation->set_rules('summary', 'Previous work done', 'trim|required');
        $this->form_validation->set_rules('specialty[]', 'Vendor Specialisation', 'trim|required');
    }
    
    public function yme(){
                $phone = "234".substr('07030287311', 1);
                $msg = "Dear Kayode, Activate Account here http://procure.lfcww.org/activate/";
                $this->sms($msg, $phone);
    }

  public function sms($msg, $phone){
        /** Sample API request to SMSPrime using XML **/
                //username
                $username = "canaanland@lfcww.org";
                //API Key
                $APIKey = "5E68F254539B8FA8F01FBC0E2F273FD4";
                //Mime mode
                $dataformat = "xml";
                //Derivative URL
                $APIUrl = "http://smsprime.com/api.module/canaanland@lfcww.org/xml";
                //Compute a signature for the user by concatenating the username and the api key
                $signature = md5($username . $APIKey);

                //Build an xml request for method send, with an auxillary instruction to get the balance
                $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                <Request>
                    <header>
                        <auth>
                            <signature>$signature</signature>
                        </auth>
                    </header>
                    <body>
                        <auxillary>
                            <balance>1</balance>
                        </auxillary>
                        <method>send</method>
                        <parameters>
                            <type>default</type>
                            <destination>".$phone."</destination>
                            <source>LFC Procure</source>
                            <header>LFC Procure</header>
                            <shortmessage>".$msg."</shortmessage>
                        </parameters>
                    </body>
                </Request>";


                //Use CURL to post
                //You could as well easily use fsockopen and its family of functions
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $APIUrl ); 
                curl_setopt($ch, CURLOPT_POST, 1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $postResult = curl_exec($ch);
                if (curl_errno($ch)) {
                //  print curl_error($ch);
                }
                curl_close($ch);
               //print htmlentities("$postResult");
    }
    
}

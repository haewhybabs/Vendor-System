<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model','Audit_model', 'Login_model', 'Approval_model']);
        $this->login = $this->session->userdata('cms_logged_in');
        $this->department_id=$this->login['department_id'];
         $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
    }

    public function index()
    {
        

        $req_list = $this->Requisition_details_model->getSent_requisition_purchase_order();
         // $req_list_attended= $this->Requisition_details_model->getSent_requisition_final_attended();
         $get_quote_count=$this->Quotes_model->get_quote_counting();
         $get_quote_submitted=$this->Quotes_model->get_quote_submitted();
        $data = array(
            
            'req_list' => $req_list,
            
            'get_count'=>$get_quote_count,
            'count_submit'=> $get_quote_submitted,
            'title' => 'Final Approval',
        );
        $this->template->load('template', 'purchase/lists', $data);

    }


    public function send($id){
        if($this->Requisition_details_model->get_by_id($id)){
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
            $date=date('Y-m-d H:i:s');
            $data = array(
            'po_sent' => 1,
                 'po_date' => $date,
            );
            
            $req_list= $this->Requisition_details_model->get_by_id($id);
             $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
            foreach ($arry_select as $arr) {
                 $cat_id = $this->Supplier_model->get_by_id($arr);
                 $phone = "234".substr($cat_id->primary_phone,1);
                 $msg = "Dear ".$cat_id->company_name.", please login go to your dashboard on http://procure.lfcww.org to download the Purchase Order document sent to you for supply.";
                   $this->sms($msg, $phone);
                    $option = array(
                        'subject'   => 'Purchase Order',
                        'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'to'        => $cat_id->email,
                    );
                   
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/po_mail', true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                
                 $data_invoice = array(
                    'vrfq_id' => $cat_id->supplier_id,
                    'vend_id' => $id,
                );
                 $this->Vendor_rfq_model->insert_invoice($data_invoice);
            }
                    $task='send purchase order to vendors'; 
                    $this->audit($task);
                    $update =  $this->Requisition_details_model->update($id, $data);
                    $this->session->set_flashdata('message', 'Purchase Order successfully sent to vendor(s)');
                    redirect(site_url('purchase_order'));

          
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('purchase_order'));    
        }
    }
    
  
    public function vendor($id)
        {
            $req_list= $this->Requisition_details_model->get_by_id($id);
            if($req_list){
            $department_status= $this->Department_model->get_by_id($this->department_id);
           // $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
           // foreach ($arry_select as $arr) {
            $cat_id = $this->Approval_model->get_by_unique($id);
            $data = array(
            'department_status'=> $department_status,
            'req_id' => $id,
            'rfp' => $req_list->rfp_no,
            'cat_list' => $cat_id,
            'title' => 'Purchase Order Vendors',
        );
                 $this->template->load('template', 'purchase/ven_list', $data);
          //  }
            }else{
                $this->session->set_flashdata('error', 'This requisition does not exist');
                redirect(site_url('purchase_order'));   
            } 
        }
    
    public function view(){
        
        $supplier= $this->Supplier_model->get_by_id($this->input->post('id'));
         $department_status= $this->Department_model->get_by_id($this->department_id);
        $material_list = $this->Approval_model->get_by_req_id($this->input->post('id'), $this->input->post('req_id'));
       // $message= $this->Vendor_rfq_model->get_by_com_id($id, $this->company_id);
        $data = array(
            'material_list' => $material_list,
            'supplier' => $supplier,
            'title' => 'Purchase Order',
             'department_status'=> $department_status,
        );
            
       $this->template->load('template', 'purchase/view', $data);
       /* $html = $this->load->view('templates/purchase_download',$data,TRUE);
        $pdfFilePath = "Purchase Order.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");*/
        
    }
    
    public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname,
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
		      );
            
      $this->Audit_model->insert($data_audit);
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

    public function _rules()
    {
        $this->form_validation->set_rules('comment', 'Rejection Note', 'trim|required');
    }

    public function checkout($id){
        $data=array(
            'title'=>'Purchase Action',
            ''

        );
    }

}


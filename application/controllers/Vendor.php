<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends MY_Controller {

	 function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('template');
            $this->load->model(['Supplier_model', 'Department_model', 'Equipment_model','Supplier_document_model', 'Contact_model', 'Director_model', 'Vendor_category_model', 'Vendor_interview_model', 'Vendor_notification_model', 'Activities_model', 'Audit_model', 'Login_model', 'Settings_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
         $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
        }
    
        public function index()
        {
        $vendor_list = $this->Supplier_model->get_all_new();
        $document = $this->Vendor_category_model->get_all();
        foreach($vendor_list as $vendor){
         $equipment_list = $this->Equipment_model->get_all();
         $document_list = $this->Supplier_document_model->get_all();
        }
       $cate = $this->Vendor_category_model->get_approve_cat();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'vendor_list' => $vendor_list,
            'title' => 'All Vendors',
            'equipment_list' => $equipment_list,
            'category_list' => $cate,
            'document_list'=> $document_list,
            'document'=>$document,

        );
           $this->template->load('template', 'vendor/vendors', $data);
        }
    
        public function equipment($id)
        {
        $supplier=$this->Supplier_model->get_by_id($id);
        $equipment_list = $this->Equipment_model->get_by_vendor($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'equipment_list' => $equipment_list,
            'title' => 'Vendor Images',
            'supplier_name'=>$supplier->company_name,
        );
           $this->template->load('template', 'vendor/equipment', $data);
        }
    
         public function documents($id)
        {
        $supplier=$this->Supplier_model->get_by_id($id);
        $document_list = $this->Supplier_document_model->get_by_vendor($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'document_list' => $document_list,
            'title' => 'Vendor Documents',
            'supplier_name'=>$supplier->company_name,
        );
           $this->template->load('template', 'vendor/document', $data);
        }
        public function edit_profile(){
            $id=$this->input->post('supplier_id');
            $data=$this->input->post();
            $update=$this->Supplier_model->update_profile($data,$id);
            $this->session->set_flashdata('message', 'Update is Successful.'); 
            redirect(site_url('Vendor/approve_list'));
        }
    
         public function details($id)
        {
        $document = $this->Vendor_category_model->get_all();
        $supplier=$this->Supplier_model->get_by_id($id);
        $contact_list = $this->Contact_model->get_by_vendor($id);
        $director_list = $this->Director_model->get_by_vendor($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);  
        $document_list = $this->Supplier_document_model->get_by_vendor($id);
        $data = array(
            'department_status'=> $department_status,
            'contact_list' => $contact_list,
            'director_list' => $director_list,
            'title' => 'Vendor Details',
            'supplier_name'=>$supplier->company_name,
            'supplier_data'=>$supplier,
            'document'=>$document,
            'document_list'=>$document_list
        );
           $this->template->load('template', 'vendor/details', $data);
        }
    
    
        public function schedule($id)
        {
        $supplier=$this->Supplier_model->get_by_id($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'title' => 'Interview Schedule',
            'supplier_name'=>$supplier->company_name,
            'supplier_data'=>$supplier,
        );
           $this->template->load('template', 'vendor/schedule', $data);
        }
    
    public function schedule_action()
        {
        $this->schedule_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->schedule($this->input->post('supplier_id'));
            } else {
             
            $date=$this->input->post('date',TRUE);
            $time=$this->input->post('timepicker',TRUE);
            
               $data_interview = array(
                'supplier_id'=>$this->input->post('supplier_id'),
                'date_interview' => $date,
                'time_interview' => $time,
                );
             
                $data_supplier = array(
                'status_verification' => 3,
                );

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

                    $supplier = $this->Supplier_model->get_email($this->input->post('supplier_id'));
             
                       $email_send['info'] = "Dear ".$supplier->company_name.", Congrats. you have been scheduled for interview on ".$date.", ".$time." at Wobi Complex Cannan Land. Login go to your dashboard on http://procure.lfcww.org to view.";
                  
                    $option = array(
                        'subject'   => 'Invitation For Interview',
                         'from'      => 'procure@lfcww.org',
                         'from_name' => 'LFC eProcurement',
                       
                    );
                   
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($supplier->email);
                   // $this->email->to('babalolaisaac@gmail.com');
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/interview_schedule', $email_send, true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 




              $phone = "234".substr($supplier->primary_phone,1);
                      $msg = "Dear ".$supplier->company_name.", Congrats. you have been scheduled for interview on ".$date.", ".$time." at  Wobi Complex Cannan Land. Login to your dashboard on http://procure.lfcww.org to view.";
                    $this->sms($phone,$msg);
               $task='Schedule a vendor for interview'; 
            $this->audit($task);
                $this->Vendor_interview_model->insert($data_interview); 
                $this->Supplier_model->update($this->input->post('supplier_id'), $data_supplier); 
                $this->session->set_flashdata('message', 'Schedule for interview successfully created.'); 
                redirect(site_url('vendor/interview'));
        }
        }
     public function interview()
        {
        $vendor_list = $this->Supplier_model->get_all_interview();
        $interview_details=$this->Supplier_model->get_interview_details();
         $equipment_list = $this->Equipment_model->get_all();
         $document_list = $this->Supplier_document_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $cate = $this->Vendor_category_model->get_approve_cat();
        $data = array(
            
            'department_status'=> $department_status,
            'vendor_list' => $vendor_list,
             'equipment_list' => $equipment_list,
             'interview'=>$interview_details,
            'document_list'=> $document_list,
            'title' => 'Interview Vendors',
            'category_list'=>$cate,
        );
           $this->template->load('template', 'vendor/interview', $data);
        }
    
        public function approve()
        {

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


        // if($this->Supplier_model->get_by_id($id)){
        //     $supplier=$this->Supplier_model->get_by_id($id);
           
        //     $data_supplier = array(
        //         'status_verification' => 2,
        //         );
        //         $this->Supplier_model->update($id, $data_supplier);
            
        //     /* $option = array(
        //                 'subject'   => 'Request For Quotation',
        //                 'from'      => 'purchasingdpt@lfcwww.org',
        //                 'from_name' => 'Living Faith E-procurement',
        //                 'to'        => $supplier->email,
        //                 'data'      => $data3,
        //             );*/
        //                $phone = "234".substr($supplier->primary_phone,1);
        //                 $msg = "Dear ".$supplier->company_name.", Congrats. you have been approved as a vendor. login go to your dashboard on http://procure.lfcww.org, to view.";
        //                $this->sms($msg, $phone);
    
        //          $task='Approved a vendor'; 
        //         $this->audit($task);
        //         $this->session->set_flashdata('message', 'Vendor successfully approved.'); 
        //         redirect(site_url('vendor/approve_list'));  
        // }else{
        //      $this->session->set_flashdata('error', 'This vendor does not exist');
        //      redirect(site_url('vendor/interview'));
        // }
          $rating=$this->input->post('rating');
          $vendor=$this->input->post('vendor_id');
          $this->form_validation->set_rules('rating','Rating','required');
          if ($this->form_validation->run()){

              if($rating<1 || $rating>100){

                $this->session->set_flashdata('error', 'Vendor Rating can not be less than 1% or greater than 99%');
                redirect(site_url('vendor/interview'));
              }

                $data_supplier = array(
                 'status_verification' => 2,
                 'performance_rating'=> $rating,
                 );
                $this->Supplier_model->update($vendor, $data_supplier);


                 $supplier=$this->Supplier_model->get_by_id($vendor);

              
                       $email_send['info'] = "Dear ".$supplier->company_name.", Congrats. you have been approved as a Vendor. Login go to your dashboard on http://procure.lfcww.org to view.";
                  
                    $option = array(
                        'subject'   => 'Vendor Approved',
                         'from'      => 'procure@lfcww.org',
                         'from_name' => 'LFC eProcurement',
                       
                    );
                   
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($supplier->email);
                   // $this->email->to('babalolaisaac@gmail.com');
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/interview_schedule', $email_send, true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 

                 $phone = "234".substr($supplier->primary_phone,1);
                        $msg = "Dear ".$supplier->company_name.", Congrats. you have been approved as a vendor. login go to your dashboard on http://procure.lfcww.org, to view.";
                        $this->sms($phone, $sms);
                
                $task='Approved a vendor'; 
                $this->audit($task);
                $this->session->set_flashdata('message', 'Vendor successfully approved.'); 
                redirect(site_url('vendor/approve_list'));  

            



          }
          else{

                $this->session->set_flashdata('error', 'Rating field is required');
                redirect(site_url('vendor/interview'));
          }

         

         
        }
    
    
    public function resend($id)
        {
        if($this->Supplier_model->get_by_id($id)){
            $supplier=$this->Supplier_model->get_by_id($id);
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

            //Insert Vendor Details into database 
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $passcode = substr(str_shuffle($chars),0,8);
        $options = [
            'cost' => 11,
            ];
        $pass= password_hash($passcode, PASSWORD_BCRYPT, $options);
            
            $data3 = array(
                        'company_name' =>  $supplier->company_name,
                        'email' =>  $supplier->email,
                        'phone' => $supplier->primary_phone,
                        'password' => $passcode,
                        'code'=>$supplier->email_code,
                    );
                    $option = array(
                        'subject'   => 'Vendor Login Details',
                        'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'to'        => $supplier->email,
                        'data'      => $data3,
                    );
                    
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/email_password2', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    if($this->email->send()){
                        
                $phone = "234".substr($supplier->primary_phone, 1);
                $msg = "Dear ".$supplier->company_name.", Activate Account here http://procure.lfcww.org/registration/activate/".$supplier->email_code.", Usrn:".$supplier->email.", Psw:".$passcode;
                $this->sms($msg, $phone);
                        
                 //Update Vendors Login
                         $data_login = array(
                            'password' =>$pass,
                        );
                         $this->Login_model->update($supplier->supplier_id, $data_login); 
                        
              $task='Resent registration confirmation email to '.$supplier->company_name; 
            $this->audit($task);
                $this->session->set_flashdata('message', 'Confirmation email successfully sent.'); 
                redirect(site_url('vendor/pending'));  
        }else{
             $this->session->set_flashdata('error', 'mail not delivered, try again later.');
             redirect(site_url('vendor/pending'));
        }
    
        }else{
             $this->session->set_flashdata('error', 'This vendor does not exist');
             redirect(site_url('vendor/pending'));
        }
        }
    
         public function approve_list()
        {
        $vendor_list = $this->Supplier_model->get_all_approve();
        $department_status= $this->Department_model->get_by_id($this->department_id);
         $equipment_list = $this->Equipment_model->get_all();
         $document_list = $this->Supplier_document_model->get_all();
        $cate = $this->Vendor_category_model->get_approve_cat();
        $data = array(
            'department_status'=> $department_status,
            'vendor_list' => $vendor_list,
            'title' => 'Approved Vendors',
             'equipment_list' => $equipment_list,
             'category_list'=>$cate,
            
            'document_list'=> $document_list,
        );
           $this->template->load('template', 'vendor/approve', $data);
    
        }
    
    
     public function reject($id)
        {
        $supplier=$this->Supplier_model->get_by_id($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'title' => 'Rejection',
            'supplier_name'=>$supplier->company_name,
            'supplier_data'=>$supplier,
        );
           $this->template->load('template', 'vendor/reject_form', $data);
    
        }
    
    
    public function edit($id)
        {
        $supplier=$this->Supplier_model->get_by_id($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'title' => 'Edit vendor',
            'supplier_name'=>$supplier->company_name,
            'supplier_data'=>$supplier,
        );
           $this->template->load('template', 'vendor/edit', $data);
    
        }
    
     public function edit_action()
        {
            $this->edit_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
             $data = array(
                  'email'=>$this->input->post('email'),
                 'primary_phone'=>$this->input->post('phone'),
                );
               $task='Updated a a vendor profile'; 
                $this->audit($task);
                $this->Supplier_model->update($this->input->post('id'), $data); 
                $this->session->set_flashdata('message', 'vendor successfully updated.'); 
                redirect(site_url('vendor/pending'));
         }
        }
    
     public function pending()
        {
        $supplier=$this->Supplier_model->get_pending();
        $department_status= $this->Department_model->get_by_id($this->department_id);

         $equipment_list = $this->Equipment_model->get_all();
         $document_list = $this->Supplier_document_model->get_all();
          $cate = $this->Vendor_category_model->get_approve_cat();
         
        $data = array(
            'department_status'=> $department_status,
            'title' => 'Pending List',
             'equipment_list' => $equipment_list,
             'document_list'=> $document_list,
            'vendor_list'=>$supplier,
            'category_list'=>$cate,
        );
           $this->template->load('template', 'vendor/pending', $data);
    
        }
    
     
        public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.'(staff)',
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
		      );
            
            $this->Audit_model->insert($data_audit);
    }
    
    
         public function rating($id)
        {
        $suppliers=$this->Supplier_model->get_by_id($id);
        $supplier=$this->Supplier_model->get_by_rating($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $cate = $this->Vendor_category_model->get_each_cat($id);
            
        $data = array(
            'department_status'=> $department_status,
            'title' => 'Supply Ratings',
            'supplier_name'=>$suppliers->company_name,
            'vendor_list'=>$suppliers,
            'category_list'=>$cate,
        );
            
           $this->template->load('template', 'vendor/rating', $data);
    
        }
    
    
     public function upload($id)
        {
        $invoice=$this->Supplier_model->get_invoice($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
          //  print_r($invoice);
        if($invoice){
             redirect('http://procure.lfcww.org/uploads/invoice/'.$invoice->invoice); 
         }else{
           $this->session->set_flashdata('error', 'invoice not found.'); 
                redirect(site_url('vendor/rating'));  
         } 
    
        }
    
    
         public function reject_action()
        {
            $subject=$this->input->post('subject',TRUE);
            $content=$this->input->post('content',TRUE);
            $supplier=$this->Supplier_model->get_by_id($this->input->post('supplier_id'));
               $data_interview = array(
                'supplier_id'=>$this->input->post('supplier_id'),
                'subject' => $subject,
                'message' => $content,
                );
             
                $data_supplier = array(
                'status_verification' => 4,
                );
            
             $phone = "234".substr($supplier->primary_phone,1);
                        $msg = "Dear ".$supplier->company_name.", your application and request as a vendor was denied. Login go to your dashboard on http://procure.lfcww.org to view details.";
                    $this->sms($msg, $phone);
             $task='Rejected a vendor'; 
            $this->audit($task);
                $this->Vendor_notification_model->insert($data_interview); 
                $this->Supplier_model->update($this->input->post('supplier_id'), $data_supplier); 
                $this->session->set_flashdata('message', 'Vender rejected successfully.'); 
                redirect(site_url('vendor/reject_list'));
        }
    
    
        public function reject_list()
        {
        $vendor_list = $this->Supplier_model->get_all_reject();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $cate = $this->Vendor_category_model->get_approve_cat();
         $equipment_list = $this->Equipment_model->get_all();
        $data = array(
            'department_status'=> $department_status,
            'vendor_list' => $vendor_list,
            'title' => 'Rejected Vendors',
            'category_list'=>$cate,
            'equipment_list'=>$equipment_list,
        );
           $this->template->load('template', 'vendor/reject', $data);
    
        }
    
    public function sms($phone,$msg){

               $username = "canaanland@lfcww.org";
              //API Key
               $APIKey = "5E68F254539B8FA8F01FBC0E2F273FD4";
              //Mime mode
              $dataformat = "xml";
              //Derivative URL
              $APIUrl = "https://smsprime.com/api.module/$username/$dataformat";
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
                print curl_error($ch);
              }
              curl_close($ch);
              print htmlentities("$postResult");


                 
    }
    
    public function schedule_rules(){
        $this->form_validation->set_rules('date', 'Interview date', 'trim|required');
        $this->form_validation->set_rules('timepicker', 'Interview time', 'trim|required');
    
}
    
     public function edit_rules()
    {
        $this->form_validation->set_rules('name', 'Vendor Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Vendor Email', 'trim|required');
        $this->form_validation->set_rules('phone', 'Vendor Phone', 'trim|required');
    }
    public function Edit_vendor_contact(){
         $data['phone']=$this->input->post('phone');
         $data['email']=$this->input->post('email');
         $ved=$this->input->post('vendor');

         //Get previous data
        $previous=$this->Supplier_model->get_previous($ved);
        foreach ($previous as $key) {
        }


       
        if (trim($data['phone']==false)){
            $data['phone']=$key->primary_phone;
            
        }if (trim($data['email']==false)){
            $data['email']=$key->email;
        }

        if(trim($data['phone']==false) && trim($data['email']==false)){
            $this->session->set_flashdata('error', 'Please fill all the neccessary details'); 
                redirect(site_url('vendor'));
        }
        else{
            $update=$this->Supplier_model->update_vendor_contact($data,$ved);
             $this->session->set_flashdata('message', 'Update is successful'); 
                redirect(site_url('vendor'));
       
            

        }
    }
    public function chek(){
      $phone='2348127967153';
     $msg='hello';
     echo $this->sms($phone,$msg);

    }
    
}

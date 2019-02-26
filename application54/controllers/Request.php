<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model', 'Audit_model', 'Login_model','Review_Model','Rfq_Model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
        $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
        }
    
        public function index()
        {
       // $req_list = $this->Department_requisition_model->get_all_approve();
        $req_list = $this->Requisition_details_model->get_all_send_quote();
        $list = $this->Requisition_details_model->get_all_department_send_quote();
        $vendor_list = $this->Supplier_model->get_by_quote();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'vendor_list' => $vendor_list,
            'title' => 'Sent Quotes',
        );
           $this->template->load('template', 'request/approve', $data);
        }
    
         public function quote_lists()
        {
        $req_list = $this->Requisition_details_model->get_all_quote();
        $count_available= $this->Requisition_details_model->count_available();
        $list = $this->Requisition_details_model->get_all_department_quote();
        //$req_list = $this->Department_requisition_model->get_all_quote_rfx();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
           
            'req_list' => $req_list,
            'title' => 'Requisition review lists',
            'count_available' => $count_available,
        );
           $this->template->load('template', 'request/quote_list', $data);
          // var_dump($count_available);
           
        }
        public function send_quote(){
               
            

            $category=$this->input->post('category_ID');
            $data['deadline']=$this->input->post('deadline');
            $vendor=$this->input->post('vendor_ID');

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



           



            if(trim($data['deadline'])==false){
                  $quote = $this->session->userdata('quote');
                   $this->session->set_flashdata('error', 'Rfq not sent , please fill the necessary details'); 
                    redirect(site_url('Request/quote_lists'));
                
            }
            else{



                
                $data['req_ID']=$this->input->post('req_ID');
              
               $store_to_rfqSummary=$this->Rfq_Model->storeRfq($data);
               $getrfq=$this->Rfq_Model->getRfq($data['req_ID']);
               foreach ($getrfq as $key){
                     
                }
                $rfq_ID=$key->rfq_ID;
                 $req_list = $this->Requisition_details_model->get_summary($data['req_ID']);
                 $list = $this->Requisition_details_model->get_req_details($data['req_ID']);

                $store_to_rfqDetail=$this->Rfq_Model->storeRfq_detail($rfq_ID);
                $store_to_rfqVendor=$this->Rfq_Model->store_to_rfqVendor($rfq_ID,$category);
                $udate_process_stage=$this->Rfq_Model->update_process_stage($data['req_ID']);

                //Mailing System for the vendors

                for($count = 0; $count < count($this->input->post('vendor_ID',TRUE)); $count++){
                    $supplier = $this->Supplier_model->get_by_id($this->input->post('vendor_ID',TRUE)[$count]);


                    $data3 = array(
                            'req_list' => $req_list,
                            'list'=>$list,
                            'message'=>'Login to portal to see full details of requested quotes and upload your quotes',
                        );
                        $option = array(
                            'subject'   => 'Request For Quotation',
                            'from'      => 'purchasingdpt@lfcwww.org',
                            'from_name' => 'Living Faith E-procurement',
                            'to'        => $supplier->email,
                            'data'      => $data3,
                        );
                           $phone = "234".substr($supplier->primary_phone,1);
                           $msg = "Dear ".$supplier->company_name.", please login go to your dashboard on http://procure.lfcww.org to view Request For Quote document sent to you.";
                           $this->sms($msg, $phone);
                       
                       // $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail);
                        $this->email->from($option['from'], $option['from_name']);
                        $this->email->to($option['to']);
                        $this->email->subject($option['subject']);
                        $this->email->message($this->load->view('templates/quote_mail', $option['data'], true));
                        $this->email->set_alt_message('View the mail using an html email client');
                        $this->email->send();


                }
                
                $this->session->set_flashdata('message', 'Rfq is successfully sent'); 
                    redirect(site_url('Request/quote_lists'));

            }
  

             
        //  $vendor=$this->input->post('vendor_ID');
          //var_dump( $vendor);
             
        }
        public function Request_quote(){
            $id=$this->input->post('req_ID');
            $cat_id=$this->input->post('category_ID');
          $data['get_comments']=$this->Review_Model->comments($id); 
          $data['detail_single']=$this->Review_Model->GetSingle_Rfq_Details($id); 
          $data['getVendors']=$this->Rfq_Model->getVendors($cat_id);
          $data['title']='Request Quote';
          $this->session->set_userdata('quote', current_url());
          $this->template->load('template', 'requisition/requestQuote', $data);
           //var_dump($data['detail_single']);
        }

    public function mail(){
        $vendor_list = $this->Supplier_model->get_by_quote();
        print_r($vendor_list);
    }
    
    public function quotes_create($id)
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
         $req_list = $this->Requisition_details_model->get_by_id($id);
         $list = $this->Requisition_details_model->get_by_req_id($id);
        if($req_list){
            $cat_id = $this->Supplier_model->get_by_category($req_list->category_id);
             $data = array(
           'title' => 'Send Quote',
            'department_status'=> $department_status,
            'req_list'=> $req_list,
            'list'=> $list,
            'vendor_list'=>$cat_id,
        );
           $this->template->load('template', 'request/quote_form', $data);
           
        }else{
           $this->session->set_flashdata('message', 'This requisition does not exist');
             redirect(site_url('request/quote_lists'));   
        }
        }
    
    
    public function resend($id)
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
         $req_list = $this->Requisition_details_model->get_by_id($id);
         $list = $this->Requisition_details_model->get_by_req_id($id);
        if($req_list){
            $cat_id = $this->Supplier_model->get_by_category($req_list->category_id);
            $vendor=$this->Vendor_rfq_model->get_vendor2($id);
             $data = array(
           'title' => 'Send Quote',
            'department_status'=> $department_status,
            'req_list'=> $req_list,
            'list'=> $list,
            'vendor_list'=>$cat_id,
            'vendor'=>$vendor,
        );
           $this->template->load('template', 'request/resend', $data);
           
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('request/quote_lists'));   
        }
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->quotes_create($this->input->post('rev_id'));
            }else{
              
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
             
            $date=date("Y-m-d H:i:s");
              $year=date("Y");
              $month=date("m");
              $req_list = $this->Requisition_details_model->get_id($this->input->post('rev_id'));
              $list = $this->Requisition_details_model->get_by_req_id($this->input->post('rev_id'));
             $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $passcode = substr(str_shuffle($chars),0,8);
            if($req_list->service_type == 0){
                $uniqid= 'RFQ|'.$req_list->short.'|'.$month.'|'.$year.'|'.strtoupper($passcode); 
             }
            if($req_list->service_type == 1){
                $uniqid= 'RFP|'.$req_list->short.'|'.$month.'|'.$year.'|'.strtoupper($passcode);   
             }
              for($count = 0; $count < count($this->input->post('company',TRUE)); $count++){
               $data = array(
                'requisition_id'=>$this->input->post('rev_id'),
                 'post_date' =>$date,
                 'end_date'=>$this->input->post('date_submission',TRUE),
                'note'=>$this->input->post('summary',TRUE),
                'rfp_number'=>$uniqid,
                 'vendor_id'=>$this->input->post('company',TRUE)[$count],
                ); 
                $this->Vendor_rfq_model->insert($data);
                  
                $data_2=array(
                'quote_status'=>1,
                'pr_status'=>1,
                    'pr_treated'=>$date,
                'rfp_no'=>$uniqid,
                );
                  $this->Requisition_details_model->update($this->input->post('rev_id'), $data_2);
                  
                 $supplier = $this->Supplier_model->get_by_id($this->input->post('company',TRUE)[$count]);
                 if($req_list->service_type == 0){
                 $data3 = array(
                        'req_list' => $req_list,
                        'list'=>$list,
                        'message'=>'Login to portal to see full details of requested quotes and upload your quotes',
                    );
                    $option = array(
                        'subject'   => 'Request For Quotation',
                        'from'      => 'purchasingdpt@lfcwww.org',
                        'from_name' => 'Living Faith E-procurement',
                        'to'        => $supplier->email,
                        'data'      => $data3,
                    );
                       $phone = "234".substr($supplier->primary_phone,1);
                $msg = "Dear ".$supplier->company_name.", please login go to your dashboard on http://procure.lfcww.org to view Request For Quote document sent to you.";
                   $this->sms($msg, $phone);
                   
                   // $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail);
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/quote_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
            }
             if($req_list->service_type == 1){
                 $data3 = array(
                        'req_list' => $req_list,
                        'list'=>$list,
                      'message'=>'Login to portal to see full details of requested proposal and upload your proposal',
                    );
                    $option = array(
                        'subject'   => 'Requset For Quotation',
                        'from'      => 'purchasingdpt@lfcwww.org',
                        'from_name' => 'Living Faith E-procurement',
                        'to'        => $supplier->email,
                        'data'      => $data3,
                    );
                   
                 $phone = "234".substr($supplier->primary_phone,1);
                $msg = "Dear ".$supplier->company_name.", please login go to your dashboard on http://procure.lfcww.org to view Request For Proposal document sent to you.";
                  $this->sms($msg, $phone);
                 
                   // $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail);
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/proposal_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
            }

             
         }
                $task='Sent Quote to vendors'; 
                $this->audit($task);
                $this->session->set_flashdata('message', 'Quote Request successfully sent to '.$count.' vendors.'); 
                redirect(site_url('request'));
         }
        }
    
    
    public function resend_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->quotes_create($this->input->post('rev_id'));
            }else{
              
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
             
            $date=date("Y-m-d H:i:s");
              $year=date("Y");
              $month=date("m");
              $req_list = $this->Requisition_details_model->get_id($this->input->post('rev_id'));
              $list = $this->Requisition_details_model->get_by_req_id($this->input->post('rev_id'));
            
              for($count = 0; $count < count($this->input->post('company',TRUE)); $count++){
                 $vendor=$this->Vendor_rfq_model->get_ven_req($this->input->post('rev_id'), $this->input->post('company',TRUE)[$count]); 
                  $distinct=$this->Vendor_rfq_model->get_rfq($this->input->post('rev_id'));
                  
                  if(in_array($this->input->post('company',TRUE)[$count], $vendor)){
                      
                  }else{
                     $data = array(
                'requisition_id'=>$this->input->post('rev_id'),
                 'post_date' =>$date,
                 'end_date'=>$this->input->post('date_submission',TRUE),
                'note'=>$this->input->post('summary',TRUE),
                'rfp_number'=> $distinct,
                 'vendor_id'=>$this->input->post('company',TRUE)[$count],
                ); 
                $this->Vendor_rfq_model->insert($data); 
                      
                 $supplier = $this->Supplier_model->get_by_id($this->input->post('company',TRUE)[$count]);
                 if($req_list->service_type == 0){
                 $data3 = array(
                        'req_list' => $req_list,
                        'list'=>$list,
                        'message'=>'Login to portal to see full details of requested quotes and upload your quotes',
                    );
                    $option = array(
                        'subject'   => 'Request For Quotation',
                        'from'      => 'purchasingdpt@lfcwww.org',
                        'from_name' => 'Living Faith E-procurement',
                        'to'        => $supplier->email,
                        'data'      => $data3,
                    );
                       $phone = "234".substr($supplier->primary_phone,1);
                $msg = "Dear ".$supplier->company_name.", please login go to your dashboard on http://procure.lfcww.org to view Request For Quote document sent to you.";
                   $this->sms($msg, $phone);
                   
                   // $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail);
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/quote_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
            }
             if($req_list->service_type == 1){
                 $data3 = array(
                        'req_list' => $req_list,
                        'list'=>$list,
                      'message'=>'Login to portal to see full details of requested proposal and upload your proposal',
                    );
                    $option = array(
                        'subject'   => 'Requset For Quotation',
                        'from'      => 'purchasingdpt@lfcwww.org',
                        'from_name' => 'Living Faith E-procurement',
                        'to'        => $supplier->email,
                        'data'      => $data3,
                    );
                   
                 $phone = "234".substr($supplier->primary_phone,1);
                $msg = "Dear ".$supplier->company_name.", please login go to your dashboard on http://procure.lfcww.org to view Request For Proposal document sent to you.";
                  $this->sms($msg, $phone);
                 
                   // $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail);
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/proposal_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
            }
                      
                  }

             
         }
                $task='Sent Quote to vendors'; 
                $this->audit($task);
                $this->session->set_flashdata('message', 'Quote Request successfully sent to vendor.'); 
                redirect(site_url('request'));
         }
        }
   
    
    public function requisition_list()
        {
        $req_list = $this->Department_requisition_model->get_all_new();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/all_list', $data);
        }
    
    
    public function vendors($id)
        {
        $req_list = $this->Vendor_rfq_model->get_vendor($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'title' => 'Vendors',
        );
           $this->template->load('template', 'request/vendor_view', $data);
        }
    
   
     public function review($id)
        {
        $req_list = $this->Department_requisition_model->get_by_id($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'title' => 'Review Requisition',
        );
           $this->template->load('template', 'requisition/review_form', $data);
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
        $this->form_validation->set_rules('summary', 'Request Note', 'trim|required');
         $this->form_validation->set_rules('date_submission', 'Date to submit RFQ', 'trim|required');
        $this->form_validation->set_rules('company[]', 'Company', 'trim|required');
    }
    
}

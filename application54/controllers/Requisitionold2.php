<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisition extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model', 'Login_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Settings_model', 'Requisition_details_model', 'Audit_model', 'Product_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
           // $this->admin_id=$this->login['admin_id'];
         $this->user_id=$this->login['user_id'];
            $this->emails=$this->login['email'];
        }
    
        public function index()
        {
       // $this->new();
        }
    
    
      public function lists()
        {
        $req_list = $this->Requisition_details_model->get_department2($this->department_id, $this->user_id);
        $list = $this->Requisition_details_model->get_by_department($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'list' => $list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/list', $data);
        }
    
    
    
    public function new($id=NULL)
        {   
         if(!empty($id)){
             $row= $this->Requisition_details_model->get_by_id2($id);
             $rows= $this->Requisition_details_model->get_by_id($id);
             $category_list = $this->Vendor_category_model->get_alls();
             $category_name = $this->Vendor_category_model->get_by_id($rows->category_id);
             $product_list = $this->Product_model->get_by_cat($rows->category_id);
             $department_status= $this->Department_model->get_by_id($this->department_id);
             $data = array(
                'title' => 'Create requisition',
                'department_status'=> $department_status,
                'rows'=> $row,
                'category'=> $rows->category_id,
                  'name'=> $category_name->category,
                 'rid'=> $id,
                 'more'=>'Add more item to requisition list',
                 'requisition'=>'Requisition List',
                  'category_list'=> $category_list,
                  'product_list'=> $product_list,
        );
           $this->template->load('template', 'requisition/form', $data);  
        }else{
        $category_list = $this->Vendor_category_model->get_alls();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $activities= $this->Activities_model->get_all();
        $data = array(
            'title' => 'Create requisition',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
             'category_list'=> $category_list,
        );
           $this->template->load('template', 'requisition/form', $data);
        }
         }
    
     public function new_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->new();
            }else{
             
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
             
             if($this->input->post('rid',TRUE)){
                 
                   $data = array(
                'req_id'=> $this->input->post('rid',TRUE),
                'product_id' => $this->input->post('product',TRUE),
                'specification' => $this->input->post('spec',TRUE),
                'quantity'=>$this->input->post('quantity',TRUE),
                'cat_id'=>$this->input->post('category',TRUE),
                ); 
             // Insert products into Requisition Details
             $this->Department_requisition_model->insert($data); 

                $this->session->set_flashdata('message', 'New Item added sucessfully to requisition.'); 
                redirect(site_url('requisition/new/'.$this->input->post('rid',TRUE)));
                 
             }else{
                 $created_by = $this->Login_model->get_name($this->emails);
             $data_req = array(
                 'user_id'=>$created_by->id,
                  'department_id'=>$this->department_id,
                  'category_id'=>$this->input->post('category',TRUE),
                 'concur'=> 1,
                 'h_receive' => date('Y-m-d H:i:s',time()),
                ); 
             $reqisition_id=$this->Requisition_details_model->insert($data_req);
             
               $data_ref = array(
                'reference'=> 'RQ/'.str_pad($reqisition_id,8,0,STR_PAD_LEFT),
                ); 
            //Update Requisition with Reference Number
            $this->Requisition_details_model->update($reqisition_id, $data_ref);
                 
               $data = array(
                'req_id'=> $reqisition_id,
                'product_id' => $this->input->post('product',TRUE),
                'specification' => $this->input->post('spec',TRUE),
                'quantity'=>$this->input->post('quantity',TRUE),
                'cat_id'=>$this->input->post('category',TRUE),
                ); 
             // Insert products into Requisition Details
             $this->Department_requisition_model->insert($data); 
            
              $get_department = $this->Department_model->get_email($this->department_id);
                 $data3 = array(
                        'info'=>'New Requisition Created by '.$get_department->dept_name.' department',
                       'comment'=>'Urgent attention of '.$get_department->dept_name.' Head of departnent is required to concur with requisition. Thanks',
                    );
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                   
                    $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->store_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
             
                $task='Created a new requisition'; 
                $this->audit($task);
                $this->session->set_flashdata('message', 'Requisition successfully created.'); 
                redirect(site_url('requisition/new/'.$reqisition_id));
             }
         }
        }
    
    
     public function edit_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->new($this->input->post('nrid',TRUE));
            }else{
                $data_req = array(
               'product_id' => $this->input->post('product',TRUE),
                'specification' => $this->input->post('spec',TRUE),
                'quantity'=>$this->input->post('quantity',TRUE),
                'cat_id'=>$this->input->post('category',TRUE),
            );
            
             $task='updated an item on requisition'; 
            $this->audit($task);
            $this->Department_requisition_model->update_all($this->input->post('id',TRUE), $this->input->post('nrid',TRUE), $data_req); 
            
             $this->session->set_flashdata('message', 'Item successfully updated for requisition.'); 
            redirect(site_url('requisition/new/'.$this->input->post('nrid',TRUE)));
            
         }
        }
    
     public function delete_action()
        {
             $task='deleted an item from requisition'; 
            $this->audit($task);
        
             $this->Department_requisition_model->delete_multiple($this->input->post('id',TRUE), $this->input->post('nrid',TRUE));
            
             $this->session->set_flashdata('message', 'Item successfully deleted from requisition.'); 
            redirect(site_url('requisition/new/'.$this->input->post('nrid',TRUE)));
            
         }
    
    
    
    public function hod_approve()
        {
        $req_list = $this->Requisition_details_model->get_all_concur($this->department_id);
        $list = $this->Requisition_details_model->get_by_department($this->department_id);
        //$req_list = $this->Department_requisition_model->get_all_concur($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/concur_list', $data);
        }
    
    public function head_approve()
        {
         $req_id=$this->Requisition_details_model->get_by_id($this->input->post('id',TRUE));
        if($req_id){
               
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
            
         $date=date("Y-m-d H:i:s");
            
             $get_department = $this->Department_model->get_email($this->department_id); 
             $cat_id = $this->Vendor_category_model->get_by_id($req_id->category_id);
            if($cat_id->service_type == 1){
               $data = array(
               'req_status' => 3,
                'concur_status' => 1,
                'technical' => 1,
                'h_treated'=>$date,
                't_receive'=>$date,
            ); 
            $d = $this->Department_model->get_by_cat($req_id->category_id);
            $recipientArr = array($d->general_email, $d->techead_email, $get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail);
                 $data3 = array(
                        'info'=>'Requisition created '.$get_department->dept_name.' and approved by head of department',
                       'comment'=>'Urgent attention of Technical review is required for review and processing of the requisition. Thanks'
                    );
            }else{
                $data = array(
                'req_status' => 2,
                'concur_status' => 1,
                'store' => 1,
                'h_treated'=>$date,
                'st_receive'=>$date,
               );  
             $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->store_mail);
             $data3 = array(
                        'info'=>'Requisition created '.$get_department->dept_name.' and approved by head of department',
                        'comment'=>'Urgent attention of Store is required to check availability of requisition items. Thanks'
                    );
            }
            
                    $option = array(
                        'subject'   => 'Requisition Approval',
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
            $task='Approved a departmental requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($this->input->post('id',TRUE), $data);
            $this->session->set_flashdata('message', 'Requisition successfully approved by departmental head');
            redirect(site_url('requisition/hod_approve'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/hod_approve'));   
        }
        
        }
    
    
     public function head_query()
        {
        $req_list = $this->Requisition_details_model->get_by_id($this->input->post('id',TRUE));
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $this->input->post('id',TRUE),
            'title' => 'Query Requisition',
        );
           $this->template->load('template', 'requisition/hquery_form', $data);
        }
    
     public function head_query_action()
        {
        $this->_rules2();
         if ($this->form_validation->run() == FALSE) {
               $this->review($this->input->post('rev_id'));
            }else{
             
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

             $date=date("Y-m-d H:i:s");
                $data_req = array(
                'h_treated'=>$date,
                'concur_status' => 3
            );
             
             $req_list = $this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
             $from = $this->Department_model->get_email($req_list->department_id);
              $get_department = $this->Department_model->get_email($this->department_id);
                  $data3 = array(
                    'info'=>'Head of Department query of requisition: '.$req_list->reference.' generated by department of '. $from->dept_name,
                     'comment'=>$this->input->post('comment',TRUE),
                    );
             
                $d=$this->input->post('destination',TRUE);
        
             if($d == 1){
                $recipientArr = array($host->procure_mail, $host->store_mail, $from->email, $from->hod_email, $from->general_email, $get_department->email); 
             }
            $option = array(
                        'subject'   => strtoupper($get_department->dept_name).' Head of Department query on requisition: '.$req_list->reference,
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                  $task='query requisition: '.$req_list->reference; 
                  $this->audit($task);
                  $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
                  $this->session->set_flashdata('message', 'Requisition successfully reviewed.'); 
                  redirect(site_url('requisition/hod_approve'));
            }   
            
        }
    
     public function head_reject()
        {
        if($this->Requisition_details_model->get_by_id($this->input->post('id',TRUE))){
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
            
            $date=date("Y-m-d H:i:s");
            $data = array(
            'concur_status' => 2,
            'supply_status' => 2,
            'h_treated'=>$date,
        );
            $get_department = $this->Department_model->get_email($this->department_id);
                  $data3 = array(
                        'info'=>'Requisition rejected by '.$get_department->dept_name.' head of department',
                    );
                    $option = array(
                        'subject'   => 'Requisition Declined',
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                   
                    $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            $task='rejected requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($this->input->post('id',TRUE), $data); 
            $this->session->set_flashdata('message', 'Requisition rejected by departmental head.'); 
            redirect(site_url('requisition/hod_aprove'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/hod_approve/'));   
        }
        
        }
    
    
    public function review_service()
        {
        $req_list = $this->Requisition_details_model->get_all_review($this->department_id);
        $list = $this->Requisition_details_model->get_by_review($this->department_id);
        $msg_list = $this->Requisition_details_model->get_msg_req($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
             'msg_list' => $msg_list,
            'title' => 'Requisition review lists',
        );
           $this->template->load('template', 'requisition/review_list', $data);
        }
    
     public function review()
        {
        $req_list = $this->Requisition_details_model->get_by_requisition($this->input->post('id',TRUE));
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $this->input->post('id',TRUE),
            'title' => 'Review Requisition',
        );
           $this->template->load('template', 'requisition/review_form', $data);
        }
    
     public function review_action()
        {
        $this->_rules2();
         if ($this->form_validation->run() == FALSE) {
               $this->review($this->input->post('rev_id'));
            }else{
             
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
             
             for($count = 0; $count < count($this->input->post('spec',TRUE)); $count++){
               $data = array(
                 'specification' => $this->input->post('spec',TRUE)[$count],
                 'quantity'=>$this->input->post('quantity',TRUE)[$count],
                ); 
                $this->Department_requisition_model->update($this->input->post('rev_id',TRUE)[$count], $data);
             }

             $date=date("Y-m-d H:i:s");
                $data_req = array(
                'req_status' => 4,
                'technical_head' => 1,
                'technical_status' => 1,
                't_treated'=>$date,
                'thead_receive'=>$date,
            );
             $req_list = $this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
             $from = $this->Department_model->get_email($req_list->department_id);
             $get_department = $this->Department_model->get_email($this->department_id);
                  $data3 = array(
                    'info'=>'Requisition: '.$req_list->reference.' generated by department of '. $from->dept_name.' reviewed by '.$get_department->dept_name.' department.',
                      
                     'comment'=>$this->input->post('comment',TRUE).'<br>Urgent attention of Head of Technical Unit of '.$get_department->dept_name.' department is required to approve requisition items. Thanks',
                    );
             
                $d=$this->input->post('destination',TRUE);
                $recipientArr = array($host->procure_mail, $host->store_mail, $host->audit_mail, $from->email, $from->hod_email, $from->general_email,  $get_department->general_email,  $get_department->email, $get_department->tec_email, $get_department->techead_email); 
             
             $option = array(
                        'subject'   => 'Technical Review on requisition: '.$req_list->reference,
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                  $task='review requisition'; 
                  $this->audit($task);
                  $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
                 $this->session->set_flashdata('message', 'Requisition successfully reviewed.'); 
                  redirect(site_url('requisition/review_service'));
            }   
         }
    
     public function tech_head()
        {
        $req_list = $this->Requisition_details_model->get_all_review2($this->department_id);
        $list = $this->Requisition_details_model->get_by_review($this->department_id);
        $msg_list = $this->Requisition_details_model->get_msg_req($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
             'msg_list' => $msg_list,
            'title' => 'Requisition review lists',
        );
           $this->template->load('template', 'requisition/head_list', $data);
        }
    
    public function tech_approve()
        {
         $req_id=$this->Requisition_details_model->get_by_id($this->input->post('id',TRUE));
        if($req_id){
               
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
            
         $date=date("Y-m-d H:i:s");
            
               $data = array(
                'req_status' => 5,
                 'admin'=>1,
                 'technical_head_status' => 1,
                'thead_treated'=>$date,
                'ad_receive'=>$date,
             ); 
             $from = $this->Department_model->get_email($req_id->department_id);
            $get_department = $this->Department_model->get_email($this->department_id);
            $recipientArr = array($get_department->email, $get_department->general_email, $get_department->techead_email, $host->audit_mail, $host->procure_mail, $host->admin_mail, $host->store);
            
             $data3 = array(
                        'info'=>'Requisition reviewed by Technical Head',
                 
                    'info'=>'Requisition: '.$req_id->reference.' reviewed by technical unit of '.$get_department->dept_name.' department, approved by it Head of Technical Unit.',
                     'comment'=>'Urgent attention of Church Administrator is required to approve requisition for vendor quotations. Thanks',
                    );
                    $option = array(
                        'subject'   => 'Requisition review',
                          'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
            $task='technical review of a requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($this->input->post('id',TRUE), $data);
            $this->session->set_flashdata('message', 'Requisition successfully approved by departmental head');
            redirect(site_url('requisition/tech_head'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/tech_head'));   
        }
        
        }
    
    public function tech_query()
        {
        $req_list = $this->Requisition_details_model->get_by_requisition($this->input->post('id',TRUE));
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $this->input->post('id',TRUE),
            'title' => 'Query Requisition',
        );
           $this->template->load('template', 'requisition/tquery_form', $data);
        }
    
     public function tech_query_action()
        {
        $this->_rules2();
         if ($this->form_validation->run() == FALSE) {
               $this->review($this->input->post('rev_id'));
            }else{
             
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

             $date=date("Y-m-d H:i:s");
                $data_req = array(
                'thead_treated'=>$date,
                'technical_head_status' => 3
            );
             
             $req_list = $this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
             $from = $this->Department_model->get_email($req_list->department_id);
              $get_department = $this->Department_model->get_email($this->department_id);
                  $data3 = array(
                    'info'=>'Requisition: '.$req_list->reference.' generated by department of '. $from->dept_name.' reviewed by '.$get_department->dept_name.' department.',
                     'comment'=>$this->input->post('comment',TRUE),
                    );
             
                $d=$this->input->post('destination',TRUE);
                $recipientArr = array($host->procure_mail, $from->email, $from->hod_email, $from->general_email,  $get_department->general_email, $get_department->email, $get_department->tec_email, $get_department->techead_email); 
             
                $option = array(
                        'subject'   => strtoupper($get_department->dept_name).' Technical Head query on requisition: '.$req_list->reference,
                         'from'      =>  $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                  $task='query requisition: '.$req_list->reference; 
                  $this->audit($task);
                  $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
                  $this->session->set_flashdata('message', 'Requisition successfully queried.'); 
                  redirect(site_url('requisition/tech_head'));
            }   
            
        }
    
     public function store()
        {
       $req_list = $this->Requisition_details_model->get_all_store();
        $list = $this->Requisition_details_model->get_all_department_store();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'list' => $list,
            'title' => 'Review Requisition',
        );
           $this->template->load('template', 'requisition/store_list', $data);
        }
    
     public function available($id)
        {
            if($this->Requisition_details_model->get_by_requisition($id)){
            $req_list = $this->Requisition_details_model->get_by_requisition($id);
            $department_status= $this->Department_model->get_by_id($this->department_id);
            $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
            'title' => 'Store Check',
        );
                 $this->template->load('template', 'requisition/store_form', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/store'));   
        }
          
         }
    
    public function available_action()
        {
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
            
             $date=date("Y-m-d H:i:s");
                $data_req = array(
                'req_status' => 5,
                'store_status' => 1,
                 'admin'=>1,
                'st_treated'=>$date,
                'ad_receive'=>$date,
            );
            
             $req_list = $this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
             $from = $this->Department_model->get_email($req_list->department_id);
              $get_department = $this->Department_model->get_email($this->department_id);
            
            $data3 = array(
                      'info'=>'Requisition: '.$req_list->reference.' generated by department of '. $from->dept_name.' checked by department of store for availability.',
                      'comment'=>$this->input->post('comment',TRUE),
                    );
            
                    $option = array(
                        'subject'   => 'Store Check for requisition: '.$req_list->reference,
                         'from'      => $get_department->email,
                        'from_name' => $get_department_dept_name,
                        'data'      => $data3,
                    );
                  
               $recipientArr = array($host->ca_mail, $from->hod_email, $from->general_email,  $get_department->general_email, $get_department->email, $get_department->tec_email, $get_department->techead_email, $host->store_mail, $host->procure_mail, $host->audit_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
             $task='Checked store on a requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
            $this->session->set_flashdata('message', 'Store successfully checked and updated for requisition.'); 
            redirect(site_url('requisition/store'));
            
         }
   #########################################################################
    ####################### ADMIN STARTS HERE ##########################
    
     public function requisition_list()
        {
        $req_list = $this->Requisition_details_model->get_all_new();
        $list = $this->Requisition_details_model->get_all_department_admin();
            $msg_list = $this->Requisition_details_model->get_msg(5);
        //$req_list = $this->Department_requisition_model->get_all_new();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'msg_list' => $msg_list,
             'list' => $list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/all_list', $data);
        }
    
    
    public function approve($id)
        {
            
        $req_id=$this->Requisition_details_model->get_by_id($id);
        if($req_id){
               
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
            
         $date=date("Y-m-d H:i:s");
            
               $data = array(
               //'req_status' => 2,
                'quote'=>1,
                'pr_receive'=>$date,
                'admin_status' => 1,
                'ad_treated'=>$date,
                'req_status' => 6,
             ); 
             $dept=$this->Requisition_details_model->get_by_id($id);
             $get_department = $this->Department_model->get_email($dept->department_id);
            $recipientArr = array($get_department->email, $get_department->general_email, $get_department->techead_email, $host->audit_mail, $host->procure_mail, $host->admin_mail, $host->store,$host->rp);
            
             $data3 = array(
                        'info'=>'Requisition '.$dept->reference.' by department of '.$get_department->dept_name.', approved for request for quotes/proposal',
                    );
                    $option = array(
                        'subject'   => 'Requisition Approved for Quote/Proposal Request',
                         'from'      => $get_department->email,
                        'from_name' => $get_department->dept_name,
                        'data'      => $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
            $task='approved requisition for quotes/proposal'; 
            $this->audit($task);
            $this->Requisition_details_model->update($id, $data);
            $this->session->set_flashdata('message', 'Requisition successfully approved by administrator');
            redirect(site_url('requisition/requisition_list'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/requisition_list'));   
        }
     }
    
    
     public function reject($id)
        {
        if($this->Requisition_details_model->get_by_id($id)){
            $date=date("Y-m-d H:i:s");
            $data = array(
            'admin_status' => 2,
            'ad_treated'=>$date,
                 'supply_status'=>2,
        );
             $task='rejected a requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($id, $data); 
             $this->session->set_flashdata('message', 'Requisition rejected successfully.');
            redirect(site_url('requisition/review_service'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/review_service'));   
        }
        
        }
    
    
     public function query($id)
        {
        $req_list = $this->Requisition_details_model->get_by_requisition($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
            'title' => 'Review Requisition',
        );
        $this->template->load('template', 'requisition/query_form', $data); 
        }
    
     public function query_action()
        {
            
         $this->_rules2();
         if ($this->form_validation->run() == FALSE) {
               $this->review($this->input->post('rev_id'));
            }else{
             
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

             $date=date("Y-m-d H:i:s");
                $data_req = array(
                'ad_treated'=>$date,
                'admin_status' => 3
            );
             
             $req_list = $this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
             $from = $this->Department_model->get_email($req_list->department_id);
             $get_department = $this->Department_model->get_email($this->department_id);
              $tec = $this->Requisition_details_model->get_rev($this->input->post('req_id',TRUE));
            // $get_department = $this->Department_model->get_email($this->department_id);
                  $data3 = array(
                    'info'=>'Requisition: '.$req_list->reference.' generated by department of '. $from->dept_name.' queried by Administrator.',
                     'comment'=>$this->input->post('comment',TRUE),
                    );
             
                $d=$this->input->post('destination',TRUE);
              
           if($d == 1){
              $recipientArr = array($host->procure_mail, $from->email, $from->hod_email, $from->general_email, $get_department->general_email, $get_department->email, $get_department->tec_email, $get_department->techead_email, $host->ca_mail); 
             }
              if($d == 2){
                $recipientArr = array($tec->tec_email, $tec->techead_email, $host->procure_mail, $get_department->general_email, $get_department->tec_email, $get_department->techead_email, $host->ca_mail); 
             }
             if($d == 3){
                $recipientArr = array($host->store_mail, $host->procure_mail, $get_department->general_email, $get_department->email, $get_department->tec_email, $host->ca_mail); 
             }
                     
             $option = array(
                        'subject'   => strtoupper($get_department->dept_name).' Administrator query on requisition: '.$req_list->reference,
                         'from'      =>  $get_department->email,
                        'from_name' =>  $get_department->dept_name,
                        'data'      =>  $data3,
                    );
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                  $task='query requisition: '.$req_list->reference; 
                  $this->audit($task);
                  $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
                 $this->session->set_flashdata('message', 'Query successfully done.'); 
            redirect(site_url('requisition/requisition_list'));
            }   
            
         }
     
    
    ##########################################################################################################
    ################################## ALL REQUISITIONS ###############################
    
    
     public function all()
        {
        $req_list = $this->Requisition_details_model->get_all();
        $list = $this->Requisition_details_model->get_by_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'list' => $list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/all', $data);
        }
    
    
    
    public function _rules()
    {
      
        $this->form_validation->set_rules('category', 'Product/Service category', 'trim|required');
        $this->form_validation->set_rules('product', 'Product/Service', 'trim|required');
    }
    
         public function _rules2()
    {
         $this->form_validation->set_rules('comment', 'Review comment is required', 'trim|required');
    }
    
   public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.'(Staff)',
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
              );
            
            $this->Audit_model->insert($data_audit);
    }
    
    
     public function get_product(){ 
    $cus = $this->input->post('lga',TRUE); 
        $document_data = $this->Product_model->get_by_cat($cus);
                foreach($document_data as $row)
                { 
                 echo "<option value='".$row->product_id."'>".$row->name."</option>";
                }
        }
    
}

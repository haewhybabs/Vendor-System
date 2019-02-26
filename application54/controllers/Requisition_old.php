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
        $this->create();
        }
    
    public function create($id=NULL)
        {   
         if(!empty($id)){
             $row= $this->Requisition_details_model->get_by_id2($id);
             $department_status= $this->Department_model->get_by_id($this->department_id);
             $data = array(
                'title' => 'Create requisition',
                'department_status'=> $department_status,
                'rows'=> $row,
                 'more'=>'Add more item to requisition list',
                 'requisition'=>'Requisition List',
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
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
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
            
             $created_by = $this->Login_model->get_name($this->emails);
             $data_req = array(
                 'user_id'=>$created_by->id,
                  'department_id'=>$this->department_id,
                  'category_id'=>$this->input->post('category',TRUE),
                ); 
             $reqisition_id=$this->Requisition_details_model->insert($data_req);
            
               $data = array(
                'req_id'=> $reqisition_id,
                'product_service' => $this->input->post('product',TRUE),
                'specification' => $this->input->post('spec',TRUE),
                'quantity'=>$this->input->post('quantity',TRUE),
                ); 
                $this->Department_requisition_model->insert($data);
            
              $get_department = $this->Department_model->get_email($this->department_id);
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'New Requision Created by '.$get_department->dept_name.' department',
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
                redirect(site_url('requisition/create/'.$reqisition_id));
         }
        }
    
    public function emails()
        {
          $get_department = $this->Requisition_details_model->get_department($this->department_id);
              //$this->Requisition_details_model->get_by_department($this->department_id);
            print_r($get_department);
        }
    
    public function lists()
        {
        $req_list = $this->Requisition_details_model->get_department($this->department_id);
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
    

    
    public function concur()
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
    
    public function admin_concur($id)
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
            
            $cat_id = $this->Vendor_category_model->get_by_id($req_id->category_id);
            if($cat_id->service_type == 1){
               $data = array(
               'req_status' => 2,
                'concur_status' => 1,
            ); 
            }else{
                $data = array(
                'req_status' => 1,
                'concur_status' => 1,
               );  
            }
            $get_department = $this->Department_model->get_email($this->department_id);
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'Requisition approved by '.$get_department->dept_name.' head of department',
                    );
                   
                    $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->store_mail, $host->technical_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
            $task='Concur with a requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($id, $data);
            $this->session->set_flashdata('message', 'Requisition successfully accepted by departmental head');
            redirect(site_url('requisition/concur'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/concur'));   
        }
        
        }
    
     public function admin_reject($id)
        {
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
            
            $date=date("Y-m-d");
            $data = array(
            'concur_status' => 2,
            'approved_date'=>$date,
        );
            $get_department = $this->Department_model->get_email($this->department_id);
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'Requisition rejected by '.$get_department->dept_name.' head of department',
                    );
                   
                    $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->store_mail, $host->technical_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
             $task='rejected requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($id, $data); 
            $this->session->set_flashdata('message', 'Requisition rejected by departmental head.'); 
            redirect(site_url('requisition/concur'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/concur/'));   
        }
        
        }
    
    public function review_service()
        {
        $req_list = $this->Requisition_details_model->get_all_review();
       // $list = $this->Requisition_details_model->get_all_department_review();
        $list = $this->Requisition_details_model->get_by_department($this->department_id);
       // $req_list = $this->Department_requisition_model->get_all_review($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'title' => 'Requisition review lists',
        );
           $this->template->load('template', 'requisition/review_list', $data);
        }
    
     public function review($id)
        {
        $req_list = $this->Requisition_details_model->get_by_requisition($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
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
             
             for($count = 0; $count < count($this->input->post('product',TRUE)); $count++){
               $data = array(
                 'product_service' => $this->input->post('product',TRUE)[$count],
                 'specification' => $this->input->post('spec',TRUE)[$count],
                 'quantity'=>$this->input->post('quantity',TRUE)[$count],
                ); 
                $this->Department_requisition_model->update($this->input->post('rev_id',TRUE)[$count], $data);
             }
             $date=date("Y-m-d");
                $data_req = array(
                'req_status' => 1,
                'technical_status' => 1,
                'approved_date'=>$date,
            );
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'New requisition reviewed and approve by Technical department',
                    );
                   
                    $recipientArr = array($host->rp_mail, $host->procure_mail);
                
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
            if($this->Requisition_details_model->get_by_id($id)){
            $req_list = $this->Requisition_details_model->get_by_requisition($id);
            $department_status= $this->Department_model->get_by_id($this->department_id);
            $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
            'title' => 'Review Requisition',
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
            
             $date=date("Y-m-d");
                $data_req = array(
                'req_status' => 3,
                'store_status' => 1,
                    'store_comment' => $this->input->post('comment',TRUE),
                'approved_date'=>$date,
            );
            
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'New requisition verified by Store department',
                    );
                   
                    $recipientArr = array($host->rp_mail, $host->store_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
             $task='updated a requisition'; 
            $this->audit($task);
            $this->Requisition_details_model->update($this->input->post('req_id',TRUE), $data_req); 
             $this->session->set_flashdata('message', 'Store successfully checked and updated for requisition.'); 
            redirect(site_url('requisition/store'));
            
         }
    
    
     public function requisition_list()
        {
        $req_list = $this->Requisition_details_model->get_all_new();
        $list = $this->Requisition_details_model->get_all_department_admin();
        //$req_list = $this->Department_requisition_model->get_all_new();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'title' => 'All Requisition lists',
        );
           $this->template->load('template', 'requisition/all_list', $data);
        }
    
    
    public function approve($id)
        {
            if($this->Requisition_details_model->get_by_id($id)){
            $req_list = $this->Requisition_details_model->get_by_requisition($id);
            $department_status= $this->Department_model->get_by_id($this->department_id);
            $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
            'title' => 'Review Requisition',
        );
                 $this->template->load('template', 'requisition/approve_form', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/store'));   
        }
          
         }
    
     public function edit_action()
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
            
                $data_req = array(
                'quantity' => $this->input->post('quantity',TRUE),
            );
            
                    $option = array(
                        'subject'   => 'New Requisition',
                         'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'data'      => 'New requisition item edited Church Admin',
                    );
                   
                    $recipientArr = array($host->rp_mail, $host->procure_mail);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
             $task='updated an item on requisition'; 
            $this->audit($task);
            $this->Department_requisition_model->update_all($this->input->post('id',TRUE), $this->input->post('req_id',TRUE), $data_req); 
            
             $this->session->set_flashdata('message', 'Item successfully updated for requisition.'); 
            redirect(site_url('requisition/approve/'.$this->input->post('req_id',TRUE)));
            
         }
    
     public function delete_action()
        {
             $task='deleted an item from requisition'; 
            $this->audit($task);
        
             $this->Department_requisition_model->delete_multiple($this->input->post('id',TRUE), $this->input->post('req_id',TRUE));
            
             $this->session->set_flashdata('message', 'Item successfully deleted from requisition.'); 
            redirect(site_url('requisition/approve/'.$this->input->post('req_id',TRUE)));
            
         }
    
    public function confirm($id)
        {
        if($this->Requisition_details_model->get_by_id($id)){
            $date=date("Y-m-d");
            $data = array(
            'admin_status' => 1,
            'approved_date'=>$date,
        );
            $this->Requisition_details_model->update($id, $data); 
            redirect(site_url('requisition/requisition_list'));
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/requisition_list/'.$id));   
        }
        
        }
    
     public function reject($id)
        {
        if($this->Requisition_details_model->get_by_id($id)){
            $date=date("Y-m-d");
            $data = array(
            'technical_status' => 2,
            'approved_date'=>$date,
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
    
    public function approve_list()
        {
        $req_list = $this->Requisition_details_model->get_all_approve();
        $list = $this->Requisition_details_model->get_all_department_approve();
        //$req_list = $this->Department_requisition_model->get_all_approve();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'title' => 'Approved Requisition',
        );
           $this->template->load('template', 'requisition/approve', $data);
        }
    
    
     public function view($id)
        {
        if($this->Department_requisition_model->get_by_id($id)){
            $department_status= $this->Department_model->get_by_id($this->department_id);
            $details=$this->Department_requisition_model->get_by_id($id);
             $data = array(
            'department_status'=> $department_status,
            'details' => $details,
            'title' => 'Requisition Details',
        );
           $this->template->load('template', 'requisition/view', $data);
            
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('requisition/requisition_list/'));   
        }
        
        }
    
    
         public function _rules()
    {
      
        $this->form_validation->set_rules('category', 'Product/Service category', 'trim|required');
        $this->form_validation->set_rules('product[]', 'Product/Service', 'trim|required');
    }
    
         public function _rules2()
    {
        $this->form_validation->set_rules('product[]', 'Product/Service', 'trim|required');
         $this->form_validation->set_rules('spec[]', 'Specifications', 'trim|required');
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
    
    
     public function get_product(){ 
    $cus = $this->input->post('lga',TRUE); 
        $document_data = $this->Product_model->get_by_cat($cus);
         echo '<option value="">Select Document</option>';
                foreach($document_data as $row)
                { 
                 echo "<option value='".$row->product_id."'>".$row->name."</option>";
                }
        }
    
}

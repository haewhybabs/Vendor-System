<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sap extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model','Audit_model', 'Login_model']);
        $this->login = $this->session->userdata('cms_logged_in');
        $this->department_id=$this->login['department_id'];
         $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
    }

    public function index()
    {
        $msg_list= $this->Requisition_details_model->get_msg(); 
        $req_list = $this->Requisition_details_model->get_all_sap();
        $list = $this->Requisition_details_model->get_all_department_dfs();
        //$req_list = $this->Department_requisition_model->get_all_concur($this->department_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list, 
            'title' => 'SAP',
        );
        $this->template->load('template', 'sap/lists', $data);

    }


    public function approve($id){
        if($this->Requisition_details_model->get_by_id($id)){
                   //Load email library
        $row=$this->Requisition_details_model->get_by_id($id);
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
        if($row->sap == 1 && $row->sap_status == 1){
              
            $data = array(     
            'rp' => 1,
            'req_status' => 11,
            'sap2' => 3,
            'sap_status' => 1,
            'sap_treated'=>$date,
            'rp_receive'=>$date,
            );
            
             $b_department = $this->Department_model->get_email($this->department_id);
            $dept=$this->Requisition_details_model->get_by_id($id);
             $get_department = $this->Department_model->get_email($dept->department_id);
            $recipientArr = array($host->audit_mail, $host->procure_mail, $host->sap_mail, $host->forensic_mail, $b_department->email, $host->rp_mail);
            
            $data3 = array(
                        'info'=>'Purchased Order for supply of requisition items with refence number: '.$dept->reference.' by department of '.$get_department->dept_name.' sent By SAP finance for Final Approval.',
                 'comment'=>'Urgent attention of Final Approval is required to approve requisition for vendor quotations. Thanks',
                    );
                    $option = array(
                        'subject'   => 'Purchased order awaiting Final Approval',
                         'from'      => $b_department->email,
                        'from_name' =>  'SAP Finance',
                        'data'      => $data3,
                    ); 
            
          }else{
            $data = array(     
            'forensic' => 1,
            'req_status' => 10,
            'sap_status' => 1,
            'sap_treated'=>$date,
            'f_receive'=>$date,
            );
              $b_department = $this->Department_model->get_email($this->department_id);
            $dept=$this->Requisition_details_model->get_by_id($id);
             $get_department = $this->Department_model->get_email($dept->department_id);
            $recipientArr = array($host->audit_mail, $host->procure_mail, $host->sap_mail, $host->forensic_mail, $b_department->email);
            
             $data3 = array(
                        'info'=>'Purchased Order for supply of requisition items with refence number: '.$dept->reference.' by department of '.$get_department->dept_name.' approved by SAP Finance. Urgent attention of Forensic is required for treatment of requisition',
                    );
                    $option = array(
                        'subject'   => 'Purchased order awaiting Forensic Approval',
                         'from'      => $b_department->email,
                        'from_name' =>  'SAP Finance',
                        'data'      => $data3,
                    ); 
          }
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
                    $task='Approve a purchase order of requisition items with refence number: '.$dept->reference.' by department of '.$get_department->dept_name; 
                    $this->audit($task);
                    $update =  $this->Requisition_details_model->update($id, $data);
                    $this->session->set_flashdata('message', 'Purchase Order Approved successfully');
                    redirect(site_url('sap'));

          
        }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('sap'));    
        }
    }
    
    
    public function reject($id)
        {
            if($this->Requisition_details_model->get_by_id($id)){
            $department_status= $this->Department_model->get_by_id($this->department_id);
             $dept=$this->Requisition_details_model->get_by_id($id);
             $get_department = $this->Department_model->get_email($dept->department_id); 
                 $b_department = $this->Department_model->get_email($this->department_id);
    
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
            'sap_status' => 2,
            'sap_treated'=>$date,
            'supply_status'=>2,
            );
               
                  $data3 = array(
                        'info'=>'Purchase Order for supply of requisition items with reference number: '.$dept->reference.' by department of '.$get_department->dept_name.'rejected by SAP Finance',
                    );
                    $option = array(
                        'subject'   => 'Purchase Order Declined',
                         'from'      => $b_department->email,
                        'from_name' =>  $b_department->dept_name,
                        'data'      => $data3,
                    );
                   
                    $recipientArr = array($host->audit_mail, $host->procure_mail, $host->admin_mail, $host->sap_mail, $host->forensic_mail, $host->admin_mail, $host->budget_mail, $host->store_mail, $host->sap_mail, $host->forensic_mail, $get_department->hod_email);
                
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
                
            $task='rejected a purchase Order for supply of requisition items with refence number: '.$dept->reference.' by department of '.$get_department->dept_name; 
            $this->audit($task);
            $this->Requisition_details_model->update($id, $data); 
                 $this->session->set_flashdata('success',  'Purchase Order declined successfully');
            redirect(site_url('sap'));
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('sap'));   
        }
          
         }
    
    public function query($id)
        {
        if($this->Requisition_details_model->get_by_id($id)){
           
        $req_list = $this->Requisition_details_model->get_by_requisition_price($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'req_id' => $id,
            'title' => 'Query PO',
        ); 
        $this->template->load('template', 'sap/edit', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('sap'));   
        }
          
         }
    
    
    public function query_action()
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
                'sap_status' => 3,
                'sap_treated'=>$date,
            );
            
           $b_department = $this->Department_model->get_email($this->department_id);
             $dept=$this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
            $get_department = $this->Department_model->get_email($dept->department_id);
             $tec = $this->Requisition_details_model->get_rev($this->input->post('req_id',TRUE));
            
           $data3 = array(
                        'info'=>'Queried Purchase Order by SAP Finance on '.$dept->reference.', for department of '.$get_department->dept_name,
                        'comment'=>$this->input->post('comment',TRUE),
                    );
            
                    $option = array(
                        'subject'   => 'SAP Purchse Order Query',
                          'from'      =>  $b_department->email,
                        'from_name' => $b_department->dept_name,
                        'data'      => $data3,
                    );
               
             $d=$this->input->post('destination',TRUE);
              
           if($d == 1){
                 $de=2;
              $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->sap_mail); 
             }
              if($d == 3){
                    $de=5;
                $recipientArr = array($tec->tec_email, $tec->techead_email, $host->procure_mail, $get_department->general_email, $host->sap_mail); 
             }
             if($d == 2){
                   $de=3;
                $recipientArr = array($host->store_mail, $host->procure_mail, $get_department->general_email, $get_department->email, $host->sap_mail); 
             }
            
            if($d == 4){
                  $de=7;
                $recipientArr = array($host->procure_mail, $get_department->general_email, $get_department->email, $host->sap_mail); 
             }
            
             $data_msg = array(
                'sender'=>8,
                'to' => $de,
                'stage'=>8,
                'comment'=>$this->input->post('comment',TRUE),
                 'requisition_id'=>$this->input->post('req_id',TRUE),
                 'date_added'=>$date
                 
            );
            
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($recipientArr);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send(); 
            
             $task='queried a purchase order of requisition items with refence number: '.$dept->reference.' by department of '.$get_department->dept_name; 
            $this->audit($task); 
            $this->Requisition_details_model->insert_msg($data_msg); 
             $this->Requisition_details_model->update($this->input->post('req_id'), $data_req);
             $this->session->set_flashdata('message', 'Query successfully done.'); 
            redirect(site_url('sap'));
            
         }
    
     public function vendors($id)
    {
        $quotes = $this->Quotes_model->get_by_vendor_id($id);
        //$list = $this->Requisition_details_model->get_all_department_quote();
        $req_list = $this->Requisition_details_model->get_vendor($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'quotes' => $quotes,
            'department_status'=> $department_status,
            'title' => 'Quotes from vendors',
            'assign_vendor'=>$req_list->vendor_assign,
            'req_id'=>$id,
        );
        $this->template->load('template', 'sap/quotes_list', $data);
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
     

    public function _rules()
    {
        $this->form_validation->set_rules('comment', 'Comment Note', 'trim|required');
    }

}

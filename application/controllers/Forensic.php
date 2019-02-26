<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forensic extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model','Audit_model', 'Login_model','Review_Model']);
        $this->login = $this->session->userdata('cms_logged_in');
    $this->department_id=$this->login['department_id'];
    $this->user_id=$this->login['user_id'];
    $this->emails=$this->login['email'];
    }

    public function index()
    {
        $req_list = $this->Requisition_details_model->getSent_requisition_forensic();
        $req_list_attended= $this->Requisition_details_model->getSent_requisition_forensic_attended();
         $get_quote_count=$this->Quotes_model->get_quote_counting();
         $get_quote_submitted=$this->Quotes_model->get_quote_submitted();
        $data = array(
            
            'req_list' => $req_list,
            'attended'=>$req_list_attended,
            'get_count'=>$get_quote_count,
            'count_submit'=> $get_quote_submitted,
            'title' => 'Forensic',
        );
        $this->template->load('template', 'forensic/lists', $data);

    }


    public function approve(){
        $this->form_validation->set_rules('comment','Comment','required');
      if($this->form_validation->run()){


             $req_id=$this->input->post('req_id');
             $rfq_ID=$this->input->post('rfq_id');
             $comments=$this->input->post('comment');
             $dept=$this->Requisition_details_model->get_by_id_new($req_id); 
             $insert['req_ID']=$req_id;
             $insert['comments']=$comments;
             $insert['dept_ID']=$dept->department_ID;
             $insert['status_checked_by']=$this->emails;
             $insert['process_status_ID']='4';
             $insert['response']='1';
             $insert['req_status_check_ID']='8';
             $insert_stage_activities=$this->Review_Model->insert_stage_activities($insert);

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


               $get_department = $this->Department_model->get_email($dept->department_ID);
                        $recipientArr = array($host->audit_mail, $host->procure_mail, $host->admin_mail, $host->budget_mail, $get_department->email, $get_department->general_email, $host->dfs_mail);
                        
                         $data3 = array(
                                    'info'=>'Approval Sheet for supply of requisition items with refence number: '.$dept->reference.' by department of '.$dept->dept_name.' approved by Forensic.',
                              'comment'=>'Final Aproval is urgently required to approve requisition for vendor quotations. Thanks',
                                );
                                $option = array(
                                    'subject'   => 'Approval Sheet approved by Forensic',
                                     'from'      => 'procure@lfcww.org',
                                    'from_name' =>'LFC eProcurement',
                                    'data'      => $data3,
                                );
                                 $this->email->from($option['from'], $option['from_name']);
                                $this->email->to($recipientArr);
                                $this->email->subject($option['subject']);
                                $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                                $this->email->set_alt_message('View the mail using an html email client');
                                $this->email->send();
                                $task='Approve a purchase order'; 
                                $this->audit($task);

                                 $this->Requisition_details_model->forensic_update($rfq_ID);
                               
                                $this->Requisition_details_model->req_forensic_update($req_id);
                                $this->session->set_flashdata('message', 'Budget for Purchase Order Approved successfully');
                                redirect(site_url('Forensic'));
        }else{
            $this->session->set_flashdata('error', 'Please fill the neccessary details');
              redirect(site_url('Forensic'));    
         }
    }
    
    
    public function reject()
        {
             $this->form_validation->set_rules('comment','Comment','required');
      if($this->form_validation->run()){


             $req_id=$this->input->post('req_id');
             $rfq_ID=$this->input->post('rfq_id');
             $comments=$this->input->post('comment');
             $dept=$this->Requisition_details_model->get_by_id_new($req_id); 
             $insert['req_ID']=$req_id;
             $insert['comments']=$comments;
             $insert['dept_ID']=$dept->department_ID;
             $insert['status_checked_by']=$this->emails;
             $insert['process_status_ID']='4';
             $insert['response']='0';
             $insert_stage_activities=$this->Review_Model->insert_stage_activities($insert);

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


               $get_department = $this->Department_model->get_email($dept->department_ID);
                        $recipientArr = array($host->audit_mail, $host->procure_mail, $host->admin_mail, $host->budget_mail, $get_department->email, $get_department->general_email, $host->dfs_mail);
                        
                         $data3 = array(
                                    'info'=>'Approval Sheet for supply of requisition items with refence number: '.$dept->reference.' by department of '.$dept->dept_name.'Disapproved by Forensic .',
                              'comment'=>'Thanks',
                                );
                                $option = array(
                                    'subject'   => 'Approval Sheet Disapproved by Forensic',
                                     'from'      => 'procure@lfcww.org',
                                    'from_name' =>'LFC eProcurement',
                                    'data'      => $data3,
                                );
                                 $this->email->from($option['from'], $option['from_name']);
                                $this->email->to($recipientArr);
                                $this->email->subject($option['subject']);
                                $this->email->message($this->load->view('templates/requisition_mail', $option['data'], true));
                                $this->email->set_alt_message('View the mail using an html email client');
                                $this->email->send();
                                $task='Approve a purchase order'; 
                                $this->audit($task);

                                $this->Requisition_details_model->forensic_update_reject($rfq_ID);
                                $this->session->set_flashdata('message', 'Budget for Purchase Order Disapproved successfully');
                                redirect(site_url('Forensic'));
         }else{
            $this->session->set_flashdata('error', 'Please fill the neccessary details');
              redirect(site_url('Forensic'));
          
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
        $this->template->load('template', 'forensic/edit', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('forensic'));   
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
                'forensic_status' => 3,
                'fp_treated'=>$date,
            );
            
           $b_department = $this->Department_model->get_email($this->department_id);
             $dept=$this->Requisition_details_model->get_by_id($this->input->post('req_id',TRUE));
            $get_department = $this->Department_model->get_email($dept->department_id);
             $tec = $this->Requisition_details_model->get_rev($this->input->post('req_id',TRUE));
            
           $data3 = array(
                        'info'=>'Queried Purchase Order by Forensic on '.$dept->reference.', for department of '.$get_department->dept_name,
                        'comment'=>$this->input->post('comment',TRUE),
                    );
            
                    $option = array(
                        'subject'   => 'Forensic Purchase Order Query',
                          'from'      =>  $b_department->email,
                        'from_name' => $b_department->dept_name,
                        'data'      => $data3,
                    );
               
             $d=$this->input->post('destination',TRUE);
              
           if($d == 1){ $de=2; $recipientArr = array($get_department->email, $get_department->general_email, $host->audit_mail, $host->procure_mail, $host->forensic_mail); }
            if($d == 3){ $de=5; $recipientArr = array($tec->tec_email, $tec->techead_email, $host->procure_mail, $get_department->general_email, $host->forensic_mail); }
             if($d == 2){ $de=3; $recipientArr = array($host->store_mail, $host->procure_mail, $get_department->general_email, $get_department->email, $host->forensic_mail);}
             if($d == 4){ $de=7; $recipientArr = array($host->procure_mail, $get_department->general_email, $get_department->email, $host->forensic_mail);}
            if($d == 5){ $de=10; $recipientArr = array($host->sap_mail, $get_department->email, $host->forensic_mail); }
            
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
            redirect(site_url('forensic'));
            
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
        $this->template->load('template', 'forensic/quotes_list', $data);
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
    
    public function _rules()
    {
        $this->form_validation->set_rules('comment', 'Rejection Note', 'trim|required');
    }

}

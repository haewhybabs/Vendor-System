<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mails extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Settings_model', 'Audit_model', 'Login_model', 'Department_model']);
        $this->load->library('form_validation');
         $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
            $this->admin_id=$this->login['admin_id'];
         $this->user_id=$this->login['user_id'];
            $this->emails=$this->login['email'];
    }

    public function index()
    {
      $page_data = $this->Settings_model->get_all();
         $department_status= $this->Department_model->get_by_id($this->department_id);

      $data = array(
        'title' => 'Mail Configuration',
        'set_data' => $page_data,
           'department_status'=> $department_status,
      );
        $this->template->load('template', 'mails/form', $data);
    }
    
     public function edit_action()
    {
         $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->index();
            }else{

            $data= array(
                 'server' => $this->input->post('host', TRUE),
		          'username' => $this->input->post('name',TRUE),
                 'password' => $this->input->post('password',TRUE),
                 'audit_mail' => $this->input->post('audit', TRUE),
		        'store_mail' => $this->input->post('store',TRUE),
                'admin_mail' => $this->input->post('admin',TRUE),
                'procure_mail' => $this->input->post('procure', TRUE),
		        'sap_mail' => $this->input->post('sap',TRUE),
                'budget_mail' => $this->input->post('budget',TRUE),
                'dfs_mail' => $this->input->post('dfs', TRUE),
		      'forensic_mail' => $this->input->post('forensic',TRUE),
                'rp_mail' => $this->input->post('rp',TRUE),
                );
             $id=1;   
            $this->Settings_model->update($id, $data);
            // $task='Updated '. $this->input->post('name',TRUE).' on Blood Group';
           // $this->audit($task);
            $task='Change and edited mail configurations on the system'; 
            $this->audit($task);
            $this->session->set_flashdata('message', 'Mail configuration edited successfully');
            redirect(site_url('mails'));
         }
        
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
        $this->form_validation->set_rules('host', 'Host', 'trim|required');
         $this->form_validation->set_rules('name', 'Email username', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Email Password', 'trim|required');
         $this->form_validation->set_rules('audit', 'Audit Dept Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('store', 'Store Dept Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('admin', 'Church Admin Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('procure', 'Procurement Dept Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('sap', 'Sap Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('budget', 'Budget Dept Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('dfs', 'DFS Dept Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('forensic', 'Forensic Dept Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('rp', 'Residential Pastor Email', 'trim|required|valid_email');
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Role_model', 'Audit_model', 'Department_model', 'Login_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
            $this->user_email=$this->login['email'];
         $this->user_id=$this->login['user_id'];
        }
     public function index()
        {
           $this->lists(); 
        }
    
        public function lists()
        {
        $admin_list=$this->Role_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'All Roles',
            'department_status'=> $department_status,
            'admin_list'=> $admin_list,
        );
           $this->template->load('template', 'role/list', $data);
        }
    
    public function create()
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'Create Role',
            'department_status'=> $department_status,
        );
           $this->template->load('template', 'role/form', $data);
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
              
             $data = array(
                'role_ID' =>$this->input->post('admin_cat',TRUE),
                  'role_name' =>$this->input->post('name',TRUE),
                );
              $task='Created a new role'; 
                    $this->audit($task);
                $this->Role_model->insert($data); 
                $this->session->set_flashdata('message', 'Role successfully created.'); 
                redirect(site_url('roles/lists'));
         }
        }
    
    public function update($id)
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $department_details= $this->Role_model->get_by_id($id);
        if($department_details){
          //  $activities= $this->Activities_model->get_all();    
        $data = array(
            'title' => 'Create Role',
            'department_status'=> $department_status,
           // 'activities_data'=> $activities,
            'department'=>$department_details,
        );
            
           $this->template->load('template', 'role/edit', $data);
        }else
        {
          $this->session->set_flashdata('error', 'This department does not exist');
             redirect(site_url('roles'));  
        }
        
        }
    
    
     public function update_action()
        {
        $this->edit_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->update($this->input->post('dept_id'));
            } else {
             $data = array(
                  'role_name'=>$this->input->post('name'), 
                );
              $task='Edited a role'; 
            $this->audit($task);
                $this->Role_model->update($this->input->post('dept_id'), $data); 
                $this->session->set_flashdata('message', 'Role successfully updated.'); 
                redirect(site_url('roles/lists'));
         }
        }
    
        public function delete($id)
        {
        if($this->Role_model->get_by_id($id)){
             $task='Deleted a role'; 
            $this->audit($task);
            $this->Role_model->delete($id); 
                $this->session->set_flashdata('message', 'Role successfully deleted.'); 
                redirect(site_url('roles')); 
        }
        else{
            $this->session->set_flashdata('error', 'This role does not exist');
             redirect(site_url('roles'));     
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
         //Supplier Information Validation
	   $this->form_validation->set_rules('name', 'Department Name', 'trim|required|is_unique[roles.role_name]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
       
    }
    
     public function edit_rules()
    {
        $this->form_validation->set_rules('name', 'Department Name', 'trim|required');
    }
    
}

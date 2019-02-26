<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model','Supplier_model', 'Activities_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
        $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
        }
    
        public function index()
        {
        $department_list=$this->Department_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'All Departments',
            'department_status'=> $department_status,
            'department_list'=> $department_list,
        );
           $this->template->load('template', 'department/list', $data);
        }
    
    public function create()
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $activities= $this->Activities_model->get_all();
        $data = array(
            'title' => 'Create Department',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
        );
           $this->template->load('template', 'department/form', $data);
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
             
             $array_specialty = $this->input->post('activities',TRUE);
             $array_specialty = implode(",", $array_specialty);
            
             $data = array(
                'dept_name'=>$this->input->post('department_name'),
                'activities_id' =>$array_specialty,
                );
             
                $this->Department_model->insert($data); 
                $this->session->set_flashdata('message', 'Department successfully created.'); 
                redirect(site_url('department'));
         }
        }
    
     public function update($id)
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $department_details= $this->Department_model->get_by_id($id);
        if($department_details){
            $activities= $this->Activities_model->get_all();
            
        $data = array(
            'title' => 'Create Department',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
            'department'=>$department_details,
        );
            
           $this->template->load('template', 'department/edit', $data);
        }else
        {
          $this->session->set_flashdata('error', 'This department does not exist');
             redirect(site_url('dashboard'));  
        }
        
        }
    
    
     public function update_action()
        {
        $this->edit_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
             
             $array_specialty = $this->input->post('activities',TRUE);
             $array_specialty = implode(",", $array_specialty);
            
             $data = array(
                'dept_name'=>$this->input->post('department_name'),
                'activities_id' =>$array_specialty,
                );
             
                $this->Department_model->update($this->input->post('dept_id'), $data); 
                $this->session->set_flashdata('message', 'Department successfully updated.'); 
                redirect(site_url('department'));
         }
        }
    
        public function delete($id)
        {
        if($this->Department_model->get_by_id($id)){
            $this->Department_model->delete($id); 
                $this->session->set_flashdata('message', 'Department successfully deleted.'); 
                redirect(site_url('department')); 
        }
        else{
            $this->session->set_flashdata('error', 'This department does not exist');
             redirect(site_url('dashboard'));     
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
	   $this->form_validation->set_rules('department_name', 'Department Name', 'trim|required|is_unique[departments.dept_name]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('activities[]', 'Right & Privilege', 'trim|required');
    }
    
     public function edit_rules()
    {
        $this->form_validation->set_rules('activities[]', 'Right & Privilege', 'trim|required');
    }
}

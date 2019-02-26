<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model','Vendor_category_model', 'Activities_model', 'Audit_model', 'Login_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
        $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
        }
    
        public function index()
        {
        $vendor_list=$this->Vendor_category_model->get_all();
            $department_list=$this->Department_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'Service Categories',
            'department_status'=> $department_status,
            'department_list'=> $department_list,
            'vendor_list'=> $vendor_list,
        );
           $this->template->load('template', 'vendor/service_list', $data);
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->index();
            } else {
           $data = array(
                'category'=>$this->input->post('service_name'),
                'news' =>$this->input->post('service_name'),
                'service_type' =>$this->input->post('admin_cat',TRUE),
                'department_id' =>$this->input->post('admin',TRUE),
               'short' => strtoupper($this->input->post('short',TRUE)),
                );
                $task='Created a Requisition Category'; 
                $this->audit($task);
                $this->Vendor_category_model->insert($data); 
                $this->session->set_flashdata('message', 'Vendor service successfully created.'); 
                redirect(site_url('category'));
         }
        }
    
     public function edit($id)
        {
        $data_edit =$this->Vendor_category_model->get_by_id($id);
        $department_list=$this->Department_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
    
        if($this->Vendor_category_model->get_by_id($id)){
            $data = array(
            'title' => 'Edit Service',
            'department_status'=> $department_status,
            'department_list'=> $department_list,
             'edit'=>$data_edit,
        );  
             $this->template->load('template', 'vendor/service_edit', $data);
        }
        else{
            $this->session->set_flashdata('error', 'This service does not exist');
             redirect(site_url('category'));     
        }
      }
    
     public function edit_action()
        {
         
           $data = array(
                'category'=>$this->input->post('service_name'),
                'news' =>$this->input->post('service_name'),
                'service_type' =>$this->input->post('admin_cat',TRUE),
               'short' => strtoupper($this->input->post('short',TRUE)),
                );
                 $task='Edited a Requisition Category'; 
                $this->audit($task);
                $this->Vendor_category_model->update($this->input->post('edit_id'), $data); 
                $this->session->set_flashdata('message', 'Vendor service successfully edited.'); 
                redirect(site_url('category'));
         }
    
    
        public function delete($id)
        {
        if($this->Vendor_category_model->get_by_id($id)){
            $this->Vendor_category_model->delete($id); 
             $task='Deleted a vendor service'; 
            $this->audit($task);
                $this->session->set_flashdata('message', 'Vendor service successfully deleted.'); 
                redirect(site_url('category')); 
        }
        else{
            $this->session->set_flashdata('error', 'This service does not exist');
             redirect(site_url('category'));     
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
         
        $this->form_validation->set_rules('service_name', 'Requisition name', 'trim|required');
         $this->form_validation->set_rules('admin_cat', 'Category type', 'trim|required');
         $this->form_validation->set_rules('short', 'Short name', 'trim|required');
        $this->form_validation->set_rules('admin', 'Department', 'trim|required');
    }
  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model','Supplier_model', 'Product_model', 'Audit_model', 'Login_model', 'Vendor_category_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
             $this->user_id=$this->login['user_id'];
             $this->emails=$this->login['email'];
        
        }
    
        public function index()
        {
        $department_list=$this->Product_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'All Products',
            'department_status'=> $department_status,
            'product_list'=> $department_list,
        );
           $this->template->load('template', 'product/list', $data);
        }
    
     public function check()
        {
        if($this->input->post('cat')){
             $row= $this->Product_model->get_by_cat($this->input->post('cat'));
             $department_status= $this->Department_model->get_by_id($this->department_id);
             $activities= $this->Vendor_category_model->get_all();
            
             $data = array(
                'title' => 'All Products',
                'department_status'=> $department_status,
                'rows'=> $row,
                 'activities_data'=> $activities,
                 'cat'=>$this->input->post('cat'),
        );
           $this->template->load('template', 'product/check', $data);  
        }else{
           $department_status= $this->Department_model->get_by_id($this->department_id);
            $activities= $this->Vendor_category_model->get_all();
            $data = array(
            'title' => 'All Products',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
        );
           $this->template->load('template', 'product/check', $data);  
        }
      
        }
    
    public function create()
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $activities= $this->Vendor_category_model->get_all();
        $data = array(
            'title' => 'Create Product',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
        );
           $this->template->load('template', 'product/form', $data);
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
             
          $data = array(
                'name'=>$this->input->post('name'),
                //'activities_id' =>$array_specialty,
                 'cat_id'=>$this->input->post('cat'),
                );
              $task='Created a product'; 
                $this->audit($task);
                $this->Product_model->insert($data); 
                $this->session->set_flashdata('message', 'New product successfully created.'); 
                redirect(site_url('products'));
         }
        }
    
     public function update($id)
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $department_details= $this->Product_model->get_by_id($id);
        $activities= $this->Vendor_category_model->get_all();
        if($department_details){
          //  $activities= $this->Activities_model->get_all();    
        $data = array(
            'title' => 'Update Product',
            'department_status'=> $department_status,
            'activities_data'=> $activities,
            'department'=>$department_details,
        );
            
           $this->template->load('template', 'product/edit', $data);
        }else
        {
          $this->session->set_flashdata('error', 'This product does not exist');
             redirect(site_url('products'));  
        }
        
        }
    
    
     public function update_action()
        {
        $this->edit_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->update($this->input->post('pid'));
            } else {
             $row= $this->Product_model->get_by_id($this->input->post('pid'));
             $data = array(
                'name'=>$this->input->post('name'),
                  'cat_id'=>$this->input->post('cat'),
                );
                $task='Updated '.$row->name.' on requisition product'; 
                $this->audit($task);
                $this->Product_model->update($this->input->post('pid'), $data); 
                $this->session->set_flashdata('message', 'Product successfully updated.'); 
                redirect(site_url('products'));
         }
        }
    
        public function delete($id)
        {
        if($this->Product_model->get_by_id($id)){
             $row= $this->Product_model->get_by_id($id);
              $task='Deleted '.$row->name.' from product'; 
                $this->audit($task);
                $this->Product_model->delete($id); 
                $this->session->set_flashdata('message', 'Product successfully deleted.'); 
                redirect(site_url('products')); 
        }
        else{
            $this->session->set_flashdata('error', 'This department does not exist');
             redirect(site_url('products'));     
        }
      }
    
     
                public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.' (Staff)',
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
		      );
            
            $this->Audit_model->insert($data_audit);
    }
    
         public function _rules()
    {
         //Supplier Information Validation
	   $this->form_validation->set_rules('name', 'Product Name', 'trim|required|is_unique[products.name]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('cat', 'Requisition Category', 'trim|required');
        //$this->form_validation->set_rules('activities[]', 'Right & Privilege', 'trim|required');
    }
    
     public function edit_rules()
    {
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('cat', 'Requisition Category', 'trim|required');
    }
}

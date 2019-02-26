<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model', 'Audit_model', 'Login_model']);
        $this->login = $this->session->userdata('cms_logged_in');
        $this->department_id=$this->login['department_id'];
        $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
    }

    public function index()
    {
        $req_list = $this->Requisition_details_model->get_all_invoice();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'title' => 'Invoices',
        );
        $this->template->load('template', 'invoices/lists', $data);

    }

    
    public function vendor($id)
        {
             $req_list= $this->Requisition_details_model->get_by_id($id);
            if($req_list){
            $department_status= $this->Department_model->get_by_id($this->department_id);
            $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
            foreach ($arry_select as $arr) {
                 $cat_id[] = $this->Supplier_model->get_by_invoice($req_list->id);
            $data = array(
            'department_status'=> $department_status,
            'req_id' => $id,
            'rfp' => $req_list->rfp_no,
            'cat_list' => $cat_id,
            'title' => 'Invoice for Vendors',
        );
                 $this->template->load('template', 'invoices/ven_list', $data);
            }
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('invoices'));   
        }
          
         }
    

    public function rating(){
         $id= $this->Supplier_model->get_by_id($this->input->post('id'));
        $supplier= $this->Supplier_model->get_by_id($this->input->post('sup_id'));
         $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
          'supplier_id' =>$this->input->post('sup_id'),
            'id' => $this->input->post('id'),
             'req_id' => $this->input->post('rid'),
            'title' => 'Rate Vendor',
             'department_status'=> $department_status,
            );
    
       $this->template->load('template', 'invoices/rating', $data);
        
    }
    
    public function rating_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->rating($this->input->post('sup_id'));
            } else {
            $data = array(
                'vendor_id'=>$this->input->post('sup_id'),
                'req_id'=>$this->input->post('rid'),
                'supply_rating'=>$this->input->post('rate'),
                'comment'=>$this->input->post('comment'),
                );
             $data_invoice= array(
                 'rate_status'=>1,
             );
              $task='Rated a vendor on supply'; 
            $this->audit($task);
                $this->Supplier_model->insert_rating($data); 
                $this->Vendor_rfq_model->update_invoice($this->input->post('id'), $data_invoice); 
             
                $this->session->set_flashdata('message', 'Rating successfully done.'); 
                redirect(site_url('invoices/vendor/'.$this->input->post('rid')));
         }
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

    public function _rules()
    {
        $this->form_validation->set_rules('comment', 'Comment on vendor', 'trim|required');
         $this->form_validation->set_rules('rate', 'Vendor rating', 'trim|required');
    }

}

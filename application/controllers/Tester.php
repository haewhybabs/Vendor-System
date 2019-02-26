<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends MY_Controller {

    function __construct() {
         parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model','Supplier_model', 'Requisition_details_model',]);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
            $this->role=$this->login['role_id'];
             $this->user_id=$this->login['user_id'];
            $this->emails=$this->login['email'];

        }
    
            

       
    
        public function index()
        {
           $role=$this->role;
        $department_status= $this->Department_model->get_by_id($this->department_id);
        
          $rfqCount=$this->Requisition_details_model->count_rfq();
          $purchase_count=$this->Requisition_details_model->purchase_count();
        $req_list = $this->Requisition_details_model->get_all();
        $vendor_list = $this->Supplier_model->get_all_new();
        $vendor_reject = $this->Supplier_model->get_all_reject();
        $vendor_approve = $this->Supplier_model->get_all_approve();
        $q=0; $p=0;    
            foreach($req_list as $vendor){
                if($vendor->quote_status == 1){$q++;}
                if($vendor->po_sent == 1){$p++;}} 
        $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'new_vendor'=>count($vendor_list),
            'approve_vendor'=>count($vendor_approve),
            'reject_vendor'=>count($vendor_reject),
            'purchase_count'=>$purchase_count,
            'roles'=> $role,
            'p'=>$p,
            'q'=>$q,
            'rfq_count'=>$rfqCount,
            
        );

      $this->load->view('dashboard/test');

     }
}
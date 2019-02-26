<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
        if($role==15 || $role==23){
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
        }
         if($role==16){
           $req_list = $this->Requisition_details_model->get_all_concur($this->department_id); 
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->concur_status == 0){$p++;}
                if($vendor->concur_status == 1){$a++;}
                if($vendor->concur_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

         if($role==17){
            $req_list = $this->Requisition_details_model->get_department2($this->department_id, $this->user_id);
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->concur_status == 0){$p++;}
                if($vendor->concur_status == 1){$a++;}
                if($vendor->concur_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==19){
            $req_list = $this->Requisition_details_model->get_all_review($this->department_id, $this->user_id);
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->technical_status == 0){$p++;}
                if($vendor->technical_status == 1){$a++;}
                if($vendor->technical_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==21){
            $req_list = $this->Requisition_details_model->get_all_store($this->department_id, $this->user_id);
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->store_status == 0){$p++;}
                if($vendor->store_status == 1){$a++;}
                if($vendor->store_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==20){
            $req_list = $this->Requisition_details_model->get_all_review2($this->department_id, $this->user_id);
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->technical_head_status == 0){$p++;}
                if($vendor->technical_head_status == 1){$a++;}
                if($vendor->technical_head_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==25){
            $req_list = $this->Requisition_details_model->get_all_new($this->department_id, $this->user_id);
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->admin_status == 0){$p++;}
                if($vendor->admin_status == 1){$a++;}
                if($vendor->admin_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

         if($role==26){
            $req_list = $this->Requisition_details_model->get_all_dfs();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->dfs_status == 0){$p++;}
                if($vendor->dfs_status == 1){$a++;}
                if($vendor->dfs_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

         if($role==27){
            $req_list = $this->Requisition_details_model->get_all_sap();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->sap_status == 0){$p++;}
                if($vendor->sap_status == 1){$a++;}
                if($vendor->sap_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

         if($role==28){
            $req_list = $this->Requisition_details_model->get_all_forensic();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->forensic_status == 0){$p++;}
                if($vendor->forensic_status == 1){$a++;}
                if($vendor->forensic_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==18){
            $req_list = $this->Requisition_details_model->get_all_budget();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->budget_status == 0){$p++;}
                if($vendor->budget_status == 1){$a++;}
                if($vendor->budget_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

          if($role==24){
            $req_list = $this->Requisition_details_model->get_all_rp();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->rp_status == 0){$p++;}
                if($vendor->rp_status == 1){$a++;}
                if($vendor->rp_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

         if($role==29){
            $req_list = $this->Requisition_details_model->get_all();
           $a=0; $p=0; $d=0;    
            foreach($req_list as $vendor){
                if($vendor->rp_status == 0){$p++;}
                if($vendor->rp_status == 1){$a++;}
                if($vendor->rp_status == 2){$d++;}} 
           $data = array(
            'title' => 'Dashboard',
            'department_status'=> $department_status,
            'req_list'=>$req_list,
            'roles'=> $role,
            'a'=>$a,
            'p'=>$p,
            'd'=>$d,
        );
         }

           $this->template->load('template', 'dashboard/dash', $data);
        }

        public function dash(){

        //   // $department_status= $this->Department_model->get_by_id($this->department_id);
        //   $rfqCount=$this->Requisition_details_model->count_rfq();
        //   $purchase_count=$this->Requisition_details_model->purchase_count();
        // $req_list = $this->Requisition_details_model->get_all();
        // $vendor_list = $this->Supplier_model->get_all_new();
        // $vendor_reject = $this->Supplier_model->get_all_reject();
        // $vendor_approve = $this->Supplier_model->get_all_approve();
        // $q=0; $p=0;    
        //     foreach($req_list as $vendor){
        //         if($vendor->quote_status == 1){$q++;}
        //         if($vendor->po_sent == 1){$p++;}} 


        //   $data = array(
        //     'title' => 'Dashboard',
        //     //'department_status'=> $department_status,
        //     'new_vendor'=>count($vendor_list),
        //     'approve_vendor'=>count($vendor_approve),
        //     'reject_vendor'=>count($vendor_reject),
        //     'purchase_count'=>$purchase_count,
        //     'roles'=> $role,
        //     'p'=>$p,
        //     'q'=>$q,
        //     'rfq_count'=>$rfqCount,
            
        // );

        //    $this->template->load('template', 'dashboard/dash', $data);

        }
}

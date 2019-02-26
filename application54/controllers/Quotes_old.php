<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends MY_Controller {

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

    }

    public function lists()
    {
        $req_list = $this->Requisition_details_model->get_all_send_quote();
        $list = $this->Requisition_details_model->get_all_department_send_quote();
        $vendor_list = $this->Supplier_model->get_by_quote();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'vendor_list' => $vendor_list,
            'title' => 'Received Quotes',
        );
           $this->template->load('template', 'quotes/approve', $data);
    }
    
     public function assign_action()
    {
     $this->form_validation->set_rules('action', 'Action', 'trim|required');
        $this->form_validation->set_rules('echeck[]', 'One of the Checkbox', 'trim|required');

	    $this->form_validation->set_error_delimiters('<li>', '</li>');
        if ($this->form_validation->run() == FALSE) {
             $this->session->set_flashdata('error', 'At least a vendor check is required');
            $this->assign($this->input->post('req_id'));
        } else {
            $echeck = $this->input->post('echeck',TRUE);
            if($this->input->post('action',TRUE) == 'assign'){
                $array2 = $this->input->post('echeck',TRUE);
                //converting array into a string
                $mul = implode(",", $array2);
                 $data = array(
		                  'vendor_assign' => $mul,
                     'po' => 1,
                     );
                  $task='Assign vendors for Purchase Order'; 
            $this->audit($task);
                 $this->Requisition_details_model->update($this->input->post('req_id'), $data);
                 $this->session->set_flashdata('message', 'Vendors assigned for Purchase Order');
                redirect(site_url('quotes/assign/'.$this->input->post('req_id')));
            }
        }
        
    }
    
     public function assign($id)
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
        $this->template->load('template', 'quotes/quotes_list', $data);
    }
    
    public function set_price()
    {
        $req_list = $this->Requisition_details_model->get_all_set_price();
        $list = $this->Requisition_details_model->get_all_department_send_quote();
        $vendor_list = $this->Supplier_model->get_by_quote();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'vendor_list' => $vendor_list,
            'title' => 'Assigned for Vendors',
        );
           $this->template->load('template', 'quotes/approval', $data);
    }

    
    public function select($id){
    
         $req_list = $this->Requisition_details_model->get_by_id($id);
        $list = $this->Requisition_details_model->get_by_requisition($req_list->id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
         if($req_list){
             $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
            foreach ($arry_select as $arr) {
                 $cat_id[] = $this->Supplier_model->get_by_requisition($req_list->id, $arr);
            }
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'lists' => $list,
             'cat_list' => $cat_id,
            'title' => 'Set prices for vendor Supply',
        );
           $this->template->load('template', 'quotes/vendor_select', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('quotes/set_price'));   
        }
    }
    
    
    public function select_edit($id){
    
         $req_list = $this->Requisition_details_model->get_by_id($id);
        $list = $this->Requisition_details_model->get_by_requisition($req_list->id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
         if($req_list){
             $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
            foreach ($arry_select as $arr) {
                 $cat_id[] = $this->Supplier_model->get_by_requisition($req_list->id, $arr);
            }
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'lists' => $list,
             'cat_list' => $cat_id,
            'title' => 'Set prices for vendor Supply',
        );
           $this->template->load('template', 'quotes/edit_select', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('quotes/set_price'));   
        }
    }
    
    
    public function select_edit_action($id){
    
         $req_list = $this->Requisition_details_model->get_by_id($id);
        $list = $this->Requisition_details_model->get_by_requisition($req_list->id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
         if($req_list){
             $arry_select = explode(",", $req_list->vendor_assign);
             //  print_r($arry_select);
            foreach ($arry_select as $arr) {
                 $cat_id[] = $this->Supplier_model->get_by_requisition($req_list->id, $arr);
            }
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
            'lists' => $list,
             'cat_list' => $cat_id,
            'title' => 'Set prices for vendor Supply',
        );
           $this->template->load('template', 'quotes/vendor_select', $data);
            }else{
           $this->session->set_flashdata('error', 'This requisition does not exist');
             redirect(site_url('quotes/set_price'));   
        }
    }
       
    
    public function select_action(){
        $this->_rules2();
        $vendorid = $this->input->post('vendor');
        $rfqid = $this->input->post('req_id');
        $price = $this->input->post('price');
        
        $date=date("Y-m-d");
              $year=date("Y");
              $month=date("m");
              $req_list = $this->Requisition_details_model->get_id($this->input->post('req_id'));
              $list = $this->Requisition_details_model->get_by_req_id($this->input->post('req_id'));

             $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
             $passcode = substr(str_shuffle($chars),0,8);
           
                $uniqid= 'PO|'.$req_list->short.'|'.$month.'|'.$year.'|'.strtoupper($passcode);   
             
        $rq=$this->Requisition_details_model->get_by_id($this->input->post('req_id'));
        for($count = 0; $count < count($this->input->post('price',TRUE)); $count++){
               $data = array(
                'req_id'=>$this->input->post('req_id'),
                 'product_id' =>$this->input->post('prod_id',TRUE)[$count],
                 'price'=>$this->input->post('price',TRUE)[$count],
                 'vendor_id'=>$this->input->post('vendor',TRUE)[$count],
                ); 
                $this->Selectv_model->insert($data); 
        
    }
        $dates=date('Y-m-d');
        $data2 = array(
                'set_price_status'=>1,
                'po_number'=>$uniqid,
                'budget'=>1,
                'pr_status'=>2,
                'pr_treated'=>$dates,
                'b_receive'=>$dates,
                ); 
          $task='Set price on purchase order of requisition number:'.$rq->reference.' and purchase order:'.$rq->rfp_no; 
            $this->audit($task);
         $this->Requisition_details_model->update($this->input->post('req_id'), $data2); 
        $this->session->set_flashdata('message', 'Price set successfully. Awaiting Approvals for further processing');
        redirect(site_url('quotes/set_price/'));
    }
    
    public function mail(){
        $vendor_list = $this->Supplier_model->get_by_quote();
        print_r($vendor_list);
    }
    
   

    public function set_price_action(){
        $qid = $this->input->post('req_id');
        $price =  $this->input->post('price');
        $data = array('quote_price' => $price);
        $update =  $this->Selectv_model->update($qid,$data);
//echo $qid;
  $task='Set price on purchase order'; 
            $this->audit($task);
        $this->session->set_flashdata('message', 'Quote Price set successfully');
       redirect(site_url('quotes/set_price'));
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
        $this->form_validation->set_rules('summary', 'Request Note', 'trim|required');
        $this->form_validation->set_rules('date_submission', 'Date to submit RFQ', 'trim|required');
        $this->form_validation->set_rules('company[]', 'Company', 'trim|required');
    }
    
     public function _rules2()
    {
        $this->form_validation->set_rules('price', 'Request Note', 'trim|required');
        $this->form_validation->set_rules('vendor', 'Date to submit RFQ', 'trim|required');
    }

}
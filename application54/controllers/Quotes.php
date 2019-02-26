<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model','Audit_model', 'Login_model','Product_model', 'Approval_model']);
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
       
        $list = $this->Requisition_details_model->get_all_department_quote_approve();
       //$vendor_list = $this->Supplier_model->get_by_quote();
       // $department_status= $this->Department_model->get_by_id($this->department_id);
       $data = array(
           
            'req_list' => $req_list,
             'list' => $list,
            'title' => 'Received Quotes',
        );
          $this->template->load('template', 'quotes/approve', $data);
           
          //var_dump($data['req_list']);
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
                     );
                  $task='Assign vendors for Purchase Order'; 
            $this->audit($task);
                 $this->Requisition_details_model->update($this->input->post('req_id'), $data);
                 $this->session->set_flashdata('message', 'Vendors assigned for Purchase Order');
                redirect(site_url('quotes/assign/'.$this->input->post('req_id')));
            }
        }
        
    }
    
    public function create($id)
    {
        $row= $this->Requisition_details_model->get_by_id2($id);
         $quotes = $this->Quotes_model->get_by_vendor_id($id);
        $rows= $this->Requisition_details_model->get_by_id($id);
        $product_list = $this->Product_model->get_by_cat($rows->category_id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
             $data = array(
                'title' => 'Create requisition',
                'department_status'=> $department_status,
                'rows'=> $row,
                 'quotes' => $quotes,
                 'rid'=> $id,
                 'more'=>'Add more item to requisition list',
                 'requisition'=>'Create Approval List',
                 'product_list'=> $product_list,
        );
        $this->template->load('template', 'quotes/create', $data);
    }
    
     public function create_action()
    {
        
             for($count = 0; $count < count($this->input->post('quantity',TRUE)); $count++){
                 
                 if($this->Approval_model->check($this->input->post('rid',TRUE), $this->input->post('vendor'.$count, TRUE), $this->input->post('product'.$count, TRUE))){
                    $this->session->set_flashdata('error', 'Vendor already added to quotation approval sheet');
                       redirect(site_url('quotes/create/'.$this->input->post('rid'))); 
                     continue;
                 }else{
                     
                    if($echeck = $this->input->post('echeck',TRUE)[$count]){
                     $val=1;
                     }else{
                     $val=0;
                     } 
                     $ch=$this->Approval_model->check_approval($this->input->post('rid',TRUE), $this->input->post('product'.$count, TRUE));
                     if($val==1 && in_array($val, $ch)){
                     $this->session->set_flashdata('error', 'Vendor already recommended for '.$this->input->post('prod',TRUE)[$count]);
                        redirect(site_url('quotes/create/'.$this->input->post('rid'))); 
                 }else{
                         
               $data = array(
                 'requisition_id' => $this->input->post('nrid',TRUE)[$count],
                'product_id' => $this->input->post('product'.$count, TRUE),
                'price' => $this->input->post('price',TRUE)[$count],
                'vendor_id' => $this->input->post('vendor'.$count, TRUE),
                 'quantity'=>$this->input->post('quantity',TRUE)[$count],
                'approve'=>$val,
                ); 
                 $this->Approval_model->insert($data);
                //$this->Approval_model->update($this->input->post('rev_id',TRUE)[$count], $data);
                 
            }
            }
            }
                $date=date("Y-m-d");
                  $year=date("Y");
                  $month=date("m");
                  $req_list = $this->Requisition_details_model->get_id($this->input->post('rid'));
                  $list = $this->Requisition_details_model->get_by_req_id($this->input->post('rid'));

                 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                 $passcode = substr(str_shuffle($chars),0,8);

                    $uniqid= 'PO|'.$req_list->short.'|'.$month.'|'.$year.'|'.strtoupper($passcode);   

            $rq=$this->Requisition_details_model->get_by_id($this->input->post('rid'));

            $dates=date('Y-m-d');

            $req_list = $this->Approval_model->get_by_recommend($this->input->post('rid',TRUE));
                          $total=0;
                           // echo $prod->name;
                             foreach($req_list as $req){ 
                                $total += $req->amount;
                             }
                         
                 $req_data= array(
                    'budget_price'=>$total,
                    'set_price_status'=>1,
                'po_number'=>$uniqid,
                'budget'=>1,
                'pr_status'=>2,
                'pr_treated'=>$dates,
                'b_receive'=>$dates,
                 );  
                 $this->Requisition_details_model->update($this->input->post('rid',TRUE), $req_data);
                $task='Added vendor to Approval Sheet of Quotations'; 
                $this->audit($task);
                 $this->session->set_flashdata('message', 'Vendor added to approve sheet');
                redirect(site_url('quotes/create/'.$this->input->post('rid'))); 
                 }
                
                 
    
     public function assign($rfq,$com)
     {
        $quotes = $this->Quotes_model->get_by_vendor_id($rfq);
         $message= $this->Requisition_details_model->get_com_quote($rfq, $com);
           $getprice=$this->Quotes_model->getprice($rfq,$com);
        //$list = $this->Requisition_details_model->get_all_department_quote();
        $req_list = $this->Requisition_details_model->get_vendor($rfq);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'quotes' => $quotes,
            'message'=>$message,
            'getprice'=>$getprice,
            'department_status'=> $department_status,
            'title' => 'Quotes from vendors',
            'assign_vendor'=>$req_list->vendor_assign,
           
        );
        $this->template->load('template', 'quotes/quotes_list', $data);
    }
    
    public function set_price()
    {
        
        
        $req_list = $this->Requisition_details_model->get_all_sent_requisition();
         $get_quote_count=$this->Quotes_model->get_quote_counting();
          $get_quote_submitted=$this->Quotes_model->get_quote_submitted();
        $data = array(
            
            'req_list' => $req_list,
            'get_count'=>$get_quote_count,
            'count_submit'=> $get_quote_submitted,
            'title' => 'Processed Quotations',
        );
           $this->template->load('template', 'quotes/approval', $data);


    }
    public function view_count($id){
        $get_quote_count=$this->Quotes_model->get_quote_count($id);
        //$count=count($get_quote_count);
        $details=$this->Quotes_model->get_vendor_details($id);
        $data=array(
          'get_count'=>$get_quote_count,
          'detail'=>$details,
          'title'=>'Quote count'
            
        );


         $this->template->load('template', 'quotes/view_count', $data);
       

    }
    public function submit_view_count($id){

      //  $get_quote_count=$this->Quotes_model->get_quote_count($id);
     //   $count=count($get_quote_count);
        $details=$this->Quotes_model->get_all_sent_requisition($id);
        $data= array(
          
          'detail'=>$details,
          'title'=>'Quote count'
            
        );


         $this->template->load('template', 'quotes/submit_view_count', $data);
        // var_dump($details);


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
        $list = $this->Requisition_details_model->get_by_requisition2($req_list->id);
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
    
        $this->_rules2();
        $vendorid = $this->input->post('vendor');
        $rfqid = $this->input->post('req_id');
        $price = $this->input->post('price');
        
         $rq=$this->Requisition_details_model->get_by_id($this->input->post('req_id'));
        for($count = 0; $count < count($this->input->post('price',TRUE)); $count++){
               $data = array(
                 'price'=>$this->input->post('price',TRUE)[$count],
                ); 
                $this->Selectv_model->update_price($this->input->post('req_id')[$count], $this->input->post('prod_id')[$count], $data); 
           // $this->Selectv_model->insert($data); 
        }
        
            $task='Edit price on purchase order of requisition number:'.$rq->reference.' and purchase order:'.$rq->rfp_no; 
            $this->audit($task);
          $this->session->set_flashdata('message', 'Price set successfully. Awaiting Approvals for further processing');
        redirect(site_url('quotes/set_price/'));
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
    
    
    public function sheet($id)
    {
        $list = $this->Approval_model->get_by_requisition($id);
        $allproduct=$this->Approval_model->get_distinct_detail($id);
        $allquote=$this->Approval_model->get_allQuote($id);
        $data=array(
            'allproduct'=>$allproduct,
            'allquote'=>$allquote,
            'title'=>'Approval Sheet'
        );
     
        $this->template->load('template', 'quotes/sheet', $data);
      // var_dump($allquote);
        
       
    }

    public function sheet_approve(){
        $this->form_validation->set_rules('approval[]','Select Button','required');
        if ($this->form_validation->run()){

                $data['rfq_ID']=$this->input->post('rfq_ID');
                $data['approval_sheet_status']='pending';
                $sheet_summary=$this->Approval_model->save_aproval_summary($data);
                $get_approval_id=$this->Approval_model->get_approval_id($data['rfq_ID']);
                foreach ($get_approval_id as $key) {
                   $approval_id=$key->approval_sheet_ID;
                }
                $sheet_detail=$this->Approval_model->save_approval_detail($approval_id);
                $req_id=$this->input->post('req_ID');
               $update_status=$this->Approval_model->update_process_status($req_id);

                $this->session->set_flashdata('message', 'Approval Sheet is successfully Created');
                 redirect(site_url('quotes/set_price/'));

        }
        else{
           


        }
    
    }
    public function sheet_view($id){
    $allquote=$this->Approval_model->approved_vendors($id);
     //var_dump($allquote);
    $data=array(
          'sheet_summary'=>$allquote,
          'title'=>'Sheet Summary'
     );

      $this->template->load('template', 'quotes/sheet_summary_view', $data);
    }
    public function sheet_summary($id){
         $allquote=$this->Approval_model->approved_vendors($id);
     //var_dump($allquote);
         $data=array(
          'sheet_summary'=>$allquote,
          'title'=>'Sheet Summary'
     );

      $this->template->load('template', 'quotes/sheet_summary', $data);
    }


    
    public function Sheet_finalize($id){
        $update_sheet_status_accepted=$this->Approval_model->update_sheet($id);

        $get_req=$this->Approval_model->get_process_sheet_req($id);
        foreach ($get_req as $key) {
            $req=$key->req_ID;
        }
        $update_process_status=$this->Approval_model->update_process_sheet_status($req);
          $this->session->set_flashdata('message', 'Approval Sheet is successfully Approved');
                  redirect(site_url('rp/'));
    }
    public function Sheet_rejected($id){
        $update_sheet_status_rejected=$this->Approval_model->Update_sheet_rejected($id);
        $this->session->set_flashdata('error','Approval Sheet is rejected');
           redirect(site_url('rp/'));
    }

    
    public function prints($id)
        {
         $list = $this->Approval_model->get_by_requisition($id);
        $req_list = $this->Approval_model->get_by_recommend($id);
        $product_list = $this->Approval_model->get_products($id);
            $spec = $this->Department_requisition_model->get_spec($id);
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'department_status'=> $department_status,
            'req_list' => $req_list,
             'list' => $list,
            'product_list'=>$product_list,
            'title' => 'Processed Quotations',
              'req_id'=>$id,
             'spec'=>$spec,
        );
       
       // $this->template->load('template', 'quotes/sheet', $data);
        $html = $this->load->view('templates/print_download',$data,TRUE);
        $pdfFilePath = "Processed Quotation.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
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
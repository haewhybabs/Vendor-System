<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_model extends CI_Model
{

    public $table = 'approval_sheet';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

  
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
        // Suppliers send Quotes
    function get_by_requisition($id)
    {
        $this->db->select('approval_sheet.*, e_vendor.company_name, products.name');
        $this->db->join('e_vendor', 'approval_sheet.vendor_id = e_vendor.supplier_id');
       //$this->db->join('requisition_details', 'requisition_details.id = approval_sheet.requisition_id');
      //$this->db->join('dept_requisition', 'dept_requisition.req_id = approval_sheet.requisition_id');
       $this->db->join('products', 'products.product_id = approval_sheet.product_id');
         $this->db->where('approval_sheet.requisition_id', $id);
       // $this->db->order_by('products.name', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
        // Suppliers send Quotes
    function get_by_req_id($id, $id2)
    {
        $this->db->select('approval_sheet.*, e_vendor.company_name, requisition_details.reference, requisition_details.rfp_no, products.name, dept_requisition.specification');
        $this->db->join('e_vendor', 'approval_sheet.vendor_id = e_vendor.supplier_id');
        $this->db->join('requisition_details', 'requisition_details.id = approval_sheet.requisition_id');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = approval_sheet.requisition_id');
         $this->db->join('products', 'products.product_id = approval_sheet.product_id');
         $this->db->where('approval_sheet.requisition_id', $id2);
         $this->db->where('approval_sheet.vendor_id', $id);
        $this->db->order_by('products.name', $this->order);
        return $this->db->get($this->table)->result();
    }
    
     function get_by_recommend($id)
    {
         $this->db->select('e_vendor.company_name, SUM(approval_sheet.quantity * approval_sheet.price) AS amount');
         //$this->db->select('approval_sheet.*, e_vendor.company_name, requisition_details.reference, requisition_details.rfp_no, products.name');
         $this->db->join('e_vendor', 'approval_sheet.vendor_id = e_vendor.supplier_id');
         $this->db->join('requisition_details', 'requisition_details.id = approval_sheet.requisition_id');
         $this->db->join('products', 'products.product_id = approval_sheet.product_id');
         $this->db->where('approval_sheet.requisition_id', $id);
         $this->db->where('approval_sheet.approve', 1);
         $this->db->group_by("e_vendor.company_name");
         return $this->db->get($this->table)->result();
    }
    
     function get_products($id)
    {
        $this->db->select('products.*, approval_sheet.requisition_id');
         $this->db->join('products', 'products.product_id = approval_sheet.product_id');
         $this->db->where('approval_sheet.requisition_id', $id);
        $this->db->order_by('products.name', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    function get_by_unique($id){
         $this->db->select('e_vendor.company_name, approval_sheet.vendor_id');
         $this->db->join('e_vendor', 'approval_sheet.vendor_id = e_vendor.supplier_id');
         $this->db->where('approval_sheet.requisition_id', $id);
         $this->db->where('approval_sheet.approve', 1);
         $this->db->group_by("e_vendor.company_name");
         return $this->db->get($this->table)->result();
    }
    
    // get all
    function get_all_new()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verification', 1);
        return $this->db->get($this->table)->result();
    }
    
     // get all
    function get_all_approve()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verification', 2);
        return $this->db->get($this->table)->result();
    }
    
       // Suppliers send Quotes
    function get_by_vendor()
    {

        $this->db->select('*');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id');
      //   $this->db->join('requisition_details', 'requisition_details.id = vendor_rfq.requisition_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       // Suppliers send Quotes
    function get_by_vendor_id($id)
    {
        $this->db->select('e_vendor.*, vendor_rfq.*');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id');
        $this->db->join('requisition_details', 'requisition_details.id = vendor_rfq.requisition_id');
         $this->db->where('requisition_details.id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_reqdetails($id)
    {

        $this->db->order_by($this->id, $this->order);
        $this->db->where('req_id', $id);
        return $this->db->get('dept_requisition')->result();
    }
    
    
      // Interviews
    function get_all_interview()
    {
        $this->db->select('e_vendor.*, vendor_interview.date_interview, vendor_interview.time_interview');
        $this->db->join('vendor_interview', 'e_vendor.supplier_id = vendor_interview.supplier_id');
        $this->db->where('e_vendor.status_verification', 3);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function quote_price()
    {
        $this->db->select('selected_vendors.id, selected_vendors.req_id,company_name,primary_phone,product_service,quote_price,specification,vendor_rfq.budget_status');
        $this->db->join('e_vendor', 'selected_vendors.vendor_id = e_vendor.supplier_id ');
        $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id ');
        $this->db->join('vendor_rfq', 'vendor_rfq.id = selected_vendors.rfq_id ');
        //$this->db->where('e_vendor.status_verification', 3);
        $this->db->order_by("selected_vendors.".$this->id, $this->order);
        return $this->db->get('selected_vendors')->result();
    }

    function budget_control()
    {
        $this->db->select('*');
       // $this->db->join('selected_vendors', 'selected_vendors.rfq_id = vendor_rfq.id ');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id ');
      //  $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id ');
        //$this->db->where('e_vendor.status_verification', 3);
        $this->db->order_by("vendor_rfq.".$this->id, $this->order);
        return $this->db->get('vendor_rfq')->result();
    }
    function dfs()
    {
        $this->db->select('*');
        // $this->db->join('selected_vendors', 'selected_vendors.rfq_id = vendor_rfq.id ');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id ');
        //  $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id ');
        $this->db->where('vendor_rfq.budget_status', "1");
        $this->db->order_by("vendor_rfq.".$this->id, $this->order);
        return $this->db->get('vendor_rfq')->result();
    }
    function rp()
    {
        $this->db->select('*');
        // $this->db->join('selected_vendors', 'selected_vendors.rfq_id = vendor_rfq.id ');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id ');
        //  $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id ');
        $this->db->where(array('vendor_rfq.budget_status'=> '1', 'vendor_rfq.dfs_status' => '1'));
        $this->db->order_by("vendor_rfq.".$this->id, $this->order);
        return $this->db->get('vendor_rfq')->result();
    }
       // get all
    function get_all_reject()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verification', 4);
        return $this->db->get($this->table)->result();
    }
    
     // get data by id
    function check($rid, $ven, $prod)
    {
        $this->db->where('requisition_id', $rid);
        $this->db->where('vendor_id', $ven);
         $this->db->where('product_id', $prod);
        return $this->db->get($this->table)->row();
    }
    
    function check_approval($rid, $ven)
    {
        $this->db->select('approval_sheet.approve');
        $this->db->where('requisition_id', $rid);
        $this->db->where('vendor_id', $ven);
        return $this->db->get($this->table)->result();
    }
    
    ## GET BY CATEGORY###
     function get_by_category($id)
    {
        $this->db->like('specialty', $id);
        return $this->db->get($this->table)->result();
    }
    
  
    function insert($data)
    {
      $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
   

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    public function get_allQuote($id){
       /* $this->db->select('quote_detail.*,company_category.category,e_vendor.company_name');
        $this->db->join('rfq_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
        $this->db->join('rfq_vendors', 'rfq_vendors.rfq_ID = rfq_summary.rfq_ID');
        $this->db->join('e_vendor','rfq_vendors.vendor_ID=e_vendor.supplier_id');
        $this->db->join('quote_summary','rfq_summary.rfq_ID=quote_summary.rfq_ID');
        $this->db->join('quote_detail','quote_summary.rfq_ID=quote_detail.rfq_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('quote_detail.rfq_ID',$id);
        $this->db->where('rfq_vendors.quote_sent','1');
        $this->db->order_by('quote_summary.quote_ID','DESC');
         return $this->db->get('requisition_summary')->result();
         */
         $this->db->select('quote_detail.*,e_vendor.company_name,quote_summary.*,requisition_summary.req_ID');
         $this->db->join('quote_summary','quote_summary.quote_ID=quote_detail.quote_ID');
         $this->db->join('rfq_summary','rfq_summary.rfq_ID=quote_summary.rfq_ID');
         $this->db->join('requisition_summary','requisition_summary.req_ID=rfq_summary.req_ID');
         $this->db->join('e_vendor','quote_summary.vendor_ID=e_vendor.supplier_id');
         $this->db->where('quote_detail.rfq_ID',$id);
          $this->db->order_by('quote_detail.req_detail_ID','ASCE');
         return $this->db->get('quote_detail')->result();
    }
    public function get_distinct_detail($id){
        $this->db->select('req_detail_ID,product_name');
        $this->db->where('rfq_ID',$id);
        $this->db->distinct();
        return $this->db->get('quote_detail')->result();
    }
    public function save_aproval_summary($data){
        return $this->db->insert('approval_sheet_summary',$data);
    }
    public function get_approval_id($rfq){
      $this->db->select('approval_sheet_ID');
      $this->db->where('rfq_ID',$rfq);
      $this->db->order_by('approval_sheet_ID');
      $this->db->limit('1');
      return $this->db->get('approval_sheet_summary')->result();

    }
    public function save_approval_detail($id){
        $approval_id=$id;
        $req_detail=$this->input->post('req_detail_ID');
        $vend=$this->input->post('approval');
        $rfq=$this->input->post('rfq_ID');
        $count=count($_POST['approval']);
        $data=array();
        $i=0;
        foreach($vend as $app){
            $data[$i]=array(
                'req_detail_ID'=>$req_detail[$i],
                'vendor_ID'=>$app,
                'rfq_ID'=>$rfq,
                'approval_sheet_ID'=>$approval_id
            );
            $i++;
        }
        return $this->db->insert_batch('approval_sheet_detail',$data);


    }
    public function update_process_status($req_id){
      $this->db->set('process_status_ID','3');
      $this->db->where('req_ID',$req_id);
      $this->db->update('requisition_summary');
    }
    public function approved_vendors($id){
     
         $this->db->select('quote_detail.*,e_vendor.company_name,quote_summary.*,approval_sheet_summary.approval_sheet_status');
         $this->db->join('quote_detail','approval_sheet_detail.req_detail_ID=quote_detail.req_detail_ID');
         $this->db->join('approval_sheet_summary','approval_sheet_summary.approval_sheet_ID=approval_sheet_detail.approval_sheet_ID');
         $this->db->join('quote_summary','quote_detail.quote_ID=quote_summary.quote_ID');
         $this->db->join('e_vendor','quote_summary.vendor_ID=e_vendor.supplier_id');
         $this->db->where('approval_sheet_detail.vendor_ID=quote_summary.vendor_ID');
         $this->db->where('approval_sheet_detail.rfq_ID',$id);
         $this->db->order_by('approval_sheet_detail.req_detail_ID','ASCE');
         return $this->db->get('approval_sheet_detail')->result();
    }
    public function all_approved_vendors(){
     
        
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname');
        $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','2');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
     
    }

      public function get_all_sent_requisition(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }


    public function update_sheet($id){
        $this->db->set('approval_sheet_status','2');
        $this->db->where('rfq_ID',$id);
        $this->db->update('approval_sheet_summary');
    }
     public function Update_sheet_rejected($id){
        $this->db->set('approval_sheet_status','0');
        $this->db->where('rfq_ID',$id);
        $this->db->update('approval_sheet_summary');
    }
    public function get_process_sheet_req($id){
        $this->db->select('requisition_summary.req_ID');
       $this->db->join('rfq_summary','requisition_summary.req_ID=rfq_summary.req_ID');
        $this->db->where('rfq_summary.rfq_ID',$id);
        $this->db->order_by('rfq_summary.rfq_ID','DESC');
        $this->db->limit('1');
        return $this->db->get('requisition_summary')->result();
       

    }

    public function update_process_sheet_status($req){
        $this->db->set('process_status_ID','4');
        $this->db->where('req_ID',$req);
        $this->db->update('requisition_summary');
    }
}
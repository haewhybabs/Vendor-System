<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotes_model extends CI_Model
{

    public $table = 'vendor_rfq';
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
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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
     public function getprice($id,$com){
     $this->db->select('quote_detail.*,quote_summary.*,rfq_summary.*');
     $this->db->join('quote_detail', 'quote_detail.quote_ID = quote_summary.quote_ID');
     $this->db->join('rfq_summary','quote_summary.rfq_ID=rfq_summary.rfq_ID');
     $this->db->where('quote_summary.rfq_ID',$id);
     $this->db->where('quote_summary.vendor_ID',$com);
     $this->db->order_by('quote_detail_ID','DESC');
      $query=$this->db->get('quote_summary'); 
        if ($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

        
    }
    public function get_quote_counting(){
     $this->db->select('vendor_ID,rfq_ID');
   //  $this->db->where('rfq_ID',$id);
     $query=$this->db->get('rfq_vendors');
      return $query->result();
    }
    public function get_quote_submitted(){
      $this->db->select('vendor_ID,rfq_ID');
     $this->db->where('quote_sent','1');
     $query=$this->db->get('rfq_vendors');
      return $query->result();
    }

     public function get_quote_count($id){
     $this->db->select('vendor_ID');
     $this->db->where('rfq_ID',$id);
     $query=$this->db->get('rfq_vendors');
      return $query->result();
    }
    public function get_vendor_details($id){
     $this->db->select('rfq_vendors.*,rfq_summary.*,e_vendor.company_name');
     $this->db->join('rfq_vendors','rfq_summary.rfq_ID=rfq_vendors.rfq_ID');
     $this->db->join('e_vendor','rfq_vendors.vendor_ID=e_vendor.supplier_id');
     $this->db->where('rfq_vendors.rfq_ID',$id);
     $this->db->order_by('rfq_vendors.rfq_ID','DESC');
     $query=$this->db->get('rfq_summary');
     return $query->result();
    

    }

    /* public function get_all_sent_requisition($id){
       $this->db->select('rfq_vendors.*,quote_summary.*, rfq_summary.*,requisition_summary.*,departments.dept_name,company_category.category,e_vendor.company_name');
        $this->db->join('rfq_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
        $this->db->join('rfq_vendors', 'rfq_vendors.rfq_ID = rfq_summary.rfq_ID');
       $this->db->join('quote_summary', 'rfq_vendors.vendor_ID = quote_summary.vendor_ID');
        $this->db->join('e_vendor','quote_summary.vendor_ID=e_vendor.supplier_id');
        //$this->db->join('quote_summary','rfq_summary.rfq_ID=quote_summary.rfq_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('rfq_vendors.quote_sent','1');
        $this->db->where('quote_summary.rfq_ID',$id);
        $this->db->order_by('quote_summary.quote_ID','DESC');
        return $this->db->get('requisition_summary')->result();
       }
       */
       public function get_all_sent_requisition($id){
      //   $this->db->select('rfq_vendors.*,rfq_summary.*,quote_summary.*,requisition_summary.*,departments.dept_name,company_category.category,e_vendor.company_name');
      //   $this->db->join('rfq_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
      //   $this->db->join('rfq_vendors', 'rfq_vendors.rfq_ID = rfq_summary.rfq_ID');
      // // $this->db->join('quote_summary', 'rfq_summary.vendor_ID = quote_summary.vendor_ID');
      //   $this->db->join('e_vendor','rfq_vendors.vendor_ID=e_vendor.supplier_id');
      //   $this->db->join('quote_summary','rfq_summary.rfq_ID=quote_summary.rfq_ID');
      //   $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
      //   $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
      //   $this->db->where('rfq_vendors.quote_sent','1');
      //    $this->db->where('quote_summary.rfq_ID',$id);
      //   $this->db->order_by('rfq_vendors.vendor_ID','DESC');
      //   return $this->db->get('requisition_summary')->result();



        $this->db->select('rfq_vendors.*,rfq_summary.*,e_vendor.company_name,company_category.category');
     $this->db->join('rfq_vendors','rfq_summary.rfq_ID=rfq_vendors.rfq_ID');
     $this->db->join('requisition_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
      $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
     $this->db->join('e_vendor','rfq_vendors.vendor_ID=e_vendor.supplier_id');
    // $this->db->where('rfq_vendors.rfq_ID',$id);
     $this->db->where('rfq_vendors.quote_sent','1');
     $this->db->where('rfq_vendors.rfq_ID',$id);
     $this->db->order_by('rfq_vendors.rfq_ID','DESC');
     $query=$this->db->get('rfq_summary');
     return $query->result();
    }
}
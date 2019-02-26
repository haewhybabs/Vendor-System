<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Selectv_model extends CI_Model
{

    public $table = 'selected_vendors';
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
       // $this->db->where('requisition_details.rfx_status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       // Suppliers send Quotes
    function get_by_req_id($id, $req_id)
    {
        $this->db->select('selected_vendors.*, dept_requisition.product_service, dept_requisition.quantity, dept_requisition.specification, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.product_id');
        $this->db->join('requisition_details', 'requisition_details.id = dept_requisition.req_id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->where('selected_vendors.vendor_id', $id);
        $this->db->where('selected_vendors.req_id', $req_id);
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

    function get_all_join()
    {
        $this->db->select('*');
        $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id');
       // $this->db->where('e_vendor.status_verification', 3);
       // $this->db->order_by(""$this->id, $this->order);
        return $this->db->get($this->table)->result();
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
    
     function get_sum($id){
          $this->db->select('*');
        $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id');
       // $this->db->where('e_vendor.status_verification', 3);
       // $this->db->order_by(""$this->id, $this->order);
         $this->db->where('selected_vendors.req_id', $id);
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
    
     // update data
    function update_price($id, $prod, $data)
    {
        $this->db->where('req_id', $id);
         $this->db->where('product_id', $prod);
        $this->db->update($this->table, $data);
    }
   

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_rfq_model extends CI_Model
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
    
     // get data by id
    function get_by_id($id)
    {
       $this->db->select('vendor_rfq.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        return $this->db->get($this->table)->result();
    }
  
     // get vendors
    function get_vendor($id)
    {
       $this->db->select('e_supplier.*, vendor_rfq.post_date, vendor_rfq.end_date');
        $this->db->join('e_supplier', 'vendor_rfq.vendor_id = e_supplier.supplier_id');
        $this->db->where('vendor_rfq.requisition_id', $id);
        return $this->db->get($this->table)->result();
    }
    
      // get vendors
    function get_vendor2($id)
    {
       $this->db->select('vendor_rfq.vendor_id');
        $this->db->where('vendor_rfq.requisition_id', $id);
        return $this->db->get($this->table)->result();
    }
    
    
      // get vendors
    function get_ven_req($r, $v)
    {
       $this->db->select('vendor_rfq.vendor_id');
        $this->db->where('vendor_rfq.requisition_id', $r);
        $this->db->where('vendor_rfq.vendor_id', $v);
        return $this->db->get($this->table)->result();
    }
    
       // get vendors
    function get_rfq($id)
    {
       $this->db->select('DISTINCT(vendor_rfq.rfp_number)');
        $this->db->where('vendor_rfq.requisition_id', $id);
        return $this->db->get($this->table)->row();
    }
    

    function get_invoice()
    {
        $this->db->select('*');
         $this->db->join('rfq_invoice', 'rfq_invoice.vrfq_id = vendor_rfq.id ');
        $this->db->join('e_vendor', 'vendor_rfq.vendor_id = e_vendor.supplier_id ');
        //  $this->db->join('dept_requisition', 'dept_requisition.id = selected_vendors.req_id ');
        $this->db->where('vendor_rfq.sent_invoice', '1');
        $this->db->order_by("vendor_rfq.".$this->id, $this->order);
        return $this->db->get('vendor_rfq')->result();
    }

    function insert($data)
    {
      $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    
    function insert_invoice($data)
    {
      $this->db->insert('rfq_invoice', $data);
        return $this->db->insert_id();
    }


    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    
     // update data
    function update_invoice($id, $data)
    {
        $this->db->where('rfq_invoice.id', $id);
        $this->db->update('rfq_invoice', $data);
    }
   

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function delete_supplier($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
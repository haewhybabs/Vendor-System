<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public $table = 'e_vendor';
    public $id = 'supplier_id';
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
    
      // get all
    function get_pending()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verification', 0);
        return $this->db->get($this->table)->result();
    }
    
      // get all
    function get_invoice($id)
    {
        $this->db->where('rfq_invoice.id', $id);
        return $this->db->get('rfq_invoice')->row();
    }
    
       // Suppliers send Quotes
    function get_by_quote()
    {
        $this->db->select('e_vendor.*, vendor_rfq.post_date, vendor_rfq.end_date, vendor_rfq.requisition_id');
        $this->db->join('vendor_rfq', 'e_vendor.supplier_id = vendor_rfq.vendor_id');
         $this->db->join('requisition_details', 'requisition_details.id = vendor_rfq.requisition_id');
        $this->db->where('requisition_details.rfx_status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       // Suppliers send Quotes
    function get_by_price()
    {
        $this->db->select('e_vendor.*, selected_vendors.vendor_id, selected_vendors.product_id');
        $this->db->join('vendor_selected', 'e_vendor.supplier_id =  selected_vendors.vendor_id');
         $this->db->join('requisition_details', 'requisition_details.id = vendor_selected.req_id');
        $this->db->where('requisition_details.assign_status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       // Suppliers send Quotes
    function get_by_requisition($id, $ven)
    {
        $this->db->select('e_vendor.*, vendor_rfq.post_date, vendor_rfq.end_date, vendor_rfq.requisition_id');
        $this->db->join('vendor_rfq', 'e_vendor.supplier_id = vendor_rfq.vendor_id');
         $this->db->join('requisition_details', 'requisition_details.id = vendor_rfq.requisition_id');
        $this->db->where('requisition_details.id', $id);
        $this->db->where('vendor_rfq.vendor_id', $ven);
         $this->db->where('vendor_rfq.sent_quotation', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
        // Suppliers send Quotes
    function get_by_invoice($id)
    {
        $this->db->select('e_vendor.*, rfq_invoice.invoice, rfq_invoice.accept_status, rfq_invoice.rate_status, rfq_invoice.submission_date, rfq_invoice.id');
        $this->db->join('rfq_invoice', 'e_vendor.supplier_id = rfq_invoice.vend_id');
         $this->db->join('requisition_details', 'requisition_details.id = rfq_invoice.vrfq_id');
        $this->db->where('requisition_details.id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
        // Suppliers send Quotes
    function get_by_rating($id)
    {
        $this->db->select('e_vendor.*, vendor_rating.supply_rating, vendor_rating.comment, vendor_rating.req_id, vendor_rating.date_time, rfq_invoice.id as invoice_id');
        $this->db->join('vendor_rating', 'e_vendor.supplier_id = vendor_rating.vendor_id');
         $this->db->join('rfq_invoice', 'e_vendor.supplier_id = rfq_invoice.vend_id');
        $this->db->where('e_vendor.supplier_id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
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
        $this->db->where('status_verification', 2);
        $this->db->like('specialty', $id);
        return $this->db->get($this->table)->result();
    }
    
  
    function insert($data)
    {
      $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
     function insert_rating($data)
    {
      $this->db->insert('vendor_rating', $data);
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
}
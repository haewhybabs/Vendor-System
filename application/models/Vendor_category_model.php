<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_category_model extends CI_Model
{

    public $table = 'company_category';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

  
    // get all
    function get_alls()
    {
         $this->db->select('company_category.*');
         return $this->db->get($this->table)->result();
    }
    
    // get all
    function get_all()
    {
         $this->db->select('company_category.*, departments.dept_name');
        $this->db->join('departments', 'departments.id = company_category.department_id');
        return $this->db->get($this->table)->result();
    }
    public function get_approve_cat(){
          $this->db->select('e_vendor.*, company_category.category, vendor_category.*');
        //$this->db->join('requisition_details', 'requisition_details.id = dept_requisition.req_id');
       // $this->db->join('departments', 'departments.id = requisition_details.department_id');  
        $this->db->join('company_category', 'company_category.id = vendor_category.cat_id');
        $this->db->join('e_vendor','vendor_category.supplier_id=e_vendor.supplier_id');
       // $this->db->where('vendor_category.supplier_id', $id);
        return $this->db->get('vendor_category')->result();
    }
  
    
     function get_dept($id)
    {
         $this->db->select('departments.general_email, departments.techead_email');
        $this->db->join('departments', 'departments.id = company_category.department_id');
         $this->db->where('company_category.id', $id);
        return $this->db->get($this->table)->row();
    }
    
     // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
     // get data by id
    function get_by_req($id)
    {
         $this->db->select('company_category.*');
         $this->db->join('dept_requisition', 'dept_requisition.cat_id =company_category.id');
        $this->db->join('requisition.details', 'dept_requisition.req_id = requisition_details.id');
        $this->db->where('requisition.details.id', $id);
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
    public function get_each_cat($id){
        $this->db->select('e_vendor.*, company_category.category, vendor_category.*');
        //$this->db->join('requisition_details', 'requisition_details.id = dept_requisition.req_id');
       // $this->db->join('departments', 'departments.id = requisition_details.department_id');  
        $this->db->join('company_category', 'company_category.id = vendor_category.cat_id');
        $this->db->join('e_vendor','vendor_category.supplier_id=e_vendor.supplier_id');
        $this->db->where('vendor_category.supplier_id', $id);
        return $this->db->get('vendor_category')->result();
    }
}
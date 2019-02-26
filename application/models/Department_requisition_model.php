<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_requisition_model extends CI_Model
{

    public $table = 'dept_requisition';
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
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
     // get data by id
    function get_by_id($id)
    {
       $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('requisition_details', 'requisition_details.id = dept_requisition.req_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');  
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('dept_requisition.req_id', $id);
        return $this->db->get($this->table)->row();
    }
    
      // get data by id
    function get_spec($id)
    {
       $this->db->select('dept_requisition.*,');
        $this->db->where('dept_requisition.req_id', $id);
        return $this->db->get($this->table)->result();
    }
    
       // get data by id
    function get_by_department($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, admin_login.firstname, admin_login.lastname');
        $this->db->join('admin_login', 'admin_login.id = dept_requisition.user_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.department_id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
        // get by concur
    function get_all_concur($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = dept_requisition.user_id');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.department_id', $id);
        $this->db->where('dept_requisition.req_status', 0);
         $this->db->where('dept_requisition.status', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
     function get_all_store($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = dept_requisition.user_id');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.department_id', $id);
        $this->db->where('dept_requisition.req_status', 1);
         $this->db->where('dept_requisition.status', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
         // get by review
    function get_all_review($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.department_id', $id);
         $this->db->where('dept_requisition.req_status', 2);
         $this->db->where('dept_requisition.status', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
       // get by new
    function get_all_new()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
       $this->db->where('dept_requisition.req_status', 3);
        $this->db->where('dept_requisition.status', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
        // get by new
    function get_all_approve()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.req_status', 3);
        $this->db->where('dept_requisition.status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
   
     // get by rfx
    function get_all_quote_rfx()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.status', 1);
        $this->db->where('dept_requisition.req_status', 3);
        $this->db->where('company_category.service_type !=', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
   
     // get by rfx
    function get_all_proposal_rfx()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
         $this->db->where('dept_requisition.status', 1);
        $this->db->where('dept_requisition.req_status', 3);
        $this->db->where('company_category.service_type', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
        // get by new
    function get_all_reject()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = dept_requisition.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.category_id');
        $this->db->where('dept_requisition.req_status', 3);
        $this->db->where('dept_requisition.status', 2);
        $this->db->order_by($this->id, $this->order);
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
    function update_req($id, $data)
    {
        $this->db->where('dept_requisition.req_id', $id);
        $this->db->update($this->table, $data);
    }
    
      // update data
    function update_all($id, $id2, $data)
    {
        $this->db->where($this->id, $id);
         $this->db->where('req_id', $id2);
        $this->db->update($this->table, $data);
    }
   

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    // delete data
    function delete_multiple($id, $id2)
    {
        $this->db->where($this->id, $id);
         $this->db->where('req_id', $id2);
        $this->db->delete($this->table);
    }
    function delete_supplier($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
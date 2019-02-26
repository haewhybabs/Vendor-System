<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_model extends CI_Model
{

    public $table = 'departments';
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
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
       // get email of departments by id
    function get_role()
    {
       $this->db->select('*');
        return $this->db->get('roles')->result();
    }
    
    
     // get email of departments by id
    function get_email($id)
    {
       $this->db->select('admin_login.email, departments.general_email, departments.dept_name, departments.techead_email');
        $this->db->join('admin_login', 'admin_login.department_id = departments.id');
        $this->db->where('departments.id', $id);
         $this->db->where('admin_login.admin_id', 1);
        return $this->db->get($this->table)->row();
    }
    
      // get email of departments by id
    function get_by_cat($id)
    {
       $this->db->select('departments.general_email, departments.dept_name, departments.techead_email');
        $this->db->join('company_category', 'company_category.department_id = departments.id');
        $this->db->where('company_category.id', $id);
        return $this->db->get($this->table)->row();
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
    function delete_supplier($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
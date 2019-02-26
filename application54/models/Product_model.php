<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public $table = 'products';
    public $id = 'product_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get email of departments by id
    function get_all()
    {
       $this->db->select('products.*, company_category.category');
        $this->db->join('company_category', 'company_category.id = products.cat_id');
        return $this->db->get($this->table)->result();
    }
  
     // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
       // get email of departments by id
      // get data by id
    function get_by_cat($id)
    {
        $this->db->where('cat_id', $id);
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
    function delete_supplier($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
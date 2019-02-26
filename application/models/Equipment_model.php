<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipment_model extends CI_Model
{

    public $table = 'supplier_equipments';
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
    
    
     // get data by id
    function get_by_vendor($id)
    {
        $this->db->where('supplier_id', $id);
        return $this->db->get($this->table)->result();
    }
    
     function get_by_vendor2($id)
    {
        $this->db->select('supplier_equipments.supplier_id');
        $this->db->where('supplier_equipments.supplier_id', $id);
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
}
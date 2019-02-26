<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_document_model extends CI_Model
{

    public $table = 'supplier_documents';
    public $id = 'supplier_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    
     function get_by_vendor($id)
    {
        $this->db->select('supplier_documents.*, support_documents.name');
        $this->db->join('support_documents', 'supplier_documents.document_name = support_documents.id');
        $this->db->where('supplier_documents.supplier_id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
        
    }
    // get all
  
    // get all
    function get_all()
    {
         $this->db->select('supplier_documents.*, support_documents.name');
        $this->db->join('support_documents', 'supplier_documents.document_name = support_documents.id');
      
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
        
    }

    
     // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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
        $this->db->where('supplier_id', $id);
        $this->db->delete($this->table);
    }
}
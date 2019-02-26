<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Requisition_model extends CI_Model
{

   public function createRequisition($id){
   	$product=$_POST['product'];
    $specification=$_POST['specification'];
    $quantity=$_POST['quantity'];
    $count= count($_POST['product']);
       $data =array();
        for($i=0; $i<$count; $i++) {
           $data[$i] = array(
           'product_ID' => $product[$i], 
           'product_specification' => $specification[$i],
           'quantity' => $quantity[$i],
           'req_ID' => $id
           );
         
        
        }
       
     return $this->db->insert_batch('requisition_new_details', $data);

   }

   public function NewRequisition($data){
   	   return $this->db->insert('requisition_summary',$data);
   }
   public function Get_previous_details($id){
     $this->db->select('*');
     $this->db->from('requisition_new_details');
     $this->db->where('req_detail_ID',$id);
     $query=$this->db->get();
     if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }



   }
   public function getProducts($id){
   	  $this->db->select('*');
   	  $this->db->from('products');
   	  $this->db->where('cat_id', $id);
   	  $query=$this->db->get();
   	  if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
      	return false;
      }

   }
   public function ReqId(){
   	$this->db->select('req_ID');
   	$this->db->from('requisition_summary');
   	$this->db->order_by('req_ID','DESC');
   	$this->db->limit('1');
   	$query=$this->db->get();
   	return $query->result();

   }
  public function update_success_Requisition($id){
    $this->db->set('successful_requisition','1');
    $this->db->where('req_ID',$id);
    $this->db->update('requisition_summary');
  }

}
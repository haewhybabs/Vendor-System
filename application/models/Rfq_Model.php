<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rfq_Model extends CI_Model
{

   

    function __construct()
    {
        parent::__construct();
    }
    public function save_rfq($data){
    	return $this->db->insert('rfq_summary',$data);
    }
    public function update_process($id){
    	$this->db->set('process_status_ID','2');
    	$this->db->where('req_ID',$id);
    	$this->db->update('requisition_summary');
    }
    public function get_rfq_details($id){
    	$this->db->select('rfq_ID');
    	$this->db->from('rfq_summary');
    	$this->db->where('user_ID',$id);
    	$this->db->order_by('rfq_ID','DESC');
    	$this->db->limit('1');
    	$query=$this->db->get();
   	    if ($query->num_rows()>0){
 
           return $query->result();

         }
        else{
      	  return false;
        }
    }
        public function getVendors($id){
        	// $this->db->like('specialty',$id);
        	// $this->db->from('e_vendor');
         //  $this->db->where('status_verification','2');
        	// $query=$this->db->get();
         //   if ($query->num_rows()>0){
 
         //       return $query->result();

         //    }
         //    else{
      	  //      return false;
         //    }  
          $this->db->select('e_vendor.*, company_category.category, vendor_category.*');
        //$this->db->join('requisition_details', 'requisition_details.id = dept_requisition.req_id');
       // $this->db->join('departments', 'departments.id = requisition_details.department_id');  
        $this->db->join('company_category', 'company_category.id = vendor_category.cat_id');
        $this->db->join('e_vendor','vendor_category.supplier_id=e_vendor.supplier_id');
        $this->db->where('vendor_category.cat_id', $id);
         $this->db->where('e_vendor.status_verification','2');
        return $this->db->get('vendor_category')->result();
        }
        public function getVendorsDetails(){
          $this->db->select('*');
          $this->db->from('e_vendor');
          $this->db->where('status_verification','2');
          $this->db->distinct();
          return $this->db->get()->result();
        }
        public function get_requisition_details_ID($id){
          $this->db->select('req_detail_ID');
          $this->db->from('requisition_new_details');
          $this->db->where('req_ID',$id);
          $this->db->where('store_status','0');
          return $this->db->get()->result();

        }

         public function countVendors($id){
          $this->db->like('specialty',$id);
          $this->db->from('e_vendor');
          return $this->db->get()->num_rows();
          
   
        }

        public function getrfq($id){
            $this->db->select('rfq_ID');
            $this->db->from('rfq_summary');
            $this->db->where('req_ID',$id);
            $this->db->order_by('rfq_ID','DESC');
            $this->db->limit('1');
          
            $query=$this->db->get();
           if ($query->num_rows()>0){
 
               return $query->result();

            }
            else{
               return false;
            }  
        }
   
        public function storeRfq($data){
           
            return $this->db->insert('rfq_summary',$data);

        }
        public function storeRfq_detail($data){
           
            return $this->db->insert('rfq_detail', $data);

            //var_dump($count);
         /* $rfq=$rfq_ID;
          $req_detail=$_POST['req_detail_ID'];
          $data=array();
          $i=0;
          foreach ($req_detail as $key) {
             $data[$i]=array(
              'req_detail_ID'=>$key,
              'rfq_ID'=>$rfq_ID

            );
             $i++;
          }
          return $this->db->insert_batch('rfq_detail', $data);*/
        }

        public function store_to_rfqVendor($rfq_ID,$category){
            
            $rfq=$rfq_ID;
            $vendor_ID=$this->input->post('vendor_ID');
            $count=count($_POST['vendor_ID']);
            $data=array();
              $i=0;
              foreach($vendor_ID as $v){
                $data[$i]=array(
                  'vendor_ID'=>$v,
                  'rfq_ID'=>$rfq
                );
                 $i++;
              }
            return $this->db->insert_batch('rfq_vendors',$data);
              //return $q->supplier_id;
        }

        public function update_process_stage($id){
            $this->db->set('process_status_ID','2');
            $this->db->where('req_ID',$id);
            $this->db->update('requisition_summary');


        }

        

    


}
?>
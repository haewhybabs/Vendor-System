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
        	$this->db->like('specialty',$id);
        	$this->db->from('e_vendor');
        	$query=$this->db->get();
           if ($query->num_rows()>0){
 
               return $query->result();

            }
            else{
      	       return false;
            }  
   
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
        public function storeRfq_detail($rfq_ID){
            $rfq=$rfq_ID;
            $req_detail_ID=$_POST['req_detail_ID'];
            $count=count($_POST['req_detail_ID']);
             $data =array();
              for($i=0; $i<$count; $i++) {
                   $data[$i] = array(
                   'req_detail_ID' => $req_detail_ID[$i], 
                   'rfq_ID' => $rfq
                   );
         
               }
            return $this->db->insert_batch('rfq_detail', $data);

            var_dump($count);
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
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review_Model extends CI_Model
{

  public function GetSummaryDetails($id){

  	 $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
  	 $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
  	$this->db->join('departments', 'departments.id = requisition_summary.department_ID');
  	$this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.department_ID', $id);
     $this->db->where('requisition_summary.req_status_ID >', '1');
     $this->db->or_where('requisition_summary.req_status_ID','0');
     $this->db->where('requisition_summary.successful_requisition', '1');
  	$this->db->order_by('requisition_summary.req_ID','DESC');
  	 $query=$this->db->get('requisition_summary');
   	  if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
      	return false;
      }
  }
   function Get_all_requisition($id){

     $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.department_ID', $id);
     $this->db->where('requisition_summary.successful_requisition', '1');
    $this->db->order_by('requisition_summary.entry_date','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }
  }
  function Get_details_requisition($id){

    //  $this->db->select('requisition_summary.*,requisition_new_details.*,products.name ');
    //  $this->db->join('products', 'products.product_id = requisition_new_details.product_ID');
    //  $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    //  $this->db->where('requisition_summary.department_ID', $id);
    //  $this->db->where('requisition_summary.successful_requisition', '1');
    // $this->db->order_by('requisition_summary.entry_date','DESC');
    //  $query=$this->db->get('requisition_summary');
    //   if ($query->num_rows()>0){
 
    //      return $query->result();

    //      }
    //   else{
    //     return false;
    //   }



      $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('requisition_summary.department_ID', $id);
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }


 
  }

  public function Get_all_details_requisition(){
          $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
   // $this->db->where('requisition_summary.department_ID', $id);
    $this->db->where('requisition_summary.successful_requisition', '1');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }



  }
   public function Get_requisition(){

     $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
     $this->db->where('requisition_summary.successful_requisition', '1');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }
  }


   public function GetSummaryPending($id){

  	 $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
  	 $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
  	$this->db->join('departments', 'departments.id = requisition_summary.department_ID');
  	$this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.successful_requisition', '1');
    $this->db->where('requisition_summary.department_ID', $id);
    $this->db->where('requisition_summary.req_status_ID', '1');
  	$this->db->order_by('requisition_summary.req_ID','DESC');
  	 $query=$this->db->get('requisition_summary');
   	  if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
      	return false;
      }
  }



     public function GetSingleDetails($id){
  	 $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
  	 $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
  	$this->db->join('departments', 'departments.id = requisition_summary.department_ID');
  	$this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
  	$this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('requisition_summary.req_ID', $id);
  	$this->db->order_by('requisition_summary.req_ID','DESC');
  	 $query=$this->db->get('requisition_summary');
   	  if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
      	return false;
      }


  }
  public function GetSingleDetailsp($id){
     $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('requisition_summary.req_ID', $id);
    $this->db->where('requisition_new_details.store_status','0');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }


  }

   public function GetSingle_Rfq_Details($id){
     $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('requisition_summary.req_ID', $id);
    $this->db->where('requisition_new_details.store_status','0');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }


  }
   public function GetStoreDetails($id){
     $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,admin_login.email,admin_login.firstname, admin_login.lastname');
      $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('requisition_summary.req_ID', $id);
   // $this->db->where('requisition_new_details.store_has_checked','0');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }


  }
  public function getRFQrows($id){
    $this->db->where('req_ID',$id);
     $query=$this->db->get('requisition_new_details');
     return $query->num_rows();
  }
  public function Hod_concor($id){
  	$this->db->set('req_status_ID','2');
  	$this->db->where('req_ID', $id);
  	$this->db->update('requisition_summary');
  }
   public function Hod_agree($data){
     return $this->db->insert('requisition_stage_activities',$data);
   }
  public function Hod_edit($data,$id){
     $edit = array(
        'product_specification' => $data['product_specification'],
        'quantity' => $data['quantity']
       
     );
     $this->db->where('req_detail_ID',$id);
     $this->db->update('requisition_new_details',$edit);

  }
    public function Hod_reject($data){
     return $this->db->insert('requisition_stage_activities',$data);
   }
   public function HodReject($id){
    $this->db->set('req_status_ID','0');
    $this->db->where('req_ID',$id);
    $this->db->update('requisition_summary');
   }
   public function T_review(){
     $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
     $this->db->where('requisition_summary.req_status_ID >', '2');
     $this->db->where('company_category.service_type','1');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }
   }

   public function T_reviewPending(){
     $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
     $this->db->where('requisition_summary.req_status_ID ', '2');
    $this->db->where('company_category.service_type','1');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }


   }

  public function Review_concur($id){
    $this->db->set('req_status_ID','3');
    $this->db->where('req_ID', $id);
    $this->db->update('requisition_summary');
  }
   public function Review_agree($data){
     return $this->db->insert('requisition_stage_activities',$data);
   }
   public function churchAd(){
      $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.req_status_ID >', '4');
    $this->db->or_where('requisition_summary.req_status_ID','-1');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }
    

   }
   public function churchAd_pending(){

    $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
    $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.req_status_ID', '4');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

      }

      else{
        return false;
      }


    


   }
   public function churchAdmin_agree($data){
      return $this->db->insert('requisition_stage_activities',$data);

   }

   public function churchAdmin_concur($id){

    $this->db->set('req_status_ID','5');
    $this->db->where('req_ID', $id);
    $this->db->update('requisition_summary');
   }
   public function ChurchReject($id){
    $this->db->set('req_status_ID','-1');
    $this->db->where('req_ID',$id);
    $this->db->update('requisition_summary');
   }
   public function churchAdmin_reject($data){
     return $this->db->insert('requisition_stage_activities',$data);


   }

    public function store_check(){



    $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
    $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.req_status_ID >', '3');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }
    
    }
    public function store_checkPending(){


       $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
     $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->where('requisition_summary.req_status_ID', '3');
    $this->db->or_where('requisition_summary.req_status_ID','2');
    $this->db->where('company_category.service_type','0');
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }

   
    }
 /*   public function update_store_status($id){
       $available = null==!($this->input->post('available')) ? 1 : 0; 
      $unavailable = null==!($this->input->post('unavailable')) ? 1 : 0; 
      $count=count($_POST['available']);
      $data=array();
        for ($i=0; $i<$count; $i++){
          $data[$i]=array(
            'store_status'=>$available[$i],
            'store_status'=>$unavailable[$i],
          
          );
           
        }
      
       $this->db->update('requisition_new_details',$data,$id);

    }
    */

    public function storeFunction($id){
      $this->db->set('store_status', '1');
      $this->db->where('req_detail_ID',$id);
      $this->db->update('requisition_new_details');
    }
    public function insert_stage_activities($data){
      return $this->db->insert('requisition_stage_activities',$data);
    }
    public function store_summary($id){
       $this->db->set('req_status_ID','4');
       $this->db->where('req_ID',$id);
       $this->db->update('requisition_summary');
    }
    public function storeAvailable($id){
       $this->db->set('store_status','1');
       $this->db->where('req_detail_ID',$id);
       $this->db->update('requisition_new_details');
    }
    public function storeUnavailable($id){
        $this->db->set('store_status','2');
       $this->db->where('req_detail_ID',$id);
       $this->db->update('requisition_new_details');
    }
    public function storeChecked($id){
       $this->db->set('store_has_checked','1');
       $this->db->where('req_detail_ID',$id);
       $this->db->update('requisition_new_details');
    }
    public function store_commnet($data){
     return $this->db->insert('requisition_stage_activities',$data);

    }
    public function store_concur($id){
    $this->db->set('req_status_ID','4');
    $this->db->where('req_ID', $id);
    $this->db->update('requisition_summary');

    }
    public function store_agree($data){
     return $this->db->insert('requisition_stage_activities',$data);
    }
    public function comments($id){
      $this->db->select('*');
      $this->db->from('requisition_stage_activities');
      $this->db->where('req_ID',$id);
      $query=$this->db->get();
       if ($query->num_rows()>0){
 
         return $query->result();

      }

      else{
        return false;
      }

    }

}
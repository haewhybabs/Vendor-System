<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Requisition_details_model extends CI_Model
{

    public $table = 'requisition_details';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

  
    //Get all
    function get_all()
    {
       $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    //Get all
    function get_department($id)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.department_id', $id);
         $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

     function get_department2($id, $user)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.department_id', $id);
        $this->db->where('requisition_details.user_id', $user);
         $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    //Get data by id
    function get_by_id2($id)
    {
       $this->db->select('dept_requisition.*, company_category.category, products.name, requisition_details.reference');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('products', 'products.product_id =dept_requisition.product_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.cat_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->result();
    }
    
    //Get data by id
    function get_id($id)
    {
       $this->db->select('requisition_details.*, company_category.category, company_category.service_type, company_category.short');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->row();
    }

     function get_summary($id)
    {
       $this->db->select('requisition_summary.*, company_category.category, company_category.service_type, company_category.short');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('requisition_summary.req_ID', $id);
        return $this->db->get('requisition_summary')->row();
    }
    
     // get data by id
    function get_by_id($id)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->row();
    }
      function get_by_id_new($id)
    {
        $this->db->select('requisition_summary.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('requisition_summary.req_ID', $id);
        return $this->db->get('requisition_summary')->row();
    }
    function get_byId($id)
    {
        $this->db->select('requisition_summary.*, company_category.category, departments.dept_name');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('requisition_summary.req_ID', $id);
        return $this->db->get('requisition_summary')->row();
    }
    
    //Get data by id
    function get_vendor($id)
    {
       $this->db->select('requisition_details.vendor_assign');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->row();
    }
    
    //Get data by id
    function get_by_requisition2($id)
    {
       $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name,selected_vendors.price');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'requisition_details.id = selected_vendors.req_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->result();
    }
    
     //Get data by id
    function get_by_requisition($id)
    {
       $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->result();
    }
    
     function get_by_requisition_price($id)
    {
       $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name, e_vendor.company_name, selected_vendors.price');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
         $this->db->join('e_vendor', 'e_vendor.supplier_id = selected_vendors.vendor_id');
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
     function get_all_concur($id)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.department_id', $id);
        $this->db->where('requisition_details.concur', 1);
         $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
     //Get for concur
     function get_all_budget()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.budget', 1);
        return $this->db->get($this->table)->result();
    }
    
     //Get for concur
     function get_all_dfs()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.dfs', 1);
        return $this->db->get($this->table)->result();
    }
    
     //Get for concur
     function get_all_sap()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.sap', 1);
        return $this->db->get($this->table)->result();
    }
    
     //Get for concur
     function get_all_forensic()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.forensic', 1);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
     function get_all_rp()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
       $this->db->where('requisition_details.rp', 1);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
    function get_all_purchase()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.rp', 1);
        $this->db->where('requisition_details.rp_status', 1);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
    function get_all_invoice()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
         $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.rp', 1);
        $this->db->where('requisition_details.rp_status', 1);
         $this->db->where('requisition_details.po_sent', 1);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
    function get_all_store()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.store', 1);
        // $this->db->where('company_category.service_type =', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    //Get for concur
    function get_all_new()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
        $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.admin', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       function get_all_approve()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
         $this->db->where('requisition_details.status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       function get_all_quote()
    {
        $this->db->select('requisition_summary.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');

        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
       
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->order_by('req_ID', $this->order);
        return $this->db->get('requisition_summary')->result();
    }
      function get_all_department_quote_approve()
    {
        $this->db->select('requisition_new_details.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('requisition_summary', 'requisition_new_details.req_ID = requisition_summary.req_ID');
        $this->db->join('products', 'products.product_id = requisition_new_details.product_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
         $this->db->where('requisition_new_details.store_status', '0');

        return $this->db->get('requisition_new_details')->result();
    }
        public function get_all_sent_requisition(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
         public function getSent_requisition_bud(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','3');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
       public function getSent_requisition_bud_attended(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status >','3');
        $this->db->or_where('approval_sheet_summary.approval_sheet_status','2');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
       public function getSent_requisition_procure(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','4');
        $this->db->where('approval_sheet_summary.procure_forensic_status','1');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
        public function getSent_requisition_procure_attended(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status >','4');
         $this->db->where('approval_sheet_summary.procure_forensic_status','1');
        $this->db->or_where('approval_sheet_summary.approval_sheet_status','1');
        
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }

       public function getSent_requisition_sap(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','5');
        $this->db->where('approval_sheet_summary.procure_forensic_status','2');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }

        public function getSent_requisition_sap_attended(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status >','5`');
         $this->db->where('approval_sheet_summary.procure_forensic_status','2');
        $this->db->or_where('approval_sheet_summary.approval_sheet_status','0');
        
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
        public function getSent_requisition_forensic(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','4');
        $this->db->where('approval_sheet_summary.procure_forensic_status','2');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
        public function getSent_requisition_forensic_attended(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status >','4');
         $this->db->where('approval_sheet_summary.procure_forensic_status','2');
        $this->db->or_where('approval_sheet_summary.approval_sheet_status','0');
        
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
       public function getSent_requisition_final(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','6');
        
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
       public function getSent_requisition_purchase_order(){
        $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status','7');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();


       }
       public function getSent_requisition_final_attended(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname, approval_sheet_summary.*');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
         $this->db->join('approval_sheet_summary','rfq_summary.rfq_ID= approval_sheet_summary.rfq_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','1');
        $this->db->where('approval_sheet_summary.approval_sheet_status >','6');
        $this->db->or_where('approval_sheet_summary.approval_sheet_status','-1');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }

        public function final_approval_requisition(){
         $this->db->select('requisition_summary.*, company_category.category,rfq_summary.*,departments.dept_name,admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_summary.user_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->join('rfq_summary','rfq_summary.req_ID= requisition_summary.req_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        $this->db->where('requisition_summary.process_status_ID>','2');
        $this->db->order_by('rfq_summary.deadline', $this->order);
        return $this->db->get('requisition_summary')->result();
       }
    
    
    /*   function get_all_send_quote()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.quote', 1);
         $this->db->where('requisition_details.quote_status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    */
    public function count_available(){
        $this->db->select('requisition_summary.req_ID,requisition_new_details.req_detail_ID');
        $this->db->join('requisition_new_details','requisition_new_details.req_ID=requisition_summary.req_ID');
        $this->db->where('requisition_summary.req_status_ID','5');
        $this->db->where('requisition_new_details.store_status','0');
         $this->db->order_by('requisition_new_details.req_detail_ID', $this->order);
        return $this->db->get('requisition_summary')->result();
    }
    public function get_all_send_quote(){
        $this->db->select('quote_summary.*,rfq_summary.*,departments.dept_name,company_category.category,e_vendor.company_name');
        $this->db->join('requisition_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
         $this->db->join('quote_summary','rfq_summary.rfq_ID=quote_summary.rfq_ID');
        $this->db->join('e_vendor','quote_summary.vendor_ID=e_vendor.supplier_id'); 
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->order_by('quote_summary.quote_ID','DESC');
        return $this->db->get('rfq_summary')->result();
    }
       function get_all_set_price()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.admin', 1);
         $this->db->where('requisition_details.rfx_status', 1);
        $this->db->where('requisition_details.po', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
        function get_all_proposal()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
         $this->db->where('requisition_details.rfx_status', 0);
         $this->db->where('requisition_details.status', 1);
         $this->db->where('requisition_details.rfx_status', 0);
         $this->db->where('company_category.service_type', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       function get_all_send_proposal()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
         $this->db->where('requisition_details.rfx_status', 1);
         $this->db->where('company_category.service_type', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // Get by review
       function get_all_reject()
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name, admin_login.firstname, admin_login.lastname');
         $this->db->join('admin_login', 'admin_login.id = requisition_details.user_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
         $this->db->where('requisition_details.status', 2);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // Get by review
    function get_all_review($id)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->join('departments', 'departments.id = company_category.department_id');
        $this->db->where('requisition_details.technical', 1);
        $this->db->where('company_category.service_type =', 1);
        $this->db->where('company_category.department_id =', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // Get by review
    function get_all_review2($id)
    {
        $this->db->select('requisition_details.*, company_category.category, departments.dept_name');
         $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
         $this->db->join('departments', 'departments.id = company_category.department_id');
        $this->db->where('requisition_details.technical_head', 1);
        $this->db->where('company_category.service_type =', 1);
        $this->db->where('company_category.department_id =', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // Get by review
    function get_rev($id)
    {
        $this->db->select('departments.*');
        $this->db->join('company_category','company_category.id = requisition_details.category_id');
         $this->db->join('departments', 'departments.id = company_category.department_id');
        $this->db->where('requisition_details.technical', 1);
        $this->db->where('company_category.service_type =', 1);
         $this->db->where('requisition_details.id =', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->row();
    }
    
    
    // Get by review
    function get_by_review($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name,products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.cat_id');
        $this->db->where('company_category.department_id =', $id);
        return $this->db->get($this->table)->result();
    }
    
    
    // 
    function get_by_all()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        return $this->db->get($this->table)->result();
    }
    
    // Get all 
    function get_by_department($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name,products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.cat_id');
        $this->db->where('requisition_details.department_id', $id);
        return $this->db->get($this->table)->result();
    }
    
    // Get all
    function get_all_department_store()
    {
         $this->db->select('dept_requisition.*, company_category.category, departments.dept_name,products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('company_category', 'company_category.id = dept_requisition.cat_id');
        $this->db->where('requisition_details.store', 1);
        //$this->db->where('company_category.service_type =', 0);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_budget()
    {
        $this->db->select('dept_requisition.*, selected_vendors.price, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_dfs()
    {
        $this->db->select('dept_requisition.*, selected_vendors.price, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
          $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_forensic()
    {
        $this->db->select('dept_requisition.*, selected_vendors.price, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
          $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_rp()
    {
        $this->db->select('dept_requisition.*, selected_vendors.price, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
          $this->db->join('products', 'products.product_id = dept_requisition.product_id');
         $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        return $this->db->get($this->table)->result();
    }
    
    
    
     function get_all_department_admin()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.admin', 1);
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_approve()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
        $this->db->where('requisition_details.status', 1);
        return $this->db->get($this->table)->result();
    }
    
      function get_all_department_quote()
    {
        $this->db->select('requisition_new_details.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('requisition_summary', 'requisition_new_details.req_ID = requisition_summary.req_ID');
        $this->db->join('products', 'products.product_id = requisition_new_details.product_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
        $this->db->where('requisition_summary.req_status_ID', '5');
        return $this->db->get('requisition_new_details')->result();
    }
    
      function get_all_department_send_quote()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
         $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.quote', 1);
        $this->db->where('requisition_details.quote_status', 1);
        return $this->db->get($this->table)->result();
    }
    
      function get_all_department_set_price()
    {
        $this->db->select('selected_vendors.*, company_category.category, departments.dept_name');
        $this->db->join('selected_vendors', 'selected_vendors.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.admin', 1);
        $this->db->where('requisition_details.rfx_status', 1);
        $this->db->where('requisition_details.po', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
      function get_all_department_proposal()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
        $this->db->where('requisition_details.rfx_status', 0);
        $this->db->where('requisition_details.status', 1);
        return $this->db->get($this->table)->result();
    }
    
      function get_all_department_send_proposal()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
        $this->db->where('requisition_details.rfx_status', 1);
        $this->db->where('requisition_details.status', 1);
        return $this->db->get($this->table)->result();
    }
    
      function get_by_req_id($id)
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('products', 'products.product_id = dept_requisition.product_id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.quote', 1);
        $this->db->where('requisition_details.id', $id);
        return $this->db->get($this->table)->result();
    }

       function get_req_details($id)
    {
        $this->db->select('requisition_new_details.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
        $this->db->join('products', 'products.product_id = requisition_new_details.product_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
       // $this->db->where('requisition_details.quote', 1);
        $this->db->where('requisition_summary.req_ID', $id);
        return $this->db->get('requisition_summary')->result();
    }

       function get_req_detailsp($id)
    {
        $this->db->select('requisition_new_details.*, company_category.category, departments.dept_name, products.name');
        $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
        $this->db->join('products', 'products.product_id = requisition_new_details.product_ID');
        $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
        $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
       // $this->db->where('requisition_details.quote', 1);
        $this->db->where('requisition_new_details.store_status','0');
        $this->db->where('requisition_summary.req_ID', $id);
        return $this->db->get('requisition_summary')->result();
    }
    
    function get_all_department_reject()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.req_status', 3);
        $this->db->where('requisition_details.status', 2);
        return $this->db->get($this->table)->result();
    }
    
     function get_all_department_review()
    {
        $this->db->select('dept_requisition.*, company_category.category, departments.dept_name');
        $this->db->join('dept_requisition', 'dept_requisition.req_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        $this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('requisition_details.technical', 1);
        return $this->db->get($this->table)->result();
    }
    
    function get_msg_req($id){
        $this->db->select('comment.*');
        $this->db->join('comment', 'comment.requisition_id = requisition_details.id');
        $this->db->join('departments', 'departments.id = requisition_details.department_id');
        //$this->db->join('company_category', 'company_category.id = requisition_details.category_id');
        $this->db->where('departments.id =', $id);
         $this->db->order_by('comment.id', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    function get_msg(){
        $this->db->select('comment.*');
       // $this->db->where('comment.sender =', $id);
     //   $this->db->or_where('comment.to =', $id);
      //   $this->db->order_by('comment.id', $this->order);
        return $this->db->get('comment')->result();
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
    public function new_update($id){
        $this->db->set('approval_sheet_status','4')
        ->where('rfq_ID',$id)
        ->update('approval_sheet_summary');
    }
     public function new_update_decline($id){
        $this->db->set('approval_sheet_status','2')
        ->where('rfq_ID',$id)
        ->update('approval_sheet_summary');
    }
    public function req_new_update($req_ID){
        $this->db->set('process_status_ID','4')
        ->where('req_ID',$req_ID)
        ->update('requisition_summary');
    }
    function insert_msg($data)
    {
      $this->db->insert('comment', $data);
        return $this->db->insert_id();
    }

    // update data
    function update_msg($id, $data)
    {
        $this->db->where('requisition_id', $id);
        $this->db->update('comment', $data);
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

    public function get_com_quote($id, $com){
     $this->db->select('requisition_summary.*, company_category.category, requisition_new_details.*, departments.dept_name,products.name,rfq_summary.*,rfq_vendors.*');
     $this->db->join('requisition_new_details', 'requisition_new_details.req_ID = requisition_summary.req_ID');
     $this->db->join('rfq_summary', 'rfq_summary.req_ID = requisition_summary.req_ID');
     $this->db->join('rfq_vendors', 'rfq_vendors.rfq_ID = rfq_summary.rfq_ID');
    $this->db->join('departments', 'departments.id = requisition_summary.department_ID');
    $this->db->join('company_category', 'company_category.id = requisition_summary.category_ID');
    $this->db->join('products', 'requisition_new_details.product_ID = products.product_ID');
    $this->db->where('rfq_summary.rfq_ID', $id);
    $this->db->where('rfq_vendors.vendor_ID',$com);
    $this->db->order_by('requisition_summary.req_ID','DESC');
     $query=$this->db->get('requisition_summary');
      if ($query->num_rows()>0){
 
         return $query->result();

         }
      else{
        return false;
      }

    }
    public function procure_update($rfq_ID){
        $this->db->set('approval_sheet_status','6')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
     public function final_update($rfq_ID){
        $this->db->set('approval_sheet_status','7')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
    public function req_final_update($req_id){
        $this->db->set('process_status_ID','8')
        ->where('req_ID',$req_id)
        ->update('requisition_summary');

    }
    public function req_procure_update($req_id){
        $this->db->set('process_status_ID','6')
        ->where('req_ID',$req_id)
        ->update('requisition_summary');

    }
    
    public function procure_update_reject($rfq_ID){

         $this->db->set('approval_sheet_status','1')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
    public function sap_update($rfq_ID){
        $this->db->set('approval_sheet_status','6')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
     public function forensic_update($rfq_ID){
        $this->db->set('approval_sheet_status','5')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
    public function req_sap_update($req_id){
        $this->db->set('process_status_ID','6')
        ->where('req_ID',$req_id)
        ->update('requisition_summary');

    }
     public function req_forensic_update($req_id){
        $this->db->set('process_status_ID','5')
        ->where('req_ID',$req_id)
        ->update('requisition_summary');

    }
     public function sap_update_reject($rfq_ID){

         $this->db->set('approval_sheet_status','0')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
    public function forensic_update_reject($rfq_ID){

         $this->db->set('approval_sheet_status','-3')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
     public function final_reject($rfq_ID){

         $this->db->set('approval_sheet_status','-2')
        ->where('rfq_ID',$rfq_ID)
        ->update('approval_sheet_summary');
    }
    public function count_rfq(){
        return $this->db->count_all_results('rfq_summary');
    }
    public function purchase_count(){
        return $this->db->where('approval_sheet_status','7')    
        ->count_all_results('approval_sheet_summary');
    }
    public function get_his_requisition($id){
        return   $this->db->select('requisition_new_details.*,requisition_summary.*, company_category.category,departments.dept_name,admin_login.firstname, admin_login.lastname,products.name')
        ->join('requisition_new_details','requisition_new_details.req_ID=requisition_summary.req_ID')
        ->join('admin_login', 'admin_login.id = requisition_summary.user_ID')
        ->join('departments', 'departments.id = requisition_summary.department_ID')
        ->join('company_category', 'company_category.id = requisition_summary.category_ID')
        ->join('products', 'products.product_id = requisition_new_details.product_ID')

        ->where('requisition_summary.req_ID',$id)

        ->get('requisition_summary')->result();
    }
    public function get_budget_reference($id){
        return $this->db->select('approval_sheet_summary.*')
        ->join('rfq_summary','approval_sheet_summary.rfq_ID=rfq_summary.rfq_ID')
        ->where('rfq_summary.rfq_ID',$id)->get('approval_sheet_summary')
        ->row();
    }
}
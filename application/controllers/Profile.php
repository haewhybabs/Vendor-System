<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	 public $login;
     public $company_id;
    
	   function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Supplier_model','Director_model', 'Contact_model', 'Vendor_category_model', 'Supplier_document_model', 'Equipment_model']);
           $this->login = $this->session->userdata('vendor_logged_in'); 
            $this->company_id=$this->login['company_id'];
        }
    
        public function index()
        {
        $document = $this->Vendor_category_model->get_all();
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $director_list = $this->Director_model->get_by_supplier($this->company_id); 
        $contact_list = $this->Contact_model->get_by_supplier($this->company_id); 
        $equipment = $this->Equipment_model->get_all($this->company_id);
        $support_doc= $this->Supplier_document_model->get_all($this->company_id);
        $data = array(
            'title' => 'Profile',
            'supplier_data'=>$supplier,
            'director'=>$director_list,
            'contact'=>$contact_list,
            'equipment'=>$equipment,
            'support'=>$support_doc,
             'document'=>$document,
        );
           $this->template->load('template', 'dashboard/profile', $data);
        }
}

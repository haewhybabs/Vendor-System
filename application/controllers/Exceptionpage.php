<?php
class Exceptionpage extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_m');
        $this->load->model('permission_m');
        $this->load->model(['Selectv_model','Quotes_model','Department_model', 'Supplier_model', 'Requisition_details_model', 'Vendor_category_model', 'Activities_model', 'Department_requisition_model', 'Vendor_rfq_model', 'Settings_model']);
        $this->login = $this->session->userdata('cms_logged_in');
        $this->department_id=$this->login['department_id'];

        $this->load->library('form_validation');
    }
    public function index(){
        $data['department_status']= $this->Department_model->get_by_id($this->department_id);
        $data['title']='Permissions';
        $this->template->load('template','errors',$data);
    }
}
?>
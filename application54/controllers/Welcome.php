<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model(['Settings_model','Login_model', 'Audit_model']);
        }

	public function index()
	{
    }

    public function logout(){
    	$this->session->sess_destroy();
    	redirect('home');
    }
}
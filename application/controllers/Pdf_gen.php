<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_gen extends MY_Controller {

    function __construct() {
    	 parent::__construct();
    	
    }
    public function index(){
       $this->load->library('m_pdf');

       $this->load->view('testup/test1');
    	
    }
   
}
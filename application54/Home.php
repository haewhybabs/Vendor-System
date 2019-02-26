<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model(['Settings_model','Login_model']);
        }

	public function index()
	{
        if ($this->session->userdata('cms_logged_in')) {
                redirect('dashboard');
        }
        else{
		$this->load->view('users/login');
        }
	}
    
   public function login() {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
               $this->index();
            } else {
                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password', TRUE);
                $row = $this->Login_model->login($email, $password);

                if ($row) {
                    $sess_array = array(
                        'firstname' => $row->firstname,
                         'lastname' => $row->lastname,
                        'email' => $row->email,
                        'department_id' => $row->department_id,
                        'admin_id'=>$row->admin_id,
                    );
                    $this->session->set_userdata('cms_logged_in', $sess_array);
                    $this->session->roleID = $row->role_ID;
                    $this->_checkUser();
                    redirect(site_url('dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Invalid Email or Password');
                    redirect(site_url('home'));
                }
            }
        }

        public function logout() {
            $user_data = $this->session->all_userdata();
            foreach ($user_data as $key => $value) {
                if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity' && $key != 'firstname' && $key != 'roleID') {
                    $this->session->unset_userdata($key);
                }
            }
            $this->session->sess_destroy();
            redirect('home');
        }
        
        public function _checkUser(){
            if (!$this->session->userdata('cms_logged_in')) {
                redirect('home/logout');
            }
        }
    
     public function _rules() {
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
        }
        
}

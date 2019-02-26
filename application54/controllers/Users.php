<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           $this->load->library('template');
            $this->load->model(['Department_model','Supplier_model', 'Activities_model', 'Login_model', 'Audit_model', 'Settings_model']);
            $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
         $this->user_email=$this->login['email'];
        $this->user_id=$this->login['user_id'];
         $this->emails=$this->login['email'];
        }
     public function index()
        {
           $this->lists(); 
        }
    
        public function lists()
        {
        $admin_list=$this->Login_model->get_all();
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $data = array(
            'title' => 'All Users',
            'department_status'=> $department_status,
            'admin_list'=> $admin_list,
        );
           $this->template->load('template', 'users/list', $data);
        }
    
    public function create()
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
        $department= $this->Department_model->get_all();
        $roles= $this->Department_model->get_role();
        $data = array(
            'title' => 'Add new user',
            'department_status'=> $department_status,
            'department'=> $department,
            'roles'=>$roles,
        );
           $this->template->load('template', 'users/form', $data);
        }
    
     public function create_action()
        {
        $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->create();
            } else {
    
              $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $passcode = substr(str_shuffle($chars),0,8);
            $options = [
                'cost' => 11,
                ];
            $pass= password_hash($passcode, PASSWORD_BCRYPT, $options);
             
             //Load email library
                $this->load->library('email');
                 $host=$this->Settings_model->get_all();
                //SMTP & mail configuration
                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => $host->server,
                    'smtp_port' =>  4500,
                    'smtp_user' => $host->username,
                    'smtp_pass' => $host->password,
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'smtp_crypto'=>'tls'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
             
             $data = array(
                'firstname' => $this->input->post('first_name',TRUE),
		        'lastname' => $this->input->post('last_name',TRUE),
                'email' => $this->input->post('email',TRUE),
                'password' =>$pass,
                'department_id' =>$this->input->post('department',TRUE),
                'role_ID' =>$this->input->post('admin_cat',TRUE),
                );
             
              $data3 = array(
                        'email' => $this->input->post('email',TRUE),
                        'password' => $passcode,
                    );
                    $option = array(
                        'subject'   => 'CoreApp Staff Login',
                        'from'      => 'procure@lfcww.org',
                        'from_name' => 'LFC eProcurement',
                        'to'        => $this->input->post('email',TRUE),
                        'data'      => $data3,
                    );
                    
                    $this->email->from($option['from'], $option['from_name']);
                    $this->email->to($option['to']);
                    $this->email->subject($option['subject']);
                    $this->email->message($this->load->view('templates/email_password', $option['data'], true));
                    $this->email->set_alt_message('View the mail using an html email client');
                    $this->email->send();
                $task='Created new user'; 
                $this->audit($task);
                $this->Login_model->insert($data); 
                $this->session->set_flashdata('message', 'User successfully created.'); 
                redirect(site_url('users'));
         }
        }
    
     public function change_password()
        {
        $department_status= $this->Department_model->get_by_id($this->department_id);
       $data = array(
            'title' => 'Change Password',
            'department_status'=> $department_status,
        );  
           $this->template->load('template', 'users/change', $data);
        }
    
    
     public function update_action()
        {
        $this->pass_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->change_password();
            } else {
             $oldpassword= $this->input->post('o_pass');
             $newpassword= $this->input->post('n_pass');
               $options = [
                'cost' => 11,
                ];
            $pass= password_hash($newpassword, PASSWORD_BCRYPT, $options);
               $user_data2=array(
                'password' =>$pass,
            );
            if($verify_pass=$this->Login_model->login($this->user_email, $oldpassword)){
            $task='Updated password'; 
            $this->audit($task);
                $this->Login_model->reset_user($this->user_email, $user_data2);
                 $this->session->set_flashdata('message', 'Password changed successfully');
                redirect(site_url('users/change_password')); 
                
          }else{
                 $this->session->set_flashdata('error', 'Invalid Password, try again');
              redirect(site_url('users/change_password'));   
            }
         }
        }
    
        public function delete($id)
        {
        if($this->Login_model->get_by_id($id)){
             $task='Deleted a user'; 
            $this->audit($task);
            $this->Login_model->delete($id); 
                $this->session->set_flashdata('message', 'User successfully deleted.'); 
                redirect(site_url('users')); 
        }
        else{
            $this->session->set_flashdata('error', 'This usert does not exist');
             redirect(site_url('user'));     
        }
      }
    
     
                public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.'(staff)',
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
		      );
            
            $this->Audit_model->insert($data_audit);
    }
    
         public function _rules()
    {
         //Supplier Information Validation
	   $this->form_validation->set_rules('email', 'Users email', 'trim|required|is_unique[admin_login.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('department', 'Users Department', 'trim|required');
         $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
         $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('admin_cat', 'User Category', 'trim|required');
    }
    
     public function pass_rules()
    {
        $this->form_validation->set_rules('o_pass', 'Old password', 'trim|required');
        $this->form_validation->set_rules('n_pass', 'New password', 'trim|required');
    }
}

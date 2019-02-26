<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type:text/html;charset=utf-8');

class Home extends CI_Controller {
    
    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model(['Settings_model','Login_model', 'Audit_model']);
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
                        'role_id'=>$row->role_ID,
                        'user_id'=>$row->id,
                    );
                $this->session->set_userdata('cms_logged_in', $sess_array);
                $this->login = $this->session->userdata('cms_logged_in');
                $this->user_id=$this->login['user_id'];
                $this->emails=$this->login['email'];
                $user=  $this->Login_model->get_by_id($this->user_id);
                $task='Logged in to Core App'; 
                $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.' (Staff)',
                'action' => $task,
                'date_time' => date('Y-m-d H:i:s',time()),
              );
              $this->Audit_model->insert($data_audit);
                    $this->session->roleID = $row->role_ID;
                    $this->_checkUser();
                     $task='Logged in to CoreApp'; 
                    $this->audit($task);
                    redirect(site_url('dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Invalid Email or Password');
                    redirect(site_url('home'));
                }
            }
        }

        public function user_login(){

            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');

            if ($this->form_validation->run() == FALSE) {
                 $this->index();
              } 
            else {
                  $username = $this->input->post('username', TRUE);
                  $password = $this->input->post('password', TRUE);
                  $json=$this->ldap_authenticate($username,$password);

                  $user=json_decode($json);
                  if($user->status=='true'){
                      $row=$this->Login_model->get_admin_user($user->mail);
                      if($row && $row->login_status !=0){


                           $sess_array = array(
                          'firstname' =>$row->firstname,
                          'lastname' =>$row->lastname,
                          'email' => $row->email,
                          'department_id' => $row->department_id,
                          'role_id'=>$row->role_ID,
                          'user_id'=>$row->id,
                          );

                          $this->session->set_userdata('cms_logged_in', $sess_array);
                          $this->login = $this->session->userdata('cms_logged_in');
                          $this->user_id=$this->login['user_id'];
                          $this->emails=$this->login['email'];
                          $this->session->roleID = $row->role_ID;

                            $task='Logged in to Core App'; 
                          $data_audit = array(
                          'user' => $this->login['firstname'].' '.$this->login['lastname'].' (Staff)',
                          'action' => $task,
                          'date_time' => date('Y-m-d H:i:s',time()),
                          );
                          $this->Audit_model->insert($data_audit);
                          $this->_checkUser();
                          $task='Logged in to CoreApp'; 
                          $this->audit($task);
                          redirect(site_url('dashboard'));
                          //var_dump($this->login);



                          

                      }

                      else {
                        $data=array(

                              'email'=>$user->mail,
                              'firstname'=>$user->fullname,
                              'login_status'=>'0',
                              'role_ID'=>'17',

                        );
                        if($row==false){

                                $this->Login_model->insert_new_user($data);

                                //Send mail to Admin

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

                          
                   
                                   $email_send['info'] = "User : ".$user->fullname." has just been created on the Procure Portal, Kindly login to your account to activate the user and give access to the user.";
                              
                                $option = array(
                                    'subject'   => 'New User Created',
                                     'from'      => 'procure@lfcww.org',
                                     'from_name' => 'LFC eProcurement',
                                   
                                );
                                $get_admin=$this->Login_model->get_admins();
                                $admins=array();
                                foreach ($get_admin as $admin) {

                                  $this->email->from($option['from'], $option['from_name']);
                                  $this->email->to($admin->email);
                                  //$this->email->to('babalolaisaac@gmail.com');
                                  $this->email->subject($option['subject']);
                                  $this->email->message($this->load->view('templates/interview_schedule', $email_send, true));
                                  $this->email->set_alt_message('View the mail using an html email client');

                                  $this->email->send();

                                } 

                              
                        }
                       
                            
                          $this->session->set_flashdata('error', 'Your account could not be verified, Please contact the Admin to activate your account.');
                          redirect(site_url('home'));
                      }



                  }

                  else{
                    $message=$user->message;
                    $this->session->set_flashdata('error', $message);
                    redirect(site_url('home'));
                  }
        


                   


              }
                         

        }
        
        public function ldap_authenticate($username,$password){

          $data=array(
            'username'=>$username,
            'password'=>$password,
            'api_key'=>'Guard_098@2@',
            'token'=>'NxQnm25gadktoyv',
            'app_username'=>'procurement_admin',


        );


          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pauth.lfcww.org/api/authenticate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "content-type: application/x-www-form-urlencoded",
              "postman-token: 7f80e898-af44-7e62-93be-0759a82cc8ff"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            return $response;
          }


           //$ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, "http://localhost/ldap_webapp/api/authenticate");
      // curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      // curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_HEADER, false);
      // // curl_setopt($ch, CURLOPT_SSLVERSION, 3);
      // // curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
      // $result = curl_exec($ch);
      // // $res    = json_encode($result, true);

      // echo $result;
      // curl_close($ch);
        
        

       


        }

        public function logout() {
            $user_data = $this->session->all_userdata();
             $task='Logged out of Core App'; 
              $this->login = $this->session->userdata('cms_logged_in');
              $this->user_id=$this->login['user_id'];
              $this->emails=$this->login['email'];
                $user=  $this->Login_model->get_by_id($this->user_id);
               $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname.' (Staff)',
                'action' => $task,
                'date_time' => date('Y-m-d H:i:s',time()),
              );
                $this->Audit_model->insert($data_audit);
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
    
     public function password(){
      $this->form_validation->set_rules('remail', 'Email', 'required');
      if ($this->form_validation->run()){
   
            $email = $this->input->post('remail', TRUE); 
           $det = $this->Login_model->get_by_email($email);
           if($det){
                       
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
                   
              //Insert Vendor Details into database 
              $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
              $passcode = substr(str_shuffle($chars),0,8);
               $options = [
                  'cost' => 11,
                  ];
              $pass= password_hash($passcode, PASSWORD_BCRYPT, $options);
              
               $data3 = array(

                              'email' => $this->input->post('remail',TRUE),
                              'password' => $passcode,
                               );
                   
                          $option = array(
                              'subject'   => 'Admin User renewal',
                              'from'      => 'procure@lfcww.org',
                              'from_name' => 'LFC eProcurement',
                              'to'        => $this->input->post('remail',TRUE),
                              'data'      => $data3,
                          );
                          
                          $this->email->from($option['from'], $option['from_name']);
                          $this->email->to($option['to']);
                          $this->email->subject($option['subject']);
                          $this->email->message($this->load->view('templates/password', $option['data'], true));
                          $this->email->set_alt_message('View the mail using an html email client');
                          $this->email->send();
                          //var_dump($this->email->print_debugger());

                            
                              //Insert Vendors Login
                               $data_login = array(
                                  'password' =>$pass,
                              );
                               $task='Reset Password'; 
                            // $this->audit($task);
                              $this->Login_model->update($det->id, $data_login); 

                              

                             $this->session->set_flashdata('message', 'Password is Reset and your new password is successfully sent to your mail');
                         
                            redirect(site_url('home')); 

                         

                              
               }
               else{
               $this->session->set_flashdata('error', 'Email does not exist');
               redirect(site_url('home')); 
               }
                  
        }

        else{
           $this->session->set_flashdata('error', 'Pls fill the neccessary details');
           redirect(site_url('home')); 
        }
        
    }
     
            public function audit($task){
            $user=  $this->Login_model->get_by_id($this->user_id);
            $data_audit = array(
                'user' => $user->firstname.' '.$user->lastname,
                'action' => $task,
                'department' => $user->dept_name,
                'date_time' => date('Y-m-d H:i:s',time()),
		      );
            
            $this->Audit_model->insert($data_audit);
    }
    
     public function _rules() {
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
        }
        public function update_user(){
          $this->Login_model->update_all();
        }


     
        
}

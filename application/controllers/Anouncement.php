<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anouncement extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Settings_model', 'Audit_model', 'Department_model', 'Anouncement_model', 'Login_model']);
        $this->load->library('form_validation');
         $this->login = $this->session->userdata('cms_logged_in'); 
            $this->department_id=$this->login['department_id'];
            //$this->admin_id=$this->login['admin_id'];
         $this->user_id=$this->login['user_id'];
            $this->emails=$this->login['email'];
    }

    public function index()
    {
      $page_data = $this->Anouncement_model->get_all();
      $department_status= $this->Department_model->get_by_id($this->department_id);

      $data = array(
        'title' => 'Anouncement',
        'set_data' => $page_data,
        'department_status'=> $department_status,
      );
        $this->template->load('template', 'anounce/form', $data);
    }
    
     public function form_action()
    {
         $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->index();
            }else{

            $data= array(
                 'summary' => $this->input->post('title', TRUE),
		          'content' => $this->input->post('content',TRUE),
                );
             $id=1;   
            $this->Anouncement_model->insert($data);
           
            $task='Added new anouncement for vendors'; 
            $this->audit($task);
            $this->session->set_flashdata('message', 'Message inserted successfully');
            redirect(site_url('anouncement'));
         }
    }
        
        
     public function edit($id)
    {
      $page_data = $this->Anouncement_model->get_by_id($id);
      $department_status= $this->Department_model->get_by_id($this->department_id);

      $data = array(
        'title' => 'Edit Anouncement',
        'set_data' => $page_data,
        'department_status'=> $department_status,
      );
        $this->template->load('template', 'anounce/edit', $data);
    }
    
     public function delete($id)
    {
        $this->Anouncement_model->delete($id);
        $this->session->set_flashdata('message', 'Message deleted successfully');
         redirect(site_url('anouncement'));
     
    }
    
       public function sms($msg, $phone){
        /** Sample API request to SMSPrime using XML **/

                //username
                $username = "canaanland@lfcww.org";
                //API Key
                $APIKey = "5E68F254539B8FA8F01FBC0E2F273FD4";
                //Mime mode
                $dataformat = "xml";
                //Derivative URL
                $APIUrl = "http://smsprime.com/api.module/canaanland@lfcww.org/xml";
                //Compute a signature for the user by concatenating the username and the api key
                $signature = md5($username . $APIKey);

                //Build an xml request for method send, with an auxillary instruction to get the balance
                $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                <Request>
                    <header>
                        <auth>
                            <signature>$signature</signature>
                        </auth>
                    </header>
                    <body>
                        <auxillary>
                            <balance>1</balance>
                        </auxillary>
                        <method>send</method>
                        <parameters>
                            <type>default</type>
                            <destination>$phone</destination>
                            <source>LFC e-Procurement</source>
                            <header>LFC e-Procurement</header>
                            <shortmessage>$msg</shortmessage>
                        </parameters>
                    </body>
                </Request>";


                //Use CURL to post
                //You could as well easily use fsockopen and its family of functions
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $APIUrl ); 
                curl_setopt($ch, CURLOPT_POST, 1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $postResult = curl_exec($ch);
                if (curl_errno($ch)) {
                //  print curl_error($ch);
                }
                curl_close($ch);
               //print htmlentities("$postResult");
    }
    
     public function edit_action()
    {
         $this->_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->index();
            }else{

            $data= array(
                   'summary' => $this->input->post('title', TRUE),
		          'content' => $this->input->post('content',TRUE),
                );   
            $this->Anouncement_model->update( $this->input->post('id', TRUE), $data);
            // $task='Updated '. $this->input->post('name',TRUE).' on Blood Group';
           // $this->audit($task);
            $task='Change and edited anouncement for vendors'; 
            $this->audit($task);
            $this->session->set_flashdata('message', 'Anouncement edited successfully');
            redirect(site_url('anouncement'));
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
    
         public function _rules()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
         $this->form_validation->set_rules('content', 'Content', 'trim|required');

    }
    
}

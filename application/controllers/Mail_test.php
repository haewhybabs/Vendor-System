<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_test extends MY_Controller {

    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
           
        }
    
        public function index()
        {
               



                     $this->load->library('email');
                    $config = Array(
                    // 'protocol' => 'smtp',
                    // 'smtp_host' => 'ssl://smtp.googlemail.com',
                    // 'smtp_port' => 25,
                    // 'smtp_user' => 'babalolaisaac@gmail.com',
                    // 'smtp_pass' => 'babalola774',
                    // 'mailtype'  => 'html', 
                    // 'charset'   => 'iso-8859-1'
                    //  );

                     'protocol' => 'smtp',
                    'smtp_host' => 'procure@lfcww.org',
                    'smtp_port' => 25,
                    'smtp_user' => 'procure@lfcww.org',
                    'smtp_pass' => 'L!v!ngF@1th',
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1'
                     );
                     $this->load->library('email', $config);
                     $this->email->set_newline("\r\n");


                          $this->email->from('procure@lfcww.org','Ayobami Babs');
                          $this->email->to('babalolaisaac@gmail.com');
                          $this->email->subject('Testing');
                          $this->email->message('Mail Testing,How are you');
                          $this->email->send();
                       // var_dump($this->email->print_debugger());
                            if ($this->email->send()){
                                echo "yes";
                            } 
                            else{
                                echo "No";
                            }
        } 

}
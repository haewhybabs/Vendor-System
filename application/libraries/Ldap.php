<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ldap
{
  
  // private $class_name        = "LDAPAuth";
  // private $class_version     = "1.0.0";
  // private $class_author      = "";
  // private $class_source      = "";

  // protected $_account_suffix     = "";
  // protected $_base_dn            = "ou=people,dc=lfcww,dc=org";
  // protected $_user_dn            = "ou=people,dc=lfcww,dc=org";
  // protected $_domain_controllers = Array('mail2.lfcww.org');
  // protected $_use_ssl            = false;
  // protected $_use_tls            = false;
  // protected $_use_ad             = false;

  // protected $_conn;
  // protected $_bind;


  
    public function index()
    { 
         
    }
    public function auth(){
        $CI=& get_instance();

      if ($CI->session->userdata('logged_in')==false){
           return false;
      }
      if ($CI->session->userdata('logged_in')==true){
       return true;
      }
    }

    public function cart_count(){
         $CI=& get_instance();
      return count($CI->cart->contents());
    }

    public function ldap_auth(){
      echo 'hello';

        // $options = Array('base_dn' => 'ou=people,dc=lfcww,dc=org',
        //                  'user_dn' => 'ou=people,dc=lfcww,dc=org',
        //                  'domain_controllers' => Array('mail2.lfcww.org'),
        //                 );
      
    }

}
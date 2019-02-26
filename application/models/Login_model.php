<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public $table = 'admin_login';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

  
    // get all
    function get_all()
    {
         $this->db->select('admin_login.*, departments.dept_name');
         $this->db->join('departments', 'departments.id = admin_login.department_id','left');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
    // login function
    function login($email, $password) {
     /*   $query=$this->db->where(['email'=>$email,'password'=>$password])
             ->get('admin_login');
        if ($query->num_rows()>0){
            return $query->row();
        }
       
       
*/

       $this->db->from($this->table);
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query){
            if ($query->num_rows() == 1) {
                $vData = $query->row();
                if(password_verify($password, $vData->password)){
                    return $vData;
                }
                else{
                    return false;
                }
            } else {
                return false;
            }
        }
        else {
            return false;
        }
       
    }

    public function get_admin_user($email){
        return $this->db->where('email',$email)
        ->get('admin_login')->row();
    }
    
    function checkMail($email){
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();
        
        if($query){
            if ($query->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    function reset_user($email, $data){
        $this->db->where('email', $email);
        $query = $this->db->update($this->table, $data);
        return $query;
    }
  
     // get data by id
    function get_by_id($id)
    {
        $this->db->select('admin_login.*, departments.dept_name');
         $this->db->join('departments', 'departments.id = admin_login.department_id');
        $this->db->where('admin_login.id', $id);
        return $this->db->get($this->table)->row();
    }
    
     // get data by email
    function get_name($id)
    {
        $this->db->where('admin_login.email', $id);
        return $this->db->get($this->table)->row();
    }
    
      // get data by email
    function get_by_email($id)
    {
        $this->db->where('email', $id);
        return $this->db->get($this->table)->row();
    }
  
    function insert($data)
    {
      $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
   

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function insert_new_user($data){
        $this->db->insert('admin_login',$data);
    }
    public function update_all(){
        $this->db->set('login_status','1')
        ->update('admin_login');
    }
    public function get_each_user($id){
         $this->db->select('admin_login.*, departments.dept_name,roles.*');
         $this->db->join('departments', 'departments.id = admin_login.department_id','left');
         $this->db->join('roles','roles.role_ID= admin_login.role_ID','left');
         $this->db->where('admin_login.id',$id);
        return $this->db->get($this->table)->row();
    }
    public function get_admins(){
        return $this->db->where('role_ID','15')
        ->get('admin_login')->result();
    }

    public function get_all_department(){
      return  $this->db->get('departments')->result();
    }
    public function update_new_user($data,$user_id){
        $this->db->set($data)
        ->where('id',$user_id)
        ->update('admin_login');
    }
    
}
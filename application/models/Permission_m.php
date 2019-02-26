<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_m extends MY_Model {

    protected $_table_name = 'permission';
    protected $_primary_key = 'permission_ID';
    protected $_primary_filter = 'intval';
    protected $_order_by = "permission_ID asc";

    function __construct() {
        parent::__construct();
    }

    public function get_all_usertype()
    {
        $this->db->select('*')->from('roles')->order_by('role_ID');
        $query = $this->db->get();
        return $query->result();
    }

    function get_by_id($id)
    {
        $this->db->where('permission_ID', $id);
        return $this->db->get('permission')->row();
    }


    function get_permission($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    public function get_modules_with_permission($id=null) {
        $query = "Select permission.permission_ID,permission.name,permission.desc, (case when permission_rel.role_ID = $id then 'yes' else 'no' end) as active From permission  left join  permission_rel ON permission.permission_ID = permission_rel.permission_ID and permission_rel.role_ID =$id";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_order_by_permission($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function insert_permission($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_permission($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    public function delete_all_permission($id)
    {
        $this->db->where(array('role_ID' => $id));
        $this->db->delete('permission_rel');
        return true;
    }
    public function insert_relation($array)
    {
        $this->db->insert("permission_rel", $array);
        $id = $this->db->insert_id();
        return $id;
    }

    public function delete_permission($id){
        parent::delete($id);
    }
    public function get_all_users(){
      return $this->db->get('admin_login')->result();
    }
    public function get_all_roles(){
        return $this->db->get('roles')->result();

    }
    public function get_user_id($id){
        return $this->db->where('admin_login.id',$id)
        ->join('departments','departments.id=admin_login.department_id','left')
        ->get('admin_login')->row();
    }
    public function edit_role($id,$data){
        $this->db->set($data)
        ->where('id',$id)
        ->update('admin_login');
    }
    public function get_department(){
        return $this->db->get('departments')->result();
    }



}

/* End of file permission_m.php */
/* Location: .//Applications/MAMP/htdocs/asheef-tsm/mvc/models/permission_m.php */
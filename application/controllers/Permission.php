<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Permission_m');
        $this->load->model('Usertype_m');
        $this->load->model('Department_model');
        $this->load->model('Audit_model');
        $this->load->library('form_validation');
        $this->login = $this->session->userdata('cms_logged_in');
        $this->department_id=$this->login['department_id'];

    }
public function index(){
    $id = $this->uri->segment(3);
    $this->data['department_status']= $this->Department_model->get_by_id($this->department_id);
    if((int)$id) {
        $usertype = $this->Usertype_m->get_usertype($id);
        if($usertype->role_name == "Super Admin" || $usertype->role_name == "Admin"){
            redirect(site_url().'exceptionpage');
        }
        if(count($usertype)) {

            $this->data['set'] = $id;
            $this->data['usertypes'] = $this->Usertype_m->get_usertype();
            $this->data['permissions'] = $this->Permission_m->get_modules_with_permission($id);
            if(empty($this->data['permissions'])) {
                $this->data['permissions'] = NULL;
                 $this->data['title'] = 'Permisions';
            }
            $this->data["subview"] = "permission/index";
             $this->data['title'] = 'Permisions';
            $this->template->load('template', 'permission/index', $this->data);
        } else {
            $this->data["subview"] = "error";
             $this->data['title'] = 'Permisions';
            $this->template->load('template', 'permission/index', $this->data);
        }
    } else {
        $this->data['usertypes'] = $this->Usertype_m->get_usertype();
        $this->data["subview"] = "permission/index";
         $this->data['title'] = 'Permisions';
        $this->template->load('template', 'permission/index',$this->data);
    }

}
    public function permission_list() {
        $usertypeID = $this->input->post('roleID');
        if((int)$usertypeID) {
            $string = base_url("permission/index/$usertypeID");
            echo $string;
        } else {
            redirect(base_url("permission/index"));
        }
    }

    public function save() {
        $this->session->userdata('usertype');
        $usertypeID = $this->uri->segment(3);
        if ((int)$usertypeID) {
            $usertype = $this->Usertype_m->get_usertype($usertypeID);
            if(count($usertype)) {
                if ($this->Permission_m->delete_all_permission($usertypeID)) {
                    foreach ($_POST as $key => $value) {
                        //var_dump($_POST);
                        $array = array();
                        $array['permission_ID'] = $value;
                        $array['role_ID'] = $usertypeID;
                       // echo $value;
                       // echo $usertypeID;
                        $this->Permission_m->insert_relation($array);
                    }
                    redirect(base_url('permission/index/'.$usertypeID),'refresh');
                } else {
                   redirect(base_url('permission/index/'.$usertypeID),'refresh');
                }
            } else {
                $this->data["subview"] = "error";
                $this->template->load('template','permission/index', $this->data);
            }
        } else {
           redirect(base_url('permission/index/'.$usertypeID),'refresh');
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

    public function modify_role(){

        $data=array(

            'users'=>$this->Permission_m->get_all_users(),
            'roles'=>$this->Permission_m->get_all_roles(),
            'title'=>'Modify Roles',
        );


        $this->template->load('template', 'permission/modify',$data);

    }
    public function user_modify($id){

        $data=array(

            'user'=>$this->Permission_m->get_user_id($id),
            'roles'=>$this->Permission_m->get_all_roles(),
            'department'=>$this->Permission_m->get_department(),
            'title'=>'User Access Right',
            'id'=>$id,
        );


        $this->template->load('template', 'permission/edit',$data);
    }

    public function edit_action(){
        $data=array(
           'id'=>$this->input->post('id'),
           'role_ID'=>$this->input->post('role_ID'),
           'staff_id'=>$this->input->post('staff_id'),
           'department_id'=>$this->input->post('department_id'),
           'login_status'=>'1',
        );
        $this->Permission_m->edit_role($data['id'],$data);
       
       

        $this->session->set_flashdata('message','Role Assigned Successfully ');
        redirect(base_url("permission/modify_role"));
        
    }

}
?>
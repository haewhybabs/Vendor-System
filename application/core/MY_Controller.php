<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('cms_logged_in')) {
            redirect('home');
        }

        $this->load->model('Menu_m');
        $this->load->model('Permission_m');

        $this->load->library('form_validation');
        if($this->session->roleID){
            $menu = $this->Menu_m->get_menu();


            $role = $this->session->roleID;
            $perm = $this->Permission_m->get_modules_with_permission($role);

            $user_id=$this->session->userdata['cms_logged_in']['user_id'];
            $get_roles=$this->Permission_m->get_user_role($user_id);

            foreach($get_roles as $rol){

                $permis[] = $this->Permission_m->get_permission_by_role($rol->role_ID);

            }
            
            



            
             
            $result = [];
            foreach($permis as $arr)
            {
                $result = array_merge($result , $arr);
            }
            
            $permo=array();
            foreach($result as $per){
                if(!in_array($per->permission_ID,$permo)){
                    $permo[]=$per->permission_ID;
                }
                else{
                    
                }
                
            }

            foreach($permo as $p=>$value ){
                $permission=$this->Permission_m->get_active($value);
                $data1=array(
                    'permission_ID'=>$value,
                    'active'=>$permission->active,
                    'name'=>$permission->name,
                    'desc'=>$permission->desc,
                );

                $data[]=$data1;
            }

            $this->session->menu = $menu;
            $this->session->perm = $perm;
            $this->session->permit=$data;

            


            
        
//  var_dump($data);
//  die;
            $array = array();
            $perm=$data;


                foreach ($perm as $p) {
                    if (  $p['active'] == "yes") {
                        array_push($array, $p['permission_ID']);


                        // $this->Menu_m->get(array('link' => ))
                        //  array_push($array['link'], $m->link);
                        //  echo '<li>' . $m->menu_name . '</li>';


                    }

            }
            //  var_dump($array);
            $method = $this->router->fetch_method();
            if ($method == "index") {
                $nmethod = "";
            } else {
                $nmethod = "/" . $this->router->fetch_method();
            }
            $link = $this->router->fetch_class() . $nmethod;
            //  echo $link;
            $linkm = $this->Menu_m->getm(array('link' => $link));

            // echo $linkm[0]->icon;
         //   var_dump($linkm);
         //   var_dump($array);
            // echo $linkm[0]->menu_ID;
            if (count($linkm)) {
                if (in_array($linkm[0]->permission_ID, $array)) {
                    // echo 'Authorized';


                } else {
                    redirect(site_url() . 'exceptionpage');
                }

                // var_dump($array);

            } else {
                //redirect(site_url().'exceptionpage');


            }
            // var_dump($menu);
            $parray = array();
            foreach ($perm as $pe) {
                array_push($parray, $pe['name']);

            }
            $pageauth = array();
            $controller = ucwords($this->router->fetch_class());
            $url = current_url();
            // echo $url;

            if (strpos(current_url(), 'create') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                //  var_dump($currlink);
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    // echo $exactperm->name;
                    // var_dump($exactperm);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        // var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_add",$pageauth)){

                           // redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_add",$pageauth)){

                          //  redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }


            if (strpos(current_url(), 'preview') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $this->Permission_m->get_modules_with_permission($role);
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'concur') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_concur",$pageauth)){

                           // redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_concur",$pageauth)){

                            //redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'printdoc') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'update') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'delete') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_delete",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_delete",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'activate') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                    //var_dump($currlink);
                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);
                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'deactivate') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_edit",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }

            if (strpos(current_url(), 'read') != "") {
                $currlink = $this->Menu_m->getm(array('link' => $controller));
                if(count($currlink)) {
                    //var_dump($currlink);
                    $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                    if ($currlink[0]->parent_ID == "" && $currlink[0]->subparent_ID == "") {
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    } elseif ($currlink[0]->parent_ID != "" && $currlink[0]->subparent_ID == "") {
                        $parent = $currlink[0]->parent_ID;
                        //  var_dump($currlink);
                        $currlink = $this->Menu_m->getm(array('menu_ID' => $parent));
                        $exactperm = $this->Permission_m->get_by_id($currlink[0]->permission_ID);

                        //  var_dump($currlink);
                        $permission = $perm;
                        //  var_dump($permission);
                        foreach($permission as $per) {
                            if ($per['active'] == "yes") {
                                array_push($pageauth, $per['name']);

                            }
                        }
                        //  var_dump($pageauth);
                        // echo $role;
                        if(!in_array($exactperm->name."_view",$pageauth)){

                            redirect(site_url().'exceptionpage');

                        }


                    }
                }
                // var_dump($pageauth);


                // redirect(site_url().'exceptionpage');
            }
        }

    }

   


}
?>

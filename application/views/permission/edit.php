<link type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.themify.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url(); ?>assets/css/list.css" rel="stylesheet">

<?php
if ($this->session->userdata('error') <> '') {
    echo '<div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="ti ti-alert"></i>&nbsp; <strong>Error!</strong> There are some errors happening
                <p>' . $this->session->userdata("error") . '</p>
            </div>';
}
if ($this->session->userdata('message') <> '') {
    echo '<div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><p><i class="ti ti-check"></i>&nbsp; ' . $this->session->userdata("message") . '</p></strong>
            </div>';
}
?>
<form action="<?=base_url();?>Permission/edit_action" method="POST">
<div data-widget-group="group1">
    <div class="row">
        
            <div class="col-md-12">
                <div class="panel panel-default no-bd">
                    <div class="panel-header bg-dark">
                        <h6 class="panel-title" style="">Update <?=$user->firstname;?> Account</h6>
                    </div> 
                        
                  
                <div class="panel-body bg-white">
                <div class="col-sm-12">
                 

        
                          <input type="hidden" value="<?=$id;?>" name="id">
                        <div class="row">
                           
                        
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Full name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control form-white" name="firstname" value="<?php echo $user->firstname; ?>" disabled>
                                </div>
                            </div>

                              <div class="col-lg-6">     
                                  <div class="form-group">
                                     <label for="exampleInputPassword1">Email Address <span class="text-danger">*</span></label>
                                     <input type="text" class="form-control form-white"  name="email" value="<?php echo $user->email; ?>" disabled>
                                  </div>
                              </div> 
                        </div>


                        <div class="row">
                          
                        
                           
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Staff ID <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control form-white"  name="staff_id" value="<?php echo $user->staff_id; ?>">
                                </div>
                            </div>
                            <?php if($user->dept_name==false):?><br>

                                <div class="form-group col-lg-6">
                           

                                        <select class="col-md-offset-4 col-md-12 " name="department_id" id="roleID">
                                             <option>Select Department</option>
                                           
                                            
                                                    
                                                <?php foreach ($department as $dept):?>

                                                    
                                                        <option value="<?=$dept->id;?>"><?=$dept->dept_name;?></option>

                                                   
                                                <?php endforeach;?>
                                               
                                        </select>
                                </div>
                            <?php else:?>



                              <div class="col-lg-6">     
                                  <div class="form-group">
                                     <label for="exampleInputPassword1">Department<span class="text-danger">*</span></label>
                                     <input type="text" class="form-control form-white"  name="department" value="<?php echo $user->dept_name; ?>" disabled>
                                     <input type="hidden"   name="department_id" value="<?php echo $user->department_id; ?>">
                                  </div>
                              </div> 

                            <?php endif;?>

                               
                        </div>




                         
                          
                      
                </div>
              </div>




                <div class="panel panel-default list-panel">
                    <div class="panel-heading">
                        <h2>Select User Role</h2>
                        <div class="panel-ctrls">

                        </div>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="form-group">
                           

                                <select class="col-md-offset-4 col-md-4 " name="role_ID" id="roleID">
                                    <?php if($user->role_ID !=false):?>
                                        <?php foreach ($roles as $rol) {
                                            if($rol->role_ID==$user->role_ID){
                                                $user_role=$rol;
                                            }
                                        }?>
                                        <option value="<?=$user_role ->role_ID;?>"><?=$user_role->role_name;?></option>
                                        <?php foreach ($roles as $role):?>
                                            <?php if($role->role_name != $user_role->role_name):?>
                                            
                                            
                                                <option value="<?=$role->role_ID;?>"><?=$role->role_name;?></option>

                                            <?php endif;?>

                                           
                                        <?php endforeach;?>
                                    <?php else:?>
                                        <option>Select User Role</option>

                                        <?php foreach ($roles as $role):?>
                                            
                                            
                                                <option value="<?=$role->role_ID;?>"><?=$role->role_name;?></option>

                                           
                                        <?php endforeach;?>
                                    <?php endif;?>

                                    
                                    
                                            

                                       
                                </select>
                        </div>
                    </div>
                </div>
               
            </div>
              
       
    </div>
</div>
<div class="text-center"><br><br>
    <?php if($user->login_status==0):?>
    <input type="submit" value="Activate User" class="btn btn-success btn-lg">
    <?php else:?>
         <input type="submit" value="Assign Role" class="btn btn-success btn-lg">
    <?php endif;?>

</div>

 </form>

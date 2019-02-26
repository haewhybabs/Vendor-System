         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Update <?=$user->firstname;?> Account</h6>
                   </div>
                <div class="panel-body bg-white">
                <div class="col-sm-12">
                     <?php
             if ($this->session->userdata('error') <> '') {
                echo '<div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("error") . '</p>
                    </div>';
            }
             if ($this->session->userdata('message') <> '') {
                echo '<div class="alert alert-dismissable alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("message") . '</p>
                    </div>';
            }
        ?>
                </div>

                         <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Users/update_user_action') ?>">
                          <input type="hidden" value="<?=$user->id?>" name="id">
                        <div class="row">
                           
                        
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Full name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control form-white" name="firstname" value="<?php echo $user->firstname; ?>" disabled="">
                                </div>
                            </div>

                              <div class="col-lg-6">     
                                  <div class="form-group">
                                     <label for="exampleInputPassword1">Email Address <span class="text-danger">*</span></label>
                                     <input type="text" class="form-control form-white"  name="email" value="<?php echo $user->email; ?>" disabled="">
                                  </div>
                              </div> 
                        </div>


                        <div class="row">
                          
                        
                           
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Staff ID <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control form-white"  name="staff_id" value="<?php echo $user->staff_id; ?>">
                                </div>
                            </div>


                          
                              <br>
                            <div class="col-lg-4" style="margin-top: 5px;">
                              <div class="form-group">
                                  <select class="form-control" name="department">
                                    <?php if($user->dept_name !=false){
                                      echo '<option value="'.$user->id.'">'.$user->dept_name.'</option>' ;

                                    }?>
                                    <?php foreach ($department as $d):?>
                                      <?php if($d->dept_name !=$user->dept_name):?>

                                    <option value="<?=$d->id;?>"><?=$d->dept_name;?></option>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                    
                                  </select>
                                
                              </div>
                            </div>

                               
                            



                               <div class="col-lg-4" style="margin-bottom:5px;">     
                                  <div class="form-group">
                                     <label for="exampleInputPassword1">User Role<span class="text-danger">*</span></label>
                                     <input type="text" class="form-control form-white"  name="name" value="<?php echo $user->role_name; ?>" disabled>
                                  </div>
                              </div> 
                        </div>




                         
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="Update User">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>

         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE USER</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('users/create_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                 <span class="text-danger"><?php echo form_error('department'); ?></span>
                                <select class="form-control"  name="department" id="category">
                                  <?php foreach($department as $docs){?>
                                    <option value="<?= $docs->id; ?>"><?= $docs->dept_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              </div> 
                                
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                 <span class="text-danger"><?php echo form_error('email'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
                              </div>
                              </div>
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">First name</label>
                                 <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="First name" name="first_name" value="<?php echo set_value('first_name'); ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Last name</label>
                                 <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Last name" name="last_name" value="<?php echo set_value('last_name'); ?>">
                              </div>
                              </div>  
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Role <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('admin_cat'); ?></span>
                                <select class="form-control"  name="admin_cat" id="category">
                                 <option value=" " selected>Role Type</option>
                                <?php foreach($roles as $rol){
                                    if($rol->role_name != 'Super Admin'){?>
                                    <option value="<?= $rol->role_ID; ?>"><?= $rol->role_name; ?></option>
                                  <?php }} ?>
                                </select>
                                </div>
                              </div>
    
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="ADD USER">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


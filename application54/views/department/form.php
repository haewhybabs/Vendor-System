         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE NEW DEPARTMENT</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('department/create_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Department <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('department_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Department name" name="department_name" value="<?php echo set_value('department_name'); ?>">
                              </div>
                              </div> 
                               
                               <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Department Email <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('dept_email'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Department email" name="dept_email" value="<?php echo set_value('dept_email'); ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">HOD Email <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('hod_email'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="HOD email" name="hod_email" value="<?php echo set_value('hod_email'); ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Technical Email (If available)</label>
                                <input type="text" class="form-control form-white" placeholder="Technical email" name="t_email" value="<?php echo set_value('t_email'); ?>">
                              </div>
                              </div> 
                               
                               <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Head of Technical Email (If available)</label>
                                <input type="text" class="form-control form-white" placeholder="Head technical email" name="tec_email" value="<?php echo set_value('tec_email'); ?>">
                              </div>
                              </div>
                               
                               
                                
                            <!--div class="col-lg-6">
                            <div class="form-group">
                             <label for="exampleInputPassword1">Right &amp; Privileges <span style="color:red">( * Minimum of 1)</span></label>
                              <span class="text-danger"><?php echo form_error('activities[]'); ?></span>
                              <div class="input-group">
                                <div class="icheck-list">
                                  <?php foreach($activities_data as $cat){?>
                                    <label>
                                     <input type="checkbox" data-checkbox="icheckbox_square-blue" name="activities[]" value="<?= $cat->id; ?>" ><?= $cat->activity_name ?>
                                     </label> 
                                <?php } ?>
                              </div>
                                   </div>
                            </div>
    
                            </div-->
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="CREATE DEPARTMENT">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


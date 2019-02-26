         
          <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE A ROLE</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('roles/create_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Role<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Role name" name="name" value="<?php echo set_value('name'); ?>">
                              </div>
                              </div> 
                               
                              
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="CREATE ROLE">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


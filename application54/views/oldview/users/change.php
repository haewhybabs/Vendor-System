         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CHANGE PASSWORD</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('users/update_action') ?>">
                      
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Old Password</label>
                                 <span class="text-danger"><?php echo form_error('o_pass'); ?></span>
                                <input type="password" class="form-control form-white" placeholder="Old password" name="o_pass">
                              </div>
                              </div> 
                              
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                 <span class="text-danger"><?php echo form_error('n_pass'); ?></span>
                                <input type="password" class="form-control form-white" placeholder="New password" name="n_pass" >
                              </div>
                              </div>  
    
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="CHANGE PASSWORD">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">REJECTION MESSAGE FOR <?= $supplier_name ?></h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('vendor/reject_action') ?>">
                      
                           <input type="hidden" value="<?= $supplier_data->supplier_id ?>" name="supplier_id">
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Company name <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control form-white" placeholder="Director Full name" name="name" value="<?php echo $supplier_name; ?>" disabled>
                              </div>
                        </div>
                          <div class="col-lg-6">     
                              <div class="form-group">
                                <label for="exampleInputPassword1">Subject</label>
                                <input type="text" name="subject" class="form-control form-white" placeholder="subject" value="<?php echo set_value('subject'); ?>">
                              </div>
                              </div> 
                          <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">Content</label>
                      <textarea name="content" class="form-control form-white"><?php echo set_value('content'); ?></textarea>
                      
                    </div>
                  </div>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="SEND REJECT">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>

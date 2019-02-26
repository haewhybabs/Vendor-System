 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
          
                   
          <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE A VENDOR SERVICE</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('anouncement/edit_action') ?>">
                       <input type="hidden" name="id" value="<?php echo $set_data->id; ?>">
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Title/Summary <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('title'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Service name" name="title" value="<?php echo $set_data->summary; ?>">
                              </div>
                              </div> 
                              
                             
                              
                              <div class="col-lg-12">
                                <div class="form-group">
                                <label>Content <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('content'); ?></span>
                                    <textarea class="form-control form-white" placeholder="Content" name="content" rows="10"><?php echo $set_data->content; ?>
                                    </textarea>
                                </div>
                              </div>
            
                           <div class="col-lg-12">
                                <input type="submit" class="btn btn-success" value="UPDATE VENDOR ANNOUNCEMENT">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
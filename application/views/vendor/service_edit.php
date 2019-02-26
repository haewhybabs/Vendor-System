 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
          
                   
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">EDIT SERVICE</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('category/edit_action') ?>">
                           <input type="hidden" name="edit_id" value="<?php echo $edit->id; ?>">
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Specialty name</label>
                                 <span class="text-danger"><?php echo form_error('service_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Service name" name="service_name" value="<?php echo $edit->category; ?>">
                              </div>
                              </div> 
                              
                               <div class="col-lg-6">
                                <div class="form-group">
                                <label>Specialty Type <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('admin_cat'); ?></span>
                                <select class="form-control"  name="admin_cat" id="category">
                                 <option value=" " selected>Type</option>
                                 <option value="1"  <?php if($edit->service_type == 1){ echo 'selected';}?> >Technical</option>
                                  <option value="0" <?php if($edit->service_type == 0){ echo 'selected';}?> >Non Technical</option>
                                
                                </select>
                                </div>
                              </div>
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Department Abbreviation<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('short'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Department Abbreviation" name="short" value="<?php echo $edit->short; ?>">
                                </div>
                              </div>
            
                           <div class="col-lg-12">
                                <input type="submit" class="btn btn-success" value="EDIT">
                                 <a href="<?= site_url('category');?>" class="btn btn-danger">Cancel</a>
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">EDIT <?= strtoupper($supplier_data->company_name);?></h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('vendor/edit_action') ?>">
                          <input name="id" type="hidden" value="<?= $supplier_data->supplier_id; ?>">
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Vendor name</label>
                                 <span class="text-danger"><?php echo form_error('name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Name" name="name" value="<?php echo $supplier_data->company_name; ?>">
                              </div>
                              </div> 
                               
                               <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Vendor Email</label>
                                 <span class="text-danger"><?php echo form_error('email'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Email" name="email" value="<?php echo $supplier_data->email; ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Vendor Phone</label>
                                 <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Phone" name="phone" value="<?php echo $supplier_data->primary_phone; ?>">
                              </div> 
                        </div>
                           
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="UPDATE VENDOR">
                                <a href="<?= site_url('vendor/pending');?>" class="btn btn-danger">Cancel</a>
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


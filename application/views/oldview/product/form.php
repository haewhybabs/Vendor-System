         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE PRODUCT</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('products/create_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Requisition Category</label>
                                 <span class="text-danger"><?php echo form_error('cat'); ?></span>
                                <select class="form-control"  name="cat" id="category">
                                  <?php foreach($activities_data as $docs){?>
                                    <option value="<?= $docs->id; ?>"><?= $docs->category; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                        </div>
                     
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Product name</label>
                                 <span class="text-danger"><?php echo form_error('name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Product name" name="name" value="<?php echo set_value('name'); ?>">
                              </div>
                              </div> 
                              
                             
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="CREATE PRODUCT">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


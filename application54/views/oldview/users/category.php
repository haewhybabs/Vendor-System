         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CHANGE CATEGORY</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('profile/category_action') ?>">
                      <?php $sup = explode(',', $supplier_data->specialty);?>
                                <div class="col-lg-6">
                            <div class="form-group">
                             <label for="exampleInputPassword1">Company Categories <span style="color:red">( * Maximum of 2)</span></label>
                              <span class="text-danger"><?php echo form_error('specialty[]'); ?></span>
                              <div class="input-group">
                                <div class="icheck-list">
                                  <?php foreach($category_data as $cat){?>
                                    <label>
                                     <input type="checkbox" data-checkbox="icheckbox_square-blue" name="specialty[]" value="<?= $cat->id; ?>" <?php if(in_array($cat->id, $sup)){ echo 'checked';} ?>><?= $cat->category ?>
                                     </label> 
                                <?php } ?>
                              </div>
                                   </div>
                            </div>
    
                            </div>

                               
                               
                             <div class="col-lg-6">
                              
                              </div>  
    
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="UPDATE COMPANY CATEGORY">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


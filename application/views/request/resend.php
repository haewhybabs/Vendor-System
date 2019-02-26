     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">REQUEST FOR QUOTE</h6>
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
                <?php
                 
                    ?>
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>S/N</th>
                           <th>Product</th>
                            <th>Specification</th>
                             <th>Quantity</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                         <?php   
                          $num= 1;
                        foreach($list as $li){?>
                        <tr>
                          <td><?= $num; ?></td>
                          <td><?= $li->name; ?></td>
                          <td><?= $li->specification; ?></td>
                             <td><?= $li->quantity; ?></td>
                        </tr>
                        <?php $num++; } ?>
                      </tbody>
                     
                    </table>
                     <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('request/resend_action') ?>">
                       <div id="planContainer">
                            <input type="hidden" name="rev_id" value="<?= $req_list->id; ?>">
                             
                              <div class="col-lg-8">
                            <div class="form-group">
                             <label for="exampleInputPassword1">Select Companies for Quotes <span style="color:red">(* Maximum of 4)</span></label>
                              <span class="text-danger"><?php echo form_error('company[]'); ?></span>
                              <div class="input-group">
                                <div class="icheck-list">
                                  <?php foreach($vendor_list as $cat){?>
                                    <label>
                                     <input type="checkbox" <?php foreach($vendor as $v){if($cat->supplier_id == $v->vendor_id){ echo 'checked';}} ?> data-checkbox="icheckbox_square-blue" name="company[]" value="<?= $cat->supplier_id; ?>" ><?= $cat->company_name; ?>
                                     </label> 
                                <?php } ?>
                              </div>
                                   </div>
                            </div>
    
                            </div>
                              
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label for="exampleInputPassword1">Submission Date<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('date_submission'); ?></span>
                                <div class="prepend-icon">
                                  <input type="text" name="date_submission" class="b-datepicker form-control form-white" placeholder="Select date.." value="<?php echo set_value('date_submission'); ?>">
                                  <i class="icon-calendar"></i>
                                </div>
                              </div> 
                            </div>  
                             
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="exampleInputPassword1">Message to Vendors <span class="text-danger">*</span></label>
                                  <span class="text-danger"><?php echo form_error('summary'); ?></span>
                                  <textarea  class="form-control form-white" placeholder="Notes to vendors" rows="6" name="summary" ><?php echo set_value('summary'); ?></textarea>
                              </div>      
                            </div>
                                  
                    </div>
    
                          <br>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="Re-Assign Quote Request">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


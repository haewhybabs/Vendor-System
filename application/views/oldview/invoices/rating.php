         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE A DEPARTMENT</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('invoices/rating_action') ?>">
                      <input type="hidden" name="sup_id" value="<?= $supplier_id; ?>">
                             <input type="hidden" name="id" value="<?= $id; ?>">
                              <input type="hidden" name="rid" value="<?= $req_id; ?>">
                
                              <div class="col-lg-12">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Rating <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('rate'); ?></span>
                                <select class="form-control"  name="rate" id="category">
                                   <option value=" ">Rate Vendor</option>
                                    <option value="Poor">Poor</option>
                                      <option value="Fair">Fair</option>
                                        <option value="Good">Good</option>
                                          <option value="Excellent">Excellent</option>
                                </select>
                              </div>
                              </div> 
                               
                               <div class="col-lg-12">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Comments <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('comment'); ?></span>
                                  <textarea class="form-control form-white" placeholder="Comments on supply" name="comment" rows="5"></textarea>
                              </div>
                              </div> 
                               
                           
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="RATE VENDOR">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


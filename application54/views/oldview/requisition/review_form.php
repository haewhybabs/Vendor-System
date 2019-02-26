     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">REVIEW REQUISITION</h6>
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
                    <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/review_action') ?>">
                     <input type="hidden" name="req_id" value="<?= $req_id; ?>">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th style="width:30%">Product</th>
                          <th style="width:10%">Quan</th>
                            <th style="width:60%">Specifications</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($req_list as $list){?>
                        <tr>
                    <input type="hidden" name="rev_id[]" value="<?= $list->id; ?>">
                    <td style="width:30%"> <input type="text" class="form-control form-white" placeholder="Product" name="product[]" value="<?= $list->name; ?>"></td>
                    <td style="width:10%"> <input type="text" class="form-control form-white" placeholder="Quantity" name="quantity[]" value="<?= $list->quantity; ?>"></td>
                    <td style="width:60%"> <textarea class="form-control form-white" placeholder="Specifications" rows="2" name="spec[]" required><?= $list->specification; ?></textarea></td>
                    </tr>
                     <?php }?>
                      </tbody>      
             </table>
               <div class="form-group">
                                <label for="exampleInputPassword1">Add Comments on Review <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('comment'); ?></span>
                                  <textarea class="form-control form-white" placeholder="comment" name="comment" rows="5" required><?php set_value('comment'); ?></textarea>
                    </div>
                    
                     <!--div class="col-lg-6">
                            <div class="form-group">
                              <label>Query Destination <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('destination'); ?></span>
                                <select class="form-control" name="destination" id="category" required> 
                                         <option value="1">Req. Department</option> 
                                         <option value="2">Req. Departmental Head</option> 
                                          <option value="3">Store</option>
                                           <option value="5">Technical Head</option>
                                            <option value="6">Administrator</option> 
                                             <option value="7">Procurement</option> 
                                             <option value="8">Budget Control</option>  
                                              <option value="9">Procurement Committee</option>  
                                               <option value="10">SAP</option> 
                                               <option value="11">Forensic</option>  
                                               <option value="12">Final Approval</option>       
                                </select>
                                </div>
                            </div-->
                            
                    <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="REVIEW REQUISITION">
                                 <a href="<?= site_url('requisition/review_service'); ?>" class="btn btn-danger btn-sm" > Cancel</a>
                           </div>
               </form>
                </div>
              </div>
            </div>
              </div>
</div>
 
     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">PO QUERY</h6>
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
                    
                     <table class="table table-bordered" >
                      <thead>
                        <tr>
                        <th style="width:20%">Vendor</th>
                         <th style="width:20%">Product/Service</th>
                              <th style="width:40%">Specification</th>
                              <th style="width:10%">Quantity</th>
                              <th style="width:10%">Price</th>
                          </tr>
                      </thead>
                </table>
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('rp/query_action') ?>">
                      <input type="hidden" name="req_id" value="<?= $req_id; ?>">
                      <?php foreach($req_list as $list){?>
                      
                      <table class="table table-bordered">
                      <tbody>
                        <tr>
                        <td style="width:20%"> <input type="text" class="form-control form-white" placeholder="Vendor" name="com[]" value="<?php echo $list->company_name; ?>" disabled></td>
                        <td style="width:20%"> <input type="text" class="form-control form-white" placeholder="Product/Service" name="product[]" value="<?php echo $list->name; ?>" disabled></td>
                    <td style="width:40%"> <textarea class="form-control form-white" placeholder="Specifications" rows="2" name="spec" disabled><?= $list->specification; ?></textarea></td>
                    <td style="width:10%"> <input type="text" class="form-control form-white" placeholder="Quantity" name="quantity" value="<?= $list->quantity; ?>" disabled></td>
                       <td style="width:10%"> <input type="text" class="form-control form-white" placeholder="Price" name="price[]" value="<?php echo $list->price; ?>" disabled></td>
                        </tr>
                      </tbody>      
                     </table>
                        <?php }?>
                            
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Query Comment</label>
                                  <textarea class="form-control form-white" placeholder="Comments" name="comment" rows="5" required></textarea>
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                            <div class="form-group">
                              <label>Query Destination <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('destination'); ?></span>
                                <select class="form-control" name="destination" id="category" required>
                                         <option value="1">Departmental Head</option> 
                                          <option value="2">Store</option>
                                           <option value="3">Technical Head</option>
                                            <option value="4">Administrator</option>   
                                             <!--option value="5">SAP</option-->          
                                </select>
                                </div>
                            </div>
                              
                          <br>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="QUERY REQUISITION">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
 
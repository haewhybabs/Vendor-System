 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
           <div class="row">
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
            <style>
               .modal-backdrop {
                display:none;
               }
            </style>
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>EDIT REQUISITION</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Product</th>
                           <th>Specification</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                            ?>
                        <tr>
                          <td><?= $vendor->product_service; ?></td>
                          <td><?= $vendor->specification; ?></td> 
                            <td>
                            <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/edit_action') ?>">
                              <input type="hidden" name="req_id" value="<?= $req_id; ?>">
                              <input type="hidden" name="id" value="<?= $vendor->id; ?>">
                              
                             <div class="col-lg-4">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Quantity (If applicable)</label>
                                <input type="text" class="form-control form-white" placeholder="Quantity" name="quantity" value="<?php echo $vendor->quantity; ?>">
                              </div>
                              </div> 
                           <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" value="Edit">
                           </div>
                            
                          </form>
                           <div class="col-sm-2">
                                <form method="post" action="<?= site_url('requisition/delete_action') ?>">
                                <input type="hidden" name="req_id" value="<?= $req_id; ?>">
                               <input type="hidden" name="id" value="<?= $vendor->id; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete">
                               </form>
                           </div>
                            </td>
                        
                        </tr>
                         <?php } ?>
                      </tbody>
                     
                    </table>
                    
                    <a href="<?= site_url('requisition/confirm/'.$req_id); ?>" class="btn btn-primary">Confirm For Final Approval</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
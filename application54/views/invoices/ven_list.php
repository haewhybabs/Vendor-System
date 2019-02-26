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
                  <h3><i class="fa fa-table"></i> <strong>VENDOR INVOICE FOR <?php echo $rfp; ?></strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Vendor</th>
                          <th>Status</th>
                          <th>Rating Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>        
                      <?php foreach($cat_list as $index => $docs){
                                    foreach($docs as $k => $v){
                                    if($v->accept_status==0){
                                      $status='<span class="text-warning">Pending</span>';  
                          }
                            if($v->accept_status == 1){
                             $status='<span class="text-success">Accepted</span>';  
                          }
                            if($v->accept_status == 2){
                             $status='<span class="text-danger">Rejected</span>';  
                          }
                          if($v->rate_status == 0){
                             $rstatus='<span class="text-danger">Not rated</span>';  
                          }
                            if($v->rate_status == 1){
                             $rstatus='<span class="text-success">Rated</span>';  
                          }?>
                        <tr>
                          <td><?= $v->company_name; ?></td>
                           <td> <?= $status; ?></td>
                           <td> <?= $rstatus; ?></td>
                          <td>
                              <?php if($v->accept_status == 1){?>
                             <a href="http://procure.lfcww.org/uploads/invoice/<?= $v->invoice; ?>"  target="_blank" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> View Uploaded Invoice</a>
                             <?php if($v->rate_status == 0){?>
                             <form method="post" action="<?= site_url('invoices/rating'); ?>" style="display:inline;">
                                 <input type="hidden" name="sup_id" value="<?= $v->supplier_id; ?>">
                                 <input type="hidden" name="id" value="<?= $v->id; ?>">
                                  <input type="hidden" name="rid" value="<?= $req_id; ?>">
                                 <input type="submit" class="btn btn-sm btn-warning" value=" Rate Vendor">
                             </form>
                            
                             <?php }}else{?>
                             <span class="text-danger">No invoice upload</span>
                             <?php }  ?>
                          </td>
                         </tr>
                        <?php }} ?>
                      </tbody>
                     
                    </table>
                  </div>
                  <a href="<?= site_url('purchase_order') ?>" class="btn btn-primary btn-sm">Back to Purchase Order</a>
                </div>
              </div>
            </div>
          </div>
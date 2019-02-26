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
                  <h3><i class="fa fa-table"></i> <strong>PURCHASE ORDER</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Dept</th>
                           <th>PO No.</th>
                             <th>Status</th>
                            <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                             $no=1;
                             if($vendor->po_sent == 0){
                             $status='<span class="text-warning">Not send</span>';  
                          }
                            if($vendor->po_sent == 1){
                             $status='<span class="text-success">PO Sent</span>';  
                          }
                           
                          $date = strtotime($vendor->rp_treated);
                            ?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                          <td><?= $vendor->po_number; ?></td>
                              <td><?= $status; ?></td>
                            <td><?= date('Y-m-d', $date); ?></td>
                           <td style="style:width:58%">
                         <a href="<?= site_url('purchase_order/vendor/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-edit"></span> View Vendors</a> 
                         <?php  if($vendor->po_sent == 0){ ?>
                        <a href="<?= site_url('purchase_order/send/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-thumbs-up"></span> Send PO</a>
                        <?php }else{?>
                         <a href="<?= site_url('purchase_order/send/'.$vendor->id); ?>" class="btn btn-warning btn-sm" ><span class="fa fa-thumbs-up"></span> Resend PO</a>
                       <?php } ?>
                        </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>  
                          
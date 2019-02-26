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
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>SUPPLY RATINGS FOR <?= strtoupper($supplier_name); ?></strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                           <th>Product</th>
                             <th>Rating</th>
                             <th>Date</th>
                             <th>Comment</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($vendor_list as $vendor){?>
                        <tr>
                            <td><a href="<?= site_url('vendor/upload/').$vendor->invoice_id; ?>"  target="_blank" class="btn btn-success btn-sm"><span class="fa fa-book"></span> Supplied Product Invoice</a></td>
                            <td><?= $vendor->supply_rating; ?></td>
                              <td><?= $vendor->date_time; ?></td>
                             <td>   <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-store<?= $vendor->supplier_id; ?>"><span class="fa fa-edit"></span> View Comments</a>
                        </td>
                              
                          <div class="modal fade" id="modal-store<?= $vendor->supplier_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title"><strong>Comments</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                       <div class="row">
                           <p><?= $vendor->comment;?></p>
                       </div>
                      
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                  <a href="<?= site_url('vendor/approve_list'); ?>" class="btn btn-sm btn-primary">Back to vendor list</a>
                </div>
              </div>
            </div>
          </div>
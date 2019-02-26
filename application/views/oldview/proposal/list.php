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
                  <h3><i class="fa fa-table"></i> <strong>Requested Proposal</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th class="hidden">S/N</th>
                           <th>Equipment Category</th>
                            <th>RFP No.</th>
                            <th>Submission Date</th>
                            <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                          $num=0;
                        foreach($list as $vendor){
                            ?>
                        <tr>
                        <td class="hidden"><?= $num; ?></td>
                          <td><?= $vendor->category; ?></td>
                            <?= $vendor->rfp_number; ?>
                            <td><?= $vendor->end_date; ?></td>
                            <td>
                                <?php if( $vendor->sent_quotation == 0){?>
                                 <span class="text-warning">Awaiting Uploaded</span>
                                 <?php }else{?>
                               <span class="text-success">Uploaded</span>
                           <?php } ?>
                            </td>
                           <td>
                            <a href="<?= site_url('quotes/download/'.$vendor->id); ?>" class="btn btn-primary btn-sm"><span class="fa fa-download"></span> Download RFP</a>
                             <?php if( $vendor->sent_quotation == 0){?>
                                <a href="<?= site_url('quotes/upload/'.$vendor->id); ?>" class="btn btn-primary btn-sm"><span class="fa fa-upload"></span> Upload Proposal</a>
                           <?php }?>    
                          </td>
                    
                        </tr>
                        <?php $num++;} ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
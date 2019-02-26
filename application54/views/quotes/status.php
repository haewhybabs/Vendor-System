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
                  <h3><i class="fa fa-table"></i> <strong>Requested Quotations</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th class="hidden">S/N</th>
                           <th>Equipment Category</th>
                            <th>RFQ No.</th>
                            <th>Submission Date</th>
                            <th>Uploaded Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                          $num=0;
                        foreach($list as $vendor){
                            if($vendor->accept_quotation == 0){
                                 $status ='<span class="text-warning">Under Review</span>';
                             }
                            if($vendor->accept_quotation == 1){
                                 $status ='<span class="text-success">Accepted</span>';
                             }
                            if($vendor->accept_quotation == 2){
                                 $status = '<span class="text-danger">Rejected</span>';
                             }
                            
                            ?>
                        <tr>
                        <td class="hidden"><?= $num; ?></td>
                          <td><?= $vendor->category; ?></td>
                            <td><?= strtoupper($vendor->rfp_number); ?></td>
                            <td><?= $vendor->end_date; ?></td>
                            <td><?= $vendor->submission_date; ?></td>
                           <td>
                            <?= $status; ?>    
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
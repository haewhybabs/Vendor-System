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
                  <h3><i class="fa fa-table"></i> <strong>Received Quotes</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Rfq</th>
                           <th>Category</th>
                           <th>Status</th>
                            <th>Deadline</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                         foreach($req_list as $vendor){
                          $date = strtotime($vendor->date_added);
                            if($vendor->quote_status == 0){
                            $status='<span class="text-danger">Not sent</span>';  
                          }
                         if($vendor->quote_status == 1){
                            $status='<span class="text-success">Sent</span>';  
                          }
                            ?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                           <td><?= $vendor->rfp_no; ?></td>
                          <td><?= $vendor->category; ?></td>
                           <td><?= $status; ?></td>
                            <td><?= date('Y-m-d', $date); ?></td>
                           <td>
                             <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic<?= $vendor->id; ?>"><span class="fa fa-eye"></span> Requisition</a>
                             <?php  if($vendor->quote_status == 1){?>
                            <a href="<?= site_url('quotes/assign/'.$vendor->id); ?>" class="btn btn-warning btn-sm" ><span class="fa fa-eye"></span> Vendor Quotes</a>
                         <?php } ?>  
                            
                          </td>
                    <div class="modal fade" id="modal-basic<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title"><strong>Requisition Lists</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                       <div class="row">
                           <div class="col-sm-1">S/N</div>
                              <div class="col-sm-4">Product</div>
                               <div class="col-sm-6">Specifications</div>  
                                <div class="col-sm-1">Quantity</div>
                       </div>
                       <?php $num=1; foreach($list as $li) {
                              if($vendor->id == $li->req_id){
                             ?>
                          <div class="row">
                           
                           <div class="col-sm-1"><?= $num; ?></div>
                              <div class="col-sm-4"><?= $li->name; ?></div>
                               <div class="col-sm-6"><?= $li->specification; ?></div>  
                                <div class="col-sm-1"><?= $li->quantity; ?></div>  
                          </div>  
                           <?php $num++; }} ?> 
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
                </div>
              </div>
            </div>
          </div>
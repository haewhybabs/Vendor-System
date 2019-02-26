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
                  <h3><i class="fa fa-table"></i> <strong>Pending Lists</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Rfq</th>
                           <th>Category</th>
                          <th>deadline</th>
                          <th>No of Requested Quote</th>
                          <th>No of Submitted Quote</th>
                          <th>Budget Reference</th>
                          <th>History</th>
                          <th>View</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php     
                           $y=1;   
                         foreach($req_list as $vendor):?>
                        <tr>
                          <td style="width: 10px;"><?= $vendor->dept_name; ?></td>
                           <td style="width: 10px;">PO/LF/000<?= $vendor->rfq_ID; ?></td>
                          <td style="width: 10px;"><?= $vendor->category; ?></td>
                          <td><?=$vendor->deadline;?></td>
                          <td style="width: 10px;">
                            <?php $x=0;?>
                            <?php foreach ($get_count as $count) {
                              if ($count->rfq_ID==$vendor->rfq_ID){
                                $x=$x+1;
                              }
                            }?>

                                  

                            <a href="<?= site_url('quotes/view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td>
                          <td style="width: 10px;">
                             <?php $x=0;?>
                            <?php foreach ($count_submit as $submit) {
                              if ($submit->rfq_ID==$vendor->rfq_ID){
                                $x=$x+1;
                              }
                            }?>


                            <a href="<?= site_url('quotes/submit_view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td>
                            <td style="width: 12px;"><?=$vendor->budget_reference;?></td>
                            <td style="width: 12px;"> <a href="<?= site_url('Requisition/Activity_history/'.$vendor->req_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span>View</a></td>
                            <td><a href="<?= site_url('quotes/sheet_procure/'.$vendor->rfq_ID); ?>" class="btn btn-default btn-sm" ><span class="fa fa-eye"></span>View</a></td>
                           <td>
                            
                                
                               
                           
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myMod<?=$y;?>">Recommend</button>

                                <div id="myMod<?=$y;?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">forensic/FORENSIC Approve</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form action="<?=base_url('Forensic/approve');?>" method="POST">
                                        <input type="hidden" name="req_id" value="<?=$vendor->req_ID;?>">
                                          <input type="hidden" name="rfq_id" value="<?=$vendor->rfq_ID;?>">
                                        <div class="form-group">
                                          <label for="comment">Comment</label>
                                          <input type="text" class="form-control" id="comment" name="comment">
                                        </div>

                                         <button type="submit" class="btn btn-default">Submit</button>
                                      </form>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            
                             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?=$y;?>">Not Recommended</button>


                              <div id="myModal<?=$y;?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Forensic Disapprove</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form action="<?=base_url('forensic/reject');?>" method="POST">
                                        <input type="hidden" name="req_id" value="<?=$vendor->req_ID;?>">
                                          <input type="hidden" name="rfq_id" value="<?=$vendor->rfq_ID;?>">
                                        <div class="form-group">
                                          <label for="comment">Comment</label>
                                          <input type="text" class="form-control" id="comment" name="comment">
                                        </div>

                                         <button type="submit" class="btn btn-default">Submit</button>
                                      </form>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            
                          </td>
                    
                        </tr>
                        <?php $y++; 
                      endforeach; ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-lg-12 portlets"><br><br>
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Attended Lists</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Rfq</th>
                           <th>Category</th>
                          <th>deadline</th>
                          <th>No of Requested Quote</th>
                          <th>No of Submitted Quote</th>
                          <th>Status</th>
                          <th>Budget Reference</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php   $k=0;     
                         foreach($attended as $vendor):?>
                        <tr>
                          <td style="width: 10px;"><?= $vendor->dept_name; ?></td>
                           <td>PO/LF/000<?= $vendor->rfq_ID; ?></td>
                          <td style="width: 15px;"><?= $vendor->category; ?></td>
                          <td><?=$vendor->deadline;?></td>
                          <td style="width: 10px;">
                            <?php $x=0;?>
                            <?php foreach ($get_count as $count) {
                              if ($count->rfq_ID==$vendor->rfq_ID){
                                $x=$x+1;
                              }
                            }?>

                                  

                            <a href="<?= site_url('quotes/view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td>
                          <td style="width: 10px;">
                             <?php $x=0;?>
                            <?php foreach ($count_submit as $submit) {
                              if ($submit->rfq_ID==$vendor->rfq_ID){
                                $x=$x+1;
                              }
                            }?>


                            <a href="<?= site_url('quotes/submit_view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td></td>
                            <td> <?php if($vendor->approval_sheet_status =='0'){ echo 'Forensic Disapproved'; }else{echo 'Approved';}?>
                            </td>
                             <td><?=$vendor->budget_reference;?></td>
                           <td>
                            
                                <a href="<?= site_url('quotes/sheet_procure/'.$vendor->rfq_ID); ?>" class="btn btn-default btn-sm" ><span class="fa fa-eye"></span>View</a>
                                 <a href="<?= site_url('Requisition/Activity_history/'.$vendor->req_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span>History</a>
                                <?php if($vendor->approval_sheet_status=='6'):?>

                                <?php elseif($vendor->approval_sheet_status=='0' && $vendor->procure_forensic_status=='2'):?>
                           
                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#my<?=$k;?>">Recommend</button>

                                <div id="my<?=$k;?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">forensic/Forensic</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form action="<?=base_url('forensic/approve');?>" method="POST">
                                        <input type="hidden" name="req_id" value="<?=$vendor->req_ID;?>">
                                          <input type="hidden" name="rfq_id" value="<?=$vendor->rfq_ID;?>">
                                        <div class="form-group">
                                          <label for="comment">Comment</label>
                                          <input type="text" class="form-control" id="comment" name="comment">
                                        </div>

                                         <button type="submit" class="btn btn-default">Submit</button>
                                      </form>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            <?php endif;?>
                           
                          </td>
                    
                        </tr>

                        <?php $k++; endforeach; ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>









         



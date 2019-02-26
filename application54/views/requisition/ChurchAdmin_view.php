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
                  <h3><i class="fa fa-table"></i> <strong>Church Admin View</strong></h3>
                </div>

                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Activity History</button>
                            <div id="myModal2" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comments<h4>
                                </div>

                                <div class="modal-body">
                                  <?php foreach ($get_comments as $detaill):?> 
                                      <?php
                                                     if ($detaill->req_status_check_ID==1):
                                                      $x="Rejected By HOD";
                                                     elseif ($detaill->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        $x= "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        $x= "store has checked";
                                                   ?>
                                       <?php endif;?>

                                 
                                   <h3><?=$x;?></h3>
                                  
                                     <table class="table  table-dynamic table-tools" data-table-name="Total users">
                                        <thead>
                                          <tr>
                                               
                                                <th>Comment</th>
                                                <th>Response</th>
                                                 <th>Current Requisition Stage</th>
                                                 
                                          </tr>






                                          </thead>
                                          <tbody>
                                            <tr>
                                              
                                                <td>
                                                  <?php if($detaill->comments==false):?>
                                                     <?php $detaill->comments="No comment";?>
                                                  <?php endif;?>
                                                      <?=$detaill->comments;?>
                                                </td>

                                                <td>
                                                    <?php if($detaill->response==1):
                                                        echo "Concurred";
                                                      ?>
                                                    <?php else:
                                                      echo "Rejected";
                                                    endif;?>

                                                </td>
                                                   
                                                <td>
                                                   <?php
                                                      if ($detaill->req_status_check_ID==1):
                                                         echo "Rejected By HOD";
                                                      elseif ($detaill->req_status_check_ID==2):
                                                         echo "HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        echo "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        echo "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        echo "store has checked";
                                                   ?>
                                                  <?php endif;?>
                                                </td>
                                            </tr>


                                           </tbody>
                    
                                  </table>
                                <?php endforeach;?>

                                         
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                              <td class="hidden">S/N</td>
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               <th>Purpose</th>
                        </tr>






                      </thead>
                      <tbody>

                        <?php foreach ($detail_single as $detail):?>

  
                        <tr>
                          <td><?=$detail->name;?></td>
                             <td><?= $detail->product_specification;?></td>
                              <td><?= $detail->quantity;?>
                              </td>
                            <td><?=$detail->purpose;?></td>
                          
                        </tr>
                       <?php endforeach;?>
                       
                      </tbody>
                    
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <br>


               <div class="col-sm-12">
                <?php if ($detail->req_status_ID==3 || $detail->req_status_ID==2):?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Approve</button>
                      <div id="myModal1" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment for Approval by <?=$detail->firstname;?></h4>
                                </div>
                                <div class="modal-body">

                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/ChurchAdmin_approve') ?>">
                    
                                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                                       <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                                       <input type="hidden" name="req_status_check_ID" value="4">
                                       <input type="hidden" name="status_checked_by" value="<?=$detail->email;?>">
                                       <input type="hidden" name="response" value="1">
                                       
                                        <div class="form-group">
                                          <label for="pwd">Comment</label>
                                          <input type="text" class="form-control" name="comments">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>




              
                   
            
                 <?php // To Reject the Specification ?>
                      
                  
                  
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4">Reject</button>
                      <div id="myModal4" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment for Rejection by <?=$detail->firstname;?><h4>
                                </div>
                                <div class="modal-body">

                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/ChurchAdmin_reject') ?>">
                    
                                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                                       <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                                       <input type="hidden" name="req_status_check_ID" value="4">
                                       <input type="hidden" name="status_checked_by" value="<?=$detail->email;?>">
                                       <input type="hidden" name="response" value="0">
                                      
                                        <div class="form-group">
                                          <label for="pwd">Comment</label>
                                          <input type="text" class="form-control" name="comments">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>


                <?php endif;?> 
             


                       
                  </div>
                           
          	 	



          	 	
          	 </div>
          </div>



          
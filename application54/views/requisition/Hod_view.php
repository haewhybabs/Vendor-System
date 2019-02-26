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
                  <h3><i class="fa fa-table"></i> <strong>Derived Quotation Sheets</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                          <tr>
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               <th>Purpose</th>
                                 <?php foreach ($detail_single as $det):?>
                                 <?php endforeach;?>
                                  <?php if ($det->req_status_ID>1):?>
                                  <?php else:?>
                               <th>Edit Specification</th>
                                  <?php endif;?>
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
                            <?php if($detail->req_status_ID>1):?>
                            <?php else:?>
                            <td>

                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit Specification</button>
                         


                         <!-- Modal -->
                          <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"> Edit Product Specification</h4>
                                </div>
                                <div class="modal-body">
                                  <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/Hod_edit') ?>">
                                    <input type="hidden" name="req_detail_ID" value="<?=$detail->req_detail_ID;?>">
                                        <div class="form-group">
                                          <label for="email">Product Specification:</label>
                                          <input class="form-control" name="product_specification" value="<?=$detail->product_specification;?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="pwd">Quantity:</label>
                                          <input type="number" class="form-control" name="quantity" value="<?=$detail->quantity;?>">
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

                            </td>
                          <?php endif;?>
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
                <?php if ($detail->req_status_ID==1):?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Concur</button>
                      <div id="myModal1" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment for Approval by <?=$detail->firstname;?></h4>
                                </div>
                                <div class="modal-body">

                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/Hod_concur') ?>">
                    
                                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                                       <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                                       <input type="hidden" name="req_status_check_ID" value="2">
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
                      
                  
                  
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Reject</button>
                      <div id="myModal2" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment for Rejection by <?=$detail->firstname;?><h4>
                                </div>
                                <div class="modal-body">

                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/Hod_reject') ?>">
                    
                                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                                       <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                                       <input type="hidden" name="req_status_check_ID" value="2">
                                       <input type="hidden" name="status_checked_by" value="<?=$detail->email;?>">
                                       <input type="hidden" name="response" value="0">
                                      
                                        <div class="form-group">
                                          <label for="pwd">Comment</label>
                                          <input type="text" class="form-control" name="comments">
                                        </div>
                                        *
                                        <button type="submit" class="btn btn-default">Submit</button>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>


                       <?php else:?>


                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Activity History</button>
                            <div id="myModal2" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment <?=$detail->firstname;?><h4>
                                </div>

                                <div class="modal-body">
                                  <?php foreach ($get_comments as $detail):?> 
                                      <?php
                                                      
                                                     if ($detail->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($detail->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($detail->req_status_check_ID==4):
                                                        $x= "Church Administrator";
                                                      elseif ($detail->req_status_check_ID==5):
                                                        $x= "store has checked";
                                                   ?>
                                       <?php endif;?>

                                 
                                   <h3><?=$x;?>    Review</h3>
                                  
                                     <table class="table  table-dynamic table-tools" data-table-name="Total users">
                                        <thead>
                                          <tr>
                                                <td class="hidden">S/N</td>
                                                <th>Comment</th>
                                                <th>Response</th>
                                                 <th>Current Requisition Stage</th>
                                                 
                                          </tr>






                                          </thead>
                                          <tbody>
                                            <tr>
                                              
                                                <td>
                                                  <?php if($detail->comments==false):?>
                                                     <?php $detail->comments="Null";?>
                                                  <?php endif;?>
                                                      <?=$detail->comments;?>
                                                </td>

                                                <td>
                                                    <?php if($detail->response==1):
                                                        echo "Concurred";
                                                      ?>
                                                    <?php else:
                                                      echo "Rejected";
                                                    endif;?>

                                                </td>
                                                   
                                                <td>
                                                   <?php
                                                      if ($detail->req_status_check_ID==1):
                                                         echo "Rejected By HOD";
                                                      elseif ($detail->req_status_check_ID==2):
                                                         echo "HOD";
                                                     elseif ($detail->req_status_check_ID==3):
                                                        echo "Technical Review";
                                                      elseif ($detail->req_status_check_ID==4):
                                                        echo "Church Administrator";
                                                      elseif ($detail->req_status_check_ID==5):
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


















                <?php endif;?> 



                       
                  </div>
                           
          	 	



          	 	
          	 </div>
          </div>

         





          
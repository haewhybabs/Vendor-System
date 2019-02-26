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
                  <h3><i class="fa fa-table"></i> <strong>Technical Review</strong></h3>
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
                                                      
                                                     if ($detaill->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        $x= "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        $x= "store has checked";
                                                   ?>
                                       <?php endif;?>

                                 
                                   <h3><?=$x;?>    Review</h3>
                                  
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
                                                     <?php $detaill->comments="Null";?>
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
                             
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               <th>Purpose</th>
                                <?php foreach ($detail_single as $detail):?>
                                <?php endforeach;?>
                                <?php if ($detail->req_status_ID==2):?>
                                    <th>Edit Specification</th>
                                <?php else:?>
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
                            <?php if ($detail->req_status_ID==2):?>
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
                                  <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/Review_edit') ?>">
                                    <input type="hidden" name="req_detail_ID" value="<?=$detail->req_detail_ID;?>">
                                        <div class="form-group">
                                          <label for="email">Product Specification:</label>
                                          <input class="form-control" name="product_specification" value="<?=$detail->product_specification;?>"></input>
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
                             <?php else:?>
                           
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
                   



               
              
                   
            
                    <?php if($detail->req_status_ID==2):?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Review</button>
                         <div id="myModal1" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Technical Review by <?=$detail->firstname;?></h4>
                                </div>
                                <div class="modal-body">

                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Requisition/Review_granted') ?>">
                    
                                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                                       <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                                       <input type="hidden" name="req_status_check_ID" value="3">
                                       <input type="hidden" name="status_checked_by" value="<?=$detail->email;?>">
                                       <input type="hidden" name="response" value="1">
                                       
                                    <div class="well">
                                      Are you Sure You want to Accept this Requisition
                                    </div>
                                        
                                        
                                        <button type="submit" class="btn btn-default">Yes</button>
                                        <a href="" class="btn btn-default">No</a>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                
                    <?php else:?>
                    <?php endif;?>


                       
                  </div>
                           
          	 	



          	 	
          	 </div>
          </div>
          


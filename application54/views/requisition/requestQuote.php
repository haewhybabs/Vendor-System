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
                  <h3><i class="fa fa-table"></i> <strong>Send RfQ</strong></h3>
                </div>


                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Comments</button>
                            <div id="myModal2" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comments</h4>
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


           <?php if($detail_single==false):?>
                <div class="well">All the requisitions are available in store
                  
                </div>
           <?php else:?>
                <form class="form-inline"  role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Request/send_quote') ?>">
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                            
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               <th>Purpose</th>
                              
                        </tr>






                      </thead>
                      <tbody>
             
                        <?php $i=0;?>
                        

                        <?php foreach ($detail_single as $detail):?>
                           

  
                        <tr>
                          <td><?=$detail->name;?></td>
                             <td><?= $detail->product_specification;?></td>
                              <td><?= $detail->quantity;?>
                              </td>
                            <td><?=$detail->purpose;?></td>     
                        </tr>
                      
                           
                          <input type="hidden" name="req_detail_ID[<?=$i;?>]" value="<?=$detail->req_detail_ID;?>">
                          <input type="hidden" name="category_ID" value="<?=$detail->category_ID;?>">

                           <?php $i++;?> 
                       <?php endforeach;?>
                       
                      </tbody>

                    
                    </table>


                  </div>
                </div>

              </div>
                  <?php if($detail->process_status_ID==1):?>
                 
                       <input type="hidden" name="category_ID" value="<?=$detail->category_ID;?>">
                       <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                       
                        <div class="form-group">
                          <label for="deadline">Deadline</label>
                          <input type="text" class="form-control" name="deadline" placeholder="year/month/date 10/10/2001">
                        </div>
                        
                       
                               <table class="table  table-dynamic table-tools" data-table-name="Total users">
                                        <thead>
                                          <tr>
                                               
                                                <th>Company's Name</th>
                                                <th>Previous work done</th>
                                                 <th>Registration Number</th>
                                                 <th>Action</th>
                                                 
                                          </tr>






                                          </thead>
                                          <tbody>
                                        <?php if($getVendors==false):?>
                                             <div class="well">No Vendor Registered yet for this Category</div>
                                            
                                        <?php else:?>
                                           <?php $j=0;?>
                                          <?php foreach($getVendors as $vendors):?>
                                            <tr>
                                              
                                                <td><?=$vendors->company_name;?></td>

                                                <td><?=$vendors->work_done;?></td>
                                                <td><?=$vendors->registration_no;?></td>
                                                <td>
                                                   <input type="checkbox" class="form-control" name="vendor_ID[]" value="<?=$vendors->supplier_id;?>">
                                                </td>

                                            </tr>
                                            <?php $j++;?>
                                         <?php endforeach;?>
                                          </tbody>
                                  </table>

                        <button type="submit" class="btn btn-default">Send RFQ</button>
                       
                  
                   </form>
                            <?php endif;?>

                       
                  </div>

                <?php else:?>
                </tbody>
                  </table>
                 
               <?php endif;?>
            </div>
          </div>
        <?php endif;?>
          <br>
          <br>
       	 	
          	 </div>
          </div>
        </div>
  </form>
       

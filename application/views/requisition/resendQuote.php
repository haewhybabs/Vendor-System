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
                                                        $x= "store has checked";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        $x= "Church Administrator";
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
                                                        echo "Recommended";
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
                                                        echo "store has checked";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        echo "Church Administrator";
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
             

                <div class="panel-content">
                  <div class="filter-left">
                    
                   
                    <table class="table">
                      <thead>
                        <tr>
                            <!--  <td class="hidden">S/N</td> -->
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               
                              
                        </tr>






                      </thead>
                      <tbody>
             
                       
                        

                        <?php foreach ($detail_single as $detail):?>
                           

  
                        <tr>
                          <td><?=$detail->name;?></td>
                             <td><?= $detail->product_specification;?></td>
                              <td><?= $detail->quantity;?>
                              </td>
                             
                        </tr>
                           <?php $i=0;?>
                          
                           <?php $i++;?> 
                       <?php endforeach;?>
                       
                      </tbody>

                    
                    </table>


                  </div>
                </div>

              </div>
                 
                 
                      
                       
                        
                         
                         <form class="form-inline"  role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Request/send_quote') ?>">
                           <input type="hidden" name="category_ID" value="<?=$detail->category_ID;?>">
                           <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="text" class="b-datepicker form-control" name="deadline" placeholder="year/month/date 10/10/2001">
                            </div>
                            <br><br>
                       
                               <!-- <table class="table  table-dynamic table-tools" data-table-name="Total users"> -->
                                  <table class="table table-dynamic table-bordered table-striped" data-table-name="Total users" data-page-length='100'>
                                        <thead>
                                          <tr>
                                               <!-- <td class="hidden">S/N</td> -->
                                                <th>Company's Name</th>
                                                <th>Previous work done</th>
                                                 <th>Registration Number</th>
                                                 <th>Vendor Details</th>
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
                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4<?=$vendors->supplier_id;?>">View</button>


                                                  

                                                           
                                                              <div id="myModal4<?=$vendors->supplier_id;?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">

                                                                      <!-- Modal content-->
                                                                      <div class="modal-content">
                                                                        <div class="modal-header">
                                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                          <h4 class="modal-title"> Vendor Details<h4>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                           <table class="table table-striped" data-table-name="Total users">
                                                                             <thead>
                                                                              <tr>
                                                                                <th>Name</th>
                                                                                <th>Registration Number</th>
                                                                                <th>Email</th>
                                                                                <th>Address</th>
                                                                                <th>Phone</th>
                                                                              </tr>
                                                                               
                                                                             </thead>
                                                                             <tbody>
                                                                              <?php foreach ($getVendorsDetails as $key):
                                                                              if ($vendors->supplier_id==$key->supplier_id):
                                                                              ?>
                                                                                  <tr>
                                                                                    <td><?=$key->company_name;?></td>
                                                                                    <td><?=$key->registration_no;?></td>
                                                                                    <td><?=$key->email;?></td>
                                                                                    <td><?=$key->address;?></td>
                                                                                     <td><?=$key->primary_phone;?></td>
                                                                                    
                                                                                  </tr>
                                                                               <?php endif;
                                                                             endforeach;?>
                                                                             </tbody>
                                                                           </table>
                                                                               
                                                                            
                                                                                
                                                                                
                                                                         
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                      </div>

                                                                    </div>
                                                            </div>
                                                  
                                                  
                                                </td>
                                                <td>
                                                   <input type="checkbox" data-checkbox="icheckbox_square-blue" class="form-control" name="vendor_ID[]" value="<?=$vendors->supplier_id;?>">
                                                </td>

                                            </tr>
                                            <?php $j++;?>
                                         <?php endforeach;?>
                                          </tbody>
                                  </table>
                                  

                        <input type="submit" class="btn btn-default" >
                       
                  
                   </form>
                            <?php endif;?>

                       
                  </div>

               
            </div>
          </div>
         
        <?php endif;?>
          <br>
          <br>
       	 	
          	 </div>
              
          </div>
        </div>



      


       

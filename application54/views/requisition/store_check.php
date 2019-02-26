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
                  <h3><i class="fa fa-table"></i> <strong>APPROVED REQUISITIONS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                      <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/store_function') ?>">
                    <table class="table table-striped">
                      <thead>
                         <tr>
                             
                              <th>Product Name</th>
                              <th>Product Specification</th>
                               <th>Quantity</th>
                               <th>Purpose</th>
                               <?php if($detail_single===false):?>
                                <?php else:?>

                                <?php foreach ($detail_single as $detail):?>
                                <?php endforeach;?>
                                <?php if ($detail->req_status_ID==5):?>
                                <?php else:?>
                                  <th>Store Status</th>
                                <?php endif;?>
                               <?php endif;?>
                        </tr>

                      </thead>
                      <tbody>

                     
                        <?php $x=0;?>
                    
                       
                        <?php foreach ($detail_single as $detail):?>
                           <input type="hidden" name="req_ID" value="<?=$detail->req_ID;?>">
                            <input type="hidden" name="dept_ID" value="<?=$detail->department_ID;?>">
                            <input type="hidden" name="status_check_by" value="<?$detail->email;?>">
                            <input type="hidden" name="response" value="1">
                            <input type="hidden" name="req_status_check_ID" value="5">
                           
                       
                       
                       
                    
  
                            <tr>
                              <td><?=$detail->name;?></td>
                                 <td><?= $detail->product_specification;?></td>
                                  <td><?= $detail->quantity;?>
                                  </td>
                                <td><?=$detail->purpose;?></td>
                                <?php if ($detail->req_status_ID==5):?>
                                 <?php else:?>
                                <td>
                                   <div class="checkbox">
                                      <label><input type="checkbox" name="store_status[]" value="1">Option 1</label>
                                    </div>
                                   <input type="hidden" name="req_detail[<?=$x;?>]" value="<?=$detail->req_detail_ID;?>">


                                </td>
                              <?php endif;?>

                              
                           
                            </tr>
                         
                           <?php $x++;?>
                       
                        
                       <?php endforeach;?>
                      
                     

                      


                      
                

                       
                      </tbody>
                     
                    </table>
                    


                  </div>
                </div>
              </div>
              <?php if($detail->req_status_ID==5):?>
              <?php else:?>

               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</a>

                          <!-- Modal -->
                          <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Comment form store</h4>
                                </div>
                                <div class="modal-body">
                                 <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <input type="text" class="form-control" name="comments">
                                  </div>
                                </div>
                                 <button type="submit" class="btn btn-primary">Save</button>
                                <div class="modal-footer">

                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                              </div>

                            </div>
                          </div>
                <?php endif;?>
            </form>
            </div>
          </div>   

           
                 <!-- Trigger the modal with a button -->
                          




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
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>LIST OF VENDORS FOR INTERVIEW</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='100'> 
                      <thead>
                        <tr>
                           <th>Vendor Name</th>
                           <th>Equipment</th>
                           <th>Category</th>
                            <th>Details</th>
                            <th>Rating</th>
                           <th>Interview Date</th>
                           <!--  <th>Interview Time</th> -->

                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($vendor_list as $vendor):?>
                        <tr>
                          <td><?= $vendor->company_name;?></td>
                           <td><?php 
                                $ans=false;
                                foreach($equipment_list as $equip){
                                  if($vendor->supplier_id == $equip->supplier_id){
                                    $ans= true;
                                    break;}}?>
                                <?php if($ans == TRUE){?>
                                <a href="<?= site_url('vendor/equipment/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">Equipments</a>
                                <?php }else{ echo '<span class="text-danger">No Upload</span>';}?>
                            </td>
                          <td><?php foreach ($category_list as $cat):?>
                                  <?php if($vendor->supplier_id==$cat->supplier_id):?>
                                         <?php echo $cat->category;?>,
                                         <br>
                                  <?php endif;?>
        
                                <?php endforeach;?>
                            </td>
                            <td>
                                <a href="<?= site_url('vendor/details/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">View</a>
                            </td>
                           <td>
                                <a href="<?= site_url('vendor/rating/'.$vendor->supplier_id);?>" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> View</a>    
                           </td>

                           <td><?php $interv=array();$x=1;
                            foreach($interview as $inter){
                                  if($vendor->supplier_id==$inter->supplier_id){
                                    $interv[]=$inter;

                                  }
                            }?>
                            <?php foreach($interv as $in):?>
                              Schedule <?=$x;?> : <?=$in->date_interview;?>, <?=$in->time_interview;?><br>

                              <?php $x++;?>
                              <?php endforeach;?>
                           

                          



                          </td>
                            
                           <td>



                             <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-basic<?=$vendor->supplier_id;?>">Approve</a>

                                 <!-- Modal -->
                               


                               <a href="<?= site_url('vendor/reject/'.$vendor->supplier_id);?>"  target="_blank" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Reject</a>

                                <a href="<?=base_url();?>vendor/schedule/<?=$vendor->supplier_id;?>" class="btn btn-info btn-sm">Reschedule Interview</a>
                          </td>
                          <div class="modal fade" id="modal-basic<?= $vendor->supplier_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Approve Vendor</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?=base_url();?>Vendor/approve" method="POST">
                                          <div class="form-group">
                                            <label for="rating">Performance Rating <span style="color:red; font-size: 12px;">(Between 1-99)</span></label>
                                            <input type="number" class="form-control" id="rating" name="rating">
                                            <input type="hidden" name="vendor_id" value="<?=$vendor->supplier_id;?>">

                                          
                                              
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


                         
                        </tr>
                         
                        <?php endforeach; ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

           
         
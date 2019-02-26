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
                  <h3><i class="fa fa-table"></i> <strong>APPROVED REQUISITIONS FOR QUOTE</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Dept</th>
                           <th>Ref</th>
                           <th>Category</th>
                            <th>Uploadby</th>
                            <th>purpose</th>
                            <th>No of Items</th>
                             <th>Status</th>

                            <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                          $date =$vendor->entry_date;?>
                          

                          
                        <tr>
                          <td style="width: 12px;"><?= $vendor->dept_name; ?></td>
                           <td>RQ00<?= $vendor->req_ID; ?></td>
                          <td style="width: 12px;"><?= $vendor->category; ?></td>
                             <td><?= $vendor->firstname.' '.$vendor->lastname; ?></td>
                          <td>
                              <?=$vendor->purpose;?>
                          </td>
                          <td style="width: 12px;">
                              <?php $x=0;?>
                             <?php foreach($count_available as $count){

                               if ($vendor->req_ID==$count->req_ID){
                                                                  
                                   $x=$x+1;
                                }
                               }

                               echo $x;?>


                      
                           <td><?php 
                           if($vendor->process_status_ID>1){
                                 $status="RFQ sent";
                           }else{
                               $status="Yet to send RFQ";
                           }
                           echo $status;
                          ?>
                           </td>
                           <td><?=$date;?></td>
                           <td >
                              <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Request/Request_quote') ?>">

                                     <input type="hidden" name="req_ID" value="<?=$vendor->req_ID;?>">
                                     <input type="hidden" name="category_ID" value="<?=$vendor->category_ID;?>">
                                     <?php if($vendor->process_status_ID>1):?>
                                      <button type="submit" class="btn btn-success btn-xs">View RFQ</button> 

                                      <?php elseif($x==0):?>
                                         <button type="submit" class="btn btn-success btn-xs">Check Store</button> 
                                     <?php else:?>
                                     <button type="submit" class="btn btn-primary btn-xs">Send RFQ</button> 
                                   <?php endif;?>
                              </form><br>
                               <?php if($vendor->process_status_ID>1):?>

                               <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('Request/Resend_quote') ?>">

                                     <input type="hidden" name="req_ID" value="<?=$vendor->req_ID;?>">
                                     <input type="hidden" name="category_ID" value="<?=$vendor->category_ID;?>">
                                     <input type="hidden" name="resend" value="resend">
                                    
                                      <button type="submit" class="btn btn-primary btn-xs">Resend RFQ</button> 
                                      
                                      
                              </form>
                            <?php endif;?>
                                  
                              
                            

                                    
                           </td>
             
                        </tr>
                       
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
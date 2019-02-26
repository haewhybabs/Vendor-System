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
                   <?php if($req_list==false):?>
                    <h3><i class="fa fa-table"></i> <strong>REQUISITION LISTS</strong></h3>
                  <?php else:?>
                   <?php foreach($req_list as $v):?>
                  <?php endforeach;?>
                 
                 <h3><i class="fa fa-table"></i> <strong>LIST OF ALL REQUISITION</strong></h3>
               <?php endif;?>
                  <a href="<?= site_url('requisition/news') ?>" class="btn btn-danger" style="float:right"> <span class="fa fa-plus"></span> Create Requisition</a>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                     <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                       
                          <th>Ref. No</th>
                            <th>Req. stage</th>
                              <th>Upload By</th>
                              <th>Req. Date</th>
                              <th>Category</th>
                              <th>Activity History</th>
                              <th>Requisition Details</th>
                              
                          <!--th class='hidden-350'>Action</th-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($req_list==false):?>
                      
                        <?php else:?>

                         <?php        
                        foreach($req_list as $vendor){
                            $no=1;
                            if($vendor->process_status_ID==1){
                              $stage='Requisition Stage';
                            }
                            elseif($vendor->process_status_ID==2){
                              $stage='RFQ Stage';
                            }
                            elseif($vendor->process_status_ID==3){
                              $stage='Approval Sheet';
                            }
                            elseif($vendor->process_status_ID==4){
                              $stage='Budget Control';
                            }
                            elseif($vendor->process_status_ID==5){
                              $stage='Procurement Committee';

                            }
                             elseif($vendor->process_status_ID==6){
                              $stage='Forensic';

                            }
                            elseif($vendor->process_status_ID==7){
                              $stage='Final Approval';
                            }

                             elseif($vendor->process_status_ID==8){
                              $stage='Purchase Order';
                            }
                            
                          ?>
                    
                        <tr>
                            <td><?= $vendor->reference; ?></td>
                            <td><?=$stage;?></td>
                            <td><?= $vendor->firstname.' '.$vendor->lastname; ?></td>
                            <td><?=$vendor->entry_date;?></td>
                             <td><?=$vendor->category;?></td>
                              <td>
                                  <a href="<?=base_url();?>Requisition/Activity_history/<?=$vendor->req_ID;?>" class="btn btn-primary btn-sm">Activity History</a>

                                  <a href="<?=base_url();?>Requisition/View_history/<?=$vendor->req_ID;?>" class="btn btn-success btn-sm">Download History</a>

                              </td>

                              <td>
                                   <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic<?= $vendor->req_ID; ?>"><span class="fa fa-eye"></span>View</a>


                              </td>

                               <div class="modal fade" id="modal-basic<?= $vendor->req_ID; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                   <?php $num=1; foreach($details as $li) {
                                          if($vendor->req_ID == $li->req_ID){
                                         ?>
                                      <div class="row">
                                       
                                       <div class="col-sm-1"><?= $num; ?></div>
                                          <div class="col-sm-4"><?= $li->name; ?></div>
                                           <div class="col-sm-6"><?= $li->product_specification; ?></div>  
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
                      <?php }?>
                    <?php endif;?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          

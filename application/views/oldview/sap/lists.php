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
                  <h3><i class="fa fa-table"></i> <strong>PURCHASE ORDER SAP</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Dept</th>
                           <th>PO No.</th>
                             <th>Status</th>
                            <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                             $no=1;
                             if($vendor->sap_status == 0){
                             $status='<span class="text-warning">Pending</span>';  
                          }
                            if($vendor->sap_status == 1){
                             $status='<span class="text-success">Approved</span>';  
                          }
                            if($vendor->sap_status == 2){
                             $status='<span class="text-danger">Rejected</span>';  
                          }
                            if($vendor->sap_status == 3){
                             $status='<span class="text-danger">On Query</span>';  
                          }
                          $date = strtotime($vendor->sap_receive);
                            ?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                          <td><?= $vendor->po_number; ?></td>
                              <td><?= $status; ?></td>
                            <td><?= date('Y-m-d', $date); ?></td>
                           <td style="style:width:58%">
                         <a href="<?= site_url('quotes/sheet/'.$vendor->id); ?>" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span> Approval Sheet</a>
                        <a href="<?= site_url('sap/vendors/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-eye"></span> Vendors</a>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-msg<?= $vendor->id; ?>"><span class="fa fa-comments"></span> Comments</a>
                         <?php if($vendor->sap_status == 0 || $vendor->sap_status == 3){?>
                        <a href="<?= site_url('sap/approve/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-thumbs-up"></span> Approve</a>
                        <a href="<?= site_url('sap/query/'.$vendor->id); ?>" class="btn btn-warning btn-sm" ><span class="fa fa-exclamation"></span> Query</a>
                        <a href="<?= site_url('sap/reject/'.$vendor->id); ?>" class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span> Reject</a>   
                         <?php } ?>
                        <?php if($vendor->sap == 1 && $vendor->sap2 == 1){?>
                        <a href="<?= site_url('sap/approve/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-thumbs-up"></span> Send for Final Approval</a>
                        <?php } ?>
                          </td>
                     
                    <div class="modal fade" id="modal-msg<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title text-center"><strong>Comments</strong></h4>
                        </div>
                        <div class="modal-body">
                        <div class="col-sm-12">
                       <?php 
                            if(!empty($msg_list) && count($msg_list) >= 1){
                              foreach($msg_list as $msg) {
                            if($msg->to == 2){$receiver='Dept. Head';}
                                 if($msg->to == 1){$receiver='Department';}
                                   if($msg->to == 3){$receiver='Store';}
                                   if($msg->to == 8){$receiver='Budget Control';}
                                   if($msg->to == 4){$receiver='Techincal Review';}
                                   if($msg->to == 5){$receiver='Techincal Head';}
                                   if($msg->to == 7){$sender='Procurement Office';}
                                   if($msg->to == 6){$receiver='Requisition Approval';}
                                   if($msg->to == 9){$receiver='Procurement Committee';}
                                   if($msg->to == 10){$receiver='SAP';}
                                   if($msg->to == 11){$receiver='Forensic';}
                                   if($msg->to == 12){$receiver='Final Approval';}
                            if($msg->sender == 2){$sender='Dept. Head';}
                            if($msg->sender == 3){$sender='Store';}
                           if($msg->sender == 4){$sender='Techincal Review';}
                            if($msg->sender == 5){$sender='Techincal Head';}
                            if($msg->sender == 6){$sender='Requisition Approval';}
                           if($msg->sender == 9){$sender='Procurement Commitee';}
                                  if($msg->sender == 7){$sender='Procurement Office';}
                            if($msg->sender == 8){$sender='Budget Control';}
                           if($msg->sender == 10){$sender='SAP';}
                          if($msg->sender == 11){$sender='Forensic';}
                           if($msg->sender == 12){$sender='Resident Pastor';}
                         if($vendor->id == $msg->requisition_id){
                               $date = $vendor->date_added;
                             ?>
                          <div class="row">
                            <p class="text-default">
                            <span class="text-primary">SENDER: <?= strtoupper($sender); ?></span> &nbsp;&nbsp;
                            <span class="text-primary text-right">TO: <?= strtoupper($receiver); ?></span><br>
                            <span class="text-warning"><?= date('Y-m-d g:i:A', strtotime(date($date))); ?></span><br>
                           
                            <?= $msg->comment; ?></p><hr>
                          </div>  
                           <?php }} }else{?>
                                <div class="row">
                                <p>No message</p>
                             </div>
                           <?php }?> 
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                               
                    <!--div class="modal fade" id="modal-basic<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title"><strong>PO Budget Price</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                       <div class="row">
                           <div class="col-sm-1">S/N</div>
                              <div class="col-sm-3">Product</div> 
                               <div class="col-sm-3">Quan</div> 
                                <div class="col-sm-5">Price</div>
                       </div>
                       <?php $num=1; $sum=0; foreach($list as $li) {
                              
                              if($vendor->id == $li->req_id ){
                                   $sum += $li->quantity * $li->price;
                             ?>
                          <div class="row">
                           
                           <div class="col-sm-1"><?= $num; ?></div>
                              <div class="col-sm-3"><?= $li->name; ?></div>
                               <div class="col-sm-3"><?= $li->quantity; ?></div>
                               <div class="col-sm-5">&#8358;<?=  number_format($li->price); ?></div>  
                          </div>  
                           <?php $num++; }} ?> 
                           <hr>
                           <div><span>Total Amount for Purchase Order:</span>  <span class="text-success">&#8358;<?= number_format($sum); ?></span></div>
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div--> 
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
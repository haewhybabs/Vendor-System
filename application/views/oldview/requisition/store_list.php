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
                  <h3><i class="fa fa-table"></i> <strong>REQUISITIONS FOR STORE</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Dept.</th>
                           <th>Reference</th>
                            <th>Status</th>  
                            <th>Received</th>
                            <th>Treated</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                             $no=1;
                             if($vendor->store_status == 0){
                             $status='<span class="text-warning">Pending</span>';  
                          }
                            if($vendor->store_status == 1){
                             $status='<span class="text-success">Checked</span>';  
                          }
                           
                          $date = strtotime($vendor->date_added);
                            ?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                          <td><?= $vendor->reference; ?></td>
                              <td><?= $status; ?></td>
                            <td><?= $vendor->st_receive; ?></td>
                             <td><?= $vendor->st_treated; ?></td>
                           <td>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic<?= $vendor->id; ?>"><span class="fa fa-eye"></span> View</a>
                           <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-msg<?= $vendor->id; ?>"><span class="fa fa-comments"></span> Comments</a>
                           <?php  if($vendor->store_status == 0){?>
                            <a href="<?= site_url('requisition/available/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-thumbs-up"></span> Check </a>
                            <?php } ?>
                          </td>
                      <div class="modal fade" id="modal-msg<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title text-center"><strong>Requisition Comments</strong></h4>
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
                           <?php } }}else{?>
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
                     <div class="modal fade" id="modal-basic<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title text-center"><strong>Requisition Lists</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                       <div class="row">
                           <div class="col-sm-1"><strong>S/N</strong></div>
                           <div class="col-sm-3"><strong>Category</strong></div>
                           <div class="col-sm-3"><strong>Product</strong></div>
                           <div class="col-sm-4"><strong>Specification</strong></div>  
                           <div class="col-sm-1"><strong>Quan</strong></div>
                       </div><hr>
                       <?php $num=1; foreach($list as $li) {
                             if($vendor->id == $li->req_id){?>
                          <div class="row">
                           
                           <div class="col-sm-1"><?= $num; ?></div>
                             <div class="col-sm-3"><?= $li->category; ?></div>
                              <div class="col-sm-3"><?= $li->name; ?></div>
                               <div class="col-sm-4"><?= $li->specification; ?></div>  
                                <div class="col-sm-1"><?= $li->quantity; ?></div>  
                          </div>  
                           <?php $num++; } }?> 
                           <hr>
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                        </tr>
                        <?php $no++;} ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
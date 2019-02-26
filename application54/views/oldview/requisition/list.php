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
                 <h3><i class="fa fa-table"></i> <strong>REQUISITION LISTS OF <?= $department_status->dept_name; ?></strong></h3>
                  <a href="<?= site_url('requisition/new') ?>" class="btn btn-danger" style="float:right"> <span class="fa fa-plus"></span> Create Requisition</a>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                     <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                         <td class="hidden">S/N</td>
                          <th>Ref. No</th>
                            <th>Req. stage</th>
                              <th>Upload By</th>
                              <th>Req. Date</th>
                              <th>Status</th>
                              <th>Action</th>
                          <!--th class='hidden-350'>Action</th-->
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                            $no=1;
                           if($vendor->supply_status == 0){$status='<span class="text-warning">Processing</span>'; }
                             if($vendor->supply_status == 1){$status='<span class="text-success">Supplied</span>'; }
                             if($vendor->supply_status == 2){$status='<span class="text-danger">Declined</span>'; }
                             if($vendor->concur_status == 0){$h_status='<span class="text-warning">Pending</span>'; }
                             if($vendor->concur_status == 1){$h_status='<span class="text-success">Approved</span>';}
                             if($vendor->concur_status == 2){$h_status='<span class="text-danger">Rejected</span>';}
                             if($vendor->store_status == 0){$s_status='<span class="text-warning">Pending</span>';}
                             if($vendor->store_status == 1){$s_status='<span class="text-success">Checked</span>';}    
                             if($vendor->technical_status == 0){$t_status='<span class="text-warning">Pending</span>';}
                            if($vendor->technical_status == 1){$t_status='<span class="text-success">Reviewed</span>';}
                            if($vendor->technical_head_status == 0){$th_status='<span class="text-warning">Pending</span>';}
                            if($vendor->technical_head_status == 1){$th_status='<span class="text-success">Approved</span>';}
                            if($vendor->technical_head_status == 2){$th_status='<span class="text-danger">Rejected</span>';}
                             if($vendor->technical_head_status == 3){$th_status='<span class="text-danger">Under Query</span>';}
                            if($vendor->admin_status == 0){$a_status='<span class="text-warning">Pending</span>';}
                            if($vendor->admin_status == 1){$a_status='<span class="text-success">Approved</span>';}
                             if($vendor->admin_status == 2){$a_status='<span class="text-danger">Rejected</span>';}
                             if($vendor->admin_status == 3){$a_status='<span class="text-danger">Under Query</span>';}
                            if($vendor->pr_status == 0){ $pr_status='<span class="text-warning">Pending</span>'; }
                            if($vendor->pr_status == 1){ $pr_status='<span class="text-warning">Send RFQ</span>'; }
                             if($vendor->pr_status == 2){ $pr_status='<span class="text-warning">Send PO</span>'; }
                             if($vendor->budget_status == 0){ $b_status='<span class="text-warning">Pending</span>'; }
                            if($vendor->budget_status == 1){$b_status='<span class="text-success">Approved</span>'; }
                             if($vendor->budget_status == 2){$b_status='<span class="text-danger">Rejected</span>';}
                            if($vendor->dfs_status == 0){$d_status='<span class="text-warning">Pending</span>';}
                            if($vendor->dfs_status == 1){$d_status='<span class="text-success">Approved</span>';}
                             if($vendor->dfs_status == 2){$d_status='<span class="text-danger">Rejected</span>';}
                            if($vendor->forensic_status == 0){$f_status='<span class="text-warning">Pending</span>';}
                            if($vendor->forensic_status == 1){$f_status='<span class="text-success">Approved</span>';}
                             if($vendor->forensic_status == 2){$f_status='<span class="text-danger">Rejected</span>';}
                            if($vendor->sap_status == 0){$sa_status='<span class="text-warning">Pending</span>';}
                            if($vendor->sap_status == 1){$sa_status='<span class="text-success">Approved</span>';}
                             if($vendor->sap_status == 2){$sa_status='<span class="text-danger">Rejected</span>';}
                            if($vendor->rp_status == 0){$r_status='<span class="text-warning">Pending</span>';}
                            if($vendor->rp_status == 1){$r_status='<span class="text-success">Approved</span>';}
                            if($vendor->rp_status == 2){$r_status='<span class="text-danger">Rejected</span>';  }
                            if($vendor->store_status == 0 && $vendor->technical_status == 0 && $vendor->req_status >= 3){$s_status='<span class="text-warning">N/A</span>';}
                            if($vendor->store_status == 0 && $vendor->technical_status == 1){$s_status='<span class="text-warning">N/A</span>';}
                            if($vendor->store_status == 1 && $vendor->technical_status == 0 && $vendor->technical_head_status == 0  ){$t_status='<span class="text-warning">N/A</span>'; $th_status='<span class="text-warning">N/A</span>';}
                            if($vendor->store_status == 1 && $vendor->req_status >= 2){$t_status='<span class="text-warning">N/A</span>'; $th_status='<span class="text-warning">N/A</span>';}
                             if($vendor->req_status >= 9 && $vendor->sap_status == 0 && $vendor->dfs_status == 0 ){$d_status='<span class="text-warning">N/A</span>';} 
                            if($vendor->sap_status == 0 && $vendor->dfs_status == 1 ){$sa_status='<span class="text-warning">N/A</span>'; $f_status='<span class="text-warning">N/A</span>';}
                            if($vendor->sap_status == 1 && $vendor->dfs_status == 0 ){$d_status='<span class="text-warning">N/A</span>';}
                            if($vendor->sap2 == 1){$s_req='<span class="fa fa-circle text-success"></span>';} 
                            if($vendor->req_status == 1){$h_req='<span class="fa fa-circle text-success"></span>';}else{$h_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 2){$st_req='<span class="fa fa-circle text-success"></span>';}else{$st_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 3){$t_req='<span class="fa fa-circle text-success"></span>';}else{$t_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 4){$th_req='<span class="fa fa-circle text-success"></span>';}else{$th_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 5){$a_req='<span class="fa fa-circle text-success"></span>';}else{$a_req='<span class="fa fa-circle text-warning"></span>';}
                             if($vendor->req_status == 6){$pr_req='<span class="fa fa-circle text-success"></span>';}else{$pr_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 7){$b_req='<span class="fa fa-circle text-success"></span>';}else{$b_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 8){$d_req='<span class="fa fa-circle text-success"></span>';}else{$d_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 9){$s_req='<span class="fa fa-circle text-success"></span>';}else{$s_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 10){$f_req='<span class="fa fa-circle text-success"></span>';}else{$f_req='<span class="fa fa-circle text-warning"></span>';}
                            if($vendor->req_status == 11){$r_req='<span class="fa fa-circle text-success"></span>';}else{$r_req='<span class="fa fa-circle text-warning"></span>';}
                           
                        $date = $vendor->date_added;
                          ?>
                    
                        <tr>
                          <td><?= $vendor->reference; ?></td>
                            <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-basic2<?= $vendor->id; ?>"><span class="fa fa-eye"></span> View Stage</a></td>
                             <td><?= $vendor->firstname.' '.$vendor->lastname; ?></td>
                            <td><?= date('Y-m-d g:i:A', strtotime(date($date))); ?></td>
                             <td><?= $status; ?></td>
                           <td style="">
                           <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic<?= $vendor->id; ?>"><span class="fa fa-eye"></span> View</a>
                           <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-msg<?= $vendor->id; ?>"><span class="fa fa-comments"></span> Comments</a>
                           <a href="<?= site_url('requisition/create/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-edit"></span> Update</a>
                            </td>
        
                    <div class="modal fade" id="modal-basic2<?= $vendor->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title"><strong>Requisition Stage</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                     <div class="row">
                           <div class="col-sm-12">
                           <div class="col-sm-3"><strong>STEPS</strong></div>
                               <div class="col-sm-1"><strong></strong></div>
                                <div class="col-sm-2"><strong>STATUS</strong></div>
                               <div class="col-sm-3"><strong>RECEIVE</strong></div>  
                               <div class="col-sm-3"><strong>TREATED</strong></div>
                           </div><hr>
                           <div class="col-sm-12">
                               <div class="col-sm-3"><small>Head Dept</small></div>
                               <div class="col-sm-1"><small><?= $h_req; ?></small></div>
                               <div class="col-sm-2"><small><?= $h_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->h_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->h_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->h_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->h_treated));}?></small></div>  
                                </div> <hr>
                           
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>Store Check</small></div>
                                <div class="col-sm-1"><small><?= $st_req; ?></small></div>
                                <div class="col-sm-2"><small><?= $s_status; ?></small></div>
                                <div class="col-sm-3"><small><?php if(!empty($vendor->st_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->st_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->st_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->st_treated));}?></small></div>  
                               </div> <hr>
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>Technical</small></div>
                                <div class="col-sm-1"><small><?= $t_req; ?></small></div>
                                <div class="col-sm-2"><small><?= $t_status; ?></small></div>
                                <div class="col-sm-3"><small><?php if(!empty($vendor->t_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->t_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->t_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->t_treated));}?></small></div>  
                               </div> <hr>
                           <div class="col-sm-12">
                               <div class="col-sm-3"><small>Technical Head</small></div>
                               <div class="col-sm-1"><small><?= $th_req; ?></small></div>
                               <div class="col-sm-2"><small><?= $th_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->thead_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->thead_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->thead_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->thead_treated));}?></small></div>  
                                </div><hr> 
                           <div class="col-sm-12">
                               <div class="col-sm-3"><small>Administrator</small></div>
                               <div class="col-sm-1"><small><?= $a_req; ?></small></div>
                               <div class="col-sm-2"><small><?= $a_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->ad_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->ad_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->ad_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->ad_treated));}?></small></div>  
                              </div><hr>
                           <div class="col-sm-12">
                               <div class="col-sm-3"><small>Procurement</small></div>
                               <div class="col-sm-1"><small><?= $pr_req; ?></small></div>
                               <div class="col-sm-2"><small><?= $pr_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->pr_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->pr_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->pr_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->pr_treated));}?></small></div>  
                            </div> <hr>
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>Budget Control</small></div>
                                <div class="col-sm-1"><small><?= $b_req; ?></small></div>
                                <div class="col-sm-2"><small><?= $b_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->b_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->b_receive));} ?></small></div> 
                                <div class="col-sm-3"><small><?php if(!empty($vendor->b_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->b_treated));} ?></small></div>   
                                </div> <hr>
            
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>Proc. Commitee</small></div>
                                <div class="col-sm-1"><small><?= $d_req; ?></small></div>
                                <div class="col-sm-2"><small><?= $d_status; ?></small></div>
                                 <div class="col-sm-3"><small><?php if(!empty($vendor->d_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->d_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->d_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->d_treated));}?></small></div>  
                             </div> <hr>
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>SAP</small></div>
                                   <div class="col-sm-1"><small><?= $s_req; ?></small></div>
                                 <div class="col-sm-2"><small><?= $sa_status; ?></small></div>
                                 <div class="col-sm-3"><small><?php if(!empty($vendor->sap_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->sap_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->sap_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->sap_treated));}?></small></div>  
                               </div> <hr>
                            <div class="col-sm-12">
                                <div class="col-sm-3"><small>Forensic</small></div>
                                   <div class="col-sm-1"><small><?= $f_req; ?></small></div>
                                <div class="col-sm-2"><small><?= $f_status; ?></small></div>
                                <div class="col-sm-3"><small><?php if(!empty($vendor->f_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->f_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->f_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->f_treated));}?></small></div>  
                            </div> <hr>
                           <div class="col-sm-12">
                               <div class="col-sm-3"><small>Final Approval</small></div>
                               <div class="col-sm-1"><small><?= $r_req; ?></small></div>
                               <div class="col-sm-2"><small><?= $r_status; ?></small></div>
                               <div class="col-sm-3"><small><?php if(!empty($vendor->rp_receive)){ echo date('Y-m-d g:i:A', strtotime($vendor->rp_receive));}?></small></div>  
                                <div class="col-sm-3"><small><?php if(!empty($vendor->rp_treated)){ echo date('Y-m-d g:i:A', strtotime($vendor->rp_treated));}?></small></div>  
                             </div> 
                          </div>
                         </div>
                        </div>
                        <div class="modal-footer">
                         <!--button onclick="myFunction()">Reload page</button-->
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                          
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
                          <h4 class="modal-title"><strong>Requisition Lists</strong></h4>
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
                         <!--button onclick="myFunction()">Reload page</button-->
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                         <?php 
                         $no++;} ?>
                          </tr>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          

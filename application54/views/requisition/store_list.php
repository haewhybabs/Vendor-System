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
            <?php if ($storeCheck_pending===false):?>
                           <div class="well">
                              No data found for Pending Requisition
                           </div>
     <?php else:?>

            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Unchecked  REQUISITIONS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                             
                              <th>Ref. No</th>
                              <th>Uploaded by</th>
                               <th>Status</th>
                               <th>Request Category</th>
                               <th>No of Items</th>
                              <th>Requisition Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($storeCheck_pending as $detail):?>

  
                        <tr>
                          <td>RQ00<?=$detail->req_ID;?></td>
                             <td><?= $detail->firstname;?></td>
                              <td><?php if ($detail->req_status_ID==2):?>
                                  <?= 'pending';?>
                                  <?php else:?>
                                    <?= 'Reviewed';?>
                                  <?php endif;?>
                              </td>
                            <td><?=$detail->category;?></td>
                           <td>
                              <?=$detail->no_of_item;?>
                          </td>
                          <td>
                            <?= $detail->entry_date;?>
                          </td>
                          <td>
                            <a href="<?= base_url();?>Requisition/storeCheck_view/<?=$detail->req_ID;?>" class="btn btn-primary">view</a>
                          </td>
                        </tr>
                       <?php endforeach;?>
                       
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif;?>
<br>
<br>

 <?php if ($storeCheck===false):?>
                           <div class="well">
                              No data found for Approved Requisition
                           </div>
     <?php else:?>

           <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Checked REQUISITIONS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                            
                              <th>Ref. No</th>
                              <th>Uploaded by</th>
                               <th>Status</th>
                               <th>Request Category</th>
                               <th>No of Items</th>
                              <th>Requisition Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       

                        <?php foreach ($storeCheck as $details):?>

  
                        <tr>
                          <td>RQ00<?=$details->req_ID;?></td>
                             <td><?= $details->firstname;?></td>
                              <td><?php if ($details->req_status_ID==2):?>
                                  <?= 'pending';?>
                                  <?php else:?>
                                    <?= 'Reviewed';?>
                                  <?php endif;?>
                              </td>
                            <td><?=$details->category;?></td>
                           <td>
                              <?=$details->no_of_item;?>
                          </td>
                          <td>
                            <?= $details->entry_date;?>
                          </td>
                          <td>
                            <a href="<?= base_url();?>Requisition/StoreCheck_view/<?=$details->req_ID;?>" class="btn btn-primary">view</a>
                          </td>
                        </tr>
                       <?php endforeach;?>
                       
                      </tbody>
                <?php endif;?>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
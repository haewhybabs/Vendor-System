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
                  <h3><i class="fa fa-table"></i> <strong>PURCHASE ORDER</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>PO ID</th>
                           <th>Category</th>
                          <th>deadline</th>
                          <th>No of Requested Quote</th>
                          <th>No of Submitted Quote</th>
                          <th> Status</th>
                          <th>Budget Reference</th>
                          <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php     
                           $y=1;   
                         foreach($req_list as $vendor):?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                           <td>PO/LF/000<?=$vendor->rfq_ID; ?></td>
                          <td><?=$vendor->category;?></td>
                          <td><?=$vendor->deadline;?></td>
                          <td style="width:10px;">
                            <?php $x=0;?>

                              <?php foreach ($get_count as $count) {
                                if ($count->rfq_ID==$vendor->rfq_ID){
                                  $x=$x+1;
                                }
                              }?>

                                  

                            <a href="<?= site_url('quotes/view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td>
                          <td style="width: 10px;">
                             <?php $x=0;?>
                            <?php foreach ($count_submit as $submit) {
                              if ($submit->rfq_ID==$vendor->rfq_ID){
                                $x=$x+1;
                              }
                            }?>


                            <a href="<?= site_url('quotes/submit_view_count/'.$vendor->rfq_ID); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-eye"></span><?=$x;?></a></td></td>
                           <td>PO Sent
                           </td>
                            <td><?=$vendor->budget_reference;?></td>
                            <td><a href="<?= site_url('purchase_order/checkout/'.$vendor->rfq_ID); ?>" class="btn btn-success btn-xs" ><span class="fa fa-eye"></span>View</a></td>
                        </tr>
                        <?php endforeach;?> 
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>  
                          
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
                  <h3><i class="fa fa-table"></i> <strong>AUDIT TRAIL</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                         <td class="hidden">S/N</td>
                          <th>User</th>
                            <th>Dept</th>
                             <th>Action</th>
                              <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php  $num=0;
                        foreach($req_list as $vendor){
                            $date = strtotime($vendor->date_time);?>
                        <tr>
                          <td class="hidden"><?= $num; ?></td>
                             <td><?= $vendor->user; ?></td>
                            <td><?= $vendor->department; ?></td> 
                            <td><?= $vendor->action; ?></td>
                            <td style="width:20%"><em class="text-danger"><?= date('Y-m-d g:i:A',$date); ?></em></td>
                          </tr>
                          <?php 
                         $num++;} ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
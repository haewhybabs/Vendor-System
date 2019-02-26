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
                  <h3><i class="fa fa-table"></i> <strong>INVOICES</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Department</th>
                           <th>Category</th>
                            <th>RFP No.</th>
                            <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($req_list as $vendor){
                
                         $date = strtotime($vendor->po_date);
                            ?>
                        <tr>
                          <td><?= $vendor->dept_name; ?></td>
                          <td><?= $vendor->category; ?></td>
                            <td><?= strtoupper($vendor->rfp_no); ?></td>
                            <td><?= date('Y-m-d', $date); ?></td>
                           <td>
                               <a href="<?= site_url('invoices/vendor/'.$vendor->id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-edit"></span> View Sent Invoices By Vendors</a>   
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
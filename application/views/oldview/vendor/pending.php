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
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>LIST OF PENDING VENDORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-bordered table-striped table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Company name</th>
                          <th>Phone</th>
                          <th class='hidden-350'>Email</th>
                          <th class='hidden-350'>Email Code</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($vendor_list as $vendor){?>
                        <tr>
                          <td><?= $vendor->company_name; ?></td>
                          <td><?= $vendor->primary_phone; ?></td>
                          <td><?= $vendor->email; ?></td>
                          <td><?= $vendor->email_code; ?></td>
                           <td class='hidden-480' style="width:30%">
                              <a href="<?= site_url('vendor/resend/'.$vendor->supplier_id); ?>"  class="btn btn-warning btn-sm" ><span class="fa fa-check"></span> Resend Mail</a>
                               <a href="<?= site_url('vendor/edit/'.$vendor->supplier_id); ?>"   class="btn btn-primary btn-sm" ><span class="fa fa-edit"></span> Edit</a>
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
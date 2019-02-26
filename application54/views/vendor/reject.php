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
                  <h3><i class="fa fa-table"></i> <strong>LIST OF REJECTED VENDORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Company name</th>
                          <th>Phone</th>
                          <th class='hidden-350'>Equipments</th>
                          <th class='hidden-350'>Supporting Document</th>
                          <th>Details</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($vendor_list as $vendor){?>
                        <tr>
                          <td><?= $vendor->company_name ?></td>
                          <td><?= $vendor->primary_phone ?></td>
                          <td class='hidden-350'><a href="<?= site_url('vendor/equipment/'.$vendor->supplier_id); ?>" target="_blank">Equipments</a></td>
                          <td class='hidden-1024'><a href="<?= site_url('vendor/documents/'.$vendor->supplier_id); ?>"  target="_blank">Documents</a></td>
                          <td class='hidden-480'><a href="<?= site_url('vendor/details/'.$vendor->supplier_id); ?>"  target="_blank">Details</a></td>
                           <td class='hidden-480'>
                              <a href="<?= site_url('vendor/approve/'.$vendor->supplier_id); ?>"  target="_blank" class="btn btn-success btn-sm" ><span class="fa fa-check"></span> Approve</a>
                               
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
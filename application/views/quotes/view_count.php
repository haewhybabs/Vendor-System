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
                  <h3><i class="fa fa-table"></i> <strong>Derived Quotation Sheets</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Company's Name</th>
                           <th>status</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                         $i=1;        
                         foreach($detail as $vendor):?>
                        <tr>
                          <td><?= $i; ?></td>
                           <td><?=$vendor->company_name; ?></td>
                           <td>
                             <?php if($vendor->quote_sent==0):
                              echo "Quote not yet sent";
                            else:
                              echo "Quote is sent";
                              endif;?>
                           </td>
                             
                          </td>
                        </tr>
                         <?php $i++;?>
                        <?php endforeach; ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
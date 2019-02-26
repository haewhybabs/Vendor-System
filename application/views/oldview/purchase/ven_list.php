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
                  <h3><i class="fa fa-table"></i> <strong><?php echo $rfp; ?> VENDORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Vendor</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>        
                      <?php foreach($cat_list as $v){?>
                        <tr>
                          <td><?= $v->company_name; ?></td>
                           <td>
                              <form enctype="multipart/form-data" method="post" action="<?= site_url('purchase_order/view')?>">
                                  <input type="hidden" value="<?= $v->vendor_id; ?>" name="id">
                                   <input type="hidden" value="<?= $req_id; ?>" name="req_id">
                                  <input type="submit" class="btn btn-success btn-sm" value="View Purchase Order">
                              </form>
                          </td>
                          
                   
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                  <a href="<?= site_url('purchase_order') ?>" class="btn btn-primary btn-sm">Back to Purchase Order</a>
                </div>
              </div>
            </div>
          </div>
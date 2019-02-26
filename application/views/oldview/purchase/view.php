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
                  <h3><i class="fa fa-table"></i> <strong>PURCHASE ORDER FOR <?= strtoupper($supplier->company_name); ?></strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>S/N</th>
                         <th>QTY</th>
                          <th>PROduct</th>
                        <th>DESCRIPTION</th>
                        <th>UNIT PRICE</th>
                        <th>TOTAL</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                    $num=1;
                    foreach ($material_list as $req){
                        $total=$req->quantity * $req->price;
                    ?>
                        <tr>
                          <td><?= $num;?></td>
                          <td><?= $req->quantity;?></td>
                          <td><?= $req->name; ?></td>
                          <td><?= $req->specification; ?></td>
                          <td><?= number_format($req->price); ?></td>
                           <td><?= number_format($total); ?></td>
                        </tr>
                    <?php $num++;} ?>
                      </tbody>
                     
                    </table>
                  </div>
                   <a href="<?= site_url('purchase_order/') ?>" class="btn btn-primary btn-sm">Back to Purchase Order</a>
                </div>
              </div>
            </div>
          </div>
           
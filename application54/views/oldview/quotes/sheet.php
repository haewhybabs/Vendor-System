 
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
                 <a class="btn btn-primary" href="<?= site_url('quotes/prints/'.$req_id); ?>">Download Sheet</a>
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Prod</th>
                          <th>Spec</th>
                           <th>Quan</th>
                            <th>Company</th>
                             <th>Status</th>
                           <th>Unit Price</th>
                           <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                             foreach($list as $li){
                                     $quan=$li->quantity;
                                      $price=$li->price;
                                      $amount=$price * $quan;
                               if($li->approve==1){
                                   $rec='Recommended';
                               }else{
                                   $rec=' ';
                               }   
                            ?>
                        <tr>
                          <td><?= $li->name; ?></td>
                           <td><?php foreach($spec as $s){if($li->product_id == $s->product_id && $li->requisition_id == $s->req_id){ echo $s->specification;}} ?></td>
                          <td><?= $quan; ?></td>
                          <td><?= $li->company_name; ?></td>
                          <td><?= $rec; ?></td>
                           <td>&#8358;<?= number_format($price); ?></td>
                            <td>&#8358;<?= number_format($amount); ?></td>
                         
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
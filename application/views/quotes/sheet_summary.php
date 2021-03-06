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
                  <h3><i class="fa fa-table"></i> <strong>Recommended Sheet</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                   
                        <tr>
                          <th>Company</th>
                          <th>Product Name</th>
                          <th>Product Specification</th>
                          <th>Product Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                        </tr>
                   
                      </thead>
                      <tbody>
                         <?php foreach($sheet_summary as $sheet):?>
                
                           <tr>
                            <td><?=$sheet->company_name;?></td>
                            <td><?=$sheet->product_name;?></td>
                            <td><?=$sheet->product_specification;?></td>
                            <td><?=$sheet->quantity;?></td>
                            <td> <?php $number=$sheet->negotiated_price;?>
                                <?php echo "N ".number_format($number, 2);?>
                                
                            </td>
                            <td>
                               <?php $number=$sheet->negotiated_price *$sheet->quantity;?>
                                <?php echo "N ".number_format($number, 2);?>
                            </td>


                           </tr>
                         <?php endforeach;?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
               
              </div>
           

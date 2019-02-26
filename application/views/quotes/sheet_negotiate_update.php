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
                 <form action="<?=base_url();?>Quotes/approval_negotiation" method="POST">
                  <div class="filter-left">
                  
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                   
                        <tr>
                          <th>Company</th>
                          <th>Product Name</th>
                          <th>Product Specification</th>
                          <th>Product Quantity</th>
                          <th> Quote Sent</th>
                          <th>Negotiated Price</th>
                          <th>Further Negotiation</th>
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
                            <td> <?php $number=$sheet->unit_price;?>
                                <?php echo "N ".number_format($number, 2);?>
                                
                            </td>
                            <td> <?php $number=$sheet->negotiated_price;?>
                                <?php echo "N ".number_format($number, 2);?>
                                
                            </td>
                            <td style="width:10px;"><input type="number" name="price[]" value="<?=$sheet->negotiated_price;?>"></td>
                            <input type="hidden" name="neg_id[]" value="<?=$sheet->negotiation_ID;?>">
                            <td>
                               <?php $number=$sheet->negotiated_price *$sheet->quantity;?>
                                <?php echo "N ".number_format($number, 2);?>
                            </td>


                           </tr>
                         <?php endforeach;?>
                      </tbody>
                     
                    </table>
                  </div>
                  <input type="hidden" name="rfq_ID" value="<?=$sheet->rfq_ID;?>">
                   <input type="submit" value="Submit" class="btn btn-default">
                  </form>
                </div>
               
              </div>
           

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
                  <h3><i class="fa fa-table"></i> <strong>Approval Sheet</strong></h3>
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
                        </tr>
                   
                      </thead>
                      <tbody>
                         <?php foreach($sheet_summary as $sheet):?>
                
                           <tr>
                            <td><?=$sheet->company_name;?></td>
                            <td><?=$sheet->product_name;?></td>
                            <td><?=$sheet->product_specification;?></td>
                            <td><?=$sheet->quantity;?></td>


                           </tr>
                         <?php endforeach;?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div> <?php if($sheet->approval_sheet_status==2 || $sheet->approval_sheet_status==1):?>
            <?php else:?>
            <a href="<?=base_url();?>Quotes/Sheet_finalize/<?=$sheet->rfq_ID;?>" class="btn btn-primary">Approve</a>

            <a href="<?=base_url();?>Quotes/Sheet_rejected/<?=$sheet->rfq_ID;?>" class="btn btn-primary">Reject</a>
          <?php endif;?>
          </div>

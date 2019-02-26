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
                  <h3><i class="fa fa-table"></i> <strong>Submitted Quotations</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th class="hidden">S/N</th>
                            <th>RFQ No.</th>
                            <th>Submission Date</th>
                            <th>Uploaded Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                        // var_dump($list);
                          $num=0;
                        foreach($list as $vendor){
                            if($vendor->sent_quotation == 1){
                            ?>
                        <tr>
                        <td class="hidden"><?= $num; ?></td>
                            <td><?= $vendor->rfp_number; ?></td>
                            <td><?= $vendor->end_date; ?></td>
                            <td><?= $vendor->submission_date; ?></td>
                            <!--td><?php if($vendor->rp_status == "0"){ echo "Unapproved";}elseif($vendor->rp_status =="1"){echo "Approved";} ?></td-->
                           <td>
                            <a href="<?= base_url();?>/uploads/quotes/<?= $vendor->upload; ?>" class="btn btn-primary btn-sm"><span class="fa fa-download"></span> View Quotation</a>
                                <!--?php if( $vendor->rp_status == "1" && $vendor->sent_invoice == "0"){?>
                               <a href="<?= base_url();?>/quotes/upload_invoice/<?= $vendor->id; ?>" class="btn btn-primary btn-sm"><span class="fa fa-download"></span> Upload Invoice</a>
                                <?php }?>
                                   <?php if( $vendor->rp_status == "1"){?>
                                   <form style="display: inline-block" action="<?php echo site_url('quotes/po_download'); ?>" method="post">
                                       <input value="<?php echo  $vendor->id ?>" class="btn btn-primary btn-sm" type="hidden" name="qid" >
                                       <input value="<?php echo  $vendor->vendor_id ?>" class="btn btn-primary btn-sm" type="hidden" name="vid" >
                                       <input style="position: relative"  value="Purchase Order" class="btn btn-primary btn-sm" type="submit" name="submit" >
                                   </form-->
                               <?php }?>
                           </td>

                    
                        </tr>
                        <?php $num++;} ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
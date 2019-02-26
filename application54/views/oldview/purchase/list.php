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
                  <h3><i class="fa fa-table"></i> <strong>Purchase Order</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th class="hidden">S/N</th>
                        
                          <th>PO</th>
                           <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                          $num=0;
                        foreach($list as $vendor){
                            ?>
                        <tr>
                        <td class="hidden"><?= $num; ?></td>
                           <td>
                              <form enctype="multipart/form-data" method="post" action="<?= site_url('purchase_order/download')?>">
                                  <input type="hidden" value="<?= $vendor->vend_id; ?>" name="vid">
                                   <input type="hidden" value="<?= $vendor->vrfq_id; ?>" name="qid">
                                  <input type="submit" class="btn btn-success btn-sm" value="Download Purchase Order">
                              </form>
                            <td>
                                <?php if( $vendor->accept_status == 0){?>
                                 <span class="text-warning">Invoice Not Uploaded</span>
                                 <?php }else{?>
                               <span class="text-success">Invoice Uploaded</span>
                           <?php } ?>
                            </td>
                            
                           <td>
                            <?php if( $vendor->accept_status == 0){?>
                                <a href="<?= site_url('purchase_order/upload/'.$vendor->id); ?>" class="btn btn-primary btn-sm"><span class="fa fa-upload"></span> Upload Quotation</a>
                           <?php }else{?>
                             <a href="<?= site_url('purchase_order/upload/'.$vendor->id); ?>" class="btn btn-primary btn-sm"><span class="fa fa-upload"></span> Re-Upload</a>
                        <?php } ?>
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
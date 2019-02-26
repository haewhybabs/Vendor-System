     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE QUOTATIONS APPROVAL SHEET FOR VENDORS</h6>
                   </div>
                <div class="panel-body bg-white">
                <div class="col-sm-12">
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
                </div>
                
                 <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('quotes/create_action') ?>">
                    <input type="hidden" name="rid" value="<?= $rid; ?>">
                   <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th style="width:4%">Req</th>
                            <th style="width:4%">Recommend</th>
                            <th style="width:10%">Product</th>
                             <th style="width:5%">Quan</th>
                             <th style="width:10%">Vendor</th>
                             <th style="width:10%">Price</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $nu=0; if(!empty($rows) && count($rows > 0)){ $num=0; foreach($rows as $row){?>
                         <input type="hidden" name="nrid[]" value="<?= $row->req_id; ?>">
                          <input type="hidden" name="product<?= $nu; ?>" value="<?= $row->product_id; ?>">
                       <tr>
                        <td style="width:4%"><?= $row->reference; ?></td>
                        <td style="width:4%"><input type="checkbox" name="echeck[]" class="echeck" value="1"/></td>
                         <td style="width:10%"> <select class="form-control" name="prod" style="width:100%">
                                    <option value="<?= $row->name; ?>"><?= $row->name; ?></option>
                                </select></td>
                        <td style="width:5%"> <input type="text" class="form-control form-white" placeholder="Quantity" name="quantity[]" value="<?= $row->quantity; ?>"></td>
                         <td style="width:10%"> <select class="form-control" name="vendor<?= $nu; ?>" style="width:100%">
                                  <?php foreach($quotes as $quote){?>
                                    <option value="<?= $quote->supplier_id; ?>"><?= $quote->company_name; ?></option>
                                    <?php } ?>
                        </select>
                        </td>
                       <td style="width:5%"> <input type="text" class="form-control form-white" placeholder="Unit Price" name="price[]" value="" required></td>
                     </tr>
                   <?php $nu++; }} ?>
                        </tbody>
                        </table>
                        
                         <button type="submit" class="btn btn-primary">UPLOAD</button>
                    </form>
                        
                      
               
                </div>
              </div>
            </div>
             
              </div>
</div>
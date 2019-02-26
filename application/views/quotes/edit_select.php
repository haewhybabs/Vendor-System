     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">UPDATE PRICE FOR SELECTED VENDORS</h6>
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
                <?php
                 
                    ?>
               <?php /*foreach($cat_list as $index => $docs){
                                    foreach($docs as $k => $v){
                    print_r($v);
                                    }}*/?>
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('quotes/select_edit_action') ?>">
                      <input type="hidden" name="req_id" value="<?= $req_list->id; ?>">
                      <?php foreach($lists as $list){?>
                       <div id="planContainer" class="row">
                           <input type="hidden" name="prod_id[]" value="<?= $list->id; ?>">
                             <div class="col-lg-4">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Product/Service</label>
                                 <span class="text-danger"><?php echo form_error('product[]'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Product/Service" name="product[]" value="<?php echo $list->name; ?>" readonly>
                              </div>
                              </div> 
                               
                               <div class="col-lg-6">
                            <div class="form-group">
                              <label>Select vendor <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('vendor'); ?></span>
                                <select class="form-control"  name="vendor[]" id="category">
                                  <?php foreach($cat_list as $index => $docs){
                                    foreach($docs as $k => $v){?>
                                    <option value="<?= $v->supplier_id; ?>"><?= $v->company_name;?></option>
                                   <?php
    }
}
?>
                                </select>
                                </div>
                            </div>
                                
                            
                             <div class="col-lg-2">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Set Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-white" placeholder="Price" name="price[]" value="<?php echo $list->price; ?>">
                              </div>
                              </div> 
                           </div>
                        <?php }?>
    
                          <br>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="SET PRICES DOR VENDOR">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
 
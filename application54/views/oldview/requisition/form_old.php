     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE A REQUISITION</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/create_action') ?>">
                       <div id="planContainer">
                            
                              
                            <div class="col-lg-9">
                            <div class="form-group">
                              <label>Requisitions Category <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('category'); ?></span>
                                <select class="form-control"  name="category" id="category">
                                  <?php foreach($category_list as $docs){?>
                                    <option value="<?= $docs->id; ?>"><?= $docs->category; ?></option>
                                  <?php } ?>
                                </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-3">
                        <div class="form-group">
                         <label> &nbsp; <span class="text-danger"></span></label>
                        <a class="btn btn-primary" id="addMore" style="display:block">Add Items</a>
                        </div>
                       </div>
                    </div>
    
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="UPLOAD REQUISITION">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
 <script>
      
    function planHtml(){   
         return '  <div id="planContainer" class="row">'
                    +   '<div class="col-lg-4">'
                              +   ' <div class="form-group">'
                                 +   '<label for="exampleInputPassword1">Product/Service <span class="text-danger">*</span></label>'             
                                 +   '<input type="text" class="form-control form-white" placeholder="Product/Service" name="product[]" value="<?php echo set_value('product[]'); ?>" required>'
                               +   '</div>'
                               +   '</div>'  
                        +   '<div class="col-lg-4">'
                              +   ' <div class="form-group">'
                                 +   '<label for="exampleInputPassword1">Specifications <span class="text-danger">*</span></label>'             
                                 +   '<textarea class="form-control form-white" placeholder="Specifications" rows="5" name="spec[]" required><?php echo set_value('spec[]'); ?></textarea>'
                               +   '</div>'
                               +   '</div>'  
                              +   '<div class="col-lg-2">'
                               +   '<div class="form-group">'
                                 +   '<label for="exampleInputPassword1">Quantity (If applicable)</label>'
                                 +   '<input type="text" class="form-control form-white" placeholder="Quantity" name="quantity[]" value="<?php echo set_value('quantity[]'); ?>">'
                               +   '</div>'
                               +   '</div>'
                        +  '<div class="col-sm-2">'
                        +  '<div class="form-group">'
                        +  '<label for="exampleInputPassword1">&nbsp;</label>'
                        +  ' <a class="btn btn-danger remove" style="display:block">Remove</a>'
                        +  '</div>'
                        +  '</div>'
          
                    +  '</div>';
    }
    
    
    $("#addMore").click(function(e){
        $('#planContainer').append(planHtml());
        
    });
    
    $(document).on('click', '.remove', function () {
        $(this).parent().parent().parent().remove();
    });  
      </script>
      
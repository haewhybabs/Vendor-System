     <link href="<?= base_url(); ?>assets/global/plugins/summernote/summernote.min.css" rel="stylesheet">    
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;"><?php if(!empty($more)){echo $more;}else{ echo 'CREATE A REQUISITION'; }?></h6>
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
                
                    <?php if($products===false):?>
                           <div class="well">
                              No Product found for this
                           </div>
                    <?php else:?>
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/create') ?>">
                      <?php $N_Items=$no_of_item;
                        $i=0;?>
                        <?php while ($i<$N_Items):?>
                        <div class="well">

                          <div class="form-group">
                              <label for="product">Product:</label>
                               <select class="form-control"  name="product[]" id="category">
                                  <?php if($products===false):?>
                                    <div class="well">
                                       No Product found for this
                                    </div>
                                  <?php else:?>
                                    <?php foreach($products as $product){?>
                                           <option value="<?= $product->product_id; ?>"><?=$product->name; ?></option>  
                                   <?php   }?>
                                  <?php endif;?>
                                </select>
                           </div>
                                             

                            <div class="form-group">
                              <label for="Specification">Specification:</label>
                              <textarea type="text" class="form-control" name="specification[]"></textarea>
                           </div>
                  
                  

                           <div class="form-group">
                              <label for="Quantity">Quantity:</label>
                              <input type="number" class="form-control" name="quantity[]">
                           </div>

                           <div>
                              <input type="file" class="form-control" name="userfile[]" multiple="multiple">
                             
                           </div>
                        
                        </div>   
                      


                             <?php $i++;?>

                            
                        <?php endwhile;?>
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>

                            
                            
                            
                    </form>
                  <?php endif;?>
                </div>
              </div>
            </div>
            
                
        <?php if(!empty($rows) && count($rows > 0)){ $num=0; foreach($rows as $row){?>
              <table class="table table-bordered">
                      <tbody>
                        <tr>
                    <form role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/edit_action') ?>">
                     <input type="hidden" name="nrid" value="<?= $row->req_id; ?>">
                      <input type="hidden" name="id" value="<?= $row->id; ?>">
                        <td style="width:10%"><?= $row->reference; ?></td>
                         <td style="width:25%"> <select class="form-control"  name="category" id="category<?= $num; ?>">
                                  <?php foreach($category_list as $docs){
                                        if($docs->id == $row->cat_id){?>
                                    <option value="<?= $docs->id; ?>" <?php if($docs->id == $row->cat_id ){echo 'selected';}?> ><?= $docs->category; ?></option>
                                  <?php }} ?>
                                </select></td>
                          <td style="width:25%"> <select class="form-control" name="product" style="width:100%">
                                    <option value="<?= $row->product_id; ?>"><?= $row->name; ?></option>
                                </select></td>
                     <td style="width:10%"> <input type="text" class="form-control form-white" placeholder="Quantity" name="quantity" value="<?= $row->quantity; ?>"></td>
                    <td style="width:25%"> <textarea class="form-control form-white" placeholder="Specifications" rows="2" name="spec" required><?= $row->specification; ?></textarea></td>
                    <td style="width:5%"> <button type="submit" class="btn btn-warning"><span class="fa fa-edit" style="display:inline"></span></button>
                <button  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-basic<?= $row->id; ?>"><span class="fa fa-trash" style="display:inline"></span></button>
                       </td>
                    </form>
                        </tr>
                      </tbody>      
             </table>
             <div class="modal fade" id="modal-basic<?= $row->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title text-center"><strong>ARE YOU SURE YOU WANT TO DELETE</strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="row">
                         <div class="col-sm-4">
                            &nbsp;
                             </div>
                          <div class="col-sm-4">
                           <form enctype="multipart/form-data" method="post" action="<?= site_url('requisition/delete_action') ?>">
                            <input type="hidden" name="nrid" value="<?= $row->req_id; ?>">
                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                            <input type="submit" class="btn btn-danger" value="YES">
                          </form>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn btn-default btn-embossed" data-dismiss="modal" href="#">NO</a>
                             </div>
                            
                         </div>
                         
                        </div>
                       
                      </div>
                    </div>
                </div> 
              <!--script>
                  $(document).ready(function(){       
                $("#category<?php echo $num; ?>").change(function(){
                var lga = $(this).val();

                 $.post('<?php echo base_url();?>index.php/requisition/get_product/',
                 {
                 lga:lga

                 },
                 function(data) 
                 {

                 $('#product<?php echo $num; ?>').html(data);
                 });

                });
                });
            </script-->
            <?php $num++; }} ?>
              </div>
</div>
 <script>
  $(document).ready(function(){       
$("#category").change(function(){
var lga = $(this).val();

 $.post('<?php echo base_url();?>index.php/requisition/get_product/',
 {
 lga:lga
 
 },
 function(data) 
 {
 
 $('#product').html(data);
 });
    
});
});
</script>
      
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
                <?php
                 
                    ?>
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('requisition/new_action') ?>">
                            
                           
                  
                          
                            
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label>Requisitions Category <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('category'); ?></span>
                                <select class="form-control"  name="category" id="category">
                                  <?php foreach($category_list as $docs){?>
                                         <option value="<?= $docs->id; ?>"><?= $docs->category; ?></option>  
                                 <?php   }?>
                                </select>
                             </div>
                            </div>
                            
                            
                      
                        <div class="col-lg-6">
                        <div class="form-group">
                       <label for="exampleInputPassword1">No of Items</label>
                         <input type="number" class="form-control form-white" placeholder="No of Itmes" name="no_of_item" required>
                        </div>
                       </div>
                        
                              
                       
                      
                        <div class="col-sm-12">
                        <div class="form-group">
                       <label for="exampleInputPassword1">Requisition Purpose</label>
                         <textarea class="form-control form-white" placeholder="Purpose" rows="3" name="purpose" required><?php echo set_value('purpose'); ?></textarea>
                        </div>
                       </div>
                      

                       
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="Create Requisition">
                                 <a class="btn btn-danger" href="<?= site_url('requisition/lists'); ?>">Cancel</a>
                           </div>
                           
                            
                      </form>
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
                  <div class="filter-left">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if($allproduct==false):?>
            <div class="well">No data found</div>
          <?php else:?>

               <?php echo form_open('Quotes/sheet_approve');?>
              
                      <?php $i=0?>
                     <?php foreach($allproduct as $pro) :?>
                        <br>
                      <br>
                      <br>
                               
                      <button class="btn btn-primary"><?=$pro->product_name;?></button>


                          <table class="table table-dynamic table-bordered table-striped" data-table-name="Total users">
                              <thead>
                              <tr>
                                 
                              
                                  <th>PRODUCT</th>
                                  <th>SPECIFICATION</th>
                                  <th>QTY</th>
                                  <th>PRICE</th>
                                  <th>Company</th>
                                  <th>Action</th>
                                 
                              </tr>
                              </thead>
                                <tbody>


                                 
                                  <?php foreach ($allquote as $q):?>

                                      <?php if ($pro->req_detail_ID==$q->req_detail_ID):?>


                                      <tr>
                                  
                                        
                                          <td><?=$q->product_name;?></td>
                                         <td><?=$q->product_specification;?></td>
                                          <td><?=$q->quantity?></td>
                                           <td><?=$q->unit_price?></td>  
                                           <td><?=$q->company_name;?></td>
                                           <td>  
                                             <input type="radio" name="approval[<?=$q->req_detail_ID;?>]" value="<?=$q->vendor_ID;?>">
                                                  <input type="hidden" name="rfq_ID" value="<?=$q->rfq_ID;?>">
                                                   <input type="hidden" name="req_detail_ID[<?=$i;?>]" value="<?=$q->req_detail_ID;?>">
                                                   <input type="hidden" name="req_ID" value="<?=$q->req_ID;?>">







                                           </td>                             
                                       </tr>
                                      <?php endif;?>
                                    
                                      
                                       <?php endforeach;?>

                                </tbody>

                          </table>


                     
                
                       <?php $i++;?>
                    <?php endforeach;?>  
                    <br>
                    <button type="submit" class="btn btn-default">Submit</button>  

              <?php echo form_close();?>      

          <?php endif;?>          
               





x2e5EnkEBPhoj7p






















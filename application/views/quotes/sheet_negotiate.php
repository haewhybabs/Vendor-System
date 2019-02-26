 
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

               <?php echo form_open('Quotes/sheet_negotiate');?>
              
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
                                  <th>Quote Sent</th>
                                  <th>Company</th>
                                  <th>Negotiate</th>
                                 
                              </tr>
                              </thead>
                                <tbody>


                                 
                                  <?php foreach ($allquote as $q):?>

                                      <?php if ($pro->req_detail_ID==$q->req_detail_ID):?>


                                      <tr>
                                  
                                        <td><?=$q->product_name;?></td>
                                         <td><?=$q->product_specification;?></td>
                                          <td><?=$q->quantity?></td>
                                            <td><?php $number=$q->unit_price;?>
                                                  <?php echo "N ".number_format($number, 2);?>
                                                    
                                            </td>   
                                           <td><?=$q->company_name;?></td>
                                           <td>  
                                             <input type="number" name="price[]" value="<?=$q->unit_price;?>">
                                             <input type="hidden" name="vendor[]" value="<?=$q->vendor_ID;?>">
                                                  <input type="hidden" name="rfq_ID" value="<?=$q->rfq_ID;?>">
                                                   <input type="hidden" name="req_detail_ID[]" value="<?=$q->req_detail_ID;?>">
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
               
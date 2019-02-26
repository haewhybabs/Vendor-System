         <style>
            .list-group-item {
                padding: 5px 15px;
             }
        </style>
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CHECK PRODUCT</h6>
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
                 <div class="col-sm-6">
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('products/check') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Requisition Category</label>
                                 <span class="text-danger"><?php echo form_error('cat'); ?></span>
                                <select class="form-control"  name="cat" id="category">
                                  <?php foreach($activities_data as $docs){?>
                                    <option value="<?= $docs->id; ?>"  <?php if(!empty($cat)){ if($docs->id == $cat){ echo 'selected';}}  ?> ><?= $docs->category; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                        </div>
                      
                           <div class="col-sm-6">
                                <div class="form-group"><br>
                                <input type="submit" class="btn btn-success" value="CHECK PRODUCT">
                               </div>
                           </div>
                      </form>
                    </div>
                    
                     <div class="col-sm-6">
                        
                         <h5 class="title text-success"><strong>Products</strong></h5>
                         <ul class="list-group">
                         <?php if(!empty($rows) && count($rows) > 0){
                             foreach($rows as $row){
                             ?>
                         
                          <li class="list-group-item list-group-item-action list-group-item-dark"><?= $row->name ?></li>
                          <?php }} else{echo 'No Product';} ?>
                        </ul>
                   
                    </div>
                </div>
              </div>
            </div>
              </div>
</div>


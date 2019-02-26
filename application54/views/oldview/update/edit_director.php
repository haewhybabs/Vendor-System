         
          <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">EDIT DIRECTOR</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/director_edit_action') ?>">
                      
                           <input type="hidden" name="director_id" value="<?= $director->id;?>">
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Full name</label>
                                 <span class="text-danger"><?php echo form_error('director_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Director Full name" name="director_name" value="<?php echo $director->name; ?>">
                              </div>
                            
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                 <span class="text-danger"><?php echo form_error('director_email'); ?></span>
                                <input type="email" class="form-control form-white" id="email" name="director_email" placeholder="Enter Director email" value="<?php echo $director->email; ?>">
                              </div>
                              
                               <div class="form-group">
                                <label for="exampleInputPassword1">Director Phone</label>
                                 <span class="text-danger"><?php echo form_error('director_phone'); ?></span>
                                <input type="text" name="director_phone" class="form-control form-white" placeholder="Director Primary Phone" value="<?php echo $director->phone; ?>">
                              </div>  
                              <div class="form-group">
                                <label for="exampleInputPassword1">BVN Number</label>
                                 <span class="text-danger"><?php echo form_error('bvn'); ?></span>
                                <input type="text" name="bvn" class="form-control form-white" placeholder="Director BVN" value="<?php echo $director->bvn; ?>">
                              </div> 
                              
                            </div>
                             <div class="col-lg-6">
                                 
                              <div class="form-group">
                                <label for="exampleInputPassword1">New Birth Date</label>
                                 <span class="text-danger"><?php echo form_error('new_birth'); ?></span>
                                <div class="prepend-icon">
                                  <input type="text" name="new_birth" class="b-datepicker form-control form-white" placeholder="Select date.." value="<?php echo $director->new_birth; ?>">
                                  <i class="icon-calendar"></i>
                                </div>
                              </div> 
                              
                              <div class="form-group">
                                <label for="exampleInputPassword1">Date Join Ministry</label>
                                 <span class="text-danger"><?php echo form_error('join_date'); ?></span>
                                <div class="prepend-icon">
                                <input type="text" class="b-datepicker form-control form-white" placeholder="Select date.." name="join_date" value="<?php echo $director->join_ministry; ?>">
                                <i class="icon-calendar"></i>
                              </div>
                              </div> 
                            <div class="form-group">
                                <label for="exampleInputPassword1">Service Group</label>
                                 <span class="text-danger"><?php echo form_error('group'); ?></span>
                                <input type="text" name="group" class="form-control form-white" placeholder="Service Group in Church" id="p_phone" value="<?php echo $director->group; ?>">
                              </div> 
                               <div class="form-group">
                                <label for="exampleInputPassword1">WOFBI status</label>
                                 <span class="text-danger"><?php echo form_error('wofbi[]'); ?></span>
                               <div class="input-group">
                                <div class="col-sm-12">
                                <div class="icheck-inline">
                                  <?php $arry_select = explode(",", $director->wofbi);
                                    ?>
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="BCC" <?php if(in_array('BBC', $arry_select)) { echo 'checked';} ?> name="wofbi[]"> BCC</label>
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="LCC" <?php if(in_array('LCC', $arry_select)) { echo 'checked';} ?> name="wofbi[]"> LCC</label>
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="LDC" <?php if(in_array('LDC', $arry_select)) { echo 'checked';} ?> name="wofbi[]"> LDC</label>
    
                                 </div>
                                  
                                </div>
                              </div>
                                 </div>
                        </div>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="EDIT">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>


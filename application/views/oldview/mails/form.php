         
          <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">UPDATE MAIL SETTINGS</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('mails/edit_action') ?>">
                     
                      <input type="hidden" name="id" value="<?php echo $set_data->id; ?>" />
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Host<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('host'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Servername" name="host" value="<?php echo $set_data->server; ?>">
                              </div>
                              </div> 
                               
                               <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Username <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Email" name="name" value="<?php echo $set_data->username; ?>">
                              </div>
                              </div> 
                              
                               <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('password'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Email Password" name="password" value="<?php echo $set_data->password; ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Audit Dept. Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('audit'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Audit Email" name="audit" value="<?php echo $set_data->audit_mail; ?>">
                              </div>
                              </div> 
                               
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Store Dept. Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('store'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Store Email" name="store" value="<?php echo $set_data->store_mail; ?>">
                              </div>
                              </div> 
                               
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Procurement Dept. Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('procure'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Procurement Email" name="procure" value="<?php echo $set_data->procure_mail; ?>">
                              </div>
                              </div>  
                               
                              <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">SAP Group Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('sap'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Techmical Email" name="sap" value="<?php echo $set_data->sap_mail; ?>">
                              </div>
                              </div> 
                              
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Church Administrator Group Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('admin'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Church Admin Email" name="admin" value="<?php echo $set_data->admin_mail; ?>">
                              </div>
                              </div> 
                              
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Budget Control Group Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('budget'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Budget Email" name="budget" value="<?php echo $set_data->budget_mail; ?>">
                              </div>
                              </div> 
                               
                                 <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Procurement Committee Group Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('dfs'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="DFS Email" name="dfs" value="<?php echo $set_data->dfs_mail; ?>">
                              </div>
                        </div>
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Forensic Group Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('forensic'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Forensic Email" name="forensic" value="<?php echo $set_data->forensic_mail; ?>">
                              </div>
                              </div> 
                                <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Final Approval Mail<span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('rp'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Resident Pastor Email" name="rp" value="<?php echo $set_data->rp_mail; ?>">
                              </div>
                              </div> 
                               
                            
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-success" value="UPDATE CONFIGURATIONS">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>



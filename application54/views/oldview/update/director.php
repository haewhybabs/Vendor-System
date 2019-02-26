         
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Director Details. (* At least two directors are required. All fields required)</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/director_action') ?>">
                      
                           
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Full name <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('director_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Director Full name" name="director_name" value="<?php echo set_value('director_name'); ?>">
                              </div>
                            
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('director_email'); ?></span>
                                <input type="email" class="form-control form-white" id="email" name="director_email" placeholder="Enter Director email" value="<?php echo set_value('director_email'); ?>">
                              </div>
                              
                               <div class="form-group">
                                <label for="exampleInputPassword1">Director Phone <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('director_phone'); ?></span>
                                <input type="text" name="director_phone" class="form-control form-white" placeholder="Director Primary Phone" value="<?php echo set_value('director_phone'); ?>">
                              </div>  
                              <div class="form-group">
                                <label for="exampleInputPassword1">BVN Number <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('bvn'); ?></span>
                                <input type="text" name="bvn" class="form-control form-white" placeholder="Director BVN" value="<?php echo set_value('bvn'); ?>">
                              </div> 
                              
                            </div>
                             <div class="col-lg-6">
                                 
                              <div class="form-group">
                                <label for="exampleInputPassword1">New Birth Date <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('new_birth'); ?></span>
                                <div class="prepend-icon">
                                  <input type="text" name="new_birth" class="b-datepicker form-control form-white" placeholder="Select date.." value="<?php echo set_value('new_birth'); ?>">
                                  <i class="icon-calendar"></i>
                                </div>
                              </div> 
                              
                              <div class="form-group">
                                <label for="exampleInputPassword1">Date Join Ministry </label>
                                 <span class="text-danger"><?php echo form_error('join_date'); ?></span>
                                <div class="prepend-icon">
                                <input type="text" class="b-datepicker form-control form-white" placeholder="Select date.." name="join_date" value="<?php echo set_value('join_date'); ?>">
                                <i class="icon-calendar"></i>
                              </div>
                              </div> 
                            <div class="form-group">
                                <label for="exampleInputPassword1">Service Group </label>
                                 <span class="text-danger"><?php echo form_error('group'); ?></span>
                                <input type="text" name="group" class="form-control form-white" placeholder="Service Group in Church" id="p_phone" value="<?php echo set_value('group'); ?>">
                              </div> 
                               <div class="form-group">
                                <label for="exampleInputPassword1">WOFBI status </label>
                                 <span class="text-danger"><?php echo form_error('wofbi[]'); ?></span>
                               <div class="input-group">
                                <div class="col-sm-12">
                                <div class="icheck-inline">
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="BCC" name="wofbi[]"> BCC</label>
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="LCC" name="wofbi[]"> LCC</label>
                                  <label>
                                  <input type="checkbox" data-checkbox="icheckbox_square-blue" value="LDC" name="wofbi[]"> LDC</label>
    
                                 </div>
                                  
                                </div>
                              </div>
                                 </div>
                        </div>
                           <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="ADD DIRECTOR">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>

 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
           <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>ALL DIRECTORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Director name</th>
                          <th>Email</th>
                          <th class='hidden-350'>Phone</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($director_list as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                          <td><?= $vendor->email ?></td>
                          <td><?= $vendor->phone;?></td>
                           <td class=''>
                              <a href="<?= site_url('update/director_edit/'.$vendor->id); ?>" class="btn btn-primary" title="View / Edit"><span class="fa fa-edit"></span></a>
                              <a href="<?= site_url('update/director_delete/'.$vendor->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

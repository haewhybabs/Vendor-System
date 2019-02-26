 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
          
                   
          <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="font-size: 17px;">CREATE A REQISITION CATEGORY</h6>
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
                 
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('category/create_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Category name <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('service_name'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Service name" name="service_name" value="<?php echo set_value('service_name'); ?>">
                              </div>
                              </div> 
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Department Abbreviation<span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('short'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Department Abbreviation" name="short" value="<?php echo set_value('short'); ?>">
                                </div>
                              </div>
                              
                               <div class="col-lg-6">
                                <div class="form-group">
                                <label>Category Type <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('admin_cat'); ?></span>
                                <select class="form-control"  name="admin_cat" id="category">
                                 <option value=" " selected>Type</option>
                                 <option value="1">Technical</option>
                                  <option value="0">Non Technical</option>
                                
                                </select>
                                </div>
                              </div>
                              
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('admin'); ?></span>
                                <select class="form-control"  name="admin" id="category">
                                 <option value=" " selected>Select Department</option>
                                  <?php foreach($department_list as $list){?>
                                   <option value="<?= $list->id; ?> "><?= $list->dept_name ?></option>
                                  <?php } ?>     
                                </select>
                                </div>
                              </div>
                              
            
                           <div class="col-lg-12">
                                <input type="submit" class="btn btn-success" value="ADD SERVICE">
                           </div>
                      </form>
                </div>
              </div>
            </div>
              </div>
</div>
           <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>LIST OF SERVICES</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Service Name</th>
                           <th>Department</th>
                           <th>Type</th>
                            <th>Abbrev.</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($vendor_list as $vendor){?>
                        <tr>
                          <td><?= $vendor->category ?></td>
                          <td><?= $vendor->dept_name ?></td>
                           <?php if($vendor->service_type== 0){?>
                            <td>Non-Technical</td>
                           <?php }else{ ?>
                            <td>Technical</td>
                            <?php } ?>
                            <td><?= $vendor->short ?></td>
                           <td class='hidden-480'>
                             <a href="<?= site_url('category/edit/'.$vendor->id); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-edit"></span> Edit</a>
                              <a href="<?= site_url('category/delete/'.$vendor->id); ?>" class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span> Delete</a>
        
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
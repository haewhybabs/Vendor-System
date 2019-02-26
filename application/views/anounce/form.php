 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
          
                   
          
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
              <div class="panel panel-info">
                <div class="panel-heading">Vendor Announcement</div>
                <div class="panel-body">
                     <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('anouncement/form_action') ?>">
                      
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Title/Summary <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('title'); ?></span>
                                <input type="text" class="form-control form-white" placeholder="Service name" name="title" value="<?php echo set_value('title'); ?>">
                              </div>
                              </div> 
                              
                             
                              
                              <div class="col-lg-12">
                                <div class="form-group">
                                <label>Content <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('content'); ?></span>
                                    <textarea class="form-control form-white" placeholder="Content" name="content" rows="10"><?php echo set_value('content'); ?>
                                    </textarea>
                                </div>
                              </div>
            
                           <div class="col-lg-12">
                                <input type="submit" class="btn btn-success" value="CREATE NEW VENDOR ANNOUNCEMENT">
                           </div>
                      </form>

                </div>
              </div>
                 
                   
             
           <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Vendor Anouncements List</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Title/Summary</th>
                        
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($set_data as $vendor){?>
                        <tr>
                          <td><?= $vendor->summary ?></td>
                           <td class='hidden-480'>
                             <a href="<?= site_url('anouncement/edit/'.$vendor->id); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-edit"></span> Edit</a>
                              <a href="<?= site_url('anouncement/delete/'.$vendor->id); ?>" class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span> Delete</a>
        
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
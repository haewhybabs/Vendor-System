<div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Contact Person Details. (* At least one contact person is required. All fields required)</h6>
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
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/contact_action'); ?>">
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">First name <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                <input type="text" class="form-control" placeholder="Contact first name" name="first_name" value="<?php echo set_value('first_name'); ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="exampleInputPassword1">Last name <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                <input type="text" class="form-control" placeholder="Contact last name" name="last_name" value="<?php echo set_value('last_name'); ?>">
                              </div>
                            </div>
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('contact_email'); ?></span>
                                <input type="email" class="form-control" id="email" placeholder="Contact email" name="contact_email" value="<?php echo set_value('contact_email'); ?>">
                              </div>
                              
                               <div class="form-group">
                                <label for="exampleInputPassword1">Contact Phone <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('contact_phone'); ?></span>
                                <input type="text" name="contact_phone" class="form-control" placeholder="Contact Phone" id="p_phone" value="<?php echo set_value('contact_phone'); ?>">
                              </div>  
    
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="ADD CONTACT">
                             
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
                  <h3><i class="fa fa-user"></i> <strong>CONTACT PERSONS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Full name</th>
                          <th>Email</th>
                          <th class='hidden-350'>Phone</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($contact_list as $contact){?>
                        <tr>
                          <td><?= $contact->first_name.' '.$contact->last_name ?></td>
                          <td><?= $contact->email ?></td>
                          <td><?= $contact->phone;?></td>
                           <td class=''>
                              <a href="<?= site_url('update/contact_edit/'.$contact->id); ?>" class="btn btn-primary" title="View / Edit"><span class="fa fa-eye"></span></a>
                              <a href="<?= site_url('update/contact_delete/'.$contact->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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

<div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">EDIT CONTACT</h6>
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
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/contact_edit_action') ?>">
                              <input type="hidden" name="contact_id" value="<?= $contact->id;?>">
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">First name</label>
                                 <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                <input type="text" class="form-control" placeholder="Contact first name" name="first_name" value="<?php echo $contact->first_name; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="exampleInputPassword1">Last name</label>
                                 <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                <input type="text" class="form-control" placeholder="Contact last name" name="last_name" value="<?php echo $contact->last_name; ?>">
                              </div>
                            </div>
                             <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                 <span class="text-danger"><?php echo form_error('contact_email'); ?></span>
                                <input type="email" class="form-control" id="email" placeholder="Contact email" name="contact_email" value="<?php echo $contact->email; ?>">
                              </div>
                              
                               <div class="form-group">
                                <label for="exampleInputPassword1">Contact Phone</label>
                                 <span class="text-danger"><?php echo form_error('contact_phone'); ?></span>
                                <input type="text" name="contact_phone" class="form-control" placeholder="Contact Phone" id="p_phone" value="<?php echo $contact->phone; ?>">
                              </div>  
    
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-success btn-square btn-embossed" value="EDIT">
                             
                           </div>
                    </form>
                         </div>
              </div>
</div>
                             </div>
                         </div>
                         

           <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Documents(* Upload your Proposal)</h6>
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
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('proposal/upload_action'); ?>">
                             <input type="hidden" name="quote_id" value="<?= $message->id; ?>">
                                 <div class="col-lg-12">
                               
                                <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Upload Document (PDF/MS-Word Format) <span class="text-danger">*</span></label>
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    
                                    <input type="file" name="document_file" class="form-control" required>
                                    
                                  </div>
                                </div>
                                </div>
                                <div class="col-lg-2">
                               <div class="form-group">
                                <label for="exampleInputPassword1">&nbsp;</label><br>
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="UPLOAD">
                                </div>
                            </div>
                            
                             </div>
                    
                    </form>
                  </div>
                </div>
    </div>
</div>




 

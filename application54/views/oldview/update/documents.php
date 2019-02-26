
           <div class="row">
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Documents(* Attach all available requested supporting documents.)</h6>
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
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/document_action'); ?>">
            
                                 <div class="col-lg-12">
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>Document Name <span class="text-danger">*</span></label>
                                <span class="text-danger"><?php echo form_error('document'); ?></span>
                                <select class="form-control" name="document">
                                 <option value="&nbsp;" selected >Select a document</option>
                                  <?php foreach($document as $docs){?>
                                    <option value="<?= $docs->id; ?>"><?= $docs->name; ?></option>
                                  <?php } ?>
                                </select>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Upload Document (JPG/PNG/PDF/Word Format) <span class="text-danger">*</span></label>
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    
                                    <input type="file" name="document_file" class="form-control">
                                    
                                  </div>
                                </div>
                                </div>
                                <div class="col-lg-2">
                               <div class="form-group">
                                <label for="exampleInputPassword1">&nbsp;</label>
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="UPLOAD">
                                </div>
                            </div>
                            
                             </div>
                    
                    </form>
                  </div>
                </div>
    </div>
</div>
 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
           <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-file"></i> <strong>ALL DOCUMENTS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Document name </th>
                          <th>File</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($support_doc as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                          <td><a href="<?= site_url('') ?>uploads/documents/<?= $vendor->document; ?>" target="_blank"> View Document</a></td>
                           <td class=''>
                              <a href="<?= site_url('update/document_delete/'.$vendor->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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

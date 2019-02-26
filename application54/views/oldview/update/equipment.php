
           <div class="row">
            <div class="col-xlg-2 col-small-stats">
              <div class="row">
                <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h6 class="panel-title" style="">Equipments(* Attach all available equipments.)</h6>
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
                    <form data-style="arrow" role="form" enctype="multipart/form-data" method="post" action="<?= site_url('update/equipment_action'); ?>">
                    
                     <div class="col-lg-12">
                             <div class="col-sm-4">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Equipment name <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('equip_name'); ?></span>
                                <input type="text" name="equip_name" class="form-control" placeholder="Equipment name" id="p_phone" value="">
                              </div>
                              
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Quantity <span class="text-danger">*</span></label>
                                 <span class="text-danger"><?php echo form_error('equip_number'); ?></span>
                                <input type="number" name="equip_number" class="form-control" placeholder="Quantity" id="p_phone" value="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                               <div class="form-group">
                          <label>Equipment Image <span class="text-danger">*</span></label>
                          
                            <input type="file" name="equipment" class="form-control">
                                </div>
                             </div>
                            
                             </div>
                              <div class="col-lg-2">
                               <div class="form-group">
                                <label for="exampleInputPassword1">&nbsp;</label>
                                <input type="submit" class="btn btn-primary btn-square btn-embossed" value="UPLOAD">
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
                  <h3><i class="fa fa-picture-o"></i> <strong>ALL EQUIPMENTS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Equipment name</th>
                          <th>Quantity</th>
                          <th>Image</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($equipment as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                           <td><?= $vendor->quantity ?></td>
                          <td><a href="<?= site_url('') ?>uploads/equipments/<?= $vendor->image; ?>" target="_blank"><img src="<?= site_url('') ?>uploads/equipments/<?= $vendor->image; ?>" width="100px"></a></td>
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

 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
           <div class="row">
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
            <style>
               .modal-backdrop {
                display:none;
               }
            </style>
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>NEW VENDORS</strong></h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <div class="filter-left">
                    <!-- <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='25'> -->
                      <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='100'> 
                      <thead>
                        <tr>
                          <th>Vendor Name</th>
                           <th>Equipment</th>
                           <th>Documents</th>
                            <th>Email</th>
                            <th>Mobile</th>
                           <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($vendor_list as $vendor):?>
                        <tr>
                          <td><?= $vendor->company_name;?></td>
                           <td><?php 
                                $ans=false;
                                foreach($equipment_list as $equip){
                                  if($vendor->supplier_id == $equip->supplier_id){
                                    $ans= true;
                                    break;}}?>
                                <?php if($ans == TRUE){?>
                                <a href="<?= site_url('vendor/equipment/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">Equipments</a>
                                <?php }else{ echo '<span class="text-danger">No Upload</span>';}?>
                            </td>
                             

                               


                          <td> 
                            <?php $docc=false;
                             foreach($document_list as $doc):
                                   if($doc->supplier_id==$vendor->supplier_id):
                                       $docc=true;
                                    break;
                                   endif; 
                               endforeach;?>

                               <?php if($docc==true):?>
                                <a href="<?=base_url();?>Vendor/documents/<?=$vendor->supplier_id ?>"  target="_blank" class="btn btn-success btn-sm"><span class="fa fa-eye"></span>View Document</a>

                              <?php else:?>
                                <span class="text-danger">No Document</span>

                              <?php endif;?>




                           
                          </td>
                            <td>
                                <?=$vendor->email;?>
                            </td>
                           <td>
                                <?=$vendor->primary_phone;?>
                           </td>
                           
                           <td class='hidden-480' style="width:23%">
                              <a href="<?= site_url('vendor/schedule/'.$vendor->supplier_id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-calendar"></span> Schedule</a>
                               <a href="<?= site_url('vendor/reject/'.$vendor->supplier_id);?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Reject</a>
                           </td>
                      
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
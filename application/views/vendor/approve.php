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
                  <h3><i class="fa fa-table"></i> <strong>LIST OF APPROVED VENDORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                   <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='100'> 
                      <thead>
                        <tr>
                          <th>Vendor Name</th>
                           <th>Equipment</th>
                           <th>Category</th>
                            <th>Details</th>
                          <th>Rating</th>
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
                          <td><?php foreach ($category_list as $cat):?>
                                  <?php if($vendor->supplier_id==$cat->supplier_id):?>
                                         <?php echo $cat->category;?>,
                                         <br>
                                  <?php endif;?>
        
                                <?php endforeach;?>
                            </td>
                            <td>
                                <a href="<?= site_url('vendor/details/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">View</a>
                            </td>
                           <td>
                                <a href="<?= site_url('vendor/rating/'.$vendor->supplier_id);?>" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> View</a>    
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
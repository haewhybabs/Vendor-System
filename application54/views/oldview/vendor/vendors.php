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
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>NEW VENDORS</strong></h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='25'>
                      <thead>
                        <tr>
                          <th>Company</th>
                          <th>Phone</th>
                          <th>Email</th>
                           <th>Categories</th>
                          <th class='hidden-350'>Equipment.</th>
                          <th class='hidden-350'>Support Doc.</th>
                          <th>Details</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($vendor_list as $vendor){
                          $sup = explode(',', $vendor->specialty)
                          ?>
                         <tr>
                          <td><?= $vendor->company_name ?></td>
                          <td><?= $vendor->primary_phone ?></td>
                            <td><?= $vendor->email ?></td>
                            <td><?php foreach($category_list as $li){
                                if(in_array($li->id, $sup)){
                                   echo $li->category.', ';
                                }
                                }?></td>
                          <td class='hidden-1024'>
                          	<?php 
                          	$ans=false;
                          	foreach($equipment_list as $equip){
                          		if($vendor->supplier_id == $equip->supplier_id){
                          			$ans= true;
                          			break;}}?>
                          	<?php if($ans == TRUE){?>
                          	<a href="<?= site_url('vendor/equipment/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">Equipments</a>
                          	<?php }else{ echo '<span class="text-danger">No Upload</span>';}?>
                          	</td>
                          <td class='hidden-1024'>
                          	<?php 
                          	$ans2=false;
                          	foreach($document_list as $doc){
                          		if($vendor->supplier_id == $doc->supplier_id){
                          			$ans2= true;
                          			break;}} ?>
                          	<?php if($ans2 == TRUE){?>
                          	<a href="<?= site_url('vendor/documents/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">Documents</a>
                          	<?php }else{ echo '<span class="text-danger">No Upload</span>'; }?>
                        </td>
                          <td class='hidden-480'><a href="<?= site_url('vendor/details/'.$vendor->supplier_id); ?>" class="btn btn-sm btn-success">Details</a></td>
                           <td class='hidden-480' style="width:23%">
                              <a href="<?= site_url('vendor/schedule/'.$vendor->supplier_id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-calendar"></span> Schedule</a>
                               <a href="<?= site_url('vendor/reject/'.$vendor->supplier_id);?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Reject</a>
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
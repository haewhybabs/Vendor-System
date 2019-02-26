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
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>SUPPLY RATINGS FOR <?= strtoupper($supplier_name); ?></strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users" data-page-length='100'> 
                      <thead>
                        <tr>
                           <th>Name</th>
                             <th>Performance Rating</th>
                             <th>Capability Rating</th>
                             
                        </tr>
                      </thead>
                      <tbody>
                       
                        <tr>
                            <td><?=$vendor_list->company_name;?></td>
                            <td><?= $vendor_list->performance_rating; ?><strong>%</strong></td>
                              <td>
                                <?php foreach ($category_list as $cat):?>
                                  <?php echo $cat->category;?> <strong>--</strong> <?php echo $cat->capability_rating;?>%, <br>
                                  
                                <?php endforeach;?>
                              </td>
                        
                   
                        </tr>
                      
                      </tbody>
                     
                    </table>
                  </div>
                  <a href="<?= site_url('vendor/approve_list'); ?>" class="btn btn-sm btn-primary">Back to vendor list</a>
                </div>
              </div>
            </div>
          </div>

       
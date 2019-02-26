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
                  <h3><i class="fa fa-table"></i> <strong>LIST OF PRODUCT</strong></h3>
                   <a href="<?= site_url('products/create') ?>" class="btn btn-danger" style="float:right"><span class="fa fa-plus"></span> Create Product</a>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Category name</th>
                          <th>Product</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php        
                        foreach($product_list as $vendor){?>
                        <tr>
                          <td><?= $vendor->category ?></td>
                           <td><?= $vendor->name ?></td>
                    
                           <td class='hidden-480'>
                              <a href="<?= site_url('products/update/'.$vendor->product_id); ?>" class="btn btn-success btn-sm" ><span class="fa fa-edit"></span> Edit</a>
                              
                              <a href="<?= site_url('products/delete/'.$vendor->product_id); ?>" class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span> Delete</a>
                              
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
          
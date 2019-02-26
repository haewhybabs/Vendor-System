
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
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong><?= strtoupper($supplier_name); ?> EQUIPMENTS</strong></h3>
                </div>
                <div class="panel-content">
                   <div class="row">
                  <?php  
                    if(empty($equipment_list)){
                        echo 'No equipment uploaded';
                    }else{
                    foreach($equipment_list as $equip){?>
                      <div class="col-sm-6">
                          <p class="text-primary"><?= $equip->name; ?>  X(<?= $equip->quantity; ?>)</p><hr>
                        <img class="img-responsive" src="http://procure.lfcww.org/uploads/equipments/<?= $equip->image; ?>">
                      </div>
                            <?php }} ?>
                </div>
                </div>
              </div>
            </div>
             <a class="btn btn-primary btn-sm" href="<?= site_url('vendor'); ?>">Back to vendors</a>
          </div>
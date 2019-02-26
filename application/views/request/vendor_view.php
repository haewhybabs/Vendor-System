    <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                   <h3><strong>VIEW VENDORS</strong></h3>
                </div>
                <div class="panel-content row">
                    <?php foreach($req_list as $list) {?>
                     <div class="col-sm-12">
                          <div class="col-sm-4"><strong>Department:</strong>
                         
                          </div>
                           <div class="col-sm-8"><?= $list->company_name; ?></div>
                      </div>
                      <div class="col-sm-4">
                          
                      </div>
                      
                      <div class="col-sm-4">
                          
                      </div>
                     
                      <?php } ?>
                      <a href="<?= site_url('request/requisition_list') ?>" class="btn btn-primary"><< Back >></a>
                  </div> 
                  </div>
                </div>
              </div>
 
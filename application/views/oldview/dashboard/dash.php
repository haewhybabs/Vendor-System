         
          <div class="row">
           <?php if($roles== 15 || $roles==23){?>
            <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="col-xlg-4 col-lg-4 col-sm-4">
                  <div class="panel">
                    <div class="panel-content widget-small bg-green">
                      <div class="title">
                        <h1 class="text-center"><strong>VENDORS</strong></h1><hr>
                        <div class="col-sm-4 text-center">Pending
                        <h4 class="text-center"><?= $new_vendor; ?></h4>
                          </div>
                          <div class="col-sm-4 text-center">Approved<br>
                          <h4 class="text-center"><?= $approve_vendor; ?></h4>
                          </div>
                         <div class="col-sm-4 text-center">Reject<br>
                          <h4 class="text-center"><?= $reject_vendor; ?></h4>
                        </div>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xlg-4 col-lg-4 col-sm-4">
                  <div class="panel">
                    <div class="panel-content widget-small bg-purple">
                      <div class="title">
                          <h1 class="text-center"><strong>REQUEST FOR QUOTATION</strong></h1><hr>
                        <h4 class="text-center"><?= $q; ?></h4>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xlg-4 col-lg-4 col-sm-4">
                  <div class="panel">
                    <div class="panel-content widget-small bg-primary">
                      <div class="title">
                          <h1 class="text-center"><strong>PURCHASE ORDER</strong></h1><hr>
                        <h4 class="text-center"><?= $p; ?></h4>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>  
              <?php }else{ ?> 
               <div class="col-xlg-12 col-small-stats">
              <div class="row">
                <div class="col-xlg-3 col-lg-3 col-sm-6">
                  <div class="panel">
                    <div class="panel-content widget-small bg-green">
                      <div class="title">
                        <h1 class="text-center"><strong>REQUISITIONS</strong></h1><hr>
                        
                        <h4 class="text-center"><?= count($req_list); ?></h4>
                         
                        </div>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                <div class="col-xlg-3 col-lg-3 col-sm-6">
                  <div class="panel">
                    <div class="panel-content widget-small bg-purple">
                      <div class="title">
                          <h1 class="text-center"><strong>PENDING REQUISITIONS</strong></h1><hr>
                        <h4 class="text-center"><?= $p; ?></h4>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xlg-3 col-lg-3 col-sm-6">
                  <div class="panel">
                    <div class="panel-content widget-small bg-purple">
                      <div class="title">
                          <h1 class="text-center"><strong>APPROVED REQUISITIONS</strong></h1><hr>
                        <h4 class="text-center"><?= $a; ?></h4>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xlg-3 col-lg-3 col-sm-6">
                  <div class="panel">
                    <div class="panel-content widget-small bg-purple">
                      <div class="title">
                          <h1 class="text-center"><strong>DECLINED REQUISITIONS</strong></h1><hr>
                        <h4 class="text-center"><?= $d; ?></h4>
                      </div>
                      <div class="content">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
               
              </div>  
            </div>
               <?php } ?> 
          </div>
        
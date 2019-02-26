             
         <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                   <h3><strong>REQUISITION DETAILS</strong></h3>
                </div>
                <div class="panel-content row">
                     <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Department:</strong></div>
                           <div class="col-sm-6"><?= $details->dept_name; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Product/Service:</strong></div>
                           <div class="col-sm-6"><?= $details->product_service; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Service Category:</strong></div>
                           <div class="col-sm-6"><?= $details->category; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Quantity:</strong></div>
                           <div class="col-sm-6"><?= $details->quantity; ?></div>
                      </div>
                       
                        <div class="col-sm-10">
                            <div class="col-sm-3"><strong>Details:</strong></div>
                           <div class="col-sm-9"><?= $details->details; ?></div>
                      </div>
                      <a href="<?= site_url('requisition/requisition_list') ?>" class="btn btn-primary"><< Back >></a>
                  </div> 
                  </div>
                </div>
              </div>
 
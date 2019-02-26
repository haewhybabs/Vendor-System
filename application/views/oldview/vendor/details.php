             
         <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                   <h3><strong>PROFILE DETAILS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="row">
                       <!--div class="col-sm-5">
                          <div class="col-sm-6">Status:</div>
                           <div class="col-sm-6"><?= $supplier_data->company_name; ?></div>
                      </div-->
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Company name:</strong></div>
                           <div class="col-sm-6"><?= $supplier_data->company_name; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Reference Number:</strong></div>
                           <div class="col-sm-6"><?= $supplier_data->reference_num; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Registration number:</strong></div>
                           <div class="col-sm-6"><?= $supplier_data->registration_no; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Phone:</strong></div>
                           <div class="col-sm-6"><?= $supplier_data->primary_phone; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Email:</strong></div>
                           <div class="col-sm-6"><?= $supplier_data->email; ?></div>
                      </div>
                        
                        <div class="col-sm-10">
                            <div class="col-sm-3"><strong>Address:</strong></div>
                           <div class="col-sm-9"><?= $supplier_data->address; ?></div>
                      </div>
                       
                        <div class="col-sm-10">
                            <div class="col-sm-3"><strong>Specialty:</strong></div>
                           <div class="col-sm-9"><?php $sup = explode(',', $supplier_data->specialty);
                               foreach($document as $doc){
                                   if(in_array($doc->id, $sup)){
                                       echo $doc->category.', ';
                                   }
                               }
                              
                               ?></div>
                      </div>
                  </div> 
                  </div>
                </div>
              </div>
 <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>ALL DIRECTORS</strong></h3>
                </div>
                <div class="panel-content">
                  
                        <?php   
                    $num=1;
                        foreach($director_list as $vendor){?>
                        
                    <div class="row">
                     <h4>Director <?= $num ?></h4><hr>      
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Director name:</strong></div>
                           <div class="col-sm-6"><?= $vendor->name; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Director Phone:</strong></div>
                           <div class="col-sm-6"><?= $vendor->phone; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Director email:</strong></div>
                           <div class="col-sm-6"><?= $vendor->email; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>New Birth:</strong></div>
                           <div class="col-sm-6"><?= $vendor->new_birth; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Date Join Ministry:</strong></div>
                           <div class="col-sm-6"><?= $vendor->join_ministry; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Group in church:</strong></div>
                           <div class="col-sm-6"><?= $vendor->group; ?></div>
                      </div>
                       <div class="col-sm-5">
                            <div class="col-sm-6"><strong>WOFBI:</strong></div>
                           <div class="col-sm-6"><?= $vendor->wofbi; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>BVN:</strong></div>
                           <div class="col-sm-6"><?= $vendor->bvn; ?></div>
                      </div>
                       
                  </div> 
                        
                        <?php $num++; } ?>
                </div>
              </div>
            </div>
          </div>
 <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>CONTACT PERSONS</strong></h3>
                </div>
                <div class="panel-content">
                  <?php   
                    $num=1;
                        foreach($contact_list as $contact){?>
                        
                    <div class="row">
                     <h4>Contact Person <?= $num ?></h4><hr>      
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Contact name:</strong></div>
                           <div class="col-sm-6"><?= $contact->first_name.' '.$contact->last_name; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6"><strong>Contact Phone:</strong></div>
                           <div class="col-sm-6"><?= $contact->phone; ?></div>
                      </div>
                        <div class="col-sm-5">
                            <div class="col-sm-6"><strong>Director email:</strong></div>
                           <div class="col-sm-6"><?= $vendor->email; ?></div>
                      </div>
                       
                        
                       
                  </div> 
                        
                        <?php $num++; } ?>
                </div>
              </div>
            </div>
          </div>
          <a class="btn btn-primary btn-sm" href="<?= site_url('vendor'); ?>">Back to vendors</a>
        </div>
          
        
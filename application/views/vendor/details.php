             
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
                  </div> <br>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Edit Profile</button>

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
        
        </div>


         <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong><?= strtoupper($supplier_name); ?> DOCUMENTS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-bordered table-striped" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Document name</th>
                          <th class='hidden-350'>View</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($document_list as $doc){?>
                        <tr>
                          <td><?= $doc->name ?></td>
                             <td class='hidden-480'>
                              <a href="http://procure.lfcww.org/uploads/documents/<?= $doc->document; ?>"  target="_blank" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> View</a>
                              </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--  <a class="btn btn-primary btn-sm" href="<?= site_url('Vendor/approve_list'); ?>">Back to vendors</a> -->
          </div>



          
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Profile Details</h4>
                </div>
                <div class="modal-body">
                  <form action="<?=base_url();?>Vendor/edit_profile" method="POST">
                  <div class="form-group">
                    <label for="name">Company name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?=$supplier_data->company_name;?>">
                  </div>
                  <div class="form-group">
                    <label for="registration_no">Registration Number:</label>
                    <input type="text" class="form-control" id="registration_no" name="registration_no" value="<?=$supplier_data->registration_no;?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$supplier_data->email;?>">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?=$supplier_data->address;?>">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="number" value="<?=$supplier_data->primary_phone;?>" name="primary_phone">
                  </div>
                  <input type="hidden" name="supplier_id" value="<?=$supplier_data->supplier_id;?>">
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>_data
          </div>
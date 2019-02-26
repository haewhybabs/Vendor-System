             
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
                          <div class="col-sm-6">Company name:</div>
                           <div class="col-sm-6"><?= $supplier_data->company_name; ?></div>
                      </div>
                      <div class="col-sm-5">
                          <div class="col-sm-6">Reference Number:</div>
                           <div class="col-sm-6"><?= $supplier_data->reference_num; ?></div>
                      </div>
                        <div class="col-sm-5">
                          <div class="col-sm-6">Registration number:</div>
                           <div class="col-sm-6"><?= $supplier_data->registration_no; ?></div>
                      </div>
                        <div class="col-sm-5">
                          <div class="col-sm-6">Phone:</div>
                           <div class="col-sm-6"><?= $supplier_data->primary_phone; ?></div>
                      </div>
                      
                        <div class="col-sm-5">
                          <div class="col-sm-6">Email:</div>
                           <div class="col-sm-6"><?= $supplier_data->email; ?></div>
                      </div>
                        
                        <div class="col-sm-10">
                          <div class="col-sm-3">Address:</div>
                           <div class="col-sm-6"><?= $supplier_data->address; ?></div>
                      </div>
                       
                        <div class="col-sm-10">
                          <div class="col-sm-3">Specialty:</div>
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
          </div>
 <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>ALL DIRECTORS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Director name</th>
                          <th>Email</th>
                          <th class='hidden-350'>Phone</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($director as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                          <td><?= $vendor->email ?></td>
                          <td><?= $vendor->phone;?></td>
                           <td class=''>
                              <a href="<?= site_url('update/director_edit/'.$vendor->id); ?>" class="btn btn-primary" title="View / Edit"><span class="fa fa-eye"></span></a>
                              <a href="<?= site_url('update/director_delete/'.$vendor->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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
 <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>CONTACT PERSONS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Full name</th>
                          <th>Email</th>
                          <th class='hidden-350'>Phone</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($contact as $contact){?>
                        <tr>
                          <td><?= $contact->first_name.' '.$contact->last_name ?></td>
                          <td><?= $contact->email ?></td>
                          <td><?= $contact->phone;?></td>
                           <td class=''>
                              <a href="<?= site_url('update/contact_edit/'.$contact->id); ?>" class="btn btn-primary" title="View / Edit"><span class="fa fa-eye"></span></a>
                              <a href="<?= site_url('update/contact_delete/'.$contact->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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
          
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-file"></i> <strong>ALL DOCUMENTS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Document name </th>
                          <th>File</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($support as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                          <td><a href="<?= site_url('') ?>uploads/documents/<?= $vendor->document; ?>" target="_blank"> View Document</a></td>
                           <td class=''>
                              <a href="<?= site_url('update/document_delete/'.$vendor->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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
 <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-picture-o"></i> <strong>ALL EQUIPMENTS</strong></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table" data-table-name="Total users">
                      <thead>
                        <tr>
                          <th>Equipment name</th>
                          <th>Quantity</th>
                          <th>Image</th>
                          <th class='hidden-350'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php        
                        foreach($equipment as $vendor){?>
                        <tr>
                          <td><?= $vendor->name ?></td>
                           <td><?= $vendor->quantity ?></td>
                          <td><a href="<?= site_url('') ?>uploads/equipments/<?= $vendor->image; ?>" target="_blank"><img src="<?= site_url('') ?>uploads/equipments/<?= $vendor->image; ?>" width="100px"></a></td>
                           <td class=''>
                              <a href="<?= site_url('update/document_delete/'.$vendor->id); ?>" class="btn btn-danger" title="Delete"><span class="fa fa-trash"></span></a>
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

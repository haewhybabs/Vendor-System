 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
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
             <a class="btn btn-primary btn-sm" href="<?= site_url('vendor'); ?>">Back to vendors</a>
          </div>
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
    
      <form method="post" action="<?= site_url('quotes/assign_action');?>" enctype="multipart/form-data">
        <input type="hidden" name="req_id" value="<?= $req_id; ?>">
    <div class="col-lg-12 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3><i class="fa fa-table"></i> <strong>Vendor Quotes</strong></h3>
            </div>
            <div class="panel-content">
                <div class="filter-left">
                   <div class="input-group">
                                <select name="action" class="form-control" id="action" required>
                                    <option value="assign">Assign For Purchase Order</option>
                                </select>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-success">ASSIGN</button>
                                </div>
                            </div>
                    <table class="table table-tools table-dynamic table-bordered table-striped" data-table-name="Total users">
                        <thead>
                        <tr>
                            <th>Check</th>
                            <th>Company</th>
                            <th>Phone</th>
                             <th>Status</th>
                              <th>Deadline</th>
                               <th>Submitted</th>
                               <th>RFQ. No</th>
                            <th class='hidden-350'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $arry_select = explode(",", $assign_vendor);
                        foreach($quotes as $quote){?>
                            <tr>
                                <td><input type="checkbox" name="echeck[]" class="echeck" value="<?= $quote->supplier_id; ?>" <?php if(in_array($quote->supplier_id, $arry_select)){echo 'checked';} ?>  <?php if($quote->sent_quotation != 1){ echo 'disabled'; }?>/></td>
                                <td><?= $quote->company_name ?></td>
                                <td><?= $quote->primary_phone ?></td>
                                <td><?php if($quote->sent_quotation != 1){ echo '<span class="text-danger">Not received</span>';}else{ echo '<span class="text-success">Received</span>';} ?></td>
                                <td><?=$quote->end_date;?></td>
                                 <td><?=$quote->submission_date;?></td>
                                  <td><?= strtoupper($quote->rfp_number);?></td>
                                <td class='hidden-480'>
                                   <?php if($quote->upload != NULL){ ?>
                                    <a href="http://procurelfcww.org/uploads/quotes/<?php echo $quote->upload; ?>"  target="_blank" class="btn btn-success btn-sm" ><span class="fa fa-eye"></span> View Quote</a>
                                <?php } ?>
                                   
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
     </form>
     <a href="<?=  site_url('quotes/lists');?>" class="btn btn-primary"> << Back</a>
</div>
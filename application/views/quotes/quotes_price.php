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
            <div class="panel-header panel-controls">
                <h3><i class="fa fa-table"></i> <strong>Quotes</strong></h3>
            </div>
            <div class="panel-content">
                <div class="filter-left">
                    <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                        <thead>
                        <tr>
                            <th>Company name</th>
                            <th>Phone</th>
                            <th class='hidden-350'>Product Service</th>

                            <th>Specification</th>
                            <th>Price</th>
                            <th class='hidden-350'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                     //   var_dump($quotes);
                        foreach($quotes as $quote){?>
                            <tr>
                                <td><?= $quote->company_name ?></td>
                                <td><?= $quote->primary_phone ?></td>
                                <td class='hidden-350'><?= $quote->product_service ?></td>

                                <td class='hidden-480'><?= $quote->specification ?></td>
                                <td class='hidden-480'><?php if($quote->quote_price == ""){ echo "Not Set";}else{ echo number_format($quote->quote_price);} ?></td>
                                <td class='hidden-480'>
                                    <?php if($quote->quote_price == ""){ ?>
                                        <form action="<?php echo  site_url('quotes/set_price_action'); ?>" method="post">
                                            <input type="number" name="price" value=""/>
                                            <input type="hidden" name="req_id" value="<?php echo $quote->id; ?>"/>
                                    <input type="submit" class="btn btn-success btn-sm" value="Set Price" />
                                        </form>
                                        <?php } ?>
                                    <?php if($quote->quote_price != "" && $quote->budget_status == "0"){ ?>
                                        <form action="<?php echo  site_url('quotes/set_price_action'); ?>" method="post">
                                            <input type="number" name="price" value=""/>
                                            <input type="hidden" name="req_id" value="<?php echo $quote->id; ?>"/>
                                            <input type="submit" class="btn btn-success btn-sm" value="Edit Price" />
                                        </form>
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
</div>
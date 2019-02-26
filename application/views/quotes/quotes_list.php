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
                <?php foreach($getprice as $r):?>
                <?php endforeach;?>
                              
     
    <div class="col-lg-12 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3><i class="fa fa-table"></i> <strong>Vendor Quotes</strong></h3>
            </div>
            <div class="panel-content">
                <div class="filter-left">
                   <div class="input-group">
                               
                             
                            </div>
                    <table class="table table-tools table-dynamic table-bordered table-striped" data-table-name="Total users">
                        <thead>
                        <tr>
                           
                        
                            <th>PRODUCT</th>
                            <th>SPECIFICATION</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($getprice as $quote){?>
                            <tr>
                            
                                
                                <td><?=$quote->product_name;?></td>
                                <td><?=$quote->product_specification;?></td>
                                <td><?=$quote->quantity?></td>
                                <td>

                                <?php $number=$quote->unit_price;?>
                                <?php echo "N ".number_format($number, 2);?>
                                </td>
                                <td> <?php $number=$quote->unit_price * $quote->quantity;?>
                                <?php echo "N ".number_format($number, 2);?></td>
                                                   
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
                              
                            
        </div>
    </div>
     <a href="<?=  site_url('quotes/lists');?>" class="btn btn-primary"> << Back</a>
</div>
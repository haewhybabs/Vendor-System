<link type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.themify.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url(); ?>assets/css/list.css" rel="stylesheet">

<?php
if ($this->session->userdata('error') <> '') {
    echo '<div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="ti ti-alert"></i>&nbsp; <strong>Error!</strong> There are some errors happening
                <p>' . $this->session->userdata("error") . '</p>
            </div>';
}
if ($this->session->userdata('message') <> '') {
    echo '<div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><p><i class="ti ti-check"></i>&nbsp; ' . $this->session->userdata("message") . '</p></strong>
            </div>';
}
?>

<div data-widget-group="group1">
    <div class="row">
        <div class="col-md-12">
            <div id="set">
                <div class="panel">
                    <div class="panel-header">
                      <h3><i class="fa fa-table"></i> <strong>User Lists</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="filter-left">
                            <table class="table table-dynamic table-tools table-bordered table-striped" data-table-name="Total users">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                        <th>Created Date</th>
                                 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1;
                                    foreach ($users as $user):?>
                                    
                                        <tr>
                                            <td><?=$x++;?></td>
                                            <td><?=$user->firstname;?></td>
                                            <td><?=$user->email;?></td>

                                            <td>
                                                <a href="<?=base_url();?>Permission/user_modify/<?=$user->id;?>" class="btn btn-primary btn-xs">Edit User Role</a>
                                            </td>
                                            <td><?=$user->created_time;?></td>
                                            
                                        </tr>
                                        <?php $x++;?>
                                    <?php endforeach;?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
            </div>

        </div>
    </div>




    <script type="text/javascript">
        
        $(document).ready(function(){

            // $("#set").hide();



            //     $('#roleID').on('change',function(){
            //        var category_id=$(this).val();
            //         if(category_id=='')
            //         {
            //             $('#set').hide();
            //         }
            //         else{
            //             $("#set").show();
            //         }
                    
            //     });
        });
    </script>
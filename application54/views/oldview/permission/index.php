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
            <div class="panel panel-default list-panel">
                <div class="panel-heading">
                    <h2>Permission</h2>
                    <div class="panel-ctrls">

                    </div>
                </div>
                <div class="panel-body no-padding">
                    <div class="form-group">

                            <select class="col-md-offset-4 col-md-4 " name="roleID" id="roleID">
                                <option>---------------------Please Select Role----------------------</option>
                                <?php foreach($usertypes as $role){
                                   if($role->role_name != "Super Admin" && $role->role_name != "Admin"){

                                    ?>


                                <option value="<?php echo $role->role_ID; ?>" <?php if (isset($set) && $set == $role->role_ID){echo "selected"; } ?>><?php echo $role->role_name; ?></option>
                                <?php }} ?>
                            </select>
                    </div>
                    <?php if (isset($set)): ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?=base_url('permission/save/'.$set)?>" class="form-horizontal" role="form" method="post" id="usertype">
                                    <div id="hide-table">
                                        <table id="" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                            <tr>
                                                <th class="col-lg-1">#</th>
                                                <th class="col-lg-3">Module Name</th>
                                                <th class="col-lg-1">Create</th>
                                                <th class="col-lg-1">Update</th>
                                                <th class="col-lg-1">Delete</th>
                                                <th class="col-lg-1">View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $permissionTable    = array();
                                            $permissionCheckBox = array();
                                            $permissionCheckBoxVal = array();
                                            foreach ($permissions as $data) {
                                                if(strpos($data->name, '_edit') == false && strpos($data->name, '_view') == false && strpos($data->name, '_delete') == false && strpos($data->name, '_add') == false && strpos($data->name, '_concur') == false) {
                                                    $push['name'] = $data->name;
                                                    $push['description'] = $data->desc;
                                                    $push['status'] = $data->active;

                                                    array_push($permissionTable, $push);

                                                }
                                                $permissionCheckBox[ $data->name ] = $data->active;
                                                $permissionCheckBoxVal[ $data->name ] = $data->permission_ID;

                                            }
                                            ?>
                                            <?php
                                            $i = 1;
                                            foreach($permissionTable as $data) { ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php
                                                        //echo $i;
                                                        $status = "";
                                                        if(isset($permissionCheckBox[$data['name']])) {
                                                            if ($permissionCheckBox[$data['name']]=="yes") {
                                                                if ($permissionCheckBoxVal[$data['name']]) {
                                                                    echo "<input type='checkbox' name=".$data['name']." value=".$permissionCheckBoxVal[$data['name']]." checked='checked' id=".$data['name']." onClick='$(this).processCheck();'>";
                                                                }
                                                            } else {
                                                                if ($permissionCheckBoxVal[$data['name']]) {
                                                                    $status = "disabled";
                                                                    echo "<input type='checkbox' name=".$data['name']." value=".$permissionCheckBoxVal[$data['name']]." id=".$data['name']."  onClick='$(this).processCheck();' >";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('module_name')?>">
                                                        <?php echo $data['description']; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('permission_add')?>">
                                                        <?php
                                                        if(isset($permissionCheckBox[$data['name'].'_add'])) {
                                                            if ($permissionCheckBox[$data['name'].'_add']=="yes") {
                                                                if ($permissionCheckBoxVal[$data['name'].'_add']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_add'."' value=".$permissionCheckBoxVal[$data['name'].'_add']." checked='checked' id='".$data['name'].'_add'."' ".$status.">";
                                                                }
                                                            } else {
                                                                if ($permissionCheckBoxVal[$data['name'].'_add']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_add'."' value=".$permissionCheckBoxVal[$data['name'].'_add']." id='".$data['name'].'_add'."' ".$status.">";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('permission_edit')?>">
                                                        <?php
                                                        if(isset($permissionCheckBox[$data['name'].'_edit'])) {
                                                            if ($permissionCheckBox[$data['name'].'_edit']=="yes") {
                                                                if ($permissionCheckBoxVal[$data['name'].'_edit']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_edit'."' value=".$permissionCheckBoxVal[$data['name'].'_edit']." checked='checked' id='".$data['name'].'_edit'."' ".$status.">";
                                                                }
                                                            } else {
                                                                if ($permissionCheckBoxVal[$data['name'].'_edit']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_edit'."' value=".$permissionCheckBoxVal[$data['name'].'_edit']." id='".$data['name'].'_edit'."' ".$status.">";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('permission_delete')?>">
                                                        <?php
                                                        if(isset($permissionCheckBox[$data['name'].'_delete'])) {
                                                            // echo "delete";
                                                            if ($permissionCheckBox[$data['name'].'_delete']=="yes") {
                                                                if ($permissionCheckBoxVal[$data['name'].'_delete']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_delete'."' value=".$permissionCheckBoxVal[$data['name'].'_delete']." checked='checked' id='".$data['name'].'_delete'."' ".$status.">";
                                                                }
                                                            } else {
                                                                if ($permissionCheckBoxVal[$data['name'].'_delete']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_delete'."' value=".$permissionCheckBoxVal[$data['name'].'_delete']." id='".$data['name'].'_delete'."' ".$status.">";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('permission_view')?>">
                                                        <?php
                                                        if(isset($permissionCheckBox[$data['name'].'_view'])) {
                                                            if ($permissionCheckBox[$data['name'].'_view']=="yes") {
                                                                if ($permissionCheckBoxVal[$data['name'].'_view']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_view'."' value=".$permissionCheckBoxVal[$data['name'].'_view']." checked='checked' id='".$data['name'].'_view'."' ".$status.">";
                                                                }
                                                            } else {
                                                                if ($permissionCheckBoxVal[$data['name'].'_view']) {
                                                                    echo "<input type='checkbox' name='".$data['name'].'_view'."' value=".$permissionCheckBoxVal[$data['name'].'_view']." id='".$data['name'].'_view'."' ".$status.">";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                   
                                                </tr>
                                                <?php $i++; } ?>
                                            <tr>
                                                <td colspan="6" rowspan="2">
                                                    <input class="btn btn-success" type="submit" name="" value="Save Permission">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div><!-- row -->
                    <?php endif ?>

                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatable.js"></script>
<script type="text/javascript">

    var usertypeID = $("#usertypeID").val();

    $('#roleID').change(function(event) {
        var roleID = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('permission/permission_list')?>",
            data: "roleID=" + roleID,
            dataType: "html",
            success: function(data) {
                console.log(data);
                window.location.href = data;
            }
        });
    });
    $.fn.processCheck = function() {
        var id = $(this).attr('id');
        if ($('input#'+id).is(':checked')) {
            if ($('input#'+id+"_add").length) {
                $('input#'+id+"_add").prop('disabled', false);
                $('input#'+id+"_add").prop('checked', true);
            }
            if ($('input#'+id+"_edit").length) {
                $('input#'+id+"_edit").prop('disabled', false);
                $('input#'+id+"_edit").prop('checked', true);
            }
            if ($('input#'+id+"_delete").length) {
                $('input#'+id+"_delete").prop('disabled', false);
                $('input#'+id+"_delete").prop('checked', true);
            }
            if ($('input#'+id+"_view").length) {
                $('input#'+id+"_view").prop('disabled', false);
                $('input#'+id+"_view").prop('checked', true);
            }
        } else {
            if ($('input#'+id+"_add").length) {
                $('input#'+id+"_add").prop('disabled', true);
                $('input#'+id+"_add").prop('checked', false);
            }
            if ($('input#'+id+"_edit").length) {
                $('input#'+id+"_edit").prop('disabled', true);
                $('input#'+id+"_edit").prop('checked', false);
            }
            if ($('input#'+id+"_delete").length) {
                $('input#'+id+"_delete").prop('disabled', true);
                $('input#'+id+"_delete").prop('checked', false);
            }
            if ($('input#'+id+"_view").length) {
                $('input#'+id+"_view").prop('disabled', true);
                $('input#'+id+"_view").prop('checked', false);
            }
        }
    };

</script>
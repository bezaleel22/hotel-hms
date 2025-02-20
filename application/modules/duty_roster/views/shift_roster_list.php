<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <?php if ($this->permission->method('duty_roster', 'create')->access()) : ?>
                <h4><?php echo display('assigned_roster_list') ?>
                    <small class="float-right">

                        <a href="<?php echo base_url("duty_roster/shift-assign") ?>" class="btn btn-primary btn-md">
                            <i class="ti-align-justify" aria-hidden="true"></i> <?php echo display('assigned_empl_list') ?>
                        </a></small>
                </h4>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable"
                        class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('shift_start') ?></th>
                                <th><?php echo display('shift_end') ?></th>
                                <th><?php echo display('shift_name') ?></th>

                                <th><?php echo display('action') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sftrosterlist)) { 
                                $sl = 1;
                                foreach ($sftrosterlist as $row) { 
                                $shift = $this->db->select("shift_name")
                                ->from('tbl_empwork_shift')
                                ->where('shiftid',$row->shift_id)
                                ->get()
                                ->row();
                            ?>
                            <tr class="">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($row->roster_start); ?></td>
                                <td><?php echo html_escape($row->roster_end); ?></td>
                                <td><?php echo html_escape($shift->shift_name); ?></td>
                                <td class="center">

                                <?php if ($this->permission->method('duty_roster', 'update')->access()) :
                                    $today = date('Y-m-d');
                                    if($row->roster_end >= $today ){?>
                                        <a href="<?php echo html_escape(base_url("duty_roster/Shift_management/update_shiftassign_form/" . $row->roster_id)) ?>" class="btn btn-info btn-sm" title="Update "><i class="ti-pencil" aria-hidden="true"></i>
                                        </a>
                                        <?php } endif; ?>

                                    <?php if ($this->permission->method('duty_roster', 'read')->access()) : ?>
                                    <input name="url" type="hidden" id="url_<?php echo html_escape($row->roster_id); ?>"
                                        value="<?php echo base_url("duty_roster/Shift_management/roster_emp_view") ?>" />
                                    <a onclick="editinfo('<?php echo html_escape($row->roster_id); ?>')"
                                        class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left"
                                        title="view"><i class="far fa-eye text-white" aria-hidden="true"></i></a>
                                    <?php endif; ?>

                                    <?php if ($this->permission->method('duty_roster', 'delete')->access()) : ?>
                                    <a href="<?php echo html_escape(base_url("duty_roster/shift_management/delete_assigned_roster/". $row->roster_id)) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('<?php echo display('are_you_sure') ?>') "
                                        title="Delete "><i class="ti-trash" aria-hidden="true"></i>
                                    </a>
                                    <?php endif; ?>

                                </td>

                            </tr>
                            <?php $sl++; ?>
                            <?php }; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
<div id="edit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('view') ?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>
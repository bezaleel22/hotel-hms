<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div id="edit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('shift_assign_update');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <?php if ($this->permission->method('duty_roster', 'create')->access()) : ?>
                <h4><?php echo display('assigned_empl_list') ?>
                <small class="float-right">
                <a href="<?php echo base_url("duty_roster/roster-list") ?>" class="btn btn-primary btn-md">
                            <i class="ti-align-justify" aria-hidden="true"></i> <?php echo display('assigned_empl_list') ?>
                        </a>
                <a href="<?php echo base_url("duty_roster/shift-assign-add") ?>" class="btn btn-primary btn-md">
                            <i class="ti-plus" aria-hidden="true"></i><?php echo display('shift_assign_add') ?>
                        </a></small></h4>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable"
                        class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('assign_employee') ?></th>
                                <th><?php echo display('shift_name') ?></th>
                                <th><?php echo display('shift_start') ?></th>
                                <th><?php echo display('shift_end') ?></th>
                                
                                <th><?php echo display('action') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sftasn_datalist)) { ?>
                            <?php $sl = 1;?>
                            <?php foreach ($sftasn_datalist as $row) { 
                            $shift = $this->db->select("shift_name")
                            ->from('tbl_empwork_shift')
                            ->where('shiftid',$row->shift_id)
                            ->get()
                            ->row();
                            ?>
                            <tr class="">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($row->first_name.' '.$row->last_name); ?></td>
                                <td><?php echo html_escape($shift->shift_name); ?></td>
                                <td><?php echo html_escape($row->roster_start); ?></td>
                                <td><?php echo html_escape($row->roster_end); ?></td>
                              
                                <td class="center">

                                    <?php if ($this->permission->method('duty_roster', 'delete')->access()) : ?>
                                    <a href="<?php echo html_escape(base_url("duty_roster/shift_management/delete_shiftassign/". $row->roster_id.'/'. $row->emp_id)) ?>"
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
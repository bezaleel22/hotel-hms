<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('shift_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body shifttimechk">
                <?php echo form_open('duty_roster/shift_management/create_shift') ?>
                <div class="row">

                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="shift_name" class="col-sm-5 col-form-label"><?php echo display('shift_name') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="shift_name" class="form-control"
                                id="shift_name" placeholder="<?php echo display('shift_name') ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift_start"
                                class="col-sm-5 col-form-label"><?php echo display('shift_start') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="shift_start" onchange="shifttimechk(),check_inshift(),checkduplicateshift()"  id="shift_start"
                                    class="form-control hrmtimepicker"
                                    placeholder="<?php echo display('shift_start') ?>">

                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="shift_end" class="col-sm-5 col-form-label"><?php echo display('shift_end') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required disabled name="shift_end" id="shift_end"
                                    class="form-control hrmtimepickernew" onchange="shifttimechk(),check_inshift(),checkduplicateshift2()" placeholder="<?php echo display('shift_end') ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift_time" class="col-sm-5 col-form-label"><?php echo display('shift_time') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required readonly name="shift_time" id="shifttimetotal"
                                    class="form-control" placeholder="<?php echo display('shift_time') ?>">

                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button id="disabledmode" disabled type="submit" onclick="checkgapshift()" class="btn btn-success w-md m-b-5 submitshiftbtn"><?php echo display('Ad') ?></button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div id="edit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('shift_update');?></strong>
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
                <h4><?php echo display('shift_list') ?><small class="float-right">
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="ti-plus" aria-hidden="true"></i>
                            <?php echo display('shift_add') ?></button></small></h4>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable"
                        class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('shift_name') ?></th>
                                <th><?php echo display('shift_start') ?></th>
                                <th><?php echo display('shift_end') ?></th>
                                <th><?php echo display('shift_hour') ?></th>
                                <th><?php echo display('action') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($shift_datalist)) { ?>
                            <?php $sl = 1;?>
                            <?php foreach ($shift_datalist as $row) { ?>
                            <tr class="">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($row->shift_name); ?></td>
                                <td><?php echo html_escape($row->shift_start); ?></td>
                                <td><?php echo html_escape($row->shift_end); ?></td>
                                <td><?php echo html_escape($row->shift_duration); ?></td>



                                <td class="center">

                                    <?php if ($this->permission->method('duty_roster', 'update')->access()) : ?>
                                    <input name="url" type="hidden" id="url_<?php echo html_escape($row->shiftid); ?>"
                                        value="<?php echo base_url("duty_roster/shift_management/update_shift_form") ?>" />
                                    <a onclick="editinfo('<?php echo html_escape($row->shiftid); ?>')"
                                        class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                        title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>


                                    <?php endif; ?>

                                    <?php if ($this->permission->method('duty_roster', 'delete')->access()) : 
                                    $chk_shift_insert = $this->db->select('shift_id')->from('tbl_duty_roster')->where('shift_id',$row->shiftid)->get()->num_rows();
                                    if ($chk_shift_insert <= 0) {
                                    ?>
                                    <a href="<?php echo html_escape(base_url("duty_roster/shift_management/delete_shift/" . $row->shiftid)) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('<?php echo display('are_you_sure') ?>') "
                                        title="Delete "><i class="ti-trash" aria-hidden="true"></i>
                                    </a>
                                    <?php } endif; ?> 

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
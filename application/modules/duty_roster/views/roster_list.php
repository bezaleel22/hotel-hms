<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong> <?php echo display('create_roster');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="arstrentryshk">
                <?php echo form_open_multipart('duty_roster/shift_management/create_roster') ?>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="shift_name"
                                class="col-sm-5 col-form-label"><?php echo display('shift_name') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('shift_id[]',$shift_list,null,'class="form-control selectpicker" required id="roster_shift_id"  multiple="multiple"') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for=""
                                class="col-sm-5 col-form-label"><?php echo display('roster_start_date') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="roster_start_date" onchange="rosterdatechk(), rosterdatechk2(), rostdaychk()"  id="roster_start_date"
                                    class="form-control datepickerwithoutprevdate"
                                    placeholder="<?php echo display('roster_start_date') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('roster_end_date') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="roster_end_date" id="roster_end_date"
                                    class="form-control datepickerwithoutprevdates" onchange="rosterdatechk(), rosterdatechk2(), rostdaychk()" placeholder="<?php echo display('roster_end_date') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roster_days" class="col-sm-5 col-form-label"><?php echo display('roster_days') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required readonly name="roster_days" id="roster_days"
                                    class="form-control" placeholder="<?php echo display('roster_days') ?>">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="reset"
                                class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button id="disabledmode" disabled type="submit"
                                class="btn btn-success w-md m-b-5 submitrosterbtn"><?php echo display('Ad') ?></button>
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
                <strong><?php echo display('roster_edit');?></strong>
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
                <h4> <?php echo display('roster_list') ?><small class="float-right">
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="ti-plus" aria-hidden="true"></i>
                            <?php echo display('create_roster') ?></button></small></h4>
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
                                <th><?php echo display('roster_start_date') ?></th>
                                <th><?php echo display('roster_end_date') ?></th>
                                <th><?php echo display('roster_days') ?></th>
                                <th><?php echo display('action') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($shift_rosterlist)) { ?>
                            <?php $sl = 1;?>
                            <?php foreach ($shift_rosterlist as $row) { ?>
                            <tr class="">
                                <?php 
                                $shiftnames = $this->db->select("tbl_empwork_shift.shift_name")
                                ->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id','left')
                                ->from('tbl_duty_roster')
                                ->where('tbl_duty_roster.roster_start',$row->roster_start)
                                ->where('tbl_duty_roster.roster_end',$row->roster_end)
                                ->get()
                                ->result();
                                ?>
                                <td><?php echo $sl; ?></td>
                                <td><?php 
                                $nlist = '';
                                foreach ($shiftnames as $shiftname) {
                                     $nlist.= $shiftname->shift_name.', ';
                                }
                                
                                 echo $list =rtrim($nlist, ', ');
                                ?></td>
                                <td><?php echo html_escape($row->roster_start); ?></td>
                                <td><?php echo html_escape($row->roster_end); ?></td>
                                <td><?php echo html_escape($row->roster_dsys); ?></td>
                                <td class="center">
                                    <?php if ($this->permission->method('duty_roster', 'update')->access()) : 
                                    $cr_date = date("Y-m-d");    
                                    if($row->roster_start >$cr_date){?>
                                    <input name="url" type="hidden" id="url_<?php echo html_escape($row->rostentry_id); ?>"
                                        value="<?php echo base_url("duty_roster/shift_management/update_roster_form") ?>" />
                                    <a onclick="editinfo('<?php echo html_escape($row->rostentry_id); ?>')"
                                        class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                        title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>


                                    <?php } endif; ?>
                                    <?php if ($this->permission->method('duty_roster', 'delete')->access()) : 
                                        $chk_roster_insert = $this->db->select('emp_startroster_date')->from('tbl_emproster_assign')->where('emp_startroster_date',$row->roster_start)->get()->num_rows();
                                        if ($chk_roster_insert <= 0) {
                                        ?>
                                    <a href="<?php echo html_escape(base_url("duty_roster/shift_management/delete_roster/" . $row->roster_start.'/'.$row->roster_end)) ?>"
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
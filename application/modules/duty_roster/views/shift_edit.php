<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body shifttimechk">
                <?php echo form_open('duty_roster/shift_management/update_shift_form') ?>
                <?php echo form_hidden('shiftid', (!empty($shiftinfo->shiftid)?$shiftinfo->shiftid:null)) ?>
                <div class="row">
                <input type="hidden" name="shift_id" id="shift_id" value="<?php echo html_escape((!empty($shiftinfo->shiftid)?$shiftinfo->shiftid:null)) ?>" >
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="shift_name" class="col-sm-5 col-form-label"><?php echo display('shift_name') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="shift_name" class="form-control"
                                value="<?php echo html_escape((!empty($shiftinfo->shift_name)?$shiftinfo->shift_name:null)) ?>" placeholder="<?php echo display('shift_name') ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift_start"
                                class="col-sm-5 col-form-label"><?php echo display('shift_start') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="shift_start" onchange="shifttimechk(), checkshiftstart()" id="shift_start2"
                                value="<?php echo html_escape((!empty($shiftinfo->shift_start)?$shiftinfo->shift_start:null)) ?>" class="form-control hrmtimepicker2"
                                    placeholder="<?php echo display('shift_start') ?>">
                                <input type="hidden" name="shift_starth2"  id="shift_starth2" value="<?php echo html_escape((!empty($shiftinfo->shift_start)?$shiftinfo->shift_start:null)) ?>">

                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                                <label for="shift_end" class="col-sm-5 col-form-label"><?php echo display('shift_end') ?> <i
                                        class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                    <input type="text" required name="shift_end" onchange="shifttimechk(), checkshiftend()" id="shift_end2"
                                    value="<?php echo html_escape((!empty($shiftinfo->shift_end)?$shiftinfo->shift_end:null)) ?>"   class="form-control hrmtimepicker2" placeholder="<?php echo display('shift_end') ?>">

                                    <input type="hidden" name="shift_endh2" id="shift_endh2"value="<?php echo html_escape((!empty($shiftinfo->shift_end)?$shiftinfo->shift_end:null)) ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="shift_time" class="col-sm-5 col-form-label"><?php echo display('shift_time') ?>
                                    <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                    <input type="text" required readonly name="shift_time" id="shifttimetotal2"
                                    value="<?php echo html_escape((!empty($shiftinfo->shift_duration)?$shiftinfo->shift_duration:null)) ?>"    class="form-control" placeholder="<?php echo display('shift_time') ?>">

                                    <input type="hidden" name="" id="shifttimetotal_h2" value="<?php echo html_escape((!empty($shiftinfo->shift_duration)?$shiftinfo->shift_duration:null)) ?>">
                                </div>
                            </div>

                        <div class="form-group text-right">
                            <button type="reset"
                                class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button id="disabledmode" type="submit"
                                class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/shift_edit.js"></script>

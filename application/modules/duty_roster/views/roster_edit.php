<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body shifttimechk">
                <?php echo form_open_multipart('duty_roster/shift_management/update_roster_data') ?>
                <?php echo form_hidden('rostentry_id', (!empty($rosterinfo->rostentry_id)?$rosterinfo->rostentry_id:null)) ?>
                <div class="row">
                    <?php $checked_shift = $this->db->select('shift_id, roster_id')->from('tbl_duty_roster')->where('rostentry_id',$rosterinfo->rostentry_id)->get()->result();?>
                    <?php $shift_list_main = $data = $this->db->select("*")->from('tbl_empwork_shift')->get()->result();?>

                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="shift_name" class="col-sm-5 col-form-label"><?php echo display('shift_name');?> 
                                <i class="text-danger">*</i>
                            </label>
                            <div class="col-sm-7">
                                <select class="form-control selectpicker" required name="shift_id[]" id="shift_id" multiple="multiple">
                                    <?php foreach ($shift_list_main as $shift) {?>
                                    <option  value="<?php echo $shift->shiftid?>"
                                    <?php 
                                    if(!empty($checked_shift)){
                                        foreach ($checked_shift as $shiftchecked) {
                                            if( $shift->shiftid==$shiftchecked->shift_id){
                                                echo "Selected class='disable-single-shift'";
                                            }
                                        } 
                                    } 
                                        ?> ><?php echo $shift->shift_name;?>
                                    
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for=""
                                class="col-sm-5 col-form-label"><?php echo display('roster_start_date') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" readonly required name="roster_start_date" onchange="rosterdatechk(), rosterdatechk2(), rostdaychk()"  id="roster_start_date"
                                   value="<?php echo html_escape((!empty($rosterinfo->roster_start)?$rosterinfo->roster_start:null)) ?>" class="form-control datepickerwithoutprevdate" 
                                    placeholder="<?php echo display('roster_start_date') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('roster_end_date') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" readonly required name="roster_end_date" id="roster_end_date" value="<?php echo html_escape((!empty($rosterinfo->roster_end)?$rosterinfo->roster_end:null)) ?>"
                                    class="form-control datepickerwithoutprevdates" onchange="rosterdatechk(), rosterdatechk2(), rostdaychk()" placeholder="<?php echo display('roster_end_date') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roster_days" class="col-sm-5 col-form-label"><?php echo display('roster_days') ?>
                                <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text"  required readonly name="roster_days" id="roster_days" value="<?php echo html_escape((!empty($rosterinfo->roster_dsys)?$rosterinfo->roster_dsys:null)) ?>"
                                    class="form-control" placeholder="<?php echo display('roster_days') ?>">
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
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/roster_edit.js"></script>

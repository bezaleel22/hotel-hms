<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<?php

$edempdata =  $this->db->select('*')->from('tbl_emproster_assign')->where('emp_startroster_date', $clk_date)->where('emp_id', $emp_id)->get()->row();

$edrsentry_id =  $this->db->select('rostentry_id, shift_id')->from('tbl_duty_roster')->where('roster_id', $edempdata->roster_id)->get()->row();

$eshiftdata =  $this->db->select('tbl_empwork_shift.*')
->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id', 'left')
->from('tbl_duty_roster')
->where('tbl_duty_roster.rostentry_id', $edrsentry_id->rostentry_id)->get()->result();

?>
<?php echo  form_open('duty_roster/shift_management/emp_shift_update') ?>
<ul class="pl-0 mb-0">
    <?php
    if($eshiftdata){
        $i=1;
     foreach($eshiftdata as $eshiftdata_list){?>
    <li class="radio">
        <input type="radio" onclick="checkdshift('<?php echo $i?>')" name="shiftchk" id="ch<?php echo $i?>"
            value="<?php echo html_escape($eshiftdata_list->shiftid)?>"
            <?php if($edrsentry_id->shift_id == $eshiftdata_list->shiftid){echo 'checked';}else{echo '';}?>>
        <label for="ch<?php echo $i?>"><?php echo html_escape($eshiftdata_list->shift_name)?></label>
    </li>
    <?php $i++; }}?>
</ul>

<input type="hidden" name="sftasnid" id="sftasnid" value="<?php echo html_escape($edempdata->sftasnid);?>">
<input type="hidden" name="roster_id" id="roster_id" value="">
<input type="hidden" name="emp_id" id="emp_id" value="<?php echo html_escape($edempdata->emp_id);?>">
<input type="hidden" name="emp_startroster_date"  id="emp_startroster_date" value="<?php echo html_escape($edempdata->emp_startroster_date);?>">
<input type="hidden" name="emp_endroster_date"  id="emp_endroster_date" value="<?php echo html_escape($edempdata->emp_endroster_date);?>">
<input type="hidden" name="emp_startroster_time"  id="emp_startroster_time" value="">
<input type="hidden" name="emp_endroster_time" id="emp_endroster_time" value="">
<div class="text-right">
    <button type="button" class="btn btn-sm px-3 btn-secondary" data-dismiss="modal"><?php echo display('close') ?></button>
    <button type="submit" class="btn btn-sm px-3 btn-primary"><?php echo display('sv_changes') ?></button>
</div>
<?php echo form_close() ?>

<script src="<?php echo MOD_URL.$module;?>/assets/js/empshift_edit.js"></script>

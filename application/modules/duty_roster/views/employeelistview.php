<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="col-sm-12 row">
    <?php 
        $chechedemp = $this->db->select('emp_id,roster_id')
        ->from('tbl_emproster_assign')
        ->where('emp_startroster_date >=', $rstrt_date)
        ->where('emp_endroster_date <=', $rend_date)
        ->group_by('emp_id')->get()->result(); 

        if(!empty($emp_list)){
            $i = 1;
            foreach($emp_list as $emp_list){
            $disable = 0;
            foreach($chechedemp as $asn_emp_list){
                if ($asn_emp_list->emp_id == $emp_list->employee_id) {
                    
                
                    $disable=1;
                }
            }
                
    ?>
    <!-- Material inline 1 -->
    <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 pb-2" onclick="chkrosteremp(<?php echo $i;?>)">
    <input type="hidden" name="chkempids" id="chkempids<?php echo $i;?>" value="<?php echo html_escape($emp_list->employee_id);?>">
        <div class="room-design">
            <input type="checkbox" <?php if($disable == 1){echo 'disabled';} ?> class="form-check-input test room-check" name="emp_id[]"
                id="empid_<?php echo html_escape($emp_list->employee_id);?>"
                value="<?php echo html_escape($emp_list->employee_id);?>">


            <div class="form-check form-check-inline">
                <label class="form-check-label" data-toggle="tooltip" data-placement="top"
                    title="<?php echo html_escape($emp_list->first_name);?>"
                    for="materialInline"><?php echo html_escape($emp_list->first_name.' '.$emp_list->last_name);?></label>
            </div>
            <p><?php echo html_escape($emp_list->position_name);?></p>
            
        </div>
    </div>
    <?php $i++; } }?>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/employeelistview.js"></script>

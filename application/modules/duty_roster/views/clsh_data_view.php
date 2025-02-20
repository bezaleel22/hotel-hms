<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">    
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="row">
        <?php
        $cr_date =  date("Y-m-d");
        $cr_time =  date("H:i");
        if ($clsh_datalist) {
        foreach($clsh_datalist as $empdata){ 
    
            $emp_details = $this->db->select("employee_history.*,position.position_name")->join('position','position.pos_id = employee_history.pos_id')->from('employee_history')->where('employee_history.employee_id', $empdata->emp_id)->get()->row();
        ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="member_inner my-3 d-flex align-items-center rounded">
            <?php $is_compchk = $this->db->select("*")->from('tbl_emproster_assign')->where('emp_id', $emp_details->employee_id)->where('emp_startroster_date', $clkcngdate)->get()->row();
            ?>
                <div class="<?php if($is_compchk->is_complete == 1){echo 'status present';}
                    if($is_compchk->is_complete == 2){ echo 'status leave';}
                    elseif($clkcngdate < $cr_date){
                        if ($is_compchk->is_complete == 3|| $is_compchk->is_complete == 0) {
                            
                            echo 'status absent';
                        }
                    }
                    
                    ?>"></div>
                <div class="img_wrapper mr-3">
                    <img src="<?php echo html_escape(base_url(!empty($emp_details->picture)?$emp_details->picture:'assets/img/hrm/manage_employee.png')); ?>" class="img-fluid rounded" alt="">
                </div>
                <div class="info_wrapper">
                    <h6 class="member_name"><?php echo html_escape($emp_details->first_name.' '.$emp_details->last_name)?></h6>
                    <h6 class="member_position"><?php echo html_escape($emp_details->position_name)?></h6>
                    <?php if($cr_date < $clkcngdate){?>
                        <?php $chk_roster_number = $this->db->select('roster_id')->from('tbl_emproster_assign')->where('emp_startroster_date',$clkcngdate)->group_by('roster_id')->get()->num_rows();?>
                        <div class="member_info">
                            <input name="url" type="hidden" id="url_<?php echo html_escape($emp_details->employee_id); ?>" value="<?php echo base_url("duty_roster/Shift_management/updtempshift_frm") ?>" />
                            <a type="button" onclick="editinfo2('<?php echo html_escape($emp_details->employee_id); ?>', '<?php echo html_escape($clkcngdate)?>')" data-target="#exampleModal" class="btn member_shift <?php if($chk_roster_number <= 1){ echo 'disable_change_shift';}?>" data-toggle="tooltip" data-placement="left" title="Update">
                            <?php echo display('change_shift_dashboard') ?></a>
                            </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php  } }else {
                    echo '<strong class="nodata-margin">No Data Found !!</strong>';
                 }?>
        
    </div>
</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5><?php echo display('change_shift_dashboard') ?></h5>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">
               
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

           

        
    

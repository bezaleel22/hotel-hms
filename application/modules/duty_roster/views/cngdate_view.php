<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="card-header tab_hotel card-roster-header">
    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
    <input type="hidden" id="changedate" value="<?php echo html_escape($change_date)?>">
             <input type="hidden" id="todaydate" value="<?php echo html_escape($cn_date = date("Y-m-d"));?>">
             <input type="hidden" id="currentshift" value="<?php if(!empty($cuuentshiftid->shift_id)){echo html_escape($cuuentshiftid->shift_id);}?>">
        <?php
        
            $current_date =  date("Y-m-d");
            $cr_time =  $change_date;
            $today = $change_date;
           
            if ($cng_shlist) {
                
                $i = 0;
                foreach($cng_shlist as $rstrid_list){
                
                $cndtsh_id = $this->db->select('shift_id')
                ->from('tbl_duty_roster')
                ->where('roster_id',$rstrid_list->roster_id)->get()->row();

                $shdata = $this->db->select('*')
                ->from('tbl_empwork_shift')
                ->where('shiftid', $cndtsh_id->shift_id)->get()->row();
            
        ?>
            <li class="nav-item click-<?php echo html_escape($shdata->shiftid)?>-curtab">
                <a class="nav-link <?php if($i == 0 ){echo 'active';}else {echo '';}?>"
                    id="pills-<?php echo html_escape($shdata->shiftid)?>-tab" data-toggle="pill"
                    href="#pills-<?php echo html_escape($shdata->shiftid)?>" role="tab"
                    onclick="clickedshift(<?php echo html_escape($shdata->shiftid)?>)" aria-controls="pills-<?php echo html_escape($shdata->shiftid)?>"
                    aria-selected="true"><?php echo html_escape($shdata->shift_name)?><input type="hidden" name="clk_shiftid" id="clk_shiftid_<?php echo html_escape($shdata->shiftid)?>" value="<?php echo html_escape($shdata->shiftid)?>"></a>
            </li>
        
        <?php $i++; } }else{echo '<b>No Data Found !!</b>';}?>
    </ul>
</div>

<div class="card-body" id="empdatashow">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                <?php
                $cr_time =  $change_date;
                if ($cng_emplist) {
                    foreach($cng_emplist as $cng_emp){
            
                    $emp_details = $this->db->select("employee_history.*,position.position_name")->join('position','position.pos_id = employee_history.pos_id')->from('employee_history')->where('employee_history.employee_id', $cng_emp->emp_id)->get()->row();
                ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="member_inner my-3 d-flex align-items-center rounded">
                    <?php $is_compchk = $this->db->select("is_complete, emp_startroster_date")->from('tbl_emproster_assign')->where('emp_id', $emp_details->employee_id)->where('emp_startroster_date', $change_date)->get()->row();?>
                        <div class="<?php if ($is_compchk) { if($is_compchk->is_complete == 1){echo 'status present';}
                            elseif($is_compchk->is_complete == 2){ echo 'status leave';}
                            elseif($change_date < $current_date){
                                if ($is_compchk->is_complete == 3|| $is_compchk->is_complete == 0) {
                                    
                                    echo 'status absent';
                                }
                            }
                        }
                            ?>"></div>
                        <div class="img_wrapper mr-3">
                            <img src="<?php echo html_escape(base_url(!empty($emp_details->picture)?$emp_details->picture:'assets/img/hrm/manage_employee.png')); ?>" class="img-fluid rounded" alt="">
                        </div>
                        <div class="info_wrapper">
                            <h6 class="member_name"><?php echo html_escape($emp_details->first_name.' '.$emp_details->last_name)?></h6>
                            <h6 class="member_position"><?php echo html_escape($emp_details->position_name)?></h6>
                            <?php if($current_date < $change_date){?>
                            <div class="member_info">
                                <?php $chk_roster_number = $this->db->select('roster_id')->from('tbl_emproster_assign')->where('emp_startroster_date',$change_date)->group_by('roster_id')->get()->num_rows();?>
                            <input name="url" type="hidden" id="url_<?php echo html_escape($emp_details->employee_id); ?>" value="<?php echo base_url("duty_roster/Shift_management/updtempshift_frm") ?>" />
                            <a type="button" disabled onclick="editinfo2('<?php echo html_escape($emp_details->employee_id); ?>', '<?php echo html_escape($change_date)?>')" data-target="#exampleModal" class="btn member_shift <?php if($chk_roster_number <= 1){ echo 'disable_change_shift';}?>" data-toggle="tooltip" data-placement="left" title="Update">
                            <?php echo display('change_shift_dashboard') ?></a>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php  } }?>
                
            </div>
        </div>
           
    </div>
</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5><?php echo display('change_shift_dashboard');?></h5>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">
               
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

    <script src="<?php echo MOD_URL.$module;?>/assets/js/cngdate_view.js"></script>


<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="card">
    <div class="card-header tab_hotel card-roster-header">
        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
            <?php
                $cr_time =  date("Y-m-d H:i");
                $today = date('Y-m-d');
                if ($cur_shlist) {
                    
                    foreach($cur_shlist as $cush_list){
                
                $shdata     = $this->db->select('*')->from('tbl_empwork_shift')->where('shiftid', $cush_list->shift_id)->get()->row();
                $rosterdate = $this->db->select("emp_startroster_date")->from('tbl_emproster_assign')->where('emp_startroster_date', $today)->get()->row();
                  
                $dstart = $rosterdate->emp_startroster_date.' '.$shdata->shift_start;
                $dend   = $rosterdate->emp_startroster_date.' '.$shdata->shift_end;
                
                $curent = DateTime::createFromFormat('Y-m-d H:i', $cr_time);
                $start  = DateTime::createFromFormat('Y-m-d H:i', $dstart);
                $end    = DateTime::createFromFormat('Y-m-d H:i', $dend);
                
                ?>
                
            <li class="nav-item">
                <a class="nav-link <?php if($start <= $curent && $curent <= $end ){echo 'active';}else {echo '';}?>"
                    id="pills-<?php echo html_escape($shdata->shiftid)?>-tab" data-toggle="pill"
                    href="#pills-<?php echo html_escape($shdata->shiftid)?>" role="tab"
                    onclick="clickedshift(<?php echo html_escape($shdata->shiftid)?>)" aria-controls="pills-<?php echo html_escape($shdata->shiftid)?>"
                    aria-selected="true"><?php echo html_escape($shdata->shift_name)?><input type="hidden" name="clk_shiftid" id="clk_shiftid_<?php echo html_escape($shdata->shiftid)?>" value="<?php echo html_escape($shdata->shiftid)?>"></a>
            </li>

            <?php } }?>
        </ul>
    </div>

    <div class="card-body" id="empdatashow">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <?php
                    $cr_time =  date("Y-m-d H:i");
                    $cr_date =  date("Y-m-d");
                    if ($cur_emplist) {
                    foreach($cur_emplist as $current_emp){
                    ?>
                     <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="member_inner my-3 d-flex align-items-center rounded">
                            <?php $is_compchk = $this->db->select("is_complete, emp_startroster_date")->from('tbl_emproster_assign')->where('emp_id', $current_emp->emp_id)->where('emp_startroster_date', $today)->get()->row();?>
                            <div class="<?php if($is_compchk->is_complete == 1){echo 'status present';}
                            elseif($is_compchk->is_complete == 2){ echo 'status leave';}
                            elseif($is_compchk->is_complete == 3 && $is_compchk->emp_startroster_date <= $cr_date){ echo 'status absent';}
                            else{echo '';}?>"></div>
                            <div class="img_wrapper mr-3">
                                <img src="<?php echo html_escape(base_url(!empty($current_emp->picture)?$current_emp->picture:'assets/img/hrm/manage_employee.png')); ?>" class="img-fluid rounded" alt="">
                            </div>
                            <div class="info_wrapper">
                                <h6 class="member_name"><?php echo html_escape($current_emp->employee_name)?></h6>
                                <h6 class="member_position"><?php echo html_escape($current_emp->position_name)?></h6>
                                
                            </div>
                        </div>
                    </div> 
                    <?php  } 
                 }else {
                    echo '<strong class="nodata-margin">No Data Found !!</strong>';
                 }?>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>


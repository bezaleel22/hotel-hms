<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="row">
                <!--  table area -->
                <div class="col-sm-12">
                    <div class="card-header">
                        <h4><?php echo display('shift_assign_add')?> </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group row">
                                    <label for="select_roster"
                                        class="col-sm-2 col-form-label"><?php echo display('select_roster') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-3 customesl pl-0">
                                    
                                    <input type="hidden" name="uproster_id" id="uproster_id" class=" form-control" value="<?php echo html_escape($rstasninfo->roster_id)?>">
                                    <input type="text" disabled name="roster_idshow" id="roster_id" class=" form-control" value="<?php echo '('.$rstasninfo->roster_start.' - '.$rstasninfo->roster_end.') '.$rstasninfo->shift_name;?>">

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        <input type="hidden" name="rstr_start_date" id="rstr_start_date" value="<?php echo html_escape($rstasninfo->roster_start)?>">
                        <input type="hidden" name="rstr_end_date" id="rstr_end_date" value="<?php echo html_escape($rstasninfo->roster_end)?>">

                        <input type="hidden" name="rstr_start_time" id="rstr_start_time" value="<?php echo html_escape($rstasninfo->shift_start)?>">
                        <input type="hidden" name="rstr_end_time" id="rstr_end_time" value="<?php echo html_escape($rstasninfo->shift_end)?>  ">
                         
                        <div class="col-sm-12" >
                            <div class="col-sm-12 row">
                                <?php 
                                 $query= $this->db->select('*')->from('tbl_duty_roster')->where('roster_id', $rstasninfo->roster_id)->get()->row();

                                    $chechedemp = $this->db->select('emp_id,roster_id')
                                    ->from('tbl_emproster_assign')
                                    ->where('emp_startroster_date >=', $query->roster_start)
                                    ->where('emp_endroster_date <=', $query->roster_end)
                                    ->group_by('emp_id')->get()->result(); 

                                if(!empty($editemp_list)){
                                    foreach($editemp_list as $emp_list){
                                        
                                        $chekbox = 0;
                                        $disable = 0;
                                    foreach($chechedemp as $asn_emp_list){
                                        if ($asn_emp_list->emp_id == $emp_list->employee_id && $asn_emp_list->roster_id == $rstasninfo->roster_id) {
                                            $chekbox =1;
                                        }else if($asn_emp_list->emp_id == $emp_list->employee_id){
                                            $disable=1;
                                        }
                                    }
                                    ?>
                                    
                                <!-- Material inline 1 -->
                                 <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 pb-2">
                                    <div class="room-design">
                                        <input type="checkbox" <?php if($chekbox == 1){echo 'checked';} ?><?php if($disable == 1){echo 'disabled';} ?> class="form-check-input test room-check" name="emp_id[]"
                                          id="empid_<?php echo html_escape($emp_list->employee_id);?>"
                                            value="<?php echo html_escape($emp_list->employee_id);?>"
                                            
                                            >


                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" data-toggle="tooltip" data-placement="top"
                                                title=""
                                                for="materialInline"><?php echo html_escape($emp_list->first_name.' '.$emp_list->last_name);?></label>
                                        </div>
                                        <p><?php echo html_escape($emp_list->position_name);?></p>
                                        <p><?php echo html_escape($emp_list->employee_id);?></p>
                                    </div>
                                </div> 
                                <?php } }?>
                            </div>



                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/shift_assign_edit.js"></script>

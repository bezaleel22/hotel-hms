<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<div class="row justify-content-center">
    <div class="col-sm-12" id="printin">

        <!--/.End of header-->
        <div class="card card-body ">

            <div class="col-12 col-md-12">

                <div class="row">

                    <strong><?php echo display('shift_start_date').' :'?></strong>&ensp;<?php echo html_escape($rstr_vdata->roster_start);?>
                    &emsp;&emsp;
                    <strong><?php echo display('shift_end_date').' :' ?></strong>&ensp;<?php echo html_escape($rstr_vdata->roster_end);?>
                    &emsp;&emsp;

                    <strong><?php echo display('shift_name').' :'?></strong>&ensp;<?php

                    $rostshift = $this->db->select('*')	
                    ->from('tbl_empwork_shift')
                    ->where('shiftid',$rstr_vdata->shift_id)
                    ->get()
                    ->row();
                     echo html_escape($rostshift->shift_name);?>
                </div>

            </div>



                <strong class="assign_emp"><?php echo display('assigned_emp')?></strong>
            <div class="col-12">
                <div class="row">
                    <?php if (!empty($rosterempdata)) { ?>
                    <?php  $sl = 1;?>
                    <?php foreach ($rosterempdata as $row) { ?>

                    <div class="room-design-show">

                        <div class="form-check form-check-inline">
                            <label class="form-check-label" data-toggle="tooltip" data-placement="top" title="Ready"
                                for="materialInline101"><?php echo html_escape($row->first_name.' '.$row->last_name)?></label>
                        </div>
                        <p><?php echo html_escape($row->employee_id)?></p>
                    </div>


                    <?php $sl++; ?>
                    <?php }; ?>
                    <?php } ?>
                </div>



            </div>

        </div>
    </div>
</div>

<style>



</style>
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
                    <?php echo  form_open('duty_roster/shift_management/create_shift_assign') ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label for="select_roster"
                                        class="col-sm-2 col-form-label"><?php echo display('select_roster') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-3 customesl pl-0">
                                        <?php echo form_dropdown('roster_id',$roster_list,'', 'class="selectpicker form-control" required data-live-search="true" id="roster_id"') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="rstr_start_date" id="rstr_start_date" value="">
                        <input type="hidden" name="rstr_end_date" id="rstr_end_date" value="">

                        <input type="hidden" name="rstr_start_time" id="rstr_start_time" value="">
                        <input type="hidden" name="rstr_end_time" id="rstr_end_time" value="">
                        
                    
                        <div class="col-sm-12" id="employeedatalistshow">
                            


                        </div>
                        <div class="form-group text-right">
                            <button type="submit" hidden id="sbmit"
                                class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>


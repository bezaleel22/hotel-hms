<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open_multipart('transport_facility/transport_setting/update_flight_details/') ?>
                <?php echo form_hidden('flyid', (!empty($flydeinfo->flyid)?$flydeinfo->flyid:null)) ?>
                    <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="flight_num" class="col-sm-5 col-form-label"><?php echo display('flight_num') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="flight_num" class="form-control" value="<?php echo html_escape((!empty($flydeinfo->flight_num)?$flydeinfo->flight_num:null)) ?>" placeholder="<?php echo display('flight_num') ?>">
                        
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="airlience_name" class="col-sm-5 col-form-label"><?php echo display('airlience_name') ?></label>
                            <div class="col-sm-7">
                            <input type="text" name="airlience_name" class="form-control" value="<?php echo html_escape((!empty($flydeinfo->airlience_name)?$flydeinfo->airlience_name:null)) ?>" placeholder="<?php echo display('airlience_name') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('departure') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="departure" class="form-control datetimepickers2" value="<?php echo html_escape((!empty($flydeinfo->departure)?$flydeinfo->departure:null)) ?>" placeholder="<?php echo display('departure') ?>">
                            
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('arrival') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="arrival" class="form-control datetimepickers2" value="<?php echo html_escape((!empty($flydeinfo->arrival)?$flydeinfo->arrival:null)) ?>" placeholder="<?php echo display('arrival') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fly_from" class="col-sm-5 col-form-label"><?php echo display('fly_from') ?></label>
                            <div class="col-sm-7">
                            <input type="text" name="fly_from" class="form-control" value="<?php echo html_escape((!empty($flydeinfo->fly_from)?$flydeinfo->fly_from:null)) ?>" placeholder="<?php echo display('fly_from') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fly_to" class="col-sm-5 col-form-label"><?php echo display('fly_to') ?></label>
                            <div class="col-sm-7">
                            <input type="text" name="fly_to" class="form-control" value="<?php echo html_escape((!empty($flydeinfo->fly_to)?$flydeinfo->fly_to:null)) ?>" placeholder="<?php echo display('fly_to') ?>">
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button id="disabledmode" type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    </div>
                    
                       
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <script src="<?php echo MOD_URL.$module;?>/assets/js/datetimepickers2.js"></script>
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open_multipart('transport_facility/transport_setting/update_vehicle_details/') ?>
                <?php echo form_hidden('vdsid', (!empty($vehicleinfo->vdsid)?$vehicleinfo->vdsid:null)) ?>
                    <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="vehicle_number" class="col-sm-5 col-form-label"><?php echo display('vehicle_number') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="vehicle_number" class="form-control" value="<?php echo html_escape((!empty($vehicleinfo->vehicle_number)?$vehicleinfo->vehicle_number:null)) ?>" placeholder="<?php echo display('vehicle_number') ?>">
                        
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type" class="col-sm-5 col-form-label"><?php echo display('vehicle_type') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="vehicle_type" class="form-control" value="<?php echo html_escape((!empty($vehicleinfo->vehicle_type)?$vehicleinfo->vehicle_type:null)) ?>" placeholder="<?php echo display('vehicle_type') ?>">
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('fuel_type') ?></label>
                            <div class="col-sm-7">
                            <input type="text" name="fuel_type" class="form-control" value="<?php echo html_escape((!empty($vehicleinfo->fuel_type)?$vehicleinfo->fuel_type:null)) ?>" placeholder="<?php echo display('fuel_type') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('seat_capacity') ?> </label>
                            <div class="col-sm-7">
                            <input type="text" name="seat_capacity" class="form-control" value="<?php echo html_escape((!empty($vehicleinfo->seat_capacity)?$vehicleinfo->seat_capacity:null)) ?>" placeholder="<?php echo display('seat_capacity') ?>">
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

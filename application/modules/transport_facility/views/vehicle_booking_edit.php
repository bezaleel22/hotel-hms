<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open_multipart('transport_facility/transport_setting/update_vehicle_booking/') ?>
                <?php echo form_hidden('vbkid', (!empty($vhiclbkinfo->vbkid)?$vhiclbkinfo->vbkid:null)) ?>
                    <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-5 col-form-label"><?php echo display('customer_name') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('cust_id', $cust_list, $vhiclbkinfo->cust_id, 'class="form-control basic-single" id="cust_id" required') ?>                            
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_number" class="col-sm-5 col-form-label"><?php echo display('vehicle_number') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('vehicle_id', $vehicle_list, $vhiclbkinfo->vehicle_id, 'class="form-control basic-single" id="vehicle_id" required') ?>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('flight_num') ?> <i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('flight_id', $flight_list, $vhiclbkinfo->flight_id, 'class="form-control basic-single" id="flight_id" required') ?>                            
                            
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('assigned_driver') ?> </label>
                            <?php $this->db->select('*');
                                $this->db->from('employee_history');
                                $this->db->where('employee_id',$vhiclbkinfo->driver_id);
                                $query=$this->db->get()->row();
        	?>
                            <div class="col-sm-7">
                            <input type="text" name="assigned_driver" id="assigned_driver" value="<?php echo  html_escape($query->first_name).' ';if(!empty($query->last_name)){echo  html_escape($query->last_name);}?>" disabled class="form-control" placeholder="<?php echo display('assigned_driver') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="driver" class="col-sm-5 col-form-label"><?php echo display('driver') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('driver_id', $driver_list, $vhiclbkinfo->driver_id, 'class="form-control basic-single" id="driver_id" ') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="transportation_type" class="col-sm-5 col-form-label"><?php echo display('transportation_type') ?><i class="text-danger">*</i>  </label>
                            <div class="col-sm-7">
                            <select name="transportation_type" id="transportation_type" required class="form-control basic-single">
                                <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                <option <?php if($vhiclbkinfo->transportation_type == "Pick Up") echo 'selected'?> value="Pick Up"><?php echo display('pick_up') ?></option>
                                <option <?php if($vhiclbkinfo->transportation_type == "Drop Off") echo 'selected'?> value="Drop Off"><?php echo display('drop_off') ?></option>
                                
                                </select>                             
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('transportation_time') ?><i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <input type="text" required name="transportation_time" class="form-control datetimepickers2" value="<?php echo html_escape((!empty($vhiclbkinfo->transportation_time)?$vhiclbkinfo->transportation_time:null)) ?>" placeholder="<?php echo display('transportation_time') ?>">

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

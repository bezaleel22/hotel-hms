<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open('pool_booking/pool_setting/pool_update') ?>
                <?php echo form_hidden('poolid', (!empty($pool_info->poolid)?$pool_info->poolid:null)) ?>
                    <div class="row">
                    
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group row">
                                <label for="pool_name" class="col-sm-5 col-form-label"><?php echo display('pool_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                <input type="text" required name="pool_name" class="form-control" value="<?php echo html_escape((!empty($pool_info->poolname)?$pool_info->poolname:null)) ?>" placeholder="<?php echo display('pool_name') ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type_name"
                                    class="col-sm-5 col-form-label"><?php echo display('type_name') ?><i class="text-danger">*</i> </label>
                                <div class="col-sm-7">
                                <?php echo form_dropdown('type_name', $pool_ty_list, $pool_info->pooltype, 'class="form-control basic-single" id="type_name" required') ?>
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-5 col-form-label"><?php echo display('status') ?> </label>
                                <div class="col-sm-7">
                                <select class="form-control basic-single" name="status" id="status" >
                                    <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                    <option <?php if($pool_info->status == 1 ) echo 'selected'?> value="1"><?php echo display('active') ?></option>
                                    <option <?php if($pool_info->status == 2 ) echo 'selected'?> value="2"><?php echo display('un_maintenence') ?></option>
                                    <option <?php if($pool_info->status == 3 ) echo 'selected'?> value="3"><?php echo display('booked') ?></option>
                                    <option <?php if($pool_info->status == 0 ) echo 'selected'?> value="0"><?php echo display('inactive') ?></option>
                                    
                                    </select>  
                                </div>
                            </div>
                            

                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group row">
                                <label for="capacity" class="col-sm-5 col-form-label"><?php echo display('capacity') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                <input type="number" required name="capacity" value="<?php echo html_escape((!empty($pool_info->capacity)?$pool_info->capacity:null)) ?>" class="form-control" placeholder="<?php echo display('capacity') ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="remarks" class="col-sm-5 col-form-label"><?php echo display('remarks') ?> </label>
                                <div class="col-sm-7">
                                <textarea  name="remarks" id="remarks" placeholder="<?php echo display('remarks') ?>" class="form-control"><?php echo html_escape((!empty($pool_info->remarks)?$pool_info->remarks:null)) ?></textarea>
                                
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

   
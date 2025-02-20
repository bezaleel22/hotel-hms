<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open('pool_booking/pool_setting/pool_type_update') ?>
                <?php echo form_hidden('potyid', (!empty($pool_ty_info->potyid)?$pool_ty_info->potyid:null)) ?>
                <div class="form-group row">
                   

                <label for="type_name" class="col-sm-4 col-form-label"><?php echo display('type_name') ?> <span class="text-danger">*</span></label>
                <div class="col-sm-8 mb-2">
                        <input type="text" name="type_name" required class="form-control" value="<?php echo html_escape((!empty($pool_ty_info->typename)?$pool_ty_info->typename:null)) ?>" placeholder="<?php echo display('type_name') ?>">
                </div>
                
                </div>
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-danger w-md m-b-5" data-dismiss="modal"><?php echo display('cancel') ?></button>
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                </div>  

                </div>  
            </div>
        </div>
    </div>

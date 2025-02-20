<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            
            <div class="card-body">
                <?php echo form_open_multipart('pool_booking/pool_setting/pool_img_create') ?>
                <?php echo form_hidden('pool_img_id', (!empty($pimginfo->pool_img_id)?$pimginfo->pool_img_id:null)) ?>
                <div class="form-group row">
                    <label for="room_name" class="col-sm-4 col-form-label"><?php echo display('pool_name') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown('pool_id',$pool_list,$allrooms=$pimginfo->pool_id, 'class="selectpicker form-control" data-live-search="true" id="pool_id"') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="file" accept="image/*" name="poolpicture" onchange="loadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($pimginfo->poolimg_name)?$pimginfo->poolimg_name:'assets/img/room-setting/room_images.png')); ?>" id="output" class="img-thumbnail height_150_width_200px"/>
                        </small>
                        <input type="hidden" name="poolold_image" value="<?php echo html_escape(base_url(!empty($pimginfo->poolimg_name)?$pimginfo->poolimg_name:'assets/img/room-setting/room_images.png')); ?>">
                    </div>
                </div>
                
                
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/poolImage.js"></script>
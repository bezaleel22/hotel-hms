<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                <?php echo form_open_multipart('pool_booking/pool_setting/create_pool_package') ?>
                <?php echo form_hidden('packageid', (!empty($ppakinfo->packageid)?$ppakinfo->packageid:null)) ?>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group row">
                                <label for="package_name" class="col-sm-5 col-form-label"><?php echo display('package_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                <input type="text" required name="package_name" class="form-control" value="<?php echo html_escape((!empty($ppakinfo->package_name)?$ppakinfo->package_name:null)) ?>" placeholder="<?php echo display('package_name') ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pool_name"
                                    class="col-sm-5 col-form-label"><?php echo display('pool_name') ?><i class="text-danger">*</i> </label>
                                <div class="col-sm-7">
                                <?php echo form_dropdown('pool_name', $pool_list, $ppakinfo->poolid, 'class="form-control basic-single" id="pool_name" required') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_from" class="col-sm-5 col-form-label"><?php echo display('date_from') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                    <input type="text" required name="date_from" class="form-control datetimepickers2" value="<?php echo html_escape((!empty($ppakinfo->datetime_from)?$ppakinfo->datetime_from:null)) ?>" placeholder="<?php echo display('date_from') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_to" class="col-sm-5 col-form-label"><?php echo display('date_to') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                    <input type="text" required name="date_to" class="form-control datetimepickers2" value="<?php echo html_escape((!empty($ppakinfo->datetime_to)?$ppakinfo->datetime_to:null)) ?>" placeholder="<?php echo display('date_to') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group row">
                                <label for="price" class="col-sm-5 col-form-label"><?php echo display('price') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-7">
                                    <input type="text" required name="price" class="form-control" value="<?php echo html_escape((!empty($ppakinfo->price)?$ppakinfo->price:null)) ?>" placeholder="<?php echo display('price') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-5 col-form-label"><?php echo display('status') ?> </label>
                                <div class="col-sm-7">
                                    <select class="form-control basic-single" name="status" id="status" >
                                        <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                        <option <?php if($ppakinfo->status == 1 ) echo 'selected'?> value="1"><?php echo display('active') ?></option>
                                        <option <?php if($ppakinfo->status == 0 ) echo 'selected'?> value="0"><?php echo display('inactive') ?></option>
                                    </select>  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pool_details" class="col-sm-5 col-form-label"><?php echo display('pool_details') ?> </label>
                                <div class="col-sm-7">
                                    <textarea  name="pool_details" id="pool_details" placeholder="<?php echo display('pool_details') ?>" class="form-control"><?php echo html_escape((!empty($ppakinfo->details)?$ppakinfo->details:null)) ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-5 col-form-label"><?php echo display('image') ?> </label>
                                <div class="col-sm-7">
                                <input type="file" accept="image/*" name="packagepicture" onchange="loadFile(event)" ><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($ppakinfo->packageimage)?$ppakinfo->packageimage:'assets/img/room-setting/room_images.png')); ?>" id="output" class="img-thumbnail height_150_width_200px" />
                                </small>
                                <input type="hidden" name="old_image" value="<?php echo html_escape((!empty($ppakinfo->packageimage)?$ppakinfo->packageimage:null)) ?>">                                
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
    <script src="<?php echo MOD_URL.$module;?>/assets/js/package_edit.js"></script>

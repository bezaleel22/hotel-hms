<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">

            <div class="card-body">
                <?php echo form_open_multipart('hall_room/hallroom/seatplan_create');?>
                <?php echo form_hidden('hsid', (!empty($intinfo[0]->hsid)?$intinfo[0]->hsid:null)) ?>

                <div class="form-group row">
                    <label for="plan_name" class="col-sm-4 col-form-label"><?php echo display('plan_name') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="plan_name" autocomplete="off" class="form-control" type="text"
                            placeholder="<?php echo display('plan_name') ?>" id="plan_name"
                            value="<?php echo html_escape((!empty($intinfo[0]->plan_name)?$intinfo[0]->plan_name:null)) ?>"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roomdescription"
                        class="col-sm-4 col-form-label"><?php echo display('description') ?> <span
                            class="text-danger"></span></label>
                    <div class="col-sm-8">
                        <textarea name="description" cols="35" rows="4"
                            placeholder="<?php echo display('description') ?>"><?php echo html_escape((!empty($intinfo[0]->description)?$intinfo[0]->description:null)) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-8">
                        <input type="file" accept="image/*" name="picture" onchange="editLoadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($intinfo[0]->image)?$intinfo[0]->image:'assets/img/room-setting/room_images.png')); ?>" id="output2" class="img-thumbnail height_150_width_200px"/>
                        </small>
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
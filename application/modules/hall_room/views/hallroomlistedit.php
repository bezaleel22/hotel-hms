<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">

            <div class="card-body">
                <?php echo form_open_multipart('hall_room/hallroom/hallroom_create');?>
                <?php echo form_hidden('roomid', (!empty($intinfo->hid)?$intinfo->hid:null)) ?>

                <div class="form-group row">
                    <label for="roomtype" class="col-sm-4 col-form-label"><?php echo display('hallroom_type') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="roomtype" autocomplete="off" class="form-control" type="text"
                            placeholder="<?php echo display('hallroom_type') ?>" id="roomtype"
                            value="<?php echo html_escape((!empty($intinfo->hall_type)?$intinfo->hall_type:null)) ?>"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capacity" class="col-sm-4 col-form-label"><?php echo display('capacity') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="capacity" autocomplete="off" class="form-control" type="number"
                            placeholder="<?php echo display('capacity') ?>" id="capacity"
                            value="<?php echo html_escape((!empty($intinfo->person_limit)?$intinfo->person_limit:null)) ?>"
                            required>
                    </div>
                </div>                
                <div class="form-group row">
                    <label for="defaultrate" class="col-sm-4 col-form-label"><?php echo display("hourly")." ".display('defaultrate') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="defaultrate" autocomplete="off" class="form-control" type="text"
                            placeholder="<?php echo display('defaultrate') ?>" id="defaultrate"
                            value="<?php echo html_escape((!empty($intinfo->rate)?$intinfo->rate:null)) ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roomsize" class="col-sm-4 col-form-label"><?php echo display('roomsize') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input name="roomsize" autocomplete="off" class="form-control" type="number"
                            placeholder="<?php echo display('roomsize') ?>" id="roomsize"
                            value="<?php echo html_escape((!empty($intinfo->size)?$intinfo->size:null)) ?>"
                            required>
                    </div>
                    <div class="col-sm-4">
                        <?php echo form_dropdown('size_unit',$allsizes,$allsizes=$intinfo->mesurement, 'class="selectpicker form-control" data-live-search="true" id="size_unit"') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="seatplan" class="col-sm-4 col-form-label"><?php echo display('seatplan') ?></label>
                    <?php
                        $singleseat = explode(",",$intinfo->seatplan);
                     ?>
                    <div class="col-sm-8">
                        <?php echo form_dropdown('seatplan[]',$seatplan,$seatplan=$singleseat, 'class="basic-single form-control" id="size_unit" multiple') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roomdescription"
                        class="col-sm-4 col-form-label"><?php echo display('description') ?> <span
                            class="text-danger"></span></label>
                    <div class="col-sm-8">
                        <textarea name="description" cols="35" rows="4"
                            placeholder="<?php echo display('description') ?>"><?php echo html_escape((!empty($intinfo->description)?$intinfo->description:null)) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-8">
                        <input type="file" accept="image/*" name="picture" onchange="editLoadFile(event)"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($intinfo->image)?$intinfo->image:'assets/img/room-setting/room_images.png')); ?>" id="output2" class="img-thumbnail height_150_width_200px"/>
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
<div class="card">
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card-header">
                <h4><?php echo display('assign_room')?> </h4>
            </div>
            <div class="card-body">
                <?php echo  form_open('hall_room/hallroom/roomassigninsert') ?>
                <div class="form-group row">
                    <label for="room_name" class="col-sm-2 col-form-label"><?php echo display('hallroom_type') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-3 customesl pl-0">
                        <?php echo form_dropdown('room_name',$allroom,'', 'class="selectpicker form-control" onchange="getroom()" data-live-search="true" id="room_name" required') ?>
                    </div>
                </div>
                <div class="col-sm-12" id="floorandroom">
                    
                    
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/hallroomAssign.js"></script>
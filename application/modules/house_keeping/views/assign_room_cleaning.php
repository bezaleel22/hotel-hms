<?php 
$status = array(
    '' => 'Select Status',
    '1' => 'Ready',
    '2' => 'Booked',
    '3' => 'Assigned to clean',
    '4' => 'Booked and assigned to clean',
    '5' => 'Under maintenance',
    '6' => 'Dirty',
    '7' => 'Blocked',
    '8' => 'Do not reserve',
    '9' => 'Under Process',
);
?>
<div class="row" id="assign_room_cleaning">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="row">
                <!--  table area -->
                <div class="col-sm-12">
                    <div class="card-header">
                        <h4><?php echo display('assign_room_cleaning')?> </h4>
                    </div>
                    <div class="card-body">
                        <?php echo  form_open('house_keeping/house_keeping/assignroomcleaner') ?>
                        <div class="row ml-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="employee_id" class="col-sm-4"><?php echo display('house_keeper') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 customesl pl-0">
                                        <?php echo form_dropdown('employee_id',$allhousekeeper,'', 'class="selectpicker form-control" data-live-search="true" id="employee_id" required') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="room_name" class="col-sm-4"><?php echo display('room_name') ?>
                                    </label>
                                    <div class="col-sm-8 customesl pl-0">
                                        <?php echo form_dropdown('room_name',$allroom,'', 'class="selectpicker form-control" onchange="getroomtype()" data-live-search="true" id="room_name"') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="col-sm-4"><?php echo display('status') ?>
                                    </label>
                                    <div class="col-sm-8 customesl pl-0">
                                        <?php echo form_dropdown('status',$status,'', 'class="selectpicker form-control" onchange="getroomstatus()" data-live-search="true" id="status"') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="allstatusandroom">
                            <div class="col-sm-12 row">
                                <?php 
                                    $assignroom=$this->db->select("roomno,status")->from('tbl_roomnofloorassign')->order_by("roomno","Asc")->get()->result();
                                    if(!empty($assignroom)){
                                        foreach($assignroom as $room){
                                            $tooltrips=$status[$room->status];
                                ?>
                                <!-- Material inline 1 -->
                                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 pb-2">
                                    <div class="room-design">
                                        <input type="checkbox" class="form-check-input test room-check" name="roomno[]"
                                            id="materialInline<?php echo html_escape($room->roomno);?>"
                                            value="<?php echo html_escape($room->roomno);?>">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" data-toggle="tooltip" data-placement="top"
                                                title="<?php echo html_escape($tooltrips);?>"
                                                for="materialInline<?php echo html_escape($room->roomno);?>"><?php echo display('room_no') ?><?php echo html_escape($room->roomno);?></label>
                                        </div>
                                        <p><?php echo html_escape($status[$room->status]);?></p>
                                    </div>
                                </div>
                                <?php } }?>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" id="sbmit"
                                    class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
                            </div>
                        </div>
                        <div class="col-sm-12" id="statusandroom">


                        </div>
                        <div class="col-sm-12" id="statuswithroom">


                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/assign_room_cleaning.js"></script>
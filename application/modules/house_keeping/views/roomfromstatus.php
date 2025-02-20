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
<div class="col-sm-12 row">
    <?php 
    if($roomname){
        $assignroom=$this->db->select("roomno,status")->from('tbl_roomnofloorassign')->where('status',$statusid)->where('roomid',$roomname)->get()->result();
    }else{
        $assignroom=$this->db->select("roomno,status")->from('tbl_roomnofloorassign')->where('status',$statusid)->get()->result();
    }
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
    <button type="submit" id="stsbmit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
</div>

<script src="<?php echo MOD_URL.$module;?>/assets/js/roomfromstatus.js"></script>
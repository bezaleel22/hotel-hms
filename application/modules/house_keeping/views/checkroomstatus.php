<?php 
$status = array(
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
<?php foreach($allroomwithstatus as $floors){?>
<br />
<div class="card">
    <div class="card-header">
        <?php echo html_escape($floors->floorname); ?>
    </div>
</div>
<br /><br />
<?php  if(!empty($floors->sub)){?>
<div class="col-sm-12 row">
    <?php 
	foreach($floors->sub as $roomno){
        if($statusid){
		$assignroom=$this->db->select("tbl_roomnofloorassign.*,roomdetails.roomtype")->from('tbl_roomnofloorassign')->join('roomdetails','roomdetails.roomid=tbl_roomnofloorassign.roomid','left')->where('floorid',$roomno->floorName)->where('roomno',$roomno->roomno)->where('status',$statusid)->get()->row();
        }else{
            $assignroom=$this->db->select("tbl_roomnofloorassign.*,roomdetails.roomtype")->from('tbl_roomnofloorassign')->join('roomdetails','roomdetails.roomid=tbl_roomnofloorassign.roomid','left')->where('floorid',$roomno->floorName)->where('roomno',$roomno->roomno)->get()->row();
        }
		$enablecheck='';
		$disablecheck=0;
		$tooltrips='Not Assign';
		if(!empty($assignroom)){
			if($assignroom->roomid==$crroomid){
				$enablecheck="allroom";
				$disablecheck=0;
				$tooltrips=$assignroom->roomtype;
	?>
    <!-- Material inline 1 -->
    <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 pb-2">
        <div class="room-design">
            <input type="checkbox" class="form-check-input test room-check"
                name="roomno<?php echo html_escape($roomno->floorName.$crroomid);?>[]"
                id="materialInline<?php echo html_escape($roomno->floorplanid);?>"
                value="<?php echo html_escape($roomno->roomno);?>">
            <div class="form-check form-check-inline">
                <label class="form-check-label" data-toggle="tooltip" data-placement="top"
                    title="<?php echo html_escape($tooltrips);?>"
                    for="materialInline<?php echo html_escape($roomno->floorplanid);?>"><?php echo display('room_no') ?><?php echo html_escape($roomno->roomno);?></label>
            </div>
            <p><?php echo html_escape($status[$assignroom->status]);?></p>
        </div>
    </div>
    <?php  } } }?>
</div>
<input name="floorid_<?php echo html_escape($crroomid);?>[]" type="hidden"
    value="<?php echo html_escape($floors->floorid);?>" />

<?php  } } ?>
<input name="roomid" type="hidden" value="<?php echo html_escape($crroomid);?>" />
<div class="form-group text-right">
    <button type="submit" id="lsbmit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/checkroomstatus.js"></script>
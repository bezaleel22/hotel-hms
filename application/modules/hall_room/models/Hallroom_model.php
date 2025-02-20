<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hallroom_model extends CI_Model {
	
	private $table = 'tbl_hallroom_booking';
 
	public function create($table, $data = array())
	{
		return $this->db->insert($table, $data);
	}
	public function delete($table, $idName, $id = null)
	{
		$this->db->where($idName,$id)
			->delete($table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($table,$id,$data = array())
	{
		return $this->db->where($id ,$data[$id])
			->update($table, $data);
	}

    public function read($limit = null, $start = null)
	{
	    $this->db->select('booked_info.*,roomdetails.roomtype');
        $this->db->from($this->table);
		$this->db->join('roomdetails','roomdetails.roomid=booked_info.roomid','left');
        $this->db->order_by('booked_info.bookedid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	public function hallroomread()
	{
	    $this->db->select('tbl_hallroom_info.*,roomsizemesurement.roommesurementitle');
        $this->db->from('tbl_hallroom_info');
		$this->db->join('roomsizemesurement','roomsizemesurement.mesurementid=tbl_hallroom_info.mesurement','left');
        $this->db->order_by('tbl_hallroom_info.hid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();    
			foreach($result as $key => $val){
				if(!empty($val->seatplan)){
					$result[$key]->seatplan = $this->seatname($val->seatplan);
				}
			}
			return $result;
        }
        return false;
	}
	public function seatname($seat){
		$singleseat = explode(",", $seat);
		$list = "";
		for($i=0; $i<count($singleseat); $i++){
			$planName  = $this->db->select("plan_name")->from("tbl_hallroom_seatplan")->where('hsid',$singleseat[$i])->get()->row();
			$list .= $planName->plan_name.",";
		}
		return trim($list,",");
	}  
	public function headcode($lvl,$code){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='$lvl' And HeadCode LIKE '$code%'");
        return $query->row();
    }
	
	public function findById($id = null)
	{ 
		$this->db->select('*');
        $this->db->from($this->table);
		$this->db->where('bookedid',$id); 
        $this->db->order_by('bookedid', 'desc');
        $query = $this->db->get();
	    return $query->row();
	} 

 
public function countlist()
	{
		$this->db->select('booked_info.*,roomdetails.roomtype');
        $this->db->from($this->table);
		$this->db->join('roomdetails','roomdetails.roomid=booked_info.roomid','left');
        $this->db->order_by('booked_info.bookedid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
public function allrooms()
	{
		$data = $this->db->select("*")
			->from('tbl_hallroom_info')
			->get()
			->result();

		$list[''] = 'Select Hall Room';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->hid] = $value->hall_type;
			return $list;
		} else {
			return false; 
		}
	}
public function customerlist()
	{
		$data = $this->db->select("*")
			->from('customerinfo')
			->get()
			->result();

		$list[''] = 'Select Guest';

		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customerid] = $value->firstname.' '.$value->lastname;
			return $list;
		} else {
			return $list; 
		}
	}
public function allpayments(){
	return $data = $this->db->select("tbl_guestpayments.*,booked_info.bookedid")
			->from('tbl_guestpayments')
			->join('booked_info','booked_info.booking_number=tbl_guestpayments.bookingnumber','left')
			->get()
			->result();
	}
public function paymentlist()
	{
		$data = $this->db->select("*")
			->from('payment_method')
			->get()
			->result();

		$list[''] = 'Select Payment';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->payment_method_id] = $value->payment_method;
			return $list;
		} else {
			return false; 
		}
	}
public function createpayment($data = array())
	{
		return $this->db->insert('tbl_guestpayments', $data);
	}
public function updatepayment($data = array())
	{
		return $this->db->where('payid',$data["payid"])
			->update('tbl_guestpayments', $data);
	}
public function findBypayId($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_guestpayments');
        $this->db->join('booked_info','booked_info.bookedid=tbl_guestpayments.bookedid','left');
		$this->db->where('booked_info.booking_number',$id); 
        $this->db->order_by('tbl_guestpayments.payid', 'desc');
        $query = $this->db->get();
	    return $query->row();
	}
	public function chargeinfo(){
		$this->db->select('*');
		$this->db->from('setting');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	} 
	public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function update_date($table, $data, $field_name, $field_value)
    {
        $this->db->where($field_name, $field_value);
        return $this->db->update($table, $data);
    }

	public function get_all($select_items, $table, $orderby,$limit=NULL,$start=NULL)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        $this->db->limit($limit, $start);
        $this->db->order_by($orderby,'DESC');
        return $this->db->get()->result();
    }
   public function read2($select_items, $table, $orderby, $where_array, $or_where=NULL)
    {
        
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
            
        }
        if($or_where!=NULL){
        foreach ($or_where as $field => $value) {
            $this->db->where($field, $value);
            
        }
        }
        $this->db->order_by($orderby,'DESC');
        return $this->db->get()->result();
    }
   public function readall($select_items, $table, $orderby, $where_array)
    {
        
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
            
        }
        $this->db->order_by($orderby,'Asc');
        return $this->db->get()->result();
        
    }
	public function readone($select_items, $table, $where_array, $where_array2=NULL)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        if($where_array2!=NULL){
        foreach ($where_array2 as $field => $value) {
            $this->db->where($field, $value);
        }
        }
        return $this->db->get()->row();
    }
    public function get_all_group($select_items, $table, $order_by_name = NULL, $order_by = NULL, $group_by = NULL)
    {
		$this->db->select($select_items);
        $this->db->from($table);
        if ($order_by_name != NULL && $order_by != NULL)
        {
            $this->db->order_by($order_by_name, $order_by);
        }
		$this->db->group_by($group_by);
        return $this->db->get()->result();
    }
	public function editbooking($id){
		$this->db->select("tbl_hallroom_booking.*, tg.*");
		$this->db->from("tbl_hallroom_booking");
		$this->db->join("tbl_guestpayments tg","tg.bookedid=tbl_hallroom_booking.hbid","left");
		$this->db->where("tbl_hallroom_booking.hbid",$id);
		return $this->db->get()->row();
	}
	public function booking_payment($id){
		$this->db->select("gp.*");
		$this->db->from("tbl_hallroom_booking");
		$this->db->join("tbl_guestpayments gp","gp.bookedid=tbl_hallroom_booking.hbid","left");
		$this->db->where("gp.book_type",1);
		$this->db->where("tbl_hallroom_booking.hbid",$id);
		$row = $this->db->get()->row();
		return $row;
	}
	public function detailbooking($id){
		$this->db->select("booked_info.*,booked_details.*,customerinfo.*,GROUP_CONCAT(roomdetails.roomtype ORDER BY booked_info.room_no) as roomtype,roomdetails.bedcharge,roomdetails.personcharge");
		$this->db->from("booked_info");
		$this->db->join("booked_details","booked_details.bookedid=booked_info.bookedid","left");
		$this->db->join("customerinfo","customerinfo.customerid=booked_info.cutomerid","left");
		$this->db->join('tbl_roomnofloorassign','FIND_IN_SET(tbl_roomnofloorassign.roomno,booked_info.room_no)<>0','left');
		$this->db->join('roomdetails','FIND_IN_SET(roomdetails.roomid,tbl_roomnofloorassign.roomid)<>0','left');
		$this->db->where("booked_info.bookedid",$id);
		$row = $this->db->get()->row();
		$singlerate = explode(",", $row->roomrate);
		$total=0;
		for($i=0;$i<count($singlerate); $i++){
			$total += $singlerate[$i]; 
		}
		$rate = ($row->discountamount*100)/$total;
		$row->disrate = $rate;
		return $row;
	}
	public function findBookingDetail($id){
		$this->db->select("bi.*,bd.extrabed as bed,bd.extraperson as person,bd.extrachild as child,bd.extra_facility_days as exday,bd.complementaryprice as comprice,bd.booked_from");
		$this->db->from("booked_info bi");
		$this->db->join("booked_details bd","bd.bookedid=bi.bookedid","left");
		$this->db->where("bi.bookedid", $id);
		$query = $this->db->get();
		$row = $query->row();
		$row->totalExAmount = $this->exRoomBill($row->roomid,$row->bed,$row->person,$row->child,$row->exday);
		$row->totalComplementary = $this->roomComplementary($row->comprice);
		return $row;
	}
	public function exRoomBill($roomid,$bed,$person,$child,$day){
		$singleid = explode(",", $roomid);
		$singlebed = explode(",", $bed);
		$singleperson = explode(",", $person);
		$singlechild = explode(",", $child);
		$singleday = explode(",", $day);
		$total = 0;
		for($i=0;$i<count($singleid); $i++){
			$charge = $this->db->select("bedcharge,personcharge")->from("roomdetails")->where("roomid",$singleid[$i])->get()->row();
			$total += ($charge->bedcharge*$singleday[$i]*$singlebed[$i])+($charge->personcharge*$singleday[$i]*$singleperson[$i])+(($charge->personcharge/2)*$singleday[$i]*$singlechild[$i]);
		}
		return $total;
	}
	public function roomComplementary($price){
		$singleprice = explode(",", $price);
		$total = 0;
		for($i=0; $i<count($singleprice); $i++){
			$total += $singleprice[$i];
		}
		return $total;
	}
	public function poolcastinfodata($poollastins){
		$this->db->select('tbl_pool_booking.*,customerinfo.*');
        $this->db->from('tbl_pool_booking');
		$this->db->join('customerinfo','customerinfo.customerid=tbl_pool_booking.custid','left');
		$this->db->where('pbookingid',$poollastins);
        $query = $this->db->get();
	    return $query->row();

	}
	public function pitemlistdata($poollastins){
		$this->db->select('tbl_pool_bookingitem.*,tbl_pool_package.*');
        $this->db->from('tbl_pool_bookingitem');
		$this->db->join('tbl_pool_package','tbl_pool_package.packageid=tbl_pool_bookingitem.packageid','left');
		$this->db->where('tbl_pool_bookingitem.pbokingid',$poollastins);
        $query = $this->db->get();
	    return $query->result();

	}
	public function pitemdatarow($poollastins){
		$this->db->select('*');
        $this->db->from('tbl_pool_booking');
		$this->db->where('pbookingid',$poollastins);
        $query = $this->db->get();
	    return $query->row();

	}
	public function restaurantCust($id){
		$this->db->select("ci.*");
		$this->db->from("customer_order co");
		$this->db->join("customerinfo ci","ci.customerid=co.customer_id","left");
		$this->db->where("co.order_id", $id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	public function ritemlistdata($id){
		$this->db->select('if.ProductName,om.price,om.menuqty');
        $this->db->from('customer_order co');
		$this->db->join('order_menu om','om.order_id=co.order_id','left');
		$this->db->join('item_foods if','if.ProductsID=om.menu_id','left');
		$this->db->where('co.order_id',$id);
        $query = $this->db->get();
	    $result = $query->result();
		foreach($result as $k => $val){
			$result[$k]->subtotal = $val->price*$val->menuqty;
		}
		return $result;
	}
	public function ritemdatasingle($id){
		$this->db->select('co.order_id,co.totalamount');
        $this->db->from('customer_order co');
		$this->db->where('order_id',$id);
        $query = $this->db->get();
	    $row = $query->row();
		$row->details = $this->ritemlistdata($row->order_id);
		return $row;

	}
	public function paymentinfo($bookno){
		$this->db->select('tbl_guestpayments.*,payment_method.payment_method,tbl_hallroom_booking.paid_amount');
		$this->db->from('tbl_guestpayments');
		$this->db->join('payment_method','payment_method.payment_method_id=tbl_guestpayments.paymenttype','left');
		$this->db->join('tbl_hallroom_booking','tbl_hallroom_booking.hbid=tbl_guestpayments.bookedid','left');
		$this->db->where('tbl_guestpayments.book_type',1);
		$this->db->where('tbl_guestpayments.bookedid',$bookno);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	}
	public function details($id)
	{
		
		$this->db->select('tbl_hallroom_booking.*,GROUP_CONCAT(tbl_hallroom_info.hall_type ORDER BY tbl_hallroom_booking.hall_type,tbl_hallroom_info.hid) as roomtype,tbl_hallroom_info.rate');
        $this->db->from('tbl_hallroom_booking');
		$this->db->join('tbl_roomnofloorassign','FIND_IN_SET(tbl_roomnofloorassign.roomno,tbl_hallroom_booking.hall_no)<>0','left');
		$this->db->join('tbl_hallroom_info','FIND_IN_SET(tbl_hallroom_info.hid,tbl_roomnofloorassign.hallid)<>0','left');
		$this->db->where('tbl_hallroom_booking.hbid',$id);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
             return $query->row();    
        }
        return false;
	
	}
	public function customerinfo($cid){
		$this->db->select('*');
		$this->db->from('customerinfo');
		$this->db->where('customerid',$cid);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	}
	public function storeinfo(){
		$this->db->select('*');
		$this->db->from('setting');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	}
	public function taxinfo(){
		$this->db->select('*');
		$this->db->from('tbl_taxmgt');
		$this->db->where('isactive',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();    
		}
		return false;
	}
	public function btaxinfo($id){
		$this->db->select('*');
		$this->db->from('tbl_hallroom_postbill');
		$this->db->where('hrbooking',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	}
	public function commoninfo(){
		$this->db->select('*');
		$this->db->from('common_setting');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();    
		}
		return false;
	}
	public function currencysetting($id = null)
	{ 
		return $this->db->select("*")->from('currency')
			->where('currencyid',$id) 
			->get()
			->row();
	}
	public function allsizes()
	{
		$data = $this->db->select("*")
			->from('roomsizemesurement')
			->get()
			->result();

		$list[''] = 'Select Size';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->mesurementid] = $value->roommesurementitle;
			return $list;
		} else {
			return false; 
		}
	}
	public function findByHallId($id = null)
	{ 
		$this->db->select('*');
        $this->db->from("tbl_hallroom_info");
		$this->db->where('hid',$id); 
        $this->db->order_by('hid', 'desc');
        $query = $this->db->get();
	    return $query->row();
	} 
	public function seatplan()
	{
		$data = $this->db->select("*")
			->from('tbl_hallroom_seatplan')
			->get()
			->result();

		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->hsid] = $value->plan_name;
			return $list;
		} else {
			return false; 
		}
	}
	public function allfloor(){

        $this->db->select('*');
        $this->db->from('tbl_floor');
        $parent = $this->db->get();
        $roomnolist = $parent->result();
        $i=0;
        foreach($roomnolist as $floors){
            $roomnolist[$i]->sub = $this->roomno($floors->floorid);
            $i++;
        }
        return $roomnolist;
    }

    public function roomno($id){

        $this->db->select('*');
        $this->db->from('tbl_floorplan');
        $this->db->where('floorName', $id);

        $roomno = $this->db->get();
        $roomnolist = $roomno->result();
        $i=0;
        foreach($roomnolist as $floors){
            $roomnolist[$i]->sub = $floors->roomno;
            $i++;
        }
        return $roomnolist;       
    }
	public function allfacility(){

        $this->db->select('*');
        $this->db->from('roomfacilitytype');
        $parent = $this->db->get();
        $facilitilist = $parent->result();
        $i=0;
        foreach($facilitilist as $facility){
            $facilitilist[$i]->sub = $this->facilitiinfo($facility->facilitytypeid);
            $i++;
        }
        return $facilitilist;
    }

    public function facilitiinfo($id){

        $this->db->select('*');
        $this->db->from('roomfacilitydetails');
        $this->db->where('facilitytypeid', $id);

        $faciliti = $this->db->get();
        $facilitilist = $faciliti->result();
        $i=0;
        foreach($facilitilist as $facility){
            $facilitilist[$i]->sub = $facility->facilitytitle;
            $i++;
        }
        return $facilitilist;       
    }
	public function roomseatplan(){
		$this->db->select("hid,seatplan");
		$this->db->from("tbl_hallroom_info");
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $key => $val){
			$list = explode(",", $val->seatplan);
			$seatplan = "";
			for($i=0; $i<count($list); $i++){
				$plan = $this->db->select("plan_name")->from("tbl_hallroom_seatplan")->where("hsid", $list[$i])->get()->row();
				if(!empty($plan->plan_name)){
					$seatplan .= $plan->plan_name.",";
				}
			}
			$result[$key]->plan_name = trim($seatplan,",");
		}
		return $result;
	}
	public function hallcustomerlist()
	{
		$data = $this->db->select("customerid,firstname,lastname,cust_phone")
			->from('customerinfo')
			->get()
			->result();

		$list[''] = 'Select Customer';

		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customerid] = $value->firstname.' '.$value->lastname.'-'.$value->cust_phone;
			return $list;
		} else {
			return $list; 
		}
	}
	public function getlist($customer=NULL,$status=NULL,$payment_status=NULL,$fromdate=NULL,$todate=NULL)
	{
		$this->db->select("*");
		$this->db->from("tbl_hallroom_booking");
		if($fromdate != NULL){
			$this->db->where('tbl_hallroom_booking.start_date>=',$fromdate);
		}
		if($todate != NULL){
			$this->db->where('tbl_hallroom_booking.end_date<=',$todate);
		}
		if($status != NULL){
			$this->db->where('tbl_hallroom_booking.status',$status);
		}
		if($payment_status != NULL){
			$this->db->where('tbl_hallroom_booking.payment_status',$payment_status);
		}
		if($customer != NULL){
			$this->db->where('tbl_hallroom_booking.customerid',$customer);
		}
		$this->db->order_by("hbid","desc");
		$get = $this->db->get();
		$result = $get->result();
		return $result;
	}
	public function settinginfo()
	{ 
		return $this->db->select("*")->from('setting')
			->get()
			->row();
	}
}
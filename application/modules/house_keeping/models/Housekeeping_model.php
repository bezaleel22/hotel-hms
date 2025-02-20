<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Housekeeping_model extends CI_Model {
	
	private $table = 'tbl_housekeepingrecord';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('checklist_id',$id)
			->delete('tbl_checklist');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($data = array())
	{
		return $this->db->where('bookedid',$data["bookedid"])
			->update($this->table, $data);
	}

    public function read()
	{
	    $this->db->select('tbl_checklist.*');
        $this->db->from("tbl_checklist");
        $this->db->order_by('tbl_checklist.checklist_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 
	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        return $query->row();
    }
	
	public function findById($id = null)
	{ 
		$this->db->select('*,first_name');
        $this->db->from($this->table);
		$this->db->join('employee_history','employee_history.employee_id = tbl_housekeepingrecord.employee_id','left'); 
		$this->db->where('hkeeper_id',$id); 
		$this->db->where('status!=',1); 
        $this->db->order_by('hkeeper_id', 'desc');
        $query = $this->db->get();
	    return $query->row();
	} 
	public function findId($id = null)
	{ 
		$this->db->select('*');
        $this->db->from("tbl_checklist");
		$this->db->where('checklist_id',$id); 
        $this->db->order_by('checklist_id', 'desc');
        $query = $this->db->get();
	    return $query->row();
	} 


	
	public function allrooms()
	{
		$data = $this->db->select("*")
			->from('roomdetails')
			->get()
			->result();

		$list[''] = 'Select Room Type';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->roomid] = $value->roomtype;
			return $list;
		} else {
			return false; 
		}
	}
	public function allhousekeeper($day)
	{
	  $today = $day;
	  $path = 'application/modules/';
		  $map = directory_map($path);
		  $modnames = array();
		  if (is_array($map) && sizeof($map) > 0){
		  $modnames = array_filter(array_keys($map));
		  $modnames = preg_replace('/\W/', '', $modnames);
		  }
		  if (in_array("duty_roster", $modnames) === true && $this->db->table_exists('tbl_emproster_assign')) {
			  
		$data = $this->rosterwiseallhousekeeper($today);
		  } 
	  else{
		$data = $this->allhousekeeperemp();
	  }
  
	  $list[''] = 'Assign to';
	  if (!empty($data)) {
		$time = date("H:i");
		foreach($data as $value){
			$list[$value->employee_id] = $value->first_name;
		}
		return $list;
	  } else {
		return false; 
	  }
	}
	public function rosterwiseallhousekeeper($day)
	{
	  $data = $this->db->select("eh.first_name,eh.employee_id,ra.emp_startroster_time,ra.emp_endroster_time")
		->from('employee_history eh')
		->join('tbl_emproster_assign ra','ra.emp_id=eh.employee_id','left')
		->where('cast(concat(ra.emp_startroster_date, " ", ra.emp_startroster_time) as datetime) <= ',$day)
		->where('cast(concat(ra.emp_endroster_date," ", ra.emp_endroster_time) as datetime) >=',$day)
		->where('ra.is_complete',1)
		->where('eh.pos_id',6)
		->get()
		->result();
	  
		return $data; 
	  
	}
  
	public function allhousekeeperemp(){
	  $data = $this->db->select("emp_his_id,first_name,last_name,employee_id")
		   ->from('employee_history')
		   ->where('pos_id',6)
		   ->get()
		   ->result();
		   return $data;
	}
	public function allfloor($id){

        $this->db->select('DISTINCT(tbl_floor.floorid),tbl_floor.floorname');
        $this->db->from('tbl_floor');
        $this->db->join('tbl_roomnofloorassign fa','fa.floorid=tbl_floor.floorid');
        $this->db->where('fa.roomid',$id);
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
	public function product_list(){
		$this->db->select('products.id,products.product_name,tbl_category.categoryname');
        $this->db->from("products");
        $this->db->join("tbl_category","products.category_id=tbl_category.category_id","left");
		$this->db->where('products.category_id',501); 
        $this->db->order_by('products.id', 'desc');
        $query = $this->db->get();
	    return $query->result();
	}
	public function checklist(){
		$this->db->select('checklist_id,taskname');
        $this->db->from("tbl_checklist");
        $this->db->where('type', 1);
        $this->db->order_by('checklist_id', 'ASC');
        $query = $this->db->get();
	    return $query->result();
	}
	public function recordlist(){
		$this->db->select('eh.first_name,hr.*,rd.roomtype,u.firstname');
        $this->db->from("tbl_housekeepingrecord hr");
        $this->db->join("employee_history eh","eh.employee_id=hr.employee_id","left");
        $this->db->join("tbl_roomnofloorassign rf","rf.roomno=hr.roomno","left");
        $this->db->join("roomdetails rd","rd.roomid=rf.roomid","left");
        $this->db->join("user u","u.id=hr.assignby","left");
        $this->db->order_by('hr.hkeeper_id', 'DESC');
        $this->db->where('hr.status',1);
        $query = $this->db->get();
	    $work = $query->result();
		$i=0;
		foreach($work as $ework){
			$all_id = explode(",", $ework->all_checklist);
			$all_pid = explode(",", $ework->all_productlist);
			if($ework->all_checklist){
				$work[$i]->checklist = $this->allchecklist($all_id);
			}
			if($ework->all_productlist){
				$work[$i]->productlist = $this->allproductlist($all_pid);
			}
			$i++;
		}
		return $work;
	}
	public function allchecklist($ids){
		$data="";
		foreach($ids as $id){
			$this->db->select('taskname');
			$this->db->from("tbl_checklist");
			$this->db->where('checklist_id',$id);
			$result = $this->db->get()->row();
			$data .= $result->taskname.",";
		}
		return trim($data,",");
	}
	public function allproductlist($ids){
		$data="";
		foreach($ids as $id){
			$this->db->select('product_name');
			$this->db->from("products");
			$this->db->where('id',$id);
			$result = $this->db->get()->row();
			$data .= $result->product_name.",";
		}
		return trim($data,",");
	}
	public function employee(){
		$this->db->select('first_name,employee_id');
        $this->db->from("employee_history");
        $this->db->where("pos_id",6);
        $this->db->order_by('employee_id', 'ASC');
        $query = $this->db->get();
	    $emp = $query->result();
		return $emp;
	}
	public function findemplist($employee_id,$fromdate,$todate){
		$betweenq="tbl_housekeepingrecord.date_start >='".$fromdate."' AND tbl_housekeepingrecord.date_end <='".$todate."'";
		$this->db->select('employee_history.first_name,employee_history.employee_id');
        $this->db->from("employee_history");
        $this->db->where("pos_id",6);
		$this->db->group_by('employee_history.employee_id');
		if($employee_id){
			$this->db->where('employee_history.employee_id',$employee_id);
		}
        $this->db->order_by('employee_history.employee_id', 'ASC');
        $query = $this->db->get();
	    $empwork = $query->result();
		$i=0;
		foreach($empwork as $ework){
			$empwork[$i]->completed = $this->completedwork($ework->employee_id, $betweenq);
			$empwork[$i]->pending = $this->pendingwork($ework->employee_id, $fromdate);
			$empwork[$i]->underprocess = $this->underprocess($ework->employee_id, $fromdate);
			$i++;
		}
		return $empwork;
	}
	public function emplist(){
		$this->db->select('first_name,employee_id');
        $this->db->from("employee_history");
        $this->db->where("pos_id",6);
        $this->db->order_by('employee_id', 'ASC');
        $query = $this->db->get();
	    $empwork = $query->result();
		$i=0;
		foreach($empwork as $ework){
			$empwork[$i]->completed = $this->completedwork($ework->employee_id);
			$empwork[$i]->pending = $this->pendingwork($ework->employee_id);
			$empwork[$i]->underprocess = $this->underprocess($ework->employee_id);
			$i++;
		}
		return $empwork;
	}
	public function completedwork($id, $betweenq=NULL){
		$this->db->select('COUNT(employee_id) as workdone');
        $this->db->from("tbl_housekeepingrecord");
		if($betweenq){
			$this->db->where($betweenq);
		}
        $this->db->where('employee_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
	    $work = $query->row();
		return $work->workdone;
	}
	public function pendingwork($id, $betweenq=NULL){
		$this->db->select('COUNT(employee_id) as workdone');
        $this->db->from("tbl_housekeepingrecord");
		if($betweenq){
			$this->db->where('createDate>=',$betweenq);
		}
        $this->db->where('employee_id', $id);
        $this->db->where('status', 0);
        $query = $this->db->get();
	    $work = $query->row();
		return $work->workdone;
	}
	public function underprocess($id, $betweenq=NULL){
		$this->db->select('COUNT(employee_id) as workdone');
        $this->db->from("tbl_housekeepingrecord");
		if($betweenq){
			$this->db->where('createDate>=',$betweenq);
		}
        $this->db->where('employee_id', $id);
        $this->db->where('status', 2);
        $query = $this->db->get();
	    $work = $query->row();
		return $work->workdone;
	}
	public function findrecordlist($employee_id,$fromdate,$todate)
	{
		$betweenq="hr.date_start >='".$fromdate."' AND hr.date_end <='".$todate."'";
		$this->db->select('eh.first_name,hr.*,rd.roomtype,u.firstname');
        $this->db->from("tbl_housekeepingrecord hr");
        $this->db->join("employee_history eh","eh.employee_id=hr.employee_id","left");
        $this->db->join("tbl_roomnofloorassign rf","rf.roomno=hr.roomno","left");
        $this->db->join("roomdetails rd","rd.roomid=rf.roomid","left");
        $this->db->join("user u","u.id=hr.assignby","left");
		$this->db->where($betweenq);
		if($employee_id){
			$this->db->where('hr.employee_id',$employee_id);
		}
        $this->db->order_by('hr.hkeeper_id', 'DESC');
        $query = $this->db->get();
	    $work = $query->result();
		$i=0;
		foreach($work as $ework){
			$all_id = explode(",", $ework->all_checklist);
			$all_pid = explode(",", $ework->all_productlist);
			if($ework->all_checklist){
				$work[$i]->checklist = $this->allchecklist($all_id);
			}
			if($ework->all_productlist){
				$work[$i]->productlist = $this->allproductlist($all_pid);
			}
			$i++;
		}
		return $work;
	
	}
	public function laundry(){
		$this->db->select('l.*,eh.first_name');
        $this->db->from("tbl_laundry l");
        $this->db->join("employee_history eh", "eh.employee_id=l.operate_by", "left");
        $this->db->order_by('l.laundry_id', 'DESC');
        $query = $this->db->get()->result();
		$i=0;
		foreach($query as $itemid){
			$id = explode(",",$itemid->product_id);
			$qty = explode(",",$itemid->quantity);
			$list = explode(",,",$itemid->checklist);
				$query[$i]->product_name = $this->productlist($id);
				$query[$i]->totalcost = $this->totalcost($list,$id,$qty);
			$i++;
		}
        return $query;
	}
	public function productlist($id){
		$data="";
		for($i=0; $i<count($id); $i++){
			$this->db->select('p.product_name');
			$this->db->from("products p");
			$this->db->join('tbl_category c','c.category_id=p.category_id','left');
			$this->db->where('p.id', $id[$i]);
			$this->db->where('c.category_id', 501);
			$query = $this->db->get()->row();
			$data .= $query->product_name.",";
			}
		return trim($data,",");
	}
	public function totalcost($list,$id,$qty){
		$data=0;
		for($i=0; $i<count($list); $i++){
			$clist = explode(",", $list[$i]);
			for($j=0; $j<count($clist); $j++){
				$this->db->select('hi.price');
				$this->db->from("tbl_hkitem hi");
				$this->db->where('hi.product_id', trim($id[$i]));
				$this->db->where('hi.checklist', trim($clist[$j]));
				$query = $this->db->get()->row();
				$data += (!empty($query->price)?$query->price*$qty[$i]:0);
			}
		}
		return trim($data);
	}
	public function product(){
		$data = $this->db->select("*")
			->from("products")
			->where("category_id",501)
			->where("reuseable",1)
			->where("is_active",1)
			->get()
			->result();

		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->product_name;
			return $list;
		} else {
			return false;
		}
	}
	public function employeelist(){
		$data = $this->db->select("first_name,employee_id")
			->from("employee_history")
			->where("pos_id",6)
			->get()
			->result();

		$list[''] = "Select Employee";
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->employee_id] = $value->first_name;
			return $list;
		} else {
			return $list; 
		}
	}
	public function read_reuseiteam(){
		$this->db->select('rp.*,p.product_name,c.categoryname');
        $this->db->from("tbl_reuseableproduct rp");
		$this->db->join('products p','p.id=rp.product_id','left');
		$this->db->join('tbl_category c','c.category_id=p.category_id','left');
        $this->db->where('p.reuseable', 1);
        $this->db->order_by('p.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	public function itemlist()
	{
	    $this->db->select('tbl_hkitem.*,p.product_name');
        $this->db->from("tbl_hkitem");
        $this->db->join("products p","p.id=tbl_hkitem.product_id","left");
        $this->db->order_by('tbl_hkitem.item_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	public function findItemId($id = null)
	{ 
		$this->db->select('*');
        $this->db->from("tbl_hkitem");
		$this->db->where('item_id',$id); 
        $query = $this->db->get();
	    return $query->row();
	}
	public function itemDelete($id = null)
	{
		$this->db->where('item_id',$id)
			->delete('tbl_hkitem');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}   
	public function hkproduct(){
		$data = $this->db->select("*")
			->from("products")
			->where("category_id",501)
			->where("reuseable",1)
			->where("is_active",1)
			->get()
			->result();

		$list[''] = "Select Item";
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->product_name;
			return $list;
		} else {
			return $list; 
		}
	}
	public function hkchecklist(){
		$data = $this->db->select("cl.*")
			->from("tbl_checklist cl")
			->where("type",2)
			->get()
			->result();

		$list[''] = "Select Task";
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->taskname] = $value->taskname;
			return $list;
		} else {
			return $list; 
		}
	}
	public function laundrychecklist(){
		$data = $this->db->select("cl.*")
			->from("tbl_checklist cl")
			->where("type",2)
			->get()
			->result();
			return $data; 
	}
	public function laundry_list(){
		$data = $this->db->select("lp.*")
			->from("tbl_laundry_payment lp")
			->get()
			->result();
			return $data; 
	}
	public function laundry_pay($id){
		$data = $this->db->select("lp.*")
			->from("tbl_laundry_payment lp")
			->where("lp.landry_id", $id)
			->get()
			->row();
			return $data; 
	}
	public function laundry_payment($data){
		return $this->db->where("landry_id", $data['landry_id'])
			->update("tbl_laundry_payment", $data);
	}
	public function invoicelist()
	{
		$data = $this->db->select("invoice_no,comment")
			->from('tbl_laundry')
			->where('type','add')
			->get()
			->result();

		$list[''] = 'Select Invoice';

		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->invoice_no] = $value->invoice_no."-".$value->comment;
			return $list;
		} else {
			return $list; 
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_model extends CI_Model {

	// CRUD Operation Start
	public function read_all($select_items, $table, $where_array = NULL, $order_by_name = NULL, $order_by = NULL)
    {
        $this->db->select($select_items);
        $this->db->from($table);
		if ($where_array != NULL && is_array($where_array) && sizeof($where_array) > 0)
        {
			foreach ($where_array as $field => $value) {
				$this->db->where($field, $value);
			}
        }
        if ($order_by_name != NULL && $order_by != NULL)
        {
            $this->db->order_by($order_by_name, $order_by);
        }
        return $this->db->get()->result();
    }

	public function create($tabel, $data = array())
	{
		return $this->db->insert($tabel, $data);
	}

	public function dataById($table, $whereid, $id = null)
	{ 
		$this->db->select('*');
        $this->db->from($table);
		$this->db->where($whereid,$id); 
        $query = $this->db->get();
	    return $query->row();
	} 

	public function update($table, $whereid,$wherefeild, $data = array())
	{
		return $this->db->where($whereid ,$wherefeild)->update($table, $data);
	}

	public function delete($table, $whereid, $id = null)
	{
		if ($id != NULL) {
			$this->db->where($whereid,$id)
			->delete($table);
		}
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	// CRUD Operation End

	public function vehicle_dtls_list(){

		$this->db->select('*');
        $this->db->from('tbl_vehicle_details');
		
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

    public function driver_data()
    {
        $path = 'application/modules/';
        $map = directory_map($path);
        $modnames = array();
        if (is_array($map) && sizeof($map) > 0){
        $modnames = array_filter(array_keys($map));
        $modnames = preg_replace('/\W/', '', $modnames);
        }
        if (in_array("duty_roster", $modnames) === true && $this->db->table_exists('tbl_emproster_assign')) {
            
			$data = $this->rosterwise_driver();
        } 
		else{
			$data = $this->driver_without_roster();
		}

		$list = array('' => 'Select Driver');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->employee_id]=$value->first_name.' '.$value->last_name;
            }
            return $list;
        } else {
			return false; 
		}
       
    }

    public function driver_without_roster()
	{
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('pos_id',17);
        $query=$this->db->get();
        $data=$query->result();	
        return $data;
	}
 	public function rosterwise_driver()
	{
		$timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);
        $today=date('Y-m-d H:i');
		$data = $this->db->select("eh.emp_his_id,eh.first_name,eh.last_name,eh.employee_id,ra.*")
			->from('employee_history eh')
			->join('tbl_emproster_assign ra','ra.emp_id=eh.employee_id','left')
			->where('cast(concat(ra.emp_startroster_date, " ", ra.emp_startroster_time) as datetime) <= ',$today)
			->where('cast(concat(ra.emp_endroster_date," ", ra.emp_endroster_time) as datetime) >=',$today)
			->where('ra.is_complete',1)
			->where('eh.pos_id',17)
			->get()
			->result();
			return $data;
	}

	public function vehicle_book_list(){

		$this->db->select('tbl_vehicle_booking.*,tbl_flight_details.flight_num, tbl_vehicle_details.vehicle_number, tbl_vehicle_details.vehicle_type, 
		customerinfo.firstname, (employee_history.first_name) as driver');
        $this->db->from('tbl_vehicle_booking');
		$this->db->join('tbl_flight_details','tbl_flight_details.flyid = tbl_vehicle_booking.flight_id','left');
		$this->db->join('tbl_vehicle_details','tbl_vehicle_details.vdsid = tbl_vehicle_booking.vehicle_id','left');
		$this->db->join('customerinfo','customerinfo.customerid = tbl_vehicle_booking.cust_id','left');
		$this->db->join('employee_history','employee_history.employee_id = tbl_vehicle_booking.driver_id','left');
        $this->db->order_by('tbl_vehicle_booking.vbkid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

    public function vbooksearchdata($fromdate=NULL,$todate=NULL)
	{
		
		
		$this->db->select('tbl_vehicle_booking.*,tbl_flight_details.flight_num, tbl_vehicle_details.vehicle_number, tbl_vehicle_details.vehicle_type, 
		customerinfo.firstname, (employee_history.first_name) as driver');
        $this->db->from('tbl_vehicle_booking');
		$this->db->join('tbl_flight_details','tbl_flight_details.flyid = tbl_vehicle_booking.flight_id','left');
		$this->db->join('tbl_vehicle_details','tbl_vehicle_details.vdsid = tbl_vehicle_booking.vehicle_id','left');
		$this->db->join('customerinfo','customerinfo.customerid = tbl_vehicle_booking.cust_id','left');
		$this->db->join('employee_history','employee_history.employee_id = tbl_vehicle_booking.driver_id','left');
		if($fromdate != NULL){
			$this->db->where('cast(tbl_vehicle_booking.transportation_time as date)>=',$fromdate);
		}
		if($todate != NULL){
			$this->db->where('cast(tbl_vehicle_booking.transportation_time as date)<=',$todate);
		}
		
        $this->db->order_by('tbl_vehicle_booking.vbkid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	
	}

	public function customer_data()
    {
        $condi1 = "signupdate > now() - INTERVAL 20 day";
        $this->db->select('*');
        $this->db->from('customerinfo');
        $this->db->where($condi1);
        
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Customer');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->customerid]=$value->firstname;
            }
        }
        return $list;
    }

	public function flight_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_flight_details');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Flight');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->flyid]=$value->flight_num;
            }
        }
        return $list;
    }

	public function vehicle_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_vehicle_details');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Vehicle');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->vdsid]=$value->vehicle_number.'-'.$value->vehicle_type;
            }
        }
        return $list;
    }
	
	
}

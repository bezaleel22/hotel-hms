<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift_model extends CI_Model 
{
    public function shift_data()
	{
		return $this->db->select('*')	
		->from('tbl_empwork_shift')
		->order_by('shiftid', 'desc')
		->get()
		->result();
	}
	
	public function shift_create($data = array())
	{
		return $this->db->insert('tbl_empwork_shift', $data);
	}

	public function shift_delete($id = null)
	{
		$this->db->where('shiftid',$id)
		->delete('tbl_empwork_shift');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function update_shift($data = array())
	{
		$this->db->where('shiftid',$data["shiftid"])->update("tbl_empwork_shift", $data);
		$today = date("Y-m-d");
		$future_roster = $this->db->select('*')->from('tbl_duty_roster')->where('shift_id',$data["shiftid"])->where('roster_start >',$today)->get()->result();
		foreach($future_roster as $future_data){

			$chk_rosterassign_data = $this->db->select('*')->from('tbl_emproster_assign')->where('roster_id',$future_data->roster_id)->get()->num_rows();
			if ($chk_rosterassign_data > 0) {
				$Data2 = array(
					'emp_startroster_time' => $data["shift_start"],
					'emp_endroster_time'   => $data["shift_end"],
				);
				$this->db->where('roster_id',$future_data->roster_id)->update("tbl_emproster_assign", $Data2);
			}
		}
		$condi = "'".$today."' BETWEEN roster_start AND roster_end";
		$current_roster = $this->db->select('*')->from('tbl_duty_roster')->where($condi)->where('shift_id', $data["shiftid"])->get()->row();
		$chk_currentrosterassign_data = $this->db->select('*')->from('tbl_emproster_assign')->where('roster_id',$current_roster->roster_id)->get()->num_rows();
		if (!empty($current_roster) && $chk_currentrosterassign_data > 0) {
			$Data3 = array(
				'emp_startroster_time' => $data["shift_start"],
				'emp_endroster_time'   => $data["shift_end"],
			);
			$this->db->where('roster_id',$current_roster->roster_id)->update("tbl_emproster_assign", $Data3);
		}
		return true;
		
	}

	public function shift_databyid($id){
	$this->db->where('shiftid',$id);
	$query = $this->db->get('tbl_empwork_shift');
	return $query->row();
    }

	public function shiftassign_data()
	{
		return $this->db->select('tbl_emproster_assign.*,employee_history.first_name,employee_history.last_name,tbl_duty_roster.*')	
		->join('tbl_duty_roster','tbl_duty_roster.roster_id=tbl_emproster_assign.roster_id','left')
		->join('employee_history','employee_history.employee_id=tbl_emproster_assign.emp_id','left')
		->from('tbl_emproster_assign')
		->order_by('tbl_emproster_assign.sftasnid', 'desc')
		->where_not_in('is_edited',1)
		->group_by('tbl_emproster_assign.roster_id')
		->group_by('tbl_emproster_assign.emp_id')
		->get()
		->result();
	}

	public function shiftroster_data()
	{
		return $this->db->select('tbl_emproster_assign.*,tbl_duty_roster.*')	
		->join('tbl_duty_roster','tbl_duty_roster.roster_id=tbl_emproster_assign.roster_id','left')
		->from('tbl_emproster_assign')
		->order_by('tbl_emproster_assign.sftasnid', 'desc')
		->group_by('tbl_emproster_assign.roster_id')
		->get()
		->result();
	}

	public function shif_data()
	{
		$data = $this->db->select("*")
		->from('tbl_empwork_shift')
		->get()
		->result();

		$list[''] = array();
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->shiftid] = $value->shift_name;
			return $list;
		} else {
			return false; 
		}
	}

	public function roster_datalist()
	{            
        $tdate =  date("Y-m-d");
		$rost_ids = array();
		$this->db->select('roster_id');
		$this->db->from('tbl_emproster_assign');
		$shifts=$this->db->get()->result_array();
		$i=0;
		foreach ($shifts as $shift) 
		{
			$rost_ids[$i] = $shift['roster_id'];
			$i++;
		}
		
		$this->db->select("tbl_duty_roster.*,tbl_empwork_shift.shift_name");
		$this->db->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id','left');
		$this->db->from('tbl_duty_roster');
		if($rost_ids){
			$this->db->where_not_in('roster_id', $rost_ids);
		}

		$this->db->where('tbl_duty_roster.roster_end >', $tdate);
		$data = $this->db->get()->result();
		$list[''] = display('select_roster');
		if (!empty($data)) 
		{
			foreach($data as $value)
				$list[$value->roster_id] = '('.$value->roster_start.' - '.$value->roster_end.') '.$value->shift_name;
			return $list;
		} else {
			return false; 
		}
	}

	public function emp_data()
	{
		$this->db->select("employee_history.emp_his_id, employee_history.employee_id,employee_history.first_name,
		employee_history.middle_name,employee_history.last_name,position.position_name,");
		$this->db->from('employee_history');
		$this->db->join('position','position.pos_id=employee_history.pos_id','left');
		$data = $this->db->get()->result();
		return $data;
	}

	public function empedit_data()
	{	
		$this->db->select("employee_history.emp_his_id, employee_history.employee_id,employee_history.first_name,
		employee_history.middle_name,employee_history.last_name,position.position_name,");
		$this->db->from('employee_history');
		$this->db->join('position','position.pos_id=employee_history.pos_id','left');
		$data = $this->db->get()->result();
		return $data;
	}
	
	public function roster_viewdata($id)
	{
		return $this->db->select('*')	
		->from('tbl_duty_roster')
		->where('roster_id',$id)
		->get()
		->row();
	}

	public function shift_assign_create($data = array())
	{
		return $this->db->insert('tbl_emproster_assign', $data);
	}

	public function rstasninfodatabyid($id)
	{
        $query = $this->db->select('tbl_duty_roster.*, tbl_empwork_shift.*');
        $this->db->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id','left');
        $this->db->where('tbl_duty_roster.roster_id',$id);
		$this->db->from('tbl_duty_roster');
        return $query =$this->db->get()->row();
    }

	public function emp_ckdata($id)
	{
		$this->db->select("*");
		$this->db->from('tbl_emproster_assign');
		$this->db->where('roster_id',$id);
		$this->db->group_by('emp_id');
		$data = $this->db->get()->result();
		return $data;
	}

	public function emp_namedata($id){
		return $this->db->select('employee_history.first_name,employee_history.last_name')
		->join('employee_history','employee_history.employee_id=tbl_emproster_assign.emp_id','left')
		->from('tbl_emproster_assign')
		->where('sftasnid',$id)
		->get()
		->row();
}

	public function roster_emp_data($id)
	{
		return $this->db->select('tbl_emproster_assign.*,employee_history.first_name,employee_history.last_name,employee_history.employee_id')	
		->join('employee_history','employee_history.employee_id=tbl_emproster_assign.emp_id','left')
		->from('tbl_emproster_assign')
		->where('tbl_emproster_assign.roster_id',$id)
		->where_not_in('is_edited',1)
		->group_by('tbl_emproster_assign.emp_id')
		->get()
		->result();
	}

	public function update_shiftassign($data = array())
	{
		return $this->db->where('sftasnid',$data["sftasnid"])
		->update("tbl_emproster_assign", $data);
	}

	public function assigned_roster_delete($id = null)
	{
		$this->db->where('roster_id',$id)
		->delete('tbl_emproster_assign');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function assignshift_delete($roster_id, $emp_id)
	{
		$this->db->where('roster_id',$roster_id)
		->where('emp_id',$emp_id)
		->delete('tbl_emproster_assign');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 


	public function roster_data()
	{
		return $this->db->select('tbl_duty_roster.*,tbl_empwork_shift.shift_name')	
		->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id','left')
		->from('tbl_duty_roster')
		->order_by('tbl_duty_roster.roster_id', 'desc')
		->group_by('tbl_duty_roster.roster_start')
		->get()
		->result();
	}

	public function roster_create($data = array())
	{
		return $this->db->insert('tbl_duty_roster', $data);
	}

	public function roster_delete($roster_start, $roster_end)
	{
		$this->db->where('roster_start',$roster_start)
		->where('roster_end',$roster_end)
		->delete('tbl_duty_roster');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function roster_databyid($id){
		$this->db->where('rostentry_id',$id);
		$query = $this->db->get('tbl_duty_roster');
		return $query->row();
	}

	public function current_shift_list()
	{
		$today = date('Y-m-d');
		$idfromdate = $this->db->select("roster_id")
		->from('tbl_emproster_assign')
		->where('emp_startroster_date', $today)
		->get()->row();

		if ($idfromdate) {
			$rostentry_id = $this->db->select("rostentry_id")
			->from('tbl_duty_roster')
			->where('roster_id', $idfromdate->roster_id)
			->get()->row();
		}
		if ($idfromdate) {
			$curshift_id = $this->db->select("shift_id")
			->from('tbl_duty_roster')
			->where('rostentry_id', $rostentry_id->rostentry_id)
			->get()->result();

			return $curshift_id;
		}
	}

	public function current_date_emps()
	{
		$today = date('Y-m-d');
		$cr_time =  date("Y-m-d H:i");
        $this->db->select('tbl_emproster_assign.*,CONCAT_WS(" ",employee_history.first_name, employee_history.last_name) AS employee_name,position.position_name');
        $this->db->from('tbl_emproster_assign');
		$this->db->join('employee_history','employee_history.employee_id=tbl_emproster_assign.emp_id','left');
		$this->db->join('position','position.pos_id = employee_history.pos_id','left');
		 $this->db->where('cast(concat(tbl_emproster_assign.emp_startroster_date, " ", tbl_emproster_assign.emp_startroster_time) as datetime) <= ',$cr_time);
		$this->db->where('cast(concat(tbl_emproster_assign.emp_endroster_date," ", tbl_emproster_assign.emp_endroster_time) as datetime) >=',$cr_time);
        $query=$this->db->get();
        $data=$query->result();
	
		return $data;

	}
	public function click_shift_data($id, $clickdate)
	{
        $cr_date =  $clickdate;

		$data =$this->db->select('roster_id')
		->from('tbl_duty_roster')
		->where('shift_id', $id)
		->where('roster_start<= ', $cr_date)
		->where('roster_end >=', $cr_date)->get()->row();

		return $this->db->select('emp_id')
		->from('tbl_emproster_assign')
		->where('roster_id', $data->roster_id)
		->where('emp_startroster_date', $cr_date)->get()->result();
		
	}

	public function cndate_shift_list($cndate)
	{
		$cndaterstrid = $this->db->select("DISTINCT(roster_id)")
        ->from('tbl_emproster_assign')
        ->where('emp_startroster_date', $cndate)
        ->get()->result();

		return $cndaterstrid;
		

	}
	public function cuuentshiftid()
	{
		$datetime = date("Y-m-d H:i");
		$this->db->select('tbl_duty_roster.shift_id');
		$this->db->from('tbl_emproster_assign');
		$this->db->join('tbl_duty_roster','tbl_duty_roster.roster_id = tbl_emproster_assign.roster_id','left');
		$this->db->where('cast(concat(tbl_emproster_assign.emp_startroster_date, " ", tbl_emproster_assign.emp_startroster_time) as datetime) <= ',$datetime);
		$this->db->where('cast(concat(tbl_emproster_assign.emp_endroster_date," ", tbl_emproster_assign.emp_endroster_time) as datetime) >=',$datetime);
		$query=$this->db->get();
		$data=$query->row();
		return $data;
	}

	public function cng_date_emps($cndate)
	{
		$data = $this->db->select("roster_id")
		->from('tbl_emproster_assign')
		->where('emp_startroster_date', $cndate)
		->get()->row();
		if ($data) {
			
			$data2 = $this->db->select("emp_id")
			->from('tbl_emproster_assign')
			->where('roster_id', $data->roster_id)
			->where('emp_startroster_date ', $cndate)
			->group_by('emp_id')
			->order_by('emp_id','desc')
			
			->get()->result();
			
			return $data2;
		}else{
			return false;
		}

	}
	public function cng_date_currstr_emps($cndate)
	{
		$crtime = date("H:i");
		$data = $this->db->select("roster_id")
		->from('tbl_emproster_assign')
		->where('emp_startroster_date', $cndate)
		->where('cast(emp_startroster_time AS time) <= ', $crtime)
		->where('cast(emp_endroster_time AS time) >= ', $crtime)
		->get()->row();
		if ($data) {
			
			$data2 = $this->db->select("emp_id")
			->from('tbl_emproster_assign')
			->where('roster_id', $data->roster_id)
			->where('emp_startroster_date ', $cndate)
			->group_by('emp_id')
			->order_by('emp_id','desc')
			
			->get()->result();
			
			return $data2;
		}else{
			return false;
		}

	}

	public function emp_data_shift_update($data = array())
	{
		return $this->db->where('sftasnid',$data["sftasnid"])
			->update("tbl_emproster_assign", $data);
	}
 
}

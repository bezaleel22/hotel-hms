<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrmodule_model extends CI_Model {
 
	public function tablelist(){
		$this->db->select('rest_table.*,table_setting.settingid,table_setting.tableid as settingtable,table_setting.iconpos');
        $this->db->from('rest_table');
		$this->db->join('table_setting','table_setting.tableid=rest_table.tableid','left');
        $this->db->order_by('table_setting.settingid', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	private function get_qronlineorder_query()
	{
			$column_order = array(null, 'customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable orderable
			$column_search = array('customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable searchable 
			$order = array('customer_order.order_id' => 'asc');
		
		$cdate=date('Y-m-d');
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.cutomertype',99);
		$this->db->order_by('customer_order.order_id','desc');
		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_qronlineorder()
	{
		$this->get_qronlineorder_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function count_filtertqrorder()
	{
		$this->get_qronlineorder_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allqrorder()
	{
		$cdate=date('Y-m-d');
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.cutomertype',99);
		$this->db->where('bill.bill_status',1);
		return $this->db->count_all_results();
	}
public function roomlist()
	{    
	    $this->db->select('tbl_roomnofloorassign.*,floorname');
        $this->db->from('tbl_roomnofloorassign');
		$this->db->join('tbl_floor','tbl_floor.floorid=tbl_roomnofloorassign.floorid','left');
        $this->db->order_by('roomno', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 
	
 

}

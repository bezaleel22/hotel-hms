<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poolsetting_model extends CI_Model {
	

	public function create($tabel, $data = array())
	{
		return $this->db->insert($tabel, $data);
	}

	//pool booking Start
	public function pool_booking_data()
	{
	    $this->db->select('tbl_pool_booking.*, CONCAT_WS(" ",customerinfo.firstname,customerinfo.lastname) AS cust_name');
        $this->db->from('tbl_pool_booking');
		
		$this->db->join('customerinfo','customerinfo.customerid=tbl_pool_booking.custid','left');
        $this->db->order_by('tbl_pool_booking.pbookingid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function poolpack_data(){

		$this->db->select('*');
        $this->db->from('tbl_pool_package');
		$this->db->where('status',1);
        $this->db->order_by('packageid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	
	//pool booking End

	//pool type Start
	public function pool_type_data(){

		$this->db->select('*');
        $this->db->from('tbl_pool_type');
        $this->db->order_by('potyid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	

	public function pool_ty_create($data = array())
	{
		return $this->db->insert('tbl_pool_type', $data);
	}

	public function pooltypeDataById($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_pool_type');
		$this->db->where('potyid',$id); 
        $query = $this->db->get();
	    return $query->row();
	} 

	public function pool_type_update($data = array())
	{
		return $this->db->where('potyid',$data["potyid"])
			->update('tbl_pool_type', $data);
	}

	public function delete_pool_type($id = null)
	{
		$this->db->where('potyid',$id)
			->delete('tbl_pool_type');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	//pool type End

	//Swimming pool start
	public function pool_data(){

		$this->db->select('*');
        $this->db->from('tbl_swimming_pool');
        $this->db->order_by('poolid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

	public function pool_ty_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_pool_type');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Pool Type');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->typename]=$value->typename;
            }
        }
        return $list;
    }

	public function pool_create($data = array())
	{
		return $this->db->insert('tbl_swimming_pool', $data);
	}

	public function poolDataById($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_swimming_pool');
		$this->db->where('poolid',$id); 
        $query = $this->db->get();
	    return $query->row();
	} 

	public function pool_update($data = array())
	{
		return $this->db->where('poolid',$data["poolid"])
		->update('tbl_swimming_pool', $data);
	}

	public function delete_pool($id = null)
	{
		$this->db->where('poolid',$id)
		->delete('tbl_swimming_pool');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	//Swimming pool End

	//Pool Image Start

	public function pool_img_data(){

		$this->db->select('tbl_pool_image.*,tbl_swimming_pool.poolname');
        $this->db->from('tbl_pool_image');
		$this->db->join('tbl_swimming_pool','tbl_swimming_pool.poolid=tbl_pool_image.pool_id','left');
        $this->db->order_by('tbl_pool_image.pool_img_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

	public function poolname_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_swimming_pool');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Pool');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->poolid]=$value->poolname;
            }
        }
        return $list;
    }

	public function create_pool_img($data = array())
	{
		return $this->db->insert('tbl_pool_image', $data);
	}

	public function poolimageById($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_pool_image');
		$this->db->where('pool_img_id',$id); 
        $query = $this->db->get();
	    return $query->row();
	}

	public function update_pool_img($data = array())
	{
		return $this->db->where('pool_img_id',$data["pool_img_id"])
		->update('tbl_pool_image', $data);
	}

	public function delete_p_img($id = null)
	{
		$this->db->where('pool_img_id',$id)
		->delete('tbl_pool_image');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	//Pool Image End 
	
	//Pool Package Start 

	public function pool_pack_data(){

		$this->db->select('tbl_pool_package.*,tbl_swimming_pool.poolname');
        $this->db->from('tbl_pool_package');
		$this->db->join('tbl_swimming_pool','tbl_swimming_pool.poolid=tbl_pool_package.poolid','left');
        $this->db->order_by('tbl_pool_package.packageid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

	public function poolpackageById($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_pool_package');
		$this->db->where('packageid',$id); 
        $query = $this->db->get();
	    return $query->row();
	}

	public function update_pool_package($data = array())
	{
		return $this->db->where('packageid',$data["packageid"])
		->update('tbl_pool_package', $data);
	}

	public function delete_pack($id = null)
	{
		$this->db->where('packageid',$id)
		->delete('tbl_pool_package');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function customer_data()
    {
		$cr_time =  date("Y-m-d H");
        $this->db->select('*');
        $this->db->from('booked_info');
		$this->db->join('customerinfo','customerinfo.customerid=booked_info.cutomerid','right');
		 $this->db->where('CAST(booked_info.checkindate AS datetime) <=',$cr_time);
		$this->db->where('CAST(booked_info.checkoutdate AS datetime) >=',$cr_time);
		$this->db->where('booked_info.bookingstatus',4);
		$this->db->group_by('booked_info.cutomerid');
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Customer(In House)');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->customerid]=$value->firstname.' '.$value->lastname;
            }
        }
        return $list;
    }

	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        return $query->row();
    }

	public function book_create_ajax($data = array())
	{
		$this->db->insert('tbl_pool_booking', $data);
		$bokins_id =  $this->db->insert_id();

		$pbookinfo=$this->db->select('*')->from('tbl_pool_booking')->where('pbookingid',$bokins_id)->get()->row();
		$cusinfo = $this->db->select('*')->from('customerinfo')->where('customerid',$pbookinfo->custid)->get()->row();
		$headn = $cusinfo->customernumber.'-'.$cusinfo->firstname.' '.$cusinfo->lastname;
		$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
		$pbooknumber=$pbookinfo->poolbooking_number;
		$saveid=$this->session->userdata('id');
		$bookdate = $pbookinfo->entrydate;
		
		//Customer debit for Pool Value
		$narration = 'Customer debit for Swimming Pool Invoice# '.$pbooknumber;
		transaction($pbooknumber, 'CIV', $bookdate, 102030101, $narration, $pbookinfo->total_amount, 0, 0, 1, $saveid, $bookdate, 1);
		
		//Pool service credit for Pool Value
		$narration = 'Pool service Credit for Swimming Pool Invoice# '.$pbooknumber;
		transaction($pbooknumber, 'CIV', $bookdate, 30302, $narration, 0, $pbookinfo->total_amount, 0, 1, $saveid, $bookdate, 1);
			
		// Customer Credit for paid amount.
		$narration = 'Customer Credit for Swimming Pool Invoice# '.$pbooknumber;
		transaction($pbooknumber, 'CIV', $bookdate, 102030101, $narration, 0, $pbookinfo->total_amount, 0, 1, $saveid, $bookdate, 1);

		// Income for company in cash	
		$narration = 'Cash in Hand payment Debit For Swimming Pool Invoice# '.$pbooknumber;
		transaction($pbooknumber, 'Swimming Pool Rent', $bookdate, 1020101, $narration, $pbookinfo->total_amount, 0, 0, 1, $saveid, $bookdate, 1);
		
		
		$loopnum = $this->input->post('loopnum',true);
		$qty = explode(" ",$this->input->post('itemqtyinp',true));
		$packname =explode(" ",$this->input->post('package_idinp',true));
		$perprice = explode(" ",$this->input->post('per_priceinp',true));
		$quantity = explode(" ",$this->input->post('itemqtyinp',true));
		$subt_price = explode(" ",$this->input->post('sub_totalinp',true));
		
		for ($i=0, $n=$loopnum; $i < $n; $i++) {
			$package_name = $packname[$i];
			$package_rate = $perprice[$i];
			$itemqty = $quantity[$i];
			$sub_total = $subt_price[$i];
			$data3 = array(
				'pbokingid'			=>	$bokins_id,
				'packageid'			=>	$package_name,
				'perprice'		    =>	$package_rate,
				'itemqty'			=>	$itemqty,
				'total_price'		=>	$sub_total,
				'entrydate'         =>  date('Y-m-d')
			);
		
			if(!empty($quantity))
			{
				$this->db->insert('tbl_pool_bookingitem',$data3);
			}
		}
		return $bokins_id;
	}

	public function book_create_ajax_inhouse($data = array())
	{
		$this->db->insert('tbl_pool_booking', $data);
		$bokins_id =  $this->db->insert_id();

		$pbookinfo=$this->db->select('*')->from('tbl_pool_booking')->where('pbookingid',$bokins_id)->get()->row();
		$cusinfo = $this->db->select('*')->from('customerinfo')->where('customerid',$pbookinfo->custid)->get()->row();
		$headn = $cusinfo->customernumber.'-'.$cusinfo->firstname.' '.$cusinfo->lastname;
		$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
		$pbooknumber=$pbookinfo->poolbooking_number;
		$saveid=$this->session->userdata('id');
		$bookdate = $pbookinfo->entrydate;
		
		
		$loopnum = $this->input->post('loopnum',true);
		$qty = explode(" ",$this->input->post('itemqtyinp',true));
		$packname =explode(" ",$this->input->post('package_idinp',true));
		$perprice = explode(" ",$this->input->post('per_priceinp',true));
		$quantity = explode(" ",$this->input->post('itemqtyinp',true));
		$subt_price = explode(" ",$this->input->post('sub_totalinp',true));
		
		for ($i=0, $n=$loopnum; $i < $n; $i++) {
			$package_name = $packname[$i];
			$package_rate = $perprice[$i];
			$itemqty = $quantity[$i];
			$sub_total = $subt_price[$i];
			$data3 = array(
				'pbokingid'			=>	$bokins_id,
				'packageid'			=>	$package_name,
				'perprice'		    =>	$package_rate,
				'itemqty'			=>	$itemqty,
				'total_price'		=>	$sub_total,
				'entrydate'         =>  date('Y-m-d')
			);
		
			if(!empty($quantity))
			{
				$this->db->insert('tbl_pool_bookingitem',$data3);
			}
		}
		return $bokins_id;
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

	public function book_create($data = array())
	{
		$this->db->insert('tbl_pool_booking', $data);
		$bokins_id =  $this->db->insert_id();
		
		$qty = $this->input->post('itemqtyinp',true);
            
		$packname = $this->input->post('package_idinp',true);
		
		$perprice = $this->input->post('per_priceinp',true);
		$quantity = $this->input->post('itemqtyinp',true);
		$subt_price = $this->input->post('sub_totalinp',true);
		
		for ($i=0, $n=count($qty); $i < $n; $i++) {
			$package_name = $packname[$i];
			$package_rate = $perprice[$i];
			$itemqty = $quantity[$i];
			$sub_total = $subt_price[$i];
			
			
			$data3 = array(
				'pbokingid'			=>	$bokins_id,
				'packageid'			=>	$package_name,
				'perprice'		    =>	$package_rate,
				'itemqty'			=>	$itemqty,
				'total_price'		=>	$sub_total,
				'entrydate'         =>  date('Y-m-d')
			);
			
			if(!empty($quantity))
			{
				$this->db->insert('tbl_pool_bookingitem',$data3);
			}
		}
		return true;
		
	}

	public function poolbook_data($id = null)
	{ 
		$this->db->select('tbl_pool_booking.*, customerinfo.*');
		$this->db->join('customerinfo', 'customerinfo.customerid=tbl_pool_booking.custid','left');
        $this->db->from('tbl_pool_booking');

		$this->db->where('tbl_pool_booking.pbookingid',$id); 
        $query = $this->db->get();
	    return $query->row();
	}

	public function poolbookitem_data($id = null)
	{ 

		$this->db->select('tbl_pool_bookingitem.*, tbl_pool_package.package_name');
		$this->db->join('tbl_pool_package', 'tbl_pool_package.packageid=tbl_pool_bookingitem.packageid','left');
        $this->db->from('tbl_pool_bookingitem');
		$this->db->where('pbokingid',$id); 
        $query = $this->db->get();
	    return $query->result();

	}

	public function book_update($data = array())
	{
		$this->db->where('pbokingid',$data["pbookingid"])->delete('tbl_pool_bookingitem');

		$qty = $this->input->post('itemqtyinp',true);
            
		$packname = $this->input->post('package_idinp',true);
		
		$perprice = $this->input->post('per_priceinp',true);
		$quantity = $this->input->post('itemqtyinp',true);
		$subt_price = $this->input->post('sub_totalinp',true);
		
		for ($i=0, $n=count($qty); $i < $n; $i++) {
			$package_name = $packname[$i];
			$package_rate = $perprice[$i];
			$itemqty = $quantity[$i];
			$sub_total = $subt_price[$i];
			
			
			$data3 = array(
				'pbokingid'			=>	$data["pbookingid"],
				'packageid'			=>	$package_name,
				'perprice'		    =>	$package_rate,
				'itemqty'			=>	$itemqty,
				'total_price'		=>	$sub_total,
				'entrydate'         =>  date('Y-m-d')
			);
			
			if(!empty($quantity))
			{
				$this->db->insert('tbl_pool_bookingitem',$data3);
			}
		}
			$check_cust_cin =  $this->db->select("*")->from("booked_info")->where("cutomerid", $data["custid"])->order_by('bookedid','desc')->get()->row();
			
			$newdate = date("Y-m-d H:i:s");
			$saveid=$this->session->userdata('id');
			$invoice = $this->db->select("poolbooking_number")->from("tbl_pool_booking")->where("pbookingid", $data["pbookingid"])->get()->row();
			$acc_id = $this->db->select("ID")->from("acc_transaction")->where('VNo',$invoice->poolbooking_number)->order_by("ID","ASC")->get()->result();

			if (empty($check_cust_cin)) {
				//Customer debited for Pool Value update
				transaction_update($acc_id[0]->ID, $invoice->poolbooking_number, $newdate, $data["total_amount"], 0, $saveid, $newdate, 102030101);

				//Pool service credit for Pool Value update
				transaction_update($acc_id[1]->ID, $invoice->poolbooking_number, $newdate, 0, $data["total_amount"], $saveid, $newdate, 30302);

				//Customer Credit for paid amount update
				transaction_update($acc_id[2]->ID, $invoice->poolbooking_number, $newdate, 0, $data["total_amount"], $saveid, $newdate, 102030101);

				// Income for company in cash update
				transaction_update($acc_id[3]->ID, $invoice->poolbooking_number, $newdate, $data["total_amount"], 0, $saveid, $newdate, 1020101);
			}

			if (!empty($check_cust_cin) && $check_cust_cin->bookingstatus != 4) {
				//Customer debited for Pool Value update
				transaction_update($acc_id[0]->ID, $invoice->poolbooking_number, $newdate, $data["total_amount"], 0, $saveid, $newdate, 102030101);

				//Pool service credit for Pool Value update
				transaction_update($acc_id[1]->ID, $invoice->poolbooking_number, $newdate, 0, $data["total_amount"], $saveid, $newdate, 30302);

				//Customer Credit for paid amount update
				transaction_update($acc_id[2]->ID, $invoice->poolbooking_number, $newdate, 0, $data["total_amount"], $saveid, $newdate, 102030101);

				// Income for company in cash update
				transaction_update($acc_id[3]->ID, $invoice->poolbooking_number, $newdate, $data["total_amount"], 0, $saveid, $newdate, 1020101);
			}

			
		return $this->db->where('pbookingid',$data["pbookingid"])
		->update('tbl_pool_booking', $data);
		
	}

	public function delete_pool_delete($id = null)
	{
		$this->db->where('pbokingid',$id)->delete('tbl_pool_bookingitem');
		return $this->db->where('pbookingid',$id)
			->delete('tbl_pool_booking');
	}

	public function oldcustomer_dropdown()
	{
		$data = $this->db->select('DISTINCT(cust_phone),firstname,customerid')
		->from('customerinfo')
		->where_not_in('cust_phone','')
		->get()->result();

		$list[''] = 'Select Customer';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customerid] = $value->cust_phone.' '.$value->firstname;
			return $list;
		} else {
			return false; 
		}
	}
}

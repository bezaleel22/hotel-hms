<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class House_keeping extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'housekeeping_model'
		));	
    }

	public function assign_room_cleaning($id = null)
    {
		$this->permission->method('house_keeping','read')->redirect();
				
        $data['title']    = display('assign_room_cleaning'); 
		$data["allroom"] = $this->housekeeping_model->allrooms(); 
		$today = date("Y-m-d H:i");
		$data["allhousekeeper"] = $this->housekeeping_model->allhousekeeper($today); 
        $data['module'] = "house_keeping";
        $data['page']   = "assign_room_cleaning";   
        echo Modules::run('template/layout', $data); 
    }
	public function room_cleaning($id = null)
    {
		$this->permission->method('house_keeping','read')->redirect();
				
        $data['title']    = display('room_cleaning'); 
        #
        #pagination ends
        #   
        $data['module'] = "house_keeping";
        $data['page']   = "room_cleaning";   
        echo Modules::run('template/layout', $data); 
    }
    public function getroomwithstatus($id,$status=null){
        $data["allroomwithstatus"] = $this->housekeeping_model->allfloor($id);
        $data['crroomid'] = $id;
        $data['statusid'] = $status;
        $data['module'] = "house_keeping";
        $data['page']   = "checkroomstatus";   
        $this->load->view('house_keeping/checkroomstatus', $data); 
       }
    public function getroomfromstatus($id,$room=null){
        $data['statusid'] = $id;
        $data['roomname'] = $room;
        $data['module'] = "house_keeping";
        $data['page']   = "roomfromstatus";   
        $this->load->view('house_keeping/roomfromstatus', $data); 
       }
       public function assignroomcleaner(){
		$this->form_validation->set_rules('employee_id',display('house_keeper'),'required|xss_clean');
		$data['title']    = display('room_cleaning');
		if ($this->form_validation->run()) {
		$employee_id=$this->input->post('employee_id', TRUE);
		$roomid=$this->input->post('roomid', TRUE);
		define( 'API_ACCESS_KEY', 'AAAAOWVEG-g:APA91bF0uCkXYJEzR59WmhlpcNVACBBDGfba7s8XIcjqamSu2HC5q1Rvv3blOywr-FNyCBDlwipuqiroXo76iB1wCqdfHXOhL66x8m0zigPohscCGPxViIYFaNdks3M2mGSCx95xyGD0');
		if(!empty($roomid)){
		$exitsroom=$this->db->select("roomid")->from('tbl_roomnofloorassign')->where('roomid',$roomid)->get()->row();
		if(!empty($exitsroom)){
		$floor="floorid_".$roomid;
		$allfloor=$this->input->post($floor);
		$totalfloor=count($allfloor);
		for($i=0;$i<$totalfloor;$i++){
			    $floorid=$allfloor[$i];
				$roomno="roomno".$allfloor[$i].$roomid;
				$allroomno=$this->input->post($roomno);
				$totalroom=count($allroomno);
				for($j=0;$j<$totalroom;$j++){
					$roomnoid=$allroomno[$j];					
					$stroom=$this->db->select("status")->from('tbl_roomnofloorassign')->where('roomno',$roomnoid)->get()->row();
					if($stroom->status==1 || $stroom->status==5 || $stroom->status==6 || $stroom->status==7 || $stroom->status==8){
						$postData = array(
					   'status'     	     	 => 3
					  );
					  $this->db->where('roomid',$roomid)->where('roomno',$roomnoid)->update('tbl_roomnofloorassign',$postData);
					  }
					if($stroom->status==2){
						$postData = array(
					   'status'     	     	 => 4
					  );
					  $this->db->where('roomid',$roomid)->where('roomno',$roomnoid)->update('tbl_roomnofloorassign',$postData);
					  }
					  if($stroom->status!=3 && $stroom->status!=4 && $stroom->status!=9){
						$storeData = array(
					   'employee_id'     	     	=> $employee_id,
					   'roomno'     	     	    => $roomnoid,
					   'createDate'     	     	=> date("Y-m-d H:i:s"),
                       'status'                     => 0
					  );
					  $this->db->insert('tbl_housekeepingrecord',$storeData);
					  $insert_id = $this->db->insert_id();
					  $details = $this->db->select("*")->from("tbl_housekeepingrecord")->where("hkeeper_id",$insert_id)->get()->row();
					  if(!empty($details)){
							  if($details->status==0){
								//notification start
								 $hk_id=$this->db->select("emp_his_id,first_name")->from("employee_history")->where("employee_id",$details->employee_id)->get()->row();
								 $roomtype = $this->db->select("roomtype")->from("roomdetails")->join("tbl_roomnofloorassign","tbl_roomnofloorassign.roomid = roomdetails.roomid","left")->where("tbl_roomnofloorassign.roomno",$details->roomno)->get()->row();
								 $this->db->select('*');
								 $this->db->from('user');
								 $this->db->where('id',$hk_id->emp_his_id);
								 $query = $this->db->get();
								 $allemployee = $query->row();
								 $senderid[]=$allemployee->device_token;
							 $registrationIds = $senderid;
							 $msg = array
							 (
								 'body' 					=> "Room No: ".$details->roomno." Room Type: ".$roomtype->roomtype,
								 'title'						=> "New room assigned"
							 );
							 $fields2 = array
							 (
								 'registration_ids' 	=> $registrationIds,
								 'data'			=> $msg
							 );
							  
							 $headers2 = array
							 (
								 'Authorization: key=' . API_ACCESS_KEY,
								 'Content-Type: application/json'
							 );
							  
							 $ch2 = curl_init();
							 curl_setopt( $ch2,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
							 curl_setopt( $ch2,CURLOPT_POST, true );
							 curl_setopt( $ch2,CURLOPT_HTTPHEADER, $headers2 );
							 curl_setopt( $ch2,CURLOPT_RETURNTRANSFER, true );
							 curl_setopt( $ch2,CURLOPT_SSL_VERIFYPEER, false );
							 curl_setopt( $ch2,CURLOPT_POSTFIELDS, json_encode( $fields2 ) );
							 $result2 = curl_exec($ch2 );
							 curl_close( $ch2 );
							 /*End Notification*/
							  }		
							  $msg = json_decode($result2);
							 if($msg->success==1){
								$this->session->set_flashdata('message', "Notification: Sent Syccessfully...");
							 }else{
								$this->session->set_flashdata('exception', "Notification(".$hk_id->first_name."): ".$msg->results[$j]->error);
							 }
					 	  }
					   }
					}
				
			}
		$this->session->set_flashdata('message', display('save_successfully'));
		redirect('house_keeping/assign-room-cleaning');	
		}
	    }else{
			$this->form_validation->set_rules('roomno[]',display('room_no'),'required|xss_clean');
			if ($this->form_validation->run()) {
				$roomno=$this->input->post('roomno', TRUE);
				$totalroom=count($roomno);
				for($j=0;$j<$totalroom;$j++){
					$roomnoid=$roomno[$j];					
					$stroom=$this->db->select("status")->from('tbl_roomnofloorassign')->where('roomno',$roomnoid)->get()->row();
					if($stroom->status==1 || $stroom->status==5 || $stroom->status==6 || $stroom->status==7 || $stroom->status==8){
						$postData = array(
					   'status'     	     	 => 3
					  );
					  $this->db->where('roomno',$roomnoid)->update('tbl_roomnofloorassign',$postData);
					  }
					if($stroom->status==2){
						$postData = array(
					   'status'     	     	 => 4
					  );
					  $this->db->where('roomno',$roomnoid)->update('tbl_roomnofloorassign',$postData);
					  }
					  if($stroom->status!=3 && $stroom->status!=4 && $stroom->status!=9){
						$storeData = array(
					   'employee_id'     	     	=> $employee_id,
					   'roomno'     	     	    => $roomnoid,
					   'createDate'     	     	=> date("Y-m-d H:i:s"),
                       'status'                     => 0
					  );
					  $this->db->insert('tbl_housekeepingrecord',$storeData);
					  $insert_id = $this->db->insert_id();
					  $details = $this->db->select("*")->from("tbl_housekeepingrecord")->where("hkeeper_id",$insert_id)->get()->row();
					  if(!empty($details)){
							  if($details->status==0){
								//notification start
								 $hk_id=$this->db->select("emp_his_id,first_name")->from("employee_history")->where("employee_id",$details->employee_id)->get()->row();
								 $roomtype = $this->db->select("roomtype")->from("roomdetails")->join("tbl_roomnofloorassign","tbl_roomnofloorassign.roomid = roomdetails.roomid","left")->where("tbl_roomnofloorassign.roomno",$details->roomno)->get()->row();
								 $this->db->select('*');
								 $this->db->from('user');
								 $this->db->where('id',$hk_id->emp_his_id);
								 $query = $this->db->get();
								 $allemployee = $query->row();
								 $senderid[]=$allemployee->device_token;
							 $registrationIds = $senderid;
							 $msg = array
							 (
								 'body' 					=> "Room No: ".$details->roomno." Room Type: ".$roomtype->roomtype,
								 'title'						=> "New room assigned"
							 );
							 $fields2 = array
							 (
								 'registration_ids' 	=> $registrationIds,
								 'data'			=> $msg
							 );
							  
							 $headers2 = array
							 (
								 'Authorization: key=' . API_ACCESS_KEY,
								 'Content-Type: application/json'
							 );
							  
							 $ch2 = curl_init();
							 curl_setopt( $ch2,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
							 curl_setopt( $ch2,CURLOPT_POST, true );
							 curl_setopt( $ch2,CURLOPT_HTTPHEADER, $headers2 );
							 curl_setopt( $ch2,CURLOPT_RETURNTRANSFER, true );
							 curl_setopt( $ch2,CURLOPT_SSL_VERIFYPEER, false );
							 curl_setopt( $ch2,CURLOPT_POSTFIELDS, json_encode( $fields2 ) );
							 $result2 = curl_exec($ch2 );
							 curl_close( $ch2 );
							 /*End Notification*/
							  }		
							  $msg = json_decode($result2);
							 if($msg->success){
								$this->session->set_flashdata('message', "Notification: Sent Syccessfully...");
							 }else{
								$this->session->set_flashdata('exception', "Notification(".$hk_id->first_name."): ".$msg->results[$j]->error);
							 }
					 	  }
					 }
					}
					$this->session->set_flashdata('message', display('save_successfully'));
				redirect('house_keeping/assign-room-cleaning');
			}else{
				$data['module'] = "house_keeping";
				$data['page']   = "assign_room_cleaning";   
				echo Modules::run('template/layout', $data); 
			}
		}
		}else{
			$data['module'] = "house_keeping";
			$data['page']   = "assign_room_cleaning";   
			echo Modules::run('template/layout', $data); 
		}
    }
    public function roomcleaninglist(){
		$params = $columns = $totalRecords = $data = array();
		$params = $_REQUEST;
	    $columns = array( 
		0 => 'hkeeper_id', 
		1 => 'tbl_housekeepingrecord.employee_id', 
		2 => 'roomno',
		3 => 'createDate',
		4 => 'first_name',
		5 => 'status',
	);

	$where = $sqlTot = $sqlRec = "";
	// check search value exist
	if(!empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( tbl_housekeepingrecord.employee_id LIKE '".$params['search']['value']."%' ";    
		$where .=" OR roomno LIKE '".$params['search']['value']."%' ";
		$where .=" OR createDate LIKE '".$params['search']['value']."%' ";
		$where .=" OR first_name LIKE '".$params['search']['value']."%' ";
		$where .=" OR status NOT LIKE '1' )";
	}else{
		$where =" WHERE (status !=1 )";
	}
	// getting total number records without any search
	$sql = "SELECT tbl_housekeepingrecord.*,first_name FROM tbl_housekeepingrecord LEFT JOIN employee_history ON employee_history.employee_id=tbl_housekeepingrecord.employee_id";
	
	
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && ($where != '')) {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}
	$SQLtotal=$this->db->query($sqlTot);
	$totalRecords = $SQLtotal->num_rows();	
	if ($params['length'] == '-1'){	
		$params['length']= intval($totalRecords);
	}
 	$sqlRec .=  " ORDER BY ".$columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";
	$SQLoffer=$this->db->query($sqlRec);
	$queryRecords=$SQLoffer->result();
	$i=0;
	foreach($queryRecords as  $value){
		$i++;
		$row = array();
		$update='';
		$delete='';
		if($this->permission->method('house_keeper','update')->access()):
		$update='<input name="url" type="hidden" id="url_'.$value->hkeeper_id.'" value="'.base_url().'house_keeping/house_keeping/updateintfrm" /><a onclick="edithousekeeping('.$value->hkeeper_id.')" class="btn btn-info btn-sm margin_right_5px" data-toggle="tooltip" data-placement="top" data-original-title="Update" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>';
		endif;
		 if($this->permission->method('house_keeper','create')->access()):
		if($value->status==2){
		 $Payment='<a href="'.base_url().'house_keeping/house_keeping/under_process/'.$value->hkeeper_id.'/'.$value->roomno.'" class="btn btn-success btn-sm margin_right_5px disabled" data-toggle="tooltip" data-placement="top" data-original-title="Process" title="Process"><i class="ti-tag" ></i></a>';
		}else{
		 $Payment='<a href="'.base_url().'house_keeping/house_keeping/under_process/'.$value->hkeeper_id.'/'.$value->roomno.'" class="btn btn-success btn-sm margin_right_5px" data-toggle="tooltip" data-placement="top" data-original-title="Process" title="Process"><i class="ti-tag" ></i></a>';
		}
		 endif;
		 if($value->status==0){
			 $status="Pending";
			 }
		else if($value->status==2){
			$status="Under Process";
			}
		$row[] =$i;
		$row[] =$value->employee_id;
		$row[] =$value->first_name;
		$row[] =$value->roomno;
		$row[] =$value->createDate;
		$row[] =$status;
		$row[] =$update.$Payment;
        $data[] = $row;
		
		}
	
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);
	}

    public function under_process($id,$rno){
        $data=array(
            'status' => 2
		);
        $this->db->where('hkeeper_id',$id)->update('tbl_housekeepingrecord',$data);
		$exitsroom=$this->db->select("status")->from('tbl_roomnofloorassign')->where('roomno',$rno)->get()->row();
		if($exitsroom->status==3){
			$postData = array(
		   'status'     	     	 => 9
		  );
		  $this->db->where('roomno',$rno)->update('tbl_roomnofloorassign',$postData);
		  }
		$this->session->set_flashdata('message', display('save_successfully'));
		redirect('house_keeping/room-cleaning');
    }
	public function updatefrmqr($rmno){
		$uid = $this->session->userdata('id');
		$hkcheck = $this->db->select("employee_id,hkeeper_id")->from("tbl_housekeepingrecord")->where("roomno",$rmno)->where('status!=',1)->get()->row();
		$empcheck = $this->db->select("emp_his_id")->from("employee_history")->where("employee_id",$hkcheck->employee_id)->get()->row();
		$checkadmin = $this->db->select("is_admin")->from("user")->where('id',$uid)->get()->row();
		if(($checkadmin || $empcheck) && $hkcheck){
		$data['intinfo']   = $this->housekeeping_model->findById($hkcheck->hkeeper_id);
		$data['hkproducts']   = $this->housekeeping_model->product_list();
		$data['checklist']   = $this->housekeeping_model->checklist();
        $data['module'] = "house_keeping";  
        $data['page']   = "qrroom_cleaning";
		echo Modules::run('template/layout', $data);  
		}else{
			$this->session->set_flashdata('exception',  "You did not assign to cleam this room");
			redirect('dashboard/home');
		}
	}
	public function updateintfrm($id){
		$data['intinfo']   = $this->housekeeping_model->findById($id);
		$data['hkproducts']   = $this->housekeeping_model->product_list();
		$data['checklist']   = $this->housekeeping_model->checklist();
        $data['module'] = "house_keeping";  
        $data['page']   = "room_cleaninfedit";
		$this->load->view('house_keeping/room_cleaninfedit', $data);  
	}
    public function roomcleaningupdate($id = null)
    {
	  $data['title'] = display('house_keeping');
	  $this->form_validation->set_rules('date_start',display('date_start'),'required|xss_clean');
	  $this->form_validation->set_rules('date_end',display('date_end'),'required|xss_clean');
	  $this->form_validation->set_rules('room_no',display('room_no'),'required|xss_clean');

	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
		$this->permission->method('house_keeping','update')->redirect();
		$date_start=$this->input->post('date_start', TRUE);
		$date_end = $this->input->post('date_end', TRUE);
		$hkeeper_id = $this->input->post('hkeeper_id', TRUE);
		$room_no = $this->input->post('room_no', TRUE);
		$products_id=$this->input->post('products_id', TRUE);
		$checklist_id=$this->input->post('checklist_id', TRUE);

		$allc_id="";
		$allp_id="";
		$allp_qty="";
		if(!empty($checklist_id)){
			$totalchecklist = count($checklist_id);
			for($i=0;$i<$totalchecklist;$i++){
				$check_id = $checklist_id[$i];
				$allc_id .= substr($check_id,2).',';
			}
		}
		if(!empty($products_id)){
			$totalprodictlist = count($products_id);
			for($i=0;$i<$totalprodictlist;$i++){
				$product_id = $products_id[$i];
				$prod_qty = "products_qty".$product_id;
				$product_qty=$this->input->post($prod_qty, TRUE);
				$allp_id .= $product_id.',';
				$allp_qty .= $product_qty.',';
			}
		}
		$data['house_keeping']   = (Object) $updateData = array(
		   'date_start'              => $date_start,
		   'date_end' 	         	 => $date_end,
		   'all_checklist'			=>trim($allc_id,','),
		   'all_productlist'		=>trim($allp_id,','),
		   'allproductqty'			=>trim($allp_qty,','),
		   'status'					=>1,
		   'assignby'				=>$this->session->userdata('id')
		  );
		  if(empty($date_start) || empty($date_start)){
			  $this->session->set_flashdata('exception',  "Start date or End date can not empty");
			}
			else if($date_start>=$date_end){
				$this->session->set_flashdata('exception',  "Start date can not larger than end date");
			} else{
				$this->db->where('hkeeper_id',$hkeeper_id)->update('tbl_housekeepingrecord',$updateData);
				$checrstatus = $this->db->select('status')->from("tbl_roomnofloorassign")->where("roomno",$room_no)->get()->row();
				if($checrstatus->status==3 || $checrstatus->status==9){
					$rmdt = array(
					'status' => 1
					);
				$this->db->where('roomno',$room_no)->update('tbl_roomnofloorassign',$rmdt);
				}
				elseif($checrstatus->status==4){
					$rmdt = array(
						'status' => 2
						);
					$this->db->where('roomno',$room_no)->update('tbl_roomnofloorassign',$rmdt);
				}
				if($products_id){
					$totalproduct = count($products_id);
					for($i=0;$i<$totalproduct;$i++){
					  $prod_id = $products_id[$i];
					  $prod_qty = "products_qty".$prod_id;
					  $p_qty=$this->input->post($prod_qty, TRUE);
			
					  $oldstock = $this->db->select("stock,product_name,used,reuseable")->from("products")->where("id",$prod_id)->get()->row();
					  $olduse = $this->db->select("in_use,ready")->from("tbl_reuseableproduct")->where("product_id",$prod_id)->get()->row();
					  $stock = $oldstock->stock - $p_qty;
					  $used = $oldstock->used + $p_qty;
					  $ready = $olduse->ready - $p_qty;
					  $inuse = $olduse->in_use + $p_qty;
					  if($stock<0){
						$this->session->set_flashdata('exception',  $oldstock->product_name." is out of stock");
					  }else{
						if($oldstock->reuseable==0){
						   $stdata = array(
							 'stock'     	     => $stock,
							 'used'     	     	 => $used
							);
					   		$this->db->where('id', $prod_id)->update('products',$stdata);
					   	}else{
							$stdata = array(
							 'in_use'     	     => $inuse,
							 'ready'     	     	 => $ready
							);
							if($ready>=0){
								$this->db->where('product_id', $prod_id)->update('tbl_reuseableproduct',$stdata);
							}else{
								$this->session->set_flashdata('exception',  $oldstock->product_name." is not ready in reuse stock");
							}
					   }
					 }
					}
				}
				$this->session->set_flashdata('message', display('update_successfully'));
		}
		redirect("house_keeping/room-cleaning");  
	  }else{
		$data['module'] = "house_keeping";
        $data['page']   = "room_cleaning";   
        echo Modules::run('template/layout', $data); 
	  }  
 
    }
	public function reuse_stock(){
		$data["reuselist"] = $this->housekeeping_model->read_reuseiteam();
		$data['title'] = display('reuse_list');  
        $data['module'] = "house_keeping";
        $data['page']   = "reuselist";   
        echo Modules::run('template/layout', $data); 
	}
	public function laundry(){
		$this->permission->method('house_keeping','read')->redirect();		
        $data['title']    = display('laundry'); 
		$data["laundry"] = $this->housekeeping_model->laundry(); 
		$data["invoicelist"] = $this->housekeeping_model->invoicelist(); 
		$data["productdropdown"] = $this->housekeeping_model->product(); 
		$data["checklist"] = $this->housekeeping_model->laundrychecklist();
		$today = date("Y-m-d H:i");
		$data["empdropdown"] = $this->housekeeping_model->allhousekeeper($today);  
        $data['module'] = "house_keeping";
        $data['page']   = "laundry_list";   
        echo Modules::run('template/layout', $data); 
	}
	public function productlist(){
		$productid = $this->input->post("product_id", TRUE);
		$product = "";
		$invoice_no = $this->input->post("invoice_no", TRUE);
		if($invoice_no){
				$recieveproduct = $this->db->select("product_id,quantity,checklist,comment")->from("tbl_laundry")->where("invoice_no", $invoice_no)->where("type","recieve")->get()->row();
				$getproduct = $this->db->select("product_id,quantity,checklist,comment")->from("tbl_laundry")->where("invoice_no", $invoice_no)->where("type","add")->get()->row();
				if(empty($recieveproduct)){
					if($getproduct){
						$product_id = explode(",", $getproduct->product_id);
						for($pi=0; $pi<count($product_id); $pi++){
							$allproduct = $this->db->select("product_name")->from("products")->where("id", $product_id[$pi])->get()->row();
							$product .= $allproduct->product_name.",";
						}
						$products['name'] = trim($product,",");
						$products['id'] = trim($getproduct->product_id);
						$products['quantity'] = trim($getproduct->quantity);
						$products['checklist'] = trim($getproduct->checklist);
						$products['comment'] = trim($getproduct->comment);
						echo $this->load->view('house_keeping/laundry_recieve', $products); 
					}else{
						echo "<h4 class='text-center mt-4'>Incorrect Invoice No</h4>";
					}
				}else{
					echo "<h4 class='text-center mt-4'>Invoice already recieved</h4>";
				}
		}
		else if($productid){
			$allproduct="";
			for($i=0; $i<count($productid); $i++){
				$singleproduct="";
				$getproduct = $this->db->select("product_name")->from("products")->where("id", $productid[$i])->get()->row();
				$pname = $this->db->select("checklist")->from("tbl_hkitem")->where("product_id", $productid[$i])->get()->result();
				if(!empty($pname)){
					foreach($pname as $plist){
						$singleproduct .= $plist->checklist.",";
					}
				}else{
					$singleproduct .= "-,";
				}
				$allproduct .= $singleproduct.",";
				$list['getchecklist'] = trim($allproduct,",,");
				$product .= $getproduct->product_name.",";
				$list['product'] =trim($product,",");
			}
			echo json_encode($list);
		}
	}
	public function save_laundry(){
	  $finyear = $this->input->post('finyear',true);
	  if($finyear<=0){
		 $this->session->set_flashdata('exception',  "Please Create Financial Year First");
		 redirect($_SERVER['HTTP_REFERER']);
	  }
	  $data['title'] = display('laundry');
	  $this->form_validation->set_rules('emp_id',display('employee_name'),'required|xss_clean');
	  $this->form_validation->set_rules('type',display('type'),'required|xss_clean');
	  $this->form_validation->set_rules('quantity[]',display('quantity'),'required|xss_clean');
	  if($this->input->post('type', TRUE)=="add"){
		$this->form_validation->set_rules('product_id[]',display('ingredient_name'),'required|xss_clean');
		$this->form_validation->set_rules('stock',display('stock'),'required|xss_clean');
	}
	  else if($this->input->post('type', TRUE)=="recieve"){
		  $this->form_validation->set_rules('inv_productid[]',display('ingredient_name'),'required|xss_clean');
		  $this->form_validation->set_rules('invoice_no',display('invoice_no'),'required|xss_clean');
		}
	
	  $emp_id=$this->input->post('emp_id', TRUE);
	  $type=$this->input->post('type', TRUE);
	  $quantity=$this->input->post('quantity', TRUE);
	  $comments=$this->input->post('comments', TRUE);
	  if($type!="recieve"){
		$product_id=$this->input->post('product_id', TRUE);
		$stock=$this->input->post('stock', TRUE);
		$invoice_no = date("YmdHis");
		if($stock=="in_use"){
			for($pl=0; $pl<count($product_id); $pl++){
				$in_use = $this->db->select("p.product_name,r.in_use")->from("tbl_reuseableproduct r")->join("products p", "p.id=r.product_id")->where('product_id', $product_id[$pl])->get()->row();
				if($quantity[$pl]>$in_use->in_use){
					$this->session->set_flashdata('exception', "Only $in_use->in_use $in_use->product_name available in used stock");
					redirect('house_keeping/laundry');
				}
			}
		}else{
			for($pl=0; $pl<count($product_id); $pl++){
				$ready = $this->db->select("p.product_name,r.ready")->from("tbl_reuseableproduct r")->join("products p", "p.id=r.product_id")->where('product_id', $product_id[$pl])->get()->row();
				if($quantity[$pl]>$ready->ready){
					$this->session->set_flashdata('exception', "Only $ready->ready $ready->product_name available in ready stock");
					redirect('house_keeping/laundry');
				}
			}
		}
	  }else{
		$invoice_no=$this->input->post('invoice_no', TRUE);
		$product_id=$this->input->post('inv_productid', TRUE);
		if($product_id){
			$oldlaundry = $this->db->select("product_id,quantity")->from("tbl_laundry")->where('invoice_no', $invoice_no)->get()->row();
			$p_id = explode(",", $oldlaundry->product_id);
			$p_qty = explode(",", $oldlaundry->quantity);
			for($p=0; $p<count($product_id); $p++){
			$oldproduct = $this->db->select("product_name")->from("products")->where('id', $p_id[$p])->get()->row();
			if($quantity[$p]>$p_qty[$p]){
				$this->session->set_flashdata('exception', "Can not recieve $oldproduct->product_name more than ".$p_qty[$p]."");
				redirect('house_keeping/laundry');
			}
		  }
		}
	  }
	  $allproduct_id="";
	  $allquantity="";
	  $allchecklist="";
	  $allcomments="";
	  if($product_id){
		for($pid=0; $pid<count($product_id); $pid++){
			$allproduct_id .= $product_id[$pid].",";
			$allquantity .= $quantity[$pid].",";
			$checklist=$this->input->post('checklist_'.$product_id[$pid], TRUE);
			$singlechecklist="";
			for($cl=0; $cl<count($checklist); $cl++){
				$singlechecklist .= $checklist[$cl].",";
			}
			$allchecklist .= trim($singlechecklist,",").",,";
			$allcomments .= $comments[$pid].",";
		}
		if($type=="add"){
			$allsinglecost="";
			$totalcost=0;
			$list=explode(",,",trim($allchecklist,",,"));
			for($i=0; $i<count($list); $i++){
				$clist = explode(",", $list[$i]);
				$singlecost="";
				for($j=0; $j<count($clist); $j++){
					$this->db->select('hi.price');
					$this->db->from("tbl_hkitem hi");
					$this->db->where('hi.product_id', trim($product_id[$i]));
					$this->db->where('hi.checklist', trim($clist[$j]));
					$query = $this->db->get()->row();
					$singlecost .= (!empty($query->price)?$query->price:0).",";
					$totalcost += (!empty($query->price)?$query->price*$quantity[$i]:0);
				}
				$allsinglecost.=$singlecost.",";
			}
		}else{
			$cost = $this->db->select("item_cost,total_cost,status")->from("tbl_laundry")->where("invoice_no", $invoice_no)->get()->row();
			$allsinglecost = $cost->item_cost;
			$status = $cost->status;
			$allcost = explode(",,", $cost->item_cost);
			$totalcost=0;
			for($i=0;$i<count($allcost); $i++){
				$singlecost = explode(",", $allcost[$i]);
				for($j=0; $j<count($singlecost); $j++){
					$totalcost+=$quantity[$i]*$singlecost[$j];
				}
			}

		}
	  }
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
		 $data['house_keeping']   = (Object) $postData = array(
		   'operate_by' 	         => $emp_id,
		   'invoice_no' 	         => $invoice_no,
		   'product_id' 	         => trim($allproduct_id,","),
		   'type' 	         	 	 => $type,
		   'checklist' 	         	 => trim($allchecklist,",,"),
		   'quantity' 	         	 => trim($allquantity,","),
		   'item_cost' 	         	 => trim($allsinglecost,",,"),
		   'total_cost' 	         => $totalcost,
		   'rec_date' 	         	 => date("Y-m-d H:i:s"),
		   'document' 	         	 => "",
		   'comment'				=> trim($allcomments,","),
		  );
		$this->permission->method('house_keeping','create')->redirect();
		if ($this->db->insert('tbl_laundry',$postData)) { 
			for($id=0; $id<count($quantity); $id++){
				$oldreuse = $this->db->select("in_laundry,ready,in_use")->from("tbl_reuseableproduct")->where('product_id', $product_id[$id])->get()->row();
				if($type!="recieve"){
					if($stock=="in_use"){
						$inuse = $oldreuse->in_use-$quantity[$id];
						$ready = $oldreuse->ready;
					}else{
						$ready = $oldreuse->ready-$quantity[$id];
						$inuse = $oldreuse->in_use;
					}
					$laundry = $oldreuse->in_laundry+$quantity[$id];
				}else{
					$laundry = $oldreuse->in_laundry-$quantity[$id];
					$ready = $oldreuse->ready+$quantity[$id];
					$inuse = $oldreuse->in_use;
				}
				if($laundry>=0 && $ready>=0){
					$update = $this->db->where("product_id", $product_id[$id])->update("tbl_reuseableproduct",array('in_laundry'=>$laundry,'in_use'=>$inuse,'ready'=>$ready));
				}
			}
			if($type!="recieve"){
				$totalamount = $this->db->select("total_amount,due_amount")->from("tbl_laundry_payment")->get()->row();
				$total_amount = $totalamount->total_amount + $totalcost;
				$due_amount = $totalamount->due_amount + $totalcost;
				$laundry_record = array(
					'landry_id'     	 => 1,
					'total_amount' 	     =>$total_amount,
					'due_amount' 	     =>$due_amount,
				);
				$this->housekeeping_model->laundry_payment($laundry_record);
			}else{
				$this->db->where("invoice_no", $invoice_no)->update("tbl_laundry", array("status"=>$status));
			}	
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('house_keeping/laundry');
		} else {
		 	$this->session->set_flashdata('exception',  display('please_try_again'));
		}
	  }else {    
		$this->permission->method('house_keeping','read')->redirect();		
		$data['title']    = display('laundry'); 
		$data["laundry"] = $this->housekeeping_model->laundry(); 
		$data["invoicelist"] = $this->housekeeping_model->invoicelist(); 
		$data["productdropdown"] = $this->housekeeping_model->product(); 
		$data["empdropdown"] = $this->housekeeping_model->employeelist();
		$data["checklist"] = $this->housekeeping_model->laundrychecklist(); 
		$data['module'] = "house_keeping";
		$data['page']   = "laundry_list";   
		echo Modules::run('template/layout', $data); 
	   }  
	}
	public function item_cost(){
		$this->permission->method('house_keeping','read')->redirect();		
		$data['title']    = display('Item_cost'); 
		$data["item"] = $this->housekeeping_model->itemlist(); 
		$data["productdropdown"] = $this->housekeeping_model->hkproduct(); 
		$data["checklistdropdown"] = $this->housekeeping_model->hkchecklist(); 
		$data['module'] = "house_keeping";
		$data['page']   = "item_list";   
		echo Modules::run('template/layout', $data); 
	}
	public function create($id = null)
    {
	  $data['title'] = display('item_list');
	  $this->form_validation->set_rules('product_id',"Item Name",'required|xss_clean');
	  $this->form_validation->set_rules('task_name',display('task_name'),'required|xss_clean');
	  $list = $this->db->select("item_id,product_id,checklist,p.product_name")->from("tbl_hkitem")->join("products p","p.id=tbl_hkitem.product_id")->get()->result();
	  foreach($list as $check){
		if($this->input->post('product_id',TRUE)==$check->product_id & $this->input->post('task_name',TRUE)==$check->checklist){
			if(empty($this->input->post('item_id', TRUE))){
				$this->session->set_flashdata('exception',  "Price Already exist for $check->product_name and $check->checklist");
				redirect('house_keeping/item_cost');
			}else{
				if($this->input->post('item_id', TRUE)!=$check->item_id){
					$this->session->set_flashdata('exception',  "Price Already exist for $check->product_name and $check->checklist");
					redirect('house_keeping/item_cost');
				}
			}
		}
	  }
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('item_id', TRUE))) {
		 $data['house_keeping']   = (Object) $postData = array(
		   'product_id' 	         => $this->input->post('product_id',TRUE),
		   'checklist' 	         	 => $this->input->post('task_name',TRUE),
		   'price' 	         		 => $this->input->post('price',TRUE),
		  );
		$this->permission->method('house_keeping','create')->redirect();
		if ($this->db->insert('tbl_hkitem',$postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('house_keeping/item_cost');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("house_keeping/item_cost"); 
	
	   } else {
		$this->permission->method('house_keeping','update')->redirect();
		$data['house_keeping']   = (Object) $postData = array(
				'item_id'     	         => $this->input->post('item_id', TRUE),
				'product_id' 	        	 => $this->input->post('product_id',TRUE),
				'checklist' 	         	 => $this->input->post('task_name',TRUE),
				'price' 	         		 => $this->input->post('price',TRUE),
		  );
	 
		if ($this->db->where('item_id',$postData['item_id'])->update('tbl_hkitem', $postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("house_keeping/item_cost");  
	   }
	  } else { 
		$data['title']    = display('Item_cost'); 
		$data["item"] = $this->housekeeping_model->itemlist(); 
		$data["productdropdown"] = $this->housekeeping_model->hkproduct(); 
		$data["checklistdropdown"] = $this->housekeeping_model->hkchecklist(); 
		$data['module'] = "house_keeping";
		$data['page']   = "item_list";   
		echo Modules::run('template/layout', $data); 
	   }   
 
    }
	public function updateitemfrm($id){
		$this->permission->method('house_keeping','update')->redirect();
		$data['title'] = display('item_edit');
		$data['intinfo']   = $this->housekeeping_model->findItemId($id);
		$data["productdropdown"] = $this->housekeeping_model->product();
		$data["checklistdropdown"] = $this->housekeeping_model->hkchecklist();  
        $data['module'] = "house_keeping";  
        $data['page']   = "itemedit";
		$this->load->view('house_keeping/itemedit', $data);   
	   }
	public function delete($id = null)
	{
		$this->permission->module('house_keeping','delete')->redirect();
		if ($this->housekeeping_model->itemDelete($id)) {
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('house_keeping/item_cost');
	}
	public function laundry_payment(){
		$data['title']    = display('payment'); 
		$data["item"] = $this->housekeeping_model->laundry_list(); 
		$data['module'] = "house_keeping";
		$data['page']   = "payment_record";   
		echo Modules::run('template/layout', $data); 
	}
	public function updatepayfrm($id){
		$data["intinfo"] = $this->housekeeping_model->laundry_pay($id);
        $data['module'] = "house_keeping";  
        $data['page']   = "laundrypay";
		$data["invoicelist"] = $this->housekeeping_model->invoicelist(); 
		$this->load->view('house_keeping/laundrypay', $data);  
	}
	public function check_invoice(){
		$invoice = $this->input->post("invoice", TRUE);
		$details = $this->db->select("total_cost,status")->from("tbl_laundry")->where("invoice_no", $invoice)->get()->row();
		if(empty($details)){
			echo json_encode("");
		}else{
			$data = array(
				'status'=> $details->status,
				'amount'=> $details->total_cost,
			);
			echo json_encode($data);
		}
	}
	public function updatepayment(){
		$this->form_validation->set_rules('landry_id',"Laundry",'required|xss_clean');
		$this->form_validation->set_rules('amount',display('amount'),'required|xss_clean');
		if ($this->form_validation->run()) { 
		  $this->permission->method('house_keeping','update')->redirect();
		  $totalamount = $this->db->select("paid_amount,due_amount")->from("tbl_laundry_payment")->where("landry_id",$this->input->post('landry_id', TRUE))->get()->row();
		  $paid_amount = $totalamount->paid_amount + $this->input->post('amount',TRUE);
		  $due_amount = $totalamount->due_amount - $this->input->post('amount',TRUE);
		  if($due_amount<0){
			  $this->session->set_flashdata('exception', "Please pay less or equal to due amount");
			  redirect('house_keeping/payment_record');
		  }
		  $acc_cash = $this->db->select("current_balance")->from("tbl_openingbalance")->where("headcode","1020101")->get()->row();
		  if(empty($acc_cash)){
			  $this->session->set_flashdata('exception', "You does not have any balance on account cash.");
			  redirect('house_keeping/payment_record');
		  }else{
			  $invoice = $this->input->post('invoice', TRUE);
			  $amount = $this->input->post('amount', TRUE);
			  if(($acc_cash->current_balance-$amount)<0){
				  $this->session->set_flashdata('exception', "You does not have ".$amount." amount on account cash.");
				  redirect('house_keeping/payment_record');
			  }
		  }
		  $data['house_keeping']   = (Object) $postData = array(
			  'landry_id'     	 => $this->input->post('landry_id', TRUE),
			  'paid_amount' 	     =>$paid_amount,
			  'due_amount' 	     =>$due_amount,
			);
			if ($this->housekeeping_model->laundry_payment($postData)) { 
				  $newdate = date("Y-m-d");
				  $saveid = $this->session->userdata('id');
				  //Cash Credited for laundry cost
				  $narration = 'Cash Credited for laundry item cost Invoice# '.$invoice;
				  transaction($invoice, 'Laundry', $newdate, 1020101, $narration, 0, $amount, 0, 1, $saveid, $newdate, 1);
				  //Laundry debited for paid amount
				  $narration = 'Laundry debited for item cost Invoice# '.$invoice;
				  transaction($invoice, 'Laundry', $newdate, 4020409, $narration, $amount, 0, 0, 1, $saveid, $newdate, 1);
				  $this->db->where("invoice_no", $invoice)->update("tbl_laundry",array("status"=>1));
				  $this->session->set_flashdata('message', "Payment Successful");
				  redirect('house_keeping/payment_record');
			 } else {
			  $this->session->set_flashdata('exception',  display('please_try_again'));
			 }
		}else{
		  $data["item"] = $this->housekeeping_model->laundry_list(); 
		  $data['module'] = "house_keeping";
		  $data['page']   = "payment_record";   
		  echo Modules::run('template/layout', $data); 
		}
	  }
}
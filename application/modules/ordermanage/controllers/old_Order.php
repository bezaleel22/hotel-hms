	<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class old_Order extends MX_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->db->query('SET SESSION sql_mode = ""');
			$this->load->model(array(
				'order_model',
				'logs_model'
			));
		}

		public function pos_order($value = null)
		{

			$this->form_validation->set_rules('ctypeid', 'Customer Type', 'required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$saveid = $this->session->userdata('id');
			$paymentsatus = $this->input->post('card_type', true);
			$customerid = $this->input->post('customer_name', true);
			$isonline = $this->input->post('isonline', true);
			if ($this->form_validation->run()) {
				if ($cart = $this->cart->contents()) {
					$this->permission->method('ordermanage', 'create')->redirect();
					$logData = array(
						'action_page' => "Add New Order",
						'action_done' => "Insert Data",
						'remarks' => "Item New Order Created",
						'user_name' => $this->session->userdata('fullname'),
						'entry_date' => date('Y-m-d H:i:s'),
					);
					/* add New Order*/
					$purchase_date = str_replace('/', '-', $this->input->post('order_date'));
					$newdate = date('Y-m-d', strtotime($purchase_date));
					$lastid = $this->db->select("*")->from('customer_order')->order_by('order_id', 'desc')->get()->row();
					$sl = $lastid->order_id;
					if (empty($sl)) {
						$sl = 1;
					} else {
						$sl = $sl + 1;
					}

					$si_length = strlen((int)$sl);

					$str = '0000';
					$str2 = '0000';
					$cutstr = substr($str, $si_length);
					$sino = $cutstr . $sl;
					$todaydate = date('Y-m-d');
					$todaystoken = $this->db->select("*")->from('customer_order')->where('order_date', $todaydate)->order_by('order_id', 'desc')->get()->row();
					if (empty($todaystoken)) {
						$mytoken = 1;
					} else {
						$mytoken = $todaystoken->tokenno + 1;
					}
					$token_length = strlen((int)$mytoken);
					$tokenstr = '00';
					$newtoken = substr($tokenstr, $token_length);
					$tokenno = $newtoken . $mytoken;
					$cookedtime = $this->input->post('cookedtime');
					$customerid2 = $this->input->post('customer_name', true);
					if (empty($cookedtime)) {
						$cookedtime = "00:15:00";
					}
					$customerinfo = $this->order_model->read('*', 'customerinfo', array('customerid' => $this->input->post('customer_name', true)));
					$mtype = $this->order_model->read('*', 'membership', array('id' => $customerinfo->membership_type));
					$ordergrandt = $this->input->post('grandtotal', true);
					$scan = scandir('application/modules/');
					$getdiscount = 0;
					foreach ($scan as $file) {
						if ($file == "loyalty") {
							if (file_exists(APPPATH . 'modules/' . $file . '/assets/data/env')) {
								$getdiscount = $mtype->discount * $this->input->post('subtotal') / 100;
							}
						}
					}
					$data2 = array(
						'customer_id' => $this->input->post('customer_name', true),
						'saleinvoice' => $sino,
						'cutomertype' => $this->input->post('ctypeid'),
						'waiter_id' => $this->input->post('waiter', true),
						'isthirdparty' => $this->input->post('delivercom', true),
						'thirdpartyinvoiceid' => $this->input->post('thirdpartyinvoiceid'),
						'order_date' => $newdate,
						'order_time' => date('H:i:s'),
						'totalamount' => $ordergrandt - $getdiscount,
						'table_no' => $this->input->post('tableid', true),
						'customer_note' => $this->input->post('customernote', true),
						'tokenno' => $tokenno,
						'cookedtime' => $cookedtime,
						'order_status' => 1
					);

					$this->db->insert('customer_order', $data2);
					$orderid = $this->db->insert_id();
					$taxinfos = $this->taxchecking();
					if (!empty($taxinfos)) {
						$multitaxvalue = $this->input->post('multiplletaxvalue', true);
						$multitaxvaluedata = unserialize($multitaxvalue);
						$inserttaxarray = array(
							'customer_id' => $this->input->post('customer_name', true),
							'relation_id' => $orderid,
							'date' => $newdate
						);
						$inserttaxdata = array_merge($inserttaxarray, $multitaxvaluedata);
						$this->db->insert('tax_collection', $inserttaxdata);
					}
					/*for 02/11*/
					if ($this->input->post('ctypeid') == 1 || $this->input->post('ctypeid') == 6) {
						if ($this->input->post('table_member_multi') == 0) {
							$addtable_member = array(
								'table_id' => $this->input->post('tableid'),
								'customer_id' => $this->input->post('customer_name', true),
								'order_id' => $orderid,
								'time_enter' => date('H:i:s'),
								'created_at' => $newdate,
								'total_people' => $this->input->post('tablemember', true),
							);
							$this->db->insert('table_details', $addtable_member);
						} else {

							$multipay_inserts = explode(',', $this->input->post('table_member_multi'));
							$table_member_multi_person = explode(',', $this->input->post('table_member_multi_person', true));
							$z = 0;
							foreach ($multipay_inserts as $multipay_insert) {
								$addtable_member = array(
									'table_id' => $multipay_insert,
									'customer_id' => $this->input->post('customer_name', true),
									'order_id' => $orderid,
									'time_enter' => date('H:i:s'),
									'created_at' => $newdate,
									'total_people' => $table_member_multi_person[$z],
								);
								$this->db->insert('table_details', $addtable_member);
								$z++;
							}
						}
					}
					/*enc 02/11*/
					if ($this->input->post('delivercom', true) > 0) {
						/*Push Notification*/
						$this->db->select('*');
						$this->db->from('user');
						$this->db->where('id', $this->input->post('waiter', true));
						$query = $this->db->get();
						$allemployee = $query->row();
						$senderid = array();
						$senderid[] = $allemployee->waiter_kitchenToken;
						define('API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
						$registrationIds = $senderid;
						$msg = array(
							'message' => "Orderid:" . $orderid . ", Amount:" . $this->input->post('grandtotal', true),
							'title' => "New Order Placed",
							'subtitle' => "admin",
							'tickerText' => "10",
							'vibrate' => 1,
							'sound' => 1,
							'largeIcon' => "TSET",
							'smallIcon' => "TSET"
						);
						$fields2 = array(
							'registration_ids' => $registrationIds,
							'data' => $msg
						);

						$headers2 = array(
							'Authorization: key=' . API_ACCESS_KEY,
							'Content-Type: application/json'
						);

						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch2, CURLOPT_POST, true);
						curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));
						$result2 = curl_exec($ch2);
						curl_close($ch2);
						/*End Notification*/
						/*Push Notification*/
						$condition = "user.waiter_kitchenToken!='' AND employee_history.pos_id=1";
						$this->db->select('user.*,employee_history.emp_his_id,employee_history.employee_id,employee_history.pos_id ');
						$this->db->from('user');
						$this->db->join('employee_history', 'employee_history.emp_his_id = user.id', 'left');
						$this->db->where($condition);
						$query = $this->db->get();
						$allkitchen = $query->result();
						$senderid5 = array();
						foreach ($allkitchen as $mytoken) {
							$senderid5[] = $mytoken->waiter_kitchenToken;
						}

						define('API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
						$registrationIds5 = $senderid5;
						$msg5 = array(
							'message' => "Orderid:" . $orderid . ", Amount:" . $this->input->post('grandtotal', true),
							'title' => "New Order Placed",
							'subtitle' => "TSET",
							'tickerText' => "onno",
							'vibrate' => 1,
							'sound' => 1,
							'largeIcon' => "TSET",
							'smallIcon' => "TSET"
						);
						$fields5 = array(
							'registration_ids' => $registrationIds5,
							'data' => $msg5
						);

						$headers5 = array(
							'Authorization: key=' . API_ACCESS_KEY,
							'Content-Type: application/json'
						);

						$ch5 = curl_init();
						curl_setopt($ch5, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch5, CURLOPT_POST, true);
						curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers5);
						curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch5, CURLOPT_POSTFIELDS, json_encode($fields5));
						$result5 = curl_exec($ch5);
						curl_close($ch5);
					} else {
						/*Push Notification*/
						$this->db->select('*');
						$this->db->from('user');
						$this->db->where('id', $this->input->post('waiter', true));
						$query = $this->db->get();
						$allemployee = $query->row();
						$senderid = array();
						$senderid[] = $allemployee->waiter_kitchenToken;
						define('API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
						$registrationIds = $senderid;
						$msg = array(
							'message' => "Orderid:" . $orderid . ", Amount:" . ($ordergrandt - $getdiscount),
							'title' => "New Order Placed",
							'subtitle' => "admin",
							'tickerText' => "10",
							'vibrate' => 1,
							'sound' => 1,
							'largeIcon' => "TSET",
							'smallIcon' => "TSET"
						);
						$fields2 = array(
							'registration_ids' => $registrationIds,
							'data' => $msg
						);

						$headers2 = array(
							'Authorization: key=' . API_ACCESS_KEY,
							'Content-Type: application/json'
						);

						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch2, CURLOPT_POST, true);
						curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));
						$result2 = curl_exec($ch2);
						curl_close($ch2);
						/*End Notification*/
						/*Push Notification*/
						$condition = "user.waiter_kitchenToken!='' AND employee_history.pos_id=1";
						$this->db->select('user.*,employee_history.emp_his_id,employee_history.employee_id,employee_history.pos_id ');
						$this->db->from('user');
						$this->db->join('employee_history', 'employee_history.emp_his_id = user.id', 'left');
						$this->db->where($condition);
						$query = $this->db->get();
						$allkitchen = $query->result();
						$senderid5 = array();
						foreach ($allkitchen as $mytoken) {
							$senderid5[] = $mytoken->waiter_kitchenToken;
						}
						define('API_ACCESS_KEY2', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
						$registrationIds5 = $senderid5;
						$msg5 = array(
							'message' => "Orderid:" . $orderid . ", Amount:" . ($ordergrandt - $getdiscount),
							'title' => "New Order Placed",
							'subtitle' => "TSET",
							'tickerText' => "onno",
							'vibrate' => 1,
							'sound' => 1,
							'largeIcon' => "TSET",
							'smallIcon' => "TSET"
						);
						$fields5 = array(
							'registration_ids' => $registrationIds5,
							'data' => $msg5
						);

						$headers5 = array(
							'Authorization: key=' . API_ACCESS_KEY2,
							'Content-Type: application/json'
						);

						$ch5 = curl_init();
						curl_setopt($ch5, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch5, CURLOPT_POST, true);
						curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers5);
						curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch5, CURLOPT_POSTFIELDS, json_encode($fields5));
						$result5 = curl_exec($ch5);
						curl_close($ch5);
					}
					if ($this->order_model->orderitem($orderid)) {
						$this->logs_model->log_recorded($logData);

						$customer = $this->order_model->customerinfo($customerid);
						$scan = scandir('application/modules/');
						$getcus = "";
						foreach ($scan as $file) {
							if ($file == "loyalty") {
								if (file_exists(APPPATH . 'modules/' . $file . '/assets/data/env')) {
									$getcus = $customerid2;
								}
							}
						}
						if (!empty($getcus)) {
							$isexitscusp = $this->db->select("*")->from('tbl_customerpoint')->where('customerid', $customerid2)->get()->row();
							if (empty($isexitscusp)) {
								$pointstable2 = array(
									'customerid' => $customerid2,
									'amount' => "",
									'points' => 10
								);
								$this->order_model->insert_data('tbl_customerpoint', $pointstable2);
							}
						}

						$this->cart->destroy();
						if ($paymentsatus == 5) {
							redirect('ordermanage/order/paymentgateway/' . $orderid . '/' . $paymentsatus);
						} else if ($paymentsatus == 3) {
							redirect('ordermanage/order/paymentgateway/' . $orderid . '/' . $paymentsatus);
						} else if ($paymentsatus == 2) {
							redirect('ordermanage/order/paymentgateway/' . $orderid . '/' . $paymentsatus);
						} else {
							if ($isonline == 1) {
								$this->session->set_flashdata('message', display('order_successfully'));
								redirect('ordermanage/order/pos_invoice');
							} else {
								if ($value == 1) {
									echo $orderid;
									exit;
								} else {
									$view = $this->postokengenerate($orderid, 0);
									echo $view; //work
									exit;
								}
							}
						}
					} else {
						if ($isonline == 1) {
							$this->session->set_flashdata('exception', display('please_try_again'));
							redirect("ordermanage/order/pos_invoice");
						} else {
							echo "error";
						}
					}
				} else {
					if ($isonline == 1) {
						$this->session->set_flashdata('exception', 'Please add Some food!!');
						redirect("ordermanage/order/pos_invoice");
					} else {
						echo "error";
					}
				}
			} else {
				if ($isonline == 1) {
					$data['categorylist'] = $this->order_model->category_dropdown();
					$data['curtomertype'] = $this->order_model->ctype_dropdown();
					$data['waiterlist'] = $this->order_model->waiter_dropdown();
					$data['tablelist'] = $this->order_model->table_dropdown();
					$data['customerlist'] = $this->order_model->customer_dropdown2();
					$settinginfo = $this->order_model->settinginfo();
					$data['settinginfo'] = $settinginfo;
					$data['currency'] = $this->order_model->currencysetting($settinginfo->currency);

					$data['module'] = "ordermanage";
					$data['page'] = "posorder";
					echo Modules::run('template/layout', $data);
				} else {
					echo "error";
				}
			}
		}

		public function itemisready()
		{
			if ($this->permission->method('ordermanage', 'read')->access() == FALSE) {
				redirect('dashboard/auth/logout');
			}
			$orderid = $this->input->post('orderid');
			$menuid = $this->input->post('menuid');
			$varient = $this->input->post('varient', true);
			$status = $this->input->post('status', true);
			$updatetData = array('food_status'     => $status);
			$this->db->where('order_id', $orderid);
			$this->db->where('menu_id', $menuid);
			$this->db->where('varientid', $varient);
			$this->db->update('order_menu', $updatetData);

			$updatetData2 = array('order_status'  => 2);
			$this->db->where('order_id', $orderid);
			$this->db->update('customer_order', $updatetData2);
			$orderinformation = $this->order_model->read('*', 'customer_order', array('order_id' => $orderid));
			$allemployee = $this->db->select('*')->from('user')->where('id', $orderinformation->waiter_id)->get()->row();
			$item = $this->order_model->read('*', 'item_foods', array('ProductsID' => $menuid));
			$isexit = $this->db->select('*')->from('tbl_orderprepare')->where('orderid', $orderid)->where('menuid', $menuid)->where('varient', $varient)->get()->row();
			if ($status == 1) {
				$ready = "Food Is Ready";
				if (empty($isexit)) {
					$ready = array(
						'preparetime' => date('Y-m-d H:i:s'),
						'orderid'     => $orderid,
						'menuid'     => $menuid,
						'varient'     => $varient
					);
					$this->db->insert('tbl_orderprepare', $ready);
				}
				//push 
				$senderid[] = $allemployee->waiter_kitchenToken;
				define('API_ACCESS_KEY', 'AAAAvWuiU2I:APA91bGGr8XSrxX1A_XkpbFkKu8KjT-UU0wgCjar1mHKVkT575rgq5cVUcqj2-2p-eEzHV-GtEH04d75yAccgoyZ3DM5YZPfp6OxYSMs-c_9nTVQLNOMksM9rWRv5zmBUpDqnPgLFj-E');
				$registrationIds = $senderid;
				$msg = array(
					'message' 					=> "Orderid: " . $orderid . ", Item Name: " . $item->ProductName . " Amount:" . $orderinformation->totalamount,
					'title'						=> "Food Is Ready.",
					'subtitle'					=> $orderid,
					'tickerText'				=> "TSET",
					'vibrate'					=> 1,
					'sound'						=> 1,
					'largeIcon'					=> "TSET",
					'smallIcon'					=> "TSET"
				);
				$fields2 = array(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);

				$headers2 = array(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);

				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
				curl_setopt($ch2, CURLOPT_POST, true);
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));
				$result2 = curl_exec($ch2);
				curl_close($ch2);
			} else {
				$ready = "Food Is Cooking";
				$this->db->where('orderid', $orderid)->where('menuid', $menuid)->where('varient', $varient)->delete('tbl_orderprepare');
				//push 
				$senderid[] = $allemployee->waiter_kitchenToken;
				define('API_ACCESS_KEY', 'AAAAvWuiU2I:APA91bGGr8XSrxX1A_XkpbFkKu8KjT-UU0wgCjar1mHKVkT575rgq5cVUcqj2-2p-eEzHV-GtEH04d75yAccgoyZ3DM5YZPfp6OxYSMs-c_9nTVQLNOMksM9rWRv5zmBUpDqnPgLFj-E');
				$registrationIds = $senderid;
				$msg = array(
					'message' 					=> "Orderid: " . $orderid . ", Item Name: " . $item->ProductName . " Amount:" . $orderinformation->totalamount,
					'title'						=> "Processing",
					'subtitle'					=> $orderid,
					'tickerText'				=> "TSET",
					'vibrate'					=> 1,
					'sound'						=> 1,
					'largeIcon'					=> "TSET",
					'smallIcon'					=> "TSET"
				);
				$fields2 = array(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);

				$headers2 = array(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);

				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
				curl_setopt($ch2, CURLOPT_POST, true);
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));
				$result2 = curl_exec($ch2);
				curl_close($ch2);
				/*End Notification*/
			}
			echo $status;
		}
	}

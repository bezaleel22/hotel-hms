<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cashregister extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'cashregister_model'
		));
	}
	public function checkcashregister(){
		$saveid=$this->session->userdata('id'); 
		$checkuser = $this->db->select('*')->from('tbl_cashregister')->where('userid',$saveid)->where('status',0)->order_by('id','DESC')->get()->row(); 
		$openamount = $this->db->select('closing_balance')->from('tbl_cashregister')->where('userid',$saveid)->where('closing_balance>','0.000')->order_by('id','DESC')->get()->row();
		
		$counterlist = $this->db->select('*')->from('tbl_cashcounter')->get()->result(); 
		$list[''] = 'Select Counter No';
		if (!empty($counterlist)) {
			foreach($counterlist as $value){
				$list[$value->ccid] = $value->counterno;
			}
		} 
		$data['allcounter']=$list;
		if(empty($checkuser)){
			if(!empty($openamount)){
				if($openamount->closing_balance>'0.000'){
					$data['openingbalance']=$openamount->closing_balance;
				}
				else{
					$data['openingbalance']="0.000";
				}
			}else{
				$data['openingbalance']="0.000";
			}
			$this->load->view('cashregister',$data); 
			}
		 else{echo 1; exit;}
		
	 }
 	public function addcashregister(){
		$this->form_validation->set_rules('counter',display('counter'),'required');
		$this->form_validation->set_rules('totalamount',display('amount'),'required');
		$saveid=$this->session->userdata('id'); 
		$counter=$this->input->post('counter',true);
		$openingamount=$this->input->post('totalamount',true);
		if ($this->form_validation->run() === true) {
			$postData = array(
					'userid' 	        => $saveid,
					'counter_no' 	    => $this->input->post('counter',true),
					'opening_balance' 	=> $this->input->post('totalamount',true),
					'closing_balance' 	=> '0.000',
					'openclosedate' 	=> date('Y-m-d'),
					'opendate' 	        => date('Y-m-d H:i:s'),
					'closedate' 	    => "1970-01-01 00:00:00",
					'status' 	        => 0,
					'openingnote' 	    => $this->input->post('OpeningNote',true),
					'closing_note' 	    => "",
				);
				if ($this->cashregister_model->addopeningcash($postData)) {
							echo 1;
						} else {
							echo 0;
						}
			}
			else{ echo 0;}
	 }
 	public function cashregisterclose(){
		$saveid=$this->session->userdata('id'); 
		$checkuser = $this->db->select('*')->from('tbl_cashregister')->where('userid',$saveid)->where('status',0)->order_by('id','DESC')->get()->row();
		$data['userinfo'] = $this->db->select('*')->from('user')->where('id',$saveid)->get()->row(); 
		$data['registerinfo']=$checkuser;
		$data['totalamount']=$this->cashregister_model->collectcash($saveid,$checkuser->opendate);
		if(!empty($checkuser)){
			$this->load->view('cashregisterclose',$data); 
			}
		 else{echo 1; exit;}
		
	 }
 	public function closecashregister(){
		$this->form_validation->set_rules('totalamount',display('amount'),'required');
		$saveid=$this->session->userdata('id'); 
		$counter=$this->input->post('counter');
		$openingamount=$this->input->post('totalamount');
		$cashclose=$this->input->post('registerid');
		if ($this->form_validation->run() === true) {
			$postData = array(
					'id' 				=> $cashclose,
					'closing_balance' 	=> $this->input->post('totalamount',true),
					'closedate' 	    => date('Y-m-d H:i:s'),
					'status' 	        => 1,
					'closing_note' 	    => $this->input->post('closingnote',true),
				);
				if ($this->cashregister_model->closeresister($postData)) {
						$this->session->set_flashdata('message',"Day Successfully closed");
							echo 1;
						} else {
							echo 0;
						}
			}
	 } 
	public function counterlist(){
		$data['title'] = display('counter_list');
		$data['module'] 	= "day_closing";  
		$data['counterlist'] = $this->db->select('*')->from('tbl_cashcounter')->get()->result(); 
		$data['page']   = "cashcounter";  
		echo Modules::run('template/layout', $data); 
	}
	public function createcounter(){
		$data['title'] = display('counter_list');
		$this->form_validation->set_rules('counter',display('counter'),'required|is_unique[tbl_cashcounter.counterno]');
		$postData = array(
			'counterno' 	        => $this->input->post('counter',true),
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->cashregister_model->createcounter($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('day_closing/cashregister/counterlist');
	
			} else { 
				$data['title'] = display('counter_list');
				$data['module'] 	= "day_closing";  
				$data['counterlist'] = $this->db->select('*')->from('tbl_cashcounter')->get()->result(); 
				$data['page']   = "cashcounter";  
				echo Modules::run('template/layout', $data); 
			}
	}
	public function editcounter($id){
		$data['title'] = display('counter_list');
		$this->form_validation->set_rules('counter',display('counter'),'required');
		$oldCounter = $this->db->select("counterno")->from("tbl_cashcounter")->where("ccid",$id)->get()->row();
		if($oldCounter->counterno!=$this->input->post('counter',true)){
			$this->form_validation->set_rules('counter',display('counter'),'required|is_unique[tbl_cashcounter.counterno]');
		}
		$postData = array(
			'ccid' 	        		=> $id,
			'counterno' 	        => $this->input->post('counter',true),
		);
			if ($this->form_validation->run() === true) {
					if ($this->cashregister_model->updatecounter($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('day_closing/cashregister/counterlist');
	
			} else { 
				$data['title'] = display('counter_list');
				$data['module'] 	= "day_closing";  
				$data['counterlist'] = $this->db->select('*')->from('tbl_cashcounter')->get()->result(); 
				$data['page']   = "cashcounter";  
				echo Modules::run('template/layout', $data); 
			}
	}
	public function cashregisterlist(){
		$this->permission->method('report','read')->redirect();
		$data['title']    = display("day_closing")." ".display("report");
		$settinginfo=$this->cashregister_model->settinginfo();
		$data['setting']=$settinginfo;
		$data['currency']=getCurrency();
		$counterlist = $this->db->select('*')->from('tbl_cashcounter')->get()->result(); 
		$userlist = $this->db->select('tbl_cashregister.*,user.firstname,user.lastname')->from('tbl_cashregister')->join('user','user.id=tbl_cashregister.userid','left')->get()->result(); 
		$list[''] = 'Select Counter No';
		$list2[''] = 'Select Cashier';
		if (!empty($counterlist)) {
			foreach($counterlist as $value)
				$list[$value->ccid] = $value->counterno;
		} 
		$data['allcounter']=$list;
		if (!empty($userlist)) {
			foreach($userlist as $value)
				$list2[$value->userid] = $value->firstname.' '.$value->lastname;
		} 
		$data['alluser']=$list2;
		$data['module'] = "day_closing";
		$data['page']   = "cashregister_report";   
		echo Modules::run('template/layout', $data); 
		}
	public function getcashregister(){
		$data['cashreport']=$this->cashregister_model->cashregister();
		$this->load->view('day_closing/cash_report', $data);
		}
	public function getcashregisterorder(){
		$start_date= $this->input->post('startdate');
		$end_date= $this->input->post('enddate');
		$uid= $this->input->post('uid');
		$data['billeport']=$this->cashregister_model->cashregisterbill($start_date,$end_date,$uid);
		$this->load->view('day_closing/details', $data);
		}
}
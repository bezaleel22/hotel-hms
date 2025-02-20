<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pool_setting extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'Poolsetting_model'
		));	
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);
    }

    public function index(){

        $this->permission->method('pool_booking','read')->redirect();
				
        $data['title']          = display('pool_booking_list'); 
	    $data['poolbook_list']  = $this->Poolsetting_model->pool_booking_data();
        $data['module']         = "pool_booking";
        $data['page']           = "pool_booking_list";   
        echo Modules::run('template/layout', $data); 
    }
    public function booking_add(){
        
        $this->permission->method('pool_booking','read')->redirect();
        
        $data['title']          = display('add_pool_booking'); 
        $data['package_list']   = $this->Poolsetting_model->poolpack_data();
	    $data['cust_list']      = $this->Poolsetting_model->customer_data();
        $data['oldcustlist']    = $this->Poolsetting_model->oldcustomer_dropdown();
        $data['module']         = "pool_booking";
        $data['page']           = "pool_booking_add";   
        echo Modules::run('template/layout', $data); 
    }

    public function randID()
	{
		$result = ""; 
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		$charArray = str_split($chars);
		for($i = 0; $i < 7; $i++) {
			$randItem = array_rand($charArray);
			$result .="".$charArray[$randItem];
		}
		return "SmPl".$result;
	}

    public function booking_create_ajax(){

        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('total_amount',display('total_amount'),'required|xss_clean');
        $this->form_validation->set_rules('cust_id',display('total_amount'),'xss_clean');
        
        if ($this->form_validation->run() === true) {

            $cust_id = $this->input->post('cust_id',TRUE);
            if($cust_id)
            {
                $lastid=$this->db->select("*")->from('tbl_pool_booking')->order_by('pbookingid','desc')->get()->row();
                if(!empty($lastid)){
                    $sl=$lastid->pbookingid;
                    }
                else{
                    $sl = "000000"; 
                    }
                $nextno=$sl+1;
                $si_length = strlen((int)$nextno); 
                
                $str = '000000';
                $cutstr = substr($str, $si_length); 
                $pbknum = $this->randID();
                $postData = array(
                    'poolbooking_number'=> $pbknum,
                    'custid'    	    => $cust_id,
                    'total_amount'      => $this->input->post('total_amount',TRUE),
                    'status'            => 1,
                    'paid_amount'       => $this->input->post('total_amount',TRUE),
                    'entrydate'         => date('Y-m-d H:i:s'),

                ); 
                
            }else{
                $newcustomer_type = $this->input->post('newcustomer_type',TRUE);
                if($newcustomer_type == 'newcust'){

                    $lastid=$this->db->select("*")->from('customerinfo')->order_by('customerid','desc')->get()->row();
                    if(!empty($lastid)){
                        $sl=$lastid->customerid;
                        }
                    else{
                        $sl = "0001"; 
                        }
                    $nextno=$sl+1;
                    $si_length = strlen((int)$nextno); 
                    
                    $str = '0000';
                    $cutstr = substr($str, $si_length); 
                    $sino = $cutstr.$nextno;
                    $nidnum = null;
                    $paspnum = null;
                    if ($this->input->post('doc_type',TRUE)) {
                        # code...
                        if($this->input->post('doc_type',TRUE) == 1){
                            $nidnum = $this->input->post('doc_num',TRUE);
                        }
                        if($this->input->post('doc_type',TRUE) == 2){
                            $paspnum = $this->input->post('doc_num',TRUE);
                        }
                    }else{
                        $nidnum = null;
                        $paspnum = null;
                    }
                    
                    $postData0 = array(
                    
                    'firstname'     	    		=> $this->input->post('firstname',TRUE),
                    'customernumber' 	        => $sino,
                    'lastname' 	        		=> $this->input->post('lastname',TRUE),
                    'cust_phone' 	         	=> $this->input->post('phone',TRUE),
                    'email' 	             		=> $this->input->post('email',TRUE),
                    'pid' 	             		=> $nidnum,
                    'passport' 	             	=> $paspnum,
                    'signupdate'					=> date('Y-m-d')
                    );
                    $this->db->insert('customerinfo',$postData0);
                    $customerid = $this->db->insert_id();
                    
                    $coa = $this->Poolsetting_model->headcode();
                    if($coa->HeadCode!=NULL){
                        $headcode=$coa->HeadCode+1;
                    }
                    else{
                        $headcode="102030101";
                    }
                    //insert Coa for Customer Receivable
                    $c_name = $this->input->post('firstname',TRUE)." ".$this->input->post('lastname',TRUE);
                    $c_acc=$sino.'-'.$c_name;
                    $createdate=date('Y-m-d H:i:s');
                    $postData1['HeadCode']   	=$headcode;
                    $postData1['HeadName']   	=$c_acc;
                    $postData1['PHeadName']   	='Customer Receivable';
                    $postData1['HeadLevel']   	='4';
                    $postData1['IsActive']  	='1';
                    $postData1['IsTransaction'] ='1';
                    $postData1['IsGL']   		='0';
                    $postData1['HeadType']  	='A';
                    $postData1['IsBudget'] 		='0';
                    $postData1['IsDepreciation']='0';
                    $postData1['DepreciationRate']='0';
                    $postData1['CreateBy'] 		=$customerid;
                    $postData1['CreateDate'] 	=$createdate;

                    $pbookinginfo=$this->db->select("*")->from('tbl_pool_booking')->order_by('pbookingid','desc')->get()->row();
                    if(!empty($pbookinginfo)){
                    $bookno=$pbookinginfo->pbookingid;
                    }
                    else{
                        $bookno = "00000000"; 
                        }
                    
                    $nextno=$bookno+1;
                    $bk_length = strlen((int)$nextno); 
                    
                    $bkstr = '00000000';
                    $pbknumber = substr($bkstr, $bk_length); 
                }
                $poolbookingnumber = $this->randID();
                if($newcustomer_type == 'oldcust'){
                    $customerid = $this->input->post('cust_idold',TRUE);
                }

                $postData = array(
                    
                    'poolbooking_number'=> $poolbookingnumber,
                    'custid'    	    => $customerid,
                    'total_amount'      => $this->input->post('total_amount',TRUE),
                    'status'            => 1,
                    'paid_amount'       => $this->input->post('total_amount',TRUE),
                    'entrydate'         => date('Y-m-d H:i:s'),
                ); 
            }
            
            $book_id = $this->Poolsetting_model->book_create_ajax($postData);
            echo $book_id;


        } 

    }

    public function poolprdataview(){
        
        $poollastins = $this->input->post('poollastins',TRUE);

        $data['poolcastinfo']  = $this->Poolsetting_model->poolcastinfodata($poollastins);
        $data['pitemlist']     = $this->Poolsetting_model->pitemlistdata($poollastins);
        $data['pitemdata']     = $this->Poolsetting_model->pitemdatarow($poollastins);
        $data['module'] 	   = "pool_booking";
        $data['page']          = "poolprintview";
        
        $this->load->view('pool_booking/poolprintview', $data); 
    }
    public function booking_create_ajax2(){

        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('total_amount',display('total_amount'),'required|xss_clean');
        $this->form_validation->set_rules('cust_id',display('total_amount'),'xss_clean');
        
        if ($this->form_validation->run() === true) {
            $poolbookingnumber = $this->randID();
            $cust_id = $this->input->post('cust_id',TRUE);
            if($cust_id)
            {

                $postData = array(

                    'poolbooking_number'=> $poolbookingnumber,
                    'custid	'    	 => $cust_id,
                    'total_amount'   => $this->input->post('total_amount',TRUE),
                    'status'         => 2,
                    'paid_amount'    => null,
                    'entrydate'      => date('Y-m-d H:i:s'),

                ); 
                
             }
            
            $this->Poolsetting_model->book_create_ajax_inhouse($postData);


        } 

    }
    public function booking_create(){

        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('total_amount',display('total_amount'),'required|xss_clean');
        $this->form_validation->set_rules('cust_id',display('total_amount'),'xss_clean');
        
        if ($this->form_validation->run() === true) {

            $cust_id = $this->input->post('cust_id',TRUE);
            if($cust_id)
            {

                $postData = array(

                    'custid	'    	 => $cust_id,
                    'total_amount'   => $this->input->post('total_amount',TRUE),
                ); 
                
            }else{

                $lastid=$this->db->select("*")->from('customerinfo')->order_by('customerid','desc')->get()->row();
                if(!empty($lastid)){
                    $sl=$lastid->customerid;
                    }
                else{
                    $sl = "0001"; 
                    }
                $nextno=$sl+1;
                $si_length = strlen((int)$nextno); 
                
                $str = '0000';
                $cutstr = substr($str, $si_length); 
                $sino = $cutstr.$nextno;
                if($this->input->post('doc_type',TRUE) == 1){
                    $nidnum = $this->input->post('doc_num',TRUE);
                }else{
                    $paspnum = $this->input->post('doc_num',TRUE);
                }
                
                $postData0 = array(
                   
                   'firstname'     	    		=> $this->input->post('firstname',TRUE),
                   'customernumber' 	        => $sino,
                   'lastname' 	        		=> $this->input->post('lastname',TRUE),
                   'cust_phone' 	         	=> $this->input->post('phone',TRUE),
                   'email' 	             		=> $this->input->post('email',TRUE),
                   'pid' 	             		=> $nidnum,
                   'passport' 	             	=> $paspnum,
                   'signupdate'					=> date('Y-m-d')
                  );
                $this->db->insert('customerinfo',$postData0);
                $customerid = $this->db->insert_id();
                
                $coa = $this->Poolsetting_model->headcode();
                if($coa->HeadCode!=NULL){
                    $headcode=$coa->HeadCode+1;
                }
                else{
                    $headcode="102030101";
                }
                //insert Coa for Customer Receivable
                $c_name = $this->input->post('firstname',TRUE)." ".$this->input->post('lastname',TRUE);
                $c_acc=$sino.'-'.$c_name;
                $createdate=date('Y-m-d H:i:s');
                $postData1['HeadCode']   	=$headcode;
                $postData1['HeadName']   	=$c_acc;
                $postData1['PHeadName']   	='Customer Receivable';
                $postData1['HeadLevel']   	='4';
                $postData1['IsActive']  	='1';
                $postData1['IsTransaction'] ='1';
                $postData1['IsGL']   		='0';
                $postData1['HeadType']  	='A';
                $postData1['IsBudget'] 		='0';
                $postData1['IsDepreciation']='0';
                $postData1['DepreciationRate']='0';
                $postData1['CreateBy'] 		=$customerid;
                $postData1['CreateDate'] 	=$createdate;
                $this->db->insert('acc_coa',$postData1);

                $postData = array(

                    'custid	'    	 => $customerid,
                    'total_amount'   => $this->input->post('total_amount',TRUE),
                ); 
                
            }
            

            if($this->Poolsetting_model->book_create($postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('pool_booking/add-booking');


        } else {
            $data['title']          = display('add_pool_booking'); 
            $data['package_list']   = $this->Poolsetting_model->poolpack_data();
            $data['cust_list']      = $this->Poolsetting_model->customer_data();
            $data['module']         = "pool_booking";
            $data['page']           = "pool_booking_add";   
            echo Modules::run('template/layout', $data);   
            
        } 

    }

    public function booking_update(){

        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('total_amount',display('total_amount'),'required|xss_clean');
        $this->form_validation->set_rules('cust_id',display('total_amount'),'xss_clean');

        if ($this->form_validation->run() === true) {

            $cust_id = $this->input->post('cust_id',TRUE);
            
            if($cust_id)
            {

                $postData = array(

                    
                    'pbookingid'    => $this->input->post('pbookingid',TRUE),
                    'custid'    	 => $cust_id,
                    'total_amount'   => $this->input->post('total_amount',TRUE),
                ); 
                
            }else{

                $lastid=$this->db->select("*")->from('customerinfo')->order_by('customerid','desc')->get()->row();
                if(!empty($lastid)){
                    $sl=$lastid->customerid;
                    }
                else{
                    $sl = "0001"; 
                    }
                $nextno=$sl+1;
                $si_length = strlen((int)$nextno); 
                
                $str = '0000';
                $cutstr = substr($str, $si_length); 
                $sino = $cutstr.$nextno; 
                if($this->input->post('doc_type',TRUE) == 1){
                    $nidnum = $this->input->post('doc_num',TRUE);
                }else{
                    $paspnum = $this->input->post('doc_num',TRUE);
                }
                
                $postData0 = array(
                   
                   'firstname'     	    		=> $this->input->post('firstname',TRUE),
                   'customernumber' 	        => $sino,
                   'lastname' 	        		=> $this->input->post('lastname',TRUE),
                   'cust_phone' 	         	=> $this->input->post('phone',TRUE),
                   'email' 	             		=> $this->input->post('email',TRUE),
                   'pid' 	             		=> $nidnum,
                   'passport' 	             	=> $paspnum,
                   'signupdate'					=> date('Y-m-d')
                  );
                $this->db->insert('customerinfo',$postData0);
                $customerid = $this->db->insert_id();
                
                $coa = $this->Poolsetting_model->headcode();
                if($coa->HeadCode!=NULL){
                    $headcode=$coa->HeadCode+1;
                }
                else{
                    $headcode="102030101";
                }
                //insert Coa for Customer Receivable
                $c_name = $this->input->post('firstname',TRUE)." ".$this->input->post('lastname',TRUE);
                $c_acc=$sino.'-'.$c_name;
                $createdate=date('Y-m-d H:i:s');
                $postData1['HeadCode']   	=$headcode;
                $postData1['HeadName']   	=$c_acc;
                $postData1['PHeadName']   	='Customer Receivable';
                $postData1['HeadLevel']   	='4';
                $postData1['IsActive']  	='1';
                $postData1['IsTransaction'] ='1';
                $postData1['IsGL']   		='0';
                $postData1['HeadType']  	='A';
                $postData1['IsBudget'] 		='0';
                $postData1['IsDepreciation']='0';
                $postData1['DepreciationRate']='0';
                $postData1['CreateBy'] 		=$customerid;
                $postData1['CreateDate'] 	=$createdate;
                $this->db->insert('acc_coa',$postData1);

                $postData = array(

                    'pbookingid'    => $this->input->post('pbookingid',TRUE),
                    'custid'    	 => $customerid,
                    'total_amount'   => $this->input->post('total_amount',TRUE),
                ); 
                
            }
            

            if($this->Poolsetting_model->book_update($postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('pool_booking/booking-list');

            
        } else {
            $data['title']          = display('pool_booking_list'); 
            $data['poolbook_list']  = $this->Poolsetting_model->pool_booking_data();
            $data['module']         = "pool_booking";
            $data['page']           = "pool_booking_list";   
            echo Modules::run('template/layout', $data);   
            
        } 

    }

    public function pool_booking_updatefrm($id){
        $this->permission->method('pool_booking','update')->redirect();
        
        $data['title']          = display('pool_booking'); 
        $data['bookdata']       = $this->Poolsetting_model->poolbook_data($id);
        $data['bookitem_data']  = $this->Poolsetting_model->poolbookitem_data($id);
        
        $data['package_list']   = $this->Poolsetting_model->poolpack_data();
	    $data['cust_list']      = $this->Poolsetting_model->customer_data();
        $data['module']         = "pool_booking";
        $data['page']           = "pool_booking_edit";   
        echo Modules::run('template/layout', $data); 

    }

    public function pool_booking_delete($id = null)
	{
		$this->permission->module('pool_booking','delete')->redirect();
		if ($this->Poolsetting_model->delete_pool_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('pool_booking/booking-list');
	}

    public function pool_package_datashow($id){

        $data['title']  	  = display('pool_booking_list');
        $data['module'] 	  = "pool_booking";
        $data['page']         = "viewdata";
        $data['poolpadata']   = $this->Poolsetting_model->poolbook_data($id);
        $data['bookitem_data_show']  = $this->Poolsetting_model->poolbookitem_data($id);
        $this->load->view('pool_booking/viewdata', $data); 


    }


    public function cust_details(){
        $customer_id =  $this->input->post('cust_id',TRUE);
        $this->db->select('*');
        $this->db->from('customerinfo');
        $this->db->where('customerid', $customer_id);
        $query=$this->db->get()->row();
        

        echo json_encode($query);
    }
    //pool type Start
    public function pool_type_list(){

        $this->permission->method('pool_booking','read')->redirect();
				
        $data['title']          = display('pool_type_list'); 
	    $data['pooltype_list']  = $this->Poolsetting_model->pool_type_data();
        $data['module']         = "pool_booking";
        $data['page']           = "pool_type_list";   
        echo Modules::run('template/layout', $data); 
    }

	public function create_pool_type()
    { 
        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('type_name',display('type_name'),'required|xss_clean');
       
        if ($this->form_validation->run() === true) {

            $postData = array(

                'typename'    	 => $this->input->post('type_name',TRUE),
            );   

            if ($this->Poolsetting_model->pool_ty_create($postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('pool_booking/pool-type');


        } else {
            $data['title']  	  = display('create');
            $data['module']       = "pool_booking";
            $data['page']         = "pool_type_list";   
            $data['pooltype_list']= $this->Poolsetting_model->pool_type_data();
            echo Modules::run('template/layout', $data);   
            
        }   
    }

	public function pool_type_update($id = null){
        $this->permission->method('pool_booking','update')->redirect();
		$data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('type_name',display('type_name'),'required|xss_clean');
        
         
        if ($this->form_validation->run() === true) {

            $postData = array(
                'potyid'        => $this->input->post('potyid',TRUE),
                'typename'    	=> $this->input->post('type_name',TRUE),
                
            ); 
            
            if ($this->Poolsetting_model->pool_type_update($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect('pool_booking/pool-type');

        } else {
			$data['title']  	  = display('pool_type_list');
			$data['module'] 	  = "pool_booking";
			$data['page']         = "pool_type_edit";
			$data['pool_ty_info'] = $this->Poolsetting_model->pooltypeDataById($id);
			$this->load->view('pool_booking/pool_type_edit', $data); 
    	}

 	}

	public function pool_type_delete($id = null)
	{
		$this->permission->module('pool_booking','delete')->redirect();
		if ($this->Poolsetting_model->delete_pool_type($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('pool_booking/pool-type');
	}
    //pool type End

    //Swimming pool Start

    public function swimming_pool(){

        $this->permission->method('pool_booking','read')->redirect();
				
        $data['title']        = display('swimming_pool'); 
	    $data['pool_list']    = $this->Poolsetting_model->pool_data();
        $data['pool_ty_list'] = $this->Poolsetting_model->pool_ty_data();
        $data['module']       = "pool_booking";
        $data['page']         = "swimming_pool_list";   
        echo Modules::run('template/layout', $data); 
    }

    public function create_pool()
    { 
        $this->permission->method('pool_booking','create')->redirect();
        $data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('pool_name',display('pool_name'),'required|xss_clean');
        $this->form_validation->set_rules('type_name',display('type_name'),'required|xss_clean');
        $this->form_validation->set_rules('status',display('status'),'xss_clean');
        $this->form_validation->set_rules('capacity',display('capacity'),'required|xss_clean');
        $this->form_validation->set_rules('remarks',display('remarks'),'xss_clean');
       
        if ($this->form_validation->run() === true) {

            $postData = array(

                'poolname'    	 => $this->input->post('pool_name',TRUE),
                'pooltype'    	 => $this->input->post('type_name',TRUE),
                'capacity'    	 => $this->input->post('capacity',TRUE),
                'status'    	 => $this->input->post('status',TRUE),
                'remarks'    	 => $this->input->post('remarks',TRUE),
            );   

            if ($this->Poolsetting_model->pool_create($postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('pool_booking/swimming-pool');


        } else {
            $data['title']  	  = display('create');
            $data['module']       = "pool_booking";
            $data['page']         = "swimming_pool_list";   
            $data['pool_ty_list'] = $this->Poolsetting_model->pool_ty_data();
            $data['pool_list']    = $this->Poolsetting_model->pool_data();
            echo Modules::run('template/layout', $data);   
            
        }   
    }

    public function pool_update($id = null){
        $this->permission->method('pool_booking','update')->redirect();
		$data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('pool_name',display('pool_name'),'required|xss_clean');
        $this->form_validation->set_rules('type_name',display('type_name'),'required|xss_clean');
        $this->form_validation->set_rules('status',display('status'),'xss_clean');
        $this->form_validation->set_rules('capacity',display('capacity'),'required|xss_clean');
        $this->form_validation->set_rules('remarks',display('remarks'),'xss_clean');
        
         
        if ($this->form_validation->run() === true) {

            $postData = array(
                'poolid'         => $this->input->post('poolid',TRUE),
                'poolname'    	 => $this->input->post('pool_name',TRUE),
                'pooltype'    	 => $this->input->post('type_name',TRUE),
                'capacity'    	 => $this->input->post('capacity',TRUE),
                'status'    	 => $this->input->post('status',TRUE),
                'remarks'    	 => $this->input->post('remarks',TRUE),
                
            ); 
            
            if ($this->Poolsetting_model->pool_update($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect('pool_booking/swimming-pool');

        } else {
			$data['title']  	  = display('pool_type_list');
			$data['module'] 	  = "pool_booking";
			$data['page']         = "swimming_pool_edit";
            $data['pool_ty_list'] = $this->Poolsetting_model->pool_ty_data();
			$data['pool_info']    = $this->Poolsetting_model->poolDataById($id);
			$this->load->view('pool_booking/swimming_pool_edit', $data); 
    	}

 	}

     public function pool_delete($id = null)
	{
		$this->permission->module('pool_booking','delete')->redirect();
		if ($this->Poolsetting_model->delete_pool($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('pool_booking/swimming-pool');
	}

    public function changestatus(){
        $sattus=$this->input->post('scode',true);
        
        $table=$this->input->post('tname',true);
        $field_value=$this->input->post('id',true);
        $field_name=$this->input->post('fieldname',true);
        $data = array('status' => $sattus); 
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
         return $this->db->affected_rows();
        }

    //Swimming pool End

    //Pool Image Start

    public function pool_img(){

        $this->permission->method('pool_booking','read')->redirect();
				
        $data['title']          = display('pool_img'); 
	    $data['poolimg_list']   = $this->Poolsetting_model->pool_img_data();
	    $data['pool_list']      = $this->Poolsetting_model->poolname_data();
        $data['module']         = "pool_booking";
        $data['page']           = "poolimages";   
        echo Modules::run('template/layout', $data); 
    }

    public function pool_img_create($id = null)
    {
	    $data['title'] = display('pool_img');
	    $this->form_validation->set_rules('pool_id',display('pool_name'),'required|xss_clean');
        $img = $this->fileupload->do_upload(
            'application/modules/pool_booking/assets/images/','poolpicture'
        );

        
        // if favicon is uploaded then resize the favicon
        if ($img !== false && $img != null) {
            $this->fileupload->do_resize(
                $favicon, 
                32,
                32
            );
        }
        //if favicon is not uploaded
        if ($img === false) {
            $this->session->set_flashdata('exception', "Please Upload a Valid Image");
        }
	   
	    $saveid=$this->session->userdata('id');
	    $id=$this->input->post('pool_img_id', TRUE);
	    $data['intinfo']="";
	    if ($this->form_validation->run()) {
            if(empty($this->input->post('pool_img_id', TRUE))) {
                $data['pool_booking'] = (Object) $postData = array(
            
                    'pool_id' 	      => $this->input->post('pool_id',TRUE),
                    'poolimg_name' 	  => $img,
                );
              
                $this->permission->method('pool_booking','create')->redirect();
                if ($this->Poolsetting_model->create_pool_img($postData)) 
                { 
                    $this->session->set_flashdata('message', display('save_successfully'));
                    redirect('pool_booking/pool-image');
                } 
                else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("pool_booking/pool-image"); 
        
            } else {
            
                $this->permission->method('pool_booking','update')->redirect();
                if(!empty($id)) {
                    $imageinfo=$this->db->select('*')->from('tbl_pool_image')->where('pool_img_id',$id)->get()->row();
                    if(!empty($img)){
                        unlink($imageinfo->poolimg_name);
                    }
                    else{

                        $img=$imageinfo->poolimg_name;
                    } 
                }
                $data['pool_booking']   = (Object) $postData = array(
                    'pool_img_id'     	=> $this->input->post('pool_img_id', TRUE),
                    'pool_id' 	        => $this->input->post('pool_id',TRUE),
                    'poolimg_name' 	    => $img,
                );
            
                if ($this->Poolsetting_model->update_pool_img($postData)) { 
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("pool_booking/pool-image");  
            }
	    } else {

            if(!empty($id)) {
                $data['title']    = display('bed_edit');
                $data['pimginfo'] = $this->Poolsetting_model->poolimageById($id);
            }
            if($this->form_validation->run()==false){
                $this->session->set_flashdata('exception',  display('please_try_again'));
                redirect("pool_booking/pool-image");  
            }
            $data['poolimg_list'] = $this->Poolsetting_model->pool_img_data();
            $data['module']       = "pool_booking";
            $data['page']         = "poolimages";   
            echo Modules::run('template/layout', $data); 
	    }   
 
    }

    public function pool_img_updatefrm($id)
    {
		$this->permission->method('pool_booking','update')->redirect();
		$data['title']     = display('pool_img');
		$data['pool_list'] = $this->Poolsetting_model->poolname_data();
		$data['pimginfo']  = $this->Poolsetting_model->poolimageById($id);
        $data['module']    = "pool_booking";  
        $data['page']      = "poolimagedit";
		$this->load->view('pool_booking/poolimagedit', $data);   
	}

    public function pool_img_delete($id = null)
    {
        $this->permission->module('pool_booking','delete')->redirect();
        $imageinfo=$this->db->select('*')->from('tbl_pool_image')->where('pool_img_id',$id)->get()->row();
        $myimage=$imageinfo->poolimg_name;
        if ($this->Poolsetting_model->delete_p_img($id)) {
            unlink($myimage);
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('pool_booking/pool-image');
    }
    //Pool Image end

    //Pool Package Start

    public function pool_package(){

        $this->permission->method('pool_booking','read')->redirect();
				
        $data['title']          = display('pool_package_list'); 
	    $data['poolpack_list']  = $this->Poolsetting_model->pool_pack_data();
	    $data['pool_list']      = $this->Poolsetting_model->poolname_data();
        $data['module']         = "pool_booking";
        $data['page']           = "pool_package_list";   
        echo Modules::run('template/layout', $data); 
    }

    public function create_pool_package($id = null)
    {
	    $data['title'] = display('pool_package');
	    $this->form_validation->set_rules('package_name',display('package_name'),'required|xss_clean');
	    $this->form_validation->set_rules('pool_name',display('pool_name'),'required|xss_clean');
	    $this->form_validation->set_rules('date_from',display('date_from'),'required|xss_clean');
	    $this->form_validation->set_rules('date_to',display('date_to'),'required|xss_clean');
	    $this->form_validation->set_rules('price',display('price'),'required|xss_clean');
	    $this->form_validation->set_rules('status',display('status'),'xss_clean');
	    $this->form_validation->set_rules('pool_details',display('pool_details'),'xss_clean');
        
        $img1 = $this->fileupload->do_upload('application/modules/pool_booking/assets/images/packageimg/','packagepicture');
       
        //if favicon is uploaded then resize the favicon
        if ($img1 !== false && $img1 != null) {
            $this->fileupload->do_resize(
                $favicon, 
                32,
                32
            );
        }
        //if favicon is not uploaded
        if ($img1 === false) {
            $this->session->set_flashdata('exception', "Please Upload a Valid Image");
        }
	   
	    $saveid=$this->session->userdata('id');
	    $id=$this->input->post('packageid', TRUE);
	    $data['intinfo']="";
	    if ($this->form_validation->run()) {
            if(empty($this->input->post('packageid', TRUE))) {
                $data['pool_booking'] = (Object) $postData = array(
            
                    'poolid' 	   => $this->input->post('pool_name',TRUE),
                    'package_name' => $this->input->post('package_name',TRUE),
                    'datetime_from'=> $this->input->post('date_from',TRUE),
                    'datetime_to'  => $this->input->post('date_to',TRUE),
                    'price' 	   => $this->input->post('price',TRUE),
                    'status' 	   => $this->input->post('status',TRUE),
                    'details' 	   => $this->input->post('pool_details',TRUE),
                    'packageimage' => $img1,
                );
               
                $this->permission->method('pool_booking','create')->redirect();
                if ($this->Poolsetting_model->create('tbl_pool_package', $postData)) 
                { 
                    $this->session->set_flashdata('message', display('save_successfully'));
                    redirect('pool_booking/pool-package');
                } 
                else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("pool_booking/pool-package"); 
        
            } else {
            
                $this->permission->method('pool_booking','update')->redirect();
                if(!empty($id)) {
                    $imageinfo=$this->db->select('*')->from('tbl_pool_package')->where('packageid',$id)->get()->row();
                    if(!empty($img1)){
                        unlink($imageinfo->packageimage);
                    }
                    else{

                        $img1=$imageinfo->packageimage;
                    } 
                }
                $data['pool_booking']   = (Object) $postData = array(
                    'packageid'     	=> $this->input->post('packageid', TRUE),
                    'poolid' 	        => $this->input->post('pool_name',TRUE),
                    'package_name'      => $this->input->post('package_name',TRUE),
                    'datetime_from'     => $this->input->post('date_from',TRUE),
                    'datetime_to'       => $this->input->post('date_to',TRUE),
                    'price' 	        => $this->input->post('price',TRUE),
                    'status' 	        => $this->input->post('status',TRUE),
                    'details' 	        => $this->input->post('pool_details',TRUE),
                    'packageimage'      => $img1,
                );
            
                if ($this->Poolsetting_model->update_pool_package($postData)) { 
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("pool_booking/pool-package");  
            }
	    } else {

            if(!empty($id)) {
                $data['title']     = display('pool_package_list');
                $data['pool_list'] = $this->Poolsetting_model->poolname_data();
                $data['ppakinfo']  = $this->Poolsetting_model->poolpackageById($id);
            }
            if($this->form_validation->run()==false){
                $this->session->set_flashdata('exception',  display('please_try_again'));
                redirect("pool_booking/pool-package");  
            }
            $data['poolpack_list']  = $this->Poolsetting_model->pool_pack_data();
            $data['pool_list']      = $this->Poolsetting_model->poolname_data();
            $data['module']         = "pool_booking";
            $data['page']           = "pool_package_list";   
            echo Modules::run('template/layout', $data); 
	    }   
 
    }

    public function pool_package_updatefrm($id)
    {
		$this->permission->method('pool_booking','update')->redirect();
		$data['title']     = display('pool_package_list');
		$data['pool_list'] = $this->Poolsetting_model->poolname_data();
		$data['ppakinfo']  = $this->Poolsetting_model->poolpackageById($id);
        $data['module']    = "pool_booking";  
        $data['page']      = "pool_package_edit";
		$this->load->view('pool_booking/pool_package_edit', $data);   
	}

    public function pool_package_delete($id = null)
    {
        $this->permission->module('pool_booking','delete')->redirect();
        $imageinfo=$this->db->select('*')->from('tbl_pool_package')->where('packageid',$id)->get()->row();
        $myimage=$imageinfo->packageimage;
        if ($this->Poolsetting_model->delete_pack($id)) {
            unlink($myimage);
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('pool_booking/pool-package');
    } 

    public function check_registered_customer(){
		$customerid=$this->input->post('cust_idold');
		$registercust = $this->db->select('*')->from('customerinfo')->where('customerid',$customerid)->get()->row();
		
		 echo json_encode($registercust); 

	}

    public function check_duplicate_customer(){
		$mobile=$this->input->post('mobile');
		$registercust = $this->db->select('*')->from('customerinfo')->where('cust_phone',$mobile)->get()->num_rows();
		
		 echo $registercust; 

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transport_setting extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'Transport_model'
		));	
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);
    }

    //Flight Details CRUD Start
    public function index(){

        $this->permission->method('transport_facility','read')->redirect();		
        $data['title']          = display('flight_details_list'); 
	    $data['fdetails_list']  = $this->Transport_model->read_all('*','tbl_flight_details');
        $data['module']         = "transport_facility";
        $data['page']           = "flight_details_list";   
        echo Modules::run('template/layout', $data); 
    }
    
    public function create_flight_details(){
        
        $this->form_validation->set_rules('flight_num',display('flight_num'),'required|xss_clean');
        $this->form_validation->set_rules('airlience_name',display('airlience_name'),'xss_clean');
        $this->form_validation->set_rules('departure',display('departure'),'required|xss_clean');
        $this->form_validation->set_rules('arrival',display('arrival'),'required|xss_clean');
        $this->form_validation->set_rules('fly_from',display('fly_from'),'xss_clean');
        $this->form_validation->set_rules('fly_to',display('fly_to'),'xss_clean');
       
        if ($this->form_validation->run() === true) {
            $postData = array(
                'flight_num'     => $this->input->post('flight_num',TRUE),
                'airlience_name' => $this->input->post('airlience_name',TRUE),
                'departure'    	 => $this->input->post('departure',TRUE),
                'arrival'    	 => $this->input->post('arrival',TRUE),
                'fly_from'    	 => $this->input->post('fly_from',TRUE),
                'fly_to'    	 => $this->input->post('fly_to',TRUE),
            );   
            if ($this->Transport_model->create('tbl_flight_details',$postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('transport_facility/flight-list');
        } else {
            $data['title']          = display('flight_details_list'); 
            $data['fdetails_list']  = $this->Transport_model->flight_details_data();
            $data['module']         = "transport_facility";
            $data['page']           = "flight_details_list";   
            echo Modules::run('template/layout', $data);   
        } 
    }

    public function flight_details_updatefrm($id)
    {
		$this->permission->method('transport_facility','update')->redirect();
		$data['title']     = display('fl_details_update');
		$data['flydeinfo'] = $this->Transport_model->dataById('tbl_flight_details','flyid',$id);
        $data['module']    = "transport_facility";  
        $data['page']      = "flight_details_edit";
		$this->load->view('transport_facility/flight_details_edit', $data);   
	}

	public function update_flight_details($id = null){

        $this->permission->method('transport_facility','update')->redirect();
		$data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('flyid','id','required|xss_clean');
        $this->form_validation->set_rules('flight_num',display('flight_num'),'required|xss_clean');
        $this->form_validation->set_rules('airlience_name',display('airlience_name'),'xss_clean');
        $this->form_validation->set_rules('departure',display('departure'),'required|xss_clean');
        $this->form_validation->set_rules('arrival',display('arrival'),'required|xss_clean');
        $this->form_validation->set_rules('fly_from',display('fly_from'),'xss_clean');
        $this->form_validation->set_rules('fly_to',display('fly_to'),'xss_clean');
        
        if ($this->form_validation->run() === true) {
            $postData = array(
                'flyid'          => $this->input->post('flyid',TRUE),
                'flight_num'     => $this->input->post('flight_num',TRUE),
                'airlience_name' => $this->input->post('airlience_name',TRUE),
                'departure'    	 => $this->input->post('departure',TRUE),
                'arrival'    	 => $this->input->post('arrival',TRUE),
                'fly_from'    	 => $this->input->post('fly_from',TRUE),
                'fly_to'    	 => $this->input->post('fly_to',TRUE),
            ); 
            if ($this->Transport_model->update('tbl_flight_details','flyid',$postData['flyid'],$postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect('transport_facility/flight-list');

        } else {
			$data['title']          = display('flight_details_list'); 
            $data['fdetails_list']  = $this->Transport_model->flight_details_data();
            $data['module']         = "transport_facility";
            $data['page']           = "flight_details_list";   
            echo Modules::run('template/layout', $data);
    	}
 	}

	public function delete_flight_details($id = null){

		$this->permission->module('transport_facility','delete')->redirect();
		if ($this->Transport_model->delete('tbl_flight_details','flyid',$id)) {
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('transport_facility/flight-list');
	}
    //Flight Details CRUD End

    //Vehicle Details CRUD Start
    public function vehicle_list(){

        $this->permission->method('transport_facility','read')->redirect();		
        $data['title']       = display('vehicle_details_list'); 
	    $data['vedtls_list'] = $this->Transport_model->vehicle_dtls_list();
	    
        $data['module']      = "transport_facility";
        $data['page']        = "vehicle_details_list";   
        echo Modules::run('template/layout', $data); 
    }

    public function getvbook(){
		
		$startdates=$this->input->post('start_date',TRUE);
		$endate=$this->input->post('to_date',TRUE);
		$data['vbooksearchinfo']   = $this->Transport_model->vbooksearchdata($startdates,$endate);
		$data['module'] = "transport_facility";  
        $data['page']   = "vehicle_booking_search";
		$this->load->view('transport_facility/vehicle_booking_search', $data);   
		}

    public function create_vehicle_details(){
        
        $this->form_validation->set_rules('vehicle_number',display('vehicle_number'),'required|xss_clean');
        $this->form_validation->set_rules('vehicle_type',display('vehicle_type'),'required|xss_clean');
        $this->form_validation->set_rules('fuel_type',display('fuel_type'),'xss_clean');
        $this->form_validation->set_rules('seat_capacity',display('seat_capacity'),'xss_clean');
        
       
        if ($this->form_validation->run() === true) {
            $postData = array(
                'vehicle_number'=> $this->input->post('vehicle_number',TRUE),
                'vehicle_type'  => $this->input->post('vehicle_type',TRUE),
                'fuel_type'    	=> $this->input->post('fuel_type',TRUE),
                'seat_capacity' => $this->input->post('seat_capacity',TRUE),
                
            );   
            if ($this->Transport_model->create('tbl_vehicle_details',$postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('transport_facility/vehicle-list');
        } else {
            $data['title']       = display('vehicle_details_list'); 
            $data['vedtls_list'] = $this->Transport_model->vehicle_dtls_list();
            $data['module']      = "transport_facility";
            $data['page']        = "vehicle_details_list";     
            echo Modules::run('template/layout', $data); 
        } 
    }

    public function vehicle_details_updatefrm($id)
    {
		$this->permission->method('transport_facility','update')->redirect();
		$data['title']      = display('vehicle_details_edit');
		$data['vehicleinfo']= $this->Transport_model->dataById('tbl_vehicle_details','vdsid',$id);
        $data['module']     = "transport_facility";  
        $data['page']       = "vehicle_details_edit";
		$this->load->view('transport_facility/vehicle_details_edit', $data);   
	}

	public function update_vehicle_details($id = null){

        $this->permission->method('transport_facility','update')->redirect();
		$data['title'] = display('pool_type_list');
        $this->form_validation->set_rules('vdsid','id','required|xss_clean');
        $this->form_validation->set_rules('vehicle_number',display('vehicle_number'),'required|xss_clean');
        $this->form_validation->set_rules('vehicle_type',display('vehicle_type'),'required|xss_clean');
        $this->form_validation->set_rules('fuel_type',display('fuel_type'),'xss_clean');
        $this->form_validation->set_rules('seat_capacity',display('seat_capacity'),'xss_clean');
        
        if ($this->form_validation->run() === true) {
            $postData = array(
                'vdsid'          => $this->input->post('vdsid',TRUE),
                'vehicle_number' => $this->input->post('vehicle_number',TRUE),
                'vehicle_type'   => $this->input->post('vehicle_type',TRUE),
                'fuel_type'    	 => $this->input->post('fuel_type',TRUE),
                'seat_capacity'  => $this->input->post('seat_capacity',TRUE),
                
            ); 
            if ($this->Transport_model->update('tbl_vehicle_details','vdsid',$postData['vdsid'],$postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            
            
            redirect('transport_facility/vehicle-list');

        } else {
           
			$data['title']       = display('vehicle_details_list'); 
            $data['vedtls_list'] = $this->Transport_model->vehicle_dtls_list();
            $data['module']      = "transport_facility";
            $data['page']        = "vehicle_details_list";     
            echo Modules::run('template/layout', $data);
    	}
 	}

	public function delete_vehicle_details($id = null){

		$this->permission->module('transport_facility','delete')->redirect();
		if ($this->Transport_model->delete('tbl_vehicle_details','vdsid',$id)) {
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('transport_facility/vehicle-list');
	}
    //Vehicle Details CRUD End

    //Vehicle Booking CRUD Start
    public function vehicle_booking_list(){

        $this->permission->method('transport_facility','read')->redirect();		
        $data['title']        = display('vehicle_booking_list'); 
	    $data['vebook_list']  = $this->Transport_model->vehicle_book_list();
	    $data['cust_list']    = $this->Transport_model->customer_data();
	    $data['flight_list']  = $this->Transport_model->flight_data();
	    $data['vehicle_list'] = $this->Transport_model->vehicle_data();
        $data['driver_list']  = $this->Transport_model->driver_data();
        $data['module']       = "transport_facility";
        $data['page']         = "vehicle_booking_list";   
        echo Modules::run('template/layout', $data); 
    }

    public function create_vehicle_booking(){
        
        $this->form_validation->set_rules('cust_id',display('customer_name'),'required|xss_clean');
        $this->form_validation->set_rules('vehicle_id',display('vehicle_number'),'required|xss_clean');
        $this->form_validation->set_rules('flight_id',display('flight_num'),'required|xss_clean');
        $this->form_validation->set_rules('transportation_type',display('transportation_type'),'required|xss_clean');
        $this->form_validation->set_rules('transportation_time',display('transportation_time'),'required|xss_clean');
        $this->form_validation->set_rules('driver_id',display('driver'),'required|xss_clean');
       
        if ($this->form_validation->run() === true) {
            $postData = array(
                'cust_id'            => $this->input->post('cust_id',TRUE),
                'vehicle_id'         => $this->input->post('vehicle_id',TRUE),
                'flight_id'          => $this->input->post('flight_id',TRUE),
                'transportation_type'=> $this->input->post('transportation_type',TRUE),
                'transportation_time'=> $this->input->post('transportation_time',TRUE),
                'driver_id'    	     => $this->input->post('driver_id',TRUE),
            );   
            if ($this->Transport_model->create('tbl_vehicle_booking',$postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
			redirect('transport_facility/vehicle-booking-list');
        } else {
            $data['title']        = display('vehicle_booking_list'); 
            $data['vebook_list']  = $this->Transport_model->vehicle_book_list();
            $data['cust_list']    = $this->Transport_model->customer_data();
            $data['flight_list']  = $this->Transport_model->flight_data();
            $data['vehicle_list'] = $this->Transport_model->vehicle_data();
            $data['driver_list']  = $this->Transport_model->driver_data();
            $data['module']       = "transport_facility";
            $data['page']         = "vehicle_booking_list";   
            echo Modules::run('template/layout', $data); 
        } 
    }

    public function vehicle_booking_updatefrm($id)
    {
		$this->permission->method('transport_facility','update')->redirect();
		$data['title']        = display('vehicle_details_edit');
		$data['vhiclbkinfo']  = $this->Transport_model->dataById('tbl_vehicle_booking','vbkid',$id);
        $data['cust_list']    = $this->Transport_model->customer_data();
        $data['flight_list']  = $this->Transport_model->flight_data();
        $data['vehicle_list'] = $this->Transport_model->vehicle_data();
        $data['driver_list']  = $this->Transport_model->driver_data();
        $data['module']       = "transport_facility";  
        $data['page']         = "vehicle_booking_edit";
		$this->load->view('transport_facility/vehicle_booking_edit', $data);   
	}

	public function update_vehicle_booking($id = null){

        $this->permission->method('transport_facility','update')->redirect();
		$data['title'] = display('vehicle_booking_edit');
        $this->form_validation->set_rules('vbkid','id','required|xss_clean');
        $this->form_validation->set_rules('cust_id',display('customer_name'),'required|xss_clean');
        $this->form_validation->set_rules('vehicle_id',display('vehicle_number'),'required|xss_clean');
        $this->form_validation->set_rules('flight_id',display('flight_num'),'required|xss_clean');
        $this->form_validation->set_rules('transportation_type',display('transportation_type'),'required|xss_clean');
        $this->form_validation->set_rules('transportation_time',display('transportation_time'),'required|xss_clean');
        $vehicle_bookid = $this->input->post('vbkid',TRUE);
        $old_driver = $this->db->select('*')->from('tbl_vehicle_booking')->where('vbkid',$vehicle_bookid)->get()->row();
        if ($this->input->post('driver_id',TRUE) == '') {
            $driverid = $old_driver->driver_id;
        }else {
            $driverid = $this->input->post('driver_id',TRUE);
        }
        if ($this->form_validation->run() === true) {
            $postData = array(
                'vbkid'              => $this->input->post('vbkid',TRUE),
                'cust_id'            => $this->input->post('cust_id',TRUE),
                'vehicle_id'         => $this->input->post('vehicle_id',TRUE),
                'flight_id'          => $this->input->post('flight_id',TRUE),
                'transportation_type'=> $this->input->post('transportation_type',TRUE),
                'transportation_time'=> $this->input->post('transportation_time',TRUE),
                'driver_id'        	 => $driverid,
            );
            if ($this->Transport_model->update('tbl_vehicle_booking','vbkid',$postData['vbkid'],$postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            
            
            redirect('transport_facility/vehicle-booking-list');

        } else {
           
			$data['title']        = display('vehicle_booking_list'); 
            $data['vebook_list']  = $this->Transport_model->vehicle_book_list();
            $data['cust_list']    = $this->Transport_model->customer_data();
            $data['flight_list']  = $this->Transport_model->flight_data();
            $data['vehicle_list'] = $this->Transport_model->vehicle_data();
            $data['driver_list']  = $this->Transport_model->driver_data();
            $data['module']       = "transport_facility";
            $data['page']         = "vehicle_booking_list";   
            echo Modules::run('template/layout', $data); 
    	}
 	}

	public function delete_vehicle_booking($id = null){

		$this->permission->module('transport_facility','delete')->redirect();
		if ($this->Transport_model->delete('tbl_vehicle_booking','vbkid',$id)) {
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('transport_facility/vehicle-booking-list');
	}

    public function flight_datarow(){
        $flight_id  = $this->input->post('flight_id',TRUE);
        $flightinfo = $this->Transport_model->dataById('tbl_flight_details','flyid',$flight_id);
        echo json_encode($flightinfo);

    }
    //Vehicle Booking CRUD End

    
}
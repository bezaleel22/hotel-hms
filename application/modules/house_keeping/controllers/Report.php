<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'housekeeping_model'
		));	
    }
	public function cleaningreport(){
		$this->permission->method('house_keeping','read')->redirect();
        $data['title']    = display('cleaning_report'); 
		$data["employee"] = $this->housekeeping_model->employee(); 
		$data["totalcount"] = $this->housekeeping_model->emplist(); 
        $data['module'] = "house_keeping";
        $data['page']   = "cleaningreport";   
        echo Modules::run('template/layout', $data); 
	}
	public function getreport(){
		$this->permission->method('house_keeping','read')->redirect();
        $data['title']    = display('cleaning_report'); 
		$employee_id=$this->input->post('employee_id',TRUE);
		$startdates=$this->input->post('start_date',TRUE);
		$endate=$this->input->post('to_date',TRUE);
		$data["totalcount"] = $this->housekeeping_model->findemplist($employee_id,$startdates,$endate); 
        $data['module'] = "house_keeping";
        $data['page']   = "getreport";   
        $this->load->view('house_keeping/getreport', $data); 
	}
	public function records(){
		$this->permission->method('house_keeping','read')->redirect();
        $data['title']    = display('records'); 
		$data["employee"] = $this->housekeeping_model->employee(); 
		$data["totalcount"] = $this->housekeeping_model->recordlist(); 
        $data['module'] = "house_keeping";
        $data['page']   = "records";   
        echo Modules::run('template/layout', $data); 
	}
	public function getrecord(){
		$this->permission->method('house_keeping','read')->redirect();
        $data['title']    = display('records'); 
		$employee_id=$this->input->post('employee_id',TRUE);
		$startdates=$this->input->post('start_date',TRUE);
		$endate=$this->input->post('to_date',TRUE);
		$data["totalcount"] = $this->housekeeping_model->findrecordlist($employee_id,$startdates,$endate); 
        $data['module'] = "house_keeping";
        $data['page']   = "getrecords";   
		$this->load->view('house_keeping/getrecords', $data);  
	}
}
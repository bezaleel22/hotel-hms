<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift_management extends MX_Controller {

public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'Shift_model',
		));		 
	}

public function index()
	{   
        $this->permission->method('duty_roster','read')->redirect();

		$data['title']    = display('shift_list');  
		$data['shift_datalist']   = $this->Shift_model->shift_data();
		$data['module']   = "duty_roster";
		$data['page']     = "shift_list";   
		echo Modules::run('template/layout', $data); 
	}

public function create_shift()
    { 
        $data['title'] = display('shift_add');
        $this->form_validation->set_rules('shift_name',display('shift_name'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_start',display('shift_start'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_end',display('shift_end'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_time',display('shift_time'),'required|max_length[150]|xss_clean');
        if ($this->form_validation->run() === true) {

            $postData = array(
            'shift_name'      => $this->input->post('shift_name',TRUE),
            'shift_start'     => $this->input->post('shift_start',TRUE),
            'shift_end'       => $this->input->post('shift_end',TRUE),
            'shift_duration'  => $this->input->post('shift_time',TRUE),
            );   

            if ($this->Shift_model->shift_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_saved'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("duty_roster/shift-list");

        } else {
            $data['title']    = display('shift_list');  
            $data['shift_datalist']   = $this->Shift_model->shift_data();
            $data['module']   = "duty_roster";
            $data['page']     = "shift_list";   
          echo Modules::run('template/layout', $data); 
        }   
    }

 public function delete_shift($id=null){
        $this->permission->module('duty_roster','delete')->redirect();
        if($this->Shift_model->shift_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('duty_roster/shift-list');
    }

	public function update_shift_form($id = null)
    { 
        $this->form_validation->set_rules('shiftid',display('shiftid'));
        $this->form_validation->set_rules('shift_name',display('shift_name'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_start',display('shift_start'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_end',display('shift_end'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('shift_time',display('shift_time'),'required|max_length[150]|xss_clean');
       
        if ($this->form_validation->run() === true) {

            $Data = array(   
            'shiftid'         =>$this->input->post('shiftid',true),
            'shift_name'      => $this->input->post('shift_name',TRUE),
            'shift_start'     => $this->input->post('shift_start',TRUE),
            'shift_end'       => $this->input->post('shift_end',TRUE),
            'shift_duration'  => $this->input->post('shift_time',TRUE),
            );   

            if ($this->Shift_model->update_shift($Data)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("duty_roster/shift-list");



        } else {
            $data['title']     = display('update');
            $data['shiftinfo'] =$this->Shift_model->shift_databyid($id);
            $data['module']    = "duty_roster";    
            $data['page']      = "shift_edit";   
            $this->load->view('duty_roster/shift_edit', $data); 
        }      
    }

    public function chk_shift_start_into_other(){

        $shift_start2 =  $this->input->post('shift_start2',TRUE);
        $shift_id   =  $this->input->post('shift_id',TRUE);
        $condi1 = "'".$shift_start2."' BETWEEN cast(shift_start AS Time) AND cast(shift_end AS Time)";
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where_not_in('shiftid', $shift_id);
        $this->db->where($condi1);
        $query=$this->db->get()->result();
        if(!empty($query)){
            echo 1;
        }
    }
    public function chk_shift_end_into_other(){

        $shift_end2 =  $this->input->post('shift_end2',TRUE);
        $shift_id   =  $this->input->post('shift_id',TRUE);
        $condi1 = "'".$shift_end2."' BETWEEN cast(shift_start AS Time) AND cast(shift_end AS Time)";
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where_not_in('shiftid', $shift_id);
        $this->db->where($condi1);
        $query=$this->db->get()->result();
        if(!empty($query)){
            echo 1;
        }
    }

    public function check_inshiftedit(){

        $shift_start =  $this->input->post('shift_start',TRUE);
        $shift_end   =  $this->input->post('shift_end',TRUE);
        $shift_id   =  $this->input->post('shift_id',TRUE);
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where_not_in('shiftid', $shift_id);
        $this->db->where('cast(shift_start AS Time) >=', $shift_start);
        $this->db->where('cast(shift_end AS Time) <=', $shift_end);
        $query=$this->db->get()->result();
        
        if(!empty($query)){
            echo 1;
            
        }
        
    }

    public function chkduplicateshift(){

        $shift_start =  $this->input->post('shift_start',TRUE);
        $shift_end   =  $this->input->post('shift_end',TRUE);
        $condi1 = "'".$shift_start."' BETWEEN cast(shift_start AS Time) AND cast(shift_end AS Time)";
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where($condi1);
        $query=$this->db->get()->result();
        if(!empty($query)){
            echo 1;
        }else {
            echo 2;
        }
        
    }
    public function chkduplicateshift2(){

        $shift_start =  $this->input->post('shift_start',TRUE);
        $shift_end   =  $this->input->post('shift_end',TRUE);
        $condi1 = "'".$shift_end."' BETWEEN cast(shift_start AS Time) AND cast(shift_end AS Time)";
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where($condi1);
        $query=$this->db->get()->result();
        
        if(!empty($query)){
            echo 1;
            
        }else {
            echo 2;
        }
        
    }
    public function check_inshift(){

        $shift_start =  $this->input->post('shift_start',TRUE);
        $shift_end   =  $this->input->post('shift_end',TRUE);
        
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where('cast(shift_start AS Time) >=', $shift_start);
        $this->db->where('cast(shift_end AS Time) <=', $shift_end);
        $query=$this->db->get()->result();
        
        if(!empty($query)){
            echo 1;
            
        }else {
            echo 2;
        }
        
    }

    public function roster_list()
	{   
        $this->permission->method('duty_roster','read')->redirect();

		$data['title']    = display('roster_list');  
		$data['shift_rosterlist']   = $this->Shift_model->roster_data();
        $data['shift_list'] = $this->Shift_model->shif_data();
		$data['module']   = "duty_roster";
		$data['page']     = "roster_list";   
		echo Modules::run('template/layout', $data); 
	}

public function create_roster()
    { 
        $data['title'] = display('shift_add');
        $this->form_validation->set_rules('roster_start_date',display('roster_start_date'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('roster_end_date',display('roster_end_date'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('roster_days',display('roster_days'),'required|max_length[150]|xss_clean');
        if ($this->form_validation->run() === true) {

            $shift_idall = $this->input->post('shift_id',TRUE);
            $randomid = $this->randID();
              $i = 0;
	 	 	 foreach ($shift_idall as $shift) {

	 	 	 	
                $postData = array(
                    'shift_id'      => $shift_idall[$i],
                    'rostentry_id'  => $randomid,
                    'roster_start'  => $this->input->post('roster_start_date',TRUE),
                    'roster_end'    => $this->input->post('roster_end_date',TRUE),
                    'roster_dsys'   => $this->input->post('roster_days',TRUE),
                    );
                    $this->Shift_model->roster_create($postData);
                    $i++;
                    
                }
            
                $this->session->set_flashdata('message', display('successfully_saved'));
           
            redirect("duty_roster/create-roster");

        } else {
            $data['title']    = display('shift_list');  
            $data['shift_datalist']   = $this->Shift_model->roster_data();
            $data['shift_list'] = $this->Shift_model->shif_data();
            $data['module']   = "duty_roster";
            $data['page']     = "roster_list";  
          echo Modules::run('template/layout', $data); 
        }   
    }

 public function delete_roster($roster_start, $roster_end){
        $this->permission->module('duty_roster','delete')->redirect();
        if($this->Shift_model->roster_delete($roster_start, $roster_end)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('duty_roster/create-roster');
    }

	public function update_roster_form($id = null)
    { 

        $data['title']     = display('update');
        $data['rosterinfo'] =$this->Shift_model->roster_databyid($id);
        $data['shift_list'] = $this->Shift_model->shif_data();
        $data['module']    = "duty_roster";    
        $data['page']      = "roster_edit";   
        $this->load->view('duty_roster/roster_edit', $data); 
            
    }
	public function update_roster_data()
    {
        $this->form_validation->set_rules('rostentry_id','Id','required|xss_clean');
        $this->form_validation->set_rules('roster_start_date',display('roster_start_date'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('roster_end_date',display('roster_end_date'),'required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('roster_days',display('roster_days'),'required|max_length[150]|xss_clean');
        
        if ($this->form_validation->run() === true) {

            $roster_id   = $this->input->post('rostentry_id',true);
            $shift_idall = $this->input->post('shift_id',TRUE);
            
            $i = 0;
            foreach ($shift_idall as $shift) {
                $check_old_roster = $this->db->select('*')->from('tbl_duty_roster')->where('rostentry_id',$roster_id)->where('shift_id',$shift_idall[$i])->get()->row();
                if (empty($check_old_roster)) {
                    $postData = array(
                        'rostentry_id'  => $roster_id,
                        'shift_id'      => $shift_idall[$i],
                        'roster_start'  => $this->input->post('roster_start_date',TRUE),
                        'roster_end'    => $this->input->post('roster_end_date',TRUE),
                        'roster_dsys'   => $this->input->post('roster_days',TRUE),
                    );
                    $this->Shift_model->roster_create($postData);
                }
                $i++;
            }
            $this->session->set_flashdata('message', display('successfully_updated'));
            redirect("duty_roster/create-roster");
        } 
            
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
		return "RS".$result;
	}

    public function shift_assign_list()
	{   
        $this->permission->method('duty_roster','read')->redirect();

		$data['title']      = display('shift_assign_list');  
		$data['sftasn_datalist']   = $this->Shift_model->shiftassign_data();
		
		$data['module']     = "duty_roster";
		$data['page']       = "shift_assign_list";   
		echo Modules::run('template/layout', $data); 
	}
    public function shift_roster_list()
	{   
        $this->permission->method('duty_roster','read')->redirect();

		$data['title']      = display('assigned_roster_list');  
		$data['sftrosterlist']   = $this->Shift_model->shiftroster_data();
		$data['module']     = "duty_roster";
		$data['page']       = "shift_roster_list";   
		echo Modules::run('template/layout', $data); 
	}

    public function roster_emp_view($id)
    {
        $data['title']  	  = display('roster_list');
        $data['module'] 	  = "duty_roster";
        $data['page']         = "viewdata";
        
        $data['rstr_vdata']   = $this->Shift_model->roster_viewdata($id);
        $data['rosterempdata']= $this->Shift_model->roster_emp_data($id);
        $this->load->view('duty_roster/viewdata', $data); 

    }

    public function delete_assigned_roster($id=null){

        $this->permission->module('duty_roster','delete')->redirect();
        if($this->Shift_model->assigned_roster_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('duty_roster/roster-list');
    }

    public function shift_assign_add()
	{   
        $this->permission->method('duty_roster','read')->redirect();

		$data['title']      = display('shift_assign_add');  
		$data['roster_list'] = $this->Shift_model->roster_datalist();
        $data['emp_list']   = $this->Shift_model->emp_data();
		$data['module']     = "duty_roster";
		$data['page']       = "shift_assign_add";   
		echo Modules::run('template/layout', $data); 
	}

    public function shiftrowdata(){

        $shift_id =  $this->input->post('shift_id',TRUE);
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where('shiftid', $shift_id);
        $query=$this->db->get()->row();
        

        echo json_encode($query);
    }
    public function rosterrowdata(){

        $roster_id =  $this->input->post('roster_id',TRUE);
        $this->db->select('tbl_duty_roster.*,tbl_empwork_shift.*');
        $this->db->join('tbl_empwork_shift','tbl_empwork_shift.shiftid=tbl_duty_roster.shift_id','left');
        $this->db->from('tbl_duty_roster');
        $this->db->where('roster_id', $roster_id);
        $query=$this->db->get()->row();
        

        echo json_encode($query);
    }
    public function checkshift_data(){

        $start_date =  $this->input->post('start_date',TRUE);
        $end_date =  $this->input->post('end_date',TRUE);
        
        $this->db->select('*');
        $this->db->from('tbl_duty_roster');
        $this->db->where('roster_start >=', $start_date);
        $this->db->where('roster_end <=', $end_date);
        
        
        $query=$this->db->get()->result();
        
        
        if(!empty($query)){
            echo 1;
            
        }
        
    }
    public function checkshift_data2(){

        $start_date =  $this->input->post('start_date',TRUE);
        $end_date =  $this->input->post('end_date',TRUE);
        
        $this->db->select('*');
        $this->db->from('tbl_duty_roster');
        $this->db->where('roster_start <= ', $start_date);
        $this->db->where('roster_end  >=', $start_date);
        
        $query=$this->db->get()->result();
        
        
        if(!empty($query)){
            echo 1;
            
        }
        
    }
    public function empdatashow(){

        $roster_id =  $this->input->post('roster_id',TRUE);
        $this->db->select('*');
        $this->db->from('tbl_duty_roster');
        $this->db->where('roster_id', $roster_id);
        $query=$this->db->get()->row();

        $data['rstrt_date']   = $query->roster_start;
        $data['rend_date']    = $query->roster_end;
        $data['title']  	  = display('roster_list');
        $data['module'] 	  = "duty_roster";
        $data['page']         = "employeelistview";
        
        $data['emp_list']   = $this->Shift_model->emp_data();
        $this->load->view('duty_roster/employeelistview', $data); 
            
        
        
    }

    public function create_shift_assign()
    { 
        $data['title'] = display('shift_add');
       
        $this->form_validation->set_rules('roster_id',display('select_roster'),'max_length[150]|xss_clean');
        if ($this->form_validation->run() === true) {
            $array = array();
            $roster_id = $this->input->post('roster_id',TRUE);
            $total_emp = $this->input->post('emp_id',TRUE);

            $emp_id = $this->input->post('emp_id',TRUE);
            
            $rstr_start_date = $this->input->post('rstr_start_date',TRUE);
            $rstr_end_date = $this->input->post('rstr_end_date',TRUE);

            $rstr_start_time = $this->input->post('rstr_start_time',TRUE);
            $rstr_end_time = $this->input->post('rstr_end_time',TRUE);
            
            $firstdate = strtotime($rstr_start_date);
            $lastdate = strtotime($rstr_end_date);

            for ($i=0, $n=count($total_emp); $i < $n; $i++) {
                    
                $emp_idinp = $emp_id[$i];
                // 86400 sec = 24 hrs = 60*60*24 = 1 day
                for ($currentDate = $firstdate; $currentDate <= $lastdate; $currentDate += (86400)) {
                                                
                    $perdate = date('Y-m-d', $currentDate);
                    $data3 = array(
                        'roster_id'		        =>$roster_id,
                        'emp_id'		        =>$emp_idinp,
                        'emp_startroster_date'  =>$perdate,
                        'emp_endroster_date'    =>$perdate,
                        'emp_startroster_time'  =>$rstr_start_time,
                        'emp_endroster_time'    =>$rstr_end_time,
                       
                        
                    );
                    
                    $this->Shift_model->shift_assign_create($data3);

                }
            }
           
           
            $this->session->set_flashdata('message', display('successfully_saved'));
            redirect("duty_roster/shift-assign");
          

        } else {
            $data['title']      = display('shift_assign_list');  
            $data['sftasn_datalist']   = $this->Shift_model->shiftassign_data();
            $data['shift_list'] = $this->Shift_model->shif_data();
            $data['emp_list']   = $this->Shift_model->emp_data();
            $data['module']     = "duty_roster";
            $data['page']       = "shift_assign_list";   
            echo Modules::run('template/layout', $data); 
        }   
    }

    public function delete_shiftassign($roster_id=null, $emp_id=null){
        $this->permission->module('duty_roster','delete')->redirect();

        if($this->Shift_model->assignshift_delete($roster_id, $emp_id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('duty_roster/shift-assign');
    }

    public function update_shiftassign_form($id = null)
	{   
        
        $data['rstasninfo'] = $this->Shift_model->rstasninfodatabyid($id);
        $data['editemp_list']   = $this->Shift_model->empedit_data();
        
        $data['module']     = "duty_roster";    
        $data['page']       = "shift_assign_edit";   
        echo Modules::run('template/layout', $data); 
	}

    public function update_addsingleemproster(){
        $this->form_validation->set_rules('roster_id','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('emp_id','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_start_date','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_end_date','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_start_time','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_end_time','','required|max_length[150]|xss_clean');

		$today           = date('Y-m-d');
        $roster_id       = $this->input->post('roster_id',TRUE);
        $emp_id          = $this->input->post('emp_id',TRUE);
        $rstr_start_date = $this->input->post('rstr_start_date',TRUE);
        $rstr_end_date   = $this->input->post('rstr_end_date',TRUE);
        $rstr_start_time = $this->input->post('rstr_start_time',TRUE);
        $rstr_end_time   = $this->input->post('rstr_end_time',TRUE);

        $firstdate       = strtotime($rstr_start_date);
        $lastdate        = strtotime($rstr_end_date);
        $tomorrow        = date("Y-m-d");

        if ($rstr_start_date < $today && $rstr_end_date > $today) {
            for ($currentDate = strtotime(date("Y-m-d")); $currentDate <= $lastdate; $currentDate += (86400)) {
                                                
                $perdate = date('Y-m-d', $currentDate);
                $data3 = array(
                    'roster_id'		        =>$roster_id,
                    'emp_id'		        =>$emp_id,
                    'emp_startroster_date'  =>$perdate,
                    'emp_endroster_date'    =>$perdate,
                    'emp_startroster_time'  =>$rstr_start_time,
                    'emp_endroster_time'    =>$rstr_end_time,
                );
                
                $this->Shift_model->shift_assign_create($data3);
            }
            return true;
        }
        else {
            for ($currentDate = $firstdate; $currentDate <= $lastdate; $currentDate += (86400)) {                            
                $perdate = date('Y-m-d', $currentDate);
                $data3 = array(
                    'roster_id'		        =>$roster_id,
                    'emp_id'		        =>$emp_id,
                    'emp_startroster_date'  =>$perdate,
                    'emp_endroster_date'    =>$perdate,
                    'emp_startroster_time'  =>$rstr_start_time,
                    'emp_endroster_time'    =>$rstr_end_time,  
                );
                $this->Shift_model->shift_assign_create($data3);
            }
            return true;
        }
    }
    public function update_romovesingleemproster(){

        $this->form_validation->set_rules('roster_id','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('emp_id','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_start_date','','required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('rstr_end_date','','required|max_length[150]|xss_clean');

		$today           = date('Y-m-d');
        $roster_id       = $this->input->post('roster_id',TRUE);
        $emp_id          = $this->input->post('emp_id',TRUE);
        $rstr_start_date = $this->input->post('rstr_start_date',TRUE);
        $rstr_end_date   = $this->input->post('rstr_end_date',TRUE);

        if ($rstr_start_date <= $today && $rstr_end_date >= $today) {

            $this->db->where('roster_id',$roster_id)->where('emp_id',$emp_id)->where('emp_startroster_date >=',$today)->delete('tbl_emproster_assign');
    
            return true;
        }else {
            
            $this->db->where('roster_id',$roster_id)->where('emp_id',$emp_id)->delete('tbl_emproster_assign');
    
            return true;
        }

    }

	public function update_shiftassign($id = null)
    { 
        $data['title'] = display('update');
        $this->db->where('roster_id',$id)->delete('tbl_emproster_assign');

        $this->form_validation->set_rules('roster_id',display('select_roster'),'max_length[150]|xss_clean');
        if ($this->form_validation->run() === true) {
            $array = array();
            $roster_id = $this->input->post('roster_id',TRUE);
            $total_emp = $this->input->post('emp_id',TRUE);

            $emp_id = $this->input->post('emp_id',TRUE);
            
            $rstr_start_date = $this->input->post('rstr_start_date',TRUE);
            $rstr_end_date = $this->input->post('rstr_end_date',TRUE);
            
            $rstr_start_time = $this->input->post('rstr_start_time',TRUE);
            $rstr_end_time = $this->input->post('rstr_end_time',TRUE);
            
            $firstdate = strtotime($rstr_start_date);
            $lastdate = strtotime($rstr_end_date);

            for ($i=0, $n=count($total_emp); $i < $n; $i++) {
                    
                $emp_idinp = $emp_id[$i];
                // 86400 sec = 24 hrs = 60*60*24 = 1 day
                for ($currentDate = $firstdate; $currentDate <= $lastdate; $currentDate += (86400)) {
                                                
                    $perdate = date('Y-m-d', $currentDate);
                    $data3 = array(
                        'roster_id'		        =>	$roster_id,
                        'emp_id'		        =>	$emp_idinp,
                        'emp_startroster_date'  =>$perdate,
                        'emp_endroster_date'    =>$perdate,
                        'emp_startroster_time'  =>$rstr_start_time,
                        'emp_endroster_time'    =>$rstr_end_time,
                       
                        
                    );
                    
                    $this->Shift_model->shift_assign_create($data3);

                }
            }
           
           
            $this->session->set_flashdata('message', display('successfully_saved'));
            redirect("duty_roster/shift-assign");
          

        
        } else {
            $data['title']      = display('update');
            $data['rstasninfo'] = $this->Shift_model->rstasninfodatabyid($id);
            $data['editemp_list']   = $this->Shift_model->empedit_data();
            $data['module']     = "duty_roster";    
            $data['page']       = "shift_assign_edit";   
            echo Modules::run('template/layout', $data); 
        }      
    }

    public function attendance_dashboard()
	{   
        
        $data['title']      = display('attendance_dashboard');
        $data['module']     = "duty_roster";    
        $data['page']       = "attendance_dashboard_view";   
        echo Modules::run('template/layout', $data); 
	}

    public function loadallshift(){

        $data['cur_shlist']  = $this->Shift_model->current_shift_list();
        $data['cur_emplist'] = $this->Shift_model->current_date_emps();
        $data['module'] 	 = "duty_roster";
        $data['page']        = "attenshift_view";
        
        $this->load->view('duty_roster/attenshift_view', $data); 
            
    }
    public function load_clkshftemp(){

        $clk_shiftid = $this->input->post('clk_shiftid',TRUE);
        $clickdate = $this->input->post('clickdate',TRUE);
        $data['clsh_datalist']= $this->Shift_model->click_shift_data($clk_shiftid, $clickdate);
        $data['clkcngdate'] 	 = $clickdate;
        $data['module'] 	 = "duty_roster";
        $data['page']        = "clsh_data_view";

        $this->load->view('duty_roster/clsh_data_view', $data); 
            
    }
    public function loadcngdate(){
		$crdate = date("Y-m-d");

        $cndate = $this->input->post('cndate',TRUE);
        $data['cng_shlist']  = $this->Shift_model->cndate_shift_list($cndate);
        $data['cuuentshiftid'] = $this->Shift_model->cuuentshiftid();
        if ($crdate == $cndate) {
            
            $data['cng_emplist'] = $this->Shift_model->cng_date_currstr_emps($cndate);
        }else {
            $data['cng_emplist'] = $this->Shift_model->cng_date_emps($cndate);
            
        }
        $data['change_date'] = $cndate;
        $data['module'] 	 = "duty_roster";
        $data['page']        = "cngdate_view";

        $this->load->view('duty_roster/cngdate_view', $data); 
            
    }

    public function updtempshift_frm($id, $cldate){
        
        $data['emp_id'] = $id;  
        $data['clk_date'] = $cldate;  
        $data['module'] = "duty_roster";  
        $data['page']   = "empshift_edit";
		$this->load->view('duty_roster/empshift_edit', $data);   
    }

    public function load_checkedshift(){

        $chksh_id =  $this->input->post('chksh_id',TRUE);
        $this->db->select('*');
        $this->db->from('tbl_empwork_shift');
        $this->db->where('shiftid', $chksh_id);
        $query=$this->db->get()->row();
        

        echo json_encode($query);
    }

    public function emp_shift_update($id = null)
    { 
        $this->form_validation->set_rules('sftasnid',' ','required|xss_clean');
        $this->form_validation->set_rules('roster_id', ' ','required|xss_clean');
        $this->form_validation->set_rules('emp_id',' ','required|xss_clean');
        $this->form_validation->set_rules('emp_startroster_date',' ','required|xss_clean');
        $this->form_validation->set_rules('emp_endroster_date',' ','required|xss_clean');
        $this->form_validation->set_rules('emp_startroster_time',' ','required|xss_clean');
        $this->form_validation->set_rules('emp_endroster_time',' ','required|xss_clean');

        if ($this->form_validation->run() === true) {

            $Data = array(   
            
            'sftasnid'              => $this->input->post('sftasnid',TRUE),
            'roster_id'             => $this->input->post('roster_id',TRUE),
            'emp_id'                => $this->input->post('emp_id',TRUE),
            'emp_startroster_date'  => $this->input->post('emp_startroster_date',TRUE),
            'emp_endroster_date'    => $this->input->post('emp_endroster_date',TRUE),
            'emp_startroster_time'  => $this->input->post('emp_startroster_time',TRUE),
            'emp_endroster_time'    => $this->input->post('emp_endroster_time',TRUE),
            'is_edited'             => 1,
            );  
            

            if ($this->Shift_model->emp_data_shift_update($Data)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("duty_roster/attendance-dashboard");



        } else {
            redirect("duty_roster/attendance-dashboard"); 
        }      
    }

    public function load_checkedroster(){

        $chksh_id =  $this->input->post('chksh_id',TRUE);
        $cng_date =  $this->input->post('cng_date',TRUE);
        $this->db->select('*');
        $this->db->from('tbl_duty_roster');
        $this->db->where('roster_start <=', $cng_date);
        $this->db->where('roster_end >=', $cng_date);
        $this->db->where('shift_id', $chksh_id);
        $query=$this->db->get()->row();
    
        echo json_encode($query); 
    }

     

}
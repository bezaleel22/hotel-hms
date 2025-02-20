<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'housekeeping_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('house_keeping','read')->redirect();
        $data['title']    = display('ehecklist_list'); 
        $data["roomsizelist"] = $this->housekeeping_model->read();		
		if(!empty($id)) {
		$data['title'] = display('ehecklist_edit');
		$data['intinfo']   = $this->housekeeping_model->findId($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "house_keeping";
        $data['page']   = "checklist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('ehecklist_add');
	  $this->form_validation->set_rules('task_name',display('task_name'),'required|xss_clean');
	  $this->form_validation->set_rules('type',display('type'),'required|xss_clean');
	  $saveid=$this->input->post('checklist_id', TRUE);
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('checklist_id', TRUE))) {
		 $data['house_keeping']   = (Object) $postData = array(
		   'taskname' 	         => $this->input->post('task_name',TRUE),
		   'type' 	         => $this->input->post('type',TRUE),
		   'status'				=>1,
		  );
		$this->permission->method('house_keeping','create')->redirect();
		if ($this->db->insert('tbl_checklist',$postData)) { 
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('house_keeping/checklist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("house_keeping/checklist"); 
	
	   } else {
		$this->permission->method('house_keeping','update')->redirect();
		$data['house_keeping']   = (Object) $postData = array(
		     'checklist_id'     	        => $this->input->post('checklist_id', TRUE),
		     'taskname' 	         => $this->input->post('task_name',TRUE),
			 'type' 	         => $this->input->post('type',TRUE),
		  );
	 
		if ($this->db->where('checklist_id',$postData['checklist_id'])->update('tbl_checklist', $postData)) { 
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("house_keeping/checklist");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('ehecklist_edit');
		$data['intinfo']   = $this->housekeeping_model->findId($id);
		$data['module'] = "house_keeping";
		$data['page']   = "checklist_edit";   
		echo Modules::run('template/layout', $data);
	   }else{	   
	   $data['module'] = "house_keeping";
	   $data['page']   = "checklist";   
	   echo Modules::run('template/layout', $data); 
	   }
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('house_keeping','update')->redirect();
		$data['title'] = display('ehecklist_edit');
		$data['intinfo']   = $this->housekeeping_model->findId($id);
        $data['module'] = "house_keeping";  
        $data['page']   = "checklistedit";
		$this->load->view('house_keeping/checklistedit', $data);   
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('house_keeping','delete')->redirect();
		
		if ($this->housekeeping_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('house_keeping/checklist');
    }
 
}

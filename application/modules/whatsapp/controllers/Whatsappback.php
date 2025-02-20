<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsappback extends MX_Controller {
    public $version='';
    public function __construct()
    {
        parent::__construct();
       
        $this->load->model(array(
            
            'whatsapp/whatsapp_model',
           
        ));
       $this->version=1;
    }
    public function showsetting(){
    	$data['title'] = display('whatsapp_chat');
	  #-------------------------------#
    	$whatsapp_settings = $this->whatsapp_model->show_api();
	  $this->form_validation->set_rules('whats_phone', display('whatsapp_phone_numer')  ,'required|max_length[100]');
	
	 
	  if ($this->form_validation->run()) { 
	  	  (Object) $postData = [
	            'whatsapp_number'     	=> $this->input->post('whats_phone',true),
				'chatenable'     		=> $this->input->post('ischatenable',true),
				'orderenable'     		=> $this->input->post('isordering',true),
	   
	  ];
	  
	  $settingData = [
	            'whatsapp_number'     	=> $this->input->post('whats_phone',true),
	   
	  ];
	  	
	  	if(!$whatsapp_settings){
	  		$this->whatsapp_model->insert_data('whatsapp_settings', $postData);
	  		$this->whatsapp_model->update_data('setting',2,$settingData);
	  	}
	  	else{
	  	$this->whatsapp_model->update_data('whatsapp_settings',$whatsapp_settings->id,$postData);
	  	$this->whatsapp_model->update_data('setting',2,$settingData);
	  	}
	  	redirect("whatsapp/whatsappback/showsetting");
	  	
	  }
	  else{
    	
	   $data['whatsapp']   = $whatsapp_settings;
       $data['module'] = "whatsapp";
	   $data['page']   = "back/add_setting";   
	   echo Modules::run('template/layout', $data);
	   }
    }
 
    
    
}

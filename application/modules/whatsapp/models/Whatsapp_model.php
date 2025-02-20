<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Whatsapp_model extends CI_Model{ 
        
  
    public function __construct()
    {
        parent::__construct();
    }

   public function show_api()
   {
    $result = $this->db->get('whatsapp_settings')->row();
        return $result;

   }


    public function insert_data($table, $data)
    {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
    public function update_data($table,$id,$data = array())
      {
    return $this->db->where('id',$id)
      ->update($table, $data);
      }

    

     
}
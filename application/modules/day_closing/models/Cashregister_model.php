<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Cashregister_model extends CI_Model{ 
        
  
    public function __construct()
    {
        parent::__construct();
    }
    public function addopeningcash($data = array())
    {	 
      return $this->db->insert('tbl_cashregister',$data);
    } 
    public function closeresister($data = array()){
        return $this->db->where('id',$data["id"])->update('tbl_cashregister', $data);
    }
    public function collectcash($id,$tdate){
      $crdate=date('Y-m-d H:i:s');
      $where="acc_transaction.CreateDate Between '$tdate' AND '$crdate'";
      $this->db->select('acc_transaction.COAID,SUM(acc_transaction.Debit) as recieved,SUM(acc_transaction.Credit) as expense,SUM(acc_transaction.Debit-acc_transaction.Credit) as totalamount,acc_coa.HeadName');
          $this->db->from('acc_transaction');
      $this->db->join('acc_coa','acc_coa.HeadCode=acc_transaction.COAID','left');
      $this->db->where('acc_transaction.CreateBy',$id);
      $this->db->where($where);
      $this->db->where('acc_transaction.IsAppove',1);
      $this->db->like('acc_transaction.COAID','10201');
      $this->db->group_by('acc_transaction.COAID');
      $query = $this->db->get();
      return $orderdetails=$query->result();
      }
    public function createcounter($data = array())
    {	 
      return $this->db->insert('tbl_cashcounter',$data);
    }
    public function updatecounter($data = array()){
      return $this->db->where('ccid',$data["ccid"])->update('tbl_cashcounter', $data);
     }
     public function cashregister(){
			$start_date= $this->input->post('from_date');
			$end_date= $this->input->post('to_date');
			$uid= $this->input->post('user');
			$counter= $this->input->post('counter');
			$dateRange = "tbl_cashregister.openclosedate BETWEEN '$start_date' AND '$end_date'";
			
			$this->db->select("tbl_cashregister.*,user.firstname,user.lastname");
			$this->db->from('tbl_cashregister');
			$this->db->join('user','user.id=tbl_cashregister.userid','left');
			if($start_date!=''){
			$this->db->where($dateRange);
			}
			if($uid!=''){
				$this->db->where('tbl_cashregister.userid',$uid);
				}
			if($counter!=''){
				$this->db->where('tbl_cashregister.counter_no',$counter);
				}
			$this->db->where('tbl_cashregister.status',1);
			$query = $this->db->get();
		
			return $query->result();
		}
	public function cashregisterbill($start,$end,$uid){
		    $dateRange = "IsAppove=1 AND CreateDate BETWEEN '$start' AND '$end' AND CreateBy=$uid";
			$this->db->select("acc_transaction.VNo,acc_transaction.Debit,acc_transaction.Credit");
			$this->db->from('acc_transaction');
			$this->db->where($dateRange);
      $this->db->order_by("acc_transaction.ID","ASC");
      $this->db->like('acc_transaction.COAID','10201');
			$query = $this->db->get();
			$result = $query->result();
      return $result;
		}
    public function settinginfo()
    { 
      return $this->db->select("*")->from('setting')
        ->get()
        ->row();
    }
}
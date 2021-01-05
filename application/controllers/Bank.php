<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MY_Controller{

  public function index(){
  	$query = $this->db->query("SELECT * FROM schools 
  	left join users on schools.owner_id = users.userId 
  	left join district on schools.district_id = district.districtId 
  	where owner_id = '".$_SESSION['userId']."'");
    $data['data'] = $query->result_array(); 
    // echo "<pre>"; print_r($data);exit();
	$this->load->view('school/bankReceipt', $data);	 
  }
}
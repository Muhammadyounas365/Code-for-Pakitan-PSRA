<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Admin_Controller
// MY_Controller
class Ajax extends MY_Controller {
	
	public function __construct(){

        parent::__construct();
		$this->load->model('user_m');
		// $this->output->enable_profiler(TRUE);
	}
	public function check_if_username_exist()
{
	if(!isset($_POST['username']) || empty($_POST['username']))
			{
			echo '0'; exit;
			}
			else
			{
				$username=$this->input->post('username');
				$result=$this->db->where('username',$username)->get('users')->row();
				if(count($result))
				{
					echo '1';exit;
				}
				else
				{
					echo '0';exit;
				}
			}
}
}
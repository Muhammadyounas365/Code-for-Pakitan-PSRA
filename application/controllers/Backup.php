<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backup extends Admin_Controller {
/*
| -----------------------------------------------------
	| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
			| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
			| EMAIL:			info@inilabs.net
| -----------------------------------------------------
		| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
			| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	function __construct() {
		parent::__construct();
		

        $this->load->model("user_m");

		
	}
	public function index() {
		if ($_POST) {
			    ini_set('memory_limit', '-1');
				$this->load->dbutil();
				$prefs = array(
					'format'        => 'zip',
		'filename'    => 'mybackup.sql'
		);
				$backup = $this->dbutil->backup($prefs);
				$this->load->helper('download');
				force_download('mybackup.zip', $backup);
				redirect(base_url('backup/index'));
			
		} else {
        $this->data['title'] = 'Database Backup';
        $this->data['description'] = 'here you can backup your database easily.';
		$this->data["view"] = "backup/index";
		$this->load->view('layout', $this->data);
		}
	}
}
/* End of file backup.php */
/* Location: .//var/www/html/schoolv2/mvc/controllers/backup.php */
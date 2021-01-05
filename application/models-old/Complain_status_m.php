<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class complain_status_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "complain_process_status";
        $this->pk = "statusId";
        $this->status = "status";
    }
    //-----------------------------------------------------------
    
}
<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class districts_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "district";
        $this->pk = "districtId";
        $this->status = "status";
    }
    //-----------------------------------------------------------
    
}
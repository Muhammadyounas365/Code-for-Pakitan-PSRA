<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class complain_type_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "complain_type";
        $this->pk = "complainTypeId";
        $this->status = "status";
    }
    //-----------------------------------------------------------
    
}
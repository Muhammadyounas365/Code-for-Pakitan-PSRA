<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class age_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "age";
        $this->pk = "ageId";
        $this->status = "status";
    }
    //-----------------------------------------------------------
    
}
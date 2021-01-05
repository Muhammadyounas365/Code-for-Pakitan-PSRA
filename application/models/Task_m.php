<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Task_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "task";
        $this->pk = "task_id";
    }

    
    
    public function get($id = NULL){
        
        if($id != NULL){
            $this->db->where($this->pk, $id);
            $query = $this->db->get($this->table);
            return $query->row();
        }else{
            $query = $this->db->get($this->table);
            return $query->result();
        }
    }
		
	   /* run a custom query */
    public function runQuery($query){
        $query= $this->db->query($query);
        return $query->result();
    }
    //-------------------------------------------------
	
    
    

     
    
    
    /**
     * function to insert new data to a table
     * if $id is provieded it will edit that recored
     * @param $data array of field values pair
     * @param $id integer id of the record
     */
    public function save($data, $id = NULL){
        
        if($id != NULL){
            $this->db->set($data);
            $this->db->where($this->pk, $id);
            $this->db->update($this->table);
        }else{
            $this->db->set($data);
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
			
        }
        return $id;
    }
    //----------------------------------------------------
    
    
    
   
	public function delete($condition){
        
        if(!$condition){
            return false;
        }
       
	    $this->db->where($condition);
        $this->db->delete($this->table);
        return true;
    }
	
    
    /**
     * function to get a specific column from a table
     * @param $col string column name
     * @param $id integer id of the record
     * @return $col_val mixed value of the column
     */
    public function getCol($col, $id){
        
        $id = (int) $id;
        $this->db->select($col);
        $this->db->from($this->table);
        $this->db->where($this->pk, $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $obj = $query->row();
        return $obj->$col;
    }
    //-----------------------------------------------------
    
}
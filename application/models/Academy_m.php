<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Academy_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "roles";
        $this->pk = "role_id";
        $this->status = "status";
    }
    //-----------------------------------------------------------
    
    
    /**
     * function to get list of all roles and joining it with 
     * modules for homepage name
     */
    public function get_academies($limit, $offset){
        
       
        
        $query = "

       SELECT
                    
                    `tuition_academy_info`.academy_id
                    , `tuition_academy_info`.`academy_name`
                    , `tuition_academy_info`.`registration_number`
                    , `tuition_academy_info`.`establishment_year`
                    , `tuition_academy_info`.`district_id`
                    , `tuition_academy_info`.`tehsil_id`
                    , `tuition_academy_info`.`uc_id`
                    , `tuition_academy_info`.`postal_address`
                    , `tuition_academy_info`.`location`
                    , `tuition_academy_info`.`telePhoneNumber`
                    
                   
                    
                    
                    
                    , `tuition_academy_info`.`owner_id`
                    
                   
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                    
                    
                FROM
                    `tuition_academy_info`
                    
                    LEFT JOIN `district` 
                        ON (`tuition_academy_info`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`tuition_academy_info`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`tuition_academy_info`.`uc_id` = `uc`.`ucId`)
                    LEFT JOIN `genderofschool` 
                        ON (`tuition_academy_info`.`gender_of_academy` = `genderofschool`.`genderOfschoolId`)
                   
                   
                         ORDER BY `tuition_academy_info`.academy_id DESC LIMIT $limit OFFSET $offset;";
                        $query = $this->db->query($query);
                        return $query->result();
    }

    public function get_academies_by_search_criteria($academy_id=0, $matchString, $district_id, $tehsil_id){
            if($district_id == '0')
            {
                $condition = "WHERE  `tuition_academy_info`.`academy_name` LIKE '%$matchString%' group by tuition_academy_info.academy_id limit 30"; 
            }
            elseif($tehsil_id == '0')
            {
                $condition = "WHERE `tuition_academy_info`.`district_id` = $district_id AND `tuition_academy_info`.`academy_name` LIKE '%$matchString%' group by tuition_academy_info.academy_id limit 30";
            }
            elseif(!empty($district_id) && !empty($tehsil_id)){
                $condition = "WHERE `tuition_academy_info`.`district_id` = $district_id AND `tuition_academy_info`.`tehsil_id` = $tehsil_id AND `tuition_academy_info`.`academy_name` LIKE '%$matchString%' group by tuition_academy_info.academy_id limit 30"; 
            }
            
            else{
                $condition = "WHERE `tuition_academy_info`.`academy_id`= $academy_id group by tuition_academy_info.academy_id";
            }
            //echo $condition;exit;
        $query = " SELECT
                    
                    `tuition_academy_info`.academy_id
                    , `tuition_academy_info`.`academy_name`
                    , `tuition_academy_info`.`registration_number`
                    , `tuition_academy_info`.`establishment_year`
                    , `tuition_academy_info`.`district_id`
                    , `tuition_academy_info`.`tehsil_id`
                    , `tuition_academy_info`.`uc_id`
                    , `tuition_academy_info`.`postal_address`
                    , `tuition_academy_info`.`location`
                    , `tuition_academy_info`.`telePhoneNumber`
                    
                   
                    
                    
                    
                    , `tuition_academy_info`.`owner_id`
                    
                   
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                    
                    
                FROM
                    `tuition_academy_info`
                    
                    LEFT JOIN `district` 
                        ON (`tuition_academy_info`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`tuition_academy_info`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`tuition_academy_info`.`uc_id` = `uc`.`ucId`)
                    LEFT JOIN `genderofschool` 
                        ON (`tuition_academy_info`.`gender_of_academy` = `genderofschool`.`genderOfschoolId`)
       
                        $condition ;";
                  
                
                        $query = $this->db->query($query);
                        return $query->result();
    }
}
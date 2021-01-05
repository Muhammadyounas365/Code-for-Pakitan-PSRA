<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class school_m extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "school";
        $this->pk = "schoolId";
        $this->status = "status";
    }
    //-----------------------------------------------------------

    // this function will grab all the data from master table "schools"
    public function get_schools_list($limit, $offset){
        $district_id = $this->session->userdata('district_id');
        $condition = '';
        if($this->session->userdata('role_id') == 16 ){
            $condition = "WHERE `schools`.`district_id`='".$district_id."'";
        }
        $query = "

          SELECT
                    `schools`.`reg_type_id`
                    ,`schools`.`isfined`
                    , `schools`.`schoolId`
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                    , `schools`.`district_id`
                    , `schools`.`tehsil_id`
                    , `schools`.`uc_id`
                    , `schools`.`address`
                    , `schools`.`location`
                    , `schools`.`telePhoneNumber`
                    , `schools`.`schoolMobileNumber`
                    , `schools`.`status`
                    , `schools`.`createdBy`
                    , `schools`.`gender_type_id`
                    , `schools`.`school_type_id`
                    , `schools`.`schoolTypeOther`
                    , `schools`.`owner_id`
                    , `schools`.`ppcCode`
                    , `schools`.`schoolId`
                    , `reg_type`.`regTypeTitle`
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                    , `schools`.`school_type_id`
                    ,`levelofinstitute`.`levelofInstituteTitle`
                    , `school_type`.`typeTitle`
                FROM
                    `schools`
                    LEFT JOIN `reg_type` 
                        ON (`schools`.`reg_type_id` = `reg_type`.`regTypeId`)
                    LEFT JOIN `district` 
                        ON (`schools`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`schools`.`uc_id` = `uc`.`ucId`)
                    LEFT JOIN `genderofschool` 
                        ON (`schools`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                    LEFT JOIN `levelofinstitute` 
                        ON (`schools`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                    LEFT JOIN `school_type` 
                        ON (`schools`.`school_type_id` = `school_type`.`typeId`)
                        $condition ORDER BY `schools`.`schoolId` DESC LIMIT $limit OFFSET $offset;";
                        $query = $this->db->query($query);
                        return $query->result();
    }

    public function schools_has_no_registration_number($limit, $offset){

            $condition = "where schools.registrationNumber in('',0) group by schools.schoolId";
        $query = "  SELECT 
                  
                     `schools`.`reg_type_id`
                    ,`schools`.`isfined`
                    
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                    ,schools.telePhoneNumber
                    ,schools.schoolMobileNumber
                    , `schools`.`address`
                    
                   
                   
                     ,school.schoolId as id
                    , `schools`.`schoolId`
                    , `reg_type`.`regTypeTitle`
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                    
                    ,`levelofinstitute`.`levelofInstituteTitle`
                    , `schools`.`biseregistrationNumber`
                    ,session_year.sessionYearTitle
                    ,`levelofinstitute`.`upper_class`
                    
                    ,(select class.classTitle from age_and_class inner join class on age_and_class.class_id=class.classId where age_and_class.class_id=(select MIN(age_and_class.class_id) from age_and_class where age_and_class.school_id=id) limit 1) as classTitle
                   
                    
                    
                    


FROM `schools` 
inner join school 
on schools.schoolId=school.schools_id


LEFT JOIN `reg_type` 
                        ON (`school`.`reg_type_id` = `reg_type`.`regTypeId`)
                    LEFT JOIN `levelofinstitute` 
                        ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                     LEFT JOIN `genderofschool` 
                        ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                    
                    LEFT JOIN `school_type` 
                        ON (`school`.`school_type_id` = `school_type`.`typeId`)
                         LEFT JOIN `session_year` 
                        ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    
                    
                    LEFT JOIN `district` 
                        ON (`schools`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`schools`.`uc_id` = `uc`.`ucId`)
                   
                        $condition LIMIT $limit OFFSET $offset;";
                        $query = $this->db->query($query);
                        //var_dump($query->result());exit;
                        return $query->result();
    }

    ///////////////////////////////////////
    public function schools_has_no_renewal_number($limit, $offset){
            
        $this->db->where('setting_name','next');
        $query=$this->db->get("session_setting");
        
        $next_session= $query->row()->session_id;

        //////////////////////////
            $condition = "WHERE `schools`.`registrationNumber` not in('',0) and school.status=2  ORDER BY `school`.`updatedDate` DESC";
        $query = "  SELECT
                    `school`.`schoolId` as school_session_id
                    ,`school`.`status`
                    ,`school`.`updatedDate`
                    ,`school`.`session_year_id`
                    ,`session_year`.`sessionYearTitle`
                    , `schools`.`schoolId`
                    ,`schools`.`isfined`
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                    , `schools`.`biseregistrationNumber`
                    , `schools`.`address`
                   
                   
                    
                   
                    , `schools`.`schoolId`
                    , `reg_type`.`regTypeTitle`
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                   
                    ,`levelofinstitute`.`levelofInstituteTitle`
                    , `school_type`.`typeTitle`
                    ,`levelofinstitute`.`upper_class`
                    
                    ,(select class.classTitle from age_and_class inner join class on age_and_class.class_id=class.classId where age_and_class.class_id=(select MIN(age_and_class.class_id) from age_and_class where age_and_class.school_id=school_session_id) limit 1) as classTitle
                FROM
                    `schools`
                   
                   
                     INNER JOIN `school` 
                        ON (`schools`.`schoolId` = `school`.`schools_id`)
                      LEFT JOIN `reg_type` 
                        ON (`school`.`reg_type_id` = `reg_type`.`regTypeId`)
                    LEFT JOIN `genderofschool` 
                        ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                    LEFT JOIN `levelofinstitute` 
                        ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                    LEFT JOIN `school_type` 
                        ON (`school`.`school_type_id` = `school_type`.`typeId`)
                   
                    LEFT JOIN `session_year` 
                        ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                     LEFT JOIN `district` 
                        ON (`schools`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`schools`.`uc_id` = `uc`.`ucId`)
                        $condition LIMIT $limit OFFSET $offset;";
                        $query = $this->db->query($query);
                        return $query->result();
    }

    public function get_single_school_from_schools_by_id_m($schools_id, $matchString, $district_id, $tehsil_id){
            if($district_id == '0')
            {
                $condition = "WHERE  `schools`.`schoolName` LIKE '%$matchString%' group by schools.schoolId limit 30"; 
            }
            elseif($tehsil_id == '0')
            {
                $condition = "WHERE `schools`.`district_id` = $district_id AND `schools`.`schoolName` LIKE '%$matchString%' group by schools.schoolId limit 30";
            }
            elseif(!empty($district_id) && !empty($tehsil_id)){
                $condition = "WHERE `schools`.`district_id` = $district_id AND `schools`.`tehsil_id` = $tehsil_id AND `schools`.`schoolName` LIKE '%$matchString%' group by schools.schoolId limit 30"; 
            }
            
            else{
                $condition = "WHERE `schools`.`schoolId`= $schools_id group by schools.schoolId";
            }
            //echo $condition;exit;
        $query = " SELECT 
                  
                     `schools`.`reg_type_id`
                    ,`schools`.`isfined`
                    , `schools`.`schoolId`
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                    ,schools.telePhoneNumber
                    ,schools.schoolMobileNumber
                    , `schools`.`address`
                    
                   
                   
                     ,school.schoolId as id
                    , `schools`.`schoolId`
                    , `reg_type`.`regTypeTitle`
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                    
                    ,`levelofinstitute`.`levelofInstituteTitle`
                    , `schools`.`biseregistrationNumber`
                    ,session_year.sessionYearTitle
                    ,`levelofinstitute`.`upper_class`
                    
                    
                   
                    
                    ,(select class.classTitle from age_and_class inner join class on age_and_class.class_id=class.classId where age_and_class.class_id=(select MIN(age_and_class.class_id) from age_and_class where age_and_class.school_id=id) limit 1) as classTitle
                    


FROM `schools` 
inner join school 
on schools.schoolId=school.schools_id


LEFT JOIN `reg_type` 
                        ON (`school`.`reg_type_id` = `reg_type`.`regTypeId`)
                    LEFT JOIN `levelofinstitute` 
                        ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                     LEFT JOIN `genderofschool` 
                        ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                    
                    LEFT JOIN `school_type` 
                        ON (`school`.`school_type_id` = `school_type`.`typeId`)
                         LEFT JOIN `session_year` 
                        ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    
                    
                    LEFT JOIN `district` 
                        ON (`schools`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`schools`.`uc_id` = `uc`.`ucId`)
       
                        $condition ;";
                  
                
                        $query = $this->db->query($query);
                        return $query->result();
    }

    public function get_single_school_for_renewal_by_id_m($schools_id, $matchString, $district_id, $tehsil_id){
        $this->db->where('setting_name','next');
        $query=$this->db->get("session_setting");
        
        $next_session= $query->row()->session_id;
            if($district_id == '0')
            {
                $condition = "WHERE  `schools`.`schoolName` LIKE '%$matchString%' and `schools`.`registrationNumber` not in('',0)  ORDER BY `schools`.`schoolName` ASC"; 
            }
            elseif($tehsil_id == '0')
            {
                $condition = "WHERE `schools`.`district_id` = $district_id AND `schools`.`schoolName` LIKE '%$matchString%' and `schools`.`registrationNumber` not in('',0)   ORDER BY `schools`.`schoolName` ASC";
            }
            elseif(!empty($district_id) && !empty($tehsil_id)){
                $condition = "WHERE `schools`.`district_id` = $district_id AND `schools`.`tehsil_id` = $tehsil_id AND `schools`.`schoolName` LIKE '%$matchString%' and `schools`.`registrationNumber` not in('',0)   ORDER BY `schools`.`schoolName` ASC"; 
            }
            
            else{
                $condition = "WHERE `schools`.`schoolId`= $schools_id and `schools`.`registrationNumber` not in('',0)   ORDER BY `schools`.`schoolName` ASC";
            }
            //echo $condition;exit;
        

        //////////////////////////
            // $condition = "WHERE and `schools`.`registrationNumber` not in('',0) and school.status=2 and session_year_id=$next_session ORDER BY `schools`.`schoolName` ASC";
        $query = "  SELECT
                    `school`.`schoolId` as school_session_id
                    ,`school`.`status`
                    ,`school`.`session_year_id`
                    ,`session_year`.`sessionYearTitle`
                    , `schools`.`schoolId`
                    , `schools`.`isfined`
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                     , `schools`.`biseregistrationNumber`
                    , `schools`.`address`
                   
                   
                    
                   
                    , `schools`.`schoolId`
                    , `reg_type`.`regTypeTitle`
                    , `district`.`districtTitle`
                    , `tehsils`.`tehsilTitle`
                    , `uc`.`ucTitle`
                    , `genderofschool`.`genderOfSchoolTitle`
                   
                    ,`levelofinstitute`.`levelofInstituteTitle`
                    , `school_type`.`typeTitle`
                    ,`levelofinstitute`.`upper_class`
                    
                    ,(select class.classTitle from age_and_class inner join class on age_and_class.class_id=class.classId where age_and_class.class_id=(select MIN(age_and_class.class_id) from age_and_class where age_and_class.school_id=school_session_id) limit 1) as classTitle
                FROM
                    `schools`
                   
                   
                     INNER JOIN `school` 
                        ON (`schools`.`schoolId` = `school`.`schools_id`)
                      LEFT JOIN `reg_type` 
                        ON (`school`.`reg_type_id` = `reg_type`.`regTypeId`)
                    LEFT JOIN `genderofschool` 
                        ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                    LEFT JOIN `levelofinstitute` 
                        ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                    LEFT JOIN `school_type` 
                        ON (`school`.`school_type_id` = `school_type`.`typeId`)
                   
                    LEFT JOIN `session_year` 
                        ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                     LEFT JOIN `district` 
                        ON (`schools`.`district_id` = `district`.`districtId`)
                    LEFT JOIN `tehsils` 
                        ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                    LEFT JOIN `uc` 
                        ON (`schools`.`uc_id` = `uc`.`ucId`)
                        $condition limit 30;";
                        $query = $this->db->query($query);
                        return $query->result();
    }

    public function explore_schools_by_school_id_m($school_id){
        // if($this->session->userdata('role_id') != 16 || $this->session->userdata('role_id') != 14){
            $schools_id_colummn = 'school.schoolId';
        // }else{
        //     $schools_id_colummn = 'school.schools_id';
        // }
        
        $query = "SELECT
            `schools`.`schoolId`
            , `school`.`schools_id`
            , `school`.`status`
            , `schools`.`reg_type_id`
            , `reg_type`.`regTypeTitle`
            , `schools`.`schoolName`
            , `schools`.`yearOfEstiblishment`
            , `schools`.`telePhoneNumber`
            , `schools`.`district_id`
            , `district`.`districtTitle`
            , `tehsils`.`tehsilTitle`
            , `uc`.`ucTitle`
            , `schools`.`uc_id`
            , `schools`.`address`
            , `schools`.`location`
            , `schools`.`late`
            , `schools`.`longitude`
            , `genderofschool`.`genderOfSchoolTitle`
            , `schools`.`gender_type_id`
            , `school_type`.`typeTitle`
            , `levelofinstitute`.`levelofInstituteTitle`
            , `school`.`level_of_school_id`
            , `schools`.`schoolTypeOther`
            , `schools`.`ppcName`
            , `schools`.`ppcCode`
            , `schools`.`mediumOfInstruction`
            , `schools`.`biseRegister`
            , `schools`.`registrationNumber`
            , `schools`.`biseregistrationNumber`
            , `schools`.`primaryRegDate`
            , `schools`.`middleRegDate`
            , `schools`.`highRegDate`
            , `schools`.`interRegDate`
            , `schools`.`biseAffiliated`
            , `schools`.`bise_id`
            , `bise`.`biseName`
            , `schools`.`otherBiseName`
            , `schools`.`management_id`
            , `management`.`managementTitle`
            , `session_year`.`sessionYearTitle`
            
        FROM
            `schools`
            LEFT JOIN `school` 
                ON ( `school`.`schools_id` = `schools`.`schoolId` )
            LEFT JOIN `levelofinstitute` 
                ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
            LEFT JOIN `bank_account` 
                ON (`schools`.`schoolId` = `bank_account`.`school_id`)
            LEFT JOIN `reg_type` 
                ON (`school`.`reg_type_id` = `reg_type`.`regTypeId`)
            LEFT JOIN `district` 
                ON (`schools`.`district_id` = `district`.`districtId`)
            LEFT JOIN `tehsils` 
                ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
            LEFT JOIN `uc` 
                ON (`schools`.`uc_id` = `uc`.`ucId`)
            LEFT JOIN `genderofschool` 
                ON (`schools`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
            LEFT JOIN `school_type` 
                ON (`schools`.`school_type_id` = `school_type`.`typeId`)
            
            LEFT JOIN `bise` 
                ON (`schools`.`bise_id` = `bise`.`biseId`)
            LEFT JOIN `management` 
                ON (`schools`.`management_id` = `management`.`managementId`)
            LEFT JOIN `session_year` 
                ON (`session_year`.`sessionYearId` = `school`.`session_year_id`)
                WHERE $schools_id_colummn = '".$school_id."';";
                $query = $this->db->query($query);
                return $query->result()[0];
    }

    public function get_age_and_class_by_school_id($school_id)
    {
        $age_and_class_query = "SELECT
                  `age_and_class`.`ageAndClassId`
                  , `age_and_class`.`age_id`
                  , `age`.`ageTitle`
                  , `age_and_class`.`class_id`
                  , `class`.`classTitle`
                  , `age_and_class`.`enrolled`
                  , `age_and_class`.`gender_id`
                  , `student_gender`.`studentGenderTitle`
                  , `age_and_class`.`school_id`
                  , `age_and_class`.`total`
              FROM
                  `age_and_class`
                  LEFT JOIN `age` 
                      ON (`age_and_class`.`age_id` = `age`.`ageId`)
                  LEFT JOIN `class` 
                      ON (`age_and_class`.`class_id` = `class`.`classId`)
                  LEFT JOIN `student_gender` 
                      ON (`age_and_class`.`gender_id` = `student_gender`.`studentGenderId`)
                    WHERE `age_and_class`.`school_id` = '".$school_id."' ORDER BY `age_and_class`.`class_id` ASC;";
                    $query = $this->db->query($age_and_class_query);
                    return $query->result();
                    // echo "<pre>";
                    // var_dump($query->result());
                    // exit;
    }
    public function get_bank_by_school_id($school_id)
    {
        $bank_query = "SELECT
                        `bankAccountId`
                        , `bankAccountNumber`
                        , `bankAccountName`
                        , `bankBranchCode`
                        , `bankBranchAddress`
                        , `accountTitle`
                        , `school_id`
                    FROM
                        `bank_account`
                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($bank_query);
                    return $query->result();
    }

    public function get_library_books_by_school_id($school_id)
    {
        $library_query = "SELECT
                        `school_library`.`schoolLibraryId`
                        , `school_library`.`book_type_id`
                        , `book_type`.`bookType`
                        , `school_library`.`numberOfBooks`
                        , `school_library`.`school_id`
                    FROM
                        `school_library`
                        INNER JOIN `book_type` 
                            ON (`school_library`.`book_type_id` = `book_type`.`bookTypeId`)
                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($library_query);
                    return $query->result();
    }

    public function physical_facilities_by_school_id($school_id)
    {
        $physical_facilities_query = "SELECT
                            `physical_facilities`.`physicalFacilityId`
                            , `physical_facilities`.`building_id`
                            , `physical_building`.`physicalBuildingTitle`
                            , `physical_facilities`.`numberOfClassRoom`
                            , `physical_facilities`.`numberOfOtherRoom`
                            , `physical_facilities`.`totalArea`
                            , `physical_facilities`.`coveredArea`
                            , `physical_facilities`.`numberOfComputer`
                            , `physical_facilities`.`numberOfLatrines`
                            , `physical_facilities`.`school_id`
                        FROM
                            `physical_facilities`
                            LEFT JOIN `physical_building` 
                                ON (`physical_facilities`.`building_id` = `physical_building`.`physicalBuildingId`)
                                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($physical_facilities_query);
                    return $query->row();

    }

    public function physical_facilities_physical_by_school_id($school_id)
    {
        $physical_facilities_physical_query = "SELECT
                                        `physical_facilities_physical`.`pfPhysicalId`
                                        , `physical_facilities_physical`.`pf_physical_id`
                                        , `physical_facilities_physical_meta`.`physicalTitle`
                                        , `physical_facilities_physical`.`school_id`
                                    FROM
                                        `physical_facilities_physical`
                                        INNER JOIN `physical_facilities_physical_meta` 
                                            ON (`physical_facilities_physical`.`pf_physical_id` = `physical_facilities_physical_meta`.`physicalId`)
                                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($physical_facilities_physical_query);
                    return $query->result();

    }

    

    public function physical_facilities_academic_by_school_id($school_id)
    {
        $physical_facilities_acedemic_query = "SELECT
                                `physical_facilities_academic`.`pfAcademicId`
                                , `physical_facilities_academic`.`academic_id`
                                , `physical_facilities_academic_meta`.`academicTitle`
                                , `physical_facilities_academic`.`school_id`
                            FROM
                                `physical_facilities_academic`
                                INNER JOIN `physical_facilities_academic_meta` 
                                    ON (`physical_facilities_academic`.`academic_id` = `physical_facilities_academic_meta`.`academicId`)
                                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($physical_facilities_acedemic_query);
                    return $query->result();
    }

    public function physical_facilities_co_curricular_by_school_id($school_id)
    {
        $physical_facilities_co_curricular_query = "SELECT
                                                `physical_facilities_co_curricular`.`pfCoCurricularId`
                                                , `physical_facilities_co_curricular`.`co_curricular_id`
                                                , `physical_facilities_co_curricular_meta`.`coCurricularTitle`
                                                , `physical_facilities_co_curricular`.`school_id`
                                            FROM
                                                `physical_facilities_co_curricular`
                                                INNER JOIN `physical_facilities_co_curricular_meta` 
                                                    ON (`physical_facilities_co_curricular`.`co_curricular_id` = `physical_facilities_co_curricular_meta`.`coCurricularId`)
                                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($physical_facilities_co_curricular_query);
                    return $query->result();
    }

    public function physical_facilities_other_by_school_id($school_id)
    {
        $physical_facilities_other_query = "SELECT
                                                `physical_facilities_others`.`pfOtherId`
                                                , `physical_facilities_others`.`other_id`
                                                , `physical_facilities_others_meta`.`otherTitle`
                                                , `physical_facilities_others`.`school_id`
                                            FROM
                                                `physical_facilities_others`
                                                INNER JOIN `physical_facilities_others_meta` 
                                                    ON (`physical_facilities_others`.`other_id` = `physical_facilities_others_meta`.`otherId`)
                                    WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($physical_facilities_other_query);
                    return $query->result();
    }

    public function staff_by_school_id($school_id)
    {
        $staff_query = "SELECT
                            `school_staff`.`schoolStaffId`
                            , `school_staff`.`schoolStaffName`
                            , `school_staff`.`schoolStaffFatherOrHusband`
                            , `school_staff`.`schoolStaffCnic`
                            , `school_staff`.`schoolStaffQaulificationProfessional`
                            , `school_staff`.`schoolStaffQaulificationAcademic`
                            , `school_staff`.`schoolStaffAppointmentDate`
                            , `school_staff`.`schoolStaffDesignition`
                            , `school_staff`.`schoolStaffNetPay`
                            , `school_staff`.`schoolStaffAnnualIncreament`
                            , `school_staff`.`schoolStaffType`
                            , `school_staff`.`schoolStaffType`
                            , `school_staff`.`schoolStaffType`
                            , `staff_type`.`staffTtitle`
                            , `school_staff`.`schoolStaffGender`
                            , `gender`.`genderTitle`
                            , `school_staff`.`TeacherTraining`
                            , `school_staff`.`TeacherExperience`
                            , `school_staff`.`school_id`
                        FROM
                            `school_staff`
                            INNER JOIN `staff_type` 
                                ON (`school_staff`.`schoolStaffType` = `staff_type`.`staffTypeId`)
                            INNER JOIN `gender` 
                                ON (`school_staff`.`schoolStaffGender` = `gender`.`genderId`)
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($staff_query);
                    return $query->result();

    }

    public function fee_by_school_id($school_id)
    {
        $staff_query = "SELECT
                            `fee`.`feeId`
                            , `fee`.`class_id`
                            , `class`.`classTitle`
                            , `fee`.`addmissionFee`
                            , `fee`.`tuitionFee`
                            , `fee`.`securityFund`
                            , `fee`.`otherFund`
                            , `fee`.`school_id`
                        FROM
                            `fee`
                            INNER JOIN `class` 
                                ON (`fee`.`class_id` = `class`.`classId`)
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($staff_query);
                    return $query->result();
    }

    public function fee_mentioned_in_form_by_school_id($school_id)
    {
        $staff_query = "SELECT
                            `feeMentionedInFormId`
                            , `feeMentionedInForm`
                            , `school_id`
                        FROM
                            `fee_mentioned_in_form_or_prospectus`
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($staff_query);
                    return $query->row();
    }

    public function security_measures_by_school_id($school_id)
    {
        $security_query = "SELECT
                            `security_measures`.`securityMeasureId`
                            , `security_status`.`securityStatusTitle`
                            , `security_provided`.`securityProvidedTitle`
                            , `security_personnel`.`SecurityPersonnelTitle`
                            , `security_measures`.`securityPersonnel`
                            , `security_personnel`.`SecurityPersonnelTitle`
                            , `security_measures`.`security_according_to_police_dept`
                            , `security_measures`.`cameraInstallation`
                            , `security_measures`.`camraNumber`
                            , `security_measures`.`dvrMaintained`
                            , `security_measures`.`cameraOnline`
                            , `security_measures`.`exitDoorsNumber`
                            , `security_measures`.`emergencyDoorsNumber`
                            , `security_measures`.`boundryWallHeight`
                            , `security_measures`.`wiresProvided`
                            , `security_measures`.`watchTower`
                            , `security_measures`.`licensedWeapon`
                            , `security_measures`.`licenseNumber`
                            , `security_measures`.`ammunitionStatus`
                            , `security_measures`.`metalDetector`
                            , `security_measures`.`walkThroughGate`
                            , `security_measures`.`gateBarrier`
                            , `security_measures`.`license_issued_by_id`
                            , `security_measures`.`school_id`
                            , `security_measures`.`securityProvided`
                            , `security_measures`.`securityStatus`
                            , `security_measures`.`security_personnel_status_id`
                            , `security_measures`.`dvrMaintained`
                            , `security_license_issued`.`licenseIssuedTitle`
                        FROM
                            `security_measures`
                            LEFT JOIN `security_personnel` 
                                ON (`security_measures`.`security_personnel_status_id` = `security_personnel`.`SecurityPersonnelId`)
                            LEFT JOIN `security_provided` 
                                ON (`security_measures`.`securityProvided` = `security_provided`.`securityProvidedId`)
                            LEFT JOIN `security_status` 
                                ON (`security_measures`.`securityStatus` = `security_status`.`securityStatusId`)
                            LEFT JOIN `security_license_issued` 
                                ON (`security_measures`.`license_issued_by_id` = `security_license_issued`.`licenseIssuedId`)
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($security_query);
                    return $query->row();
       
    }


    public function hazards_with_associated_risks_by_school_id($school_id)
    {
        $hazards_query = "SELECT
                            `hazards_with_associated_risks`.`hazardsWithAssociatedRisksId`
                            , `hazards_with_associated_risks`.`exposedToFlood`
                            , `hazards_with_associated_risks`.`drowning`
                            , `hazards_with_associated_risks`.`buildingCondition`
                            , `hazards_with_associated_risks`.`accessRoute`
                            , `hazards_with_associated_risks`.`adjacentBuilding`
                            , `hazards_with_associated_risks`.`safeAssemblyPointsAvailable`
                            , `hazards_with_associated_risks`.`disasterTraining`
                            , `hazards_with_associated_risks`.`schoolImprovementPlan`
                            , `hazards_with_associated_risks`.`schoolDisasterManagementPlan`
                            , `hazards_with_associated_risks`.`electrification_condition_id`
                            , `hazards_electrification`.`electrificationTitle`
                            , `hazards_with_associated_risks`.`ventilationSystemAvailable`
                            , `hazards_with_associated_risks`.`chemicalsSchoolLaboratory`
                            , `hazards_with_associated_risks`.`chemicalsSchoolSurrounding`
                            , `hazards_with_associated_risks`.`roadAccident`
                            , `hazards_with_associated_risks`.`safeDrinkingWaterAvailable`
                            , `hazards_with_associated_risks`.`sanitationFacilities`
                            , `hazards_with_associated_risks`.`building_structure_id`
                            , `building_structure`.`buildingStructure`
                            , `hazards_with_associated_risks`.`school_surrounded_by_id`
                            , `hazards_surrounded`.`hazardsSurroundedTitle`
                            , `hazards_with_associated_risks`.`school_id`
                        FROM
                            `hazards_with_associated_risks`
                            LEFT JOIN `hazards_surrounded` 
                                ON (`hazards_with_associated_risks`.`school_surrounded_by_id` = `hazards_surrounded`.`hazardsSurroundedId`)
                            LEFT JOIN `hazards_electrification` 
                                ON (`hazards_with_associated_risks`.`electrification_condition_id` = `hazards_electrification`.`electrificationId`)
                            LEFT JOIN `building_structure` 
                                ON (`hazards_with_associated_risks`.`building_structure_id` = `building_structure`.`buildingStructureId`)
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($hazards_query);
                    return $query->row();
        
    }

    public function hazards_with_associated_risks_unsafe_list_by_school_id($school_id)
    {
        $hazards_query = "SELECT
                            `hazards_with_associated_risks_unsafe_list`.`unSafeId`
                            , `hazards_with_associated_risks_unsafe_list`.`unsafe_list_id`
                            , `unsafe_list`.`unSafeListTitle`
                            , `hazards_with_associated_risks_unsafe_list`.`school_id`
                        FROM
                            `hazards_with_associated_risks_unsafe_list`
                            INNER JOIN `unsafe_list` 
                                ON (`hazards_with_associated_risks_unsafe_list`.`unsafe_list_id` = `unsafe_list`.`unSafeListId`)
                            WHERE school_id = '".$school_id."';";
                    $query = $this->db->query($hazards_query);
                    return $query->result();
        
    }

    public function fee_concession_by_school_id($school_id)
    {


        $fee_query = "SELECT
                    `fee_concession`.`feeConcessionId`
                    , `fee_concession`.`feeConcessionId`
                    , `fee_concession`.`concession_id`
                    , `concession_type`.`concessionTypeTitle`
                    , `fee_concession`.`percentage`
                    , `fee_concession`.`numberOfStudent`
                    , `fee_concession`.`school_id`
                FROM
                    `fee_concession`
                    LEFT JOIN `concession_type` 
                        ON (`fee_concession`.`concession_id` = `concession_type`.`concessionTypeId`)
                        WHERE school_id = '".$school_id."';";
                        $query = $this->db->query($fee_query);
                        return $query->result();
    }


    // this fucntion will provide the data for the first time and then the school user will update all the data in school table.
    public function get_school_data_for_school_insertion($userId){
        $query = "SELECT
                    `schools`.`reg_type_id`
                    ,`schools`.`schoolId`
                    , `schools`.`schoolName`
                    , `schools`.`yearOfEstiblishment`
                    , `schools`.`telePhoneNumber`
                    , `schools`.`tehsil_id`
                    , `schools`.`uc_id`
                    , `schools`.`uc_text`
                    , `schools`.`address`
                    , `schools`.`location`
                    , `schools`.`late`
                    , `schools`.`longitude`
                    , `schools`.`gender_type_id`
                    , `schools`.`school_type_id`
                    , `schools`.`level_of_school_id`
                    , `schools`.`schoolTypeOther`
                    , `schools`.`ppcName`
                    , `schools`.`ppcCode`
                    , `schools`.`ppcCode`
                    , `schools`.`mediumOfInstruction`
                    , `schools`.`biseRegister`
                    , `schools`.`registrationNumber`
                    , `schools`.`primaryRegDate`
                    , `schools`.`highRegDate`
                    , `schools`.`interRegDate`
                    , `schools`.`biseAffiliated`
                    , `schools`.`biseAffiliated`
                    , `schools`.`bise_id`
                    , `schools`.`bise_id`
                    , `schools`.`management_id`
                    , `school`.`reg_type_id`
                FROM
                    `schools`
                    INNER JOIN `users` 
                        ON (`schools`.`owner_id` = `users`.`userId`)
                    LEFT JOIN `school` 
                        ON ( `school`.`schools_id` = `schools`.`schoolId`)
                        WHERE `schools`.`owner_id`='".$userId."';";
        $query = $this->db->query($query);
        return $query->row() ;

    }

    public function school_fund_by_id_m($fee_id)
    {   
        return $this->db->get_where('fee', array('feeId' => $fee_id))->result()[0];
        // return $this->db->where('schoolStaffId', $staff_id)->get('school_staff')->result();
    }

    public function school_enrollement_by_id_m($enrolled_id)
    {   
        return $this->db->get_where('age_and_class', array('ageAndClassId' => $enrolled_id))->result()[0];
        // return $this->db->where('schoolStaffId', $staff_id)->get('school_staff')->result();
    }

    public function school_staff_by_id_m($staff_id)
    {   
        return $this->db->get_where('school_staff', array('schoolStaffId' => $staff_id))->result()[0];
        // return $this->db->where('schoolStaffId', $staff_id)->get('school_staff')->result();
    }

    public function delete_record_by_id_m($id, $col, $table)
    {
        $this->db->where($col, $id);
        $this->db->delete($table);
        $affected_row = $this->db->affected_rows();
        return $affected_row;
    }

    public function get_gender()
    {
        return $this->db->get('gender')->result();
    }
    public function get_staff_type()
    {
        return $this->db->get('staff_type')->result();
    }
    public function get_security_status()
    {
        return $this->db->get('security_status')->result();
    }
    public function get_security_provided()
    {
        return $this->db->get('security_provided')->result();
    }
    public function get_security_personnel()
    {
        return $this->db->get('security_personnel')->result();
    }
    public function get_security_license_issued()
    {
        return $this->db->get('security_license_issued')->result();
    }
    public function get_building_structure()
    {
        return $this->db->get('building_structure')->result();
    }
    public function get_hazards_surrounded()
    {
        return $this->db->get('hazards_surrounded')->result();
    }
    public function get_hazards_electrification()
    {
        return $this->db->get('hazards_electrification')->result();
    }
    public function hazards_hazard_with_associated_risks($school_id)
    {
        return $this->db->where('school_id', $school_id)->get('hazards_with_associated_risks')->result();
    }
    public function get_unsafe_list()
    {
        return $this->db->get('unsafe_list')->result();
    }
    public function get_unsafe_by_school_id($school_id)
    {
        return $this->db->where('school_id', $school_id)->get('hazards_with_associated_risks_unsafe_list')->result();
    }
    // this method will get all school list by schools.schoolId i-e schools_id in school table 
    public function get_schools_list_by_schools_id($schools_id)
    {
            $query = "SELECT
            `school`.`schoolId`
            , `school`.`schools_id`
            , `schools`.`schoolName`
            , `schools`.`yearOfEstiblishment`
            , `schools`.`district_id`
            , `district`.`districtTitle`
            , `schools`.`tehsil_id`
            , `tehsils`.`tehsilTitle`
            , `uc`.`ucTitle`
            , `schools`.`uc_text`
            , `schools`.`telePhoneNumber`
            , `schools`.`schoolMobileNumber`
            , `school`.`level_of_school_id`
            , `levelofinstitute`.`levelofInstituteTitle`
            , `school`.`school_type_id`
            , `school_type`.`typeTitle`
            , `school`.`reg_type_id`
            , `reg_type`.`regTypeTitle`
            , `school`.`gender_type_id`
            , `genderofschool`.`genderOfSchoolTitle`
            , `session_year`.`sessionYearTitle`
        FROM
            `schools`
            LEFT JOIN `school` 
                ON (`schools`.`schoolId` = `school`.`schools_id`)
            LEFT JOIN `district` 
                ON (`schools`.`district_id` = `district`.`districtId`)
            LEFT JOIN `tehsils` 
                ON (`tehsils`.`tehsilId` = `schools`.`tehsil_id`)
            LEFT JOIN `uc` 
                ON (`uc`.`ucId` = `schools`.`uc_id`)
            LEFT JOIN `school_type` 
                ON (`school_type`.`typeId` = `school`.`school_type_id`)
            LEFT JOIN `reg_type` 
                ON (`reg_type`.`regTypeId` = `school`.`reg_type_id`)
            LEFT JOIN `levelofinstitute` 
                ON (`levelofinstitute`.`levelofInstituteId` = `school`.`level_of_school_id`)
            LEFT JOIN `genderofschool` 
                ON (`genderofschool`.`genderOfSchoolId` = `school`.`gender_type_id`)
            LEFT JOIN `session_year` 
                ON (`session_year`.`sessionYearId` = `school`.`session_year_id`)
                WHERE `school`.`schools_id` = ".$schools_id." 
            ORDER BY `school`.`schoolId` DESC ;";
            return $this->db->query($query)->result();
    }
}

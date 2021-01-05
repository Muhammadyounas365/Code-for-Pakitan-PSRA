<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends Admin_Controller {
  
  public function __construct(){

parent::__construct();
$this->load->model("age_m");
  }
  public function index(){
            

            $q1=$this->db->query("SELECT count(schoolId) as registered from schools
                 WHERE `registrationNumber` not in('',0)
            	");
            $q2=$this->db->query("SELECT count(schoolId) as renewed from school
                where renewal_code not in('',0);
            	");
            $q3=$this->db->query("SELECT count(schoolId) as total from schools
               ;
            	");
            $q4=$this->db->query("SELECT 
district.districtTitle
,district.districtId as school_district_id
,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id ) and schools.district_id=school_district_id and 
  
 
  school.level_of_school_id=1
) as primaryschools

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id ) and schools.district_id=school_district_id and 
  
 
  school.level_of_school_id=2
) as middleschools

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id ) and schools.district_id=school_district_id and 
  
 
  school.level_of_school_id=3
) as Highschools

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id ) and schools.district_id=school_district_id and 
  
 
  school.level_of_school_id=4
) as inter_collages



from district
");
$q5=$this->db->query("SELECT 

(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id )  and 
  
 
  school.level_of_school_id=1
) as primary_schools

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id )  and 
  
 
  school.level_of_school_id=2
) as middle

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id ) and 
  
 
  school.level_of_school_id=3
) as high

,(select count(school.schoolId)
from schools inner join school on schools.schoolId=school.schools_id
where school.schoolId in(select MAX(schoolId) from school where status=1 group by schools_id )  and 
  
 
  school.level_of_school_id=4
) as high_sec



");
            //var_dump($q1->result());
            $this->data['primary']=$q5->row()->primary_schools;
            $this->data['middle']=$q5->row()->middle;
            $this->data['high']=$q5->row()->high;
            $this->data['high_sec']=$q5->row()->high_sec;
            $this->data['levelwise_registered_schools']=$q4->result();
            $this->data['total_schools']=$q3->row()->total;
            $this->data['registered_schools']=$q1->row()->registered;
            $this->data['renewed_schools']=$q2->row()->renewed;
            // $this->data['total_users'] = $this->db->select('count(userId) as total')->get('users')->row()->total;
            // $this->data['inactive_users'] = $this->db->select('count(userId) as inactive')->where('userStatus','0')->get('users')->row()->inactive;
            // $this->data['active_users'] = $this->db->select('count(userId) as active')->where('userStatus','1')->get('users')->row()->active;
            //var_dump($this->data['active_users']);exit;
            $this->data['title'] = 'Dashboard';
            $this->data['description'] = 'info about All Modules';
            $this->data['view'] = 'dashboard/dashboard';
            $this->load->view('layout', $this->data);
  }

}
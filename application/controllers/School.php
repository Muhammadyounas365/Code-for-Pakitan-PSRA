<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("school_m");

    	}

      public function create_payment_receipt()
      {
        $this->data['title'] = 'challan';
        $this->data['description'] = 'info about challan';
        $this->data['view'] = 'school/payment_receipt';
        $this->load->view('layout', $this->data);
      }

	public function index($id = 0){
      $district_id = $this->session->userdata('district_id');

      if($this->session->userdata('role_id') == 16){
        // this will count rows for school users i-e dmo's  
          $this->data['tehsils'] = $this->db->where('district_id', $district_id)->get('tehsils')->result();    
          $this->db->where('district_id', $district_id);
          $this->data['district_id'] = $district_id;
      }else{
        // this block will contain some code for admin

        $this->load->model('general_modal');
        $this->data['districts'] = $this->general_modal->districts(0, FALSE);
      }
      $query = $this->db->get('schools');
      $number_of_rows = $query->num_rows();
      // pagination code is executed and dispaly pagination in view
      $this->load->library('pagination');
          $config = [
              'base_url'  =>  base_url('school/index'),
              'per_page'  =>  10,
              'total_rows' => $number_of_rows,
              'full_tag_open' =>  '<ul class="pagination pagination-sm">',
              'full_tag_close'  =>    '</ul>',
              'first_tag_open'    =>  '<li>',
              'first_tag_close'  =>   '</li>',
              'last_tag_open' =>  '<li>',
              'last_tag_close'  =>    '</li>',
              'next_tag_open' =>  '<li>',
              'next_tag_close'  =>    '</li>',
              'prev_tag_open' =>  '<li>',
              'prev_tag_close'  =>    '</li>',
              'num_tag_open'  =>  '<li>',
              'num_tag_close'  => '</li>',
              'cur_tag_open'  =>  '<li class="active"><a>',
              'cur_tag_close'  => '</a></li>'
          ];

        $this->pagination->initialize($config);
        if(empty($id)){
            $offset = $this->uri->segment(3,0);
        }else{
            $offset = $id;
        }
    $this->data['schools'] = $this->school_m->get_schools_list($config['per_page'], $offset);
    // echo "<pre />";
    // var_dump($this->data['schools']);
    // exit();
    $this->data['title'] = 'school';
		$this->data['description'] = 'info about school';
		$this->data['view'] = 'school/schools';
		$this->load->view('layout', $this->data);
	}

  public function certificate_of_schools($schools_id= 0 )
  { 
    // $q="SELECT
    //               `school`.`schoolId`
    //             , `schools`.`schoolName`
    //               , `schools`.`registrationNumber`
    //               , `levelofinstitute`.`levelofInstituteTitle`
                 
    //               , `district`.`districtTitle`
                 
                
                 
                  
    //               ,`tehsils`.`tehsilTitle`
    //                ,`uc`.`ucTitle`
    //                 , `schools`.`telePhoneNumber`
    //                  , `schools`.`address`
    //           FROM
    //               `schools`
                  
    //                    INNER JOIN `district` 
    //                   ON (`schools`.`district_id` = `district`.`districtId`)

    //                    INNER JOIN `tehsils` 
    //                   ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                 
    //                   INNER JOIN `uc` 
    //                   ON (`schools`.`uc_id` = `uc`.`ucId`)
    //               INNER JOIN `school` 
    //                   ON (`schools`.`schoolId` = `school`.`schools_id`)
    //               INNER JOIN `levelofinstitute` 
    //                   ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
    //                INNER JOIN `session_year` 
    //                   ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
    //                     INNER JOIN `forms_process` 
    //                   ON (`school`.`schoolId` = `forms_process`.`school_id`)
    //                 WHERE forms_process.form_a_status=1 and forms_process.form_b_status=1 and forms_process.form_c_status=1 and forms_process.form_d_status=1 and forms_process.form_e_status=1 and forms_process.form_f_status=1 and forms_process.form_g_status=1 and forms_process.form_h_status=1 and `levelofinstitute`.`levelofInstituteId`!=1
    //                 group by schools.schoolId order by schools.district_id";
    //                 $result=$this->db->query($q)->result();
    //                 $html="";
    //                 $html.="<table style='border:solid 1px gray;' border='1' cellpadding='5' cellspacing='0'>";
    //                  $html.="<tr>
    //                  <th>ID#</th>
    //                   <th>School Name</th>
    //                    <th>Reg No</th>
    //                     <th>School Level</th>
    //                      <th>District</th>
    //                       <th>Tehsil</th>
    //                        <th>Uc</th>
    //                         <th>Phone#</th>
    //                          <th>Address</th></tr>";
    //                 foreach ($result as $r) {
    //                   $html.="<tr>";
    //                   $html.="<td>".$r->schoolId."</td>";
    //                    $html.="<td>".$r->schoolName."</td>";
    //                    $html.="<td>".$r->registrationNumber."</td>";
    //                    $html.="<td>".$r->levelofInstituteTitle."</td>";
    //                    $html.="<td>".$r->districtTitle."</td>";
    //                    $html.="<td>".$r->tehsilTitle."</td>";
    //                    $html.="<td>".$r->ucTitle."</td>";
    //                    $html.="<td>".$r->telePhoneNumber."</td>";
    //                    $html.="<td>".$r->address."</td>";
    //                   $html.="</tr>";
                      
    //                 }
    //                 $html.="</table>";
    //                 echo $html;exit;


    $query = "SELECT
                  `school`.`schoolId`
                  ,`school`.`updatedDate`
                  , `schools`.`registrationNumber`
                  , `schools`.`schoolName`
                  , `schools`.`district_id`
                  , `district`.`districtTitle`
                  , `district`.`bise`
                  , `schools`.`gender_type_id`
                  , `genderofschool`.`genderOfSchoolTitle`
                  , `levelofinstitute`.`levelofInstituteTitle`
                  , `levelofinstitute`.`upper_class`
                  , `schools`.`biseregistrationNumber`
                  ,`session_year`.`sessionYearTitle`
                ,`tehsils`.`tehsilTitle`
              FROM
                  `schools`
                  
                       INNER JOIN `district` 
                      ON (`schools`.`district_id` = `district`.`districtId`)

                       INNER JOIN `tehsils` 
                      ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                
                  
                  INNER JOIN `school` 
                      ON (`schools`.`schoolId` = `school`.`schools_id`)
                  INNER JOIN `genderofschool` 
                      ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                  INNER JOIN `levelofinstitute` 
                      ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                   INNER JOIN `session_year` 
                      ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    WHERE `schools`.`schoolId` = ".$schools_id." AND `school`.`status`=1 ORDER BY `school`.`schoolId` DESC;";

                    $school_info=$this->db->query($query)->row();
                    if(empty($school_info) || count($school_info) < 1)
                    {
                      $query1 = "SELECT
                  `school`.`schoolId`
                  ,`school`.`updatedDate`
                  , `schools`.`registrationNumber`
                  , `schools`.`schoolName`
                  , `schools`.`district_id`
                  , `district`.`districtTitle`
                  , `district`.`bise`
                  , `schools`.`gender_type_id`
                  , `genderofschool`.`genderOfSchoolTitle`
                  , `levelofinstitute`.`levelofInstituteTitle`
                  , `levelofinstitute`.`upper_class`
                  , `schools`.`biseregistrationNumber`
                  ,`session_year`.`sessionYearTitle`
                  ,`tehsils`.`tehsilTitle`
              FROM
                  `schools`
                  
                       INNER JOIN `district` 
                      ON (`schools`.`district_id` = `district`.`districtId`)

                       INNER JOIN `tehsils` 
                      ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                  
                  
                  INNER JOIN `school` 
                      ON (`schools`.`schoolId` = `school`.`schools_id`)
                  INNER JOIN `genderofschool` 
                      ON (`school`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                  INNER JOIN `levelofinstitute` 
                      ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                   INNER JOIN `session_year` 
                      ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    WHERE `schools`.`schoolId` = ".$schools_id." ORDER BY `school`.`schoolId` DESC;";

                    $school_info=$this->db->query($query1)->row();
                    }
                    //var_dump($school_info);exit;
                    $query1 = "SELECT
                 
                  MIN(`age_and_class`.`class_id`)
                  
                  ,(select classTitle from class where classId= MIN(`age_and_class`.`class_id`)) as classTitle
                  
                  
              FROM
                  `age_and_class`
                  
                 
                  
                      
                      INNER JOIN `class` 
                      ON (`age_and_class`.`class_id` = `class`.`classId`)
                    WHERE `age_and_class`.`school_id` =".$school_info->schoolId.";";
    $this->data['schools_info'] = $school_info;
    //var_dump($this->db->query($query1)->row());exit;
    $this->data['lower_class'] = $this->db->query($query1)->row();

    $this->load->view('school/certificate_of_schools', $this->data);
    //     $this->data['view'] = 'school/certificate_of_schools';
    // $this->load->view('layout', $this->data);
  }

   public function certificate()
  {
    $school_id=$this->input->post('school_id');
    $query = "SELECT
                  `school`.`schoolId`
                  ,`school`.`updatedDate`
                  , `schools`.`registrationNumber`
                  , `schools`.`schoolName`
                  , `schools`.`district_id`
                  , `district`.`districtTitle`
                  , `district`.`bise`
                  , `schools`.`gender_type_id`
                  , `genderofschool`.`genderOfSchoolTitle`
                  , `levelofinstitute`.`levelofInstituteTitle`
                  , `levelofinstitute`.`upper_class`
                  , `schools`.`biseregistrationNumber`
                  ,`session_year`.`sessionYearTitle`
                ,`tehsils`.`tehsilTitle`
              FROM
                  `schools`
                  
                       INNER JOIN `district` 
                      ON (`schools`.`district_id` = `district`.`districtId`)

                       INNER JOIN `tehsils` 
                      ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                  INNER JOIN `genderofschool` 
                      ON (`schools`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                  
                  INNER JOIN `school` 
                      ON (`schools`.`schoolId` = `school`.`schools_id`)
                  INNER JOIN `levelofinstitute` 
                      ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                   INNER JOIN `session_year` 
                      ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    WHERE `school`.`schoolId` = ".$school_id." AND `school`.`status`=1 ORDER BY `school`.`schoolId` DESC;";

                    $school_info=$this->db->query($query)->row();
                    if(empty($school_info) || count($school_info) < 1)
                    {
                      $query1 = "SELECT
                  `school`.`schoolId`
                  ,`school`.`updatedDate`
                  , `schools`.`registrationNumber`
                  , `schools`.`schoolName`
                  , `schools`.`district_id`
                  , `district`.`districtTitle`
                  , `district`.`bise`
                  , `schools`.`gender_type_id`
                  , `genderofschool`.`genderOfSchoolTitle`
                  , `levelofinstitute`.`levelofInstituteTitle`
                  , `levelofinstitute`.`upper_class`
                  , `schools`.`biseregistrationNumber`
                  ,`session_year`.`sessionYearTitle`
                  ,`tehsils`.`tehsilTitle`
              FROM
                  `schools`
                  
                       INNER JOIN `district` 
                      ON (`schools`.`district_id` = `district`.`districtId`)

                       INNER JOIN `tehsils` 
                      ON (`schools`.`tehsil_id` = `tehsils`.`tehsilId`)
                  INNER JOIN `genderofschool` 
                      ON (`schools`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                  
                  INNER JOIN `school` 
                      ON (`schools`.`schoolId` = `school`.`schools_id`)
                  INNER JOIN `levelofinstitute` 
                      ON (`school`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                   INNER JOIN `session_year` 
                      ON (`school`.`session_year_id` = `session_year`.`sessionYearId`)
                    WHERE `school`.`schoolId` = ".$school_id." ORDER BY `school`.`schoolId` DESC;";

                    $school_info=$this->db->query($query1)->row();
                    }
                    //var_dump($school_info);exit;
                    $query1 = "SELECT
                 
                  MIN(`age_and_class`.`class_id`)
                  
                  ,(select classTitle from class where classId= MIN(`age_and_class`.`class_id`)) as classTitle
                  
                  
              FROM
                  `age_and_class`
                  
                 
                  
                      
                      INNER JOIN `class` 
                      ON (`age_and_class`.`class_id` = `class`.`classId`)
                    WHERE `age_and_class`.`school_id` =".$school_info->schoolId.";";
    $this->data['schools_info'] = $school_info;
    //var_dump($this->db->query($query1)->row());exit;
    $this->data['lower_class'] = $this->db->query($query1)->row();

    $this->load->view('school/certificate_of_schools', $this->data);
    //     $this->data['view'] = 'school/certificate_of_schools';
    // $this->load->view('layout', $this->data);
  }
  public function search_schools_by_creiteria($schools_id = 0)
  {   
      $district_id = '';
      $tehsil_id = '';
      $matchString = '';

      if(!empty($this->input->post('schools_id'))){
          $schools_id = $this->input->post('schools_id');
      }else{
          $district_id = $this->input->post('district_id');
          $tehsil_id = $this->input->post('tehsil_id');
          $matchString = $this->input->post('matchString');
      }
      $this->data['schools'] = $this->school_m->get_single_school_from_schools_by_id_m($schools_id, $matchString, $district_id, $tehsil_id);
      $this->load->view('school/search_schools_by_creiteria', $this->data);
  }
  public function get_school_username_password()
  {
      $arr=array();
    $schools_id=$this->input->post('id');
    if($schools_id)
    {
      $q="SELECT `schools`.`schoolId`,`schools`.`registrationNumber`,`schools`.`schoolName`,`schools`.`schoolMobileNumber`,`schools`.`yearOfEstiblishment`,`users`.`userTitle`,`users`.`userName`,`users`.`userPassword`,`users`.`contactNumber` FROM `schools` inner join users on `schools`.`owner_id`=`users`.`userId` WHERE `schools`.`schoolId`=$schools_id";
      $this->data['school_info']=$this->db->query($q)->row();
      //var_dump($school_info);exit;
    $arr['school_info']=$this->load->view('school/school_username_and_password_details_by_ajax', $this->data,true);
    $arr['status']=true;
    echo json_encode($arr);exit;

    }
  }


    public function registration_code_allotment($id = 0){
      $this->load->model('general_modal');
      $this->data['districts'] = $this->general_modal->districts(0, FALSE);
        $query = $this->db->query("Select schools.schoolId from schools inner join school on 
          schools.schoolId=school.schools_id where registrationNumber in ('',0)

          ");
        $number_of_rows = $query->num_rows();
        // pagination code is executed and dispaly pagination in view
        $this->load->library('pagination');
            $config = [
                'base_url'  =>  base_url('school/registration_code_allotment'),
                'per_page'  =>  10,
                'total_rows' => $number_of_rows,
                'full_tag_open' =>  '<ul class="pagination pagination-sm">',
                'full_tag_close'  =>    '</ul>',
                'first_tag_open'    =>  '<li>',
                'first_tag_close'  =>   '</li>',
                'last_tag_open' =>  '<li>',
                'last_tag_close'  =>    '</li>',
                'next_tag_open' =>  '<li>',
                'next_tag_close'  =>    '</li>',
                'prev_tag_open' =>  '<li>',
                'prev_tag_close'  =>    '</li>',
                'num_tag_open'  =>  '<li>',
                'num_tag_close'  => '</li>',
                'cur_tag_open'  =>  '<li class="active"><a>',
                'cur_tag_close'  => '</a></li>'
            ];

          $this->pagination->initialize($config);
          if(empty($id)){
              $offset = $this->uri->segment(3,0);
          }else{
              $offset = $id;
          }
      $this->data['schools'] = $this->school_m->schools_has_no_registration_number($config['per_page'], $offset);
      // echo "<pre />";
      // var_dump($this->data['schools']);
      // exit();
      $this->data['title'] = 'school Registration';
      $this->data['description'] = 'info about school';
      $this->data['view'] = 'school/schools_has_no_registration_number';
      $this->load->view('layout', $this->data);
    }
    ///////////////////////////////////////////////
    public function renewal_code_allotment($id = 0){
      $this->load->model('general_modal');
      $this->data['districts'] = $this->general_modal->districts(0, FALSE);
      $this->db->where('setting_name','next');
        $query=$this->db->get("session_setting");
        
        $next_session= $query->row()->session_id;
        $query ="SELECT count(*)as total_rows FROM `schools` inner join school on `schools`.`schoolId`=`school`.`schools_id` WHERE `schools`.`registrationNumber` not in('',0) and `school`.`status`=2 and session_year_id=$next_session";

        $number_of_rows = $this->db->query($query)->row()->total_rows;
        //echo $number_of_rows;exit;
        // pagination code is executed and dispaly pagination in view
        $this->load->library('pagination');
            $config = [
                'base_url'  =>  base_url('school/renewal_code_allotment'),
                'per_page'  =>  25,
                'total_rows' => $number_of_rows,
                'full_tag_open' =>  '<ul class="pagination pagination-sm">',
                'full_tag_close'  =>    '</ul>',
                'first_tag_open'    =>  '<li>',
                'first_tag_close'  =>   '</li>',
                'last_tag_open' =>  '<li>',
                'last_tag_close'  =>    '</li>',
                'next_tag_open' =>  '<li>',
                'next_tag_close'  =>    '</li>',
                'prev_tag_open' =>  '<li>',
                'prev_tag_close'  =>    '</li>',
                'num_tag_open'  =>  '<li>',
                'num_tag_close'  => '</li>',
                'cur_tag_open'  =>  '<li class="active"><a>',
                'cur_tag_close'  => '</a></li>'
            ];

          $this->pagination->initialize($config);
          if(empty($id)){
              $offset = $this->uri->segment(3,0);
          }else{
              $offset = $id;
          }
      $this->data['schools'] = $this->school_m->schools_has_no_renewal_number($config['per_page'], $offset);
      // echo "<pre />";
      // var_dump($this->data['schools']);
      // exit();
      $this->data['title'] = 'school Renewal';
      $this->data['description'] = 'info about school';
      $this->data['view'] = 'school/school_has_no_renewal_number';
      $this->load->view('layout', $this->data);
    }

    public function get_tehsils_list_by_district_id($district_id = 0, $list = FALSE)
    {
        $this->load->model('general_modal');
        echo $this->general_modal->tehsils($district_id, $list);
    }

    public function get_single_school_from_schools_by_id($schools_id = 0)
    {   
        $district_id = '';
        $tehsil_id = '';
        $matchString = '';
       
        if(!empty($this->input->post('schools_id'))){
            $schools_id = $this->input->post('schools_id');
        }else{
            $district_id = $this->input->post('district_id');
            $tehsil_id = $this->input->post('tehsil_id');
            $matchString = $this->input->post('matchString');
        }

        // var_dump($this->school_m->get_single_school_from_schools_by_id_m(15)[0]);
        $this->data['schools'] = $this->school_m->get_single_school_from_schools_by_id_m($schools_id, $matchString, $district_id, $tehsil_id);
        $this->load->view('school/schools_has_no_registration_number_row_load_in_ajax', $this->data);
    }
    public function get_single_school_for_renewal_by_id($schools_id = 0)
    {   
        $district_id = '';
        $tehsil_id = '';
        $matchString = '';
       
        if(!empty($this->input->post('schools_id'))){
            $schools_id = $this->input->post('schools_id');
        }else{
            $district_id = $this->input->post('district_id');
            $tehsil_id = $this->input->post('tehsil_id');
            $matchString = $this->input->post('matchString');
        }

        // var_dump($this->school_m->get_single_school_from_schools_by_id_m(15)[0]);
        $this->data['schools'] = $this->school_m->get_single_school_for_renewal_by_id_m($schools_id, $matchString, $district_id, $tehsil_id);
        $this->load->view('school/schools_has_no_renewal_number_ajax_load', $this->data);
    }

  public function generate_reg_number(){
     date_default_timezone_set("Asia/Karachi"); 
     $dated = date("d-m-Y h:i:sa");
     $school_id = $this->input->post('id');

     $row = $this->db->where('schoolId', $school_id)->get('schools')->row();

     $yearOfEstiblishment = $row->yearOfEstiblishment;
     $tehsil_id = $row->tehsil_id;
     $district_id = $row->district_id;

     $where = array('tehsilId' => $tehsil_id, 'district_id' => $district_id);


     $this->db->where($where);
     $autoIncreamentNumberRow = $this->db->get('registration_code')->result()[0];

     $registrationNumberIncreamentId = $autoIncreamentNumberRow->registrationNumberIncreamentId;
     $registrationNumberIncreament = $autoIncreamentNumberRow->registrationNumberIncreament;

     $district_id_with_prefix_zero = sprintf("%02d", $district_id);
     $tehsil_id_with_prefix_zero = sprintf("%03d", $tehsil_id);
     $yearOfEstiblishment = substr($yearOfEstiblishment,2);
     $codeCombined = $district_id_with_prefix_zero.$tehsil_id_with_prefix_zero.$registrationNumberIncreament.$yearOfEstiblishment;

      $data["district_id"] = $district_id;
      $data["tehsil_id"] = $tehsil_id;
      $data["school_id"] = $school_id;
      $data["codeCombined"] = $codeCombined;

      $update_data = array(
              'registrationNumber' => $codeCombined,
              'updatedDate'=>$dated,
              'updatedBy' => $this->session->userdata('userId')
      );

      $this->db->where('schoolId', $school_id);
      $this->db->update('schools', $update_data);
      $affected_rows = $this->db->affected_rows();
      if($affected_rows){
          $school_session_id=$this->db->where('schools_id',$school_id)->order_by('schoolId','asc')->get('school')->row()->schoolId;
          $update_session_data = array(
                  'status' => 1,
                  'updatedDate'=>$dated,
                  'updatedBy' => $this->session->userdata('userId')
          );
          $this->db->where('schoolId',$school_session_id);
          $this->db->update('school', $update_session_data);
          $update_increament = array(
                  'registrationNumberIncreament' => $registrationNumberIncreament+1
          );
          $where1 = array('tehsilId' => $tehsil_id, 'district_id' => $district_id);
          $this->db->where($where1);
          $this->db->update('registration_code', $update_increament);
          $affected_rows = $this->db->affected_rows();

                echo "<h2 style='margin-top:150px; margin-bottom:70px;' class='text-center'><strong class='text text-success'>Successfully Alloted Registration Number \" $codeCombined \" .</strong></h2>";
                echo "<div class='row'><div class='col-md-offset-2 col-md-8' style='margin-bottom:35px;'>";
                echo "
                <input type='hidden' name='schools_id_for_message' id='schools_id_for_message' value='".$school_session_id."'></input>


                <button id='send_message' class='btn btn-primary'><i class='fa fa-envelope-o'></i> Send Registration Certificate</button><a class='btn btn-success btn-flat pull-right' onclick='(function(){ location.reload(); })
          ();'>Close</a>";
                echo "</div></div>";
      }

      // echo json_encode($arr);
      // exit();
  }

public function generate_renewal_number(){
     date_default_timezone_set("Asia/Karachi"); 
     $dated = date("d-m-Y h:i:sa");
     $school_id = $this->input->post('id');

     $row = $this->db->where('schoolId', $school_id)->get('school')->row();
     $renewal_code='';
     $schoolId=$row->schoolId;
     $schools_id=$row->schools_id;
     $reg_type_id=$row->reg_type_id;
     $session_id=$row->session_year_id;
     $renewal_code=$reg_type_id."-".$schoolId."-".$session_id;
     //echo $renewal_code;exit;
     $arr=array();
     if($renewal_code !="")
     {
       $update_data = array(
              'renewal_code' => $renewal_code,
              'status' =>1,
              'updatedDate'=>$dated,
              'updatedBy' => $this->session->userdata('userId')
      );

      $this->db->where('schoolId', $school_id);
      $this->db->update('school', $update_data);
      $affected_rows =1;// $this->db->affected_rows();

         if($affected_rows >0)
         {
            $arr['msg']="<h2 style='margin-top:150px; margin-bottom:70px;' class='text-center'><strong class='text text-success'>Successfully Alloted Renewal Number \" $renewal_code \"</strong></h2>
                <div class='row'><div class='col-md-offset-2 col-md-8' style='margin-bottom:35px;'>
                <input type='hidden' name='schools_id_for_message' id='schools_id_for_message' value='".$school_id."'></input>


                <button id='send_message' class='btn btn-primary'><i class='fa fa-envelope-o'></i> Send Registration Certificate</button>
                
                <button class='btn btn-success btn-flat pull-right' onclick='(function(){ location.reload(); })
          ();'>Close</button>
                </div></div>";
                $arr['status']=true;
         }
         else
         {
           $arr['msg']="<h2 style='margin-top:150px; margin-bottom:70px;' class='text-center'><strong class='text text-success'>Sorry Cannot Create Renewal Code</strong></h2>
                <div class='row'><div class='col-md-offset-2 col-md-8' style='margin-bottom:35px;'>
                <button class='btn btn-success btn-flat pull-right' onclick='(function(){ location.reload(); })
          ();'>Close</button>
                </div></div>";
                $arr['status']=false;
         }
     }
     else
     {
      
      $arr['msg']="<h2 style='margin-top:150px; margin-bottom:70px;' class='text-center'><strong class='text text-success'>Sorry Cannot Create Renewal Code</strong></h2>
                <div class='row'><div class='col-md-offset-2 col-md-8' style='margin-bottom:35px;'>
                <button class='btn btn-success btn-flat pull-right' onclick='(function(){ location.reload(); })
          ();'>Close</button>
                </div></div>";
                $arr['status']=false;

     }
     echo json_encode($arr);exit;

     
  }



	public function bankReceipt(){
    $this->data['view'] = 'school/bankReceipt';
    // $this->load->view('layout', $this->data);
  }
  public function create_form(){
    $userId = $this->session->userdata('userId');
    // echo "<pre />";
    //echo $userId;exit;
    $this->data['schooldata'] = $this->school_m->get_school_data_for_school_insertion($userId);
    $tehsil_id = $this->data['schooldata']->tehsil_id;
    $this->data['ucs_list'] = $this->db->where('tehsil_id', $tehsil_id)->get('uc')->result();
    // var_dump($ucs_list);
    // exit();
    $this->load->model("general_modal");
    $this->load->model("session_m");
    $next=$this->session_m->get_next_session();
    $this->data['next_session_id'] = $next->session_id;
    $this->data['school_types'] = $this->general_modal->school_types();
    $this->data['districts'] = $this->general_modal->districts();
    $this->data['gender_of_school'] = $this->general_modal->gender_of_school();
    $this->data['level_of_institute'] = $this->general_modal->level_of_institute();
    $this->data['reg_type'] = $this->general_modal->registration_type();
    $this->data['tehsils'] = $this->general_modal->tehsils();
    $this->data['ucs'] = $this->general_modal->ucs();
    $this->data['locations'] = $this->general_modal->location();
    $this->data['bise_list'] = $this->general_modal->bise_list();
    // var_dump($this->data['locations']);
    // exit();
		$this->data['title'] = 'school';
		$this->data['description'] = 'info about school';
		$this->data['view'] = 'school/create';
		$this->load->view('layout', $this->data);
	}


    public function form_b($school_id =1){
    $this->load->model("general_modal");


    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['buildings'] = $this->general_modal->building();
    $this->data['physical'] = $this->general_modal->physical();
    $this->data['academics'] = $this->general_modal->academic();
    $this->data['book_types'] = $this->general_modal->book_type();
    $this->data['co_curriculars'] = $this->general_modal->co_curricular();
    $this->data['other'] = $this->general_modal->other();    
    // var_dump($this->data['other']);
    // exit();
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_b';
    $this->load->view('layout', $this->data);
  }

  public function add_section_b($school_id =1){
    if($_POST)
    {
       //validation configuration
        $validation_config = array(
            array(
                'field' =>  'building_id',
                'label' =>  'School Building',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfClassRoom',
                'label' =>  'Number Of Class Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfOtherRoom',
                'label' =>  'Number Of Other Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'totalArea',
                'label' =>  'Total Area',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'coveredArea',
                'label' =>  'Covered Area',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();

          $mainData = array(
            'building_id' => $posts['building_id'],
            'numberOfClassRoom' => $posts['numberOfClassRoom'],
            'numberOfOtherRoom' => $posts['numberOfOtherRoom'],
            'totalArea' => $posts['totalArea'],
            'coveredArea' => $posts['coveredArea'],
            'numberOfComputer' => $posts['numberOfComputer'],
            'numberOfLatrines' => $posts['numberOfLatrines'],
            'numberOfLatrines' => $posts['numberOfLatrines'],
            'school_id' => $posts['school_id']
            );

              $msg = "New School has been created successfully";
              $type = "msg_success";
              $this->db->insert('physical_facilities', $mainData);
              $physical_facilities_insert_id = $this->db->insert_id();
              // $insert_id = $this->school_m->save($mainData);
              if($physical_facilities_insert_id){
                  $pf_physical_ids = $posts['pf_physical_id'];
                  $academic_ids    = $posts['academic_id'];
                  $other_ids    = $posts['other_id'];
                  $co_curricular_ids    = $posts['co_curricular_id'];
                    if(!empty($posts['numberOfBooks'])){
                      $book_type_ids_array = $posts['book_type_ids'];
                      $numberOfBooks_array = $posts['numberOfBooks'];
                      $count = count($book_type_ids_array);

                          $library_batch_data = [];
                          for ($i=0; $i < $count; $i++) {
                            array_push($library_batch_data,  array(
                                                      '`book_type_id`' => $book_type_ids_array[$i],
                                                      '`numberOfBooks`' => $numberOfBooks_array[$i],
                                                      '`school_id`' => $posts['school_id']
                                                    ));
                            
                          }
                          $this->db->insert_batch('school_library', $library_batch_data);
                          $insert_id = $this->db->insert_id();

                    }
                  foreach ($pf_physical_ids as $pf_physical_id) {
                      $this->db->insert('physical_facilities_physical', array('pf_physical_id' => $pf_physical_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($academic_ids as $academic_id) {
                      $this->db->insert('physical_facilities_academic', array('academic_id' => $academic_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($co_curricular_ids as $co_curricular_id) {
                      $this->db->insert('physical_facilities_co_curricular', array('co_curricular_id' => $co_curricular_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($other_ids as $other_id) {
                      $this->db->insert('physical_facilities_others', array('other_id' => $other_id, 'school_id' => $posts['school_id']));
                  }
                    $update_in_form_process = array(
                          'form_b_status' => 1
                  );
                 
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);
                 

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/explore_school_by_id/'.$posts['school_id']);
              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/explore_school_by_id/'.$posts['school_id']);
              }

        }else{

           redirect('school/explore_school_by_id/'.$posts['school_id']);
        
        }
    }
    else
    {
      $this->load->model("general_modal");


    

    $this->data['school_id'] = (int) $school_id;
    $this->data['buildings'] = $this->general_modal->building();
    $this->data['physical'] = $this->general_modal->physical();
    $this->data['academics'] = $this->general_modal->academic();
    $this->data['book_types'] = $this->general_modal->book_type();
    $this->data['co_curriculars'] = $this->general_modal->co_curricular();
    $this->data['other'] = $this->general_modal->other();    
    // var_dump($this->data['other']);
    // exit();
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/add_section_b';
    $this->load->view('layout', $this->data);
    }
    
  }

    public function form_c($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['age_list'] = $this->db->get('age')->result();
    $this->data['class_list'] = $this->db->get('class')->result();
    $this->data['age_and_class'] = $this->school_m->get_age_and_class_by_school_id($school_id);
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_c';
    $this->load->view('layout', $this->data);
  }

    public function form_d($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;
    $this->data['school_staff'] = $this->school_m->staff_by_school_id($school_id);
    $this->data['school_id'] = (int) $school_id;
     $this->data['gender'] = $this->school_m->get_gender();
        $this->data['staff_type'] = $this->school_m->get_staff_type();
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_d';
    $this->load->view('layout', $this->data);
  }

    public function form_e($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['class_list'] = $this->db->get('class')->result();
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_e';
    $this->load->view('layout', $this->data);
  }

    public function form_f($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_f';
    $this->load->view('layout', $this->data);
  }

  public function add_section_f($school_id =1){
   if($_POST)
   {
       //validation configuration
        $validation_config = array(
            array(
                'field' =>  'securityStatus',
                'label' =>  'Security Status',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'securityProvided',
                'label' =>  'Security Provided',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'exitDoorsNumber',
                'label' =>  'Exit Doors Number',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'watchTower',
                'label' =>  'watch Tower',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();

              $msg = "Security Measures added successfully";
              $type = "msg_success";
              $this->db->insert('security_measures', $posts);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                $update_in_form_process = array(
                        'form_f_status' => 1
                );
               
                $this->db->where('school_id', $posts['school_id']);
                $this->db->update('forms_process', $update_in_form_process);

                $this->session->set_flashdata($type, $msg);
                redirect('school/explore_school_by_id/'.$posts['school_id']);
              }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                 redirect('school/explore_school_by_id/'.$posts['school_id']);
              }

        }else{

             redirect('school/explore_school_by_id/'.$posts['school_id']);
        }

   }

   else
   {
     $this->data['school_id'] = (int) $school_id;
     $this->data['title'] = 'school';
     $this->data['description'] = 'info about school';
     $this->data['view'] = 'school/add_section_f';
     $this->load->view('layout', $this->data);
   }
    
  }

    public function form_g($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_g';
    $this->load->view('layout', $this->data);
  }

  public function add_section_g($school_id =1){
   if($_POST)
   {
     //validation configuration
        $validation_config = array(
            array(
                'field' =>  'safeAssemblyPointsAvailable',
                'label' =>  'Safe Assembly Points Available',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'disasterTraining',
                'label' =>  'Disaster Training',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolImprovementPlan',
                'label' =>  'School Improvement Plan',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'electrification_condition_id',
                'label' =>  'Electrification Condition',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          if($posts['accessRoute'] != 'Safe'){
          $unSafeList1 = $posts['unSafeList'];
          unset($posts['unSafeList']);                             
          }

              $msg = "Hazards with associated risks has been added successfully";
              $type = "msg_success";

              $this->db->insert('hazards_with_associated_risks', $posts);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                  if($posts['accessRoute'] != 'Safe'){
                      $count = count($unSafeList1);
                          $batch_data = [];
                          for ($i=0; $i < $count; $i++) {
                            array_push($batch_data,  array(
                                        '`unsafe_list_id`' => $unSafeList1[$i],
                                        '`school_id`' => $posts['school_id']
                                                      ));   
                          }
                      $this->db->insert_batch('`hazards_with_associated_risks_unsafe_list`', $batch_data);
                  }

                  $update_in_form_process = array(
                          'form_g_status' => 1
                  );
                  
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/explore_school_by_id/'.$posts['school_id']);

              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/explore_school_by_id/'.$posts['school_id']);

              }

        }else{

            redirect('school/explore_school_by_id/'.$posts['school_id']);

            
            }

   }
   else
   {
    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/add_section_g';
    $this->load->view('layout', $this->data);
   }
    
  }

    public function form_h($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_h';
    $this->load->view('layout', $this->data);
  }

  public function add_section_h($school_id =1){
    if($_POST)
    {
       //validation configuration
        $validation_config = array(
            array(
                'field' =>  'concession_id',
                'label' =>  'Safe Assembly Points Available',
                'rules' =>  'trim'
            ),
            array(
                'field' =>  'disasterTraining',
                'label' =>  'Disaster Training',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolImprovementPlan',
                'label' =>  'School Improvement Plan',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'electrification_condition_id',
                'label' =>  'Electrification Condition',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        // if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
           
              $msg = "Fee concession has been added successfully";
              $type = "msg_success";
              $concession_ids = $posts['concession_id']; 
              $percentage = $posts['percentage'];
              $numberOfStudent = $posts['numberOfStudent'];                             
              $count = count($concession_ids);
                  $batch_data = [];
                  for ($i=0; $i < $count; $i++) {
                    array_push($batch_data,  array(
                    '`concession_id`' => $concession_ids[$i],
                    '`percentage`' => $percentage[$i],
                    '`numberOfStudent`' => $numberOfStudent[$i],
                    '`school_id`' => $posts['school_id']
                     ));
                  }
                  // echo "<pre >";
                  // var_dump($batch_data);
                  // exit();
                  $this->db->insert_batch('fee_concession', $batch_data);
                  $insert_id = $this->db->insert_id();

              $update_in_form_process = array(
                      'form_h_status' => 1
              );
          
              $this->db->where('school_id', $posts['school_id']);
              $this->db->update('forms_process', $update_in_form_process);
              

            
            if($insert_id){
                $this->session->set_flashdata($type, $msg);
                redirect('school/explore_school_by_id/'.$posts['school_id']);
            }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/explore_school_by_id/'.$posts['school_id']);
            }
    }
    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/add_section_h';
    $this->load->view('layout', $this->data);
  }

	public function create_process($id = null){
    
      //var_dump($_POST);exit();
      //validation configuration
      $validation_config = array(
          array(
              'field' =>  'management_id',
              'label' =>  'Management System',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'mediumOfInstruction',
              'label' =>  'Medium Of Instruction',
              'rules' =>  'trim|required'
          )

      );

      // $post_data = $this->input->post();
      // unset($posts['text_password']);
      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
        $posts = $this->input->post();
        $schools_id = $posts['schools_id'];
        unset($posts['schools_id']);
        $school = array(
              // 'reg_type_id' => $posts['reg_type_id'],
              // 'name' => $posts['name'],
              // 'yearOfEstiblishment' => $posts['yearOfEstiblishment'],
              // 'telePhoneNumber' => $posts['telePhoneNumber'],
              // 'district_id' => $posts['district_id'],
              // 'tehsil_id' => $posts['tehsil_id'],
              // 'uc_id' => $posts['uc_id'],
              'address' => $posts['address'],
              // 'location' => $posts['location'],
              'late' => $posts['late'],
              'longitude' => $posts['longitude'],
              // 'gender_type_id' => $posts['gender_type_id'],
              // 'school_type_id' => $posts['school_type_id'],
              // 'type_of_institute_id' => $posts['type_of_institute_id'],
              // 'schoolTypeOther' => $posts['schoolTypeOther'],
              // 'ppcName' => $posts['ppcName'],
              // 'ppcCode' => $posts['ppcCode'],
              'uc_text' => $posts['uc_text'],
              'mediumOfInstruction' => $posts['mediumOfInstruction'],
              'biseRegister' => $posts['biseRegister'],
              'biseregistrationNumber' => $posts['biseregistrationNumber'],
              'primaryRegDate' => $posts['primaryRegDate'],
              'middleRegDate' => $posts['middleRegDate'],
              'highRegDate' => $posts['highRegDate'],
              'interRegDate' => $posts['interRegDate'],
              'biseAffiliated' => $posts['biseAffiliated'],
              'bise_id' => $posts['bise_id'],
              'otherBiseName' => $posts['otherBiseName'],
              'management_id' => $posts['management_id']
              );
            if(!empty($posts['uc_id'])){
                $school['uc_id'] = $posts['uc_id'];
            }else{
              // $school['uc_id'] = 0;
            }


            $msg = "School data has been inserted successfully";
            $type = "msg_success";
            // $insert_id = $this->school_m->save($school, $schools_id);
            $this->db->where('schoolId', $schools_id);
            $this->db->update('schools', $school);

            if($this->db->affected_rows() > 0){
                $update_in_form_process = array(
                        'form_a_status' => 1
                );

                $this->db->where('user_id', $this->session->userdata('userId'));
                $this->db->update('forms_process', $update_in_form_process);
                $school_bank = array(
                    'bankAccountNumber' => $posts['bankAccountNumber'],
                    'bankAccountName' => $posts['bankAccountName'],
                    'bankBranchCode' => $posts['bankBranchCode'],
                    'bankBranchAddress' => $posts['bankBranchAddress'],
                    'accountTitle' => $posts['accountTitle'],
                    'school_id' => $schools_id
                );
                if($posts['bankAccountNumber'] && $posts['banka_acount_details']=='Yes' ){
                $this->db->insert('bank_account', $school_bank);
                }
                $this->session->set_flashdata($type, $msg);
                redirect('school/form_b/'.$schools_id);
            }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/create_form');
            }
          

      }else{

          $this->create_form();
      
      }

	}

    public function form_b_process($id = null){
      // echo "<pre>";print_r($this->input->post()); exit;
      
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'building_id',
                'label' =>  'School Building',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfClassRoom',
                'label' =>  'Number Of Class Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfOtherRoom',
                'label' =>  'Number Of Other Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'totalArea',
                'label' =>  'Total Area',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'coveredArea',
                'label' =>  'Covered Area',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          // echo "<pre>"; print_r($posts);exit();

          $mainData = array(
            'building_id' => $posts['building_id'],
            'numberOfClassRoom' => $posts['numberOfClassRoom'],
            'numberOfOtherRoom' => $posts['numberOfOtherRoom'],
            'totalArea' => $posts['totalArea'],
            'rent_amount' => $posts['rent_amount'],
            'coveredArea' => $posts['coveredArea'],
            'numberOfComputer' => $posts['numberOfComputer'],
            'numberOfLatrines' => $posts['numberOfLatrines'],
            'school_id' => $posts['school_id']
            );
          echo "<pre>"; print_r($mainData);exit;

              $msg = "New School has been created successfully";
              $type = "msg_success";
              $this->db->insert('physical_facilities', $mainData);
              $physical_facilities_insert_id = $this->db->insert_id();
              // $insert_id = $this->school_m->save($mainData);
              if($physical_facilities_insert_id){
                  $pf_physical_ids = $posts['pf_physical_id'];
                  $academic_ids    = $posts['academic_id'];
                  $other_ids    = $posts['other_id'];
                  $co_curricular_ids    = $posts['co_curricular_id'];
                    if(!empty($posts['numberOfBooks'])){
                      $book_type_ids_array = $posts['book_type_ids'];
                      $numberOfBooks_array = $posts['numberOfBooks'];
                      $count = count($book_type_ids_array);

                          $library_batch_data = [];
                          for ($i=0; $i < $count; $i++) {
                            array_push($library_batch_data,  array(
                                                      '`book_type_id`' => $book_type_ids_array[$i],
                                                      '`numberOfBooks`' => $numberOfBooks_array[$i],
                                                      '`school_id`' => $posts['school_id']
                                                    ));
                            
                          }
                          $this->db->insert_batch('school_library', $library_batch_data);
                          $insert_id = $this->db->insert_id();

                    }
                  foreach ($pf_physical_ids as $pf_physical_id) {
                      $this->db->insert('physical_facilities_physical', array('pf_physical_id' => $pf_physical_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($academic_ids as $academic_id) {
                      $this->db->insert('physical_facilities_academic', array('academic_id' => $academic_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($co_curricular_ids as $co_curricular_id) {
                      $this->db->insert('physical_facilities_co_curricular', array('co_curricular_id' => $co_curricular_id, 'school_id' => $posts['school_id']));
                  }
                  foreach ($other_ids as $other_id) {
                      $this->db->insert('physical_facilities_others', array('other_id' => $other_id, 'school_id' => $posts['school_id']));
                  }

                  $update_in_form_process = array(
                          'form_b_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/form_c/'.$posts['school_id']);
              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/form_b');
              }

        }else{

            $this->form_b();
        
        }

    }

    public function form_c_process($id = null){     
       
              if($id){
                  $update_in_form_process = array(
                          'form_c_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $id);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata('msg_success', 'Enrollement Added Successfully');
                  redirect('school/form_d/'.$id);
              }

            
          else{

                $this->form_c($id);
               }

    }

    public function delete_age_class_by_id($school_id=1){
        if($_POST)
        {
         $id=$this->input->post('age_class_ids');
          if(is_array($id)){
            $this->db->where_in('ageAndClassId', $id);
        }else{
            $this->db->where('ageAndClassId', $id);
        }
        $delete = $this->db->delete('age_and_class');
        if($delete)
        {
          $this->session->set_flashdata('msg_success', 'Enrollement Deleted Successfully');
                  redirect('school/form_c/'.$school_id);
        }
        else
        {
           $this->session->set_flashdata('msg_error', 'Something went Wrong');
                  redirect('school/form_c/'.$school_id);
        }
        }
       
    }
    public function delete_staff_info_by_id($school_id=1)
    {
       if($_POST)
        {
         $id=$this->input->post('staff_ids');
         //var_dump($id);exit;
          if(is_array($id)){
            $this->db->where_in('schoolStaffId', $id);
        }else{
            $this->db->where('schoolStaffId', $id);
        }
        $delete = $this->db->delete('school_staff');
        if($delete)
        {
          $this->session->set_flashdata('msg_success', 'Staff Record Deleted Successfully');
                  redirect('school/form_d/'.$school_id);
        }
        else
        {
           $this->session->set_flashdata('msg_error', 'Something went Wrong');
                  redirect('school/form_d/'.$school_id);
        }
        }
    }


    public function form_d_process($id = 1){
     if($id){
                  $update_in_form_process = array(
                          'form_d_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $id);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata('msg_success', 'Staff Added Successfully');
                  redirect('school/form_e/'.$id);
              }

            
          else{

                $this->form_d($id);
               }

    }


    public function form_e_process($id = 1){
    // echo "<pre >";
    // var_dump($this->input->post());   
    // exit;

        //validation configuration
        $validation_config = array(
            // array(
            //     'field' =>  'addmissionFee[]',
            //     'label' =>  'Addmission Fee',
            //     'rules' =>  'trim|required'
            // ),
            array(
                'field' =>  'tuitionFee[]',
                'label' =>  'Tuition Fee',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'securityFund[]',
                'label' =>  'Security Fund',
                'rules' =>  'trim|required'
            )
        );
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          $class_ids_array = $posts['class_id'];
          // $addmissionFee_array = $posts['addmissionFee'];
          $tuitionFee_array = $posts['tuitionFee'];
          $securityFund_array = $posts['securityFund'];
          $otherFund_array = $posts['otherFund'];
                              
          $count = count($class_ids_array);
              $msg = "New School has been created successfully";
              $type = "msg_success";
              $batch_data = [];
              for ($i=0; $i < $count; $i++) {
                array_push($batch_data,  array(
                            '`class_id`' => $class_ids_array[$i],
                            // '`addmissionFee`' => $addmissionFee_array[$i],
                            '`tuitionFee`' => $tuitionFee_array[$i],
                            '`securityFund`' => $securityFund_array[$i],
                            '`otherFund`' => $otherFund_array[$i],
                            '`school_id`' => $posts['school_id']
                                          ));   
              }
              $this->db->insert_batch('fee', $batch_data);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                  $update_in_form_process = array(
                          'form_e_status' => 1
                  );
                  if($posts['feeMentionedInForm'] == NULL){
                    $feeMentionedInForm_array = array('school_id'=> $posts['school_id']);
                    
                  }else{
                    $feeMentionedInForm_array = array('feeMentionedInForm' => $posts['feeMentionedInForm'], 'school_id'=> $posts['school_id']);
                  }


                  $this->db->insert('fee_mentioned_in_form_or_prospectus', $feeMentionedInForm_array);

                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/form_f/'.$posts['school_id']);
              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/create_form');
              }

        }else{

            $this->form_e();
        
        }

    }

    public function form_f_process($id = 1){
    // echo "<pre >";
    // var_dump($this->input->post());   
    // exit;

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'securityStatus',
                'label' =>  'Security Status',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'securityProvided',
                'label' =>  'Security Provided',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'exitDoorsNumber',
                'label' =>  'Exit Doors Number',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'watchTower',
                'label' =>  'watch Tower',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();

              $msg = "New School has been created successfully";
              $type = "msg_success";
              $this->db->insert('security_measures', $posts);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                $update_in_form_process = array(
                        'form_f_status' => 1
                );
                $this->db->where('user_id', $this->session->userdata('userId'));
                $this->db->where('school_id', $posts['school_id']);
                $this->db->update('forms_process', $update_in_form_process);

                $this->session->set_flashdata($type, $msg);
                redirect('school/form_g/'.$posts['school_id']);
              }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/form_f');
              }

        }else{

            $this->form_f();
        }

    }



    public function form_g_process($id = 1){

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'safeAssemblyPointsAvailable',
                'label' =>  'Safe Assembly Points Available',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'disasterTraining',
                'label' =>  'Disaster Training',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolImprovementPlan',
                'label' =>  'School Improvement Plan',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'electrification_condition_id',
                'label' =>  'Electrification Condition',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          if($posts['accessRoute'] != 'Safe'){
          $unSafeList1 = $posts['unSafeList'];
          unset($posts['unSafeList']);                             
          }

              $msg = "New School has been created successfully";
              $type = "msg_success";

              $this->db->insert('hazards_with_associated_risks', $posts);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                  if($posts['accessRoute'] != 'Safe'){
                      $count = count($unSafeList1);
                          $batch_data = [];
                          for ($i=0; $i < $count; $i++) {
                            array_push($batch_data,  array(
                                        '`unsafe_list_id`' => $unSafeList1[$i],
                                        '`school_id`' => $posts['school_id']
                                                      ));   
                          }
                      $this->db->insert_batch('`hazards_with_associated_risks_unsafe_list`', $batch_data);
                  }

                  $update_in_form_process = array(
                          'form_g_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/form_h/'.$posts['school_id']);

              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/create_form');
              }

        }else{

            $this->form_g();
            
            }

    }
    

    public function form_h_process($id = 1){

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'concession_id',
                'label' =>  'Safe Assembly Points Available',
                'rules' =>  'trim'
            ),
            array(
                'field' =>  'disasterTraining',
                'label' =>  'Disaster Training',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolImprovementPlan',
                'label' =>  'School Improvement Plan',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'electrification_condition_id',
                'label' =>  'Electrification Condition',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        // if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
            if($id != null){
              $msg = "New School has been created successfully";
              $type = "msg_success";
              $concession_ids = $posts['concession_id']; 
              $percentage = $posts['percentage'];
              $numberOfStudent = $posts['numberOfStudent'];                             
              $count = count($concession_ids);
                  $batch_data = [];
                  for ($i=0; $i < $count; $i++) {
                    array_push($batch_data,  array(
                    '`concession_id`' => $concession_ids[$i],
                    '`percentage`' => $percentage[$i],
                    '`numberOfStudent`' => $numberOfStudent[$i],
                    '`school_id`' => $posts['school_id']
                     ));
                  }
                  // echo "<pre >";
                  // var_dump($batch_data);
                  // exit();
                  $this->db->insert_batch('fee_concession', $batch_data);
                  $insert_id = $this->db->insert_id();

              $update_in_form_process = array(
                      'form_h_status' => 1
              );
              $this->db->where('user_id', $this->session->userdata('userId'));
              $this->db->where('school_id', $posts['school_id']);
              $this->db->update('forms_process', $update_in_form_process);
              

            }else{
              $type = "msg";
              $msg =  "School has been updated successfully";
              $insert_id = $this->school_m->save($post_data, $id);
            }
            
            if($insert_id){
                $this->session->set_flashdata($type, $msg);
                redirect('school/create_form');
            }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/create_form');
            }
        // }else{

        //     if($id == null){
        //     $this->form_f();
        //     }else{
        //       var_dump($this->input->post());
        //       exit;
        //     $this->session->set_flashdata('msg_error', "Something's wrong, Please try again.");
        //     $path = "school/edit/".$id;
        //     redirect($path);
        //     }
        
        // }

    }


  /**
   * edit a district
   * @param $district id integer
   */
  public function edit($id){

        $id = (int) $id;
        
        // code start
        $this->data['schooldata'] = $this->school_m->get_school_data_for_school_insertion($user_id);
        $tehsil_id = $this->data['schooldata']->tehsil_id;
        $this->data['ucs_list'] = $this->db->where('tehsil_id', $tehsil_id)->get('uc')->result();
        // var_dump($ucs_list);
        // exit();
        $this->load->model("general_modal");
        $this->data['school_types'] = $this->general_modal->school_types(0,false);
        $this->data['districts'] = $this->general_modal->districts();
        $this->data['gender_of_school'] = $this->general_modal->gender_of_school();
        $this->data['level_of_institute'] = $this->general_modal->level_of_institute();
        $this->data['reg_type'] = $this->general_modal->registration_type();
        $this->data['tehsils'] = $this->general_modal->tehsils();
        $this->data['ucs'] = $this->general_modal->ucs();
        $this->data['locations'] = $this->general_modal->location();
        $this->data['bise_list'] = $this->general_modal->bise_list();


        $this->data['type_of_institute'] = $this->general_modal->type_of_institute(false);
        $this->data['districts'] = $this->districts(false);
        $this->data['gender_of_school'] = $this->gender_of_school(false);
        $this->data['level_of_institute'] = $this->level_of_institute(false);
        // var_dump($this->data['type_of_institute']);
        // exit();
        $this->data['school'] = $this->school_m->get($id);
        $this->data['title'] = 'school';
        $this->data['description'] = 'here you can edit and save the changes on fly.';
        $this->data['view'] = 'school/school_edit';
        $this->load->view('layout', $this->data);

  }

  public function delete($complain_id){
    $complain_id = (int) $complain_id;
    $where = array('complainTypeId' => $complain_id );
    $result = $this->school_m->delete($where);
    if($result){
        $this->session->set_flashdata('msg_success', "complain Type successfully deleted.");
          redirect('complain_type');
      }else{
          $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
          redirect('complain_type');
    }
  }

  public function explore_schools_by_school_id($schools_id)
  {
    $schools_info = $this->school_m->get_schools_list_by_schools_id($schools_id);
    // $this->school_m->get_school_data_for_school_insertion($userId);
    // echo "<pre>";
    // print_r($schools_info);
    // exit;
    $this->data['schools'] = $schools_info;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/explore_schools_by_school_id';
    $this->load->view('layout', $this->data);
    
	  // $school_id = $this->db->where('schools_id', $school_id)->get('school')->result()[0]->schoolId;
   //    redirect('school/explore_school_by_id/'.$school_id);
  }

  public function explore_school_by_id($school_id){
      $this->data['school'] = $this->school_m->explore_schools_by_school_id_m($school_id);
      $this->data['school_bank'] = $this->school_m->get_bank_by_school_id($school_id);

      $this->data['school_physical_facilities'] = $this->school_m->physical_facilities_by_school_id($school_id);
      $this->data['school_physical_facilities_physical'] = $this->school_m->physical_facilities_physical_by_school_id($school_id);
      $this->data['school_physical_facilities_academic'] = $this->school_m->physical_facilities_academic_by_school_id($school_id);
      $this->data['school_physical_facilities_co_curricular'] = $this->school_m->physical_facilities_co_curricular_by_school_id($school_id);
      $this->data['school_physical_facilities_other'] = $this->school_m->physical_facilities_other_by_school_id($school_id);
      $this->data['school_library'] = $this->school_m->get_library_books_by_school_id($school_id);


      $this->data['age_and_class'] = $this->school_m->get_age_and_class_by_school_id($school_id);
      // $school_bank = $this->school_m->get_bank_by_school_id($school_id);

      $this->data['school_staff'] = $this->school_m->staff_by_school_id($school_id);

      $this->data['school_fee'] = $this->school_m->fee_by_school_id($school_id);
      $this->data['school_fee_mentioned_in_form'] = $this->school_m->fee_mentioned_in_form_by_school_id($school_id);
      //var_dump($this->data['school_fee_mentioned_in_form']);exit;

      $this->data['school_security_measures'] = $this->school_m->security_measures_by_school_id($school_id);

      $this->data['school_hazards_with_associated_risks'] = $this->school_m->hazards_with_associated_risks_by_school_id($school_id);
      $this->data['hazards_with_associated_risks_unsafe_list'] = $this->school_m->hazards_with_associated_risks_unsafe_list_by_school_id($school_id);
      
      $this->data['school_fee_concession'] = $this->school_m->fee_concession_by_school_id($school_id);
      $this->data['schoolId'] = $school_id;
      $this->data['title'] = 'school details';
      $query = $this->db->query("SELECT * FROM bank_transaction where school_id = '".$school_id."'");
      $this->data['bank_transaction'] = $query->result_array(); 
      // echo "<pre>"; print_r($this->data['bank_transaction']);exit();
      $this->data['description'] = 'here you can edit and save the changes on fly.';
      $this->data['view'] = 'school/school_full_details';
      $this->load->view('layout', $this->data);

  }


//  <====----  School edit starts here    ----====>

    // staff add, edit, delete
    public function school_staff_edit_by_id()
    {
        $staff_id = $this->input->post('id');
        $this->data['gender'] = $this->school_m->get_gender();
        $this->data['staff_type'] = $this->school_m->get_staff_type();

        $this->data['staff_info'] = $this->school_m->school_staff_by_id_m($staff_id);
        $this->load->view('school/school_staff_edit_in_modal', $this->data);
    }
    public function update_fee_concession_info()
    {
       // var_dump($this->input->post());
        // exit();
       $fee_concession_id = $this->input->post('feeConcessionId');
       $fee_concession_info=array(
         "concession_id" =>$this->input->post('concession_id'),
         "percentage" =>$this->input->post('percentage'),
         "numberOfStudent" =>$this->input->post('numberOfStudent')
        );

       $this->db->where('feeConcessionId',$fee_concession_id)->update('fee_concession', $fee_concession_info);
       $affected_row = $this->db->affected_rows();
       $arr = array();

       if($affected_row){
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Fee concession data is successfully changed.</strong>";
        }else{
          $arr["status"] = FALSE;
          // $arr["msg"] = validation_errors();  
          $arr['msg'] = "<strong class='text-center'>You didn't make any change in fee concession data.</strong>";
        }
        echo json_encode($arr);
        exit();
    }

    public function update_fee_info()
    {
         
       $fee_id = $this->input->post('feeId');
       $fee_info=array(
         "class_id" =>$this->input->post('class_id'),
         "addmissionFee" =>$this->input->post('addmissionFee'),
         "tuitionFee" =>$this->input->post('tuitionFee'),
         "securityFund" =>$this->input->post('securityFund'),
         "otherFund " =>$this->input->post('otherFund')
        );

       $this->db->where('feeId',$fee_id)->update('fee', $fee_info);
       $affected_row = $this->db->affected_rows();
       $arr = array();

       if($affected_row){
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Fee  data is successfully changed.</strong>";
        }else{
          $arr["status"] = FALSE;
          // $arr["msg"] = validation_errors();  
          $arr['msg'] = "<strong class='text-center'>You didn't make any change in fee  data.</strong>";
        }
        echo json_encode($arr);
        exit();
    }
    public function update_staff_info($staff_id)
    {
        // var_dump($this->input->post());
        // exit();
       $staff_info = $this->input->post();
       $this->db->where('schoolStaffId', $staff_id)->update('school_staff', $staff_info);
       $affected_row = $this->db->affected_rows();
       $arr = array();

       if($affected_row){
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Staff data is successfully changed.</strong>";
        }else{
          $arr["status"] = FALSE;
          // $arr["msg"] = validation_errors();  
          $arr['msg'] = "<strong class='text-center'>You didn't make any change in Staff data.</strong>";
        }
        echo json_encode($arr);
        exit();

    }

    public function delete_record_by_id()
    {
        $id = $this->input->post('id');
        $column = $this->input->post('column');
        $table = $this->input->post('table');
        // var_dump($this->input->post());
        // exit();
        $response = $this->school_m->delete_record_by_id_m($id, $column, $table);
        $arr = array();

        if($response){
           $arr["status"] = TRUE;
           
         }else{
           $arr["status"] = FALSE;
           // $arr["msg"] = validation_errors();  
         }
         echo json_encode($arr);
         exit();
    }

    public function school_fund_add_ajax(){
      // var_dump($this->input->post());
      // exit;
        $this->data['school_id'] = $this->input->post('id');
        $this->data['age_list'] = $this->db->get('age')->result();
        $this->data['class_list'] = $this->db->get('class')->result();

        $this->load->view('school/school_fund_add_in_modal', $this->data);
    }
    public function school_fee_edit_by_id()
    {
                $fee_id = $this->input->post('id');
                $this->data['fee_info']=$this->db->where('feeId',$fee_id)->get('fee')->row();
                $this->data['age_list'] = $this->db->get('age')->result();
                $this->data['class_list'] = $this->db->get('class')->result();

                $this->load->view('school/school_fund_edit_in_modal', $this->data);
    }

    public function school_fund_add_process_ajax()
    {         
      // 
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'class_id',
                'label' =>  'Class',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'addmissionFee',
                'label' =>  'Addmission Fee',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'tuitionFee',
                'label' =>  'Tuition Fee',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'securityFund',
                'label' =>  'Security Fund',
                'rules' =>  'trim|required'
            )
        );

        
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
        $arr = array();
        $posts = $this->input->post();
        $this->db->insert('fee', $posts);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Dues/Fund data is successfully save.</strong>";
          $arr['id'] = $insert_id;
        }else{
          $arr["status"] = FALSE;
          $arr["msg"] = "<strong class='text-center'>Internal Server Error, Try again.</strong>";  
        }
        }else{
           $arr["status"] = FALSE;
           $arr["msg"] = validation_errors();            
        }
        echo json_encode($arr);
        exit();
    }

    public function get_fund_record_by_id()
    {
        $id = $this->input->post('id');
        $this->data['fund_info'] = $this->school_m->school_fund_by_id_m($id);
        $this->data['class_list'] = $this->db->get('class')->result();

        $query_for_fund = "SELECT COUNT(`feeId`) AS fund_count FROM `fee` WHERE `school_id` ='".$this->data['fund_info']->school_id."';";
        $query_result = $this->db->query($query_for_fund)->result();
        $this->data['fund_count'] = $query_result[0]->fund_count;

        // the view below is only for one row
        $this->load->view('school/school_fund_row_append_in_modal', $this->data);
        
        // var_dump($this->data['fund_info']);
        // exit();
    }

    public function fee_concession_edit_by_id()
    {
        $fee_concession_id = $this->input->post('id');
        $this->data['fee_concession_info']=$this->db->where('feeConcessionId',$fee_concession_id)->get('fee_concession')->row();
       
        $this->load->view('school/fee_concession_edit_in_modal', $this->data);
    }

    public function school_enrollement_add_ajax(){
        $this->data['school_id'] = $this->input->post('id');
        $this->data['age_list'] = $this->db->get('age')->result();
        $this->data['class_list'] = $this->db->get('class')->result();

        $this->load->view('school/school_enrollement_add_in_modal', $this->data);
    }

    public function school_enrollement_add_process_ajax()
    {

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'age_id',
                'label' =>  'Age',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'class_id',
                'label' =>  'Class',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'enrolled',
                'label' =>  'Enrolled',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'gender_id',
                'label' =>  'Gender',
                'rules' =>  'trim|required'
            )
        );

        
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
        $arr = array();
        $posts = $this->input->post();
        $this->db->insert('age_and_class', $posts);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
          $arr["status"] = true;
          $arr["msg"] = "<strong class='text-center'>Enrollement data is successfully save.</strong>";
          $arr['id'] = $insert_id;
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
                    WHERE `age_and_class`.`ageAndClassId` = '".$insert_id."';";
                    $query = $this->db->query($age_and_class_query);
                    $arr['age_class']= $query->row();
         
        }else{
          $arr["status"] = false;
          $arr["msg"] = "<strong class='text-center'>Internal Server Error, Try again.</strong>";  
        }
        }else{
           $arr["status"] = false;
           $arr["msg"] = validation_errors();            
        }
        echo json_encode($arr);
        exit();
    }

// if the school id is set then display only total enrolled students in enrollement section
    public function get_enrolled_record_by_id($school_id = 0)
    {
        $this->data['enrolled_flag'] = FALSE;
        // comment here
        // in deletion process only outer of if code will execute wihile in addition whole code will be run 
        if($school_id == 0 ){
            $this->data['enrolled_flag'] = TRUE;

            $id = $this->input->post('id');
            // below query is used for fetching school id in case of addition else the outer code will conroll the execution and the view will be conntroll the '$this->data['enrolled_flag']' set with true or false flag.
            $age_and_class_query_result = $this->db->where('ageAndClassId', $id)->get('age_and_class')->result();
            $school_id = $age_and_class_query_result[0]->school_id;
            // print_r($age_and_class_query_result);
            // exit();
            $this->data['enrollement_info'] = $this->school_m->school_enrollement_by_id_m($id);
            $this->data['age_list'] = $this->db->get('age')->result();
            $this->data['class_list'] = $this->db->get('class')->result();

        }

        $query_for_enrolled = "SELECT SUM(`enrolled`) AS enrolled_sum, COUNT(`enrolled`) AS enrolled_count FROM `age_and_class` WHERE `school_id` = $school_id;";
        $query_result = $this->db->query($query_for_enrolled)->result();
        $this->data['enrolled_sum'] = $query_result[0]->enrolled_sum;
        $this->data['enrolled_count'] = $query_result[0]->enrolled_count;

                // the view below is only for one row
        $this->load->view('school/school_enrolled_row_append_in_modal', $this->data);
        
        // var_dump($this->data['staff_info']);
        // exit();
    }



    public function school_staff_add_ajax(){
        $this->data['school_id'] = $this->input->post('id');
        // var_dump($this->data['school_id']);
        // exit();
        $this->data['gender'] = $this->school_m->get_gender();
        $this->data['staff_type'] = $this->school_m->get_staff_type();
        $this->load->view('school/school_staff_add_in_modal', $this->data);
    }

    public function school_staff_add_process_ajax()
    {
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'schoolStaffName',
                'label' =>  'Name',
                'rules' =>  'trim'
            ),
            array(
                'field' =>  'schoolStaffFatherOrHusband',
                'label' =>  'Father Or Husband Name',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffCnic',
                'label' =>  'CNIC',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffGender',
                'label' =>  'Gender',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffType',
                'label' =>  'Staff Type',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffAppointmentDate',
                'label' =>  'Date Of Appointment',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffNetPay',
                'label' =>  'Net Pay',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'schoolStaffDesignition',
                'label' =>  'Designation',
                'rules' =>  'trim|required'
            )
        );

        
        $this->form_validation->set_rules($validation_config);
        $this->form_validation->set_error_delimiters('<div style="color:white;">', '</div>');
        if($this->form_validation->run() === TRUE){
        $arr = array();
        $posts = $this->input->post();
        $this->db->insert('school_staff', $posts);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Staff data is successfully save.</strong>";
          $arr['id'] = $insert_id;
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
                            WHERE `school_staff`.`schoolStaffId` = '".$insert_id."';";
                    $query = $this->db->query($staff_query);
                    $arr['staff_info']=$query->row();
        }else{
          $arr["status"] = FALSE;
          $arr["msg"] = "<strong class='text-center'>Internal Server Error, Try again.</strong>";  
        }
        }else{
           $arr["status"] = FALSE;
           $arr["msg"] = validation_errors();            
        }
        echo json_encode($arr);
        exit();
    }

    public function get_staff_record_by_id()
    {
        $id = $this->input->post('id');
        $this->data['staff_info'] = $this->school_m->school_staff_by_id_m($id);
        $this->data['gender'] = $this->school_m->get_gender();
        $this->data['staff_type'] = $this->school_m->get_staff_type();
        // the view below is only for one row
        $this->load->view('school/school_staff_row_append_in_modal', $this->data);
        
        // var_dump($this->data['staff_info']);
        // exit();
    }

      public function physical_facilities_view_edit(){
      $this->load->model("general_modal");
      $school_id = $this->input->post('id');
      $this->data['school_physical_facilities'] = $this->school_m->physical_facilities_by_school_id($school_id);
      // physical facilities
      $school_physical_facilities_physical = $this->school_m->physical_facilities_physical_by_school_id($school_id);
      $physical_ids = array();
      foreach($school_physical_facilities_physical as $ph_obj) {
          $physical_ids[] = $ph_obj->pf_physical_id;
      }
      $this->data['facilities_physical_ids'] = $physical_ids;
      // end

      // academic 
      $academic = $this->school_m->physical_facilities_academic_by_school_id($school_id);
      $academic_ids = array();
      foreach($academic as $acad_obj) {
          $academic_ids[] = $acad_obj->academic_id;
      }
      $this->data['academic_ids'] = $academic_ids;
      // end academic_ids
      
      // curricular_ids 
      $curricular = $this->school_m->physical_facilities_co_curricular_by_school_id($school_id);
      $curricular_ids = array();
      foreach($curricular as $curricular_obj) {
          $curricular_ids[] = $curricular_obj->co_curricular_id;
      }
      $this->data['curricular_ids'] = $curricular_ids;

      // end co-curricular ids
      // other ids
      $other = $this->school_m->physical_facilities_other_by_school_id($school_id);
      $other_ids = array();
      foreach($other as $other_obj) {
          $other_ids[] = $other_obj->other_id;
      }
      $this->data['other_ids'] = $other_ids;

      // $this->data['school_library'] = $this->school_m->get_library_books_by_school_id($school_id);
      // var_dump($this->data['school_physical_facilities']);exit();

      $this->data['school_id'] = (int) $school_id;
      $this->data['buildings'] = $this->general_modal->building();
      $this->data['physical'] = $this->general_modal->physical();
      $this->data['academics'] = $this->general_modal->academic();
      $this->data['book_types'] = $this->general_modal->book_type();
      $this->data['co_curriculars'] = $this->general_modal->co_curricular();
      $this->data['other'] = $this->general_modal->other();    
      // var_dump($this->data['other']);
      // exit();
      $this->load->view('school/form_b_edit_in_modal', $this->data);
    }

    public function physical_facilities_view_edit_process()
    {
          $posts = $this->input->post();
          if (!isset($posts['numberOfComputer'])) 
          { 
            $numberOfComputer = "";
          }else{
            $numberOfComputer = $posts['numberOfComputer'];
          }
          // // var_dump($posts);
          // exit();
        $validation_config = array(
            array(
                'field' =>  'building_id',
                'label' =>  'School Building',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfClassRoom',
                'label' =>  'Number Of Class Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'numberOfOtherRoom',
                'label' =>  'Number Of Other Rooms',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'totalArea',
                'label' =>  'Total Area',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'coveredArea',
                'label' =>  'Covered Area',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          $school_id = $posts['school_id'];
          $mainData = array(
            'building_id' => $posts['building_id'],
            'numberOfClassRoom' => $posts['numberOfClassRoom'],
            'numberOfOtherRoom' => $posts['numberOfOtherRoom'],
            'totalArea' => $posts['totalArea'],
            'coveredArea' => $posts['coveredArea'],
            'numberOfComputer' => $numberOfComputer,
            'numberOfLatrines' => $posts['numberOfLatrines'],
            'school_id' => $posts['school_id']
            );


          $this->db->where('physicalFacilityId', $posts['physicalFacilityId'])->update('physical_facilities', $mainData);
          $affected_row = $this->db->affected_rows();
                    // if(!empty($posts['numberOfBooks'])){
                    //   $book_type_ids_array = $posts['book_type_ids'];
                    //   $numberOfBooks_array = $posts['numberOfBooks'];
                    //   $count = count($book_type_ids_array);

                    //       $library_batch_data = [];
                    //       for ($i=0; $i < $count; $i++) {
                    //         array_push($library_batch_data,  array(
                    //                                   '`book_type_id`' => $book_type_ids_array[$i],
                    //                                   '`numberOfBooks`' => $numberOfBooks_array[$i],
                    //                                   '`school_id`' => $posts['school_id']
                    //                                 ));
                            
                    //       }
                    //       $this->db->insert_batch('school_library', $library_batch_data);
                    //       $insert_id = $this->db->insert_id();

                    // }
                  $this->db->where('school_id', $school_id);
                  $this->db->delete(array('physical_facilities_physical','physical_facilities_academic','physical_facilities_co_curricular', 'physical_facilities_others'));


                  if(isset($posts['pf_physical_id'])){
                    $pf_physical_ids = $posts['pf_physical_id'];
                    foreach ($pf_physical_ids as $pf_physical_id) {
                      $this->db->insert('physical_facilities_physical', array('pf_physical_id' => $pf_physical_id, 'school_id' => $posts['school_id']));
                    }
                  }

                  if (isset($posts['academic_id'])) {
                    $academic_ids    = $posts['academic_id'];
                      foreach ($academic_ids as $academic_id) {
                          $this->db->insert('physical_facilities_academic', array('academic_id' => $academic_id, 'school_id' => $posts['school_id']));
                      }
                  }


                  if (isset($posts['co_curricular_id'])) {
                    $co_curricular_ids    = $posts['co_curricular_id'];
                      foreach ($co_curricular_ids as $co_curricular_id) {
                          $this->db->insert('physical_facilities_co_curricular', array('co_curricular_id' => $co_curricular_id, 'school_id' => $posts['school_id']));
                      }
                  }

                  if(isset($posts['other_id'])){
                    $other_ids    = $posts['other_id'];
                      foreach ($other_ids as $other_id) {
                          $this->db->insert('physical_facilities_others', array('other_id' => $other_id, 'school_id' => $posts['school_id']));
                      }
                  }

                  $arr["status"] = TRUE;
                  $arr["msg"] = "<strong class='text-center'>Physical Facilities Data Successfully Updated.</strong>";
                    // $arr['id'] = $insert_id;

    }else{

         $arr["status"] = FALSE;
         $arr["msg"] = validation_errors();
    }
      echo json_encode($arr);
      exit();
  }


  public function add_books_in_library_view()
  {
      $this->data['school_id'] = $this->input->post('id');
      $this->load->model('general_modal');
      $this->data['book_types'] = $this->general_modal->book_type();
      $this->load->view('school/add_books_in_library_view', $this->data);
      // var_dump($this->input->post());
      // exit();
  }
  public function add_books_in_library_process()
  {
      // var_dump($this->input->post());
      // exit();
      $validation_config = array(
          array(
              'field' =>  'book_type_id',
              'label' =>  'Book Type',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'numberOfBooks',
              'label' =>  'Number Of Books',
              'rules' =>  'trim|required'
          )
      );

      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
          $this->db->insert('school_library', $this->input->post());
          $insert_id = $this->db->insert_id();
          if($insert_id){
            $this->session->set_flashdata('msg_success', "Books added to library successfully.");
            redirect('school/explore_school_by_id/'.$this->input->post('school_id'));
          }else{
              $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
              redirect('school/explore_school_by_id/'.$this->input->post('school_id'));
          }
          
      }else{
          $this->session->set_flashdata('msg', "validation Error kindly fill the form properly.");
          redirect('school/explore_school_by_id/'.$this->input->post('school_id'));
      }
  }

  public function security_measures_edit_view_ajax_modal()
  {
    $school_id = $this->input->post('id');
    $this->data['school_id'] = $school_id;
    $this->data['security_status'] = $this->school_m->get_security_status();
    $this->data['security_provided'] = $this->school_m->get_security_provided();
    $this->data['security_personnel'] = $this->school_m->get_security_personnel();
    $this->data['security_license_issued'] = $this->school_m->get_security_license_issued();

    $this->data['school_security_measures'] = $this->db->where('school_id', $school_id)->get('security_measures')->result()[0];
    // var_dump($this->data['school_security_measures']);
    $this->load->view('school/school_security_edit_modal_view', $this->data);
    // echo "<pre />";
    // var_dump($this->data['security_status']);
    // exit();

}

public function security_measures_edit_view_ajax_process()
{
      $securityMeasureId = $this->input->post('securityMeasureId');
      $posts = $this->input->post();
      unset($posts['securityMeasureId']);
      unset($posts['school_id']);
      // var_dump($posts);
      // exit();
      $validation_config = array(
          array(
              'field' =>  'securityStatus',
              'label' =>  'Security Status',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'securityProvided',
              'label' =>  'Security Provided',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'exitDoorsNumber',
              'label' =>  'Exit Doors Number',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'watchTower',
              'label' =>  'watch Tower',
              'rules' =>  'trim|required'
          )
      );

      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
      // $staff_info = $this->input->post();
      $this->db->where('securityMeasureId', $securityMeasureId)->update('security_measures', $posts);
      $affected_row = $this->db->affected_rows();
      $arr = array();

      if($affected_row){
         $arr["status"] = TRUE;
         $arr["msg"] = "<strong class='text-center'>Security Measures Successfully Changed.</strong>";
       }else{
         $arr["status"] = FALSE;
         // $arr["msg"] = validation_errors();  
         $arr['msg'] = "<strong class='text-center'>You didn't make any change in Security Measures data.</strong>";
       }

    }else{
        $arr["status"] = FALSE;
        $arr["msg"] = validation_errors();  
        // $arr['msg'] = "<strong class='text-center'>You didn't make any change in Staff data.</strong>";
    }
        echo json_encode($arr);
        exit();

}

public function hazard_risk_edit_view_ajax_modal(){
    $school_id = $this->input->post('id');
    $this->data['school_id'] = $school_id;
    $this->data['building_structure'] = $this->school_m->get_building_structure();
    $this->data['hazards_surrounded'] = $this->school_m->get_hazards_surrounded();
    $this->data['hazards_electrification'] = $this->school_m->get_hazards_electrification();
    $this->data['unsafe_list'] = $this->school_m->get_unsafe_list();
    $this->data['hazards_hazard_with_associated_risks'] = $this->school_m->hazards_hazard_with_associated_risks($school_id)[0];
    // unsafe_ids 
    $unsafe_list = $this->school_m->get_unsafe_by_school_id($school_id);
    // var_dump($this->data['hazards_hazard_with_associated_risks']);
    // exit;
    $unsafe_ids = array();
    foreach($unsafe_list as $unsafe ) {
        $unsafe_ids[] = $unsafe->unsafe_list_id;
    }
    $this->data['unsafe_ids'] = $unsafe_ids;

    // var_dump($this->data['hazards_hazard_with_associated_risks']);
    // exit();
    $this->load->view('school/hazards_risks_edit_in_modal', $this->data);
}
public function hazard_risk_edit_view_ajax_modal_process()
{
    // echo "<pre />";
    // var_dump($this->input->post());
    // exit();

        $posts = $this->input->post();
        if($posts['accessRoute'] != 'Safe'){
        $unSafeList1 = $posts['unSafeList'];
        unset($posts['unSafeList']);                             
        }
        $arr = array();
        $hazardsWithAssociatedRisksId = $posts['hazardsWithAssociatedRisksId'];
        $school_id = $posts['school_id'];
        unset($posts['school_id']);
        unset($posts['hazardsWithAssociatedRisksId']);
        $this->db->where('hazardsWithAssociatedRisksId', $hazardsWithAssociatedRisksId)->update('hazards_with_associated_risks', $posts);
        $query_result = $this->db->affected_rows();

       // unsafe list deletion old list and insert new one 
        if($posts['accessRoute'] != 'Safe'){
            $count = count($unSafeList1);
                $batch_data = [];
                for ($i=0; $i < $count; $i++) {
                  array_push($batch_data,  array(
                              '`unsafe_list_id`' => $unSafeList1[$i],
                              '`school_id`' => $school_id
                                            ));   
                }

            // supply id column and then table name in argument list
            $this->school_m->delete_record_by_id_m($school_id, 'school_id', 'hazards_with_associated_risks_unsafe_list');
            $this->db->insert_batch('`hazards_with_associated_risks_unsafe_list`', $batch_data);
            $insert_id = $this->db->insert_id();

            }
            if($query_result > 0 ){
                  $arr["status"] = TRUE;
                  $arr["msg"] = "<strong class='text-center'>Hazards With Assiociated Risks Successfully Changed.</strong>";
            }else{
                $arr["status"] = FALSE;
                $arr['msg'] = "<strong class='text-center'>You didn't make any change in Security Measures data.</strong>";
            }
                // $arr["status"] = FALSE;
                // $arr["msg"] = validation_errors();  
                // $arr['msg'] = "<strong class='text-center'>You didn't make any change in Staff data.</strong>";

                echo json_encode($arr);
                exit();
}

public function school_update_by_school_user_after_copying_data()
{
   $school_id = $this->input->post('id');
   $this->data['school_id'] = $school_id;
   $this->load->view('school/renewal_update_form_for_school_user', $this->data);
}

public function school_update_by_school_user_after_copying_data_process()
{

  $post = $this->input->post();
  // echo "<pre>";print_r($post);
  // exit();
  if ($this->input->post('bt_date')) {
    $count = count($this->input->post('bt_date'));
    for ($i=0; $i <$count ; $i++){ 
      $InserData = array(
      'school_id' => $this->input->post('school_id'),
      'reg_type_id' => $this->input->post('reg_type_id'),
      'bt_no' => $_POST['bt_no'][$i],
      'bt_date' => $_POST['bt_date'][$i],     
      );
      $query = $this->db->query("SELECT * FROM bank_transaction where bt_no='".$_POST['bt_no'][$i]."'");
      $num_rows =  $query->num_rows(); 
      if($num_rows > 0){
        echo "THis ".$_POST['bt_no'][$i]." tracsaction no already used";exit();
      }else{
        $this->db->insert('bank_transaction', $InserData);
      }
    }
   
  }
  
  
  $school_id = $post['school_id'];
   $this->db->where('schoolId', $school_id);
  
  $current_session=$this->db->get('school')->row();
  $schools_id=$current_session->schools_id;
  $status=$current_session->status;
  //echo $school_id;exit;
  
  $this->db->where('schools_id', $schools_id);
  $this->db->where('status', 1);
  $this->db->order_by('schoolId', 'DESC');
  $previos_session=$this->db->get('school')->row();
  $school_inserted_id=$school_id;
  $school_id=$previos_session->schoolId;
  //var_dump($previos_session);exit;
  ///////////////////////////////////
  ///////////////////////////////////
  //////////////////////////////////
  // Copy School Data
  if($status ==0)
  {
    $this->db->trans_begin();
  //  if($skip_post_data == false){
    
  //   $post = $this->input->post();
  //   $schools_data_to_update = array(
  //       'level_of_school_id' => $post['level_of_school_id'],
  //       'gender_type_id' => $post['gender_type_id'],
  //       'school_type_id' => $post['type_of_institute_id'],
  //       'reg_type_id' => $post['reg_type_id'],
  //       'schoolName' => $post['name'],
  //       'ppcName'=> $post['ppcName'],
  //       'ppcCode'=> $post['ppcCode'],
  //       'schoolTypeOther'=> $post['schoolTypeOther']
  //   );

  //   $this->db->where('schoolId', $post['schools_id']);
  //   $this->db->update('schools', $schools_data_to_update);
  //   $affected_rows = $this->db->affected_rows();

  //   // getting school Id and then get all old data by this school id and updated with renewal school id 
  //   $school_id = $this->db->where('schools_id', $post['schools_id'])->order_by('schoolId', 'desc')->get('school')->result()[0]->schoolId;

  //   $school_data_to_insert = array(
  //                           'reg_type_id' => $post['reg_type_id'],
  //                           'schools_id' => $post['schools_id'],
  //                           'session_year_id' => $post['session_year_id'],
  //                           'level_of_school_id' => $post['level_of_school_id'],
  //                           'gender_type_id' => $post['gender_type_id'],
  //                           'school_type_id' => $post['type_of_institute_id'],
  //                           'updatedDate' => $post['createdDate'],
  //                           'school_will_be_update_by_school_user' => 1,
  //                           'updatedBy' => $this->session->userdata('userId')
  //                         );
  //   $this->db->insert('school', $school_data_to_insert);
  //   $school_inserted_id = $this->db->insert_id();

  //   $this->db->insert('forms_process', array('user_id' => $post['owner_id'],
  //                                           'reg_type_id' => $post['reg_type_id'],
  //                                           'form_a_status' => 1,
  //                                           'school_id' => $school_inserted_id                                       
  //                                     ));
  // }

  // $physical_facilities = $this->school_m->physical_facilities_by_school_id($school_id);
  $physical_facilities =  $this->db->where('school_id', $school_id)->get('physical_facilities')->row();

  if(!empty($physical_facilities)){
        $physical_facilities = $physical_facilities;
        $physical_facilities_array = array(
        'building_id' => $physical_facilities->building_id ,
        'numberOfClassRoom' => $physical_facilities->numberOfClassRoom ,
        'numberOfOtherRoom' => $physical_facilities->numberOfOtherRoom ,
        'totalArea' => $physical_facilities->totalArea ,
        'coveredArea' => $physical_facilities->coveredArea ,
        'numberOfComputer' => $physical_facilities->numberOfComputer,
        'numberOfLatrines' => $physical_facilities->numberOfLatrines,
        'school_id' => $school_inserted_id
        );
        $this->db->insert('physical_facilities', $physical_facilities_array);
    }
    // get and insert as a batch insertion
    $school_physical_facilities_physical = $this->school_m->physical_facilities_physical_by_school_id($school_id);
    $school_physical_facilities_physical_array = array();
    foreach ($school_physical_facilities_physical as $spfp) {
      array_push($school_physical_facilities_physical_array, array(
        'school_id' => $school_inserted_id,
        'pf_physical_id' => $spfp->pf_physical_id
        )
      );
    }
    if(!empty($school_physical_facilities_physical_array)){
     $this->db->insert_batch('physical_facilities_physical', $school_physical_facilities_physical_array);
   }



    // get "physical_facilities_academic" table data and insert as batch
    $school_physical_facilities_academic = $this->school_m->physical_facilities_academic_by_school_id($school_id);
    $school_physical_facilities_academic_array = array();
    foreach ($school_physical_facilities_academic as $spfa) {
      array_push($school_physical_facilities_academic_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'academic_id' => $spfa->academic_id
                                                            )
      );
    }
    if(!empty($school_physical_facilities_academic_array)){
      $this->db->insert_batch('physical_facilities_academic', $school_physical_facilities_academic_array);
    }

    //  get "physical_facilities_co_curricular" and insert wiht school_id
    $physical_facilities_co_curricular = $this->school_m->physical_facilities_co_curricular_by_school_id($school_id);
    $physical_facilities_co_curricular_array = array();
    foreach ($physical_facilities_co_curricular as $pfcc) {
      array_push($physical_facilities_co_curricular_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'co_curricular_id' => $pfcc->co_curricular_id
                                                            )
      );
    }
    if(!empty($physical_facilities_co_curricular_array)){
      $this->db->insert_batch('physical_facilities_co_curricular', $physical_facilities_co_curricular_array);
    }

    //  get "school_physical_facilities_other" and insert wiht school_id
    $physical_facilities_others =  $this->school_m->physical_facilities_other_by_school_id($school_id);
    $physical_facilities_others_array = array();
    foreach ($physical_facilities_others as $pfo) {
      array_push($physical_facilities_others_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'other_id' => $pfo->other_id
                                                            )
      );
    }
    if(!empty($physical_facilities_others_array)){
      $this->db->insert_batch('physical_facilities_others', $physical_facilities_others_array);
    }

    //  get "school_physical_facilities_other"  and insert wiht school_id
    $school_library = $this->school_m->get_library_books_by_school_id($school_id);
    $school_library_array = array();
    foreach ($school_library as $sl) {
      array_push($school_library_array, array(
                                        'school_id' => $school_inserted_id,
                                        'book_type_id' => $sl->book_type_id,
                                        'numberOfBooks' => $sl->numberOfBooks
                                      )
      );
    }
    if(!empty($school_library_array)){
      $this->db->insert_batch('school_library', $school_library_array);
    }
    // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_b_status' => 1));

    //  get "age_and_class"  and insert wiht school_id
    // $age_and_class = $this->db->where('school_id', $school_id)->get('age_and_class')->result();
    // $age_and_class_array = array();
    // foreach ($age_and_class as $ac) {
    //   array_push($age_and_class_array, array(
    //                                     'school_id' => $school_inserted_id,
    //                                     'age_id' => $ac->age_id,
    //                                     'class_id' => $ac->class_id,
    //                                     'enrolled' => $ac->enrolled,
    //                                     'gender_id' => $ac->gender_id,
    //                                     'total' => $ac->total
    //                                   )
    //   );
    // }
    // if(!empty($age_and_class_array)){
    //   $this->db->insert_batch('age_and_class', $age_and_class_array);
    // }
    // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_c_status' => 1));

    //  get "age_and_class"  and insert wiht school_id
    $school_staff = $this->school_m->staff_by_school_id($school_id);
    $school_staff_array = array();
    foreach ($school_staff as $ss) {
      array_push($school_staff_array, array(
                                        'school_id' => $school_inserted_id,
                                        'schoolStaffName' => $ss->schoolStaffName,
                                        'schoolStaffFatherOrHusband' => $ss->schoolStaffFatherOrHusband,
                                        'schoolStaffCnic' => $ss->schoolStaffCnic,
                                        'schoolStaffQaulificationProfessional' => $ss->schoolStaffQaulificationProfessional,
                                        'schoolStaffQaulificationAcademic' => $ss->schoolStaffQaulificationAcademic,
                                        'schoolStaffAppointmentDate' => $ss->schoolStaffAppointmentDate,
                                        'schoolStaffDesignition' => $ss->schoolStaffDesignition,
                                        'schoolStaffNetPay' => $ss->schoolStaffNetPay,
                                        'schoolStaffAnnualIncreament' => $ss->schoolStaffAnnualIncreament,
                                        'schoolStaffType' => $ss->schoolStaffType,
                                        'schoolStaffGender' => $ss->schoolStaffGender,
                                        'TeacherTraining' => $ss->TeacherTraining,
                                        'TeacherExperience' => $ss->TeacherExperience
                                      )

      );
    }

    if(!empty($school_staff_array)){
      $this->db->insert_batch('school_staff', $school_staff_array);
    }

    

     //get "fee"  and insert wiht school_id
    $school_fee = $this->school_m->fee_by_school_id($school_id);
    $school_fee_array = array();
    foreach ($school_fee as $sf) {
      array_push($school_fee_array, array(
                                        'school_id' => $school_inserted_id,
                                        'class_id' => $sf->class_id,
                                        'addmissionFee' => $sf->addmissionFee,
                                        'tuitionFee' => $sf->tuitionFee,
                                        'otherFund' => $sf->otherFund,
                                        'securityFund' => $sf->securityFund
                                      )
      );
    }
    if(!empty($school_fee_array)){
      $this->db->insert_batch('fee', $school_fee_array);
    }
    // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_d_status' => 1));

    //  get "fee_mentioned_in_form_or_prospectus"  and insert wiht school_id
    $school_fee_mentioned_in_form = $this->school_m->fee_mentioned_in_form_by_school_id($school_id);
    if(!empty($school_fee_mentioned_in_form)){
      $this->db->insert('fee_mentioned_in_form_or_prospectus', array(
                                        'school_id' => $school_inserted_id,
                                        'feeMentionedInForm'=> $school_fee_mentioned_in_form->feeMentionedInForm
                                      )
                                    );
    }  
    // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_e_status' => 1));
    


    //  get "security_measures"  and insert wiht school_id
    $school_security_measures = $this->school_m->security_measures_by_school_id($school_id);
    if(!empty($school_security_measures)){
      $school_security_measures_array = array(
                                'school_id' => $school_inserted_id,
                                'securityStatus' => $school_security_measures->securityStatus,
                                'securityProvided' => $school_security_measures->securityProvided,
                                'securityPersonnel' => $school_security_measures->securityPersonnel,
                                'security_personnel_status_id' => $school_security_measures->security_personnel_status_id,
                                'security_according_to_police_dept' => $school_security_measures->security_according_to_police_dept,
                                'cameraInstallation' => $school_security_measures->cameraInstallation,
                                'camraNumber' => $school_security_measures->camraNumber,
                                'dvrMaintained' => $school_security_measures->dvrMaintained,
                                'cameraOnline' => $school_security_measures->cameraOnline,
                                'exitDoorsNumber' => $school_security_measures->exitDoorsNumber,
                                'emergencyDoorsNumber' => $school_security_measures->emergencyDoorsNumber,
                                'boundryWallHeight' => $school_security_measures->boundryWallHeight,
                                'wiresProvided' => $school_security_measures->wiresProvided,
                                'watchTower' => $school_security_measures->watchTower,
                                'licensedWeapon' => $school_security_measures->licensedWeapon,
                                'licenseNumber' => $school_security_measures->licenseNumber,
                                'ammunitionStatus' => $school_security_measures->ammunitionStatus,
                                'metalDetector' => $school_security_measures->metalDetector,
                                'walkThroughGate' => $school_security_measures->walkThroughGate,
                                'gateBarrier' => $school_security_measures->gateBarrier,
                                'license_issued_by_id' => $school_security_measures->license_issued_by_id
                              );
        $this->db->insert('security_measures', $school_security_measures_array);
        $this->db->insert_id();
      } 
      // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_f_status' => 1));
      

    //  get "security_measures"  and insert wiht school_id
    $school_hazards_with_associated_risks = $this->school_m->hazards_with_associated_risks_by_school_id($school_id);
    if(!empty($school_hazards_with_associated_risks)){
      $school_hazards_with_associated_risks_array = array(
                                'school_id' => $school_inserted_id,
                                'exposedToFlood' => $school_hazards_with_associated_risks->exposedToFlood,
                                'drowning' => $school_hazards_with_associated_risks->drowning,
                                'buildingCondition' => $school_hazards_with_associated_risks->buildingCondition,
                                'accessRoute' => $school_hazards_with_associated_risks->accessRoute,
                                'adjacentBuilding' => $school_hazards_with_associated_risks->adjacentBuilding,
                                'safeAssemblyPointsAvailable' => $school_hazards_with_associated_risks->safeAssemblyPointsAvailable,
                                'disasterTraining' => $school_hazards_with_associated_risks->disasterTraining,
                                'schoolImprovementPlan' => $school_hazards_with_associated_risks->schoolImprovementPlan,
                                'schoolDisasterManagementPlan' => $school_hazards_with_associated_risks->schoolDisasterManagementPlan,
                                'electrification_condition_id' => $school_hazards_with_associated_risks->electrification_condition_id,
                                'ventilationSystemAvailable' => $school_hazards_with_associated_risks->ventilationSystemAvailable,
                                'chemicalsSchoolLaboratory' => $school_hazards_with_associated_risks->chemicalsSchoolLaboratory,
                                'chemicalsSchoolSurrounding' => $school_hazards_with_associated_risks->chemicalsSchoolSurrounding,
                                'roadAccident' => $school_hazards_with_associated_risks->roadAccident,
                                'safeDrinkingWaterAvailable' => $school_hazards_with_associated_risks->safeDrinkingWaterAvailable,
                                'sanitationFacilities' => $school_hazards_with_associated_risks->sanitationFacilities,
                                'building_structure_id' => $school_hazards_with_associated_risks->building_structure_id,
                                'school_surrounded_by_id' => $school_hazards_with_associated_risks->school_surrounded_by_id
                              );
        $this->db->insert('hazards_with_associated_risks', $school_hazards_with_associated_risks_array);
        $this->db->insert_id();
      }
    //  get "hazards_with_associated_risks_unsafe_list"  and insert wiht school_id
    $hazards_with_associated_risks_unsafe_list = $this->school_m->hazards_with_associated_risks_unsafe_list_by_school_id($school_id);
    $hazards_with_associated_risks_unsafe_list_array = array();
    foreach ($hazards_with_associated_risks_unsafe_list as $hwaru) {
      array_push($hazards_with_associated_risks_unsafe_list_array, array(
                                        'school_id' => $school_inserted_id,
                                        'unsafe_list_id' => $hwaru->unsafe_list_id
                                      )
      );
    }
    if(!empty($hazards_with_associated_risks_unsafe_list_array)){
      $this->db->insert_batch('hazards_with_associated_risks_unsafe_list', $hazards_with_associated_risks_unsafe_list_array);
    }
    // $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_g_status' => 1));
    
    //  get "school_fee_concession"  and insert wiht school_id
    $school_fee_concession = $this->school_m->fee_concession_by_school_id($school_id);
    $school_fee_concession_array = array();
    foreach ($school_fee_concession as $sfc) {
      array_push($school_fee_concession_array, array(
                                        'school_id' => $school_inserted_id,
                                        'concession_id' => $sfc->concession_id,
                                        'percentage' => $sfc->percentage,
                                        'numberOfStudent' => $sfc->numberOfStudent
                                      )
      );
    }
    if(!empty($school_fee_concession_array)){
      $this->db->insert_batch('fee_concession', $school_fee_concession_array);
    }
           $this->db->trans_complete();
         if ($this->db->trans_status() === FALSE)
        {
              $this->db->trans_rollback();
              $this->session->set_flashdata('msg_error', 
                  "Sorry Something went wrong!.");
                  //echo $school_id;exit;
                  redirect("school/create_form");
        }
        else
        {
           $this->db->trans_commit();
       $school_data_to_update = array(
      'reg_type_id' => $post['reg_type_id'],
      'updatedDate' => date('Y-m-d H:i:s',time()),
      'updatedBy' => $this->session->userdata('userId'),
      'status'=>2
      );
       // echo "<pre>"; print_r($school_data_to_update);exit();
        $this->db->where('schoolId', $school_inserted_id);
        $this->db->update('school', $school_data_to_update);
        $affected_rows = $this->db->affected_rows();
        if($affected_rows > 0){
            $this->session->set_flashdata('msg_success', 
                  "You have successfully applied for renewal, kindly update your current school data.");
                  //echo $school_id;exit;
                  redirect("school/explore_school_by_id/$school_inserted_id");
        }
        else
        {
          $this->session->set_flashdata('msg_error', 
                  "Sorry Something went wrong!.");
                  //echo $school_id;exit;
                  redirect("school/create_form");
        }
        }
  }
  else
  {
     redirect("school/explore_school_by_id/$school_inserted_id");
  }

  
  
}

public function renewal_of_registration()
{
   $schools_id = 16846;//$this->input->post('id');
   $query_for_schoolsdata = $this->db->select('*')->where('schoolId', $schools_id)->get('schools')->result();
   $this->data['owner_id'] = $userId = $query_for_schoolsdata[0]->owner_id;
   $this->data['schooldata'] = $query_for_schoolsdata[0];
   $this->load->model("general_modal");
   $this->data['school_types'] = $this->general_modal->school_types();
   $this->data['gender_of_school'] = $this->general_modal->gender_of_school();
   $this->data['level_of_institute'] = $this->general_modal->level_of_institute();
   $this->data['reg_type'] = $this->general_modal->registration_type();
   $this->data['session_years'] = $this->db->order_by("sessionYearId", "desc")->get('session_year')->result();
   $this->load->view('school/renewal_of_registration', $this->data);
}

public function renewal_of_registration_process($skip_post_data = false, $school_id=0, $school_inserted_id=0)
{

    if($skip_post_data == false){
    $this->db->trans_start();
    $post = $this->input->post();
    $schools_data_to_update = array(
        'level_of_school_id' => $post['level_of_school_id'],
        'gender_type_id' => $post['gender_type_id'],
        'school_type_id' => $post['type_of_institute_id'],
        'reg_type_id' => $post['reg_type_id'],
        'schoolName' => $post['name'],
        'ppcName'=> $post['ppcName'],
        'ppcCode'=> $post['ppcCode'],
        'schoolTypeOther'=> $post['schoolTypeOther']
    );

    $this->db->where('schoolId', $post['schools_id']);
    $this->db->update('schools', $schools_data_to_update);
    $affected_rows = $this->db->affected_rows();

    // getting school Id and then get all old data by this school id and updated with renewal school id 
    $school_id = $this->db->where('schools_id', $post['schools_id'])->order_by('schoolId', 'desc')->get('school')->result()[0]->schoolId;

    $school_data_to_insert = array(
                            'reg_type_id' => $post['reg_type_id'],
                            'schools_id' => $post['schools_id'],
                            'session_year_id' => $post['session_year_id'],
                            'level_of_school_id' => $post['level_of_school_id'],
                            'gender_type_id' => $post['gender_type_id'],
                            'school_type_id' => $post['type_of_institute_id'],
                            'updatedDate' => $post['createdDate'],
                            'school_will_be_update_by_school_user' => 1,
                            'updatedBy' => $this->session->userdata('userId')
                          );
    $this->db->insert('school', $school_data_to_insert);
    $school_inserted_id = $this->db->insert_id();

    $this->db->insert('forms_process', array('user_id' => $post['owner_id'],
                                            'reg_type_id' => $post['reg_type_id'],
                                            'form_a_status' => 1,
                                            'school_id' => $school_inserted_id                                       
                                      ));
  }

  // $physical_facilities = $this->school_m->physical_facilities_by_school_id($school_id);
  $physical_facilities =  $this->db->where('school_id', $school_id)->get('physical_facilities')->result();

  if(!empty($physical_facilities)){
        $physical_facilities = $physical_facilities[0];
        $physical_facilities_array = array(
        'building_id' => $physical_facilities->building_id ,
        'numberOfClassRoom' => $physical_facilities->numberOfClassRoom ,
        'numberOfOtherRoom' => $physical_facilities->numberOfOtherRoom ,
        'totalArea' => $physical_facilities->totalArea ,
        'coveredArea' => $physical_facilities->coveredArea ,
        'numberOfComputer' => $physical_facilities->numberOfComputer,
        'numberOfLatrines' => $physical_facilities->numberOfLatrines,
        'school_id' => $school_inserted_id
        );
        $this->db->insert('physical_facilities', $physical_facilities_array);
    }
    // get and insert as a batch insertion
    $school_physical_facilities_physical = $this->school_m->physical_facilities_physical_by_school_id($school_id);
    $school_physical_facilities_physical_array = array();
    foreach ($school_physical_facilities_physical as $spfp) {
      array_push($school_physical_facilities_physical_array, array(
        'school_id' => $school_inserted_id,
        'pf_physical_id' => $spfp->pf_physical_id
        )
      );
    }
    if(!empty($school_physical_facilities_physical_array)){
     $this->db->insert_batch('physical_facilities_physical', $school_physical_facilities_physical_array);
   }



    // get "physical_facilities_academic" table data and insert as batch
    $school_physical_facilities_academic = $this->school_m->physical_facilities_academic_by_school_id($school_id);
    $school_physical_facilities_academic_array = array();
    foreach ($school_physical_facilities_academic as $spfa) {
      array_push($school_physical_facilities_academic_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'academic_id' => $spfa->academic_id
                                                            )
      );
    }
    if(!empty($school_physical_facilities_academic_array)){
      $this->db->insert_batch('physical_facilities_academic', $school_physical_facilities_academic_array);
    }

    //  get "physical_facilities_co_curricular" and insert wiht school_id
    $physical_facilities_co_curricular = $this->school_m->physical_facilities_co_curricular_by_school_id($school_id);
    $physical_facilities_co_curricular_array = array();
    foreach ($physical_facilities_co_curricular as $pfcc) {
      array_push($physical_facilities_co_curricular_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'co_curricular_id' => $pfcc->co_curricular_id
                                                            )
      );
    }
    if(!empty($physical_facilities_co_curricular_array)){
      $this->db->insert_batch('physical_facilities_co_curricular', $physical_facilities_co_curricular_array);
    }

    //  get "school_physical_facilities_other" and insert wiht school_id
    $physical_facilities_others =  $this->school_m->physical_facilities_other_by_school_id($school_id);
    $physical_facilities_others_array = array();
    foreach ($physical_facilities_others as $pfo) {
      array_push($physical_facilities_others_array, array(
                                                                'school_id' => $school_inserted_id,
                                                                'other_id' => $pfo->other_id
                                                            )
      );
    }
    if(!empty($physical_facilities_others_array)){
      $this->db->insert_batch('physical_facilities_others', $physical_facilities_others_array);
    }

    //  get "school_physical_facilities_other"  and insert wiht school_id
    $school_library = $this->school_m->get_library_books_by_school_id($school_id);
    $school_library_array = array();
    foreach ($school_library as $sl) {
      array_push($school_library_array, array(
                                        'school_id' => $school_inserted_id,
                                        'book_type_id' => $sl->book_type_id,
                                        'numberOfBooks' => $sl->numberOfBooks
                                      )
      );
    }
    if(!empty($school_library_array)){
      $this->db->insert_batch('school_library', $school_library_array);
    }
    $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_b_status' => 1));

    //  get "age_and_class"  and insert wiht school_id
    // $age_and_class = $this->db->where('school_id', $school_id)->get('age_and_class')->result();
    // $age_and_class_array = array();
    // foreach ($age_and_class as $ac) {
    //   array_push($age_and_class_array, array(
    //                                     'school_id' => $school_inserted_id,
    //                                     'age_id' => $ac->age_id,
    //                                     'class_id' => $ac->class_id,
    //                                     'enrolled' => $ac->enrolled,
    //                                     'gender_id' => $ac->gender_id,
    //                                     'total' => $ac->total
    //                                   )
    //   );
    // }
    // if(!empty($age_and_class_array)){
    //   $this->db->insert_batch('age_and_class', $age_and_class_array);
    // }
    $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_c_status' => 1));

    //  get "age_and_class"  and insert wiht school_id
    $school_staff = $this->school_m->staff_by_school_id($school_id);
    $school_staff_array = array();
    foreach ($school_staff as $ss) {
      array_push($school_staff_array, array(
                                        'school_id' => $school_inserted_id,
                                        'schoolStaffName' => $ss->schoolStaffName,
                                        'schoolStaffFatherOrHusband' => $ss->schoolStaffFatherOrHusband,
                                        'schoolStaffCnic' => $ss->schoolStaffCnic,
                                        'schoolStaffQaulificationProfessional' => $ss->schoolStaffQaulificationProfessional,
                                        'schoolStaffQaulificationAcademic' => $ss->schoolStaffQaulificationAcademic,
                                        'schoolStaffAppointmentDate' => $ss->schoolStaffAppointmentDate,
                                        'schoolStaffDesignition' => $ss->schoolStaffDesignition,
                                        'schoolStaffNetPay' => $ss->schoolStaffNetPay,
                                        'schoolStaffAnnualIncreament' => $ss->schoolStaffAnnualIncreament,
                                        'schoolStaffType' => $ss->schoolStaffType,
                                        'schoolStaffGender' => $ss->schoolStaffGender,
                                        'TeacherTraining' => $ss->TeacherTraining,
                                        'TeacherExperience' => $ss->TeacherExperience
                                      )

      );
    }

    if(!empty($school_staff_array)){
      $this->db->insert_batch('school_staff', $school_staff_array);
    }

    

    //  get "fee"  and insert wiht school_id
    // $school_fee = $this->school_m->fee_by_school_id($school_id);
    // $school_fee_array = array();
    // foreach ($school_fee as $sf) {
    //   array_push($school_fee_array, array(
    //                                     'school_id' => $school_inserted_id,
    //                                     'class_id' => $sf->class_id,
    //                                     'addmissionFee' => $sf->addmissionFee,
    //                                     'tuitionFee' => $sf->tuitionFee,
    //                                     'otherFund' => $sf->otherFund,
    //                                     'securityFund' => $sf->securityFund
    //                                   )
    //   );
    // }
    // if(!empty($school_fee_array)){
    //   $this->db->insert_batch('fee', $school_fee_array);
    // }
    $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_d_status' => 1));

    //  get "fee_mentioned_in_form_or_prospectus"  and insert wiht school_id
    $school_fee_mentioned_in_form = $this->school_m->fee_mentioned_in_form_by_school_id($school_id);
    if(!empty($school_fee_mentioned_in_form)){
      $this->db->insert('fee_mentioned_in_form_or_prospectus', array(
                                        'school_id' => $school_inserted_id,
                                        'feeMentionedInForm'=> $school_fee_mentioned_in_form->feeMentionedInForm
                                      )
                                    );
    }  
    $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_e_status' => 1));
    


    //  get "security_measures"  and insert wiht school_id
    $school_security_measures = $this->school_m->security_measures_by_school_id($school_id);
    if(!empty($school_security_measures)){
      $school_security_measures_array = array(
                                'school_id' => $school_inserted_id,
                                'securityStatus' => $school_security_measures->securityStatus,
                                'securityProvided' => $school_security_measures->securityProvided,
                                'securityPersonnel' => $school_security_measures->securityPersonnel,
                                'security_personnel_status_id' => $school_security_measures->security_personnel_status_id,
                                'security_according_to_police_dept' => $school_security_measures->security_according_to_police_dept,
                                'cameraInstallation' => $school_security_measures->cameraInstallation,
                                'camraNumber' => $school_security_measures->camraNumber,
                                'dvrMaintained' => $school_security_measures->dvrMaintained,
                                'cameraOnline' => $school_security_measures->cameraOnline,
                                'exitDoorsNumber' => $school_security_measures->exitDoorsNumber,
                                'emergencyDoorsNumber' => $school_security_measures->emergencyDoorsNumber,
                                'boundryWallHeight' => $school_security_measures->boundryWallHeight,
                                'wiresProvided' => $school_security_measures->wiresProvided,
                                'watchTower' => $school_security_measures->watchTower,
                                'licensedWeapon' => $school_security_measures->licensedWeapon,
                                'licenseNumber' => $school_security_measures->licenseNumber,
                                'ammunitionStatus' => $school_security_measures->ammunitionStatus,
                                'metalDetector' => $school_security_measures->metalDetector,
                                'walkThroughGate' => $school_security_measures->walkThroughGate,
                                'gateBarrier' => $school_security_measures->gateBarrier,
                                'license_issued_by_id' => $school_security_measures->license_issued_by_id
                              );
        $this->db->insert('security_measures', $school_security_measures_array);
        $this->db->insert_id();
      } 
      $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_f_status' => 1));
      

    //  get "security_measures"  and insert wiht school_id
    $school_hazards_with_associated_risks = $this->school_m->hazards_with_associated_risks_by_school_id($school_id);
    if(!empty($school_hazards_with_associated_risks)){
      $school_hazards_with_associated_risks_array = array(
                                'school_id' => $school_inserted_id,
                                'exposedToFlood' => $school_hazards_with_associated_risks->exposedToFlood,
                                'drowning' => $school_hazards_with_associated_risks->drowning,
                                'buildingCondition' => $school_hazards_with_associated_risks->buildingCondition,
                                'accessRoute' => $school_hazards_with_associated_risks->accessRoute,
                                'adjacentBuilding' => $school_hazards_with_associated_risks->adjacentBuilding,
                                'safeAssemblyPointsAvailable' => $school_hazards_with_associated_risks->safeAssemblyPointsAvailable,
                                'disasterTraining' => $school_hazards_with_associated_risks->disasterTraining,
                                'schoolImprovementPlan' => $school_hazards_with_associated_risks->schoolImprovementPlan,
                                'schoolDisasterManagementPlan' => $school_hazards_with_associated_risks->schoolDisasterManagementPlan,
                                'electrification_condition_id' => $school_hazards_with_associated_risks->electrification_condition_id,
                                'ventilationSystemAvailable' => $school_hazards_with_associated_risks->ventilationSystemAvailable,
                                'chemicalsSchoolLaboratory' => $school_hazards_with_associated_risks->chemicalsSchoolLaboratory,
                                'chemicalsSchoolSurrounding' => $school_hazards_with_associated_risks->chemicalsSchoolSurrounding,
                                'roadAccident' => $school_hazards_with_associated_risks->roadAccident,
                                'safeDrinkingWaterAvailable' => $school_hazards_with_associated_risks->safeDrinkingWaterAvailable,
                                'sanitationFacilities' => $school_hazards_with_associated_risks->sanitationFacilities,
                                'building_structure_id' => $school_hazards_with_associated_risks->building_structure_id,
                                'school_surrounded_by_id' => $school_hazards_with_associated_risks->school_surrounded_by_id
                              );
        $this->db->insert('hazards_with_associated_risks', $school_hazards_with_associated_risks_array);
        $this->db->insert_id();
      }
    //  get "hazards_with_associated_risks_unsafe_list"  and insert wiht school_id
    $hazards_with_associated_risks_unsafe_list = $this->school_m->hazards_with_associated_risks_unsafe_list_by_school_id($school_id);
    $hazards_with_associated_risks_unsafe_list_array = array();
    foreach ($hazards_with_associated_risks_unsafe_list as $hwaru) {
      array_push($hazards_with_associated_risks_unsafe_list_array, array(
                                        'school_id' => $school_inserted_id,
                                        'unsafe_list_id' => $hwaru->unsafe_list_id
                                      )
      );
    }
    if(!empty($hazards_with_associated_risks_unsafe_list_array)){
      $this->db->insert_batch('hazards_with_associated_risks_unsafe_list', $hazards_with_associated_risks_unsafe_list_array);
    }
    $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_g_status' => 1));
    
    //  get "school_fee_concession"  and insert wiht school_id
    $school_fee_concession = $this->school_m->fee_concession_by_school_id($school_id);
    $school_fee_concession_array = array();
    foreach ($school_fee_concession as $sfc) {
      array_push($school_fee_concession_array, array(
                                        'school_id' => $school_inserted_id,
                                        'concession_id' => $sfc->concession_id,
                                        'percentage' => $sfc->percentage,
                                        'numberOfStudent' => $sfc->numberOfStudent
                                      )
      );
    }
    if(!empty($school_fee_concession_array)){
      $this->db->insert_batch('fee_concession', $school_fee_concession_array);
    }

          $this->db->where('school_id', $school_inserted_id)->update('forms_process', array('form_h_status' => 1));
    if($skip_post_data == false){
          $this->db->trans_complete();

          $this->session->set_flashdata('msg_success', 
            "School renewal successfully done, now school's user can update the data inserted in renewal process.");
            redirect('school');
    }

  }

  public function delete_school_by_id_with_all_related_data($school_id, $rediret_with_id = 0){

    // $this->school_m->delete_record_by_id_m($id, $col, $table);

    $school_affected_rows = $this->school_m->delete_record_by_id_m($school_id, "schoolId", "school");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "security_measures");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "school_staff");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "school_library");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "physical_facilities_others");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "physical_facilities_physical");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "physical_facilities_co_curricular");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "physical_facilities_academic");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "physical_facilities");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "hazards_with_associated_risks_unsafe_list");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "hazards_with_associated_risks");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "forms_process");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "fee_mentioned_in_form_or_prospectus");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "fee_concession");
    $this->school_m->delete_record_by_id_m($school_id, "school_id", "fee");
    if($rediret_with_id != 0 && $school_affected_rows > 0){
      $this->session->set_flashdata('msg_success', 
        "School has been deleted successfully with all its related data.");
        redirect("school/explore_schools_by_school_id/$rediret_with_id");
    }
}



  public function delet_school_by_id_from_master_table($schools_id)
  {
     $school_list = $this->db->select('schoolId')->where('schools_id', $schools_id)->get('school')->result();
     $owner = $this->db->select('owner_id')->where('schoolId', $schools_id)->get('schools')->result();
     if( !empty($owner) ){
        $owner_id = $owner[0]->owner_id;
        $this->school_m->delete_record_by_id_m($owner_id, "userId", "users");   
     }
     
     foreach ($school_list as $sl) {
        $this->delete_school_by_id_with_all_related_data($sl->schoolId);
     }
     $school_affected_rows = $this->school_m->delete_record_by_id_m($schools_id, "schoolId", "schools");
     if($school_affected_rows > 0){
       $this->session->set_flashdata('msg_success', 
         "School has been deleted successfully with all its related data.");
         redirect("school");
     }
  }
  public function edit_edit_school_details_by_id_submit()
 {
      $schools_id=$this->input->post('schools_id');
      $school_id=$this->input->post('school_id');
     // 
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'schoolName',
                'label' =>  'school Name',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'yearOfEstiblishment',
                'label' =>  '  year Of Estiblishment',
                'rules' =>  'trim|required'
            )
            
           
        );

        
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
        $arr = array();
        $update_schools_data=array(
          'schoolName' =>$this->input->post('schoolName'),
          'yearOfEstiblishment' =>$this->input->post('yearOfEstiblishment'),
          'biseregistrationNumber' =>$this->input->post('biseregistrationNumber'),
          'telePhoneNumber' =>$this->input->post('telePhoneNumber'),
          'district_id' =>$this->input->post('district_id'),
          'tehsil_id' =>$this->input->post('tehsil_id'),
          'location' =>$this->input->post('location'),
          'uc_id' =>$this->input->post('uc_id')

          );
        $update_school_data=array(
           
          'session_year_id' =>$this->input->post('session_year_id'),
          'reg_type_id' =>$this->input->post('reg_type_id'),
          'gender_type_id' =>$this->input->post('gender_type_id'),
          'level_of_school_id' =>$this->input->post('level_of_school_id'),
          'school_type_id' =>$this->input->post('school_type_id')
          );
         $this->db->where('schoolId', $school_id)->update('school', $update_school_data);
          $affected_row = $this->db->where('schoolId', $schools_id)->update('schools', $update_schools_data);
        
        if ($affected_row >0) {
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>School data is successfully saved.</strong>";
         
        }else{
          $arr["status"] = FALSE;
          $arr["msg"] = "<strong class='text-center'>Internal Server Error, Try again.</strong>";  
        }
        }else{
           $arr["status"] = FALSE;
           $arr["msg"] = validation_errors();            
        }
        echo json_encode($arr);
        exit();
  }
  public function edit_school_details_by_id()
  {
    $arr=array();
    $html="";
     $this->load->model("user_m");
    $school_id=$this->input->post('id');
    if($school_id)
    {
      $school_query=" SELECT 
                  
                     `schools`.`reg_type_id`
                     ,`schools`.`location`
                    ,`schools`.`isfined`
                    , `schools`.`schoolName`
                    , `schools`.`registrationNumber`
                    , `schools`.`yearOfEstiblishment`
                    ,`schools`.`telePhoneNumber`
                    ,`schools`.`schoolMobileNumber`
                    ,`schools`.`address`
                    ,`school`.`schoolId` as id
                    ,`schools`.`schoolId`
                    ,`school`.`reg_type_id`  
                    ,`schools`.`district_id`
                    ,`schools`.`tehsil_id`
                    ,`schools`.`uc_id`
                    ,`school`.`gender_type_id`
                    ,`school`.`school_type_id`
                    ,`school`.`level_of_school_id`
                    ,`schools`.`biseregistrationNumber`
                    ,`school`.`session_year_id`
                    FROM `schools` 
                    inner join school 
                    on `schools`.`schoolId`=`school`.`schools_id`


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
                        where `school`.`schoolId`=$school_id;

      ";
      
        $school_info=$this->db->query($school_query)->row();
        $this->data['schooldata']=$school_info;
       

        //var_dump($this->data['school_info']);exit;
        $this->load->model("general_modal");
        $this->data['school_types'] = $this->general_modal->school_types();
    $this->data['districts'] = $this->general_modal->districts();
    $this->data['gender_of_school'] = $this->general_modal->gender_of_school();
    $this->data['level_of_institute'] = $this->general_modal->level_of_institute();
    $this->data['reg_type'] = $this->general_modal->registration_type();
    $this->data['tehsils'] = $this->general_modal->tehsils($school_info->district_id);
    $this->data['ucs'] = $this->general_modal->ucs($school_info->tehsil_id);
    $this->data['locations'] = $this->general_modal->location();
    $this->data['bise_list'] = $this->general_modal->bise_list();
        
        $this->data['session_years'] = $this->db->where('status','1')->order_by("sessionYearId", "asc")->get('session_year')->result();
          
        $this->data['title'] = 'school user';
        $this->data['description'] = 'info about user';
        //$this->data['view'] = 'user/user_registration';
        $html=$this->load->view('school/edit_school_details_in_modal', $this->data,true);
        
        $arr['view']=$html;
        $arr['status']=true;
    }
    else
    {

        $arr['status']=false;
    }
     echo json_encode($arr);exit;
       
  }




  public function renewal_as_a_whole_school()
  {
    
    
    $this->load->model("session_m");
     $next=$this->session_m->get_next_session();
   $session_year_id  = $next->session_id;
    
    
    $date = 3434;
      $get_schools = "SELECT
                    schoolId,owner_id
                    
                    
                FROM
                    schools
                   
                WHERE  yearOfEstiblishment !=". date('Y')."  AND registrationNumber  not IN('',0);";

      //           $get_schools = "SELECT
      //               schoolId,owner_id
                    
                    
      //           FROM
      //               schools
                   
      //           WHERE  registrationNumber  not IN('',0);";
       $schools_list = $this->db->query($get_schools)->result();

      // echo "<pre>";
       //var_dump($schools_list);
       //exit();

      $counter=0;
      foreach ($schools_list as $schools) {
         $schools_id = $schools->schoolId;

         
         $get_school_for_renewal = "SELECT 
                                  *
                                  
                              FROM
                                  school
                                 
                                      WHERE schools_id = $schools_id and status=1 order by schoolId  DESC";
        $school = $this->db->query($get_school_for_renewal)->row();
        
        if(count($school) >0)
        {
          $this->db->trans_start();
            $school_data_to_insert = array(
                                    'reg_type_id' => 2,
                                    'schools_id' => $school->schools_id,
                                    'session_year_id' => $session_year_id,
                                    'level_of_school_id' => $school->level_of_school_id,
                                    'gender_type_id' => $school->gender_type_id,
                                    'school_type_id' => $school->school_type_id,
                                    'updatedDate' =>123456,
                                    'school_will_be_update_by_school_user' => 1,
                                    'updatedBy' => $this->session->userdata('userId')
                                  );
            $check_school_session = "SELECT 
                                  schoolId,schools_id,reg_type_id,session_year_id
                                  
                              FROM
                                  school
                                 
                                      WHERE schools_id = $schools_id AND session_year_id= 
                                      $session_year_id order by schoolId  DESC";
            $check_school = $this->db->query($check_school_session)->result();
            if(count($check_school) < 1 || empty($check_school) )
            {
               $this->db->insert('school', $school_data_to_insert);
               $school_inserted_id = $this->db->insert_id();

               $this->db->insert('forms_process', array('user_id' => $schools->owner_id,
                                                    'reg_type_id' => $school->reg_type_id,
                                                    'form_a_status' => 1,
                                                    'school_id' => $school_inserted_id                                       
                                                ));

               $this->db->where('userId', $schools->owner_id)->update('users', array('school_renewed' => 1));
               $counter++;
            }
            
            //$this->renewal_of_registration_process(true, $school->schoolId, $school_inserted_id);
            
            $this->db->trans_complete();

            #insert school and form process here

            #batch insertion or process
            #copy all data
            #update user renewal status
        }
        //var_dump($school);
        //echo "<br>";
       
          // var($get_school_for_renewal_list);
          // exit();
            
        
      }
      echo $counter;exit;
  }

}

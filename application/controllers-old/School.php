<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("school_m");
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
    $query = "SELECT
                  `schools`.`schoolId`
                  , `schools`.`registrationNumber`
                  , `schools`.`schoolName`
                  , `schools`.`district_id`
                  , `district`.`districtTitle`
                  , `schools`.`gender_type_id`
                  , `genderofschool`.`genderOfSchoolTitle`
                  , `levelofinstitute`.`levelofInstituteTitle`
                  , `school`.`registrationNumber` AS biseRegistrationNumber
              FROM
                  `schools`
                  INNER JOIN `district` 
                      ON (`schools`.`district_id` = `district`.`districtId`)
                  INNER JOIN `genderofschool` 
                      ON (`schools`.`gender_type_id` = `genderofschool`.`genderOfSchoolId`)
                  INNER JOIN `levelofinstitute` 
                      ON (`schools`.`level_of_school_id` = `levelofinstitute`.`levelofInstituteId`)
                  INNER JOIN `school` 
                      ON (`schools`.`schoolId` = `school`.`schools_id`)
                    WHERE `schools`.`schoolId` = ".$schools_id.";";
    $schools_info = $this->db->query($query)->result()[0];
    $this->load->view('school/certificate_of_schools', array('schools_info' => $schools_info));
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


    public function registration_code_allotment($id = 0){
      $this->load->model('general_modal');
      $this->data['districts'] = $this->general_modal->districts(0, FALSE);
        $this->db->where('registrationNumber', 0);
        $query = $this->db->get('schools');
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
      $this->data['title'] = 'school';
      $this->data['description'] = 'info about school';
      $this->data['view'] = 'school/schools_has_no_registration_number';
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

  public function generate_reg_number(){
     $school_id = $this->input->post('id');

     $row = $this->db->where('schoolId', $school_id)->get('schools')->result()[0];

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
              'registrationNumber' => $codeCombined
      );

      $this->db->where('schoolId', $school_id);
      $this->db->update('schools', $update_data);
      $affected_rows = $this->db->affected_rows();
      if($affected_rows){
          $update_increament = array(
                  'registrationNumberIncreament' => $registrationNumberIncreament+1
          );
          $where1 = array('tehsilId' => $tehsil_id, 'district_id' => $district_id);
          $this->db->where($where1);
          $this->db->update('registration_code', $update_increament);
          $affected_rows = $this->db->affected_rows();

                echo "<h2 style='margin-top:150px; margin-bottom:70px;' class='text-center'><strong class='text text-success'>Successfully Alloted Registration Number \" $codeCombined \" .</strong></h2>";
                echo "<div class='row'><div class='col-md-offset-2 col-md-8' style='margin-bottom:35px;'>";
                echo "<button class='btn btn-success btn-flat pull-right' onclick='(function(){ location.reload(); })
          ();'>Close</button>";
                echo "</div></div>";
      }

      // echo json_encode($arr);
      // exit();
  }


	public function create_form(){
    $userId = $this->session->userdata('userId');
    // echo "<pre />";
    $this->data['schooldata'] = $this->school_m->get_school_data_for_school_insertion($userId);
    $tehsil_id = $this->data['schooldata']->tehsil_id;
    $this->data['ucs_list'] = $this->db->where('tehsil_id', $tehsil_id)->get('uc')->result();
    // var_dump($ucs_list);
    // exit();
    $this->load->model("general_modal");
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

    public function form_c($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['age_list'] = $this->db->get('age')->result();
    $this->data['class_list'] = $this->db->get('class')->result();
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_c';
    $this->load->view('layout', $this->data);
  }

    public function form_d($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
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

    public function form_g($school_id =1){
    $user_id = $this->session->userdata('userId');
    $school_id = $this->db->where('user_id', $user_id)->order_by("formProcessId desc")->get('forms_process')->result()[0]->school_id;

    $this->data['school_id'] = (int) $school_id;
    $this->data['title'] = 'school';
    $this->data['description'] = 'info about school';
    $this->data['view'] = 'school/form_g';
    $this->load->view('layout', $this->data);
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

	public function create_process($id = null){
    
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
        $school_id = $posts['school_id'];
        unset($posts['school_id']);
        // echo "<pre >";
        // var_dump($posts);
        // exit();
        $school = array(
              // 'reg_type_id' => $posts['reg_type_id'],
              // 'name' => $posts['name'],
              // 'yearOfEstiblishment' => $posts['yearOfEstiblishment'],
              // 'telePhoneNumber' => $posts['telePhoneNumber'],
              // 'district_id' => $posts['district_id'],
              // 'tehsil_id' => $posts['tehsil_id'],
              // 'uc_id' => $posts['uc_id'],
              'address' => $posts['address'],
              'pkNo' => $posts['pkNo'],
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
              'registrationNumber' => $posts['registrationNumber'],
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
            $insert_id = $this->school_m->save($school, $school_id);
            if($insert_id){
                $update_in_form_process = array(
                        'school_id' => $insert_id,
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
                    'school_id' => $insert_id
                );
                if($posts['bankAccountNumber']){
                $this->db->insert('bank_account', $school_bank);
                }
                $this->session->set_flashdata($type, $msg);
                redirect('school/form_b/'.$insert_id);
            }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/create_form');
            }
          

      }else{

          $this->create_form();
      
      }

	}

    public function form_b_process($id = null){
      // var_dump($this->input->post());
      // exit;
      
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
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'age[]',
                'label' =>  'Age',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'class[]',
                'label' =>  'Class',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'gender[]',
                'label' =>  'gender',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'enrolled[]',
                'label' =>  'enrolled',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          $class_array = $posts['class'];
          $age_array = $posts['age'];
          $enrolled_array = $posts['enrolled'];
          $gender_array = $posts['gender'];
          $count = count($class_array);

              $msg = "New School has been created successfully";
              $type = "msg_success";
              $batch_data = [];
              for ($i=0; $i < $count; $i++) {
                array_push($batch_data,  array(
                                          '`age_id`' => $age_array[$i],
                                          '`class_id`' => $class_array[$i],
                                          '`enrolled`' => $enrolled_array[$i],
                                          '`gender_id`' => $gender_array[$i],
                                          '`school_id`' => $posts['school_id']
                                        ));
                
              }
              $this->db->insert_batch('age_and_class', $batch_data);
              $insert_id = $this->db->insert_id();
              if($insert_id){
                  $update_in_form_process = array(
                          'form_c_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/form_d/'.$posts['school_id']);
              }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('school/create_form');
              }

            }
        else{

            $this->form_c();
        }

    }


    public function form_d_process($id = 1){
    // echo "<pre >";
    // var_dump($this->input->post());   
    // exit;

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'name[]',
                'label' =>  'Name',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'fatherName[]',
                'label' =>  'Father / Husband Name',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'cnic[]',
                'label' =>  'CNIC',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'designation[]',
                'label' =>  'Designation',
                'rules' =>  'trim|required'
            )
        );

        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
          $posts = $this->input->post();
          $name_array = $posts['name'];
          $fatherName_array = $posts['fatherName'];
          $cnic_array = $posts['cnic'];
          $qualificationProfessional_array = $posts['qualificationProfessional'];
          $qualificationAcademic_array = $posts['qualificationAcademic'];
          $appointmentDate_array = $posts['appointmentDate'];
          $designation_array = $posts['designation'];
          $netPay_array = $posts['netPay'];
          $annualIncrement_array = $posts['annualIncrement'];
          $staff_array = $posts['staff'];
          $gender_array = $posts['gender'];
          $TeacherTraining_array = $posts['TeacherTraining'];
          $TeacherExperience_array = $posts['TeacherExperience'];
                    
          $count = count($name_array);
              $msg = "New School has been created successfully";
              $type = "msg_success";
              $batch_data = [];
              for ($i=0; $i < $count; $i++) {
                array_push($batch_data,  array(
                            '`schoolStaffName`' => $name_array[$i],
                            '`schoolStaffFatherOrHusband`' => $fatherName_array[$i],
                            '`schoolStaffCnic`' => $cnic_array[$i],
                            '`schoolStaffQaulificationProfessional`' => $qualificationProfessional_array[$i],
                            '`schoolStaffQaulificationAcademic`' => $qualificationAcademic_array[$i],
                            '`schoolStaffAppointmentDate`' => $appointmentDate_array[$i],
                            '`schoolStaffDesignition`' => $designation_array[$i],
                            '`schoolStaffNetPay`' => $netPay_array[$i],
                            '`schoolStaffAnnualIncreament`' => $annualIncrement_array[$i],
                            '`schoolStaffType`' => $staff_array[$i],
                            '`schoolStaffGender`' => $gender_array[$i],
                            '`TeacherTraining`' => $TeacherTraining_array[$i],
                            '`TeacherExperience`' => $TeacherExperience_array[$i],
                            '`school_id`' => $posts['school_id']
                                          ));
                
              }
              $this->db->insert_batch('school_staff', $batch_data);
              $insert_id = $this->db->insert_id();
              if($insert_id){

                  $type = "msg_success";
                  $msg =  "School has been updated successfully";
                  $update_in_form_process = array(
                          'form_d_status' => 1
                  );
                  $this->db->where('user_id', $this->session->userdata('userId'));
                  $this->db->where('school_id', $posts['school_id']);
                  $this->db->update('forms_process', $update_in_form_process);

                  $this->session->set_flashdata($type, $msg);
                  redirect('school/form_e/'.$posts['school_id']);
              }else{
                  $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                  redirect('school/create_form');
              }
  
        }else{

            $this->form_d();
        
        }

    }


    public function form_e_process($id = 1){
    // echo "<pre >";
    // var_dump($this->input->post());   
    // exit;

        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'addmissionFee[]',
                'label' =>  'Addmission Fee',
                'rules' =>  'trim|required'
            ),
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
          $addmissionFee_array = $posts['addmissionFee'];
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
                            '`addmissionFee`' => $addmissionFee_array[$i],
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
        $this->data['type_of_institute'] = $this->type_of_institute(false);
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

  public function explore_schools_by_school_id($school_id)
  {
	  $school_id = $this->db->where('schools_id', $school_id)->get('school')->result()[0]->schoolId;
      redirect('school/explore_school_by_id/'.$school_id);
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

      $this->data['school_security_measures'] = $this->school_m->security_measures_by_school_id($school_id);

      $this->data['school_hazards_with_associated_risks'] = $this->school_m->hazards_with_associated_risks_by_school_id($school_id);
      $this->data['hazards_with_associated_risks_unsafe_list'] = $this->school_m->hazards_with_associated_risks_unsafe_list_by_school_id($school_id);
      
      $this->data['school_fee_concession'] = $this->school_m->fee_concession_by_school_id($school_id);
      // echo "<pre />";
      // var_dump($this->data['school_fee_concession']);
      // exit;
      $this->data['title'] = 'school details';
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
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Enrollement data is successfully save.</strong>";
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
        if($this->form_validation->run() === TRUE){
        $arr = array();
        $posts = $this->input->post();
        $this->db->insert('school_staff', $posts);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
          $arr["status"] = TRUE;
          $arr["msg"] = "<strong class='text-center'>Staff data is successfully save.</strong>";
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


            if($query_result > 0 || $insert_id > 0 ){
                  $arr["status"] = TRUE;
                  $arr["msg"] = "<strong class='text-center'>Hazards With Assiociated Risks Successfully Changed.</strong>";
                }

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
	    
}

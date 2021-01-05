<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Admin_Controller
// MY_Controller
class User extends Admin_Controller {
	
	public function __construct(){
        echo "<h3>We are sorry for inconvenience, we are updating our system right know.<h3>";exit;
        parent::__construct();
		    $this->load->model('user_m');  
		    // $this->output->enable_profiler(TRUE);

    	}

	public function index($id = 0){
		$user_id = $this->session->userdata('userId');
		  $result = $this->db->where('userId', $user_id)->get('users')->result()[0];
		  $district_id = $result->district_id;
		  $role_id = $result->role_id;
		  if($role_id == 16){
		  	$this->db->where('district_id', $district_id);
		  	$this->db->where('userId >=', '20');
		  }
    $query = $this->db->get('users');
    $number_of_rows = $query->num_rows();
    // pagination code is executed and dispaly pagination in view
    $this->load->library('pagination');
        $config = [
            'base_url'  =>  base_url('user/index'),
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
    // this if is used for after deletion redirect...
    if(empty($id)){
        $offset = $this->uri->segment(3,0);
    }else{
        $offset = $id;
    }

		$this->data['users'] = $this->user_m->get_user_list($config['per_page'], $offset);
		$this->data['title'] = 'user';
		$this->data['description'] = 'info about user';
		$this->data['view'] = 'user/user';
		$this->load->view('layout', $this->data);
	}
	public function create_form(){
		$roles_query = "SELECT
			    `role_id`
			    , `role_title`
			FROM
			    `roles`
			WHERE role_status = 1;";
		$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district`;";

		$this->data['roles'] = $this->user_m->runQuery($roles_query);
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		// var_dump($this->data['roles']);
		// exit;
		$this->data['title'] = 'user';
		$this->data['description'] = 'info about user';
		$this->data['view'] = 'user/create';
		$this->load->view('layout', $this->data);
	}
	public function create(){

		$validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules'	=> 'required|trim|min_length[3]'
			),
				array(
				'field' => 'role_id',
				'label' => 'Role',
				'rules' => 'required|trim'
				),
			array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required'
			),
			array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
							'required' => 'You must provide a %s.',
					),
			),
			array(
					'field' => 'passconf',
					'label' => 'Password Confirmation',
					'rules' => 'required|matches[password]'
			),
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|valid_email'
			),
		    array(
					'field' => 'cnic',
					'label' => 'CNIC',
					'rules' => 'trim|is_unique[users.cnic]'
		      	)
		);
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){

            date_default_timezone_set("Asia/Karachi");
			$dated = date("d-m-Y h:i:sa");
			 
			$insert = array(
				'role_id' => $this->input->post('role_id'),
				'userTitle' => $this->input->post('name'),
				'userName' => $this->input->post('username'),
				'userPassword' => $this->input->post('password'),
				'userEmail' => $this->input->post('email'),
				'cnic'		=>	$this->input->post("cnic"),
				'userStatus'=>$this->input->post('status'),
				'gender' =>$this->input->post('gender'),
				'address' => $this->input->post('address'),
				'contactNumber'=> $this->input->post('contactNumber'),
				'district_id' => $this->input->post('district'),
				'createdBy' => $this->session->userdata('userId'),
				'createdDate'=> $dated,
			);
			$result = $this->user_m->save($insert);
			if($result){
				$this->session->set_flashdata('msg_success', "<strong>".$this->input->post('name').'</strong><br/><i>successfully added to database.</i>');
				redirect("user/index");
			}else{
				$this->session->set_flashdata('msg_info', "<strong>".$this->input->post('name').'</strong><br/><i> registration failed, try again.</i>');
				redirect("user/create_form");
			}

		}else{
			$roles_query = "SELECT
				    `role_id`
				    , `role_title`
				FROM
				    `roles`
				WHERE role_status = 1;";
			$district_query = "SELECT
				    `districtId`
				    , `districtTitle`
				FROM
				    `district`;";

			$this->data['roles'] = $this->user_m->runQuery($roles_query);
			$this->data['districts'] = $this->user_m->runQuery($district_query);

			$this->data['title'] = 'user';
			$this->data['description'] = 'info about user';
			$this->data['view'] = 'user/create';
			$this->load->view('layout', $this->data);
			
		}
	}

	public function create_school_user_form(){
		// $roles_query = "SELECT
		// 	    `role_id`
		// 	    , `role_title`
		// 	FROM
		// 	    `roles`
		// 	WHERE `role_status` = 1 AND `role_id` = 15;";
		$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district`;";

		$this->data['roles'] = 15;//$this->user_m->runQuery($roles_query);

		$this->load->model("general_modal");
		$this->data['school_types'] = $this->general_modal->school_types();

		$this->data['gender_of_school'] = $this->general_modal->gender_of_school();
		$this->data['level_of_institute'] = $this->general_modal->level_of_institute();
		$this->data['reg_type'] = $this->general_modal->registration_type();
				// $this->data['districts'] = $this->general_modal->districts();
		$district_id = $this->session->userdata('district_id');
		$this->data['district_id'] = $district_id;
		$this->data['tehsils'] = $this->general_modal->tehsils($district_id);	
		$this->data['title'] = 'school user';
		$this->data['description'] = 'info about user';
		$this->data['view'] = 'user/create_school_user_form';
		$this->load->view('layout', $this->data);
	}

	public function get_ucs_by_tehsils_id(){
		$tehsil_id = $this->input->post('id');
		if(!empty($tehsil_id)){
		$this->load->model("general_modal");
		$response = $this->general_modal->ucs($tehsil_id, FALSE);
		echo $response;
		return;
		}else{
			return "<option></option>";
		}
	}


	public function create_school_user_process(){
		// var_dump($this->input->post());exit();
		$validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules'	=> 'trim'
			),
				array(
				'field' => 'role_id',
				'label' => 'Role',
				'rules' => 'required|trim'
				),
			array(
					'field' => 'username',
					'label' => 'User name',
					'rules' => 'required|trim|callback_check_userAndPass'
			),
			array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|trim',
					'errors' => array(
							'required' => 'You must provide a %s.',
					),
			),
			array(
					'field' => 'passconf',
					'label' => 'Password Confirmation',
					'rules' => 'required|matches[password]'
			),
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'valid_email'
			),
		    array(
					'field' => 'cnic',
					'label' => 'CNIC',
					'rules' => 'trim'
		      	)
		);
		$this->form_validation->set_message('matches', 'The %s is not matching with Password');
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){
			$insert = array(
				'role_id' => $this->input->post('role_id'),
				'userTitle' => $this->input->post('name'),
				'userName' => $this->input->post('username'),
				'userPassword' => $this->input->post('password'),
				'userEmail' => $this->input->post('email'),
				'cnic'		=>	$this->input->post("cnic"),
				'createdDate'=> $this->input->post("createdDate"),
				'createdBy'=>$this->session->userdata('userId'),
				'gender'=> $this->input->post("gender"),
				'address'=> $this->input->post("address"),
				'userStatus' =>1,
				'district_id'=> $this->input->post("district_id")
			);
			$result = $this->user_m->save($insert);
			$arr = array();
			if($result){
			$arr["status"] = TRUE;
			$arr["user_id"] = $result;
			$arr["msg"] = "<strong class='text-center'>New User For School is successfully added.</strong>";
			}

		}else{
			$arr["status"] = FALSE;
			$arr["msg"] = validation_errors();  
		}
		echo json_encode($arr);
		exit();
	}


	public function master_table_data_school_user_insert_process(){

		$validation_rules = array(
			array(
				'field' => 'schoolName',
				'label' => 'School Name',
				'rules'	=> 'required|trim'
			),
				array(
				'field' => 'yearOfEstiblishment',
				'label' => 'Year Of Estiblishment',
				'rules' => 'required|trim'
				),
			array(
					'field' => 'gender_type_id',
					'label' => 'School Gender',
					'rules' => 'required|trim'
			),
			array(
					'field' => 'school_type_id',
					'label' => 'School Level',
					'rules' => 'required|trim'
			),
			array(
					'field' => 'level_of_school_id',
					'label' => 'Level of school',
					'rules' => 'required|trim'
			)
		);
		$this->form_validation->set_rules($validation_rules);
		if( $this->form_validation->run() === TRUE ){
			$posts = $this->input->post();
			$this->db->insert('schools', $posts);
			$schools_id = $this->db->insert_id();

			
			// setting registration number ... adding in schools table
			// $district_id = $posts['district_id'];
			// $tehsil_id = $posts['tehsil_id'];
			// $yearOfEstiblishment = $posts['yearOfEstiblishment'];

			// $where = array('tehsilId' => $tehsil_id, 'district_id' => $district_id);


			// $this->db->where($where);
			// $autoIncreamentNumberRow = $this->db->get('registration_code')->result()[0];

			// $registrationNumberIncreamentId = $autoIncreamentNumberRow->registrationNumberIncreamentId;
			// $registrationNumberIncreament = $autoIncreamentNumberRow->registrationNumberIncreament;

			// $district_id_with_prefix_zero = sprintf("%02d", $district_id);
			// $tehsil_id_with_prefix_zero = sprintf("%03d", $tehsil_id);
			// $yearOfEstiblishment = substr($yearOfEstiblishment,2);
			// $codeCombined = $district_id_with_prefix_zero.$tehsil_id_with_prefix_zero.$registrationNumberIncreament.$yearOfEstiblishment;

			//  $data["district_id"] = $district_id;
			//  $data["tehsil_id"] = $tehsil_id;
			//  $data["school_id"] = $insert_id;
			//  $data["codeCombined"] = $codeCombined;

			//  $update_data = array(
			//          'registrationNumber' => $codeCombined
			//  );

			//  $this->db->where('schoolId', $insert_id);
			//  $this->db->update('schools', $update_data);
			//  $affected_rows = $this->db->affected_rows();
			//  if($affected_rows){
			//      $update_increament = array(
			//              'registrationNumberIncreament' => $registrationNumberIncreament+1
			//      );
			//      $where = array('tehsilId' => $tehsil_id, 'district_id' => $district_id);
			//      $this->db->where($where);
			//      $this->db->update('registration_code', $update_increament);
			//      $affected_rows = $this->db->affected_rows();
			//  }


			// ends here ...
			// below block of code will add school information in slave table if fails user and school will be deleted automatically. 
			$msg = "<a href='javascript:void(0)' class='btn-link' onclick='(function(){ location.reload(); })();'><strong class='text-center text-danger'>Click to add user information again, Our system deleted the information.</strong></a>";
			$arr = array();

			if(!empty($schools_id)){
			$school_info_slave_table_data = array(
				'name' => $posts['schoolName'], 
				'schools_id' => $schools_id,
				'reg_type_id'=> $posts['reg_type_id'],
				'district_id' => $posts['district_id'],
				'tehsil_id' => $posts['tehsil_id'],
				'uc_id' => $posts['uc_id'],
				'address' => $posts['address'],
				'yearOfEstiblishment'=> $posts['yearOfEstiblishment'],
				'telePhoneNumber' => $posts['telePhoneNumber'],
				'location' => $posts['location'],
				'gender_type_id' => $posts['gender_type_id'],
				'school_type_id' => $posts['school_type_id'] ,
				'level_of_school_id' => $posts['level_of_school_id'],
				'schoolTypeOther' => $posts['schoolTypeOther'],
				'ppcCode'=> $posts['ppcCode']

				);
				if(!empty($posts['ppcCode'])){
					$school_info_slave_table_data['ppcName'] = $posts['schoolName'];
				}
				$this->db->insert('school', $school_info_slave_table_data);
				$school_id = $this->db->insert_id();
				// checking if slave table data entered, successfully then enter more data else delete master table entry and user too.
				if(!empty($school_id)){
					
					$form_proccess_insert_data = array(
						'user_id'      => $posts['owner_id'],
						'school_id'   => $school_id,
						'reg_type_id'=> $posts['reg_type_id']
							);
						$this->db->insert('forms_process', $form_proccess_insert_data);
						$forms_process = $this->db->insert_id();
						
						if(!empty($forms_process)){
							$arr["status"] = TRUE;
							$arr["user_id"] = $schools_id;
							$arr["msg"] = "<strong class='text-center'>School is successfully added.</strong>";
						}else{
							$user_id = $posts['owner_id'];
							$this->db->delete('users', array('userId' => $user_id));
							$this->db->delete('schools', array('schoolId' => $schools_id));
							$this->db->delete('school', array('schoolId' => $school_id));
							$arr["status"] = FALSE;
							$arr["msg"] = $msg; 
						}
						

				}else{
					$user_id = $posts['owner_id'];
					$this->db->delete('users', array('userId' => $user_id));
					$this->db->delete('schools', array('schoolId' => $schools_id));
					$arr["status"] = FALSE;
					$arr["msg"] = $msg; 
				}
			
			}else{
				$user_id = $posts['owner_id'];
				$this->db->where('userId', $user_id )->delete('users');
				$arr["status"] = FALSE;
				$arr["msg"] = $msg;  

				
			}

		}else{
			$arr["status"] = FALSE;
			$arr["msg"] = validation_errors();  
		}
		echo json_encode($arr);
		exit();
	}

	public function login(){
	     //check if the user is already logedin
	   if($this->user_m->loggedIn() == TRUE){
	       redirect($this->session->userdata(''));
	   }

	   //load other models
	   $this->load->model("role_m");
	   $this->load->model("module_m");
	   // $this->load->model("department_m");
	   
	   $validations = array(
	       array(
	           'field' =>  'userName',
	           'label' =>  'User Name',
	           'rules' =>  'required'
	       ),
	       array(
	           'field' =>  'password',
	           'label' =>  'Password',
	           'rules' =>  'required'
	       )
	   );
	   $this->form_validation->set_rules($validations);
	   if($this->form_validation->run() === TRUE){
	       
	       $input_values = array(
	           'userName' => $this->input->post("userName"),
	           'userPassword' => $this->input->post("password"),
	           'userStatus' => 1
	       );
	       
	       //get the user
	       $user = $this->user_m->getBy($input_values, TRUE);
	       // var_dump($user->createdDate);exit;
	       if(count($user) > 0){  
	           //
	           $role_homepage_id = $this->role_m->getCol("role_homepage", $user->role_id);
	           $role_homepage_parent_id = $this->module_m->getCol("parent_id", $role_homepage_id);
	           
	           //now create homepage path
	           $homepage_path = "";
	           if($role_homepage_parent_id != 0){
	               $homepage_path .= $this->module_m->getCol("module_uri", $role_homepage_parent_id)."/";
	           }
	           $homepage_path .= $this->module_m->getCol("module_uri", $role_homepage_id);
	           
	           $user_data = array(
	               "userId" => $user->userId,
	               "userTitle" => $user->userTitle,
	               "userEmail" => $user->userEmail,
	               "gender" => $user->gender,
	               "role_homepage_id" => $role_homepage_id,
	               "role_homepage_uri" => $homepage_path,
	               "role_id" => $user->role_id,
	               "logged_in" => TRUE,
	               'district_id' => $user->district_id,
	               'cnic' => $user->cnic,
	               'createdDate' => $user->createdDate,
	               'contactNumber' => $user->contactNumber	              
	           );

	           //add to session
	           $this->session->set_userdata($user_data);
	           // var_dump($this->session->userdata('createdDate'));exit;
	           $this->session->set_flashdata('msg_success', "<strong>".$user->userTitle.'</strong><br/><i>welcome to admin panel</i>');
	           redirect($homepage_path);
	       }else{

	           $this->session->set_flashdata('msg', 'User-Name or password is incorrect, Please try again.');
	           redirect("user/login");
	       }
	   }else{
	       $this->data['title'] = "Login to dashboard";
	       $this->load->view("user/login", $this->data);
	   }
	}

	public function logout(){
	   $this->user_m->logout();
	   redirect("user/login");
	}

	public function edit($userId){
		$this->data['userInfo'] = $this->user_m->get($userId);
		// var_dump($this->data['userInfo']);
		// exit();

		$roles_query = "SELECT
			    `role_id`
			    , `role_title`
			FROM
			    `roles`
			WHERE role_status = 1;";
		$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district`;";
		$gender_query = "SELECT `genderId`, `genderTitle` FROM `gender`";

		$this->data['roles'] = $this->user_m->runQuery($roles_query);
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		$this->data['userId'] = $userId; 
		$this->data['gender'] = $this->user_m->runQuery($gender_query);
		// var_dump($this->data['roles']);
		// exit;
		$this->data['title'] = 'user edit';
		$this->data['description'] = 'info about user';
		$this->data['view'] = 'user/edit';
		$this->load->view('layout', $this->data);

	}

	public function update_user_record($userId='0'){
		
		$validation_rules = array(
			array(
				'field' => 'userTitle',
				'label' => 'Name',
				'rules'	=> 'required|trim|min_length[3]'
			),
			array(
					'field' => 'userName',
					'label' => 'User name',
					'rules' => 'required'
			),
			array(
					'field' => 'userPassword',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
							'required' => 'You must provide a %s.',
					),
			),
			array(
					'field' => 'userEmail',
					'label' => 'Email',
					'rules' => 'required|valid_email'
			),

		);

		if( $this->session->userdata('role_id') != 15){
			$arr = array(
					'field' => 'cnic',
					'label' => 'CNIC',
					'rules' => 'required|callback_check_cnic[' . $userId . ']|trim'
		      	);
			$validation_rules = array_merge($validation_rules, $arr);
		// array_push(	$arr , $validation_rules);

		}
				$this->form_validation->set_rules($validation_rules);
				if($this->form_validation->run()===TRUE){

					$result = $this->user_m->save($this->input->post(), $userId);
					if($result){
						$this->session->set_flashdata('msg_success', "<strong>".$this->input->post('userTitle').'</strong><br/><i>successfully updated.</i>');
						redirect("user/edit/".$userId);
					}else{
						$this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
						redirect("user/edit/".$userId);
					}

				}else{
					$this->edit($userId);
				}

	}
	public function check_cnic($cnic, $userId){

		$this->db->where(array('userId!='=>  $userId , 'cnic'=> $cnic));
		$num = $this->db->count_all_results('users');
		if ($num > 0){
		        $this->form_validation->set_message('check_cnic' , 'The {field} has already registered with another account');
		        return FALSE;
		}else{
		        return TRUE;
		}
	}
	public function check_userAndPass(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->where(array('userName='=>  $username , 'userPassword='=> $password));
		$num = $this->db->count_all_results('users');

		if ($num > 0){
		        $this->form_validation->set_message('check_userAndPass' , 'The {field} has already registered with another account');
		        return FALSE;
		}else{
		        return TRUE;
		}
	}

	public function delete($user_id){
	  $user_id = (int) $user_id;
	  $where = array('userId' => $user_id );
	  $result = $this->user_m->delete($where);

	  $schools = $this->db->where('owner_id', $user_id)->get('schools')->result();

	  if($schools){
	  		$schools_id = $schools[0]->schoolId;
	  		$this->db->where('schoolId', $schools_id);
	  		$this->db->delete('schools');

	  		$school_list = $this->db->where('schools_id', $schools_id)->get('school')->result();
	  		foreach ($school_list as $school) {
	  			$this->db->where('schoolId', $school->schoolId);
	  			$this->db->delete('school');

	  		}

	  		$this->db->where('user_id', $user_id);
	  		$this->db->delete('forms_process');

	  }
	   
	  if($result){
	      $this->session->set_flashdata('msg_success', "User successfully deleted.");
	        redirect('user');
	    }else{
	        $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
	        redirect('user');
	  }
	}
	

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Admin_Controller
// MY_Controller
class Registration extends MY_Controller {
	
	public function __construct(){
        
        parent::__construct();
		    $this->load->model('user_m');  
		    // $this->output->enable_profiler(TRUE);

    	}
    	public function change_message()
    	{  
    	   // $q=$this->db->query("SELECT message_for_all.message_id,message_school.school_id FROM `message_for_all` inner join message_school on message_for_all.message_id=message_school.message_id WHERE  message_for_all.message_id >3611 and message_for_all.subject='School Registration Certificate'");
    	   // $messages=$q->result();

    	   // $count=0;
    	   // foreach ($messages as $message) {
    	   // 	 $schools_id=$this->db->query("SELECT schools_id FROM school where schoolId=$message->school_id")->row()->schools_id;
              
    	   // 	$update_message=array(
        //         'school_id' =>$schools_id

    	   // 		);
    	   // 	$this->db->where('message_id',$message->message_id);
        //         $this->db->update('message_school', $update_message);
        //         $count++;
    	    	
    	   // }
    	   // echo $count;exit;

    		
             
    	}
    	
    	public function send_email(){
    	   //Load email library
$this->load->library('email');

//SMTP & mail configuration
$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'ssl://mail.fatimidfoundationpeshawar.com',
    'smtp_port' => 465,
    'smtp_user' => 'info@fatimidfoundationpeshawar.com',
    'smtp_pass' => 'dilwale2015',
    'mailtype'  => 'html',
    'charset'   => 'utf-8'
);
$this->email->initialize($config);
$this->email->set_mailtype("html");
$this->email->set_newline("\r\n");

//Email content
$htmlContent = '<h1>Sending email via SMTP server</h1>';
$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.<h1>This is a Heading</h1>
<p>This is a paragraph.</p>
</p>';


$this->email->to('yaminkhan564@gmail.com');
$this->email->from('info@fatimidfoundationpeshawar.com','MyWebsite');
$this->email->subject('How to send email via SMTP server in CodeIgniter');
$this->email->message($htmlContent);

//Send email

if($this->email->send())
{
    echo "Email sent successfully";
}
                
            
        
        
        
           
        
    	}

    	public function user_registration()
    	{
    		$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district` ORDER by districtTitle ASC;";
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		$this->data['roles'] = 15;//$this->user_m->runQuery($roles_query);

		$this->load->model("general_modal");
		$this->data['school_types'] = $this->general_modal->school_types();

		$this->data['gender_of_school'] = $this->general_modal->gender_of_school();
		$this->data['level_of_institute'] = $this->general_modal->level_of_institute();
		$this->data['reg_type'] = $this->general_modal->registration_type();
				// $this->data['districts'] = $this->general_modal->districts();
		
		$this->data['session_years'] = $this->db->where('status','1')->order_by("sessionYearId", "asc")->get('session_year')->result();
			
		$this->data['title'] = 'school user';
		$this->data['description'] = 'info about user';
		//$this->data['view'] = 'user/user_registration';
		$this->load->view('user/user_registration', $this->data);
    	}

    	public function academy_registration()
    	{
    		$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district` ORDER by districtTitle ASC;";
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		$this->data['roles'] = 20;//$this->user_m->runQuery($roles_query);

		$this->load->model("general_modal");
		$this->data['gender_of_school'] = $this->general_modal->gender_of_school();
			
		$this->data['title'] = 'school user';
		$this->data['description'] = 'info about user';
		//$this->data['view'] = 'user/user_registration';
		$this->load->view('user/academy_registration', $this->data);
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


	public function get_tehsils_by_district_id(){
		$district_id = $this->input->post('id');
		if(!empty($district_id)){
		$this->load->model("general_modal");
		$response = $this->general_modal->tehsils($district_id, FALSE);
		echo $response;
		return;
		}else{
			return "<option></option>";
		}
	}
	// Here Registration data will be inserted for new acount in database

	public function create_school_user_process()
	{
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
					'field' => 'userName',
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
		      	),
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
		$this->form_validation->set_message('matches', 'The %s is not matching with Password');

		$post=$this->input->post();
		 //var_dump($post);exit;
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){
			$insert = array(
				'role_id' => $this->input->post('role_id'),
				'userTitle' => $this->input->post('name'),
				'userName' => $this->input->post('userName'),
				'userPassword' => $this->input->post('password'),
				'userEmail' => $this->input->post('email'),
				'cnic'		=>	$this->input->post("cnic"),
				'createdDate'=> $this->input->post("createdDate"),
				'district_id' => $this->input->post("district"),
				'gender'=> $this->input->post("gender"),
				'address'=> $this->input->post("address"),
				'userStatus' =>1,
				'contactNumber' => $this->input->post("contactNumber")
				
			);
			$result = $this->user_m->save($insert);
			
			if($result)
			{
                           ///////////////////////////////////////
						    $posts = $this->input->post();

						    $schools_data = array(
							'schoolName' => $posts['schoolName'],
							'district_id' => $posts['district'],
							'tehsil_id' => $posts['tehsil_id'],
							'uc_id' => $posts['uc_id'],
							'postal_address' => $posts['postal_address'],
							'reg_type_id' => $posts['reg_type_id'],
							'yearOfEstiblishment'=> $posts['yearOfEstiblishment'],
							'telePhoneNumber' => $posts['telePhoneNumber'],
							'location' => $posts['location'],
							'gender_type_id' => $posts['gender_type_id'],
							'school_type_id' => $posts['school_type_id'] ,
							'level_of_school_id' => $posts['level_of_school_id'],
							'schoolTypeOther' => $posts['schoolTypeOther'],
							'ppcCode'=> $posts['ppcCode'],
							
							'createdDate' => $posts['createdDate'],
							'owner_id' => $result
							);

							if(!empty($posts['ppcCode'])){
								$schools_data['ppcName'] = $posts['schoolName'];
							}
							// echo json_encode($schools_data);exit();
						$this->db->insert('schools', $schools_data);
						$schools_id = $this->db->insert_id(); 
						///////////////////////////////////////////////////
						         if($schools_id)
						         {
						         	/////////////////////
						         	$school_info_slave_table_data = array( 
									'schools_id' => $schools_id,
									'reg_type_id'=> $posts['reg_type_id'],
									'session_year_id' => $posts['session_year_id'],
									'gender_type_id' => $posts['gender_type_id'],
									'school_type_id' => $posts['school_type_id'],
									'level_of_school_id' => $posts['level_of_school_id'],
									
									'updatedDate' => $posts['createdDate']
									);

									$this->db->insert('school', $school_info_slave_table_data);
									$school_id = $this->db->insert_id();
						         	/////////////////////
						         	            if($school_id)
						         	            {
						         	            	//////////////
						         	            	 $form_proccess_insert_data = array(
													'user_id'      => $result,
													'school_id'   => $school_id,
													'reg_type_id'=> $posts['reg_type_id']
														);
													$this->db->insert('forms_process', $form_proccess_insert_data);
													$forms_process = $this->db->insert_id();
						         	            	/////////////
						         	            	if(!empty($forms_process)){
													$this->session->set_flashdata('registration_success', "<strong>".$this->input->post('name').'</strong><br/><i> You have successfully Registred your acount.Now Enter your User Name and Password to Login.</i>');
				                                        redirect("user/login");
													}
													else{
													$user_id = $result;
													$this->db->delete('users', array('userId' => $user_id));
													$this->db->delete('schools', array('schoolId' => $schools_id));
													$this->db->delete('school', array('schoolId' => $school_id));
													$arr["status"] = FALSE;
													$arr["msg"] = $msg; 
												}
						         	            }
                                   
						         }   
			}

		}
		else
		{
			$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district`;";
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		$this->data['roles'] = 15;//$this->user_m->runQuery($roles_query);

		$this->load->model("general_modal");
		$this->data['school_types'] = $this->general_modal->school_types();

		$this->data['gender_of_school'] = $this->general_modal->gender_of_school();
		$this->data['level_of_institute'] = $this->general_modal->level_of_institute();
		$this->data['reg_type'] = $this->general_modal->registration_type();
				// $this->data['districts'] = $this->general_modal->districts();
		
		$this->data['session_years'] = $this->db->order_by("sessionYearId", "desc")->get('session_year')->result();
			
		$this->data['title'] = 'school user';
		$this->data['description'] = 'info about user';
		//$this->data['view'] = 'user/user_registration';
		$this->load->view('user/user_registration', $this->data);
		}
		
	}

	public function create_academy_user_process()
	{
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
					'field' => 'userName',
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
		      	),
		    array(
				'field' => 'academy_name',
				'label' => 'Academy Name',
				'rules'	=> 'required|trim'
			),
			array(
					'field' => 'gender_type_id',
					'label' => 'School Gender',
					'rules' => 'required|trim'
			),
				array(
				'field' => 'yearOfEstiblishment',
				'label' => 'Year Of Estiblishment',
				'rules' => 'required|trim'
				)
			
			
			
		);
		$this->form_validation->set_message('matches', 'The %s is not matching with Password');

		
		 //var_dump($post);exit;
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){
			$insert = array(
				'role_id' => $this->input->post('role_id'),
				'userTitle' => $this->input->post('name'),
				'userName' => $this->input->post('userName'),
				'userPassword' => $this->input->post('password'),
				'userEmail' => $this->input->post('email'),
				'cnic'		=>	$this->input->post("cnic"),
				'createdDate'=> $this->input->post("createdDate"),
				'district_id' => $this->input->post("district"),
				'gender'=> $this->input->post("gender"),
				'address'=> $this->input->post("address"),
				'userStatus' =>1,
				'contactNumber' => $this->input->post("contactNumber")
				
			);
			$result = $this->user_m->save($insert);
			
			if($result)
			{
                           ///////////////////////////////////////
						    $posts = $this->input->post();

						    $academy_data = array(
							'academy_name' => $posts['academy_name'],
							'district_id' => $posts['district'],
							'tehsil_id' => $posts['tehsil_id'],
							'uc_id' => $posts['uc_id'],
							'postal_address' => $posts['postal_address'],
							
							'establishment_year'=> $posts['yearOfEstiblishment'],
							'telePhoneNumber' => $posts['telePhoneNumber'],
							'location' => $posts['location'],
							
							'gender_of_academy' => $posts['gender_type_id'],
							'createdDate' => $posts['createdDate'],
							'owner_id' => $result
							);

							
							// echo json_encode($schools_data);exit();
						$this->db->insert('tuition_academy_info', $academy_data);
						$academy_id = $this->db->insert_id(); 
						///////////////////////////////////////////////////
						         if($academy_id){
													$this->session->set_flashdata('registration_success', "<strong>".$this->input->post('name').'</strong><br/><i> You have successfully Registred your acount.Now Enter your User Name and Password to Login.</i>');
				                                        redirect("user/login");
													}
													else{
													$user_id = $result;
													$this->db->delete('users', array('userId' => $user_id));
													
													$this->session->set_flashdata('msg_error', "Registration Failed Please Try again!");
				                                        redirect("user/login");
												}
			}

		}
		else
		{
			$district_query = "SELECT
			    `districtId`
			    , `districtTitle`
			FROM
			    `district`;";
		$this->data['districts'] = $this->user_m->runQuery($district_query);
		$this->data['roles'] = 20;//$this->user_m->runQuery($roles_query);

		$this->load->model("general_modal");
		
		
		$this->data['gender_of_school'] = $this->general_modal->gender_of_school();
		
			
		$this->data['title'] = 'school user';
		$this->data['description'] = 'info about user';
		//$this->data['view'] = 'user/user_registration';
		$this->load->view('user/academy_registration', $this->data);
		}
	}

	   public function check_userAndPass(){
		$username = $this->input->post('userName');
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
    }
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
		    // $this->load->model('module_m');
    	}

	public function index($status = NULL){

    if($status == NULL){
        $this->data['modules'] = $this->module_m->getBy("module_status in (0,1,2) and module_type = 'controller'");
    }else{
        $this->data['modules'] = $this->module_m->getBy(array("module_status" => $status));
    }
		$this->data['title'] = 'module';
		$this->data['description'] = 'info about module';
		$this->data['view'] = 'modules/modules';
		$this->load->view('layout', $this->data);
	}

	public function create_form($parent_id = 0){

    $this->data['parent_id'] = (int) $parent_id;

    $parent_id = $this->input->post('parent_id');
    // below is for redirection and setting data for insertion
    if(!$this->data['parent_id'] == 0){
        $this->data['title'] = 'method';
        $this->data['description'] = 'info about method';
    }else{
        $this->data['title'] = 'module';
        $this->data['description'] = 'info about module';
    }

    $this->data['icons'] = $this->db->get('icons')->result();
		$this->data['view'] = 'modules/create';
		$this->load->view('layout', $this->data);
	}


  /**
   * function to create a new modules / methods
   */
   public function create_process(){
            
      //set the validations
   // var_dump($this->input->post());
   // exit;
      $parent_id = $this->input->post('parent_id');
      // below is for redirection and setting data for insertion
      if(!$parent_id == 0){
        $redirect = "modules/actions/".$parent_id;
        $method_or_controller = "action";
      }else{
        $redirect = "modules";
        $method_or_controller = "controller";
      }
      $validation_config = array(
          array(
              'field' => 'module_title',
              'label' => 'Module name',
              'rules' => 'required'
          ),
          array(
              'field' => 'uri',
              'label' => 'module / method URL',
              'rules' => 'required'
          )
      );
      $this->form_validation->set_rules($validation_config);

      if($this->form_validation->run() == TRUE){
          
          $inputs = array(
              "module_title"          => $this->input->post("module_title"),
              "module_type"           => $method_or_controller,
              "parent_id"             => $parent_id,
              "module_uri"            => $this->input->post("uri"),
              "module_desc"           => $this->input->post("desc"),
              "module_menu_status"    => $this->input->post("menu_status"),
              "module_icon"           => $this->input->post("icon"),
              "module_status"         => $this->input->post("status"),
              "created_by"            => $this->session->userdata('user_id')
          );
          if($this->module_m->save($inputs)){
              
              $this->session->set_flashdata("msg_success", "New $method_or_controller has been created successfully");
              redirect($redirect);
          }else{
              
              $this->session->set_flashdata("msg_error", "Something's wrong, Please try later");
              redirect("modules");
          }
      }else{
              $this->data['parent_id'] = (int) $parent_id;
              $this->data['title'] = 'module';
              $this->data['description'] = 'info about module';
              $this->data['icons'] = $this->db->get('icons')->result();
              $this->data['view'] = 'modules/create';
              $this->load->view('layout', $this->data);
      }
   }
   //----------------------------------------------------------------------------

  /***********************************************************************/
  /************************ Actions management ***************************/
  /***********************************************************************/
  
  /**
   * get all actions of a controller
   */
  public function actions($module_id){
      
      $module_id = (int) $module_id;
      $this->data['title'] = 'method';
      $this->data['description'] = 'In this page you can view all actions related to clicked controller.';
      $this->data['module_name'] = $this->module_m->getModuleName($module_id);
      $this->data['module_id'] = $module_id;
      $this->data['modules'] = $this->module_m->getBy("parent_id = '".$module_id."' and module_status in (0,1,2)");
      $this->data['view'] = 'modules/actions';
      $this->load->view('layout', $this->data);
  }
  //---------------------------------------------------------------------------
	public function create(){
		$validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules'	=> 'required|trim|min_length[3]'
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
					'rules' => 'required|valid_email|is_unique[user.email]'
			)
		);
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){
			$insert = array(
				'role_id' => $this->input->post('role_id'),
				'user_title' => $this->input->post('name'),
				'user_name' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email')		
			);
			$this->module_m->save($insert);
		}else{
			$this->session->set_userdata('active','true');
			$this->data['title'] = 'user';
			$this->data['description'] = 'info about user';
			$this->data['view'] = 'user/user';
			$this->load->view('layout', $this->data);
			
		}
	}



	// code samples

	    
    /**
     * Default action to be called
     */ 
    public function index1(){
		redirect(ADMIN_DIR.$this->session->userdata('role_homepage_uri'));
       // $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		//redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`users`.`status` IN (0, 1) ";
		$data = $this->module_model->get_user_list($where);
		 $this->data["users"] = $data->users;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Users');
		$this->data["view"] = ADMIN_DIR."users/users";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_user($user_id){
        
        $user_id = (int) $user_id;
        
        $this->data["users"] = $this->module_model->get_user($user_id);
        $this->data["title"] = $this->lang->line('User Details');
		$this->data["view"] = ADMIN_DIR."users/view_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`users`.`status` IN (2) ";
		$data = $this->module_model->get_user_list($where);
		 $this->data["users"] = $data->users;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Users');
		$this->data["view"] = ADMIN_DIR."users/trashed_users";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->module_model->changeStatus($user_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
    }
    
    /**
      * function to restor user from trash
      * @param $user_id integer
      */
     public function restore($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->module_model->changeStatus($user_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."users/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft user from trash
      * @param $user_id integer
      */
     public function draft($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->module_model->changeStatus($user_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish user from trash
      * @param $user_id integer
      */
     public function publish($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->module_model->changeStatus($user_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a User
      * @param $user_id integer
      */
     public function delete($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        //$this->module_model->changeStatus($user_id, "3");
        //Remove file....
						$users = $this->module_model->get_user($user_id);
						$file_path = $users[0]->user_image;
						$this->module_model->delete_file($file_path);
		$this->module_model->delete(array( 'user_id' => $user_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."users/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new User
      */
     public function add(){
		
    $this->data["roles"] = $this->module_model->getList("roles", "role_id", "role_title", $where ="`role_id` > 1");
    $this->data["districts"] = $this->module_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
        $this->data["title"] = $this->lang->line('Add New User');$this->data["view"] = ADMIN_DIR."users/add_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->module_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("user_image")){
                       $_POST['user_image'] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $user_id = $this->module_model->save_data();
          if($user_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."users/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a User
      */
     public function edit($user_id){
		 $user_id = (int) $user_id;
        $this->data["user"] = $this->module_model->get($user_id);
		  
    $this->data["roles"] = $this->module_model->getList("roles", "role_id", "role_title", $where ="`role_id` > 1");
    $this->data["districts"] = $this->module_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
        $this->data["title"] = $this->lang->line('Edit User');$this->data["view"] = ADMIN_DIR."users/edit_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($user_id){
		 
		 $user_id = (int) $user_id;
       
	   if($this->module_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("user_image")){
                         $_POST["user_image"] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $user_id = $this->module_model->update_data($user_id);
          if($user_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }
        }else{
			$this->edit($user_id);
			}
		 
		 }
	 
     
     /**
      * logout a user
      */
     public function logout(){
        $this->module_m->logout();
        redirect(ADMIN_DIR."users/login");
     }
    //-----------------------------------------------------
	
	/**
      * function to login a user
      */
     public function login(){
        
        //check if the user is already logedin
        if($this->module_m->loggedIn() == TRUE){
            redirect(ADMIN_DIR."users/view");
        }
        
        //load other models
        $this->load->model("role_m");
        $this->load->model("module_m");
        
        $validations = array(
            /*array(
                'field' =>  'user_email',
                'label' =>  'Email Address',
                'rules' =>  'valid_email|required'
            ),
            */
            array(
                'field' =>  'user_password',
                'label' =>  'Password',
                'rules' =>  'required'
            )
        );
        $this->form_validation->set_rules($validations);
        if($this->form_validation->run() === TRUE){
            
            $input_values = array(
                'user_name' => $this->input->post("user_email"),
                'user_password' => $this->input->post("user_password")
            );
            
            //get the user
            $user = $this->module_m->getBy($input_values, TRUE);
			//var_dump($user);
			//exit;
            
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
				
				$fields = "roles.*";
				$join  = array();
				$where = "roles.role_id = $user->role_id";
                $role=$roles= $this->role_m->joinGet($fields, "roles", $join, $where);
				
				//get user projects  by role id
				
						
				
                $user_data = array(
					"user_id"  => $user->user_id,
                    "user_email" => $user->user_email,
                    "user_title" => $user->user_title,
                    "role_id" => $user->role_id,
					"role_level" =>  $role[0]->role_level,
					"district_id" => $user->district_id,
                    "role_homepage_id" => $role_homepage_id,
                    "role_homepage_uri" => $homepage_path,
                    "ngo_id" => $user->ngo_id,
					"user_image" => $user->user_image ,
                    "logged_in" => TRUE
                );
                
                //add to session
                $this->session->set_userdata($user_data);
				//var_dump($this->session->userdata);
				//exit;
                $this->session->set_flashdata('msg_success', "<strong>".$user->user_title.'</strong><br/><i>welcome to admin panel</i>');
                redirect(ADMIN_DIR.$homepage_path);
				 
				
            }else{
                $this->session->set_flashdata('msg', 'Email or password is incorrect');
                redirect(ADMIN_DIR."users/login");
            }
        }else{
            
            $this->data['title'] = "Login to dashboard";
            $this->load->view(ADMIN_DIR."users/login", $this->data);
        }
        
     }
	 
	 
	public function update_profile(){
		 
		 $user_id = (int) $this->session->userdata('user_id');
        $this->data["user"] = $this->module_model->get($user_id);
        
        
        $validation_config = array(
						array(
                            "field"  =>  "user_email",
                            "label"  =>  "User Email",
                            "rules"  =>  "required"
                        ),
                        
                        
                        array(
                            "field"  =>  "user_password",
                            "label"  =>  "User Password",
                            "rules"  =>  "required"
                        ),
						
						  array(
                            "field"  =>  "module_mobile_number",
                            "label"  =>  "Mobile Number",
                            "rules"  =>  "required"
                        ),
						
                        
            );
        
        
        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
            
            
                    $config = array(
                        "upload_path" => "./assets/uploads/".$this->router->fetch_class()."/",
                        "allowed_types" => "jpg|jpeg|bmp|png|gif",
                        "max_size" => 10000,
                        "max_width" => 0,
                        "max_height" => 0,
                        "remove_spaces" => true,
                        "encrypt_name" => true
                    );
                    if(!$this->upload_file("user_image", $config)){
                        //var_dump($this->data["upload_error"]);
                    }else{
                        //var_dump($this->data["upload_data"]);
                        $user_image = $this->data["upload_data"]["file_name"];
                    }
                    
            
            $inputs = array();
            
                    
                    
                     $inputs["user_email"]  =  $this->input->post("user_email");
                    
                     $inputs["user_password"]  =  $this->input->post("user_password");
					
					$inputs["module_mobile_number"]  =  $this->input->post("module_mobile_number");
					
					
                    
                    if($_FILES["user_image"]["size"] > 0){
                        $inputs["user_image"]  =  $this->router->fetch_class()."/".$user_image;
                    }
                    
            
            if($this->module_model->save($inputs, $user_id)){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."users/update_profile");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."users/update_profile");
            }
        }
        
        $this->data["title"] = $this->lang->line('Update Profile');
		$this->data["view"] = ADMIN_DIR."users/update_profile";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     
		  
	  } 
}

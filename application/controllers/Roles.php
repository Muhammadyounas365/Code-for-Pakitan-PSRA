<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
		    // $this->load->model('module_m');
        $this->load->model("role_m");
    	}

	public function index(){

    // $fields = "*";
    // $join  = 
    // array(
    //     "modules" => "roles.role_homepage = modules.module_id"
    // );
    // $where = "";
    $query = $this->db->query("SELECT * FROM roles LEFT JOIN  modules on modules.module_id = roles.role_homepage");
    // $data = 
    
    $this->data['roles'] = $query->result();
    $this->data['title'] = 'role';
		$this->data['description'] = 'info about role';
		$this->data['view'] = 'roles/roles';
		$this->load->view('layout', $this->data);
	}
	public function create_form(){
    $this->data['module_tree'] = $this->module_m->modulesTree();
    $this->data['modules'] = $this->module_m->get();
		$this->data['title'] = 'role';
		$this->data['description'] = 'info about roles';
		$this->data['view'] = 'roles/create';
		$this->load->view('layout', $this->data);
	}
	public function create_process(){
      //load required models
      $this->load->model("mr_m");
      $this->load->model("module_m");
      $module_ids = explode(",", $this->input->post("checked_modules"));
      
      //validation configuration
      $validation_config = array(
          array(
              'field' =>  'role_title',
              'label' =>  'Role Title',
              'rules' =>  'trim|required'
          ),
          array(
              'field' =>  'checked_modules',
              'label' =>  'Modules',
              'rules' =>  'trim|is_string'
          )
      );
      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
          
          $inputs = array(
              'role_title'    =>  $this->input->post('role_title'),
              'role_desc'     =>  $this->input->post('role_desc'),
              'role_homepage' =>  $this->input->post('role_homepage'),
              'role_level'    =>  1,
              'role_status'   =>  $this->input->post('role_status'),
              'created_by'    => $this->session->userdata('user_id'),
          );
          
          $role_id = $this->role_m->save($inputs);
          if($role_id){
              //now save all checked modules
              $compiled_module_ids = $this->module_m->compileModuleIds($module_ids);
              if(count($compiled_module_ids) > 1){
                  $this->mr_m->addRights($role_id, $compiled_module_ids);
              }
              $this->session->set_flashdata('msg_success', 'New role has been created successfully');
              redirect('roles');
          }else{
              $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
              redirect('roles/create_form');
          }
      }else{
          
              $this->data['module_tree'] = $this->module_m->modulesTree();
              $this->data['modules'] = $this->module_m->get();
              $this->data['title'] = 'role';
              $this->data['description'] = 'info about roles';
              $this->data['view'] = 'roles/create';
              $this->load->view('layout', $this->data);
      }

	}


  /**
   * edit a role
   * @param $role_id integer
   */
  public function edit($role_id){
      //load required models
    // var_dump($this->input->post());
    // exit;
        $this->load->model("mr_m");
        $this->load->model("module_m");
         
        //get this controller data to populate form
        $role_id = (int) $role_id;
        $this->data['role'] = $this->role_m->get($role_id);
        $module_ids = explode(",", $this->input->post("checked_modules"));
        
    
        //validation configuration
        $validation_config = array(
            array(
                'field' =>  'role_title',
                'label' =>  'Role Title',
                'rules' =>  'trim|required'
            ),
            array(
                'field' =>  'checked_modules',
                'label' =>  'Modules',
                'rules' =>  'trim|is_string'
            )
        );
        $this->form_validation->set_rules($validation_config);
        if($this->form_validation->run() === TRUE){
            
            $inputs = array(
                'role_title'    =>  $this->input->post('role_title'),
                'role_desc'     =>  $this->input->post('role_desc'),
                'role_homepage' =>  $this->input->post('role_homepage'),
                'role_status'   =>  $this->input->post('role_status')
            );
            
            if($this->role_m->save($inputs, $role_id)){
                
                //now lets process modules rights
                $this->mr_m->deleteRights($role_id);
                //get parent module ids and compile the array
                $compiled_module_ids = $this->module_m->compileModuleIds($module_ids);


                if(count($compiled_module_ids) > 1){
                    $this->mr_m->addRights($role_id, $compiled_module_ids);
                }
                
                
                $this->session->set_flashdata('msg_success', 'Role has been updated successfully');
                redirect('roles/edit/'.$role_id);
            }else{
                $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
                redirect('roles/edit/'.$role_id);
            }
      }else{
          $this->load->helper('my_functions_helper');
          $this->data['module_tree'] = $this->module_m->modulesTree();
          $this->data['this_role_rights'] = $this->mr_m->rightsByRole($role_id);
          $this->data['modules'] = $this->module_m->get();
          $this->data['title'] = 'role edit';
          $this->data['description'] = 'here you can edit and save the changes on fly.';
          $this->data['view'] = 'roles/edit_role';
          $this->load->view('layout', $this->data);
      }
  }

	    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain_type extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("complain_type_m");
    	}

	public function index(){
    
    $this->data['complainTypes'] = $this->complain_type_m->get();
    // var_dump($this->data['districts']);
    // exit();
    $this->data['title'] = 'complain type';
		$this->data['description'] = 'info about complain type';
		$this->data['view'] = 'complain_type/complain_type';
		$this->load->view('layout', $this->data);
	}


	public function create_form(){
		$this->data['title'] = 'Complain Type';
		$this->data['description'] = 'info about Complain Type';
		$this->data['view'] = 'complain_type/create';
		$this->load->view('layout', $this->data);
	}


	public function create_process($complain_id = null){
    
      //validation configuration
      $validation_config = array(
          array(
              'field' =>  'complainTypeTitle',
              'label' =>  'Complain Type Title',
              'rules' =>  'trim|required'
          )
      );
      $post_data = $this->input->post();
      // unset($posts['text_password']);
      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
          if($complain_id == null){
            $msg = "New complain type has been created successfully";
            $type = "msg_success";
            $insert_id = $this->complain_type_m->save($post_data);            
          }else{
            $type = "msg";
            $msg =  "Complain type has been updated successfully";
            $insert_id = $this->complain_type_m->save($post_data, $complain_id);
          }
          
          if($insert_id){
              $this->session->set_flashdata($type, $msg);
              redirect('complain_type');
          }else{
              $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
              redirect('complain_type/create_form');
          }
      }else{

          if($complain_id == null){
          $this->create_form();
          }else{

          $this->session->set_flashdata('msg_error', "Something's wrong, Please try again.");
          $path = "complain_type/edit/".$complain_id;
          redirect($path);
          }
      
      }

	}


  /**
   * edit a district
   * @param $district id integer
   */
  public function edit($complain_id){

        $complain_id = (int) $complain_id;
        $this->data['complainTypes'] = $this->complain_type_m->get($complain_id);
        $this->data['title'] = 'complain Type edit';
        $this->data['description'] = 'here you can edit and save the changes on fly.';
        $this->data['view'] = 'complain_type/complain_type_edit';
        $this->load->view('layout', $this->data);

  }

  public function delete($complain_id){
    $complain_id = (int) $complain_id;
    $where = array('complainTypeId' => $complain_id );
    $result = $this->complain_type_m->delete($where);
    if($result){
        $this->session->set_flashdata('msg_success', "complain Type successfully deleted.");
          redirect('complain_type');
      }else{
          $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
          redirect('complain_type');
    }
  }
	    
}

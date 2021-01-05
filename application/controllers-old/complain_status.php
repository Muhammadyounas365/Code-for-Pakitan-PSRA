<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class complain_status extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("complain_status_m");
    	}

	public function index(){
    
    $this->data['complainStatuses'] = $this->complain_status_m->get();
    // var_dump($this->data['districts']);
    // exit();
    $this->data['title'] = 'complain status';
		$this->data['description'] = 'info about complain status';
		$this->data['view'] = 'complain_status/complain_status';
		$this->load->view('layout', $this->data);
	}


	public function create_form(){
		$this->data['title'] = 'Complain status';
		$this->data['description'] = 'info about Complain status';
		$this->data['view'] = 'complain_status/create';
		$this->load->view('layout', $this->data);
	}


	public function create_process($complain_id = null){
    
      //validation configuration
      $validation_config = array(
          array(
              'field' =>  'statusTitle',
              'label' =>  'Complain Status Title',
              'rules' =>  'trim|required'
          )
      );
      $post_data = $this->input->post();
      // unset($posts['text_password']);
      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
          if($complain_id == null){
            $msg = "New complain status has been created successfully";
            $type = "msg_success";
            $insert_id = $this->complain_status_m->save($post_data);            
          }else{
            $type = "msg";
            $msg =  "Complain status has been updated successfully";
            $insert_id = $this->complain_status_m->save($post_data, $complain_id);
          }
          
          if($insert_id){
              $this->session->set_flashdata($type, $msg);
              redirect('complain_status');
          }else{
              $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
              redirect('complain_status/create_form');
          }
      }else{

          if($complain_id == null){
          $this->create_form();
          }else{

          $this->session->set_flashdata('msg_error', "Something's wrong, Please try again.");
          $path = "complain_status/edit/".$complain_id;
          redirect($path);
          }
      
      }

	}


  /**
   * edit a status
   * @param $status id integer
   */
  public function edit($status_id){

        $status_id = (int) $status_id;
        $this->data['complainStatus'] = $this->complain_status_m->get($status_id);
        $this->data['title'] = 'complain Status edit';
        $this->data['description'] = 'here you can edit and save the changes on fly.';
        $this->data['view'] = 'complain_status/complain_status_edit';
        $this->load->view('layout', $this->data);

  }

  public function delete($status_id){
    $status_id = (int) $status_id;
    $where = array('statusId' => $status_id );
    $result = $this->complain_status_m->delete($where);
    if($result){
        $this->session->set_flashdata('msg_success', "complain Type successfully deleted.");
          redirect('complain_status');
      }else{
          $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
          redirect('complain_status');
    }
  }
	    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("districts_m");
    	}

	public function index(){
    
    $this->data['districts'] = $this->districts_m->get();
    // var_dump($this->data['districts']);
    // exit();
    $this->data['title'] = 'districts';
		$this->data['description'] = 'info about districts';
		$this->data['view'] = 'districts/districts';
		$this->load->view('layout', $this->data);
	}


	public function create_form(){
		$this->data['title'] = 'district';
		$this->data['description'] = 'info about districts';
		$this->data['view'] = 'districts/create';
		$this->load->view('layout', $this->data);
	}


	public function create_process($district_id = null){
    
      //validation configuration
      $validation_config = array(
          array(
              'field' =>  'districtTitle',
              'label' =>  'District Title',
              'rules' =>  'trim|required'
          )
      );
      $post_data = $this->input->post();
      // unset($posts['text_password']);
      $this->form_validation->set_rules($validation_config);
      if($this->form_validation->run() === TRUE){
          if($district_id == null){
            $type = "New district has been created successfully";
            $insert_id = $this->districts_m->save($post_data);            
          }else{
            $type = "District has been updated successfully";
            $insert_id = $this->districts_m->save($post_data, $district_id);
          }
          
          if($insert_id){
              $this->session->set_flashdata('msg_success', $type);
              redirect('district');
          }else{
              $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
              redirect('district/create_form');
          }
      }else{

          if($district_id == null){
          $this->create_form();
          }else{

          $this->session->set_flashdata('msg_error', "Something's wrong, Please try again.");
          $path = "district/edit/".$district_id;
          redirect($path);
          }
      
      }

	}


  /**
   * edit a district
   * @param $district id integer
   */
  public function edit($district_id){

        $district_id = (int) $district_id;
        $this->data['district'] = $this->districts_m->get($district_id);
        $this->data['title'] = 'district edit';
        $this->data['description'] = 'here you can edit and save the changes on fly.';
        $this->data['view'] = 'districts/district_edit';
        $this->load->view('layout', $this->data);

  }

  public function delete($district_id){
    $district_id = (int) $district_id;
    $where = array('districtId' => $district_id );
    $result = $this->districts_m->delete($where);
    if($result){
        $this->session->set_flashdata('msg_success', "District successfully deleted.");
          redirect('district');
      }else{
          $this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
          redirect('district');
    }
  }
	    
}

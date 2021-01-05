<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academy extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("academy_m");
    	}

	public function index($id = 0){
    
    $district_id = $this->session->userdata('district_id');

      
        // this block will contain some code for admin

        $this->load->model('general_modal');
        $this->data['districts'] = $this->general_modal->districts(0, FALSE);
      
      $query = $this->db->get('tuition_academy_info');
      $number_of_rows = $query->num_rows();
      // pagination code is executed and dispaly pagination in view
      $this->load->library('pagination');
          $config = [
              'base_url'  =>  base_url('academy/index'),
              'per_page'  =>  20,
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
    $this->data['academies'] = $this->academy_m->get_academies($config['per_page'], $offset);
    // echo "<pre />";
    // var_dump($this->data['schools']);
    // exit();
    $this->data['title'] = 'Academy';
    $this->data['description'] = 'info about Academy';
    $this->data['view'] = 'academy/academies';
    $this->load->view('layout', $this->data);
	}


	public function search_academies_by_criteria(){
		$district_id = '';
      $tehsil_id = '';
      $matchString = '';
      $academy_id=0;
      if(!empty($this->input->post('academy_id'))){
          $academy_id = $this->input->post('academy_id');
      }else{
          $district_id = $this->input->post('district_id');
          $tehsil_id = $this->input->post('tehsil_id');
          $matchString = $this->input->post('matchString');
      }
      $this->data['academies'] = $this->academy_m->get_academies_by_search_criteria($academy_id, $matchString, $district_id, $tehsil_id);
      $this->load->view('academy/search_academy_by_criteria', $this->data);
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

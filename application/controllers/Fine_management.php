<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fine_management extends Admin_Controller {
	
	public function __construct(){
        
        parent::__construct();
        $this->load->model("general_modal");
        $this->load->model("user_m");
        $this->load->model("school_m");
    	}


      public function index()
      {

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
              'base_url'  =>  base_url('fine_management/index'),
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
    $this->data['schools'] = $this->school_m->get_schools_list($config['per_page'], $offset);
    // echo "<pre />";
    // var_dump($this->data['schools']);
    // exit();
          $this->data['title'] = 'Fine Management';
          $this->data['description'] = 'here you can manage schools fines';
          $this->data['view'] = 'fine_management/all_schools';
          $this->load->view('layout', $this->data);
      }

      public function get_tehsils_list_by_district_id($district_id = 0, $list = FALSE)
    {
        $this->load->model('general_modal');
        echo $this->general_modal->tehsils($district_id, $list);
    }

    public function search_schools_by_creiteria($schools_id = 0)
  {   $arr=array();
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
    $arr['rows']=$this->load->view('fine_management/search_schools_by_creiteria', $this->data,true);
    $arr['status']=true;
    echo json_encode($arr);exit;

  }

  public function get_school_fine_details()
  {
    $arr=array();
    $schools_id=$this->input->post('id');
    if($schools_id)
    {
      $q="SELECT * from schools where schoolId=$schools_id";
      $this->data['school_info']=$this->db->query($q)->row();
      $q1="SELECT * from school_fine_history where school_id=$schools_id order by history_id DESC";
      $this->data['school_fine_history']=$this->db->query($q1)->result();
      //var_dump($school_info);exit;
   $arr['school_info']=$this->load->view('fine_management/school_fine_details_by_ajax', $this->data,true);
    $arr['status']=true;
    echo json_encode($arr);exit;

    }
  }

  public function add_fine_details()
  {
    $arr=array();
    date_default_timezone_set("Asia/Karachi"); 
     $dated = date("d-m-Y h:i:sa");
    $school_id=$this->input->post('school_id');
    if($_POST)
    {
      $school_id=$this->input->post('school_id');
      $update_school=array(
        'isfined'=>$this->input->post('isfined'),
        'fine_amount'=>$this->input->post('amount'),
        'remarks'=>$this->input->post('remarks'),
        'fined_date'=>$dated
        );
     
      $this->db->where('schoolId',$school_id);
      $this->db->update('schools',$update_school);
        $affected_rows = $this->db->affected_rows();
        if($affected_rows)
        { 
          
          $school_fine_history=array(
        'is_fined'=>$this->input->post('isfined'),

        'school_id'=> $school_id,
        'fine_amount'=>$this->input->post('amount'),
        'remarks'=>$this->input->post('remarks'),
        'created_date'=>$dated,
        'created_by'=>$this->session->userdata('userId')
        );
        $this->db->insert('school_fine_history', $school_fine_history);
          $arr['fine_status']=$this->input->post('isfined');
          $arr['status']=true;
        }
        else
        {
          $arr['status']=false;
        }
    }
    else
    {
      $arr['status']=false;
    }
    echo json_encode($arr);exit;
    //var_dump($_POST);exit;
  }
      
	    
}

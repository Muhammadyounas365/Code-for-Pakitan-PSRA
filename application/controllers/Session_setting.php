<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Session_setting extends Admin_Controller {
  
  public function __construct(){

parent::__construct();
$this->load->model("session_m");
  }
  public function index(){

$this->data['session_years'] = $this->session_m->get_sessions();
    $this->data['description'] = 'info about Session';
    $this->data['title'] = 'Session';
    $next=$this->session_m->get_next_session();
    $this->data['next_session'] = $next->sessionYearTitle;
    $current=$this->session_m->get_current_session();
    $this->data['current_session'] = $current->sessionYearTitle;
    $this->data['view'] = 'session/session_setting';
    $this->load->view('layout', $this->data);
  }
  public function update_current_session()
  {
    if($_POST)
    {
      $session_id=$this->input->post('session_id');
      if($session_id)
      {
        $update_data=array(
          'session_id' =>$session_id
          );
         $this->db->where('setting_name','current');
         $this->db->update('session_setting',$update_data);
         redirect('session_setting');
      }
    }
  }
  public function update_next_session()
  {
    if($_POST)
    {
      $session_id=$this->input->post('session_id');
      if($session_id)
      {
        $update_data=array(
          'session_id' =>$session_id
          );
         $this->db->where('setting_name','next');
         $this->db->update('session_setting',$update_data);
         redirect('session_setting');
      }
    }
  }
  public function create_form(){
    $this->data['title'] = 'age';
    $this->data['description'] = 'info about age';
    $this->data['view'] = 'age/create';
    $this->load->view('layout', $this->data);
  }
  public function create_process($id = null){

//validation configuration
$validation_config = array(
array(
'field' =>  'ageTitle',
'label' =>  'Age Title',
'rules' =>  'trim|required'
)
);
$post_data = $this->input->post();
//var_dump($post_data);exit;
// unset($posts['text_password']);
$this->form_validation->set_rules($validation_config);
if($this->form_validation->run() === TRUE){
if($id == null){
$msg = "New Age has been created successfully";
$type = "msg_success";
$insert_id = $this->age_m->save($post_data);
}else{
$type = "msg";
$msg =  "Age has been updated successfully";
$insert_id = $this->age_m->save($post_data, $id);
}

if($insert_id){
$this->session->set_flashdata($type, $msg);
redirect('age');
}else{
$this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
redirect('age/create_form');
}
}else{
if($id == null){
$this->create_form();
}else{
$this->session->set_flashdata('msg_error', "Something's wrong, Please try again.");
$path = "age/edit/".$id;
redirect($path);
}

}
  }
/**
* edit a district
* @param $district id integer
*/
public function edit($id){

}
public function delete($id){
$id = (int) $id;
$where = array('complainTypeId' => $id );
$result = $this->age_m->delete($where);
if($result){
$this->session->set_flashdata('msg_success', "complain Type successfully deleted.");
redirect('complain_type');
}else{
$this->session->set_flashdata('msg_error', "Something's wrong, Please try later");
redirect('complain_type');
}
}
  
}
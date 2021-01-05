<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NoteSheet extends Admin_Controller { 
  public function index($id=null){ 
    $flage='';
    if ($_SESSION['user_type'] ==1) {
      $flage='1';
    }else if ($_SESSION['user_type'] ==2) {
      $flage='2';
    }else if ($_SESSION['user_type'] ==3) {
      $flage='3';
    }else if ($_SESSION['user_type'] ==4) {
      $flage='4';
    }else if ($_SESSION['user_type'] ==5) {
      $flage='5';
    }else if ($_SESSION['user_type'] ==6) {
      $flage='6';
    }else if ($_SESSION['user_type'] ==7) {
      $flage='7';
    }

    $config = array();
    $this->load->library("pagination");
    $config["base_url"] = base_url() ."Notesheet/index" ;

    $total = $this->db->query("SELECT * FROM schools 
    LEFT JOIN levelofinstitute on levelofinstitute.levelofInstituteId = schools.level_of_school_id
    LEFT JOIN district on district.districtId = schools.district_id
    LEFT JOIN tehsils on tehsils.tehsilId = schools.tehsil_id
    WHERE schools.status_type='$flage'");
    $total = count($total);
    $config["total_rows"] = $total;
    $config["uri_segment"] = 3;

    $config['per_page'] = 20;
    
    $config['reuse_query_string'] = true;
    $config['full_tag_open'] = '<ul class="pagination justify-content-end pull-right">';
    $config['full_tag_close'] = '</ul>';
    $config['attributes'] = ['class' => 'page-link'];
     
    $config['first_link'] = '&laquo; First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
     
    $config['last_link'] = 'Last &raquo;';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
     
    $config['next_link'] = 'Next &rarr;';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
     
    $config['prev_link'] = '&larr; Prev';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
     
    $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
     
    $config['anchor_class'] = 'follow_link';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $this->data["links"] = $this->pagination->create_links(); 
    $limit = $config['per_page'];

    $query = $this->db->query("SELECT * FROM schools 
    LEFT JOIN levelofinstitute on levelofinstitute.levelofInstituteId = schools.level_of_school_id
    LEFT JOIN district on district.districtId = schools.district_id
    LEFT JOIN tehsils on tehsils.tehsilId = schools.tehsil_id
    WHERE schools.status_type='$flage' limit $limit ");
    $this->data['res'] = $query->result_array(); 
    // echo "<pre>"; print_r($res);exit();
    $this->data['view'] = 'Notesheet/notesheet';
    $this->load->view('layout',$this->data); 
 }
 public function ChangeStatus(){
//   echo "<pre>"; print_r($_SESSION);echo $this->input->get('comments');exit();
  if($this->input->get('comments')){

      $this->input->get('comments'); 
      $data['school_id'] = $this->input->get('schoolId');
      $data['comment_text'] = $this->input->get('comments'); 
      $data['comment_by'] = $_SESSION['userId']; 
    //   echo "<pre>"; print_r($data);exit();
      $insert = $this->db->insert("commentnewregistraction",$data);
      if($insert){  
        echo json_encode($res['success'] = '1'); 
      }else{
          echo $this->db->error();
      }
  }else if($this->input->get('para_text')){
      $data['school_id'] = $this->input->get('schoolId');
      $data['para_text'] = $this->input->get('para_text'); 
      $statusType = $this->input->get('statusType'); 
      $data['added_by_id'] = $_SESSION['userId']; 
      $insert = $this->db->insert("paranewregistration",$data);
      if($insert){  
    // echo "UPDATE `schools` SET `status_type` = '".$statusType."' WHERE schoolId ='".$data['school_id']."'";
          $update = $this->db->query("UPDATE `schools` SET `status_type` = '".$statusType."' WHERE schoolId ='".$data['school_id']."'");
          if($update){  
            echo json_encode($res['success'] = '1'); 
          }
        // echo json_encode($res['success'] = '1'); 
      }
  }else if($this->input->get('ViewPara')){
      $response="";
      $id = $this->input->get('schoolId');  
      $query = $this->db->query("SELECT * FROM paranewregistration LEFT JOIN users on paranewregistration.added_by_id = users.userId  WHERE school_id = '".$id."' ");
      $result = $query->result_array();  
      if($result){   
        foreach($result as $res){
          $response .= "<li> <b>TEXT: </b>". $res['para_text']."<br><b> Created at: </b>".$res['para_created_at']."<b> initiated By:</b>".$res['userTitle']."</li>";
        }
        $res['success'] ='1';
        $res['datas'] =$response;
        echo json_encode($res); 
      }
  }else if($this->input->get('ViewComments')){
      $response="";
      $id = $this->input->get('schoolId');  
      $query = $this->db->query("SELECT * FROM commentnewregistraction LEFT JOIN users on commentnewregistraction.comment_by = users.userId  WHERE school_id = '".$id."' ");
      $result = $query->result_array();  
      if($result){   
        foreach($result as $res){
          $response .= "<li> <b>TEXT: </b>". $res['comment_text']."<br><b> Created at: </b>".$res['comment_created_at']."<b> initiated By:</b>".$res['userTitle']."</li>";
        }
        $res['success'] ='1';
        $res['datas'] =$response;
        echo json_encode($res); 
      }
  }else if($this->input->get('status_type')){
      // echo "string";exit();
      $schoolId = $this->input->get('schoolId');
      $status_type = $this->input->get('status_type'); 
      $where =array('schoolId'=>$schoolId);
      // echo "UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'";
      $update = $this->db->query("UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'");
      if($update){  
        echo json_encode($res['success'] = '1'); 
      }
  }
  
  
  else if($this->input->get('addSubject')){
      // echo "string";exit();
      $schoolId = $this->input->get('schoolId');
      $subject = $this->input->get('subject'); 
      $where =array('schoolId'=>$schoolId);
    //   echo  "UPDATE `schools` SET `subjects` = '".$subject."' WHERE schoolId ='".$schoolId."'";
      $update = $this->db->query("UPDATE `schools` SET `subjects` = '".$subject."' WHERE schoolId ='".$schoolId."'");
      if($update){  
        echo json_encode($res['success'] = '1'); 
      }
  }
  
  
  else if($this->input->get('status_type')){
      // echo "string";exit();
      $schoolId = $this->input->get('schoolId');
      $status_type = $this->input->get('status_type'); 
      $where =array('schoolId'=>$schoolId);
      // echo "UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'";
      $update = $this->db->query("UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'");
      if($update){  
        echo json_encode($res['success'] = '1'); 
      }
  }else if($this->input->get('status_type')){
      // echo "string";exit();
      $schoolId = $this->input->get('schoolId');
      $status_type = $this->input->get('status_type'); 
      $where =array('schoolId'=>$schoolId);
      // echo "UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'";
      $update = $this->db->query("UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'");
      if($update){  
        echo json_encode($res['success'] = '1'); 
      }
  }else if($this->input->get('status_type')){
      // echo "string";exit();
      $schoolId = $this->input->get('schoolId');
      $status_type = $this->input->get('status_type'); 
      $where =array('schoolId'=>$schoolId);
      // echo "UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'";
      $update = $this->db->query("UPDATE `schools` SET `status_type` = '".$status_type."' WHERE schoolId ='".$schoolId."'");
      if($update){  
        echo json_encode($res['success'] = '1'); 
      }
  }
 }
 public function renewal_upgradation(){ 
  $this->data['view'] = 'Notesheet/renewal_upgradation';
  $this->load->view('layout',$this->data); 
 }
}
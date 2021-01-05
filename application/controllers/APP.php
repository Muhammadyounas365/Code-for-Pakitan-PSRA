<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class APP extends MY_Controller {

    public $title;
    public $description;
    public $short_description;
    public $date; 
    
    public function updateNotifyKey(){
    if ($this->input->post()) {
      $this->db->where(array('userId'=>$this->input->post('user_id')));
      $this->db->update("users", array('firebaseAppKey'=>$this->input->post('firebaseAppKey')));
    //   print_r($this->db->last_query());exit();
      $affectedRows = $this->db->affected_rows();
      if ($affectedRows) {
        $response["success"] = "200";
        $response["message"] = "update successfully";
        echo json_encode($response);
      } else {
        $response["success"] = "201";
        $response["message"] = "already exist same key";
        echo json_encode($response);
      }
    }else{
      $response["success"] = "401";
      $response["message"] = "Access denied. Invalid access method";
      echo json_encode($response);
    }
   }

    //Firebase notification setting
   
    public function login()
    {
      if ($this->input->post()) {
      $username = $this->input->post('appus_username');
      $password = $this->input->post('appus_password'); 
      $query_login= "SELECT * FROM users where userName = '$username' AND userPassword = '$password'";
      $query = $this->db->query($query_login); $response["userData"]=array();
     if(!$query){
         $response['message']='error in sql query';
         $response['success']='201';
     }       
     else{
      if ($query->num_rows() > 0){
       $result =  $query->result_array();         
       foreach ($result as $row_show) { 
         if ($row_show['userStatus'] != '1'){
            $response["success"] = "204";
            $response["message"] = "your account is Bloked temporarly, contact admin"; // through sms API in signup time
         } 
         // check the status of users whethre it is block or not
         elseif ($row_show['role_id'] !='15') {
           $response["success"] = "401";
           $response["message"] = "Access denied. you'r not Authorized Person";
         }
         // return the app users data 
         else{ 
           $data['user_id']            = $row_show['userId']; 
           $data['role_id']            = $row_show['role_id']; 
           $data['userTitle']          = $row_show['userTitle']; 
           $data['userName']      = $row_show['userName']; 
           $data['userEmail']           = $row_show['userEmail'];
           $data['gender']         = $row_show['gender']; 
           $data['contactNumber']       = $row_show['contactNumber'];   
           $data['district_id']          = $row_show['district_id'];           
           $data['createdDate']          = $row_show['createdDate'];           
           array_push($response["userData"], $data);
           $response["success"] = 200;
         }           
      }
              

      }else{
        $response["success"] = 0;
        $response["message"] = "Username or password incorrect"; 
      } 
     }     
      

    }else{
       $response["success"] = 0;
       $response["message"] = "Acces denied, invaid request";  
    }echo json_encode($response);
}
    
}
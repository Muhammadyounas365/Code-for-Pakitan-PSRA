<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Firebase extends Admin_Controller {

    public $title;
    public $description;
    public $short_description;
    public $date; 
// Sending message to a topic by topic name
    public function index(){
    
         $this->data['view'] = 'firebase/notification';
         $this->load->view('layout', $this->data);
   } 
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );

        return $this->sendPushNotification($fields);
    } // add firebased page access fucntion, xyz_post, send, sendPushNotification
    public function SendNotification(){ 

        $json['title']=  trim($this->input->post('title'));  
        $json['description']= trim($this->input->post('description')); 
        $json['date']= date('d M Y g:i A',time()); 
        $query = $this->db->query("SELECT * FROM users where firebaseAppKey!='' ");
        $data = $query->result_array();  
        // echo "<pre>"; print_r($data);exit ;
        // $key='feNzDGW4Sx-4awV3zrgku1:APA91bEjLkm1oJ7WH8gB3EKJaqImk_6VmmBajbuWzlDbkobLBC4-FIHZ30dcKqbb6U9hg8Wx0-V11ZdmKpwSww_O_pcY25h9-ix1-eQqgnSR7jOVw7DGYOchA0IwRs1ityphG_9Y9vmX';    
        foreach($data as $row){
         $response = $this->send($row['firebaseAppKey'], $json);  
        //  echo "<pre>"; print_r($response);
        }
        
        redirect('Firebase/index');
    }

    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($fields) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . "AAAAHJlhfTw:APA91bFDv64vZkfKeDcfY0LNJnWpEmWXC5CqzkXDqpJLHhloamRLRDAT-Chrf1kD6BpRpgdbbfzR6kvfW5S4YGQPBfBwWyfvGqR7B8MIo-RH_JLu8ujy31vkO7O8jcpH2gf-yvY6clDN",
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
}
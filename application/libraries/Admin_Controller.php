<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Admin_Controller extends MY_Controller{
    
    public $controller_name = "";
    public $method_name = "";
    
    
    public function __construct(){
      
        parent::__construct();
       
        $this->load->helper("my_functions");
        $this->load->model("mr_m");
        $this->load->model("module_m");
        $this->data['controller_name'] = $this->controller_name = $this->router->fetch_class();
        $this->data['method_name'] = $this->method_name = $this->router->fetch_method();
        $this->data['menu_arr'] = $this->mr_m->roleMenu($this->session->userdata("role_id"));
        if($this->session->userdata('role_id')==15)
        {
           $user_id=$this->session->userdata('userId');
        $query = "  SELECT * FROM `schools` where owner_id=$user_id";
        
              $query = $this->db->query($query);
              if(count($query->row()) >0){
                  $school_info=$query->row();
              $school_name=str_replace("'", "",$school_info->schoolName);
        
              $query1 = "SELECT message_for_all.*,`message_school`.`school_id` FROM `message_for_all`
                     left join message_school on `message_for_all`.`message_id`=`message_school`.`message_id`
                     where (`message_school`.`school_id`=$school_info->schoolId AND 
                     `message_for_all`.`select_all`='no')
                     OR  (`message_for_all`.`district_id` in($school_info->district_id,0) AND  `message_for_all`.`level_id` in($school_info->level_of_school_id,0) 
                      AND 
                     `message_for_all`.`select_all`='yes' AND  LOCATE(`message_for_all`.`like_text`,'".$school_name."')> 0)
                     order by `message_for_all`.`message_id` DESC";
              $query1 = $this->db->query($query1);
             // print_r($this->db->last_query()) ;exit;
              // var_dump($query1->result());exit;

                
                $this->data['inbox_messages']=count($query1->result());
                  
              }
                else
                 {
                 $this->data['inbox_messages']=0;
                 }
              
        }
        else
        {
                 $this->data['inbox_messages']=0;
        }
       
        // var_dump($this->session);
        // exit();
        //login check
        $exception_uri = array(
            "user/login",
            "user/logout"
        );
       if(!in_array(uri_string(), $exception_uri)){

            
            if($this->uri->segment(2)!="receive_sms"){

            //check if the user is logged in or not
            if(!$this->session->userdata('userId') && empty($this->session->userdata('userId'))){
                // echo "problem is here too many redirections here...";
                // exit();
                redirect("user/login");
            }

            //now we will check if the current module is assigned to the user or not
            $this->data['current_action_id'] = $current_action_id = $this->module_m->actionIdFromName($this->controller_name, $this->method_name);
            $allowed_modules = $this->mr_m->rightsByRole($this->session->userdata("role_id"));

            
            //add role homepage to allowed modules
            $allowed_modules[] = $this->session->userdata("role_homepage_id");

            if(!in_array($current_action_id, $allowed_modules)){
                $this->session->set_flashdata('msg_error', 'You are not allowed to access this module');
                // redirect($_SERVER['HTTP_REFERER']);
                // session_destroy();
                redirect($this->session->userdata("role_homepage_uri"));

            }
            }
        }
    }

    
    
    
}
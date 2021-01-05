<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	
	public function __construct(){
        
        parent::__construct();
		$this->load->model('task_m');
    	}

	public function index(){

		$this->data['tasks'] = $this->task_m->get();
		$this->data['title'] = 'task';
		$this->data['description'] = 'info about task';
		$this->data['view'] = 'admin/task/task';
		$this->load->view('admin/layout', $this->data);
    }
    
	public function create(){
		$validation_rules = array(
			array(
				'field' => 'task',
				'label' => 'Task',
				'rules'	=> 'required|trim|min_length[3]'
			),
			array(
					'field' => 'description',
					'label' => 'Description',
					'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($validation_rules);
		if($this->form_validation->run()===TRUE){
			$insert = array(
				'task_title' => $this->input->post('task'),
				'task_description' => $this->input->post('description'),
				'status' => 0		
			);
            $this->task_m->save($insert);
            redirect('task');
		}else{
			$this->session->set_userdata('active','true');
			$this->data['title'] = 'task';
			$this->data['description'] = 'info about task';
			$this->data['view'] = 'admin/task/task';
			$this->load->view('admin/layout', $this->data);
			
		}
	}

    
    /**
     * get single record by id
     */
    public function edit($task_id){
        
        $task_id = (int) $task_id;
        
        $this->data["task"] = $this->task_m->get($user_id);
        $this->data['view'] = 'admin/task/edit';
        $this->load->view('admin/layout', $this->data);
    }
    //-----------------------------------------------------
        /**
      * function to permanently delete a task
      * @param $task_id integer
      */
     public function delete($task_id){
        
        $task_id = (int) $task_id;

		$this->task_m->delete(array( 'task_id' => $task_id));
        redirect('task');
     }
     //----------------------------------------------------
    
	 
	 
	 public function update_data($user_id){
		 
    }
}
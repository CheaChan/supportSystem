<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemType extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model', 'm');
    }
	public function index()
	{
		$this->load->view('system');
    }
    public function getSystemList(){
        $result = $this->m->getSystemList();
		echo json_encode($result);
    }
    // add new system
    public function addSystem(){
        $result = $this->m->addSystem();
        $msg['success'] = false;
        $msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // edit system
    public function editSystem(){
        $result = $this->m->editSystem();
		echo json_encode($result);
    }
    // delete system 
    public function deleteSystem(){
        $result = $this->m->deleteSystem();
		$msg['success'] = false;
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function updateSystem(){
        $result = $this->m->updateSystem();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
}

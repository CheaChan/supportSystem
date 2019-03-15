<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model', 'm');
    }
    // ************
    // * Service 
    // ************

    // auto load view
	public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('service');
        }else{
            $this->load->view('login_form');
        }
    }
    // get all service
    public function getserviceList(){
        $result = $this->m->getserviceList();
		echo json_encode($result);
    }
    // add new system
    public function addService(){
        $result = $this->m->addService();
        $msg['success'] = false;
        $msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // edit system
    public function editService(){
        $result = $this->m->editService();
		echo json_encode($result);
    }
    // delete system 
    public function deleteService(){
        $result = $this->m->deleteService();
		$msg['success'] = false;
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // udate service
    public function updateService(){
        $result = $this->m->updateService();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
}

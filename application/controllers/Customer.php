<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model', 'm');
    }
    // *************
    // * Customer
    // *************

    //auto load view
    public function index()
	{
		if(isset($this->session->userdata['logged_in'])){
            $this->load->view('customer');
        }else{
            $this->load->view('login_form');
        }
    }
    // load the view customer
    public function customerList(){
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('customer');
        }else{
            $this->load->view('login_form');
        }
    }
    // get system type
    public function getSystemType(){
        $result = $this->m->getSystemType();
		echo json_encode($result);
    }
    // get service hosting
    public function getServiceHost(){
        $result = $this->m->getServiceHost();
		echo json_encode($result);
    }
    // get service maintenance
    public function getServiceMain(){
        $result = $this->m->getServiceMain();
		echo json_encode($result);
    }
    // calculate the expire date
    public function calExpDate(){
        $result = $this->m->calExpDate();
		echo json_encode($result);
    }
    // get the customer list
    public function getCustomerList(){
        $result = $this->m->getCustomerList();
		echo json_encode($result);
    }
    // add the customer
    public function addCusomter(){
        $result = $this->m->addCusomter();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // get edit customer 
    public function editCustomer(){
        $result = $this->m->editCustomer();
		echo json_encode($result);
    }
    // update the customer
    public function updateCustomer(){
        $result = $this->m->updateCustomer();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // delete the customer
    public function deleteCustomer(){
        $result = $this->m->deleteCustomer();
		$msg['success'] = false;
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // view detail customer 
    public function viewCustomer(){
        $result = $this->m->viewCustomer();
		echo json_encode($result);
    }  
}
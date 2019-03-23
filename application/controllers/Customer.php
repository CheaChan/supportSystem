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
            $this->load->view('dashboard/header');
            $this->load->view('customer');
            $this->load->view('dashboard/footer');
        }else{
            $this->load->view('login_form');
        }
    }
    // load the view customer
    public function customerList(){
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('dashboard/header');
            $this->load->view('customer');
            $this->load->view('dashboard/footer');
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
    // view detail customer service expire
    public function viewCustomerExpire(){
        $result = $this->m->viewCustomerExpire();
		echo json_encode($result);
    } 
    // get the service expire for each customer that has service expire
    public function getServiceExpire(){
        $result = $this->m->getServiceExpire();
		echo json_encode($result);
    }  
    // get expire date
    public function getExpireDate(){
        $this->session->unset_userdata('cusId');
        $amountOfExp = 0;
        //$expId = array();
        $today = date("Y-m-d"); 
        $c_id = null;
        $start = strtotime($today);
        $result = $this->m->getExpireDate();
        //$expDate = json_encode($result);
        if($result){
            foreach ($result as $value){
                $end1 = strtotime($value->exp_date_host);
                $end2 = strtotime($value->exp_date_main);
                if( (ceil(($end1 - $start) / 86400) <= 7 && $value->exp_date_host !='0000-00-00') || (ceil(($end2 - $start) / 86400) <= 7 && $value->exp_date_main != '0000-00-00')){
                    $amountOfExp += 1;
                    $c_id = $value->c_id;
                    if($c_id != "" || $c_id != null ){
                        if($this->session->userdata('cusId') == "" ) 
                        {
                            $cusId = array();
                        } 
                        else 
                        {
                            $cusId = $this->session->userdata('cusId');
                        }
                        if (!in_array($c_id, $cusId)) 
                        {
                            array_push($cusId, $c_id);
                            $this->session->set_userdata('cusId', $cusId);
                        }
                    }else{
                       // echo "Hello,";
                        //$this->session->unset_userdata('cusId');
                    }
                }
            }
            if($c_id == "" || $c_id == null ) 
            {
                $this->session->unset_userdata('cusId');
            }
        }
        echo $amountOfExp;
        

   }
    // renew service 
    public function renewService(){
        $result = $this->m->renewService();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
}
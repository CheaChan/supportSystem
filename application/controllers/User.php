<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('customer');
        }else{
            $this->load->view('login_form');
        }
    }
    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
            );
        $result = $this->m->login($data);
        if ($result == TRUE) {
            $userData = $this->m->get_user_logged_in($data);
                if($userData != false){
                    $session_data = array(
                        'u_id' => $userData->u_id,
                        'u_name' => $userData->u_name
                    );
                    $this->session->set_userdata('logged_in',$session_data);
                    redirect('user/customerList');
                }
            
        } else {
            $data = array(
            'error_message' => 'Invalid Username or Password'
            );
            $this->load->view('login_form', $data);
        }
    }
    public function customerList(){
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('customer');
        }else{
            $this->load->view('login_form');
        }
    }   
    public function logout(){
        // Removing session data
        $sess_array = array(
            'u_id' => '',
            'u_name'=> ''
            );
        $this->session->unset_userdata('logged_in', $sess_array);
        // $this->session->unset_userdata('u_id');
        // $this->session->unset_userdata('u_name');
        $this->index();
    }
    public function getCustomerList(){
        $result = $this->m->getCustomerList();
		echo json_encode($result);
    }
    public function getSystemType(){
        $result = $this->m->getSystemType();
		echo json_encode($result);
    }
    public function getServiceHost(){
        $result = $this->m->getServiceHost();
		echo json_encode($result);
    }
    public function getServiceMain(){
        $result = $this->m->getServiceMain();
		echo json_encode($result);
    }
    public function calExpDate(){
        $result = $this->m->calExpDate();
		echo json_encode($result);
    }
    public function addCusomter(){
        $result = $this->m->addCusomter();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function editCustomer(){
        $result = $this->m->editCustomer();
		echo json_encode($result);
    }
    public function updateCustomer(){
        $result = $this->m->updateCustomer();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function deleteCustomer(){
        $result = $this->m->deleteCustomer();
		$msg['success'] = false;
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function viewCustomer(){
        $result = $this->m->viewCustomer();
		echo json_encode($result);
    }
    public function setHostDetail(){
        $result = $this->m->setHostDetail(1, 2);
		//echo json_encode($result);
    }
    public function userList(){
        $this->load->view('user');
    }


    // ***************
    // * *  User   * *
    // ***************
    
    public function getUserList(){
        $result = $this->m->getUserList();
		echo json_encode($result);
    }
    // add new user
    public function addUser(){
        $result = $this->m->addUser();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // edit user
    public function editUser(){
        $result = $this->m->editUser();
		echo json_encode($result);
    }
    // update user
    public function updateUser(){
        $result = $this->m->updateUser();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    // delete user 
    public function deleteUser(){
        $result = $this->m->deleteUser();
		$msg['success'] = false;
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    
   
}

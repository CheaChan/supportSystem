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
    // ***************
    // * *  User   * *
    // ***************

    // auto load view
	public function index()
	{
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('dashboard/header');
            $this->load->view('user');
            $this->load->view('dashboard/footer');
        }else{
            $this->load->view('login_form');
        }
    }
    // login proccess
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
                    redirect('customer');
                }
            
        } else {
            $data = array(
            'error_message' => 'Invalid Username or Password'
            );
            $this->load->view('login_form', $data);
        }
    }
    // logout from the system
    public function logout(){
        // Removing session data
        $sess_array = array(
            'u_id' => '',
            'u_name'=> ''
            );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->index();
    }
    // load view user
    public function userList(){
        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('user');
        }else{
            $this->load->view('login_form');
        }
    }
    // get all the user
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
    // get current password
    public function getCurrentPassword(){
        $u_id = $this->session->userdata['logged_in']['u_id'];
        $result = $this->m->getCurrentPassword($u_id);
		echo json_encode($result);
    }
    // change password
    public function changePassword(){
        $u_id = $this->session->userdata['logged_in']['u_id'];
        $result = $this->m->changePassword($u_id);
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }

}

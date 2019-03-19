<?php

Class User_model extends CI_Model {
    // Read data using username and password
    public function login($data) {
        $condition = "u_name =" . "'" . $data['username'] . "' AND " . "u_pass =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    // user login 
    public function get_user_logged_in($data){
        $condition = "u_name =" . "'" . $data['username'] . "' AND " . "u_pass =" . "'" . $data['password'] . "'";
        $query =  "SELECT * FROM user WHERE {$condition} LIMIT 1";
        
        if ($query!= NULL) {
            return $this->db->query($query)->row(); 
        } else {
            return false;
        }
    }
    // ************
    // * Customer
    // ************

    // get customer list
    public function getCustomerList(){
        $this->db->select('c.*, st.sys_type');
        $this->db->from('customer c'); 
        $this->db->join('system_type st', 'c.sys_type_id = st.sys_id', 'left');
        $this->db->order_by('c.c_id','desc');                
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // get the system type
    public function getSystemType(){
        $this->db->select('*');
        $this->db->from('system_type'); 
        $this->db->order_by('sys_type','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // get the service hosting
    public function getServiceHost(){
        $this->db->select('*');
        $this->db->from('service_type'); 
        $this->db->where('serv_key', 1);
        $this->db->order_by('serv_id','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // get the service maintenance
    public function getServiceMain(){
        $this->db->select('*');
        $this->db->from('service_type'); 
        $this->db->where('serv_key', 2);
        $this->db->order_by('serv_id','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // calculate the expire date
    public function calExpDate(){
        $serv_id = $this->input->get('serv_id');
        $this->db->select('serv_duration');
        $this->db->from('service_type'); 
        $this->db->where('serv_id', $serv_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // add new customer
    public function addCusomter(){
        $fields = array(
            'c_name'=>$this->input->post('customerName'),
            'c_phone'=>$this->input->post('customerPhone'),
            'c_org'=>$this->input->post('customerOrg'),
            'public_ip'=>$this->input->post('publicIP'),
            'sys_type_id'=>$this->input->post('systemTypeSelect'),
            'serv_host_id'=>$this->input->post('serviceHostSelect'),
            'start_date_host'=>$this->input->post('hostStartDate'),
            'exp_date_host'=>$this->input->post('hostExpDate'),
            'serv_main_id'=>$this->input->post('serviceMainSelect'),
            'start_date_main'=>$this->input->post('mainStartDate'),
            'exp_date_main'=>$this->input->post('mainExpDate'),
            'num_branch'=>$this->input->post('orgBranch')
            );
        $this->db->insert('customer', $fields);
       
        if($this->db->affected_rows() > 0)
        {
            
            $c_id = $this->db->insert_id();
            $serv_host_id = $fields['serv_host_id'];
            $start_date_host = $fields['start_date_host'];
            $serv_main_id = $fields['serv_main_id'];
            $start_date_main = $fields['start_date_main'];
            if(($serv_host_id !='' || $serv_host_id != null) && ($start_date_host!='' || $start_date_host!=null)){
                $this->setHostDetail($c_id, $serv_host_id);
            }
            if(($serv_main_id !='' || $serv_main_id != null) && ($start_date_main!='' || $start_date_main!=null)){
                $this->setHostDetail($c_id, $serv_main_id);
            }
            return true;
        }else{
            return false;
        }

    }
    // set host detail in service detail
    public function setHostDetail($c_id, $serv_host_id){
        $data_host=$this->db->query("SELECT serv_price, serv_duration FROM service_type WHERE serv_id =".$serv_host_id);
        foreach ($data_host->result() as $row)
        {
            $duration = $row->serv_duration;
            $price = $row->serv_price;
            $priceEeachMonth= ($price/$duration);
            $serv_host_datail = array();
            for($i = 1; $i <= $duration; $i++){
                $serv_host_datail[] = array(
                    'c_id' => $c_id, 
                    'serv_id' => $serv_host_id, 
                    'd_price' => $priceEeachMonth
                );
            }
            $serv_host_datail_temp = array();
            foreach($serv_host_datail as $row){
                array_push($serv_host_datail_temp, $row);
            }
            $this->db->insert_batch('service_detail',$serv_host_datail_temp);
        }
    }
    // set main detail in service detail
    public function setMainDetail($c_id, $serv_main_id){
        $data_main=$this->db->query("SELECT serv_price, serv_duration FROM service_type WHERE serv_id =".$serv_main_id);
        foreach ($data_main->result() as $row)
        {
            $duration = $row->serv_duration;
            $price = $row->serv_price;
            $priceEeachMonth= ($price/$duration);
            $serv_main_datail = array();
            for($i = 1; $i <= $duration; $i++){
                $serv_main_datail[] = array(
                    'c_id' => $c_id, 
                    'serv_id' => $serv_main_id, 
                    'd_price' => $priceEeachMonth
                );
            }
            $serv_main_datail_temp = array();
            foreach($serv_main_datail as $row){
                array_push($serv_main_datail_temp, $row);
            }
            $this->db->insert_batch('service_detail',$serv_main_datail_temp);
        }
    }
    // edit the customer
    public function editCustomer(){
        $id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('customer c'); 
        $this->db->join('system_type st', 'st.sys_id = c.sys_type_id', 'left');
        $this->db->join('service_type sv', 'sv.serv_id = c.serv_host_id ', 'left');
        $this->db->where('c_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // update the customer
    public function updateCustomer(){
        $id = $this->input->post('txtId');
        $fields = array(
            'c_name'=>$this->input->post('customerName'),
            'c_phone'=>$this->input->post('customerPhone'),
            'c_org'=>$this->input->post('customerOrg'),
            'public_ip'=>$this->input->post('publicIP'),
            'sys_type_id'=>$this->input->post('systemTypeSelect'),
            'serv_host_id'=>$this->input->post('serviceHostSelect'),
            'start_date_host'=>$this->input->post('hostStartDate'),
            'exp_date_host'=>$this->input->post('hostExpDate'),
            'serv_main_id'=>$this->input->post('serviceMainSelect'),
            'start_date_main'=>$this->input->post('mainStartDate'),
            'exp_date_main'=>$this->input->post('mainExpDate'),
            'num_branch'=>$this->input->post('orgBranch')
            );
        $this->db->where('c_id', $id);
        $this->db->update('customer', $fields);
        if($this->db->affected_rows() > 0)
        {
            $c_id = $id;
            $serv_host_id = $fields['serv_host_id'];
            $serv_main_id = $fields['serv_main_id'];
            $start_date_host = $fields['start_date_host'];
            $start_date_main = $fields['start_date_main'];

            $this->deleteServDetail($c_id);
            if(($serv_host_id !='' || $serv_host_id != null) && ($start_date_host!='' || $start_date_host!=null || $start_date_host!='0000-00-00')){
                $this->setHostDetail($c_id, $serv_host_id);
            }
            if(($serv_main_id !='' || $serv_main_id != null) && ($start_date_main!='' || $start_date_main!=null || $start_date_main!='0000-00-00')){
                $this->setHostDetail($c_id, $serv_main_id);
            }
            
            return true;
        }else{
            return false;
        }
    }
    // delete detail
    public function deleteServDetail($c_id){
        $this->db->where('c_id', $c_id);
        $this->db->delete('service_detail');
    }
    // delete the customer
    public function deleteCustomer(){
        $id = $this->input->get('id');
        $this->db->where('c_id', $id);
        $this->db->delete('customer');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // view customer detail
    public function viewCustomer(){
        $id = $this->input->get('id');
        $this->db->select('c.c_id, c.c_name, c.c_phone, c.c_org, c.public_ip, st.sys_type, c.num_branch, c.serv_host_id, c.serv_main_id,
         svh.serv_type host_name, svh.serv_duration host_duration, svh.serv_price host_price, c.start_date_host, c.exp_date_host, 
         svm.serv_type main_name, svm.serv_duration main_duration, svm.serv_price main_price, c.start_date_main, c.exp_date_main');
        $this->db->from('customer c'); 
        $this->db->join('system_type st', 'st.sys_id = c.sys_type_id', 'left');
        $this->db->join('service_type svh', 'svh.serv_id = c.serv_host_id ', 'left');
        $this->db->join('service_type svm', 'svm.serv_id = c.serv_main_id ', 'left');
        $this->db->where('c_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // view customer detail
    public function viewCustomerExpire(){
        $ids = $this->session->userdata('cart');
        if($ids != ""){
            $this->db->select('c.c_id, c.c_name, c.c_phone, c.c_org, c.public_ip, st.sys_type,c.num_branch, c.serv_host_id, c.serv_main_id,
            svh.serv_type host_name, svh.serv_duration host_duration, svh.serv_price host_price, c.start_date_host, c.exp_date_host, 
            svm.serv_type main_name, svm.serv_duration main_duration, svm.serv_price main_price, c.start_date_main, c.exp_date_main');
            $this->db->from('customer c'); 
            $this->db->join('system_type st', 'st.sys_id = c.sys_type_id', 'left');
            $this->db->join('service_type svh', 'svh.serv_id = c.serv_host_id ', 'left');
            $this->db->join('service_type svm', 'svm.serv_id = c.serv_main_id ', 'left');
            $this->db->where_in('c.c_id', $ids);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                return $query->result();
            }else{
                return false;
            }
        }else{
            return "";
        }
        
    }
    // get expire date
    public function getExpireDate(){
        $this->db->select('c_id, exp_date_host, exp_date_main');
        $this->db->from('customer c');        
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    

    // ***************
    // * *  User   * *
    // ***************

    // get all the users
    public function getUserList(){
        $this->db->select('u_id, u_name, u_status');
        $this->db->from('user u'); 
        $this->db->order_by('u.u_id','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // add new user
    public function addUser(){
        $fields = array(
            'u_name'=>$this->input->post('userName'),
            'u_pass'=>$this->input->post('password'),
            'u_status'=> 1
            );
        $this->db->insert('user', $fields);
       
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // edit user
    public function editUser(){
        $id = $this->input->get('id');
        $this->db->select('u_id, u_name');
        $this->db->from('user c'); 
        $this->db->where('u_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // update user
    public function updateUser(){
        $id = $this->input->post('txtEditId');
        $fields = array(
            'u_name'=>$this->input->post('userEditName')
            );
        $this->db->where('u_id', $id);
        $this->db->update('user', $fields);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // delete user
    public function deleteUser(){
        $id = $this->input->get('id');
        $this->db->where('u_id', $id);
        $this->db->delete('user');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    public function getCurrentPassword($u_id){
        $this->db->select('u_id, u_pass');
        $this->db->from('user c'); 
        $this->db->where('u_id', $u_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // update user
    public function changePassword($u_id){
        //$id = $this->input->post('txtId');
        $fields = array(
            'u_pass'=>$this->input->post('newPassword')
            );
        $this->db->where('u_id', $u_id);
        $this->db->update('user', $fields);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // *************
    // ** System 
    // *************

    // get all the system
    public function getSystemList(){
        $this->db->select('*');
        $this->db->from('system_type'); 
        $this->db->order_by('sys_type','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // add new system
    public function addSystem(){
        $fields = array(
            'sys_type'=>$this->input->post('systemName')
            );
        $this->db->insert('system_type', $fields);
       
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }

    }
    // edit system
    public function editSystem(){
        $id = $this->input->get('id');
        $this->db->select('sys_id, sys_type');
        $this->db->from('system_type'); 
        $this->db->where('sys_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // update system type
    public function updateSystem(){
        $id = $this->input->post('txtId');
        $fields = array(
            'sys_type'=>$this->input->post('systemName')
            );
        $this->db->where('sys_id', $id);
        $this->db->update('system_type', $fields);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // delete system
    public function deleteSystem(){
        $id = $this->input->get('id');
        $this->db->where('sys_id', $id);
        $this->db->delete('system_type');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // *************
    // ** Service 
    // *************

    // get all the service
    public function getserviceList(){
        $this->db->select('*');
        $this->db->from('service_type'); 
        $this->db->order_by('serv_key','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // add new service
    public function addService(){
        $fields = array(
            'serv_type'=>$this->input->post('serviceName'),
            'serv_price'=>$this->input->post('servicPrice'),
            'serv_duration'=>$this->input->post('serviceDuration'),
            'serv_key'=>$this->input->post('serviceType')
            );
        $this->db->insert('service_type', $fields);
       
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // edit service
    public function editService(){
        $id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('service_type'); 
        $this->db->where('serv_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return false;
        }
    }
    // update service
    public function updateService(){
        $id = $this->input->post('txtId');
        $fields = array(
            'serv_type'=>$this->input->post('serviceName'),
            'serv_price'=>$this->input->post('servicPrice'),
            'serv_duration'=>$this->input->post('serviceDuration'),
            'serv_key'=>$this->input->post('serviceType')
            );
        $this->db->where('serv_id', $id);
        $this->db->update('service_type', $fields);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
    // delete service
    public function deleteService(){
        $id = $this->input->get('id');
        $this->db->where('serv_id', $id);
        $this->db->delete('service_type');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
    }
}
?>
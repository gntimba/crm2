<?php
class Users extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}

	public function login($email,$password)
	{
		
		$user=$this->user_model->verify_user($email,$password);
		$data['database']=$user;
	
		
		$this->load->view('test',$data);
	}
	public function logout(){
		session_destroy();
		redirect(base_url('users'));
	}
	public function mainpage(){
	$this->load->view('layout');
	}
}
?>
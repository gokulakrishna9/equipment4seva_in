<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function index()
	{
		if($this->session->has_userdata('logged_in'))
			redirect('/equipment/');
		$this->load->model('user_detail');
		$this->data['captcha_image'] = $this->user_detail->set_captcha();
		$this->load->view('welcome_message', $this->data);
	}

	public function authenticate_user(){
		$this->load->model('user_detail');
		$authentic = $this->user_detail->authenticate_user();
		if($authentic){
			$this->session->set_userdata('logged_in', true);
			redirect('/equipment/');
		} else {
			$this->data['captcha_image'] = $this->user_detail->set_captcha();
			$this->data['error_message'] = 'Login Failed, try again.';
			$this->load->view('welcome_message', $this->data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
	}
}

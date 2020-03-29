<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function _remap($method){
    $this->data = array();
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->index();
      return;
    }
	}
	
	public function index(){
		$this->data['header'] = 'equipment';
		$this->data['form_action'] = 'welcome/index';
		$this->load->model('equipment_model');
		$this->load->model('equipment_type_model');
		$this->load->model('place_model');
		$this->load->model('vendor_model');
		$this->data['select_data']['place_id'] = $this->place_model->get_place();
		$this->data['tabel_data'] = $this->equipment_model->equipment_summary();
		$this->data['select_data']['equipment_type_id'] = $this->equipment_type_model->get_equipment_type();
		$this->data['select_data']['donor_id'] = $this->vendor_model->get_vendor();
		$this->data['form_fields'] = $this->equipment_model->get_summary_filter();
		$this->data['key_field'] = '';
		/*
		$this->data['table_operator'][] = array(			
			'label' => 'View Detailed',
      'controller_method' => 'equipment/get_equipment',
			'equipment_id' => 'equipment_id'
		);
		*/
		$this->load->view('container/reports_container', $this->data);		
	}

	public function login()
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

	public function equipment_summary(){

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/welcome/');
	}
}

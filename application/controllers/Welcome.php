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
		$this->load_defaults();		
		$this->data['table_operator']['0'] = array(
      'label' => 'View',
      'controller_method' => 'eq_detailed'
    );
		$this->load->view('container/reports_container', $this->data);		
	}

	private function load_defaults(){
		$this->data['header'] = 'equipment';
		$this->data['form_action'] = 'welcome/equipment_summary';
		$this->load->model('equipment_model');
		$this->load->model('equipment_type_model');
		$this->load->model('place_model');
		$this->load->model('vendor_model');
		$this->data['select_data']['place_id'] = $this->place_model->get_place();
		$this->data['select_data']['group'] = $this->equipment_model->get_grouping();
		$this->data['select_data']['sub_group'] = $this->equipment_model->get_subgrouping();
		$this->data['tabel_data'] = $this->equipment_model->equipment_summary();
		$this->data['select_data']['equipment_type_id'] = $this->equipment_type_model->get_equipment_type();
		$this->data['select_data']['donor_id'] = $this->vendor_model->get_vendor();
		$this->data['where_fields'] = $this->equipment_model->get_where_filter();
		$this->data['group_fields'] = $this->equipment_model->get_group_filter();
		$this->data['key_field'] = '';
		$this->data['update_data'] = $this->equipment_model->welcome_default_filter_values();
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
		$this->load_defaults();
		$this->data['table_operator']['0'] = array(
      'label' => 'View',
      'controller_method' => 'eq_detailed'
    );
		$this->data['update_data'] = $this->input->post(NULL, TRUE);
		$this->load->view('container/reports_container', $this->data);		
	}

	public function eq_detailed(){
		$this->load_defaults();
		$this->data['total_rows'] = $this->equipment_model->equipment_detailed_count();          // Pagination
		$this->data['tabel_data'] = $this->equipment_model->eq_detail_public();
		$this->data['detailed'] = true;
		$this->set_pagination_data();
		$this->load->view('container/reports_container', $this->data);
	}

	private function set_pagination_data(){
		$this->data['pagination_action'] = 'welcome/eq_detailed';
    if($this->input->get('page_number')){
      $this->session->set_userdata('page_number', $this->input->get('page_number'));
      $this->data['page_number'] = $this->input->get('page_number');
    }
    else{
      $this->session->set_userdata('page_number', 1);
      $this->data['page_number'] = 1;
    }
    if($this->input->post('per_page')){
      $this->session->set_userdata('per_page', $this->input->post('per_page'));
      $this->data['per_page'] = $this->input->post('per_page');
    }
    else{
      $this->session->set_userdata('per_page', 50);
      $this->data['per_page'] = 50;
    }
  }

	public function logout(){
		$this->session->sess_destroy();
		redirect('/welcome/');
	}
}

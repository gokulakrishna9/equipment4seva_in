<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {
  public function _remap($method){
    if(!$this->authenticate_user()){
      $this->default_handler();
      return;
    }
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'equipment';
    $this->data['form_action'] = 'equipment/add_update_equipment';
    // Pagination
    $this->data['pagination_action'] = 'equipment/index';

    if(method_exists($this, $method)){
      $this->load_model();
      $this->set_session_filters();
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $this->data);
    // Common UI
  }
  
  private function set_session_filters(){
    
  }

  private function set_pagination_data(){
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

  private function authenticate_user(){
    if($this->session->has_userdata('logged_in')){
      return true;
    }      
    else{
      return false;
    }
  }

  private function authorize_user(){

  }

  private function load_model() {
    $this->load->model('equipment_model');
    $this->load->model('equipment_type_model');
    $this->load->model('equipment_functional_status_model');
    $this->load->model('equipment_procurement_status_model');
    $this->load->model('equipment_procurement_type_model');
    $this->load->model('vendor_model');
    $this->load->model('journal_type_model');
  }

  private function load_defaults(){ 
    $this->set_pagination_data();
    //<<-- View Data -->>
    $this->session->unset_userdata('equipment_id');
    $this->data['total_rows'] = $this->equipment_model->count_all();          // Pagination
    $this->data['tabel_data'] = $this->equipment_model->get_equipment();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_model->get_equipment_form_fields();
    $this->data['key_field'] = 'equipment_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'equipment/get_equipment',
      'equipment_id' => 'equipment_id'
    );
    $this->data['table_operator'][] = array(
      'label' => 'Log Location',
      'controller_method' => 'equipment_location_log/index',
      'equipment_id' => 'equipment_id'
    );
    // <<-- select_data -->>
    $this->data['select_data'] = array();
    // <<-- Masters -->>
    $this->data['select_data']['equipment_type_id'] = $this->equipment_type_model->get_equipment_type();
    $this->data['select_data']['functional_status_id'] = $this->equipment_functional_status_model->get_functional_status();
    $this->data['select_data']['procurement_status_id'] = $this->equipment_procurement_status_model->get_equipment_procurement_status();
    $this->data['select_data']['equipment_procurement_type_id'] = $this->equipment_procurement_type_model->get_equipment_procurement_type();
    $this->data['select_data']['vendor_id'] = $this->vendor_model->get_vendor();
    $this->data['select_data']['donor_id'] = $this->data['select_data']['vendor_id'];
    $this->data['select_data']['manufacturer_id'] = $this->data['select_data']['vendor_id'];
    $this->data['select_data']['procured_by_id'] = $this->data['select_data']['vendor_id'];
    $this->data['select_data']['supplier_id'] = $this->data['select_data']['vendor_id'];
    $this->data['select_data']['journal_type_id'] = $this->journal_type_model->get_journal_type();
    // <<-- Global, page info -->>
    $this->data['header'] = 'equipment/equipment';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
    $this->load_defaults();
  }

  function add_update_equipment(){
    $this->equipment_model->add_update_equipment();
    $this->load_defaults();
  }

  function get_equipment(){
    $this->data['update_data'] = $this->equipment_model->get_equipment_record();
    $this->load_defaults();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

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
    $this->load->model('equipment_model');
    $this->load->model('equipment_type_model');
    $this->load->model('equipment_functional_status_model');
    $this->load->model('equipment_procurement_status_model');
    $this->load->model('equipment_procurement_type_model');
    $this->load->model('vendor_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $this->data);
    // Common UI
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

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_model->get_equipment();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_model->get_equipment_form_fields();
    $this->data['key_field'] = 'equipment_id';
    $this->data['table_operator']['Update'] ='equipment/get_equipment?equipment_id=';
    $this->data['table_operator']['Log Location'] ='equipment_location_log/index?equipment_id=';
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
    // <<-- Global, page info -->>
    $this->data['header'] = 'equipment/equipment';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment(){
    $this->equipment_model->add_update_equipment();
  }

  function get_equipment(){
    $this->data['update_data'] = $this->equipment_model->get_equipment_record();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

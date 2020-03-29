<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_service_record extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'equipment/equipment_service_record';
    $this->data['form_action'] = 'equipment_service_record/add_update_equipment_service_record';
    $this->load->model('equipment_model');
    $this->load->model('equipment_service_record_model');
    $this->load->model('user_detail');
    $this->load->model('caller_institution_model');
    $this->load->model('vendor_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'equipment';
    $this->load->view('container/default_container', $this->data);
  }

  private function authenticate_user(){

  }

  private function authorize_user(){

  }

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_service_record_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_service_record_model->get_equipment_service_record();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_service_record_model->get_form_fields();
    $this->data['select_data']['equipment_id'] = $this->equipment_model->get_equipment();
    $this->data['key_field'] = 'request_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'equipment_service_record/get_equipment_service_record',
      'request_id' => 'request_id'
    );
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_service_record(){
    $this->equipment_service_record_model->add_update_equipment_service_record();
  }

  function get_equipment_service_record(){
    $this->data['update_data'] = $this->equipment_service_record_model->get_equipment_service_record_record();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
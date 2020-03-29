<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_service_record_log extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'logs/equipment_service_record_log';
    $this->data['form_action'] = 'equipment_service_record_log/add_update_equipment_service_record_log';
    $this->load->model('equipment_service_record_log_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'equipment_service_record_log';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){    
    // <<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_service_record_log_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_service_record_log_model->get_equipment_service_record_log();

    $this->data['select_data']['request_id'] = array();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_service_record_log_model->get_form_fields();
    $this->data['key_field'] = 'service_record_log_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'equipment_service_record_log/get_equipment_service_record_log',
      'service_record_log_id' => 'service_record_log_id'
    );
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_service_record_log(){
    $this->equipment_service_record_log_model->add_update_equipment_service_record_log();
  }

  function get_equipment_service_record_log(){
    $this->data['update_data'] = $this->equipment_service_record_log_model->get_equipment_service_record_log_record();
  }

  function delete_equipment(){
    // Delete record
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

  function default_handler(){
    echo 'Default Method Called';
  }
}
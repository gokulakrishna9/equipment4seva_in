<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_issue_type extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'service_issue';
    $this->data['form_action'] = 'service_issue_type/add_update_issue_type';
    $this->load->model('service_issue_type_model');
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

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->service_issue_type_model->count_all(); 
    $this->data['equipment'] = $this->service_issue_type_model->get_service_issue_type();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->service_issue_type_model->get_form_fields();
    $this->data['key_field'] = 'equipment_service_issue_type_id';
    $this->data['table_operator'] ='service_issue_type/get_service_issue_type?equipment_service_issue_type_id=';
    // <<-- select_data -->>
    $this->data['select_data'] = array();
    // <<-- Masters -->>
    // <<-- Global, page info -->>
    $this->data['header'] = 'equipment';
    $this->data['leftNav'] = 'service_issue';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_issue_type(){
    $this->service_issue_type_model->add_update_service_issue_type();
  }

  function get_service_issue_type(){
    $this->data['update_data'] = $this->service_issue_type_model->get_service_issue_type_record();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }

  private function authenticate_user(){

  }

  private function authorize_user(){

  }
}

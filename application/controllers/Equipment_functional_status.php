<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_functional_status extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters/equipment_functional_status';
    $this->data['form_action'] = 'equipment_functional_status/add_update_equipment_functional_status';
    $this->load->model('equipment_functional_status_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_functional_status_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_functional_status_model->get_functional_status();
    // <<-- Scaffold Data point  -->>
    $this->data['select_data'] = array();
    $this->data['form_fields'] = $this->equipment_functional_status_model->get_form_fields();
    $this->data['key_field'] = 'functional_status_id';
    $this->data['table_operator'] ='equipment_functional_status/get_functional_status?functional_status_id=';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_functional_status(){
    $this->equipment_functional_status_model->add_update_equipment_functional_status();
  }

  function get_functional_status(){
    $this->data['update_data'] = $this->equipment_functional_status_model->get_equipment_functional_status();
  }

  function delete_equipment(){
    // Delete record
  }

  private function authenticate_user(){

  }

  private function authorize_user(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
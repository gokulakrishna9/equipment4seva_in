<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_accessory extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'equipment/equipment_accessory';
    $this->data['form_action'] = 'equipment_accessory/add_update_equipment_accessory';
    $this->load->model('equipment_model');
    $this->load->model('equipment_accessory_model');
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
    $this->data['total_rows'] = $this->equipment_accessory_model->count_all(); 
    $this->data['equipment'] = $this->equipment_accessory_model->get_equipment_accessory();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_accessory_model->get_form_fields();
    $this->data['select_data']['equipment_id'] = $this->equipment_model->get_equipment();
    $this->data['key_field'] = 'equipment_accessory_id';
    $this->data['table_operator'] ='equipment_accessory/get_equipment_accessory?equipment_accessory_id=';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_accessory(){
    $this->equipment_accessory_model->add_update_equipment_accessory();
  }

  function get_equipment_accessory(){
    $this->data['update_data'] = $this->equipment_accessory_model->get_equipment_accessory_record();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_procurement_status_type extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters/equipment_procurement_status_type';
    $this->data['form_action'] = 'equipment_procurement_status_type/add_update_equipment_procurement_status_type';
    $this->load->model('equipment_procurement_status_type_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'equipment_type';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_type_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_type_model->get_equipment_type();
    // <<-- Scaffold Data point  -->>
    $this->data['select_data'] = array();
    $this->data['form_fields'] = $this->equipment_type_model->get_form_fields();
    $this->data['key_field'] = 'equipment_type_id';
    $this->data['table_operator'] ='equipment_type/get_equipment_type?equipment_type_id=';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_type(){
    $this->equipment_type_model->add_update_equipment_type();
  }

  function get_equipment_type(){
    $this->data['update_data'] = $this->equipment_type_model->get_equipment_type_record();
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
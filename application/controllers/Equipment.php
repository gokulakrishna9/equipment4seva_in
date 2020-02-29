<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->load_defaults();
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $this->data);
    // Common UI
  }

  private function authenticate_user(){

  }

  private function authorize_user(){

  }

  private function load_defaults(){
    $this->load->model('equipment_model');
    $this->load->model('equipment_type');
    $this->load->model('equipment_status_type');
    $this->load->model('donor');
    $this->load->model('vendor');
    
    $this->data['equipment'] = $this->equipment_model->get_equipment();
    $this->data['equipment_types'] = $this->equipment_type->get_equipment_type();
    $this->data['equipment_status_types'] = $this->equipment_status_type->get_equipment_status_type();
    $this->data['donors'] = $this->donor->get_donors();
    $this->data['vendor'] = $this->vendor->get_vendor();
    $this->data['header'] = 'equipment';
    $this->data['leftNav'] = 'equipment';
    $this->data['form_action'] = 'equipment/add_update_equipment';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment(){
    $this->equipment_model->add_update_equipment();
  }

  function get_equipment(){
    $this->data['update_data'] = $this->equipment_model->get_equipment(true);
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

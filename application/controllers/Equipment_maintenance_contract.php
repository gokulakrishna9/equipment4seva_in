<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_maintenance_contract extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'equipment/equipment_maintenance_contract';
    $this->data['form_action'] = 'equipment_maintenance_contract/add_update_equipment_maintenance_contract';
    $this->load->model('equipment_model');
    $this->load->model('equipment_maintenance_contract_model');
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
    $this->data['total_rows'] = $this->equipment_maintenance_contract_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_maintenance_contract_model->get_equipment_maintenance_contract();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_maintenance_contract_model->get_form_fields();
    $this->data['select_data']['equipment_id'] = $this->equipment_model->get_equipment();
    $this->data['select_data']['vendor_id'] = $this->vendor_model->get_vendor();
    $this->data['key_field'] = 'amc_cmc_id';
    $this->data['table_operator'] ='equipment_maintenance_contract/get_equipment_maintenance_contract?amc_cmc_id=';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_equipment_maintenance_contract(){
    $this->equipment_maintenance_contract_model->add_update_equipment_maintenance_contract();
  }

  function get_equipment_maintenance_contract(){
    $this->data['update_data'] = $this->equipment_maintenance_contract_model->get_equipment_maintenance_contract_record();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

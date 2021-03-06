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
    $this->set_pagination_data();  
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_maintenance_contract_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_maintenance_contract_model->get_equipment_maintenance_contract();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_maintenance_contract_model->get_form_fields();
    $this->data['select_data']['equipment_id'] = $this->equipment_model->get_equipment();
    $this->data['select_data']['vendor_id'] = $this->vendor_model->get_vendor();
    $this->data['key_field'] = 'amc_cmc_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'equipment_maintenance_contract/get_equipment_maintenance_contract',
      'amc_cmc_id' => 'amc_cmc_id'
    );
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
    $this->load_defaults();
  }

  private function set_session_filters(){
    
  }

  private function set_pagination_data(){
    $this->data['pagination_action'] = 'equipment_maintenance_contract/index';
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

  function add_update_equipment_maintenance_contract(){
    $this->equipment_maintenance_contract_model->add_update_equipment_maintenance_contract();
    $this->load_defaults();
  }

  function get_equipment_maintenance_contract(){
    $this->data['update_data'] = $this->equipment_maintenance_contract_model->get_equipment_maintenance_contract_record();
    $this->load_defaults();
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

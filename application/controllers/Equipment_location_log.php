<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_location_log extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'equipment/equipment';
    $this->data['parent_route'] = 'equipment';
    $this->data['form_action'] = 'equipment_location_log/add_update_equipment_location_log';
    $this->load->model('equipment_location_log_model');
    $this->load->model('vendor_model');
    $this->load->model('equipment_model');
    $this->load->model('place_model');

    // Pagination
    $this->data['pagination_action'] = 'equipment/index';

    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'equipment';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){  
    $this->set_pagination_data();
    // <<-- View Data -->>
    $this->data['total_rows'] = $this->equipment_location_log_model->count_all(); 
    $this->data['tabel_data'] = $this->equipment_location_log_model->get_equipment_location_log();
    $this->data['parent_record'] = $this->equipment_model->get_equipment()[0];
    $this->data['select_data']['vendor_id'] = $this->vendor_model->get_vendor();
    $this->data['select_data']['place_id'] = $this->place_model->get_place();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->equipment_location_log_model->get_form_fields();
    $this->data['key_field'] = 'equipment_location_log_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'equipment_location_log/get_equipment_location_log',
      'equipment_location_log_id' => 'equipment_location_log_id'
    );
  }

  // Pagination
  private function set_session_filters(){
    
  }

  private function set_pagination_data(){
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
  
  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
    if($this->input->post_get('equipment_id'))
      $this->session->set_userdata('equipment_id', $this->input->post_get('equipment_id'));
    $this->data['update_data'] = (object)['equipment_id'=>$this->session->equipment_id];
    $this->load_defaults();
  }

  function add_update_equipment_location_log(){
    $this->equipment_location_log_model->add_update_equipment_location_log();
    $this->load_defaults();
  }

  function get_equipment_location_log(){
    $this->data['update_data'] = $this->equipment_location_log_model->get_equipment_location_log_record();
    $this->load_defaults();
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
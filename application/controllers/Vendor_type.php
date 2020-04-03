<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_type extends CI_Controller {
  public function _remap($method){
    if(!$this->authenticate_user()){
      $this->default_handler();
      return;
    }
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters';
    $this->data['form_action'] = 'vendor_type/add_update_vendor_type';
    $this->load->model('vendor_type_model');
  
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->load->view('container/default_container', $this->data);
    // Common UI
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
    $this->data['total_rows'] = $this->vendor_type_model->count_all(); 
    $this->data['tabel_data'] = $this->vendor_type_model->get_vendor_type();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->vendor_type_model->get_form_fields();
    $this->data['key_field'] = 'vendor_type_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'vendor_type/get_vendor_type',
      'vendor_type_id' => 'vendor_type_id'
    );
    // <<-- select_data -->>
    $this->data['select_data'] = array();
    // <<-- Global, page info -->>
    $this->data['header'] = 'masters/vendor_type';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
    $this->load_defaults();
  }

  private function set_session_filters(){
    
  }

  private function set_pagination_data(){
    $this->data['pagination_action'] = 'vendor_type/index';
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

  function add_update_vendor_type(){
    $this->vendor_type_model->add_update_vendor_type();
    $this->load_defaults();
  }

  function get_vendor_type(){
    $this->data['update_data'] = $this->vendor_type_model->get_vendor_type_record();
    $this->load_defaults();
  }

  function delete_vendor(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
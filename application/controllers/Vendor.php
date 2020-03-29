<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
  public function _remap($method){
    if(!$this->authenticate_user()){
      $this->default_handler();
      return;
    }
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters';
    $this->data['form_action'] = 'vendor/add_update_vendor';
    $this->load->model('vendor_model');
    $this->load->model('vendor_contact_model');
    $this->load->model('vendor_type_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
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
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->vendor_model->count_all(); 
    $this->data['tabel_data'] = $this->vendor_model->get_vendor();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->vendor_model->get_vendor_form_fields();
    $this->data['key_field'] = 'vendor_id';
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'vendor/get_vendor',
      'vendor_id' => 'vendor_id'
    );
    // <<-- select_data -->>
    $this->data['select_data'] = array();
    // <<-- Masters -->>
    $this->data['select_data']['contact_person_id'] = $this->vendor_contact_model->get_vendor_contact();
    $this->data['select_data']['vendor_type_id'] = $this->vendor_type_model->get_vendor_type();
    // <<-- Global, page info -->>
    $this->data['header'] = 'masters/vendor';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_vendor(){
    $this->vendor_model->add_update_vendor();
  }

  function get_vendor(){
    $this->data['update_data'] = $this->vendor_model->get_vendor_record();
  }

  function delete_vendor(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

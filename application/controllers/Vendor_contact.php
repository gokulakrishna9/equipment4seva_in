<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_contact extends CI_Controller {
  public function _remap($method){
    if(!$this->authenticate_user()){
      $this->default_handler();
      return;
    }
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters';
    $this->data['form_action'] = 'vendor_contact/add_update_vendor_contact';
    $this->load->model('vendor_contact_model');
  
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
    $this->data['total_rows'] = $this->vendor_contact_model->count_all(); 
    $this->data['tabel_data'] = $this->vendor_contact_model->get_vendor_contact();
    // <<-- Scaffold Data point  -->>
    $this->data['form_fields'] = $this->vendor_contact_model->get_form_fields();
    $this->data['key_field'] = 'contact_person_id';
    $this->data['table_operator']['Update'] ='vendor_contact/get_vendor_contact?contact_person_id=';
    // <<-- select_data -->>
    $this->data['select_data'] = array();
    // <<-- Global, page info -->>
    $this->data['header'] = 'masters/vendor_contact';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_vendor_contact(){
    $this->vendor_contact_model->add_update_vendor_contact();
  }

  function get_vendor_contact(){
    $this->data['update_data'] = $this->vendor_contact_model->get_vendor_contact_record();
  }

  function delete_vendor(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
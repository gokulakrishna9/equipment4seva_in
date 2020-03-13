<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caller_institution extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters/caller_institution';
    $this->data['form_action'] = 'caller_institution/add_update_caller_institution';
    $this->load->model('caller_institution_model');
    if(method_exists($this, $method)){
      $this->$method();
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'caller_institution_model';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){    
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->caller_institution_model->count_all(); 
    $this->data['tabel_data'] = $this->caller_institution_model->get_caller_institution();
    // <<-- Scaffold Data point  -->>
    $this->data['select_data'] = array();
    $this->data['form_fields'] = $this->caller_institution_model->get_form_fields();
    $this->data['key_field'] = 'caller_institution_id';
    $this->data['table_operator'] ='caller_institution/get_caller_institution?caller_institution_id=';
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_update_caller_institution(){
    $this->caller_institution_model->add_update_caller_institution();
  }

  function get_caller_institution(){
    $this->data['update_data'] = $this->caller_institution_model->get_caller_institution_record();
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

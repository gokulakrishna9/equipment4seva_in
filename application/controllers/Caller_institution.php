<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caller_institution extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters/caller_institution';
    $this->data['form_action'] = 'caller_institution/add_update_caller_institution';
    $this->load->model('caller_institution_model');
    
    // Pagination
    $this->data['pagination_action'] = 'equipment/index';
    $this->session->set_userdata('per_page', $this->input->post('page_number'));
    $this->data['page_number'] = $this->input->post('page_number');
    $this->session->set_userdata('per_page', 50);
    $this->data['per_page'] = 50;

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
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'caller_institution/get_caller_institution',
      'caller_institution_id' => 'caller_institution_id'
    );
  }

  // Pagination
  private function set_session_filters(){
    $this->set_pagination_data();
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
    $this->set_session_filters();
    $this->load_defaults();
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

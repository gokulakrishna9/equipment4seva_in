<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    $this->data['header'] = 'masters/place';
    $this->data['form_action'] = 'place/add_update_place';
    $this->load->model('place_model');
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'place_model';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){  
    $this->set_pagination_data();  
    //<<-- View Data -->>
    $this->data['total_rows'] = $this->place_model->count_all(); 
    $this->data['tabel_data'] = $this->place_model->get_place();
    // <<-- Scaffold Data point  -->>
    $this->data['select_data'] = array();
    $this->data['form_fields'] = $this->place_model->get_form_fields();
    $this->data['key_field'] = 'place_id';
    
    $this->data['table_operator'][] = array(
      'label' => 'Update',
      'controller_method' => 'place/get_place',
      'place_id' => 'place_id'
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
    $this->data['pagination_action'] = 'place/index';
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

  function add_update_place(){
    $this->place_model->add_update_place();
    $this->load_defaults();
  }

  function get_place(){
    $this->data['update_data'] = $this->place_model->get_place_record();
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

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
      $this->load_defaults();
    } else {
      $this->default_handler();
      return;
    }
    $this->data['leftNav'] = 'place_model';
    $this->load->view('container/default_container', $this->data);
  }

  private function load_defaults(){    
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
  }

  function add_update_place(){
    $this->place_model->add_update_place();
  }

  function get_place(){
    $this->data['update_data'] = $this->place_model->get_place_record();
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $data = array();
    $data = array();
    $data['header'] = 'Equipment';
    $data['leftNav'] = 'current_left_nav';
    $data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $data);
    // Common UI
  }

  function add_equipment(){
    // return UI component => data
  }

  function update_equipment(){
    // Set hidden record ID
    // Return data with route
  }

  function view_equipment(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

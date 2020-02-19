<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
    $data = array();
    $data['components'] = array();
    $data['components']['common/header'] = array();
    $data['components']['common/left_nav'] = array(
      'left_nav' => [
        'Equipment' => 'url',
        'Equipment Accessory' => 'url',
        'Maintenance Contract' => 'url',
        'Service Record' => 'url'
      ]
    );
    $data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $data);
    // Common UI
  }

  function add_equipment(){
    // return UI component => data
  }

  function update_equipment(){

  }

  function view_equipment(){

  }

  function delete_equipment(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

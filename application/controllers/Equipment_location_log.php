<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_location_log extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_location_log(){
    echo 'Add Equipment Location Log';
  }

  function update_equipment_location_log(){

  }

  function view_equipment_location_log(){

  }

  function delete_equipment_location_log(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

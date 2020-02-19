<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_service_record extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_service_record(){
    echo 'Add Equipment Service Record';
  }

  function update_equipment_service_record(){

  }

  function view_equipment_service_record(){

  }

  function delete_equipment_service_record(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
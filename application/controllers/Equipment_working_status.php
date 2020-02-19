<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_working_status extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_working_status(){
    echo 'Add Equipment working_status';
  }

  function update_equipment_working_status(){

  }

  function view_equipment_working_status(){

  }

  function delete_equipment_working_status(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
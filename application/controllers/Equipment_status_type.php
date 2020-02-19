<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_status_type extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_status_type(){
    echo 'Add Equipment Status Type';
  }

  function update_equipment_status_type(){

  }

  function view_equipment_status_type(){

  }

  function delete_equipment_status_type(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_type extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_type(){
    echo 'Add Equipment Type';
  }

  function update_equipment_type(){

  }

  function view_equipment_type(){

  }

  function delete_equipment_type(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}
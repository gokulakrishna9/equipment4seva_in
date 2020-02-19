<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_accessory extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_accessory(){
    echo 'Add Equipment Accessory';
  }

  function update_equipment_accessory(){

  }

  function view_equipment_accessory(){

  }

  function delete_equipment_accessory(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_maintenance_contract extends CI_Controller {
  public function _remap($method){
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      $this->default_handler();
    }
  }

  function add_equipment_maintenance_contract(){
    echo 'Add Equipment Maintenance Contract';
  }

  function update_equipment_maintenance_contract(){

  }

  function view_equipment_maintenance_contract(){

  }

  function delete_equipment_maintenance_contract(){

  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {
  public function _remap($method){
    // Authentication, Authorization
    $this->data = array();
    if(method_exists($this, $method)){
      $this->data['form_action'] = 'add_equipment';
      $this->$method();
    } else {
      $this->default_handler();
      return;
    }
    $this->load->model('equipment_type');
    $this->load->model('donor');
    $this->load->model('procured_by');
    $this->load->model('supplier');
    $this->data['equipment_types'] = $this->equipment_type->get_equipment_type();
    $this->data['donors'] = $this->donor->get_donors();
    $this->data['procured_by'] = $this->procured_by->get_procured_by();
    $this->data['supplier'] = $this->supplier->get_supplier();
    $this->data['header'] = 'equipment';
    $this->data['leftNav'] = 'equipment';
    $this->data['components']['forms/equipment'] = array();  // forms data
    $this->load->view('container/default_container', $this->data);
    // Common UI
  }

  function index(){
    // Modal with View, Update, Delete buttons
    // Return data with route
  }

  function add_equipment(){
    // return UI component => data
    
  }

  function get_equipment(){
    $this->data['form_action'] = 'add_equipment';
  }

  function update_equipment(){
    // Set hidden record ID
    // Return data with route
  }

  function delete_equipment(){
    // Delete record
  }

  function default_handler(){
    echo 'Default Method Called';
  }
}

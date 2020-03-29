<?php
class Equipment_maintenance_contract_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_maintenance_contract_form_fields = array(
    'amc_cmc_id'	=> array('', 'input', 'hidden'),
    'type'	=> array('Type', 'select', 'equipment_id', 'eq_name'),
    'equipment_id'	=> array('Equipment', 'select', 'equipment_id', 'eq_name'),
    'vendor_id' => array('Vendor', 'select', 'vendor_id', 'vendor_name'),
    'from_date'	=> array('Call Date', 'input', 'date'),
    'to_date'	=> array('To Date', 'input', 'date'),
    'rate'	=> array('Rate', 'input', 'text'),
    'cost'	=> array('Cost', 'input', 'text'),// <<-- Pending discussion needed
  );

  function get_form_fields(){
    return $this->equipment_maintenance_contract_form_fields;
  }

  function get_equipment_maintenance_contract(){
    $this->db->select("amc_cmc_id, type, eq_name, DATE_FORMAT(from_date, '%d %b %Y') as from_date, DATE_FORMAT(to_date, '%d %b %Y') as to_date, rate, equipment_maintenance_contract.cost, vendor_name")
      ->from('equipment_maintenance_contract')
      ->join('equipment', 'equipment.equipment_id = equipment_maintenance_contract.equipment_id', 'left')
      ->join('vendor', 'vendor.vendor_id = equipment_maintenance_contract.vendor_id', 'left')
      ->order_by('rate', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_maintenance_contract');
  }

  function get_equipment_maintenance_contract_record(){
    if($this->input->get('amc_cmc_id'))
      $this->db->where('equipment_maintenance_contract.amc_cmc_id', $this->input->get('amc_cmc_id'));
    $this->db->select('*')->from('equipment_maintenance_contract')
         ->order_by('rate', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_maintenance_contract(){
    $post_data = array();
    foreach($this->equipment_maintenance_contract_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_maintenance_contract', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
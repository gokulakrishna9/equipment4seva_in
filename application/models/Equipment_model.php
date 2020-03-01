<?php
class Equipment_model extends CI_Model {
  // label, html_element, type, ... 
  private $equipment_form_fields = array(
    'equipment_id'	=> array('', 'input', 'hidden'),
    'equipment_type_id'	=> array('Equipment Type', 'select', 'equipment_type_id', 'equipment_type'),
    'equipment_procurement_type_id' => array('Procurement type', 'input', 'number'),
    'manufacturer_id'	=> array('Manufacturer', 'select', 'vendor_id', 'vendor_name'),
    'eq_name' => array('Equipment Name', 'input', 'text'),
    'model' => array('Model', 'input', 'text'),
    'serial_number' => array('Serial Number', 'input', 'text'),
    'mac_address'	=> array('MAC Address', 'input', 'text'),
    'asset_number' => array('Asset Number', 'input', 'text'),
    'donor_id' => array('Donor', 'select', 'donor_id', 'donor_name'),
    'procured_by_id' => array('Procured By', 'select', 'vendor_id', 'vendor_name'),
    'purchase_order_date' => array('Order Date', 'input', 'date'),
    'cost' => array('Cost', 'input', 'number'),
    'supplier_id' => array('Supplier', 'select', 'vendor_id', 'vendor_name'),
    'invoice_number' => array('Invoice Number', 'input', 'text'),
    'invoice_date' => array('Invoice Date', 'input', 'date'),
    'supply_date' => array('Supply Date', 'input', 'date'),
    'installation_date' => array('Installation Date', 'input', 'date'),
    'warranty_start_date' => array('Warranty Start','input', 'date'),
    'warranty_end_date' => array('Warranty End','input', 'date'),
    'functional_status_id' => array('Functional Status', 'select', 'functional_status_id', 'working_status'),
    'procurement_status_id'	=> array('Procurement Status', 'select', 'procurement_status_id','procurement_status')
  );

  function get_equipment_form_fields(){
    return $this->equipment_form_fields;
  }

  function get_equipment($apply_filter=false){
    if($apply_filter && $this->input->get('equipment_id'))
      $this->db->where('equipment.equipment_id', $this->input->get('equipment_id'));
    $this->db->select("equipment_id, equipment_type, manufac.vendor_name, eq_name, model, serial_number, mac_address, asset_number, donor_name, proc.vendor_name, purchase_order_date, cost, supp.vendor_name, invoice_number, invoice_date, supply_date, installation_date, warranty_start_date, warranty_end_date, equipment_status_type")
      ->from('equipment')
      ->join('equipment_type', 'equipment_type.equipment_type_id = equipment.equipment_type_id', 'left')
      ->join('equipment_procurement_type', 'equipment_procurement_type.equipment_procurement_type_id  = equipment.equipment_procurement_type_id', 'left')
      ->join('vendor as manufac', 'manufac.vendor_id = equipment.manufacturer_id', 'left')
      ->join('vendor as supp', 'supp.vendor_id = equipment.supplier_id', 'left')
      ->join('vendor as proc', 'proc.vendor_id = equipment.procured_by_id', 'left')
      ->join('donors', 'donors.donor_id = equipment.donor_id', 'left')
      ->join('equipment_status_type', 'equipment_status_type.equipment_status_type_id = equipment.functional_status_id', 'left');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function add_update_equipment(){
    $post_data = array();
    foreach($this->equipment_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
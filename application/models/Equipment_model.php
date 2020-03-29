<?php
class Equipment_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_form_fields = array(
    'equipment_id'	=> array('', 'input', 'hidden'),
    'equipment_type_id'	=> array('Equipment Type', 'select', 'equipment_type_id', 'equipment_type'),
    'equipment_procurement_type_id' => array('Procurement type', 'select', 'equipment_procurement_type_id', 'procurement_type'),
    'manufacturer_id'	=> array('Manufacturer', 'select', 'vendor_id', 'vendor_name'),
    'eq_name' => array('Equipment Name', 'input', 'text'),
    'model' => array('Model', 'input', 'text'),
    'serial_number' => array('Serial Number', 'input', 'text'),
    'mac_address'	=> array('MAC Address', 'input', 'text'),
    'asset_number' => array('Asset Number', 'input', 'text'),
    'donor_id' => array('Donor', 'select', 'vendor_id', 'vendor_name'),
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
    'procurement_status_id'	=> array('Procurement Status', 'select', 'equipment_procurement_status_id','procurement_status'),
    'journal_type_id' => array('Journal Type', 'select', 'journal_type_id', 'journal_type'),
    'journal_number' => array('Journal Number', 'input', 'text'),
    'journal_date' => array('Journal Date', 'input', 'date')
  );

  function get_equipment_form_fields(){
    return $this->equipment_form_fields;
  }

  function get_equipment(){
    $this->db->select("equipment_id, equipment_type, manufac.vendor_name, eq_name, model, serial_number, mac_address, asset_number, donor.vendor_name as donor_name, proc.vendor_name, DATE_FORMAT(purchase_order_date, '%d %b %Y') as purchase_order_date, FORMAT(cost, 2, 'en_IN'), supp.vendor_name, invoice_number, DATE_FORMAT(invoice_date, '%d %b %Y') as invoice_date, DATE_FORMAT(supply_date, '%d %b %Y') as supply_date, DATE_FORMAT(installation_date, '%d %b %Y') as installation_date, DATE_FORMAT(warranty_start_date, '%d %b %Y') as warranty_start_date, DATE_FORMAT(warranty_end_date, '%d %b %Y') as warranty_end_date, working_status, journal_type, journal_number, DATE_FORMAT(journal_date, '%d %b %Y') as journal_date")
      ->from('equipment')
      ->join('equipment_type', 'equipment_type.equipment_type_id = equipment.equipment_type_id', 'left')
      ->join('equipment_procurement_type', 'equipment_procurement_type.equipment_procurement_type_id  = equipment.equipment_procurement_type_id', 'left')
      ->join('vendor as manufac', 'manufac.vendor_id = equipment.manufacturer_id', 'left')
      ->join('vendor as supp', 'supp.vendor_id = equipment.supplier_id', 'left')
      ->join('vendor as proc', 'proc.vendor_id = equipment.procured_by_id', 'left')
      ->join('vendor as donor', 'donor.vendor_id = equipment.donor_id', 'left')
      ->join('journal_type', 'journal_type.journal_type_id = equipment.journal_type_id', 'left')
      ->join('equipment_functional_status', 'equipment_functional_status.functional_status_id = equipment.functional_status_id', 'left')
      ->order_by('eq_name', 'ASC');
    //  ->limit();
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment');
  }

  function get_equipment_record(){
    if($this->input->get('equipment_id'))
      $this->db->where('equipment.equipment_id', $this->input->get('equipment_id'));
    $this->db->select("*")
    ->from('equipment')
    ->order_by('eq_name', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

/*
  function get_summary_filter(){
    $report_group_id = '1';
    $this->db->select("*")
      ->from('report_group')
      ->where('report_group.report_group_id', $report_group_id)
      ->order_by('report_group_id', 'ASC');
    $qry = $this->db->get();
    $rslts = array();
    $rslts[] = $qry->result();
    $this->db->select("*")
      ->from('report_subgroup')
      ->where('report_subgroup.report_group_id', $report_group_id)
      ->order_by('report_group_id', 'ASC');
    $qry = $this->db->get();
    $rslts = array();
    $rslts[] = $qry->result();
    $this->db->select("*")
      ->from('report_where')
      ->where('report_where.report_group_id', $report_group_id)
      ->order_by('report_group_id', 'ASC');
    $qry = $this->db->get();
    $rslts = array();
    $rslts[] = $qry->result();
    return $rslts; 
  }
*/

  function get_summary_filter(){
    $filters = array();
    $filters['equipment_type_id'] = $this->equipment_form_fields['equipment_type_id'];
    $filters['donor_id'] = $this->equipment_form_fields['donor_id'];
    $filters['place_id'] = array('Place', 'select', 'place_id', 'place');
    $filters['cost'] = $this->equipment_form_fields['cost'];
    return $filters;
  }

  function equipment_summary(){
    $count_by_data = array();
    $where_data = array();
    foreach($this->equipment_form_fields as $field => $props){
      if(empty($this->input->post($field)))
        continue;      
      $count_by_data[$field] = $this->input->post($field);              
    }
    foreach($count_by_data as $field => $value){
      $this->db->where('equipment.'."$field", $value);
    }
    if(!empty($this->input->post('place_id') != ''))
      $this->db->where('place.place_id', $this->input->post('place_id'));
    
    $this->db->select("COUNT(*) as All_Equipment, SUM(cost) Equipment_Cost")
      ->from('equipment')
      ->join('equipment_type', 'equipment_type.equipment_type_id = equipment.equipment_type_id', 'left')
      ->join('equipment_procurement_type', 'equipment_procurement_type.equipment_procurement_type_id  = equipment.equipment_procurement_type_id', 'left')
      ->join('vendor as manufac', 'manufac.vendor_id = equipment.manufacturer_id', 'left')
      ->join('vendor as supp', 'supp.vendor_id = equipment.supplier_id', 'left')
      ->join('vendor as proc', 'proc.vendor_id = equipment.procured_by_id', 'left')
      ->join('vendor as donor', 'donor.vendor_id = equipment.donor_id', 'left')
      ->join('journal_type', 'journal_type.journal_type_id = equipment.journal_type_id', 'left')
      ->join('equipment_functional_status', 'equipment_functional_status.functional_status_id = equipment.functional_status_id', 'left')
      ->join('equipment_location_log', 'equipment_location_log.equipment_id = equipment.equipment_id', 'left')
      ->join('place', 'equipment_location_log.place_id = place.place_id', 'left')
      ->order_by('eq_name', 'ASC');
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
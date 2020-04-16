<?php
class Equipment_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_form_fields = array(
    'equipment_id'	=> array('', 'input', 'hidden'),
    'equipment_type_id'	=> array('Equipment Type', 'select', 'equipment_type_id', 'equipment_type'),
    'equipment_procurement_type_id' => array('Procurement type', 'select', 'equipment_procurement_type_id', 'procurment_type'),
    'manufacturer_id'	=> array('Manufacturer', 'select', 'vendor_id', 'vendor_name'),
    'eq_name' => array('Equipment Name', 'input', 'text'),
    'model' => array('Model', 'input', 'text'),
    'serial_number' => array('Serial Number', 'input', 'text'),
    'mac_address'	=> array('MAC Address', 'input', 'text'),
    'asset_number' => array('Asset Number', 'input', 'text'),
    'donor_id' => array('Donor', 'select', 'vendor_id', 'vendor_name'),
    'procured_by_id' => array('Procured By', 'select', 'vendor_id', 'vendor_name'),
    'purchase_order_date' => array('Order Date', 'input', 'date'),
    'cost' => array('Cost', 'input', 'text'),
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
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    // https://stackoverflow.com/questions/12102200/get-records-with-max-value-for-each-group-of-grouped-sql-results
    $eq_loc_log_str = "(SELECT * FROM (SELECT equipment_id, place.place, vendor_name as custodian, equipment_location_log.delivery_date as delivery_date, address FROM equipment_location_log LEFT JOIN vendor ON equipment_location_log.vendor_id = vendor.vendor_id LEFT JOIN place ON equipment_location_log.place_id = place.place_id ORDER BY delivery_date desc) as ordrd GROUP BY delivery_date) as eq_loc_log";
    $this->db->select("equipment.equipment_id, equipment_type, eq_name, model, manufac.vendor_name as manufacturer, supp.vendor_name as supplier, serial_number, mac_address, asset_number, donor.vendor_name as donor, proc.vendor_name as procured_by, equipment_procurement_type.procurment_type, FORMAT(cost, 2, 'en_IN') as cost_INR, invoice_number,  DATE_FORMAT(purchase_order_date, '%d %b %Y') as purchase_order_date, DATE_FORMAT(invoice_date, '%d %b %Y') as invoice_date, DATE_FORMAT(purchase_order_date, '%d %b %Y') as purchase_order_date , DATE_FORMAT(supply_date, '%d %b %Y') as supply_date, DATE_FORMAT(installation_date, '%d %b %Y') as installation_date, DATE_FORMAT(warranty_start_date, '%d %b %Y') as warranty_start_date, DATE_FORMAT(warranty_end_date, '%d %b %Y') as warranty_end_date, journal_type, journal_number, DATE_FORMAT(journal_date, '%d %b %Y') as journal_date, address, place, custodian as user, DATE_FORMAT(delivery_date, '%d %b %Y') as delivery_date, working_status, equipment.equipment_id as equipment_ID")
      ->from('equipment')
      ->join('equipment_type', 'equipment_type.equipment_type_id = equipment.equipment_type_id', 'left')
      ->join('equipment_procurement_type', 'equipment_procurement_type.equipment_procurement_type_id  = equipment.equipment_procurement_type_id', 'left')
      ->join('vendor as manufac', 'manufac.vendor_id = equipment.manufacturer_id', 'left')
      ->join('vendor as supp', 'supp.vendor_id = equipment.supplier_id', 'left')
      ->join('vendor as proc', 'proc.vendor_id = equipment.procured_by_id', 'left')
      ->join('vendor as donor', 'donor.vendor_id = equipment.donor_id', 'left')
      ->join('journal_type', 'journal_type.journal_type_id = equipment.journal_type_id', 'left')
      ->join('equipment_functional_status', 'equipment_functional_status.functional_status_id = equipment.functional_status_id', 'left')
      ->order_by('eq_name', 'ASC')
      ->limit($limit, $offset);
    $this->db->join("$eq_loc_log_str", 'eq_loc_log.equipment_id = equipment.equipment_id', 'left');
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

  function get_where_filter(){
    $filters['equipment_type_id'] = $this->equipment_form_fields['equipment_type_id'];
    $filters['donor_id'] = $this->equipment_form_fields['donor_id'];
    $filters['place_id'] = array('Place', 'select', 'place_id', 'place');
    $filters['cost'] = $this->equipment_form_fields['cost'];    
    $filters['journal_from_date'] = array('Journal From Date', 'input', 'date');
    $filters['journal_to_date'] = array('Journal To Date', 'input', 'date');
    return $filters;
  }

  function get_group_filter(){
    $filters = array();
    $filters['group'] = array('Grouping', 'select', 'setting_query_filter_field_id', 'label');
    $filters['sub_group'] = array('Sub Grouping', 'select', 'setting_query_filter_field_id', 'label');
    //$filters['date_on'] = array('Apply Date On', 'select', 'setting_query_filter_field_id', 'label');
    return $filters;
  }

  function get_grouping(){
    $this->db->select('*')
      ->from('setting_query_filter_field')
      ->join('setting_query_filter', 'setting_query_filter.setting_query_filter_id = setting_query_filter_field.setting_query_filter_id')
      ->where('setting_query_filter.query_filter_name', 'welcome_page')
      ->where('filter_type', 'group');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function get_subgrouping(){
    $this->db->select('*')
      ->from('setting_query_filter_field')
      ->join('setting_query_filter', 'setting_query_filter.setting_query_filter_id = setting_query_filter_field.setting_query_filter_id')
      ->where('setting_query_filter.query_filter_name', 'welcome_page');
      //->where('filter_type', 'subgroup');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function welcome_default_filter_values(){
    $this->db->select('setting_query_filter_field_id')
      ->from('setting_query_filter_field')
      ->join('setting_query_filter', 'setting_query_filter.setting_query_filter_id = setting_query_filter_field.setting_query_filter_id')
      ->where('setting_query_filter.query_filter_name', 'welcome_page')
      ->where('setting_query_filter_field.default_filter', 'yes');
    $qry = $this->db->get();
    $rslts = $qry->result();
    $rslts = $rslts[0]->setting_query_filter_field_id;
    return (object)array('group' => $rslts);
  }

  function equipment_summary(){
    // Grouping fields
    $group_filter_id = false;
    $mstrs = array();
    if($this->input->post('group')){
      $group_filter_id = $this->input->post('group');
    }
    else{
      $group_filter_id = $this->welcome_default_filter_values()->group;
    }
    // Subgrouping fields
    $sub_group_id = false;
    if($this->input->post('sub_group')){
      $sub_group_id = $this->input->post('sub_group');
    }
      
    // Group On
    $this->db->select('*')
      ->from('setting_query_filter_field')
      ->join('setting_query_filter', 'setting_query_filter.setting_query_filter_id = setting_query_filter_field.setting_query_filter_id')
      ->where('setting_query_filter.query_filter_name', 'welcome_page')
      ->where('setting_query_filter_field.setting_query_filter_field_id', $group_filter_id);
    if($sub_group_id){
      $this->db->or_where('setting_query_filter_field.setting_query_filter_field_id', $sub_group_id);
    }
    $qry = $this->db->get();
    $mstrs = $qry->result();
    // Apply Group By
    $group_record = '';
    $this->db->select('*')
      ->from('setting_query_filter_field')
      ->where('setting_query_filter_field_id', $group_filter_id);
    $qry = $this->db->get();
    $group_record = $qry->result();
    $group_record = $group_record[0];  
    $group_by_label = str_replace(" ","_", $group_record->label);
    $group_by_field = $group_by_label.'.'.$group_record->master_label_field;
    $group_by_select = $group_by_field.' AS '.$group_by_label;
    $group_by_str =  $group_by_field;

    // Apply Sub group by
    $sub_group_by_label = '';
    $sub_group_by_select = '';
    $sub_group_by_str = '';
    
    if($sub_group_id){
      $this->db->select('*')
        ->from('setting_query_filter_field')
        ->where('setting_query_filter_field_id', $sub_group_id);
      $qry = $this->db->get();
      $sub_group_record = $qry->result();
      $sub_group_record = $sub_group_record[0];  
      $sub_group_by_label = str_replace(" ","_", $sub_group_record->label);
      $sub_group_by_field = $sub_group_by_label.'.'.$sub_group_record->master_label_field;
      $sub_group_by_select = $sub_group_by_field.' AS '.$sub_group_by_label;
      $sub_group_by_str =  $sub_group_by_field;
    }

    // journal_form_date, journal_to_date
    if($this->input->post('journal_from_date') && $this->input->post('journal_to_date')){
      $from_date = $this->input->post('journal_from_date');
      $to_date = $this->input->post('journal_to_date');
      $this->db->where("equipment.journal_date BETWEEN '$from_date' AND '$to_date'");
    }
    
    // All where conditions
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
    // All the join conditions
    foreach($mstrs as $mstr){
      $table_name = $mstr->table_name;
      $field_name = $mstr->field_name;
      $master_table = $mstr->master_table_name;
      $master_field_name = $mstr->master_field_name;
      $label = str_replace(" ","_", $mstr->label);
      $join_string = $table_name."."."$field_name = $label".".".$master_field_name;
      $this->db->join("$master_table AS $label", $join_string, 'left');
    }
    // Final query
    $this->db->select("$group_by_select, $sub_group_by_select, COUNT(*) as All_Equipment, SUM(cost) as Equipment_Cost")
      ->from('equipment')
      ->join('equipment_location_log', 'equipment_location_log.equipment_id = equipment.equipment_id', 'left')
      ->join('place', 'equipment_location_log.place_id = place.place_id', 'left')
      ->order_by($group_by_str, 'ASC')
      ->order_by($sub_group_by_str, 'ASC')
      ->group_by($group_by_str)
      ->group_by($sub_group_by_str);
    $qry = $this->db->get();
    $rslts = $qry->result();
    // Recursive order n assuming group by 2 groups
    $rslts = array(
      'group_label' => $group_by_label,
      'numeric' => array('All_Equipment', 'Equipment_Cost'), 
      'data' => $rslts
    );
    $rslts['sub_group_labels'] = $sub_group_by_label == '' ? array() : array($sub_group_by_label);
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
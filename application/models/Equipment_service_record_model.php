<?php
class Equipment_service_record_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $service_record_form_fields = array(
    'request_id'	=> array('', 'input', 'hidden'),
    'equipment_id'	=> array('Equipment', 'select', 'equipment_id', 'eq_name'),
    'user_id' => array('User', 'select', 'user_id', 'name'),// <<-- User name can be changed in the query
    'call_date'	=> array('Call Date', 'input', 'date'),
    'call_time'	=> array('Call Time', 'input', 'time'),
    'call_type' => array('Call Type', 'input', 'text'),     // <<-- Pending discussion needed
    'service_issue_type_id'	=> array('Service Issue Type', 'input', 'text'),// <<-- Pending discussion needed
    'call_information'	=> array('Call Information', 'input', 'text'),
    'caller_institution_id' => array('Caller Institution', 'input', 'text'),
    'contact_person'	=> array('Contact Person', 'input', 'text'),
    'service_provider_id'	=> array('Service Provider', 'select', 'vendor_id', 'vendor_name'),
    'service_person' => array('Service Person', 'input', 'text'),
    'service_person_phone'	=> array('Service Person Phone', 'input', 'text'),
    'contact_person_phone'	=> array('Contact Person Phone', 'input', 'text'),
    'service_person_remarks ' => array('Service Person Remarks', 'input', 'text'),
    'issue_closure'	=> array('Issue Closure', 'input', 'text'),
    'working_status_id'	=> array('Working Status', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_accessory_form_fields;
  }

  function get_equipment_service(){
    $this->db->select("request_id, equipment_id, CONCAT(user_detail.first_name, ' ', user_detail.last_name) as name, call_date, call_time, call_type, service_issue_type, call_information, caller_institution, contact_person, vendor_name as service_provider, service_person, service_person_phone, contact_person_phone, service_person_remarks, issue_closure, working_status_id")
      ->from('equipment_service_record')
      ->join('equipment', 'equipment.equipment_id = equipment_service_record.equipment_id', 'left')
      ->join('equipment_service_issue_type', 'equipment_service_issue_type.equipment_service_issue_type_id = equipment_service_record.equipment_service_issue_type', 'left')
      ->join('caller_institution', 'caller_institution.caller_institution_id = equipment_service_record.caller_institution_id', 'left')
      ->join('user_detail', 'user_detail.user_id = equipment.user_id', 'left')
      ->join('caller_institution', 'caller_institution.caller_institution_id = equipment_service_record.caller_institution_id', 'left')
      ->join('vendor', 'vendor.vendor_id = equipment_service_record.service_provider_id', 'left')
      ->join('equipment_status_type', 'equipment_status_type.equipment_status_type_id = equipment_service_record.equipment_status_type_id', 'left');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_accessory');
  }

  function get_equipment_service_record(){
    if($this->input->get('equipment_service_record_id'))
      $this->db->where('equipment_service_record.equipment_service_record_id', $this->input->get('equipment_service_record_id'));
    $this->db->select("*")
    ->from('equipment_service_record');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_service_record(){
    $post_data = array();
    foreach($this->service_record_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_service_record', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
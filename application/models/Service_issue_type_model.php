<?php
class Service_issue_type_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_accessory_form_fields = array(
    'equipment_service_issue_type_id'	=> array('', 'input', 'hidden'),
    'equipment_service_issue_type'	=> array('Service Issue Type', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_accessory_form_fields;
  }

  function get_service_issue_type(){
    $this->db->select("equipment_service_issue_type_id, equipment_service_issue_type")
      ->from('equipment_service_issue_type')
      ->order_by('equipment_service_issue_type', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_accessory');
  }

  function get_service_issue_type_record(){
    if($this->input->get('equipment_service_issue_type_id'))
      $this->db->where('equipment_service_issue_type.equipment_service_issue_type_id', $this->input->get('equipment_service_issue_type_id'));
    $this->db->select("*")
      ->from('equipment_service_issue_type')
      ->order_by('equipment_service_issue_type', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_service_issue_type(){
    $post_data = array();
    foreach($this->equipment_accessory_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_service_issue_type', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
<?php
class Equipment_service_record_log_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $service_record_log_form_fields = array(
    'service_record_log_id'	=> array('', 'input', 'hidden'),
    'request_id'	=> array('Request', 'select', 'request_id', 'service_person'),
    'status_note'	=> array('Status Note', 'input', 'text')
  );

  function get_form_fields(){
    return $this->service_record_log_form_fields;
  }

  function get_equipment_service_record_log(){
    $this->db->select("*")
      ->from('equipment_service_record_log')
      ->order_by('status_note', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_service_record_log');
  }

  function get_equipment_service_record_log_record(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    if($this->input->get('service_record_log_id'))
      $this->db->where('equipment_service_record_log.service_record_log_id', $this->input->get('service_record_log_id'));
    $this->db->select("*")
      ->from('equipment_service_record_log')
      ->order_by('status_note', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_service_record_log(){
    $post_data = array();
    foreach($this->service_record_log_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_service_record_log', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
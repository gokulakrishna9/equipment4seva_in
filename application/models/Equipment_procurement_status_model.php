<?php
class Equipment_procurement_status_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_procurement_status_form_fields = array(
    'equipment_procurement_status_id'	=> array('', 'input', 'hidden'),
    'procurement_status'	=> array('Procurement Status', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_procurement_status_form_fields;
  }

  function get_equipment_procurement_status(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("*")
      ->from('equipment_procurement_status')
      ->order_by('procurement_status', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_functional_status');
  }

  function get_equipment_procurement_status_record(){
    if($this->input->get('equipment_procurement_status_id'))
      $this->db->where('equipment_procurement_status.equipment_procurement_status_id', $this->input->get('equipment_procurement_status_id'));
    $this->db->select("*")
      ->from('equipment_procurement_status')
      ->order_by('procurement_status', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_procurement_status(){
    $post_data = array();
    foreach($this->equipment_procurement_status_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_procurement_status', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  function validate_input(){
  }

  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
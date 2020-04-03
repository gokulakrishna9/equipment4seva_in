<?php
class Equipment_functional_status_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_functional_status_form_fields = array(
    'functional_status_id'	=> array('', 'input', 'hidden'),
    'working_status'	=> array('Working Status', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_functional_status_form_fields;
  }

  function get_functional_status(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("*")
      ->from('equipment_functional_status')
      ->order_by('working_status', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_functional_status');
  }

  function get_equipment_functional_status(){
    if($this->input->get('functional_status_id'))
      $this->db->where('equipment_functional_status.functional_status_id', $this->input->get('functional_status_id'));
    $this->db->select("*")
    ->from('equipment_functional_status')
    ->order_by('working_status', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_functional_status(){
    $post_data = array();
    foreach($this->equipment_functional_status_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('equipment_functional_status', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  function validate_input(){
  }

  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
<?php
class Caller_institution_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_accessory_form_fields = array(
    'caller_institution_id'	=> array('', 'input', 'hidden'),
    'caller_institution'	=> array('Caller Institution', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_accessory_form_fields;
  }

  function get_caller_institution(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 1;
    else 
      $offset = $this->session->page_number * $limit;
    $this->db->select("*")
      ->from('caller_institution')
      ->order_by('caller_institution', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_accessory');
  }

  function get_caller_institution_record(){
    if($this->input->get('caller_institution_id'))
      $this->db->where('caller_institution.caller_institution_id', $this->input->get('caller_institution_id'));
    $this->db->select("*")
    ->from('caller_institution')
    ->order_by('caller_institution', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_caller_institution(){
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
    $this->db->replace('caller_institution', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
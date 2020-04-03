<?php
class Equipment_accessory_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_accessory_form_fields = array(
    'equipment_accessory_id'	=> array('', 'input', 'hidden'),
    'equipment_id'	=> array('Equipment', 'select', 'equipment_id', 'eq_name'),
    'accessory_name' => array('Accessory Name', 'input', 'text')
  );

  function get_form_fields(){
    return $this->equipment_accessory_form_fields;
  }

  function get_equipment_accessory(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("equipment_accessory_id, accessory_name, eq_name as equipment_name")
      ->from('equipment_accessory')
      ->join('equipment', 'equipment.equipment_id = equipment_accessory.equipment_id', 'left')
      ->order_by('accessory_name', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_accessory');
  }

  function get_equipment_accessory_record(){
    if($this->input->get('equipment_accessory_id'))
      $this->db->where('equipment_accessory.equipment_accessory_id', $this->input->get('equipment_accessory_id'));
    $this->db->select("*")
    ->from('equipment_accessory')
    ->order_by('accessory_name', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_accessory(){
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
    $this->db->replace('equipment_accessory', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
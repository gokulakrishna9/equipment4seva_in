<?php
class equipment_location_log_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $equipment_accessory_form_fields = array(
    'equipment_location_log_id'	=> array('', 'input', 'hidden'),
    'equipment_id' => array('', 'input', 'hidden'),
    'vendor_id' => array('Party', 'select', 'vendor_id', 'vendor_name'),
    'place_id' => array('Place', 'select', 'place_id', 'place'),
    'address'	=> array('Address', 'input', 'text'),
    'delivery_date'	=> array('Delivery Date', 'input', 'date'),
  );

  function get_form_fields(){
    return $this->equipment_accessory_form_fields;
  }

  function get_equipment_location_log(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    if($this->session->has_userdata('equipment_id'))
      $this->db->where('equipment_location_log.equipment_id', $this->session->equipment_id);
    $this->db->select("equipment_location_log_id, eq_name as equipment, vendor_name, place, address, delivery_date")
      ->from('equipment_location_log')
      ->join('equipment', 'equipment.equipment_id = equipment_location_log.equipment_id', 'left')
      ->join('vendor', 'vendor.vendor_id = equipment_location_log.vendor_id', 'left')
      ->join('place', 'place.place_id = equipment_location_log.place_id', 'left')
      ->order_by('delivery_date', 'DESC')
      ->order_by('address', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('equipment_accessory');
  }

  function get_equipment_location_log_record(){
    if($this->input->post_get('equipment_location_log_id'))
      $this->db->where('equipment_location_log.equipment_location_log_id', $this->input->post_get('equipment_location_log_id'));  
    $this->db->select("*")
    ->from('equipment_location_log')
    ->order_by('address', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_equipment_location_log(){
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
    $this->db->replace('equipment_location_log', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
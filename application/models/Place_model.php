<?php
class Place_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $place_form_fields = array(
    'place_id'	=> array('', 'input', 'hidden'),
    'place'	=> array('Place', 'input', 'text')
  );

  function get_form_fields(){
    return $this->place_form_fields;
  }

  function get_place(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("*")
      ->from('place')
      ->order_by('place', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('place');
  }

  function get_place_record(){
    if($this->input->get('place_id'))
      $this->db->where('place.place_id', $this->input->get('place_id'));
    $this->db->select("*")
      ->from('place')
      ->order_by('place', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_place(){
    $post_data = array();
    foreach($this->place_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('place', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
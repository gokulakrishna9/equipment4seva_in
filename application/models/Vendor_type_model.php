<?php
class Vendor_type_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $vendor_type_form_fields = array(
    'vendor_type_id'	=> array('', 'input', 'hidden'),
    'vendor_type'	=> array('Vendor Type', 'input', 'text')
  );

  function get_form_fields(){
    return $this->vendor_type_form_fields;
  }

  function get_vendor_type(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("*")
      ->from('vendor_type')
      ->order_by('vendor_type', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('vendor_type');
  }

  function get_vendor_type_record(){
    if($this->input->get('vendor_type_id'))
      $this->db->where('vendor_type.vendor_type_id', $this->input->get('vendor_type_id'));
    $this->db->select("*")
      ->from('vendor_type')
      ->order_by('vendor_type', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_vendor_type(){
    $post_data = array();
    foreach($this->vendor_type_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('vendor_type', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
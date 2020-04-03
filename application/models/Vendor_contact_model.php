<?php
class vendor_contact_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $vendor_contact_form_fields = array(
    'contact_person_id'	=> array('', 'input', 'hidden'),
    'contact_person_name'	=> array('Name', 'input', 'text'),
    'phone' => array('Phone', 'input', 'text'),
    'email' => array('Email', 'input', 'email')
  );

  function get_form_fields(){
    return $this->vendor_contact_form_fields;
  }

  function get_vendor_contact(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("*")
      ->from('vendor_contact')
      ->order_by('contact_person_name', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('vendor_contact');
  }

  function get_vendor_contact_record(){
    if($this->input->get('contact_person_id'))
      $this->db->where('vendor_contact.contact_person_id', $this->input->get('contact_person_id'));
    $this->db->select("*")
      ->from('vendor_contact')
      ->order_by('contact_person_name', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_vendor_contact(){
    $post_data = array();
    foreach($this->vendor_contact_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('vendor_contact', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
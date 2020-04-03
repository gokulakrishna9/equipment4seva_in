<?php
class Vendor_model extends CI_Model {
  // label, html_element, {type | master_value_field, master label field}, ... 
  private $vendor_form_fields = array(
    'vendor_id'	=> array('', 'input', 'hidden'),
    'vendor_type_id'	=> array('Vendor Type', 'select', 'vendor_type_id', 'vendor_type'),
    'vendor_name' => array('Name', 'input', 'text'),
    'vendor_address'	=> array('Address', 'input', 'text'),
    'vendor_city' => array('City', 'input', 'text'),
    'vendor_state' => array('State', 'input', 'text'),
    'vendor_country' => array('Country', 'input', 'text'),
    'account_no'	=> array('Account Number', 'input', 'text'),
    'bank_name' => array('Bank', 'input', 'text'),
    'branch' => array('Branch', 'input', 'text'),
    'vendor_email' => array('Email', 'input', 'text'),
    'vendor_phone' => array('Phone', 'input', 'text'),
    'contact_person_id' => array('Contact Person', 'select', 'contact_person_id', 'contact_person_name'),
    'vendor_pan' => array('PAN', 'input', 'text')
  );

  function get_vendor_form_fields(){
    return $this->vendor_form_fields;
  }

  function get_vendor(){
    $limit = $this->session->per_page;
    if($this->session->page_number == 1)
      $offset = 0;
    else 
      $offset = ($this->session->page_number - 1) * $limit;
    $this->db->select("vendor_id, vendor_type, vendor_name, vendor_address, vendor_city, vendor_state, vendor_country, account_no, bank_name, branch, vendor_email, vendor_phone, vendor_pan, contact_person_name")
      ->from('vendor')
      ->join('vendor_type', 'vendor_type.vendor_type_id = vendor.vendor_type_id', 'left')
      ->join('vendor_contact', 'vendor_contact.contact_person_id  = vendor.contact_person_id', 'left')
      ->order_by('vendor_name', 'ASC')
      ->limit($limit, $offset);
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }

  function count_all(){
    return $this->db->count_all('vendor');
  }

  function get_vendor_record(){
    if($this->input->get('vendor_id'))
      $this->db->where('vendor.vendor_id', $this->input->get('vendor_id'));
    $this->db->select("*")
      ->from('vendor')
      ->order_by('vendor_name', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts[0];
  }

  function add_update_vendor(){
    $post_data = array();
    foreach($this->vendor_form_fields as $field => $props){
      $post_data[$field] = is_null($this->input->post($field)) ? ' ' : $this->input->post($field);
    }
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $this->db->replace('vendor', $post_data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function validate_input(){
  }
  function transaction_check(){
    // Destroy transactions after a certain limit
  }
}
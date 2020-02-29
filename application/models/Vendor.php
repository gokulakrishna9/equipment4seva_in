<?php
class Vendor extends CI_Model {
  function get_vendor(){
    $this->db->select("*")
      ->from('vendor');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
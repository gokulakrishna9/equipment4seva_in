<?php
class Supplier extends CI_Model {
  function get_supplier(){
    $this->db->select("*")
      ->from('supplier');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
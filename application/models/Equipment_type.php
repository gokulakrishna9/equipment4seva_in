<?php
class Equipment_type extends CI_Model {
  function get_equipment_type(){
    $this->db->select("*")
      ->from('equipment_type');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
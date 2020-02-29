<?php
class Equipment_status_type extends CI_Model {
  function get_equipment_status_type(){
    $this->db->select("*")
      ->from('equipment_status_type');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
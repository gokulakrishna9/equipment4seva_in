<?php
class Procured_by extends CI_Model {
  function get_procured_by(){
    $this->db->select("*")
      ->from('procured_by');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
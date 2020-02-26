<?php
class Donor extends CI_Model {
  function get_donors(){
    $this->db->select("*")
      ->from('donors');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
<?php
class Donor extends CI_Model {
  function get_donors(){
    $this->db->select("*")
      ->from('donors')
      ->order_by('caller_institution', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
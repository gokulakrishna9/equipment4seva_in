<?php
class Journal_type_model extends CI_Model {
  function get_journal_type(){
    $this->db->select("*")
      ->from('journal_type')
      ->order_by('journal_type', 'ASC');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
}
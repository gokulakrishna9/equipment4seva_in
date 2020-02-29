<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format_data {
  public function format_table_data($table_data, $action, $key_field){
    $table_rows = array();
    $header = array();
    $header[] = 'Update';
    foreach($table_data[0] as $key => $value){
      $header[] = ucwords(str_replace('_', ' ', $key));
    }
    $table_rows[] = $header;
    foreach($table_data as $record){
      $values = array();
      $values[] = '<a href="'.base_url().$action.$record->$key_field.'" class="w3-btn w3-teal">Update</a>';
      foreach($record as $field_name => $field_value){
        $values[] = $field_value;
      }      
      $table_rows[] = $values;
    }
    return $table_rows;
  }
}
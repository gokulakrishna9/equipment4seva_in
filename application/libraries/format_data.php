<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format_data {
  public function format_table_data($table_data, $action, $key_field){
    $table_rows = array();
    $header = array();
    if(!$table_data)
      return;
    foreach($action as $key => $op){
      $header[] = $key;
    }
    $colors = array('w3-teal', 'w3-lime', 'w3-amber');
    $target = '';
    foreach($table_data[0] as $key => $value){
      $header[] = ucwords(str_replace('_', ' ', $key));
    }
    $table_rows[] = $header;
    foreach($table_data as $record){
      $values = array();
      $i = 0;
      foreach($action as $key => $op){
        if($i > 2)
          $i = 0;
        if($i > 0)
          $target = '';
        else 
          $target = '';
        $values[] = '<a href="'.base_url().$op.$record->$key_field.'" 
        target="'.$target.'" class="w3-btn '.$colors[$i].'">'.$key.'</a>';
        $i++;
      }
      foreach($record as $field_name => $field_value){
        $values[] = $field_value;
      }      
      $table_rows[] = $values;
    }
    return $table_rows;
  }
}
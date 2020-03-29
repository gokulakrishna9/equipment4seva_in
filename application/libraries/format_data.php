<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format_data {
  public function format_table_data($table_data, $action){
    $table_rows = array();
    $header = array();
    if(!$table_data)
      return;
    if(isset($action)){
      foreach($action as $op){
        $header[] = $op['label'];
      }
    }    
    $colors = array('w3-teal', 'w3-lime', 'w3-amber');
    $target = '';
    foreach($table_data[0] as $key => $value){
      if(strpos($key, 'id') !== false)
        continue;
      $header[] = ucwords(str_replace('_', ' ', $key));
    }
    $table_rows[] = $header;    
    foreach($table_data as $record){  
      $values = array();
      if(isset($action)){
        $i = 0; // Color List
        foreach($action as $op){
          if($i > 2)
            $i = 0;
          if($i > 0)
            $target = '';
          else 
            $target = '';
          // Build URL
          $url = base_url();
          $url .= $op['controller_method'].'?';
          foreach($op as $url_param => $value_param){
            if($url_param == 'label' || $url_param == 'controller_method')
              continue;
            $url .= $url_param.'='.$record->$value_param.'&';
          }
          $values[] = '<a href="'.$url.'" 
          target="'.$target.'" class="w3-btn '.$colors[$i].'">'.$op['label'].'</a>';
          $i++;
        }
      }
      foreach($record as $field_name => $field_value){
        if(strpos($field_name, 'id') !== false)
          continue;
        $values[] = $field_value;
      }      
      $table_rows[] = $values;
    }
    return $table_rows;
  }
}
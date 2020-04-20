<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format_data {
  public function format_table_data($table_data, $action = null){
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
    $table_rows['header'] = $header; 
    $table_rows['values'] = array();   
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
          $values[] = array('properties' => '','value' => '<a href="'.$url.'" 
          target="'.$target.'" class="w3-btn '.$colors[$i].'">'.$op['label'].'</a>');
          $i++;
        }
      }
      foreach($record as $field_name => $field_value){
        if(strpos($field_name, 'id') !== false)
          continue;
        $prop = '';
        if(is_numeric($field_value)){
          $prop = 'class="w3-right-align"';
          $field_value = $this->ind_numbr_format($field_value);
        }          
        $values[] = array('value' => $field_value, 'properties' => $prop);
      }      
      $table_rows['values'][] = $values;
    }
    return $table_rows;
  }

  // separate data_properties array because of the joins
  public function format_table_data_multi($table_data, $action = null, $data_properties = null){
    $table_rows = array();
    $header = array();
    $colors = array('w3-teal', 'w3-lime', 'w3-amber');
    if(!$table_data)
      return;    
    $colors = array('w3-teal', 'w3-lime', 'w3-amber');
    $target = '';
    $position = 0;
    foreach($table_data[0] as $key => $value){
      if(isset($action) && array_key_exists($position, $action)){
        $header[] = ucwords(str_replace('_', ' ', $action[$position]['label']));
      }
      if(isset($data_properties) && array_key_exists('hidden', $data_properties[$key]))
        continue;      
      $header[] = ucwords(str_replace('_', ' ', $key));
      $position++;
    }
    $table_rows['header'] = $header; 
    $table_rows['values'] = array();
    foreach($table_data as $record){  
      $values = array();
      $position = 0;
      foreach($record as $field_name => $field_value){
        if(isset($action) && array_key_exists($position, $action)){
          $op = $action[$position][0];
          $op_url = $action[$position]['controller_method'].'?';
          $params = '';
          foreach($op['record_params'] as $url_param => $value_param){
            $params .= $url_param.'='.str_replace(" ","_", $record->$value_param).'&';
          }
          foreach($op['hard_coded_params'] as $url_param => $value_param){
            $params .= $url_param.'='.str_replace(" ","_", $value_param).'&';
          }
          $i = $position % sizeof($colors);
          $op_url .= $params;
          $values[] = array('properties' => '','value' => '<a href="'.$op_url.'" 
          target="'.$target.'" class="w3-btn '.$colors[$i].'">'.$action[$position]['label'].'</a>');
        }
        $position++;
        $prop = '';
        if(isset($data_properties) && array_key_exists($field_name, $data_properties)){          
          // data_properties are key value pairs
          if(array_key_exists('hidden', $data_properties[$field_name]))
            continue;
          foreach($data_properties[$field_name] as $prop_key => $prop_value){
            $prop .= $prop_key.'="'.$prop_value;
            if($prop_key == 'class')
              continue;
            $prop .= '" ';
          }
          if(array_key_exists('class', $data_properties[$field_name]) && is_numeric($field_value)){
            $prop .= $prop_key.'="'.$prop_value;
            $prop .= 'w3-right-align';
            $field_value = $this->ind_numbr_format($field_value);
            $prop .= '" ';
          }  
        } else if(is_numeric($field_value)){
          $prop .= 'class="w3-right-align" ';
          $field_value = $this->ind_numbr_format($field_value);
        }
        // Add extra info to html data-<<attribute>> property
        $values[] = array('value' => $field_value, 'properties' => $prop);
      }
      $table_rows['values'][] = $values;
    }
    return $table_rows;
  }

  function grouping_component($data, $table_operator){
    //group_label, sub_group_labels
    $group_label = $data['record_params']['group_label'];
    $sub_group_labels = $data['record_params']['sub_group_labels'];
    $records = $this->group_totals($data);
    $ops = array();
    $ops[] = array();
    $value = array();    
    foreach($table_operator as $position => $params){
      $value['record_params'] = array();
      $value['record_params']['group_label'] = $group_label;                // <<-- This needs to be fixed, get group value here
      // This has to be fixed, for multiple subgroups
      $i = 1;
      foreach($sub_group_labels as $label){
        $value['record_params']['sub_group'.$i] = $label;
        $i++;
      }
      $value['hard_coded_params'] = array();
      $value['hard_coded_params'] = $data['hard_coded_params'];
      $ops[$position][] = $value;
      foreach($params as $key => $val){
        $ops[$position][$key] = $val;
      }
    }
    $table_data = $this->format_table_data_multi($records, $ops);
    return $table_data;
  }

  // Change this to indexes ? matrices
  function group_totals($data){
    $group_label = $data['record_params']['group_label'];
    $unique_groups = array();
    $sql_records = $data['data'];
    $sub_group_labels = $data['record_params']['sub_group_labels'];
    foreach($sql_records as $record){
      $unique_groups[] = $record->$data['record_params']['group_label'];
    }
    $unique_groups = array_unique($unique_groups);
    $records = array();
    $grand_total = array();
    $grand_total[$group_label] = 'Grand Total';
    foreach($data['record_params']['sub_group_labels'] as $sub_group_label){
      $grand_total[$sub_group_label] = '';
    }
    foreach($data['numeric'] as $numeric_label){
      $grand_total[$numeric_label] = 0;
    }
    foreach($unique_groups as $group){
      $totals = array();
      $totals[$group_label] = '';      
      $record_label = '';
      foreach($data['record_params']['sub_group_labels'] as $sub_group_label){
        $totals[$sub_group_label] = '';
      }
      foreach($data['numeric'] as $numeric_label){
        $totals[$numeric_label] = 0;
      }
      foreach($sql_records as $record){
        if($record->$group_label == $group){
          $records[] = $record;
          foreach($data['numeric'] as $numeric_label){
            if(sizeof($sub_group_labels) > 0)
              $totals[$numeric_label] = $totals[$numeric_label] + $record->$numeric_label;
            $grand_total[$numeric_label] = $grand_total[$numeric_label] + $record->$numeric_label;
          }
        }
      }
      if(sizeof($sub_group_labels) > 0){
        $totals[$group_label] = $group.' Total';
        $records[] = (object)$totals;
      }
    }
    $records[] = (object)$grand_total;
    return $records;
  }

  function ind_numbr_format($number){    	
    $decimal = (string)($number - floor($number));
    $numbr = floor($number);
    $length = strlen($numbr);
    $delimiter = '';
    $numbr = strrev($numbr);
    for($i=0;$i<$length;$i++){
      if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
        $delimiter .=',';
      }
      $delimiter .=$numbr[$i];
    }
    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);
    if( $decimal != '0'){
      $result = $result.$decimal;
    }
    return $result;
  }

  function grand_total($data){

  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HTML_builders {
  public function build_select($select_attributes = 0, $option_attributes = 0, $value_key= '', $label_key = '', $selected = 0)
  { 
    // Merge selected with options
    if($option_attributes != 0){
      foreach($option_attributes as $key => $attributes){
        if($selected != 0 && array_key_exists($key, $selected)){
          $option_attributes = array_merge($option_attributes[$key], $attributes);
        }
      }
      // HTML Build
      $options = '<option value="">--Select--</option>';
      foreach($option_attributes as $key => $attributes){
        $options .= '<option value="'.$key.'" ';
        foreach($attributes as $atr_key => $atr_val){
          if($atr_key == $label_key)
            continue;
          if($atr_key == $value_key)
            continue;
          $options .= $atr_key.'="'.$atr_val.'" ';
        }
        $options .= 'value="'.$attributes->$value_key.'">'.$attributes->$label_key.'</option>';
      }
    }
    
    // Select Build
    if($select_attributes != 0){
      $select = '<select ';
      foreach($select_attributes as $atr_key => $atr_val){
        $select .= $atr_key.'="'.$atr_val.'" ';
      }
      $select .= '>'.$options.'</select>';
    }
    return $select;
  }
}
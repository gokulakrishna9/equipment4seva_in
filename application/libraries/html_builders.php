<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HTML_builders {
  public function build_select($filed_name, $select_attributes, $option_attributes, $options, $selected)
  {
    // $option_attributes key => attributes, $select_attributes attribute => value, $selected key => {attributes}
    
    // Merge selected with options
    foreach($option_attributes as $key => $attributes){
      if(array_key_exists($key, $selected)){
        $option_attributes = array_merge($option_attributes[$key], $attributes);
      }
    }

    // HTML Build
    $options = '';
    foreach($option_attributes as $key => $attributes){
      $options .= '<options value="'.$key.'" ';
      foreach($attributes as $atr_key => $atr_val){
        if($atr_key == 'label')
          continue;
        $options .= $atr_key.'='.$atr_val.' ';
      }
      $options .= '>'.$attributes['label'].'</options>';
    }
    
    // Select Build
    $select = '<select ';
    foreach($select_attributes as $atr_key => $attributes){
      if($atr_key == 'label')
        continue;
      $select .= $atr_key.'='.$atr_val.' ';
    }
    $select .= '></select>';
  }
}
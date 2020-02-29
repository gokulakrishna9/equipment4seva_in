<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HTML_builders {
  function build_select($select_attributes=0, $option_attributes=0, $value_key='', $label_key='', $selected=0)
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
        $options .= '<option ';
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

  public function build_form($form_fields=0, $select_data=0, $form_data=0){
    $select_attributes = array(
      'class'=> 'w3-select w3-border'
    );
    $label_attributes = '';
    $input_attributes = 'class="w3-input w3-border"';
    $form_elements = array();
    if($form_fields == 0)
      return;
    foreach($form_fields as $field => $properties){
      $input_element = array();
      $label = '<label class=""><b>'.$properties[0].':</b></label>';
      $field_value = '';
      if($select_data != 0 && array_key_exists($field, $form_data))
          $field_value = $form_data[$field];
      if($properties[1] == 'select'){
        $select_attributes['name'] = $field;
        // select_attributes, option_attributes, value_key, label_key, selected
        $inpt = $this->build_select($select_attributes, $select_data[$field], $field, $properties[0], $field_value);
        $input_element[] = $label.$inpt;
      } else if($properties[1] == 'input'){
        $inpt = "<input $input_attributes type='$properties[2]' name='$field' value='$field_value'></input>";
        $input_element[] = $label.$inpt;
      }
      $form_elements[] = $input_element; 
    }
    var_dump($form_elements);
    return $form_elements;
  }

  public function build_grid($html_elements, $number_of_columns){

  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HTML_builders {
  function build_select($select_attributes=0, $option_attributes=0, $value_key='', $label_key='', $update_data='')
  {
    // Merge selected with options
    $options = '<option value="">--Select--</option>';
    if($option_attributes != 0){
      // HTML Build
      foreach($option_attributes as $key => $attributes){
        $options .= '<option ';
        $selected = '';
        if($update_data != '' && array_key_exists($select_attributes['name'], $update_data) && $attributes->$value_key == $update_data[$select_attributes['name']]){
          $selected = 'selected';
        }
        $options .= 'value="'.$attributes->$value_key.'" '.$selected.'>'.$attributes->$label_key.'</option>';
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

  public function build_form($form_fields='', $select_data='', $form_data=''){
    $select_attributes = array(
      'class'=> 'w3-select w3-border'
    );
    $label_attributes = '';
    $input_attributes = 'class="w3-input w3-border"';
    $form_elements = array();
    $form_element['hidden'] = array();
    if($form_fields == '')
      return;
    foreach($form_fields as $field => $properties){
      $field_value = '';
      $options = 0;
      $field_value = 0;
      if($select_data != '' && array_key_exists($field, $select_data))
        $options = $select_data[$field];
      if($form_data != '' && array_key_exists($field, $form_data))
        $field_value = $form_data[$field];
      if($properties[2] == 'hidden'){
        $form_elements['hidden'][] = "<input type='$properties[2]' name='$field' value='$field_value'></input>";
        continue;
      }
      $input_element = '';
      $label = '<label class=""><b>'.$properties[0].':</b></label>';
      if($properties[1] == 'select'){
        $select_attributes['name'] = $field;
        // select_attributes, option_attributes, value_key, label_key, selected
        $inpt = $this->build_select($select_attributes, $options, $properties[2], $properties[3], $form_data);
        $input_element = $label.$inpt;
      } else if($properties[1] == 'input'){
        $inpt = "<input $input_attributes type='$properties[2]' name='$field' value='$field_value'></input>";
        $input_element = $label.$inpt;
      }
      $form_elements[] = $input_element; 
    }
    return $form_elements;
  }

  public function build_grid($html_elements, $number_of_columns='3'){
    $row_properties = '';
    $column_properties = '';
    $cols_added = 1;
    $total_elements = 0;
    $grid = '';//$html_elements['hidden'];
    // Dynamic layout pending
    $grid_class = array('w3-quarter', 'w3-third', 'w3-half');
    forEach($html_elements as $key => $element){
      $total_elements++;
      if($key == 'hidden')
        continue;
      if($cols_added == $number_of_columns+1){
        $cols_added = 1;
      }
      if($cols_added == 1){
        $grid .= '<div class="w3-row w3-margin-bottom">';
      }
      $grid .= '<div class="w3-col w3-mobile w3-quarter w3-margin-right">';
      $grid .= $element;
      $grid .= '</div>';
      if($cols_added == $number_of_columns || $total_elements == sizeof($html_elements)){
        $grid .= '</div>';
      }
      $cols_added++;
    }
    forEach($html_elements['hidden'] as $hd_element)
      $grid .= $hd_element;
    return $grid;
  }
}
<?php
//total_rows
// Add pagination
$temp =explode('/', $header);
if(sizeof($temp) > 1)
  $cntrl = $temp[1];
else
  $cntrl = $temp[0];
$config['base_url'] = base_url().$cntrl;
$config['full_tag_open'] = '<span>';
$config['full_tag_close'] = '</span>';
$config['cur_tag_open'] = '<b>';
$config['cur_tag_close'] = '</b>';
$config['total_rows'] = isset($total_rows) ? $total_rows : 2000;
$config['per_page'] = isset($per_page) ? $per_page : 10;
$config['num_links'] = $config['total_rows']/$config['per_page'];
$config['enable_query_strings'] = TRUE;
$config['page_query_string'] = TRUE;
$this->pagination->initialize($config);
$form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
$frm_opn = form_open($config['base_url'], $form_attributes);
$frm_cls = form_close();
$button_data = array(
  'name' => '',
  'id' => '',
  'type' => 'submit',
  'class' => 'w3-button w3-blue'
);
echo $frm_opn;
echo $this->pagination->create_links();
?>
<select class="w3-select w3-border" style='width:50px; margin: 10px;' name="display_count">
  <option value="50" selected>50</option>
  <option value="100">100</option>
  <option value="200">200</option>
</select>
<?php echo form_button($button_data, 'Per Page'); ?>
<?php
echo $frm_cls;
?>
<?php
//total_rows
// Add pagination
$temp =explode('/', $header);
if(sizeof($temp) > 1)
  $cntrl = $temp[1];
else
  $cntrl = $temp[0];
$config['pagination_action'] = $pagination_action;
$config['total_rows'] = $total_rows;
$config['page_number'] = $page_number;
$config['per_page'] = $per_page; 
$form_attributes = array('action'=> 'post', 'class' => '', 'id' => '');
$frm_opn = form_open($config['pagination_action'], $form_attributes);
$frm_cls = form_close();
$button_data = array(
  'name' => '',
  'id' => '',
  'type' => 'submit',
  'class' => 'w3-button w3-blue'
);
?>
<div class="w3-bar w3-border w3-margin">
<?php echo $frm_opn; ?>
<span class='w3-margin w3-large'>All Records: <?php echo $total_rows; ?></span>
<span class='w3-margin'><?php echo $this->html_builders->build_pagination($config); ?></span>
<input type="text" size='2' name='per_page' value='<?php echo $per_page; ?>'></input>
<?php echo form_button($button_data, 'Per Page'); ?>
<?php echo $frm_cls; ?>
</div>

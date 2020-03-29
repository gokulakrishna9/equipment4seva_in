<!DOCTYPE html>
<html>
<title>Equipment For Seva</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url();?>assets\css_lib\w3.css">
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<style>
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
  }
</style>
<body>
  <div class="w3-row navbar">
    <div class="w3-col m12 w3-light-green">
      <h3 class='w3-margin-left'>Equipment For Seva</h3>
    </div> 
    <div class="w3-bar w3-border w3-light-grey">
        <?php $this->load->view('public_components/menu_bar', $header); ?>
    </div>
  </div>
  <div class="w3-bar w3-margin w3-padding"></div>
  <div  class="w3-bar w3-margin w3-padding">
    &nbsp;
  </div>
  <!-- Form -->
  <div  class="w3-container w3-padding">
    <div class="w3-row">
      <div class="w3-col w3-mobile s12 m12">
        <h3>Search By:</h3>
      </div>
    </div>
    <?php
    $form_fields = isset($form_fields) ? $form_fields : '';
    $update_data = isset($update_data) ? $update_data : '';
    $form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
    $frm_opn = form_open($form_action, $form_attributes);
    $frm_cls = form_close();
    $button_data = array(
      'type' => 'submit',
      'class' => 'w3-right w3-teal w3-button'
    );
    if(is_array($form_fields)){
      echo $frm_opn;
      echo $this->html_builders->build_grid($this->html_builders->build_form($form_fields, $select_data, (array)$update_data));
    }        
    ?>
    <div class="w3-row">
      <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
      </div>
      <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom"></div>
      <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom w3-margin-top">
          <?php echo form_button($button_data, 'Submit'); ?>
      </div>
    </div>
    <?php
    echo $frm_cls;
    ?>
  </div>
  <!-- Table -->
  <div style="overflow:auto;" class="w3-container">
    <?php $this->load->view('common/table'); ?>
  </div>
  <script src='<?php echo base_url();?>assets\js_lib\jquery-3.4.1.min.js'></script>
  <script src='<?php echo base_url();?>assets\js_lib\zebra_datepicker.min.js'></script>
  <script>
  /*
  <?php /*foreach($form_fields as $field => $properties){ 
      if($properties[2] == 'date'){    
  ?>
      $('#<?php echo $field; ?>').Zebra_DatePicker({
          format: 'M d, Y'
      });
  <?php }}*/ ?>
  */
  </script>
</body>
</html>
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
    <div class="w3-bar w3-border w3-light-grey">
      <?php $this->load->view('public_components/menu_bar', $header); ?>
    </div>
  </div>
  <div class="w3-bar w3-margin w3-padding"></div>
  <!-- Form -->
  <div  class="w3-container w3-padding">
    <?php
    $where_fields = isset($where_fields) ? $where_fields : '';
    $group_fields = isset($group_fields) ? $group_fields : '';
    $update_data = isset($update_data) ? $update_data : '';
    $form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
    $frm_opn = form_open($form_action, $form_attributes);
    $frm_cls = form_close();
    $button_data = array(
      'type' => 'submit',
      'class' => 'w3-right w3-teal w3-button'
    );
    if(is_array($where_fields)){
      echo $frm_opn;
      echo '<h5><b>Search By:</b><h5>';
      echo $this->html_builders->build_grid($this->html_builders->build_form($where_fields, $select_data, (array)$update_data));
    }
    if(!isset($detailed) && is_array($group_fields)){
      echo '<h5><b>Group By:</b><h5>';
      echo $this->html_builders->build_grid($this->html_builders->build_form($group_fields, $select_data, (array)$update_data));
    }    
    ?>
    <div class="w3-row">
      <div class="w3-col w3-m3">
      </div>
      <div class="w3-col w3-m3"></div>
      <div class="w3-col w3-m3"></div>
      <div class="w3-col w3-m3 w3-center-align">
        <?php echo form_button($button_data, 'Submit'); ?>
      </div>
    </div>
    <?php
    echo $frm_cls;
    ?>
  </div>
  <!-- Table -->
  <div style="overflow:auto;" class="w3-container">
    <?php 
      if(isset($detailed)){
    ?>    
    <?php $this->load->view('common/pagination'); ?>
    <?php $this->load->view('common/table'); ?>
    <?php $this->load->view('common/pagination'); ?>    
    <?php }
      else
        $this->load->view('common/group_table'); 
    ?>
  </div>
  <script src='<?php echo base_url();?>assets\js_lib\jquery-3.4.1.min.js'></script>
  <script src='<?php echo base_url();?>assets\js_lib\zebra_datepicker.min.js'></script>
  <script src='<?php echo base_url();?>assets/js_lib/jquery-3.4.1.min.js'></script>
  <script src='<?php echo base_url();?>assets/js_lib/zebra_datepicker.min.js'></script>
  <link rel='stylesheet' href='<?php echo base_url();?>assets/css_lib/theme.default.css'>
  <script type='text/javascript' src='<?php echo base_url();?>assets/js_lib/jquery.tablesorter.js'></script>
  <script type='text/javascript' src='<?php echo base_url();?>assets/js_lib/jquery.tablesorter.widgets.js'></script>
  <script>
    $(document).ready(function(){
      $("#viewRecords").tablesorter({
        cssDisabled: "disabled",
        widthFixed: true,
        widgets: ["zebra", "filter"],
        widgetOptions: {
          filter_reset: '.reset',
          // set to false because it is difficult to determine if a filtered
          // row is already showing when looking at ranges
          filter_searchFiltered: false
        }
      });
      $("#viewRecords").addClass('w3-table');
    });    
  </script>
</body>
</html>
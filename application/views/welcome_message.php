<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Equipment For Seva</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets\css_lib\w3.css">
	<style>
		.empty-div {
      height: 2cm;
		}
	</style>
</head>
<body>
<div class="w3-row">
   <div class="w3-col m12 w3-light-green">
    <h3 class='w3-margin-left'>Equipment For Seva</h3>
   </div> 
</div>
<div class="w3-row">
  <div class="w3-col m6 l4">
    &nbsp;
  </div>
  <div class="w3-col m6 l4">
    <div class="w3-card w3-light-grey">
      <h5 class="w3-center">Login</h5>
      <h5 class='w3-lite-red'><?php echo isset($error_message) ? $error_message : ''; ?></h5>
    </div>
    <?php 
    $form_action = 'welcome/authenticate_user';
      $form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
      $frm_opn = form_open($form_action, $form_attributes);
      $frm_cls = form_close();
      $button_data = array(
          'name' => 'equipment',
          'id' => 'equipment',
          'type' => 'submit',
          'class' => "w3-btn w3-blue w3-right"
      );
      echo $frm_opn;
    ?>
      <div class="w3-margin-bottom">
        <label class="w3-text-blue"><b>User Name:</b></label>
        <input class="w3-input w3-border" name='user_name' type="text" required>
      </div>
      <div class="w3-margin-bottom">
        <label class="w3-text-blue"><b>Password:</b></label>
        <input class="w3-input w3-border" name='password' type="password" required>
      </div>
      <div class="w3-row">
        <div class="w3-col m4">
          <br>
          <?php echo $captcha_image; ?>
        </div>
        <div class="w3-col m8">
          <label class="w3-text-blue"><b>Captcha:</b></label>
          <input class="w3-input w3-border" type="text" name="captcha" required>
        </div>
      </div>    
      <br>
    <?php echo form_button($button_data, 'Login'); ?>
    <?php echo $frm_cls; ?>
  </div>
  <div class="w3-col m6 l4">
    &nbsp;
  </div>
</div>
</body>
</html>
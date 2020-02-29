<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url();?>assets\css_lib\w3.css">
<style>
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
    }
</style>
<body>
    <!-- Header -->
    <div class="w3-bar w3-border w3-light-grey navbar">
        <?php $this->load->view('common/header', $header); ?>
    </div>
    <div class="w3-bar w3-margin w3-padding"></div>
    <!-- Left Nav -->
    <div class="w3-sidebar w3-bar-block w3-light-grey" style="width:15%">
        <?php $this->load->view('common/left_nav', array($header, $leftNav)); ?>
    </div>
    <div style="margin-left:15%" class="">
        &nbsp;
    </div>
    <!-- Form -->
    <div style="margin-left:15%" class="">
        <?php $this->load->view('form/equipment', $header); ?>
    </div>
    <!-- Table -->
    <div style="margin-left:15%;overflow:auto;" class="w3-container">
        <?php $this->load->view('common/table', $header); ?>
    </div>
</body>
</html>
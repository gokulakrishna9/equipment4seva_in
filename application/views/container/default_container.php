<!DOCTYPE html>
<html>
<title>W3.CSS</title>
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
    <div style="margin-left:15%" class="w3-container">
        <?php
        $update_data = isset($update_data) ? $update_data : '';
        $form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
        $frm_opn = form_open($form_action, $form_attributes);
        $frm_cls = form_close();
        $button_data = array(
            'name' => 'equipment',
            'id' => 'equipment',
            'type' => 'submit',
            'class' => 'w3-right w3-teal w3-button'
        );
        echo $frm_opn;
        echo $this->html_builders->build_grid($this->html_builders->build_form($form_fields, $select_data, (array)$update_data));
        ?>
        <div class="w3-row">
            <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
            </div>
            <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom"></div>
            <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom w3-margin-top">
                <?php echo form_button($button_data, 'Save'); ?>
            </div>
        </div>
        <?php
        echo $frm_cls;
        ?>
    </div>
    <!-- Table -->
    <div style="margin-left:15%;overflow:auto;" class="w3-container">
        <?php $this->load->view('common/table', $header); ?>
    </div>
</body>
</html>
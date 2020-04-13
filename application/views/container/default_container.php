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
    <!-- Header -->
    <div class="w3-bar w3-border w3-light-grey navbar">
        <?php $this->load->view('common/header', $header); ?>
    </div>
    <div class="w3-bar w3-margin w3-padding"></div>
    <!-- Left Nav -->
    <div class="w3-sidebar w3-bar-block w3-light-grey" style="width:15%">
        <?php $this->load->view('common/left_nav', array($header)); ?>
    </div>
    <div style="margin-left:15%" class="">
        &nbsp;
    </div>
    <?php 
        if(isset($parent_record)){
    ?>
    <div style="margin-left:15%;overflow:auto;" class="w3-container">    
    <a href='<?php echo base_url().$parent_route; ?>' class='w3-btn w3-orange'>Back</a>
    <?php
        echo $this->html_builders->build_record($parent_record);
    ?>
    </div>
    <?php
        }
    ?>
    <!-- Form -->
    <div style="margin-left:15%" class="w3-container">
        <?php
        $form_fields = isset($form_fields) ? $form_fields : '';
        $update_data = isset($update_data) ? $update_data : '';
        $form_attributes = array('action'=> 'post', 'class' => 'w3-container', 'id' => 'equipment_form');
        $frm_opn = form_open($form_action, $form_attributes);
        $frm_cls = form_close();
        $button_data = array(
            'name' => '',
            'id' => '',
            'type' => 'submit',
            'class' => 'w3-right w3-teal w3-button'
        );
        if(is_array($form_fields)){
            echo $frm_opn;
            echo $this->html_builders->build_grid($this->html_builders->build_form($form_fields, $select_data, (array)$update_data));
        }        
        ?>
        <div class="w3-row">
            <div class="w3-col w3-m3 w3-margin-right w3-margin-bottom"></div>
            <div class="w3-col w3-m3 w3-margin-right w3-margin-bottom"></div>
            <div class="w3-col w3-m3 w3-margin-right w3-margin-bottom"></div>
            <div class="w3-col w3-m3 w3-center-align w3-margin-right w3-margin-bottom w3-margin-top">
                <?php echo form_button($button_data, 'Submit'); ?>
            </div>
        </div>
        <?php
        echo $frm_cls;
        ?>
    </div>
    <!-- Table -->
    <div style="margin-left:15%;overflow:auto;" class="w3-container w3-padding">
        <?php $this->load->view('common/pagination'); ?>
        <?php $this->load->view('common/table'); ?>
        <?php $this->load->view('common/pagination'); ?>
    </div>
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
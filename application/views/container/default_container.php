<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url();?>assets\css_lib\w3.css">
<body>
    <?php 
    // Globals
    $globals = array(
        'form_class' => '',
        'form_col_divs' => '',
        'label_class' => '',
        'field_class' => '',
        'select_class' => '',
        'radio_class' => '',
        'checkbox_class' => '',
        'table_class' => ''
    );
    ?>
    <?php 
    foreach($components as $component => $data_points){
        $this->load->view($component, $data_points);
    }
    ?>
</body>
</html>
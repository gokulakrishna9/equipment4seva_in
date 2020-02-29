<?php 
$form_attributes = array('class' => 'w3-container', 'id' => 'equipment_form');
var_dump($form_action);
$frm_opn = form_open($form_action, $form_attributes);
$frm_cls = form_close();
$equipment_type_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'equipment_type_id'
);
$equipment_type_select = $this->html_builders->build_select($equipment_type_attributes, $equipment_types, 'equipment_type_id', 'equipment_type');
$donor_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'donor_id'
);
$donor_select = $this->html_builders->build_select($donor_attributes, $donors, 'donor_id', 'donor_name');
$procured_by_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'procured_by_id'
);/*
$procured_by_select = $this->html_builders->build_select($procured_by_attributes, $vendor, 'vendor_id', 'vendor_name', array($update_data[0]->procured_by_id));
$supplier_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'supplier_id'
);
$supplier_select = $this->html_builders->build_select($procured_by_attributes, $vendor, 'vendor_id', 'vendor_name');
$manufacturer_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'manufacturer_id'
);
$manufacturer_select = $this->html_builders->build_select($manufacturer_attributes, $vendor, 'vendor_id', 'vendor_name');
$equipment_status_type_attributes = array(
  'class'=> 'w3-select w3-border',
  'name' => 'functional_status_id'
);
$equipment_status_type_select = $this->html_builders->build_select($equipment_status_type_attributes, $equipment_status_types, 'equipment_status_type_id', 'equipment_status_type');
*/
$button_data = array(
  'name' => 'equipment',
  'id' => 'equipment',
  'type' => 'submit',
  'class' => 'w3-right w3-teal w3-button'
);
?>
<?php echo $frm_opn; ?>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Type:</b></label>
    <?php // echo $equipment_type_select; ?>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment:</b></label>
    <input class="w3-input w3-border" type="text" name="eq_name"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Model:</b></label>
    <input class="w3-input w3-border" type="text" name="model"></input>
  </div>  
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Serial Number:</b></label>
    <input class="w3-input w3-border" type="text" name="serial_number"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Mac Address:</b></label>
    <input class="w3-input w3-border" type="text" name="mac_address"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Asset Number:</b></label>
    <input class="w3-input w3-border" type="text" name="asset_number"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Donor:</b></label>
    <?php // echo $donor_select; ?>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Procured By:</b></label>
    <?php // echo $procured_by_select; ?>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Supplier:</b></label>
    <?php // echo $supplier_select; ?>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Manufacturer:</b></label>
    <?php // echo $manufacturer_select; ?>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Cost:</b></label>
    <input class="w3-input w3-border" type="text" name="eq_cost"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Number:</b></label>
    <input class="w3-input w3-border" type="text" name="invoice_number"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Purchase Order Date:</b></label>
    <input class="w3-input w3-border" type="text" name="purchase_order_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Date:</b></label>
    <input class="w3-input w3-border" type="text" name="invoice_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Supply Date:</b></label>
    <input class="w3-input w3-border" type="text" name="supply_date"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Installation Date:</b></label>
    <input class="w3-input w3-border" type="text" name="installation_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Status:</b></label>
    <?php // echo $equipment_status_type_select; ?>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Warranty Start Date:</b></label>
    <input class="w3-input w3-border" type="text" name="warranty_start_date"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Warranty End Date:</b></label>
    <input class="w3-input w3-border" type="text" name="warranty_end_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom"></div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom w3-margin-top">
    <?php echo form_button($button_data, 'Save'); ?>
  </div>
</div>
<?php echo $frm_cls; ?>
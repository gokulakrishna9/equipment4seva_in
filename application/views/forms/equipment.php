<?php 
$action = '';
$form_attributes = array('class' => 'w3-container', 'id' => 'equipment_form');
$frm_opn = form_open('equipment/'.$action, $form_attributes);
$frm_cls = form_close();
$equipment_type_options = array();  // selected
?>
<div style="margin-left:15%" class="">
  &nbsp;
</div>
<div style="margin-left:15%" class="">
<?php echo $frm_opn; ?>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Name:</b></label>
    <input class="w3-input w3-border" type="text" name="eq_name"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Model:</b></label>
    <input class="w3-input w3-border" type="text" name="eq_model"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Serial Number:</b></label>
    <input class="w3-input w3-border" type="text" name="serial_number"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Mac Address:</b></label>
    <input class="w3-input w3-border" type="text" name="mac_address"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Asset Number:</b></label>
    <input class="w3-input w3-border" type="text" name="asset_number"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Donor ID:</b></label>
    <input class="w3-input w3-border" type="text" name="donor_id"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Procured By ID:</b></label>
    <input class="w3-input w3-border" type="text" name="procured_by_id"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Purchase Order Date:</b></label>
    <input class="w3-input w3-border" type="text" name="purchase_order_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Equipment Cost:</b></label>
    <input class="w3-input w3-border" type="text" name="eq_cost"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Supplier ID:</b></label>
    <input class="w3-input w3-border" type="text" name="supplier_id"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Number:</b></label>
    <input class="w3-input w3-border" type="text" name="invoice_number"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Date:</b></label>
    <input class="w3-input w3-border" type="text" name="invoice_date"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Supplier ID:</b></label>
    <input class="w3-input w3-border" type="text" name="supply_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Number:</b></label>
    <input class="w3-input w3-border" type="text" name="installation_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Date:</b></label>
    <input class="w3-input w3-border" type="text" name="warranty_start_date"></input>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Supplier ID:</b></label>
    <input class="w3-input w3-border" type="text" name="warranty_start_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Number:</b></label>
    <input class="w3-input w3-border" type="text" name="warranty_end_date"></input>
  </div>
  <div class="w3-col w3-quarter w3-margin-right w3-margin-bottom">
    <label class=""><b>Invoice Date:</b></label>
    <input class="w3-input w3-border" type="text" name="equipment_status_id"></input>
  </div>
</div>
<?php echo $frm_cls; ?>
</div>

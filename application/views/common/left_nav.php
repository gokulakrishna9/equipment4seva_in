<?php 
  $all_left_nav = array(
    'equipment' => [
      'Equipment' => 'equipment',
      'Equipment Accessory' => 'equipment_accessory',
      'Service Record' => 'equipment_service_record',
      'Maintenance Contract' => 'equipment_maintenance_contract',
    ],
    'masters' => [
      'Equipment Type' => 'equipment_type',
      'Eq Functional Status' => 'equipment_functional_status',
      'Eq Procurement Status' => 'equipment_procurement_status',
      'Eq Procurement Type' => 'equipment_procurement_type',
      'Vendor Type' => 'vendor_type',
      'Vendor Contact' => 'vendor_contact',
      'Vendor' => 'vendor',
      'Place' => 'place'
    ],
    /*
    'logs' => [
      'Eq Location' => 'equipment_location_log',
      'Eq Service Record' => 'equipment_service_record_log'
    ]
    */
  );
?>
<?php
  foreach($all_left_nav[explode('/', $header)[0]] as $label => $url){
    $highlight = '';
    $temp =explode('/', $header);
    if(sizeof($temp) > 1)    
      if(preg_match("/\b".explode('/', $header)[1]."\b/i", $url))
        $highlight = 'w3-khaki';
?>
  <a href="<?php echo base_url().$url; ?>" class="w3-bar-item w3-button <?php echo $highlight ?>"><?php echo $label; ?></a>
<?php 
  }
?>
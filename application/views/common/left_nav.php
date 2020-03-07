<?php 
  $all_left_nav = array(
    'equipment' => [
      'Equipment' => base_url().'equipment',
      'Equipment Accessory' => base_url().'equipment_accessory',
      'Service Record' => base_url().'service_record',
      'Maintenance Contract' => base_url().'maintenance',
    ]
  );
?>
<?php
  foreach($all_left_nav[explode('/', $header)[0]] as $label => $url){
    $highlight = '';
    $temp =explode('/', $header);
    if(sizeof($temp) > 1)
      if(strpos($url, $temp[1]) >= 0)
        $highlight = 'w3-khaki';
?>
  <a href="<?php echo $url; ?>" class="w3-bar-item w3-button <?php echo $highlight ?>"><?php echo $label; ?></a>
<?php 
  }
?>
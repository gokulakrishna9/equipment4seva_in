<?php 
  $all_left_nav = array(
    'Equipment' => [
      'Equipment' => 'url',
      'Equipment Accessory' => 'url',
      'Service Record' => 'url',
      'Maintenance Contract' => 'url',
    ]
  );
?>
<?php 
  foreach($all_left_nav['Equipment'] as $label => $url){
?>
  <a href="<?php echo $url?>" class="w3-bar-item w3-button"><?php echo $label?></a>    
<?php 
  }
?>
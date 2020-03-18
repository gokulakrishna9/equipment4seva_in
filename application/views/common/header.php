<?php 
  $header_list = array(
    'Equipment'=> 'equipment', 
    //'Logs'=>'equipment_location_log',
    'Masters'=> 'equipment_type',
    'Settings'=>'url',
  ); 
  $logout = 'welcome/logout';
?>
<?php 
  $route = explode('/', $header);
  foreach($header_list as $label => $hdr){
    $highlight = ''; 
    if(strpos(strtolower($label), $route[0]) !== false){
      $highlight = 'w3-light-green';
    }
?>
  <a href="<?php echo base_url().$hdr; ?>" class="w3-bar-item w3-button <?php echo $highlight; ?>">
    <?php echo $label; ?>
  </a>   
  <a href=""></a> 
<?php } ?>
<a href="<?php echo base_url().$logout; ?>" class="w3-bar-item w3-right w3-button <?php echo $highlight; ?>">
  <?php echo 'Logout'; ?>
</a>   
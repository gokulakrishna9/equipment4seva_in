<?php 
  $header_list = array(
    'Equipment'=>'url', 
    'Logs'=>'url',
    'Masters'=>'url',
    'Settings'=>'url'
  ); 
?>
<?php 
  foreach($header_list as $label => $url){
?>
  <a href="<?php echo $url; ?>" class="w3-bar-item w3-button"><?php echo $label; ?></a>    
<?php } ?>
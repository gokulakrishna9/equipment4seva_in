<?php 
  $header_list = array(
    'Equipment'=> base_url().'equipment', 
    'Logs'=>'url',
    'Masters'=>'url',
    'Settings'=>'url'
  ); 
?>
<?php 
  foreach($header_list as $label => $url){
    $highlight = '';
    if(strpos($url, explode('/', $header)[0]))
      $highlight = 'w3-light-green';
?>
  <a href="<?php echo $url; ?>" class="w3-bar-item w3-button <?php echo $highlight ?>"><?php echo $label; ?></a>    
<?php } ?>
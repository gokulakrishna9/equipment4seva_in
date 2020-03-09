<?php 
  $header_list = array(
    'Equipment'=> 'equipment', 
    'Logs'=>'url',
    'Masters'=> 'service_issue_type',
    'Settings'=>'url'
  ); 
?>
<?php 
  foreach($header_list as $label => $url){
    $highlight = ''; 
    if(strpos($url, explode('/', $header)[0]) !== false){
      $highlight = 'w3-light-green';
    }
?>
  <a href="<?php echo base_url().$url; ?>" class="w3-bar-item w3-button <?php echo $highlight ?>"><?php echo $label; ?></a>    
<?php } ?>
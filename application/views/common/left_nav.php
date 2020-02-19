<div class="w3-sidebar w3-bar-block w3-light-grey" style="width:15%">
  <?php 
    foreach($left_nav as $label => $url){
  ?>
    <a href="<?php echo $url?>" class="w3-bar-item w3-button"><?php echo $label?></a>    
  <?php } ?>
</div>
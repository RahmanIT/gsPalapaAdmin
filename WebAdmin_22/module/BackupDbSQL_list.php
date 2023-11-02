<?php 
  $it2 = new FilesystemIterator($conf["DataDir"].'backup');
  foreach ($it2 as $fileinfo) {
    $sa = $fileinfo->getFilename();
	?>
    <a href="<?php echo $conf["DataDir"].'/backup/'.$sa; ?>" target="_blank">
    <button type="button" class="btn btn-lg btn-primary"><?php echo $sa; ?></button><br/> <br/> 
    </a>  
    <?php
 }
?>
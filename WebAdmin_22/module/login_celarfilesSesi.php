<?php 
$file1 = $conf["DataDir"]."sesion/".$segmen3.'.json';	
	if(file_exists($file1)){
		unlink($file1);
  }else{
	  include("404.html");
	}
?>
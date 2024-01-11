<?php 
if(isset($segmen3) && $segmen3!=""){
$file = str_replace("%20"," ", $segmen3);
$file1 = $conf["DataDir"]."sesion/".$file.'.json';	
	if(file_exists($file1)){
		$fileData = exif_read_data($file1);
		header("Content-Type:application/json");
		readfile($file1);
	}else{ include("404.html");}
}else{ include("404.html");}
?>
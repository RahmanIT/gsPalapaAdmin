<?php 
if(isset($segmen3) && $segmen3!=""){
$file = str_replace("%20"," ", $segmen3);
$file1 = $conf["DataDir"]."download/".$file;	
$format = substr($file, -6,6);
$fext = explode(".",$format);
	if($fext[1]=="jpg"){						
		$fileData = exif_read_data($file1);
		header("Content-Type: " . $fileData["MimeType"]);
		header("Content-Length: " . $fileData["FileSize"]);
		readfile($file1);
	}else if(($fext[1]=="png")){						
		$fileData = exif_read_data($file1);
		header("Content-Type:image/png");
		readfile($file1);
	}else if(($fext[1]=="pdf")){
		$fileData = exif_read_data($file1);
		header("Content-Type:application/pdf");
		readfile($file1);
	}else if(($fext[1]=="zip")){
		$fileData = exif_read_data($file1);
		header("Content-Type:application/zip");
		readfile($file1);
	}else{ include("404.html");}
}else{ include("404.html");}
?>
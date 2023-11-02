<?php 
if(isset($segmen3) && $segmen3!=""){
$foto = str_replace("%20"," ", $segmen3);
$file = $conf["DataDir"]."files/".$foto;
$format = substr($foto, -6,6);
$fext = explode(".",$format);
	if($fext[1]=="jpg"){						
		$fileData = exif_read_data($file);
		header("Content-Type: " . $fileData["MimeType"]);
		header("Content-Length: " . $fileData["FileSize"]);
		readfile($file);
	}else if(($fext[1]=="png")){						
		$fileData = exif_read_data($file);
		header("Content-Type:image/png");
		readfile($file);
	}else if(($fext[1]=="jpeg")){						
		$fileData = exif_read_data($file);
		header("Content-Type:image/jpeg");
		readfile($file);
	}else{ include("404.html");};
}else{ include("404.html");}
?>

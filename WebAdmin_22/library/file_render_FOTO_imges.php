<?php 
if(isset($segmen3) && $segmen4!=""){
$foto = str_replace("%20"," ", $segmen4);
$file = $conf["DataDir"]."images/".$segmen3."/".$foto;
$format = substr($foto, -4,6);
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
	}else{ include("404.html");};
};
?>

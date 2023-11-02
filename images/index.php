<?php 
if(isset($segmen3) && $segmen4!=""){
$foto = str_replace("%20"," ", $segmen4);
$file = $DataDir."images/".$segmen3."/".$foto;						
$fileData = exif_read_data($file);
header("Content-Type: " . $fileData["MimeType"]);
header("Content-Length: " . $fileData["FileSize"]);
readfile($file);
}
?>

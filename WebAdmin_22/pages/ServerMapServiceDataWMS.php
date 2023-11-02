<?php error_reporting(0);  if(($P[0]["ROLE"]>=2) && ($P[0]["ROLE"]<=3) && ($P[0]["EMAIL"]!="") && (strlen($P[0]["NAMA"])) > 15){ 
$fileXml = $_GET["Srv"]; 
$xml=simplexml_load_file($fileXml) or die("Error: Gagal membuat list");
echo "<div><i>Ditemukan : ".  $xml->count()." item </i></div>";
foreach($xml->children() as $child)
  {
   $UrlSrv = $xml->layer[$i]->name;	  
  } 	  
} ?>
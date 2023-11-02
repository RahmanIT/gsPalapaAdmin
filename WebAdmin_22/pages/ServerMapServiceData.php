<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$colname_RsSrv = "-1";
if (isset($_GET['Srv'])) {
  $colname_RsSrv = etSQLValueString($Congis,$_GET['Srv'], "int");
}
$query_RsSrv = sprintf("SELECT SRV_ID, URL_GeoServer, Srv_Type FROM tb_geoserver WHERE SRV_ID = %s",$colname_RsSrv);
$RsSrv = mysqli_query($Congis, $query_RsSrv) or die(mysqli_error());
$row_RsSrv = mysqli_fetch_assoc($RsSrv);
$totalRows_RsSrv = mysqli_num_rows($RsSrv);
?>
<?php   

if ($row_RsSrv['Srv_Type']== 'ArcgisServer'){
	
//===========  ARCGIS SERVE TYPE ===================================================

$fileXml = $row_RsSrv['URL_GeoServer']."?f=sitemap"; 
$xml=simplexml_load_file($fileXml) or die("Error: Gagal membuat list");
//echo $xml->getName() . "<br>";
$i=0;
echo "<div><i>Ditemukan : ".  $xml->count()." item </i></div>";
?>
<div class="table-responsive">
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Map Service</th>
            <th>Type</th>
            <th>Geovista</th>
            <th>Katalog</th>
        </tr>
    </thead>
    <tbody>
 <?php
foreach($xml->children() as $child)
  {
   $UrlSrv = $xml->url[$i]->loc;
   $Serivice = explode("/",$UrlSrv);
   $Cnt = sizeof($Serivice);
   $TypS = $Serivice[$Cnt-1];
   $NmSrv =  str_replace('_', ' ', $Serivice[$Cnt-2]); 
   $NamaGeo = $Serivice[$Cnt-2];
   
   $cekData  = mysqli_result(mysqli_query($Congis, "SELECT COUNT(ID) FROM tb_mapservice where URL_SERVICE='$UrlSrv'"), 0);
   if($cekData==0){
	   $tbl = "<td><a href=".$nama_folder.'/WebAdmin/Peta.jsp/?UrlS='.$UrlSrv.'&type='.$TypS.'&Nama='.$NamaGeo."><button type=\"button\" class=\"btn btn-primary\">Publikasikan</button></a></td>";
	   }else{
		$tbl ="<td><button type='button' class='btn btn-default'>Terpublikasi</button></td>";
	   }
   echo"<tr>
          <td><a href=".$UrlSrv.' target="_blank">'.$NmSrv.'</a>'."</td>
          <td>".$TypS."</td>".
          $tbl.
           "<td><a href=".$nama_folder.'/WebAdmin/Add-Metadata.jsp/?UrlS='.$UrlSrv.'&type='.$TypS.'&Nama='.$NamaGeo."><button type=\"button\" class=\"btn btn-success\">Metadata</button></a></td>
        </tr>"; 
  $i++;}
  
}else {
//===========  GEOSERVER TYPE ===================================================	
//echo "Server url:".$row_RsSrv['URL_GeoServer'];
$url = $row_RsSrv['URL_GeoServer']."/ows?service=wms&version=1.3.0&request=GetCapabilities";
$file = file_get_contents($url);
$layer = json_decode($file,true);
//var_dump($layer);
 for ($i = 0; $i < count($layer['layers']['layer']); $i++) {
	echo $i." > " .$layer['layers']['layer'][$i]['name']."<br>";
}
}

mysqli_free_result($RsSrv);
?>
<?php } ?>                                
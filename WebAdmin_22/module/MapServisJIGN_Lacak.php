<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){  
	$colname_Recordset1 = "-1";
	if (isset($_GET['Srv'])) {
	  $colname_Recordset1 = $_GET['Srv'];
	}
	$query_Recordset1 = sprintf("SELECT SERVICE_URL,TYPE FROM tb_jdsn WHERE KD_JDSN = %s",$colname_Recordset1);
	$Recordset1 = mysqli_query($Congis, $query_Recordset1) or die(mysqli_error());
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
	
	if($row_Recordset1['TYPE']=="ESRI"){   
	$fileXml =$row_Recordset1['SERVICE_URL']."?f=sitemap"; 
	$xml=simplexml_load_file($fileXml) or die("Error: Gagal membuat list");
	//echo $xml->getName() . "<br>";
	$i=0;
	echo $fileXml.'<br/>';
	echo "<div><i>Ditemukan : ".  $xml->count()." item </i></div>";
	?>
	<table class="table table-hover table-striped" style="max-width:450px;">
	<tbody >
	 <tr>
	<?php
	foreach($xml->children() as $child)
	  {
	   $UrlSrv = $xml->url[$i]->loc;
	   $Serivice = explode("/",$UrlSrv);
	   $Cnt = sizeof($Serivice);
	   $TypS = $Serivice[$Cnt-1];
	   $NmSrv =  str_replace('_', ' ', $Serivice[$Cnt-2]); 
	   $NamaGeo = $Serivice[$Cnt-2];	   
	   if($TypS=='MapServer'){
		   $TypS = 'Dynamic';
		}
		   $cekData  = mysqli_result(mysqli_query($Congis, "SELECT COUNT(URL_SERVIS) FROM tb_mapservis_jign where URL_SERVIS='$UrlSrv'"), 0);
		   if($cekData==0){
				echo '<tr><th>'.$NmSrv.'('.$TypS.")<th/><th><button id='SrvID$i' onClick=\"TransferData($i,'$NmSrv','$TypS','$UrlSrv','$_GET[Srv]',0)\" type='button' class='btn btn-primary'>Add</button></th></tr>";
		   }else{
				echo '<tr><th>'.$NmSrv.'('.$TypS.")<th/><th><button id='SrvID$i' type='button' class='btn btn-success'>Tersimpan</button></th></tr>";
		   }
		$i++;
		}
	?>	
	</table>
      <?php }?>
      <?php if($row_Recordset1['TYPE']=="OGC"){
		  $fileXml = $row_Recordset1['SERVICE_URL']."/ows?service=wms&version=1.3.0&request=GetCapabilities"; 
			//echo $fileXml;
			//error_reporting(0);
			$TypS = "OGC";
			$xml=simplexml_load_file($fileXml) or die('<div class="alert alert-danger" role="alert">Gagal memuat data, time out!</div>');
			echo "<div><i>Ditemukan : ". $xml->Capability->Layer->Layer->count()." item </i></div>";
			echo '<table id="tbGeoService" class="table table-striped table-hover" style="max-width:450px;">';
			for ($x = 0; $x < count($xml->Capability->Layer->Layer); $x++) { 
			$urlHost = explode("/",$_GET["url"]);
			$lyName = $xml->Capability->Layer->Layer[$x]->Name;
			$sch = explode(":",$lyName);
			$lyNameOke = $xml->Capability->Layer->Layer[$x]->Name;
			$schem = $sch[0];
			$lyNm = $sch[1];
			$Lytitle = $xml->Capability->Layer->Layer[$x]->Title;
			$Lycrs= $xml->Capability->Layer->Layer[$x]->CRS;
			$wbl = $xml->Capability->Layer->Layer[$x]->EX_GeographicBoundingBox->westBoundLongitude;
			$ebl = $xml->Capability->Layer->Layer[$x]->EX_GeographicBoundingBox->eastBoundLongitude;
			$sbl = $xml->Capability->Layer->Layer[$x]->EX_GeographicBoundingBox->southBoundLatitude;
			$nbl = $xml->Capability->Layer->Layer[$x]->EX_GeographicBoundingBox->northBoundLatitude;
			$sty = $xml->Capability->Layer->Layer[$x]->Style -> Name; 
			$url = $row_Recordset1['SERVICE_URL'].'/'.$schem.'/wms?';
				$cekData  = mysqli_result(mysqli_query($Congis, "SELECT COUNT(URL_SERVIS) FROM tb_mapservis_jign where URL_SERVIS='$url' and PARAMS='$lyName'"), 0);
				if($cekData==0){
					echo "<tr><th>$Lytitle<th/><th><button id='SrvID$x' onClick=\"TransferDataOGC($x,'$Lytitle','$url','$TypS',$colname_Recordset1, 0, '$lyName','$wbl','$sbl','$ebl','$nbl','$Lycrs','$sty','$schem')\" type='button' class='btn btn-primary'>Add</button></th></tr>";
				}else{
					echo '<tr><th>'.$NmSrv.'('.$TypS.")<th/><th><button id='SrvID$i' type='button' class='btn btn-success'>Tersimpan</button></th></tr>";
			   }
			}
		  ?>
      
      <?php } ?>
	<?php
	mysqli_free_result($Recordset1);
	?>
<?php } ?>
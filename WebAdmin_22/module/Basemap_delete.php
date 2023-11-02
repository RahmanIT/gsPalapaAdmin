<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$kdDel = $_GET["p"];
	 $queary = sprintf("DELETE from basemap_layer WHERE KDMAP=%s",GetSQLValueString($Congis,$kdDel, "int"));
	$hsl = mysqli_query($Congis, $queary) or die(mysqli_error());
	if(isset($hsl)){
	  echo "0";
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	 $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Delete Basemap layer $Foto dengan kode $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
	?>
<?php } ?>
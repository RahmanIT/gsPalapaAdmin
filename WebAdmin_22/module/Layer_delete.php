<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$kdDel = $_GET["p"];
	$query = sprintf("DELETE from layermap WHERE Id=%s", GetSQLValueString($Congis,$kdDel, "text"));
	$hsl = mysqli_query($Congis, $query);
	if(isset($hsl)){
	  echo "0";
	  $tglNf = date("Y-m-d H:m:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Delete Layer WEB GIS on index $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 } ?>
<?php } ?>
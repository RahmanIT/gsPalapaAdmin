<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
		$updateSQL = sprintf("INSERT INTO layermap(LABEL, URL, TITLE, LYNAME, TYPE, VISIBLE, LYR_IDX, LOGIN_ST) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,$_POST["NAMA"], "text"),
		GetSQLValueString($Congis,$_POST["URL"], "text"),
		GetSQLValueString($Congis, $_POST["LyName"], "text"),
		GetSQLValueString($Congis, $_POST['LyName2'], "text"),
		GetSQLValueString($Congis,$_POST["MapType"], "text"),
		GetSQLValueString($Congis, $_POST["CboVisible"], "date"),
		GetSQLValueString($Congis, $_POST["LyIndex"], "int"),
		GetSQLValueString($Congis, $_POST['CboLogin'], "text"));
	$s = mysqli_query($Congis, $query) or die(mysqli_error());
	$wkt = time();
	$tglNf = date("Y-m-d H:i:s");
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,22, "int"),
	GetSQLValueString($Congis,"Menambahkan Layer WEB GIS  nama layer  $_POST[NAMA] type $_POST[MapType] WMS= $_POST[LyName]", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
 } ?>
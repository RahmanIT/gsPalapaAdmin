<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){ 
	$tglNf = date("Y-m-d H:i:s");
	$insertSQL = sprintf("INSERT INTO tb_mapservis_jign (NM_SERVIS, URL_SERVIS, PARAMS, TYPE_SERVIS, TANGGAL, KD_JDSN, KD_USER, MINX, MINY, MAXX, MAXY, WORKSPACES, CRSID, LYSTYLE) VALUES (%s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s)",
	GetSQLValueString($Congis,$_POST['NmWMS'], "text"),
	GetSQLValueString($Congis,$_POST['UrlWMS'], "text"),
	GetSQLValueString($Congis,$_POST['NtvLayer'], "text"),
	GetSQLValueString($Congis,$_POST['CboType'], "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$_POST['JIGN'], "int"),
	GetSQLValueString($Congis,0, "int"),
	GetSQLValueString($Congis,$_POST['MINX'], "text"),
	GetSQLValueString($Congis,$_POST['MINY'], "text"),
	GetSQLValueString($Congis,$_POST['MAXX'], "text"),
	GetSQLValueString($Congis,$_POST['MAXY'], "text"),
	GetSQLValueString($Congis,$_POST['SCHEMA'], "text"),
	GetSQLValueString($Congis,$_POST['SRSID'], "text"),
	GetSQLValueString($Congis,$_POST['LYSTYLE'], "text"));
	$Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,22, "int"),
	GetSQLValueString($Congis,"Menambahkan Map Servis WMS $_POST[NmWMS]", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
 } ?>
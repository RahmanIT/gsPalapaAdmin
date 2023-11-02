<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	 $tglNf = date("Y-m-d H:i:s");
	  $insertSQL = sprintf("UPDATE tb_mapservis_jign set NM_SERVIS=%s, URL_SERVIS=%s, TYPE_SERVIS=%s, TANGGAL=%s, KD_JDSN=%s, KD_USER=%s WHERE KD_SRV=%s",
					GetSQLValueString($Congis,$_POST['NmWMS'], "text"),
					GetSQLValueString($Congis,$_POST['UrlWMS'], "text"),
					GetSQLValueString($Congis,$_POST['CboType'], "text"),
					GetSQLValueString($Congis,$tglNf, "date"),
					GetSQLValueString($Congis,$_POST['JIGN'], "int"),
					GetSQLValueString($Congis,$_POST['WaliData'], "int"),
					GetSQLValueString($Congis, $_POST['TxtIdWMS'], "int"));
	  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,24, "int"),
		GetSQLValueString($Congis,"Update peta WMS  $_POST[NmWMS] kode $_POST[TxtIdWMS]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
 } ?>
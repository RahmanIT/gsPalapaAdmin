<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$updateSQL = sprintf("UPDATE tb_shafile_zip SET AKSES='%s' WHERE KD_FILE=%s",
				GetSQLValueString($Congis,$_GET['data'],"text"),
				GetSQLValueString($Congis,$_GET['kd'],"int"));
	$Result1 = mysql_query($Congis, $updateSQL) or die(mysql_error());
	if (isset($Result1)){		
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,3, "int"),
				GetSQLValueString($Congis,"Update Hak Akses $_GET[kd] menjadi $_GET[data]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
} ?>
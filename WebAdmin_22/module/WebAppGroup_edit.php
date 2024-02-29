<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	$query=sprintf("UPDATE tb_modelling_group SET KD_MODEL=%s, NAMAGROUP=%s, KETERNGAN=%s, AKSES=%s, PRIORITAS=%s WHERE KDGROUP=%s",
			GetSQLValueString($Congis,$_POST["CboAp"], "int"),
			GetSQLValueString($Congis,$_POST["NAMAGROUP"], "text"),
			GetSQLValueString($Congis,$_POST["KETERNGAN"], "text"),
			GetSQLValueString($Congis,$_POST["AKSES"], "text"),
			GetSQLValueString($Congis, $_POST["PRIORITAS"], "int"),
			GetSQLValueString($Congis,$_POST["KdID"], "int"));
	$s = mysqli_query($Congis, $query) or die(mysqli_error());
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,25, "int"),
		GetSQLValueString($Congis,"Updating Web App Data Group Layer dengan nama  ".$_POST["NAMAGROUP"]." on kode index ".$_POST["KdID"], "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} ?>
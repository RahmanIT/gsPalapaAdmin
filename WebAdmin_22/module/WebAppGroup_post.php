<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	$query= sprintf("INSERT INTO tb_modelling_group(KD_MODEL, NAMAGROUP, KETERNGAN, AKSES, PRIORITAS,KD_USER) VALUES (%s,%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,$_POST["CboAp"], "int"),
			GetSQLValueString($Congis,$_POST["NAMAGROUP"], "text"),
			GetSQLValueString($Congis,$_POST["KETERNGAN"], "text"),
			GetSQLValueString($Congis,$_POST["AKSES"], "text"),
			GetSQLValueString($Congis, $_POST["PRIORITAS"], "int"),
			GetSQLValueString($Congis, $P[0]["KD_USER"], "int"));	
	mysqli_query($Congis, $query) or die(mysqli_error());
	$wkt = time();
	$tglNf = date("Y-m-d H:i:s");
	$nmA = $P[0]["INISIAL"];
			$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,25, "int"),
			GetSQLValueString($Congis,"Menambhkan Layers Group  baru bernama ".$_POST["NAMAGROUP"]." on ".$_POST["KETERNGAN"], "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
 } ?>
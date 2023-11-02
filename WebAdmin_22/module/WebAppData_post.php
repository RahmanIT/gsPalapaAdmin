<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	$query= sprintf("INSERT INTO tb_modelling_data(KD_MODEL, NM_MAP, URL_MAP, LY_NAME, VISIBLE, TYPE, MAPIDX, LY_EXTEND) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,$_POST["CboAp"], "int"),
			GetSQLValueString($Congis,$_POST["NM_PETA"], "text"),
			GetSQLValueString($Congis,$_POST["URL_SERVICE"], "text"),
			GetSQLValueString($Congis,$_POST["LY_NAME"], "text"),
			GetSQLValueString($Congis, $_POST["DEFAULT_SHW"], "text"),
			GetSQLValueString($Congis,$_POST["TYPE_SERVICE"], "text"),
			GetSQLValueString($Congis,$_POST["IDX_SERVICE"], "int"),
			GetSQLValueString($Congis,$_POST["LY_EXTD"], "text"));
	
	mysqli_query($Congis, $query) or die(mysqli_error());
	$wkt = time();
	$tglNf = date("Y-m-d H:i:s");
	$nmA = $P[0]["INISIAL"];
			$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,25, "int"),
			GetSQLValueString($Congis,"Menambhkan WEB APP  baru bernama ".$_POST["NM_PETA"]." on ".$_POST["LY_NAME"], "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
 } ?>
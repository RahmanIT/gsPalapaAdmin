<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	$query=sprintf("UPDATE tb_modelling_data SET  KD_MODEL=%s, NM_MAP=%s, URL_MAP=%s, LY_NAME=%s, VISIBLE=%s, TYPE=%s, MAPIDX=%s, LY_EXTEND=%s, KDGROUP=%s WHERE KDMAP=%s",
			GetSQLValueString($Congis,$_POST["CboAp"], "int"),
			GetSQLValueString($Congis,$_POST["NM_PETA"], "text"),
			GetSQLValueString($Congis,$_POST["URL_SERVICE"], "text"),
			GetSQLValueString($Congis,$_POST["LY_NAME"], "text"),
			GetSQLValueString($Congis, $_POST["DEFAULT_SHW"], "text"),
			GetSQLValueString($Congis,$_POST["TYPE_SERVICE"], "text"),
			GetSQLValueString($Congis,$_POST["IDX_SERVICE"], "int"),
			GetSQLValueString($Congis,$_POST["LY_EXTD"], "text"),
			GetSQLValueString($Congis,$_POST["KDGROUP"], "int"),
			GetSQLValueString($Congis,$_POST["KdID"], "int"));
	$s = mysqli_query($Congis, $query) or die(mysqli_error());
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,25, "int"),
		GetSQLValueString($Congis,"Updating Web App Data-Layer Modelling  ".$_POST["NM_PETA"]." on kode ".$_POST["KdID"], "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} ?>
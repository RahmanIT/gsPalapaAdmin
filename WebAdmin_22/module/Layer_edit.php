<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$updateSQL = sprintf("UPDATE layermap SET  LABEL=%s, URL=%s, TITLE=%s, LYNAME=%s, TYPE=%s, VISIBLE=%s, LYR_IDX=%s, LOGIN_ST=%s WHERE Id=%s",
  GetSQLValueString($Congis,$_POST["NAMA"], "text"),
  GetSQLValueString($Congis,$_POST["URL"], "text"),
  GetSQLValueString($Congis, $_POST["LyName"], "text"),
  GetSQLValueString($Congis, $_POST['LyName2'], "text"),
  GetSQLValueString($Congis,$_POST["MapType"], "text"),
  GetSQLValueString($Congis, $_POST["CboVisible"], "date"),
  GetSQLValueString($Congis, $_POST["LyIndex"], "int"),
  GetSQLValueString($Congis, $_POST['CboLogin'], "text"),
  GetSQLValueString($Congis, $_POST['KDMAP'], "int"));
	$s = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
	echo $s;
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,4, "int"),
	GetSQLValueString($Congis,"Updating Layer WEB GIS  nama layer  $_POST[NAMA] type $_POST[MapType] WMS= $_POST[LyName]", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
} ?>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ 
$kdDel = GetSQLValueString($Congis,$_GET["p"], "int");
$Foto = mysqli_result(mysqli_query($Congis, "SELECT IMAGE FROM tb_feture WHERE KD_FEATURE=$kdDel"), 0); 
 unlink($conf["DataDir"]."images/peta/80x80_".$Foto);
 unlink($conf["DataDir"]."images/peta/300x250_".$Foto);
 unlink($conf["DataDir"]."images/peta/800x600_".$Foto);
$query =  sprintf("DELETE from tb_feature_lyr WHERE KD_FEATURE=%s",GetSQLValueString($Congis,$_GET["p"], "int"));
mysqli_query($Congis, $query);
$query1 =  sprintf("DELETE from tb_feture WHERE KD_FEATURE==%s",GetSQLValueString($Congis,$_GET["p"], "int"));
$hsl = mysqli_query($Congis, $query1);
if(isset($hsl)){
    echo "0"; 
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,4, "int"),
			GetSQLValueString($Congis,"Delete Feature Acces $Foto on index $kdDel", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
 }
}?>

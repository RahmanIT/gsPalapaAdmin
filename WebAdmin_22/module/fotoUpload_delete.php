<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$kdDel = GetSQLValueString($Congis,$_GET["p"], "text");
$Foto = mysqli_result(mysqli_query($Congis, "SELECT FOTO FROM tb_fhoto_explor WHERE KD=$kdDel"), 0); 
unlink($conf["DataDir"]."files/".$Foto);
$Qrt = sprintf("DELETE from tb_fhoto_explor WHERE KD=%s", GetSQLValueString($Congis,$kdDel, "text"));
$hsl = mysqli_query($Congis, $Qrt);
	if(isset($hsl)){
	  echo "0";
	   mysqli_select_db($database_Confdbms, $Congis);
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Delete files $Foto on index $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
}
?>

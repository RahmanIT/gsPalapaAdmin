<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ 
	$kdDel = $_GET["p"];
	$Foto = mysqli_result(mysqli_query($Congis,"SELECT FILE_NAME FROM tb_download WHERE KD_FILE=$kdDel"), 0); 
	unlink($conf["DataDir"]."download/".$Foto);
	$query = sprintf("DELETE from tb_download WHERE KD_FILE=%s",GetSQLValueString($Congis,$_GET["p"], "int"));
	$hsl = mysqli_query($Congis, $query);
	if(isset($hsl)){
		echo "0";
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"elete files $Foto on index $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
	?>
<?php } ?>
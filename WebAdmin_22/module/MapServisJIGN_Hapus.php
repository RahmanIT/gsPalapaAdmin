<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){
	$kdDel = $_GET["p"];
	$remote_file = $_GET["n"];
	$query= sprintf("DELETE from tb_mapservis_jign WHERE KD_SRV ==%s",GetSQLValueString($Congis,$kdDel, "int"));
	$hsl = mysqli_query($Congis, $query);
	if(isset($hsl)){
	  echo "0";
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA =$P[0]["INISIAL"];
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,12, "int"),
			GetSQLValueString($Congis,"Delete WMS JIGN index $kdDel", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
	}
} ?>
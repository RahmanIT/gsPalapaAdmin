<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	if ((isset($_GET["name"])) && ($_GET["name"]!="")) {
	$insertSQL = sprintf("INSERT INTO tb_link (NAMA, URL) VALUES (%s, %s)", GetSQLValueString($Congis,$_GET['name'], "text"), GetSQLValueString($Congis,$_GET['u'], "text"));
	$Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	if (isset($Result1)){
		echo 1;
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,14, "int"),
		GetSQLValueString($Congis,"Menambahkan link baru $_GET[name] dengan sumber $_GET[u]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	}
	}
} ?>
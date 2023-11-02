<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$kd = $_GET['s'];
	$nama = $_GET['name'];
	$n = $_GET['u'];
	$UpdateSQL = sprintf("UPDATE tb_link SET NAMA=%s, URL=%s WHERE KD_LINK=%s", GetSQLValueString($Congis,$_GET['name'], "text"),GetSQLValueString($Congis,$_GET['u'], "text"), GetSQLValueString($Congis,$kd, "int"));
	$ks = mysqli_query($Congis, $UpdateSQL);
	if(isset($ks)){
	echo 1;
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,14, "int"),
		GetSQLValueString($Congis,"Updating link $_GET[name] dengan sumber $_GET[u]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	}
	?>
<?php } ?>
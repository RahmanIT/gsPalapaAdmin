<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
 $kd = $_GET['Index'];
 $query  = sprintf("UPDATE tb_user_petadwn SET STS_K=%s WHERE ID=%s",
 			GetSQLValueString($Congis,4, "text"),
			GetSQLValueString($Congis,$_GET['Index'], "int"));
 mysql_query($Congis,$query);
 
 	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,12, "int"),
			GetSQLValueString($Congis,"user di tolak $kd", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
}?>
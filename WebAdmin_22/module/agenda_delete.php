<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	$kdDel = $_GET["p"];
	$query = sprintf("DELETE from tb_agenda WHERE KD=%s",GetSQLValueString($Congis,$_GET["p"], "int"));
	$hsl = mysqli_query($Congis, $query);
	if(isset($hsl)){
	  echo "0";
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	 // mysqli_query($Congis, "INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('4','Agenda acara delete index record = $kdDel ','$tglNf','$wkt','$nmA')");
	   $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Agenda acara delete index record =  $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
	?>
 <?php } ?>
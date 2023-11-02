<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	$kdDel = GetSQLValueString($Congis, $_GET["p"], "int");
	$Foto = mysqli_result(mysqli_query($Congis, "SELECT FOTO FROM tb_slideshow WHERE ID_SLD=$kdDel"), 0); 
	 unlink($conf["DataDir"]."images/SlideShow/120x40_".$Foto);
	 unlink($conf["DataDir"]."images/SlideShow/1200x400_".$Foto);
	 $query = sprintf("DELETE from tb_slideshow WHERE ID_SLD=%s",GetSQLValueString($Congis,$kdDel, "int"));
	$hsl = mysqli_query($Congis, $query) or die(mysqli_error());
	if(isset($hsl)){
	  echo "0";
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Delete slide show index $Foto $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
}?>
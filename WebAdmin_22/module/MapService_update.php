<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){ 
	  $updateSQL = sprintf("UPDATE tb_mapservice SET NM_SERVICE=%s, URL_SERVICE=%s, TYPE_S=%s, TANSPARAN=%s, LEGEND=%s, START_OPT=%s, NO_IDX=%s  WHERE ID=%s",
						    GetSQLValueString($Congis,$_POST["NM_PETA"], "text"),
						   GetSQLValueString($Congis,$_POST["URL_SERVICE"], "text"),
						   GetSQLValueString($Congis,$_POST["TYPE_SERVICE"], "text"),
						   GetSQLValueString($Congis,$_POST["TRANSPARAN"], "text"),
						   GetSQLValueString($Congis,$_POST["LEGEND_SHW"], "text"),
						   GetSQLValueString($Congis,$_POST["DEFAULT_SHW"], "text"),
						   GetSQLValueString($Congis,$_POST["IDX_SERVICE"], "text"),						   
						   etSQLValueString($Congis,$_POST['KdID'], "int"));
	
	  $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
	  if (isset($Result1)){
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,12, "int"),
			GetSQLValueString($Congis,"Updating MAp Service $_POST[JUDUL]", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
		 }
}
?>
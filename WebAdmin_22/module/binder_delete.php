<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ 
	 $kdDel = $_GET["p"];
	 $Foto = mysqli_result(mysqli_query($Congis, "SELECT FOTO FROM tb_binder WHERE KD=$kdDel"), 0); 
	 unlink($conf["DataDir"]."images/upload/250x60_".$Foto);
	 $query = sprintf("DELETE from tb_binder WHERE KD=%s",GetSQLValueString($Congis,$_GET["p"], "int"));
	 $hsl = mysqli_query($Congis, $query);
	if(isset($hsl)){
	  echo "0";
	   mysqli_select_db($Congis, $database_Confdbms);
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,4, "int"),
		GetSQLValueString($Congis,"Menghapus Binder $Foto index $kdDel", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
 } ?>

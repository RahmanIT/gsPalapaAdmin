<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$query = sprintf("UPDATE tb_modelling SET NM_TABEL=%s, GPS_MODE=%s WHERE KD_MODEL=%s",
	GetSQLValueString($Congis,$_POST["NAMA_TB"], "text"),
	GetSQLValueString($Congis,$_POST["customSwitch1"], "text"),
	GetSQLValueString($Congis,$_POST["CboAp"], "int"));
	$hasil = mysqli_query($Congis, $query);
	if($hasil ==1){
		echo 'berhasil '.$_POST["customSwitch1"];
	}
}; ?>
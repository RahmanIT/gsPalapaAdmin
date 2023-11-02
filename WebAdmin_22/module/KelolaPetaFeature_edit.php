<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	  $updateSQL = sprintf("UPDATE tb_feature_edit SET NM_FEATURE=%s, URL_FEATURE=%s, AKSES=%s WHERE KD_FT=%s",
							GetSQLValueString($Congis,$_POST['NmFeature'],"text"), 
						   GetSQLValueString($Congis,$_POST['UrlFeature'],"text"), 
						   GetSQLValueString($Congis,$_POST['TxtAksesOP'], "text"),
						   GetSQLValueString($Congis,$_POST['TxtKdFt'],"int"));
	
	$Result1 = mysqli_query($updateSQL, $Congis) or die(mysqli_error());
	if (isset($Result1)){
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,12, "int"),
				GetSQLValueString($Congis,"Updating Feature Service $_POST[NmFeature]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	  			mysqli_query($Congis, $Query);	 
	}
}
?>
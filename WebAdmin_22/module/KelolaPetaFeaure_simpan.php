<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$tglNf = date("Y-m-d H:i:s");
	  $insertSQL = sprintf("INSERT INTO tb_feature_edit (NM_FEATURE, URL_FEATURE, AKSES, TANGGAL, KD_USER) VALUES (%s, %s, %s, %s, %s)",
						   GetSQLValueString($Congis,$_POST['NmFeature'],"text"), 
						   GetSQLValueString($Congis,$_POST['UrlFeature'], "text"),
						   GetSQLValueString($Congis,$_POST['TxtAksesOP'], "text"),
						   GetSQLValueString($Congis,$tglNf, "date"),
						   GetSQLValueString($Congis,$P[0]["KD_USER"], "int"));
	$Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	if (isset($Result1)){
	 echo "Berhasil Menyimpan";
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,23, "int"),
				GetSQLValueString($Congis,"Menambahkan Feautur Data $_POST[NmFeature] dengan sumber $_POST[uRLFeature]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	  			mysqli_query($Congis, $Query);
	 }
} ?>
<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ 
	if ((isset($_POST["NAMA"])) && ($_POST["NAMA"]!="")) {
	mysqli_select_db($Confdbms, $database_Confdbms);
	$insertSQL = sprintf("UPDATE tb_kategori SET NAMA=%s, KETERANGAN=%s, KTG_ICON=%s WHERE KD_KATEGORI=%s",
	      			GetSQLValueString($Confdbms,$_POST["NAMA"], "text"),
					GetSQLValueString($Confdbms,$_POST["KET"], "text"),
					GetSQLValueString($Confdbms,$_POST["FaIcon"], "text"),
					GetSQLValueString($Confdbms,$_POST["KD"], "int"));
	mysqli_query($Confdbms, $insertSQL);
	mysqli_select_db($Confdbms, $database_Confdbms);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Confdbms,19, "int"),
		GetSQLValueString($Confdbms,"Updating kategori $_POST[NAMA] dan kode data $_POST[KD]", "text"),
		GetSQLValueString($Confdbms,$tglNf, "date"),
		GetSQLValueString($Confdbms,$wkt, "text"),
		GetSQLValueString($Confdbms,$nmA, "text"));
		mysqli_query($Confdbms, $Query);
	}
 } ?>
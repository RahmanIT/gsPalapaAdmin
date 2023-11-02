<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmPeta")) {
	  $insertSQL = sprintf("INSERT INTO tb_mapservice(NM_SERVICE, URL_SERVICE, TYPE_S, TANSPARAN, LEGEND, NO_IDX, START_OPT, USERNAME, PASSWORD,KD_USER) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($Congis,$_POST["NM_PETA"], "text"),
						   GetSQLValueString($Congis,$_POST["URL_SERVICE"], "text"),
						   GetSQLValueString($Congis,$_POST["TYPE_SERVICE"], "text"),
						   GetSQLValueString($Congis,$_POST["TRANSPARAN"], "text"),
						   GetSQLValueString($Congis,$_POST["LEGEND_SHW"], "text"),
						   GetSQLValueString($Congis,$_POST["IDX_SERVICE"], "text"),
						   GetSQLValueString($Congis,$_POST["DEFAULT_SHW"], "text"),
						   GetSQLValueString($Congis,$_POST["USERNAME"], "text"),
						   GetSQLValueString($Congis,$_POST["PWD"], "text"),
						   etSQLValueString($Congis,$_POST["KD_USER"], "int"));
	  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
			$tglNf = date("Y-m-d H:i:s");
			$wkt = time();
			$nmA = $P[0]["INISIAL"];
			$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,4, "int"),
			GetSQLValueString($Congis,"Menambahkan peta baru baru $_POST[NM_PETA] surce $_POST[URL_SERVICE]", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
	 	}
} ?>
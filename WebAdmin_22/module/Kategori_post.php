<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	if ((isset($_POST["NAMA"])) && ($_POST["NAMA"]!="")) {
	  $insertSQL = sprintf("INSERT INTO tb_kategori (NAMA, KETERANGAN,KTG_ICON) VALUES (%s, %s, %s)",
	      			GetSQLValueString($Congis,$_POST["NAMA"], "text"),
					GetSQLValueString($Congis,$_POST["KET"], "text"),
					GetSQLValueString($Congis,$_POST["FaIcon"], "text"));
	  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	  if (isset($Result1)){
	  echo 1;
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,15, "int"),
		GetSQLValueString($Congis,"Membuat kategori $_POST[NAMA]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 }
	}
 } ?>
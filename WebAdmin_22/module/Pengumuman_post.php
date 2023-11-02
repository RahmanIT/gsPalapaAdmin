<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	  $insertSQL = sprintf("INSERT INTO tb_info (JUDUL, ISI, CREATED, TANGGAL, KD_USER) VALUES (%s, %s, %s, %s, %s)",
						  GetSQLValueString($Congis,$_POST['JUDUL'], "text"),
						  GetSQLValueString($Congis,$_POST['ISI'], "text"),
						  GetSQLValueString($Congis,$_POST['CREATED'], "text"),
						  GetSQLValueString($Congis, $_POST['TANGGAL'], "date"),
						  GetSQLValueString($Congis,$_SESSION['KdUser'], "int"));
	  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	  $insertGoTo = "#";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,12, "int"),
				GetSQLValueString($Congis,"Menambahkan pengumuman $_POST[JUDUL]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
				mysqli_query($Congis,$Query);
	  $insertGoTo = $nama_folder."/WebAdmin/Pengumuman.html";
	  header(sprintf("Location: %s", $insertGoTo));
	}
} ?>
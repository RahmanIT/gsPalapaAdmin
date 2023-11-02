<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	  $insertSQL = sprintf("INSERT INTO tb_agenda (ACARA, KET, TANGGAL, TGL_SELESAI, WAKTU, SELESAI, TEMPAT) VALUES (%s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($Congis,$_POST['ACARA'], "text"),
						   GetSQLValueString($Congis, $_POST['KET'], "text"),
						   GetSQLValueString($Congis,$_POST['TANGGAL'], "date"),
						   GetSQLValueString($Congis,$_POST['TGL_SELESAI'], "date"),
						   GetSQLValueString($Congis,$_POST['WAKTU'], "date"),
						   GetSQLValueString($Congis,$_POST['SELESAI'], "date"),
						   GetSQLValueString($Congis,$_POST['TEMPAT'], "text"));
	  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["NAMA"];
	  //mysqli_query($Congis, "INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('18','Agenda baru berjudul $_POST[ACARA] ','$tglNf','$wkt','$nmA')");
	   $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,18, "int"),
		GetSQLValueString($Congis,"Agenda baru berjudul $_POST[ACARA]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	  
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
		$insertGoTo = $nama_folder."/WebAdmin/Agenda.html";
	  header(sprintf("Location: %s", $insertGoTo));
	}
	?>
<?php } ?>
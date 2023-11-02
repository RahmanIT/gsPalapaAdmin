<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	  $updateSQL = sprintf("UPDATE tb_agenda SET ACARA=%s, KET=%s, TANGGAL=%s, TGL_SELESAI=%s, WAKTU=%s, SELESAI=%s, TEMPAT=%s,INSTAGRAM=%s, YOTUBE=%s WHERE KD=%s",
	  				GetSQLValueString($Congis,$_POST['ACARA'], "text"),
					GetSQLValueString($Congis, $_POST['KET'], "text"),
					GetSQLValueString($Congis,$_POST['TANGGAL'], "date"),
					GetSQLValueString($Congis,$_POST['TGL_SELESAI'], "date"),
					GetSQLValueString($Congis,$_POST['WAKTU'], "date"),
					GetSQLValueString($Congis,$_POST['SELESAI'], "date"),
					GetSQLValueString($Congis,$_POST['TEMPAT'], "text"),
					GetSQLValueString($Congis,$_POST['TxtIG'], "text"),
					GetSQLValueString($Congis,$_POST['TxtYOTUBE'], "text"),
					GetSQLValueString($Congis,$_POST['KD'], "int"));	
	  $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());	 
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];;
	 // mysqli_query($Congis, "INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('18','Update Agenda $_POST[ACARA]','$tglNf','$wkt','$nmA')");
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,18, "int"),
		GetSQLValueString($Congis,"Agenda baru berjudul $_POST[ACARA]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	  $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
	  if (isset($Result1)){
		   $insertGoTo = $nama_folder."/WebAdmin/Agenda.html";
			header(sprintf("Location: %s", $insertGoTo));
		 }
	}
}//end sesion fungsi on 
?>
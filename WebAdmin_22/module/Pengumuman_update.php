<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	  $updateSQL = sprintf("UPDATE tb_info SET JUDUL=%s, ISI==%s, CREATED==%s, TANGGAL==%s  WHERE KD=%s",
						   GetSQLValueString($Congis,$_POST['JUDUL'], "text"),
						  GetSQLValueString($Congis,$_POST['ISI'], "text"),
						  GetSQLValueString($Congis,$_POST['CREATED'], "text"),
						  GetSQLValueString($Congis, $_POST['TANGGAL'], "date"),
						  GetSQLValueString($Congis,$_POST['KD'], "int"));
	$Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
	if (isset($Result1)){
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
		  	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,12, "int"),
				GetSQLValueString($Congis,"Updating pengumuman $_POST[JUDUL]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
				mysqli_query($Congis,$Query); 
	$insertGoTo = $nama_folder."/WebAdmin/Pengumuman.html";
	header(sprintf("Location: %s", $insertGoTo));
		}
	}
} ?>
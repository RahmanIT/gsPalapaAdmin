<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$nmFile=$_FILES['fileUploadSHP']['name'];
	$remote_file = $_POST["CboDIR"]."/".$nmFile;
	$ftp_server = mysqli_result(mysqli_query("SELECT ftp_id1 FROM tb_setting"), 0);
	$ftp_user_name=$_SESSION['NmInisial'];
	$ftp_user_pass=$_SESSION['ftpID'];
	// set up basic connection
	$conn_id = ftp_connect($ftp_server);
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	// upload a file
	if (ftp_put($conn_id, $remote_file, $_FILES['fileUploadSHP']['tmp_name'], FTP_BINARY)) {
	 echo "successfully uploaded $remote_file\n";
	} else {
	 echo "There was a problem while uploading $remote_file\n";
	}
	// close the connection
	ftp_close($conn_id);
	$tgl2 = date("Y-m-d");
	$wkt2 = date("H:m:s");
	$insertSQL = sprintf("INSERT INTO tb_shafile_zip(NAMA, KETERANGAN, DIR, FILE_NAME, TANGGAL, WAKTU, AKSES, KD_USER) VALUES (%s, %s, %s, %s,%s, %s,%s,%s)",
			GetSQLValueString($Congis,$nmFile,$_POST["KetShapefile"], "text"),
			GetSQLValueString($Congis,$_POST["CboDIR"], "text"),
			GetSQLValueString($Congis,$nmFile, "text"),
			GetSQLValueString($Congis,$tgl2, "date"),
			GetSQLValueString($Congis,$wkt2, "date"),
			GetSQLValueString($Congis,$_POST["TxtAksesOP"], "text"),
			GetSQLValueString($Congis,$_SESSION['KdUser'], "int"));
	$Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());	
	    
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,3, "int"),
				GetSQLValueString($Congis,"Upload shapefile  baru baru $_POST[NM_PETA] surce $remote_file", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
 } ?>
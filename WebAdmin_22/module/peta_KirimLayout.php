<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){
	 $NamaAlias = $_POST['NM_FILE'].".".$_POST["EXT_FILE"];
	  $server_file = $_POST['PATH_FILE'];
	  $ftp_server ="localhost";
	  $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	  $ftp_username = "n5d1k4ls3l";
	  $ftp_userpass = "v537e3ef";
	  $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
	  $nama_FIle = date("Ymd_Hms_").$_POST['NM_FILE'].".".$_POST["EXT_FILE"];
	  $local_file = "E:/WebFile/WebPortal/MapLayout/".$nama_FIle;
		if (ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
			{  echo "Klik link berikut untuk download  <br/><a href='$nama_folder/MapLayout/$nama_FIle' onclick=\"Alert.ok()\" target='_new'>$NamaAlias</a>"; }
		else {  echo "Gagal mengaakses server."; }
	  ftp_close($ftp_conn);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,10, "int"),
				GetSQLValueString($Congis,"Admin Send Peta to $server_file alias $NamaAlias", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis,$Query);
 } ?>
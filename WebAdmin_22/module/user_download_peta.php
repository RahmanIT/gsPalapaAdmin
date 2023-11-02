<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmDownloadPeta")) {
  $insertSQL = sprintf("INSERT INTO tb_user_petadwn(NAMA, EMAIL, PENGGUNA, KET, TANGGAL, IP_ADDR, KD_PETA, EXTENSI, LAMPIRAN,STS_K) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($Congis,$_POST['NAMA'], "text"),
                       GetSQLValueString($Congis,$_POST['EMAIL'], "text"),
					   GetSQLValueString($Congis,$_POST['JnsPengguna'], "text"),
					   GetSQLValueString($Congis,$_POST['KET'], "text"),
					   GetSQLValueString($Congis,date("Y-m-d H:m:s"), "date"),
                       GetSQLValueString($Congis,$_SERVER['REMOTE_ADDR'], "text"),
					   GetSQLValueString($Congis,$_POST['KODE_FILE'], "int"),
					   GetSQLValueString($Congis,$_POST['EXT_FILE'], "text"),
					   GetSQLValueString($Congis,"-", "text"),
					   GetSQLValueString($Congis,"5", "text"));
  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
  $NamaAlias = $_POST['NM_FILE'].".".$_POST["EXT_FILE"];
  $server_file = $_POST['PATH_FILE'];
  $ftp_server = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3 FROM tb_setting"), 0);
  $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
  $ftp_username = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ui FROM tb_setting"), 0);
  $ftp_userpass = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ps FROM tb_setting"), 0);
  $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
  $nama_FIle = date("Ymd_Hms_").$_POST['NM_FILE'].".".$_POST["EXT_FILE"];
  $ditTarget = mysqli_result(mysqli_query($Congis, "SELECT ftpTemp_DIR FROM tb_setting"), 0);
  $local_file = $ditTarget.$nama_FIle;
  	if (ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
  		{  echo "Klik link berikut untuk download  <br/><a href='$nama_folder/MapLayout/$nama_FIle' onclick=\"HideDownloadL()\" target='_new'>$NamaAlias</a>"; }
  	else {  echo "Gagal mengaakses server."; }
  ftp_close($ftp_conn);
   
  	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,10, "int"),
			GetSQLValueString($Congis,"User Download $server_file alias $NamaAlias", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
}
?>
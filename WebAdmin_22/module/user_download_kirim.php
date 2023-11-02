<?php
$sqli = mysqli_query("SELECT tb_user_petadwn.EXTENSI, tb_peta.PDF, tb_peta.JPG, tb_peta.PNG, tb_peta.NAMA FROM  tb_user_petadwn INNER JOIN tb_peta ON tb_user_petadwn.KD_PETA = tb_peta.KD_PETA WHERE tb_user_petadwn.ID=$segmen5");
$row = mysqli_fetch_assoc($sqli);
echo "01- FTP Proses <br/>";  
//---------------------- Mengabil Peta Dari Local Storage ---------------------------------------------------
  $NamaAlias = $row['NAMA'].".".$row["EXTENSI"];
  if($row["EXTENSI"]=="pdf"){
	$server_file = $row['PDF'];
  }else if($row["EXTENSI"]=="jpg"){
	$server_file = $row['JPG'];  
  }else if($row["EXTENSI"]=="png"){
    $server_file = $row['PNG'];
  }
  $ftp_server = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3 FROM tb_setting"), 0);
  $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
  $ftp_username = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ui FROM tb_setting"), 0);
  $ftp_userpass = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ps FROM tb_setting"), 0);
  $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
  $nama_FIle = date("Ymd_Hms_").$row['NAMA'].".".$row["EXTENSI"];
  $local_file = "E:/WebFile/WebPortal/MapLayout/".$nama_FIle;
  	if (ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
  		{  echo "<a href='$nama_folder/MapLayout/$nama_FIle' onclick=\"HideDownloadL()\" target='_new'>$NamaAlias</a>"; 
		}else { 
	 		echo "<b>Gagal mengaakses server ftp.</b>";
	 	}
  ftp_close($ftp_conn);
 
echo "<br/>02- Mengirim Email<br/>";  
//---------------------- Mengirim email ---------------------------------------------------
//require_once ('../../WebAdmin/module/class.phpmailer.php');
require 'PHPMailerAutoload.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 $row1 = mysqli_fetch_assoc(mysqli_query($Congis, "SELECT tb_setting.NAMA_ORG, tb_setting.EMAIL, tb_setting.DOMAIN FROM tb_setting"));
 $EmailAddr = $row1["EMAIL"]; 
 $AppName = $row1["NAMA_ORG"]; 
 $webDomain = $row1["DOMAIN"]; 
// HTML body
$body = "<h2>PETA ".$row['NAMA']."</h2>";
$body .= "<p>Hai ".$segmen4."</p>";
$body .= "<p>Permintaan peta ".$row['NAMA']." telah selesai kami proses </p>";
$body .= "Anda dapat medownload peta pada lampiran, jika anda mengalami masalah pada peta yang kami lampiran";
$body .= "silahkan menghubungi kami melalui halaman <b><i>htp://geoportal.kalselprov.go.id/WebPortal/Kontak-kami.html</i></b></p> ";
$body .= "<p>BADAN PERENCANAAN PEMBANGUNAN DAERAH<br/>Infrastruktur dan Penataan Ruang</p>";
$body .= "<center><p>Jaringan Data Spasial Provinsi Kalimantan Selatan</p>LUMBUNG GEOPORTAL<br/>".$webDomain;
$body .= "Terimakasi.</center>";

echo "Sending Email to ".$segmen3."<br/>";
//$mail->isSendmail();
// And the absolute required configurations for sending HTML with attachement
$mail->setFrom($EmailAddr,$AppName); //email pengirim
$mail->AddAddress($segmen3, $segmen4);//email tujuan

$mail->Subject = "Permintaan Peta ".$NamaAlias;
$mail->MsgHTML($body);
$mail->AddAttachment('MapLayout/'.$nama_FIle);
if(!$mail->Send()) {
   echo "<b>Mailer Error: </b>" . $mail->ErrorInfo;
//exit;
}else {
   echo "<b>Message was sent successfully</b>";
}
 
//---------------------- Membiat Log Pemberitahuan ---------------------------------------------------
echo "<br/>03- Repot Proses<br/>";
  	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,22, "int"),
			GetSQLValueString($Congis,"Mengirim peta $server_file alias $NamaAlias ke $segmen3 a/n $segmen4", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
  $query3 = sprintf("UPDATE tb_user_petadwn SET STS_K=%s WHERE ID=%s",
  				GetSQLValueString($Congis,5, "text"),
				GetSQLValueString($Congis,$segmen5, "int"));
  mysqli_query($Congis, $query3);
 echo "<b>Complete</b>";
?>
<?php 
error_reporting(0);
if (isset($_POST['EMAIL']) && $_POST['txtKey'] == 'c3r091vekf2sslsgeoportalkalsel' && $_POST['EMAIL']!="" && $_POST['PWD']!="") {
$arrContextOptions=array(
	"ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
); 	
  $loginUsername=htmlspecialchars($_POST['EMAIL']);
  $pwd_string = htmlspecialchars($_POST['PWD']);
  $t=time();
  $dt = date('Y_m_d_h');
  $key =md5('geoportal'.$dt.'kalsle'); 
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = $nama_folder."/WebAdmin/home.html";
  $MM_redirectLoginFailed = "#";
  $MM_redirecttoReferrer = false;
		$str1 = $loginUsername.'#_#'.$pwd_string;
		$kunci = '6300berkatD4tuKAlmApAyAn63';
		for ($i = 0; $i < strlen($str1); $i++) {
			$karakter = substr($str1, $i, 1);
			$kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
			$karakter = chr(ord($karakter)+ord($kuncikarakter));
			$hasil .= $karakter;
		}
   $keyU = urlencode(base64_encode($hasil));
   $sumber = $conf["SrvAPI"].'/rest/Geoportal-Validasi/?UID='.$keyU.'&kode='.$t.'&key='.$key;
   $konten = file_get_contents($sumber); 

  if (!isset($_SESSION)) {
		  session_start();
  }
  if(!isset($_SESSION['LoginFaildC'])){
	  $_SESSION['LoginFaildC'] =0;
  } 
  
  if (($konten != '404') and ($konten != '500')) {
	  if( $_SESSION['LoginFaildC'] < 4 ){ 
	     $data = json_decode($konten, true);
//		 $_SESSION['MM_User'] = $loginUsername;
//		 $_SESSION['MM_UserGroup'] = $data[0]["INISIAL"];	 
//		 $_SESSION['NAMA'] = $data[0]['NAMA'];
//		 $_SESSION['KdUser'] = $data[0]['KD_USER'];
		 $_SESSION['P']= $konten;
		echo 101;  
	  	$tglNf = date("Y-m-d H:m:s");
	  	$wkt = time();
	  	$nmA =$data[0]['KD_USER'];
		$query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, KD_USER) VALUES (%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,12, "int"),
				GetSQLValueString($Congis,"Login user $data[0]['NAMA'] on id $loginUsername", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "date"),
				GetSQLValueString($Congis,$nmA, "text"));
	  	mysqli_query($Congis,$query);
	  }
  }
  else {
	if( $_SESSION['LoginFaildC'] >= 4 ){
		echo '<h1 style="color:#F00"> Halaman Terblokir</h1>';
	 }else {  
        echo "<div class='alert alert-danger'><strong>Login Gagal! $_SESSION[LoginFaildC]</strong> periksa email dan sandi anda.</div>";
	 }
    $_SESSION['LoginFaildC'] = $_SESSION['LoginFaildC'] +1;	
	$date = date("Y-m-d");
	$jam = date("H:i:s");
	$wkt = time();
	$st = "LOGIN-FAIL";
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$QeryFilaLogin= sprintf("INSERT INTO log_login(USERNAME, TANGGAL, JAM, SESION_IP, WAKTU, STATUS) VALUES ('%s', '%s', '%s', '%s', '%s','%s')",
					GetSQLValueString($Congis,$loginUsername,"text"),
					GetSQLValueString($Congis,$date,"date"), 
					GetSQLValueString($Congis,$jam, "date"),
					GetSQLValueString($Congis,$ip,"text"), 
					GetSQLValueString($Congis,$wkt,"date"), 
					GetSQLValueString($Congis,$st,"text"));
    mysqli_query($Congis, $QeryFilaLogin) or die(mysqli_error());
		if( $_SESSION['LoginFaildC'] == 4 ){
		 $LoginFailQuser=sprintf("INSERT INTO tb_kunciuser(EMAIL, TANGGAL, JAM, WAKTU, IP_ADDR) VALUES ('%s', '%s', '%s', '%s', '%s')",
		 					GetSQLValueString($Congis,$loginUsername,"text"),
							GetSQLValueString($Congis,$date,"date"),
							GetSQLValueString($Congis, $jam,"date"),
							GetSQLValueString($Congis, $wkt,"date"),
							GetSQLValueString($Congis, $ip,"text"));
		 $LoginBLok = mysqli_query($Congis, $LoginFailQuser) or die(mysqli_error()); 
		}
		
  }
}
?>
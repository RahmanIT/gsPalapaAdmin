<?php
include('function_peta.php');
// settings
$max_file_size = 1024*1024; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
// thumbnail sizes
$sizes = array(80=>80, 300=>250, 800=>600);

//UPLOAD IMAGE
$namafolder="images/peta"; //folder tempat menyimpan file
if (!empty($_FILES["filUpload"]["tmp_name"])){
    $jenis_gambar=$_FILES['filUpload']['type'];         
        $gambar = $namafolder.basename($_FILES['filUpload']['name']); 
		$namaFoto =  basename($_FILES['filUpload']['name']);      
        		// get file extension
		$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h, $conf["DataDir"]);
			}
		} else {
			$msg = 'Unsupported file';
			$namaFoto = "none.png";
		}
		
} else {
	 echo "Anda belum memilih gambar";
	 $namaFoto = "none.png";
}
//********AKHIR SCRIP UPLOAD FOTO

//get data FTP SERVER
$ftp_server = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3 FROM tb_setting"), 0);
$ftp_user_name = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ui FROM tb_setting"), 0);
$ftp_user_pass = mysqli_result(mysqli_query($Congis, "SELECT ftp_id3Ps FROM tb_setting"), 0);


//-- Upload Peta JPG ke server FTP
if (!empty($_FILES["JPG"]["tmp_name"])){
	$nmFile=$_FILES['JPG']['name'];
	$remote_file = $_POST["CboDIR"]."/".$nmFile;
	// set up basic connection
	$conn_id = ftp_connect($ftp_server);
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	// upload a file
	if (ftp_put($conn_id, $remote_file, $_FILES['JPG']['tmp_name'], FTP_BINARY)) {
	 echo "successfully uploaded $remote_file\n";
	} else {
	 echo "There was a problem while uploading $remote_file\n";
	}
    
	$jpgPeta = $remote_file ;
	// close the connection
	ftp_close($conn_id);
}else { $jpgPeta='-'; }
//------------------------------------------------------------------------------------------
//-- Upload Peta PDF ke server FTP
if (!empty($_FILES["PDF"]["tmp_name"])){
	$nmFile=$_FILES['PDF']['name'];
	$remote_file = $_POST["CboDIR"]."/".$nmFile;

	// set up basic connection
	$conn_id = ftp_connect($ftp_server);
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	// upload a file
	if (ftp_put($conn_id, $remote_file, $_FILES['PDF']['tmp_name'], FTP_BINARY)) {
	 echo "successfully uploaded $remote_file\n";
	} else {
	 echo "There was a problem while uploading $remote_file\n";
	}
    
	$pdfPeta = $remote_file ;
	// close the connection
	ftp_close($conn_id);
}else { $pdfPeta='-'; }
//------------------------------------------------------------------------------------------
//-- Upload Peta PNG ke server FTP
if (!empty($_FILES["PNG"]["tmp_name"])){
	$nmFile=$_FILES['PNG']['name'];
	$remote_file = $_POST["CboDIR"]."/".$nmFile;
	// set up basic connection
	$conn_id = ftp_connect($ftp_server);
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	// upload a file
	if (ftp_put($conn_id, $remote_file, $_FILES['PNG']['tmp_name'], FTP_BINARY)) {
	 echo "successfully uploaded $remote_file\n";
	} else {
	 echo "There was a problem while uploading $remote_file\n";
	}
    
	$pngPeta = $remote_file ;
	// close the connection
	ftp_close($conn_id);
}else { $pngPeta='-'; }


//SAVE DATA	
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	echo "sipan";
  $insertSQL = sprintf("INSERT INTO tb_peta (NAMA, SUMMARY, ABSTRAK, GEO_REFERENCE, MAP_SERVER, PDF,R_PDF, JPG, R_JPG, PNG, R_PNG, KD_JDSN, TYPE_IG, PEMBUAT, SMB_DATA, TANGGAL, TGL_MODIF, IMAGE, BB, BT, LU, LS, MAX_SKALA, MIN_SKALA, ID_REC, XML_FILE, MAP_TAG,KD_USER,FILE_DIR) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['JUDUL'], "text"),
                       GetSQLValueString($_POST['SUMMARY'], "text"),
					   GetSQLValueString($_POST['ABSTRAK'], "text"),
					   GetSQLValueString($_POST['GEO_REFERENCE'], "text"),
                       GetSQLValueString($_POST['MAP_SERVER'], "text"),
                       GetSQLValueString($pdfPeta, "text"),
					   GetSQLValueString($_POST['RdPDF'], "text"),
                       GetSQLValueString($jpgPeta, "text"),
					   GetSQLValueString($_POST['RdJPG'], "text"),
					   GetSQLValueString($pngPeta, "text"),
					   GetSQLValueString($_POST['RdPNG'], "text"),
                       GetSQLValueString($_POST['KD_JDSN'], "text"),
                       GetSQLValueString($_POST['TYPE_IG'], "text"),
                       GetSQLValueString($_POST['INISIAL'], "text"),
                       GetSQLValueString($_POST['SMB_DATA'], "text"),
                       GetSQLValueString($_POST['TANGGAL'], "date"),
                       GetSQLValueString($_POST['TGL_UPDATE'], "date"),
                       GetSQLValueString($namaFoto, "text"),
					   GetSQLValueString($_POST['BB'], "text"),
					   GetSQLValueString($_POST['BT'], "text"),
					   GetSQLValueString($_POST['LU'], "text"),
					   GetSQLValueString($_POST['LS'], "text"),
					   GetSQLValueString($_POST['MAX_SKALA'], "text"),
					   GetSQLValueString($_POST['MIN_SKALA'], "text"),
					   GetSQLValueString($_POST['ID_REC'], "text"),
					   GetSQLValueString($_POST['XML_FILE'], "text"),
					   GetSQLValueString($_POST['MAP_TAG'], "text"),
					   GetSQLValueString($_POST['PEMBUAT'], "text"),
					   GetSQLValueString($_POST['CboDIR'], "text"));
  mysqli_select_db($Congis, $database_Confdbms);
  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
  echo "Tersipan";
 $insertGoTo = $nama_folder."/WebAdmin/Metadata.jsp";  
  	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,24, "int"),
			GetSQLValueString($Congis,"Menambahkan Peta baru $_POST[JUDUL]", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);

  header(sprintf("Location: %s", $insertGoTo));
}

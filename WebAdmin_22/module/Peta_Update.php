<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
include('function_peta.php');
// settings
$max_file_size = 1024*1024; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
// thumbnail sizes
$sizes = array(80=>80, 300=>250, 800=>600);


//UPLOAD IMAGE
$namafolder="images/peta"; //folder tempat menyimpan file

if (!empty($_FILES["filUpload"]["tmp_name"]))
{
    $jenis_gambar=$_FILES['filUpload']['type'];         
        $gambar = $namafolder . basename($_FILES['filUpload']['name']); 
		$namaFoto =  basename($_FILES['filUpload']['name']);      
        		// get file extension
		$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h);
			}
			mysql_query("UPDATE tb_peta SET IMAGE='$namaFoto' WHERE KD_PETA=$_POST[KD_PETA]");
		} else {
			$msg = 'Unsupported file';
		}
		
} else {
	 echo "Anda belum memilih gambar";
}
//********AKHIR SCRIP UPLOAD FOTO
	
//SAVE DATA	
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 $insertSQL = sprintf("UPDATE tb_peta SET NAMA=%s, SUMMARY=%s, ABSTRAK=%s, GEO_REFERENCE=%s, MAP_SERVER=%s, PDF=%s, R_PDF=%s, JPG=%s, R_JPG=%s, PNG=%s, R_PNG=%s, KD_JDSN=%s, TYPE_IG=%s, PEMBUAT=%s, SMB_DATA=%s, TANGGAL=%s, TGL_MODIF=%s, BB=%s, BT=%s, LU=%s, LS=%s, MAX_SKALA=%s, MIN_SKALA=%s, ID_REC=%s, XML_FILE=%s, MAP_TAG=%s WHERE KD_PETA=%s",
                       GetSQLValueString($_POST['JUDUL'], "text"),
                       GetSQLValueString($_POST['SUMMARY'], "text"),
					   GetSQLValueString($_POST['ABSTRAK'], "text"),
					   GetSQLValueString($_POST['GEO_REFERENCE'], "text"),
                       GetSQLValueString($_POST['MAP_SERVER'], "text"),
                       GetSQLValueString($_POST['PDF'], "text"),
					   GetSQLValueString($_POST['RdPDF'], "text"),
                       GetSQLValueString($_POST['JPG'], "text"),
					   GetSQLValueString($_POST['RdJPG'], "text"),
					   GetSQLValueString($_POST['PNG'], "text"),
					   GetSQLValueString($_POST['RdPNG'], "text"),
                       GetSQLValueString($_POST['KD_JDSN'], "text"),
                       GetSQLValueString($_POST['TYPE_IG'], "text"),
                       GetSQLValueString($_POST['PEMBUAT'], "text"),
                       GetSQLValueString($_POST['SMB_DATA'], "text"),
                       GetSQLValueString($_POST['TANGGAL'], "date"),
                       GetSQLValueString($_POST['TGL_UPDATE'], "date"),
					   GetSQLValueString($_POST['BB'], "text"),
					   GetSQLValueString($_POST['BT'], "text"),
					   GetSQLValueString($_POST['LU'], "text"),
					   GetSQLValueString($_POST['LS'], "text"),
					   GetSQLValueString($_POST['MAX_SKALA'], "text"),
					   GetSQLValueString($_POST['MIN_SKALA'], "text"),
					   GetSQLValueString($_POST['ID_REC'], "text"),
					   GetSQLValueString($_POST['XML_FILE'], "text"),
					   GetSQLValueString($_POST['MAP_TAG'], "text"),
					   GetSQLValueString($_POST['KD_PETA'], "text"));

  $Result1 = mysql_query($insertSQL, $Congis) or die(mysql_error());
 $insertGoTo = $nama_folder."/WebAdmin/Metadata.jsp";
 
  $tglNf = date("Y-m-d H:m:s");
  $wkt = time();
  $nmA = $_SESSION['NAMA'];
  mysql_query("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('24','Update peta $_POST[JUDUL]','$tglNf','$wkt','$nmA')");
  header(sprintf("Location: %s", $insertGoTo));
}
} ?>
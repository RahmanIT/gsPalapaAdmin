<?php 
$session_id='1'; //$session id
define ("MAX_SIZE","100000"); 
function getExtension($str){
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
    include('../../library/function_jdsn.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg','jpg','png');
	$sizes = array(150=>120);
	if ($_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
		$jenis_gambar=$_FILES['filUpload']['type'];         
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["TempDir"]);
				}
				$ImgUrl = $conf["TempDir"]."150x120_".$namaFoto;
				$img68 =  base64_encode(file_get_contents($ImgUrl));
				$StrFoto = preg_replace("[^a-zA-Z]", "", $img68);
				mysqli_select_db($Congis, $database_Confdbms);
				mysqli_query($Congis,"UPDATE st_geovista SET DF_BASEMAPIMG='$StrFoto' WHERE Id=1");
				unlink($ImgUrl);
			} else {
				$msg = 'Unsupported file';
			}
	} else {
		 echo "Anda belum memilih gambar"; 
	}
//==============================================================================
if ((isset($_POST["MM_update2"])) && ($_POST["MM_update2"] == "FormSetting")) {
  $updateSQL = sprintf("UPDATE st_geovista SET G_NAME=%s, G_DISKRIPTION=%s, C_LAT=%s, C_LONG=%s, C_ZOOM=%s, BASEMAP=%s, DF_BASENAME=%s,  DF_BASEMAP=%s, DESA_URL=%s, DESA_PARAM=%s, KECAMATAN_URL=%s, KECAMATAN_PARAM=%s,KABUPATEN_URL=%s, KABUPATEN_PARAM=%s WHERE Id=%s",
                       GetSQLValueString($Congis,$_POST['NAMA_APP'],"text"),
					   GetSQLValueString($Congis,$_POST['DISKRIP_APP'],"text"),
                       GetSQLValueString($Congis,$_POST['C_LAT'],"text"),
                       GetSQLValueString($Congis,$_POST['C_LONG'],"text"),
                       GetSQLValueString($Congis,$_POST['C_ZOOM'],"text"),
                       GetSQLValueString($Congis,$_POST['BASEMAP'],"text"),
                       GetSQLValueString($Congis,$_POST['DF_BASENAME'],"text"), 
                       GetSQLValueString($Congis,$_POST['DF_BASEMAP'],"text"),
					   GetSQLValueString($Congis,$_POST['DESA_URL'],"text"),
					   GetSQLValueString($Congis,$_POST['DESA_PARAM'],"text"),
					   GetSQLValueString($Congis,$_POST['KECAMATAN_URL'],"text"),
					   GetSQLValueString($Congis,$_POST['KECAMATAN_PARAM'],"text"),
					   GetSQLValueString($Congis,$_POST['KABUPATEN_URL'],"text"),
					   GetSQLValueString($Congis,$_POST['KABUPATEN_PARAM'],"text"),
					   GetSQLValueString($Congis,$_POST['KD'],"int"));
  $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  $tglNf = date("Y-m-d H:m:s");
  $wkt = time();
  $nmA = $_SESSION['NAMA'];
  mysqli_query($Congis, "INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('15','Update setting Website GeoVista | $_POST[NAMA_APP] | $_POST[BASEMAP]','$tglNf','$wkt','$nmA')");
  $updateGoTo = $nama_folder."/WebAdmin/Setting-Map.jsp";
  header(sprintf("Location: %s", $updateGoTo));
}

?>


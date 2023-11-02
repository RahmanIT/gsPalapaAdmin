<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<?php
$kd = $_POST["KD_JDSN"];
include('library/function_jdsn.php');
$max_file_size = 1024*1024; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
$sizes = array(100=>120);
if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
    $jenis_gambar=$_FILES['filUpload']['type'];         
        $gambar = $namafolder . basename($_FILES['filUpload']['name']); 
		$namaFoto =  basename($_FILES['filUpload']['name']);      
		$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			foreach ($sizes as $w => $h) {
				$files[] = resize($w,$h,$conf["TempDir"]);
			}
		$ImgUrl = $conf["TempDir"]."100x120_".$namaFoto;
		$img68 =  base64_encode(file_get_contents($ImgUrl));
		$StrFoto = preg_replace("[^a-zA-Z]", "", $img68);
		$query = sprintf("UPDATE tb_jdsn SET LOGO=%s, FOTO_S=%s WHERE KD_JDSN=%s",
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$StrFoto, "text"),
				GetSQLValueString($Congis,$kd, "int"));		
		mysqli_query($Congis, $query);
		unlink($ImgUrl);
		} else {
			$msg = 'Unsupported file';
		}
}
	//********AKHIR SCRIP UPLOAD FOTO
	$nama = $_POST["NAMA"];
	$kt = $_POST["KETERANGAN"];
	$Query = sprintf("UPDATE tb_jdsn SET NM_JDSN=%s, WEB_JIGN=%s, SERVICE_URL=%s, KETERANGAN=%s,TANGGAL=%s, TYPE=%s, KATEGORI=%s WHERE KD_JDSN=$kd",
	       		GetSQLValueString($Congis,$nama, "text"),
				GetSQLValueString($Congis,$_POST["WEB_JIGN"], "text"),
				GetSQLValueString($Congis,$_POST["SERVICE_URL"], "text"),
				GetSQLValueString($Congis,$kt, "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$_POST["CboType"], "text"),
				GetSQLValueString($Congis,$_POST["Kategori"], "text"),
				GetSQLValueString($Congis,$kd, "int"));
				
	mysqli_query($Congis, $Query);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,11, "int"),
				GetSQLValueString($Congis,"Update JDSN baru bernama ".$nama." ket ".$kt, "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	  			mysqli_query($Congis, $Query);
}
?>
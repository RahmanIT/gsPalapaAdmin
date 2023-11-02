<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$kd = $_POST["KD_MODEL"];
	include('library/function_jdsn.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
	$sizes = array(400=>220);
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg")
	{
		     $jenis_gambar=$_FILES['filUpload']['type'];          
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["TempDir"]);
				}
				$ImgUrl = $conf["TempDir"]."400x220_".$namaFoto;
				$img68 =  base64_encode(file_get_contents($ImgUrl));
				//$StrFoto = preg_replace("[^a-zA-Z]", "", $img68);
				$query= sprintf("UPDATE tb_modelling SET IMG_MODEL=%s WHERE KD_MODEL=%s", GetSQLValueString($Congis,$img68, "text"),GetSQLValueString($Congis,$kd, "int"));
				mysqli_query($Congis, $query)or die(mysqli_error());
				unlink($ImgUrl);
			} else {
				echo 'Unsupported file';
			}
			
	} else {
		 echo "Anda belum memilih gambar";
		 
	}
	//********AKHIR SCRIP UPLOAD FOTO
	$nama = $_POST["NAMA"];
	$ket = $_POST["KETERANGAN"];
	$tglNf = date("Y-m-d");
	$query= sprintf("UPDATE tb_modelling SET  NM_MODEL=%s, KETERANGAN=%s, INSTANSI=%s, APP_URL=%s, TGL_UPDATE=%s, PAGE_SOURCE=%s, PAGE_DAFULT=%s, PAGE_NAME=%s, LAT_Y=%s, LONG_X=%s,ZOOM_LEVEL=%s  WHERE KD_MODEL=%s",
			GetSQLValueString($Congis,$nama, "text"),
			GetSQLValueString($Congis,$ket, "text"),
			GetSQLValueString($Congis,$_POST["Instnasi"], "text"),
			GetSQLValueString($Congis,$_POST["AppURL"], "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$_POST["CboModule"], "text"),
			GetSQLValueString($Congis,$_POST["AppPage"], "text"),
			GetSQLValueString($Congis,$_POST["AppDir"], "text"),
			GetSQLValueString($Congis, $_POST["KOOR_Y"], "text"),
			GetSQLValueString($Congis,$_POST["KOOR_X"], "text"),
			GetSQLValueString($Congis,$_POST["ZOOM_LV"], "int"),
			GetSQLValueString($Congis,$kd, "int"));
	mysqli_query($Congis, $query) or die(mysqli_error());
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,25, "int"),
				GetSQLValueString($Congis,"Updating Web App Modelling $nama", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	  mysqli_query($Congis, $Query);
	?>
<?php } ?>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$kd = $_POST["KDMAP"];
	include('library/function_jdsn.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg','jpg','png');
	$sizes = array(100=>70);
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
			$jenis_gambar=$_FILES['filUpload']['type'];         
			$gambar = $namafolder.basename($_FILES['filUpload']['name']); 
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["TempDir"]);
				}
				$ImgUrl = $conf["TempDir"]."100x70_".$namaFoto;
				$img68 =  base64_encode(file_get_contents($ImgUrl));
				$StrFoto = preg_replace("[^a-zA-Z]", "", $img68);
				$query = sprintf("UPDATE basemap_layer SET IMAGE=%s, FOTO_S=%s WHERE KDMAP=%s",
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$StrFoto, "text"),
				GetSQLValueString($Congis,$kd, "int"));
				mysqli_query($Congis,$query);
				unlink($ImgUrl);
			} else {
				$msg = 'Unsupported file';
			}
	} else {
		 echo "Anda belum memilih gambar"; 
	}
	//********AKHIR SCRIP UPLOAD FOTO
//	$nm = $_POST["NAMA"];
//	$url = $_POST["URL"];
//	$ly = $_POST["LyName"];
//	$tye = $_POST["MapType"];
	$query = sprintf("UPDATE basemap_layer SET NAMA=%s, URL=%s, LYNAME=%s, OL_TYPE=%s WHERE KDMAP=%s",
				GetSQLValueString($Congis,$_POST["NAMA"], "text"),
				GetSQLValueString($Congis,$_POST["URL"], "text"),
				GetSQLValueString($Congis,$_POST["LyName"], "text"),
				GetSQLValueString($Congis,$_POST["MapType"], "text"),
				GetSQLValueString($Congis,$kd, "int"));				
	mysqli_query($Congis, $query) or die(mysqli_error());
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,22, "int"),
		GetSQLValueString($Congis,"Updating Basemap Layer  $_POST[NAMA]| $_POST[LyName] | $_POST[MapType] | on image $namaFoto", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 
	//mysqli_query($Congis, "INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('22','Updating Basemap Layer  $nm | $ly | $tye | on image $namaFoto','$tglNf','$wkt','$nmA')");
	?>
<?php } ?>
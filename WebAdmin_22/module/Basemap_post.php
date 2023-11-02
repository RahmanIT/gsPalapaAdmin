<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	include('library/function_jdsn.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg','jpg','png');
	$sizes = array(100=>70);
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
		$jenis_gambar=$_FILES['filUpload']['type'];         
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				/* resize image */
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["TempDir"]);
				}
				$ImgUrl = $conf["TempDir"]."100x70_".$namaFoto;
				$img68 =  base64_encode(file_get_contents($ImgUrl));
				$StrFoto = preg_replace("[^a-zA-Z]", "", $img68);
				mysqli_select_db($Congis, $database_Confdbms);
				unlink($ImgUrl);
			} else {
				$msg = 'Unsupported file';
				$namaFoto = "none.jpg";
				$StrFoto="null";
			}	
	} else {
		 echo "Anda belum memilih gambar";
		 $namaFoto = "none.jpg";
		 $StrFoto="null";
	}
	$nm = $_POST["NAMA"];
	$url = $_POST["URL"];
	$ly = $_POST["LyName"];
	$tye = $_POST["MapType"];
	$query = sprintf("INSERT INTO basemap_layer(NAMA, URL, LYNAME, OL_TYPE, IMAGE,FOTO_S) VALUES(%s,%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,$_POST["NAMA"], "text"),
				GetSQLValueString($Congis,$_POST["URL"], "text"),
				GetSQLValueString($Congis,$_POST["LyName"], "text"),
				GetSQLValueString($Congis,$_POST["MapType"], "text"),
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$StrFoto, "text"));	
	mysqli_query($Congis, $query) or die(mysqli_error());
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,22, "int"),
		GetSQLValueString($Congis,"Menambahkan basemap Peta Dasar baru $namaFot on $_POST[NAMA]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	 
	?>
<?php } ?>
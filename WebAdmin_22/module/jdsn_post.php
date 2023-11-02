<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php	include('library/function_jdsn.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png');
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
				unlink($ImgUrl);
			} else {
				$msg = 'Unsupported file';
				$namaFoto = "none.png";
				$StrFoto="";
			}
	} else {
		 echo "Anda belum memilih gambar";
		 $namaFoto = "none.png";
		 $StrFoto="";
	}

	$nama = $_POST["NAMA"];
	$ket = $_POST["KETERANGAN"];
	$tglNf = date("Y-m-d H:i:s");
	$Query = sprintf("INSERT INTO tb_jdsn (NM_JDSN,WEB_JIGN, SERVICE_URL, KETERANGAN, LOGO, TANGGAL, TYPE, KATEGORI, FOTO_S) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s)",
	       		GetSQLValueString($Congis,$nama, "text"),
				GetSQLValueString($Congis,$_POST["WEB_JIGN"], "text"),
				GetSQLValueString($Congis,$_POST["SERVICE_URL"], "text"),
				GetSQLValueString($Congis,$ket, "text"),
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$_POST["CboType"], "text"),
				GetSQLValueString($Congis,$_POST["Kategori"], "text"),
				GetSQLValueString($Congis,$StrFoto, "text"));
	  mysqli_query($Congis, $Query);
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];;
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	  			GetSQLValueString($Congis,11, "int"),
				GetSQLValueString($Congis,"Menambhkan JDSN baru bernama ".$nama." on ".$ket, "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
	  mysqli_query($Congis, $Query);
	?>
<?php } ?>
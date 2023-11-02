<?php error_reporting(0); 
 if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	$kdIndx = $_POST["KD_NEWS"];
	require("library/function_berita.php"); 
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
	$Foto = mysqli_result(mysqli_query($Congis, "SELECT FOTO FROM tb_berita WHERE KD_NEWS=$kdIndx"), 0); 
	 unlink($conf["DataDir"]."images/berita/65x65_".$Foto);
	 unlink($conf["DataDir"]."images/berita/300x250_".$Foto);
	 unlink($conf["DataDir"]."images/berita/800x450_".$Foto);
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png');
	$sizes = array(65=>65, 300=>250, 800=>450);
	$namafolder=$conf["DataDir"]."images/berita"; //folder tempat menyimpan file
		$jenis_gambar=$_FILES['filUpload']['type'];         
			$gambar = $namafolder.basename($_FILES['filUpload']['name']); 
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["DataDir"]);
				}
				$query = sprintf("UPDATE tb_berita SET FOTO=%s WHERE KD_NEWS=%s",
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$kdIndx, "int"));
				mysqli_query($Congis, $query);
			} else {
				echo 'Unsupported file';
			}
			
	} else {
		 echo "Anda belum memilih gambar";
	}
	//********AKHIR SCRIP UPLOAD FOTO
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	  $updateSQL = sprintf("UPDATE tb_berita SET KD_KATEGORI=%s, JUDUL=%s, ABSTRAK=%s, ISI=%s, CREATED=%s, TANGGAL=%s WHERE KD_NEWS=%s",
			  GetSQLValueString($Congis,$_POST['KD_KATEGORI'], "int"),
			  GetSQLValueString($Congis,$_POST['JUDUL'], "text"),
			  GetSQLValueString($Congis,$_POST['ABSTRAK'], "text"),
			  GetSQLValueString($Congis,$_POST['ISI'], "text"),						  
			  GetSQLValueString($Congis,$_POST['CREATED'], "text"),
			  GetSQLValueString($Congis,$_POST['TANGGAL'], "date"),
			  GetSQLValueString($Congis,$_POST['KD_NEWS'], "int"));
		$Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,19, "int"),
		GetSQLValueString($Congis,"Update berita $_POST[JUDUL]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);	  
	  if (isset($Result1)){
		   $insertGoTo = $nama_folder."/WebAdmin/Berita.jsp";
		 }
	}
	?>
<?php }?>
<?php  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$kd = $_POST["KD"];
	$DataDir1 = $DataDir;
	include('library/function_binder.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
	$sizes = array(250=>60);
	if (!empty($_FILES["filUpload"]["tmp_name"])&& $_FILES['filUpload']['type']=="image/jpg" or $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png"){
		$jenis_gambar=$_FILES['filUpload']['type'];          
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["DataDir"]);
				}
				$query = sprintf("UPDATE tb_binder SET FOTO=%s WHERE KD=%s",GetSQLValueString($Congis,$namaFoto, "text"),	GetSQLValueString($Congis,$kd, "int"));
				mysqli_query($Congis, $query);
			} else {
				echo 'Unsupported file';
			}
	} else {
		 echo "Anda belum memilih gambar";
	}
	//********AKHIR SCRIP UPLOAD FOTO
	$query = sprintf("UPDATE tb_binder SET Nama=%s, URL=%s WHERE KD=%s",
			GetSQLValueString($Congis,$_POST["NAMA"], "text"),
			GetSQLValueString($Congis,$_POST["URL"], "text"),
			GetSQLValueString($Congis,$kd, "int"));
	mysqli_query($Congis, $query);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,19, "int"),
		GetSQLValueString($Congis,"Update binder $_POST[NAMA] on to $_POST[URL]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
	?>
<?php } ?>
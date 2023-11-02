<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){  
	include('library/function_SlideShow.php');
	$max_file_size = 2048*2048; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
	$sizes = array(120=>40,1200=>400);
	if (!empty($_FILES["filUpload"]["tmp_name"])){
		$jenis_gambar=$_FILES['filUpload']['type'];          
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["DataDir"]);
				}
			} else {
				$msg = 'Unsupported file';
				$namaFoto = "none.jpg";
			}
			
	} else {
		 echo "Anda belum memilih gambar";
		 $namaFoto = "none.jpg";
	}
	$query = sprintf("INSERT INTO tb_slideshow(JUDUL, KETERANGAN, FOTO) VALUES(%s,%s,%s)",
				GetSQLValueString($Congis,$_POST["JUDUL"], "text"),
				GetSQLValueString($Congis,$_POST["KETERANGAN"], "text"),
				GetSQLValueString($Congis,$namaFoto, "text"));
	mysqli_query($Congis, $query);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,7, "int"),
	GetSQLValueString($Congis,"Menambahkan foto slide baru $namaFoto", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
} ?>
<?php  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ 
	include("library/function_binder.php");
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
	$sizes = array(250=>60);
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpg" or $_FILES['filUpload']['type']=="image/jpeg"){
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
	$query = sprintf("INSERT INTO tb_binder(NAMA,FOTO, URL) VALUES(%s,%s,%s)",
			GetSQLValueString($Congis,$_POST["NAMA"], "text"),
			GetSQLValueString($Congis,$namaFoto, "text"),
			GetSQLValueString($Congis,$_POST["URL"], "text"));
	mysqli_query($Congis, $query);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,20, "int"),
		GetSQLValueString($Congis,"Menambahkan binder $nama from $_POST[URL] on image $namaFoto", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} ?>
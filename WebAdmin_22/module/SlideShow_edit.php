<?php  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	$kd = $_POST["ID_SLD"];
	include('library/function_SlideShow.php');
	$max_file_size = 2048*2048; // 200kb
	$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
	$sizes = array(120=>40,1200=>400);
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpg" or $_FILES['filUpload']['type']=="image/jpeg"){
		$jenis_gambar=$_FILES['filUpload']['type'];         
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w,$h,$conf["DataDir"]);
				}
				mysqli_select_db($Congis, $database_Confdbms);
				$query = sprintf("UPDATE tb_slideshow SET FOTO=%s WHERE ID_SLD=%s",
				GetSQLValueString($Congis,$namaFoto, "text"),
				GetSQLValueString($Congis,$kd, "int"));
				mysqli_query($Congis, $query);
			} else {
				echo 'Unsupported file';
			}
			
	} else {
		 echo "Anda belum memilih gambar";
		 
	}
	//********AKHIR SCRIP UPLOAD FOTO
	$nama = $_POST["KETERANGAN"];
	$judul = $_POST["JUDUL"];
	$query = sprintf("UPDATE tb_slideshow SET JUDUL=%s, KETERANGAN=%s WHERE ID_SLD=%s",
	GetSQLValueString($Congis,$judul, "text"),
	GetSQLValueString($Congis,$_POST["KETERANGAN"], "text"),
	GetSQLValueString($Congis,$kd, "int"));
	mysqli_query($Congis, $query);
	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,6, "int"),
	GetSQLValueString($Congis,"Updating slide show $judul - $nama on image $namaFoto", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
	?>
<?php } ?>
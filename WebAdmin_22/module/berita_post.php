<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	if (isset($_POST['txtKeyB']) && $_POST['txtKeyB'] == '43kfr02738@geoportalkalsel') {
	include('library/function_berita.php');
	$max_file_size = 1024*1024; // 200kb
	$valid_exts = array('jpeg','jpg','png');
	$sizes = array(65=>65, 300=>250, 800=>450);
	$namafolder=$conf["DataDir"]."images/berita"; 
	if (!empty($_FILES["filUpload"]["tmp_name"]) && $_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/png" or $_FILES['filUpload']['type']=="image/jpg"){
		$jenis_gambar=$_FILES['filUpload']['type'];         
			$gambar = $namafolder.basename($_FILES['filUpload']['name']); 
			$namaFoto =  basename($_FILES['filUpload']['name']);      
			$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
			if (in_array($ext, $valid_exts)) {
				foreach ($sizes as $w => $h) {
					$files[] = resize($w, $h, $conf["DataDir"]);
				}
			} else {
				echo 'Unsupported file';
			}
			
	} else {
		 echo "Anda belum memilih gambar";
	}
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	  $Qrt = sprintf("INSERT INTO tb_berita (JUDUL,ABSTRAK, ISI, KD_KATEGORI, CREATED, TANGGAL, FOTO,KD_USER) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
						  GetSQLValueString($Congis,$_POST['JUDUL'], "text"),
						  GetSQLValueString($Congis,$_POST['ABSTRAK'], "text"),
						  GetSQLValueString($Congis,$_POST['ISI'], "text"),
						  GetSQLValueString($Congis,$_POST['KD_KATEGORI'], "text"),
						  GetSQLValueString($Congis,$_POST['CREATED'], "text"),
						  GetSQLValueString($Congis,$_POST['TANGGAL'], "date"),
						  GetSQLValueString($Congis,$namaFoto, "text"),
						  GetSQLValueString($Congis,$_SESSION['KdUser'], "int"));
	  $Result1 = mysqli_query($Congis, $Qrt) or die(mysqli_error());
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  $Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,17, "int"),
	GetSQLValueString($Congis,"Posting berita baru $_POST[JUDUL]", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
	  $insertGoTo = $nama_folder."/WebAdmin/Berita.jsp";
	  header(sprintf("Location: %s", $insertGoTo));
	}
  } //end validasi form
}?>
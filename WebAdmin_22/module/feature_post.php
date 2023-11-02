<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){  
include('library/function_peta.php');
$max_file_size = 1024*1024; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
$sizes = array(80=>80, 300=>250, 800=>600);
if (!empty($_FILES["filUpload"]["tmp_name"]))
{
    $jenis_gambar=$_FILES['filUpload']['type'];         
		$namaFoto =  basename($_FILES['filUpload']['name']);      
		$ext = strtolower(pathinfo($_FILES['filUpload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h, $conf["DataDir"]);
			}
		} else {
			$msg = 'Unsupported file';
			$namaFoto = "none.png";
		}
		
} else {
	 echo "Anda belum memilih gambar";
	 $namaFoto = "none.png";
}
//********AKHIR SCRIP UPLOAD FOTO
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_feture(NM_FEATURE, KETERANGAN, TANGGAL, IMAGE, F_ROLE) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($Congis,$_POST["NM_FEATURE"],"text"), 
                       GetSQLValueString($Congis,$_POST["KETERANGAN"],"text"), 
					   GetSQLValueString($Congis,date("Y-m-d H:i:s"),"date"),
					   GetSQLValueString($Congis, $namaFoto,"text"),
					   GetSQLValueString($Congis,$_POST["CboROle"],"text"));
  mysqli_select_db($Congis, $database_Confdbms);
  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysql_error());
   $FIdF  = mysqli_result(mysql_query($Congis, "SELECT MAX(KD_FEATURE) FROM tb_feture"), 0); 
    for ($i=0; $i < $_POST["TxtIndxF"]; $i++ ){
	   $PF ="URLPETA_".$i; 
	   $peta = $_POST[$PF];
	   if(isset($_POST[$PF])){
		    $insertSQL1 = sprintf("INSERT INTO tb_feature_lyr(KD_FEATURE, F_SERVICE, F_ROLE) VALUES (%s,%s,%s)",
					   GetSQLValueString($Congis,$FIdF,"text"),
					   GetSQLValueString($Congis, $peta,"text"),
					   GetSQLValueString($Congis,$_POST["CboROle"],"text"));			
	       mysqli_query($Congis, $insertSQL1);
	   }
   };
  for ($s=0; $s < $_POST["TxtIndxM"]; $s++ ){
	   $PF ="URLSERVICE_".$s; 
	   $TY = "F_TYPE_".$s;  
	   $peta = $_POST[$PF];
	   $MapType = $_POST[$TY];
	    if(isset($_POST[$TY])){
			$insertSQL2 = sprintf("INSERT INTO tb_feature_lyr(KD_FEATURE, F_TYPE, F_SERVICE, F_ROLE) VALUES (%s,%s,%s,%s)",
					   GetSQLValueString($Congis,$FIdF,"text"),
					   GetSQLValueString($Congis,$MapType,"text"),
					   GetSQLValueString($Congis, $peta,"text"),
					   GetSQLValueString($Congis,$_POST["CboROle"],"text"));
	   		mysql_query($Congis, $insertSQL2);
		}
	  };
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
				GetSQLValueString($Congis,23, "int"),
				GetSQLValueString($Congis,"Menambahkan Feature Acces baru $_POST[NM_FEATURE]", "text"),
				GetSQLValueString($Congis,$tglNf, "date"),
				GetSQLValueString($Congis,$wkt, "text"),
				GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
  $insertGoTo = $nama_folder."/WebAdmin/Feature.jsp";
  header(sprintf("Location: %s", $insertGoTo));
}
} ?>
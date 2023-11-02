<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmDownload")) {
  $insertSQL = sprintf("INSERT INTO tb_user_download(NAMA, EMAIL, TANGGAL, IP_ADDR, KD_FILE) VALUES (%s, %s, %s, %s, %s)",
  				GetSQLValueString($Congis,$_POST['NAMA'], "text"),
				GetSQLValueString($Congis,$_POST['EMAIL'], "text"),
				GetSQLValueString($Congis,date("Y-m-d H:i:s"), "date"),
				GetSQLValueString($Congis, $_SERVER['REMOTE_ADDR'], "text"),
				GetSQLValueString($Congis,$_POST['KODE_FILE'], "int"));

  mysqli_select_db($Congis, $database_Confdbms);
  $Result1 = mysqli_query($Congis, $insertSQL) or die(mysqli_error());
  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }  
  $kdf= $_POST['KODE_FILE'];
  $FIles  = mysqli_result(mysqli_query($Congis,"SELECT FILE_NAME FROM tb_download WHERE KD_FILE=$kdf"), 0); 
  echo "<a href='$nama_folder/download/$FIles' target='_blank' onClick='HideDownloadL()'>Klik untuk mengunduh</a>";
  $tglNf = date("Y-m-d H:i:s");
  $wkt = time();
  $nmA = $_POST['NAMA'];
  mysqli_query("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES ('10','User Download $FIles','$tglNf','$wkt','$nmA')");
}
?>
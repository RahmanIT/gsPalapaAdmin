<?php
if ((isset($_POST["message"])) && ($_POST["name"] <> "")) {
  $insertSQL = sprintf("INSERT INTO tb_pesan (NAMA, EMAIL, SUBJEK, COMMEN, TANGGAL, IP_ADDR) VALUES (%s, %s, %s, %s, %s, %s)",
  GetSQLValueString($Congis,$_POST['name'], "text"),
  GetSQLValueString($Congis,$_POST['email'], "text"),
  GetSQLValueString($Congis, $_POST['subject'], "text"),
  GetSQLValueString($Congis,$_POST['message'], "text"),
  GetSQLValueString($Congis,date("Y-m-d H:i:s"), "date"),
  GetSQLValueString($Congis, $_SERVER['REMOTE_ADDR'], "text"));
  mysqli_select_db($Congis, $database_Confdbms);
  $Result1 = mysqli_query($Congis,$insertSQL) or die(mysqli_error());
   echo '<span class="alert alert-success"><strong>Success!</strong> Pesan anda berhasil di kirim. &nbsp;&nbsp;&nbsp; <p onClick="HideMsg()" class="fa fa-times"></p></span><br/>';
  $tglNf = date("Y-m-d H:i:s");
  $wkt = time();
  $nmA = $_POST['name'];
  	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
	GetSQLValueString($Congis,2, "int"),
	GetSQLValueString($Congis,"Pesan masuk dari $_POST[ft_author] menyampaikan $_POST[ft_message] ", "text"),
	GetSQLValueString($Congis,$tglNf, "date"),
	GetSQLValueString($Congis,$wkt, "text"),
	GetSQLValueString($Congis,$nmA, "text"));
	mysqli_query($Congis, $Query);
}
?>
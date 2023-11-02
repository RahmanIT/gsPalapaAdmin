<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$file = $_GET["dir"]."/".$_GET['file'];
	$ftp_server = mysqli_result(mysqli_query($Congis, "SELECT ftp_id1 FROM tb_setting"), 0);
	$ftp_user_name=$_SESSION['NmInisial'];
	$ftp_user_pass=$_SESSION['ftpID'];
	$conn_id = ftp_connect($ftp_server);
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	// try to delete $file
	if (ftp_delete($conn_id, $file)) {
	 echo "$file deleted successful\n";
	} else {
	 echo "could not delete $file\n";
	}
	// close the connection
	ftp_close($conn_id);
	$kdDel = $_GET["p"];
	$hsl = mysqli_query($Congis, "DELETE from tb_shafile_zip WHERE KD_FILE = $kdDel");
	if(isset($hsl)){
	  echo "Berhasil";	  
	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,4, "int"),
			GetSQLValueString($Congis,"Delete file $remote_file - index $kdDel", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
	} ?>
<?php } ?>
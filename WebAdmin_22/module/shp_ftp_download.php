<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){  
	$ftp_server = mysqli_result(mysqli_query($Congis,"SELECT ftp_id1 FROM tb_setting"), 0);
	$ftp_username = mysqli_result(mysqli_query($Congis,"SELECT ftp_id3Ui FROM tb_setting"), 0);
	$ftp_userpass = mysqli_result(mysqli_query($Congis,"SELECT ftp_id3Ps FROM tb_setting"), 0);
	?>
	<!--file_get_contents('ftp://username:password@server_name/folder_name/xyz#123.csv')-->
	<a href="ftp://<?php echo $ftp_username.':'.$ftp_userpass.'@'.$ftp_server; ?>/ADMINISTRASI/TANAH%20AR%20250K.zip">Download</a>
<?php } ?>
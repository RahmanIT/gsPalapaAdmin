<?php require_once('../../WebAdmin/ftp_trnasmiter/Connections/Confdbms.php'); 
mysqli_select_db($Confdbms, $database_Confdbms);
?>
<?php 
//hapus semua files di folder
  $it2 = new FilesystemIterator('ftp_tempDownload/UnzipFiles');
  foreach ($it2 as $fileinfo) {
    $delfile = 'ftp_tempDownload/UnzipFiles/'.$fileinfo->getFilename();
	unlink($delfile);
 }
?>
<?php
// define some variables
$nmFIle = $_GET['p'];
$local_file ="ftp_tempDownload/".$nmFIle; 
$dirFIle = $_GET['dr'];
$server_file = $dirFIle."/".$nmFIle;
$ftp_server = mysqli_result(mysqli_query($Confdbms, "SELECT ftp_id1 FROM tb_setting"), 0);
$ftp_user_name=$_SESSION['NmInisial'];
$ftp_user_pass=$_SESSION['ftpID'];
// set up basic connection
$conn_id = ftp_connect($ftp_server);
// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
// try to download $server_file and save to $local_file
if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n <br/>";
} else {
    echo "There was a problem\n <br/>";
}
// close the connection
ftp_close($conn_id);
 // Zip file name
    $filename = $local_file;
    $zip = new ZipArchive;
    $res = $zip->open($filename);
    if ($res === TRUE) {
        // Unzip path
        $path = "ftp_tempDownload/UnzipFiles/";
        // Extract file
        $zip->extractTo($path);
        $zip->close();

       // echo 'Unzip!<br/>';
	   unlink($filename);
    } else {
        //echo 'failed!<br/>';
    }
// Get Project path
define('_PATH', dirname(__FILE__));
$ftp_server = mysqli_result(mysqli_query($Confdbms,"SELECT ftp_id2 FROM tb_setting"), 0);
$ftp_user_name=mysqli_result(mysqli_query($Confdbms,"SELECT ftp_id2Ui FROM tb_setting"), 0);
$ftp_user_pass=mysqli_result(mysqli_query($Confdbms, "SELECT ftp_id2Ps FROM tb_setting"), 0);
// set up basic connection
$conn_id = ftp_connect($ftp_server);
// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//Get Nama files
  $it = new FilesystemIterator('ftp_tempDownload/UnzipFiles');
  foreach ($it as $fileinfo) {
	 $nmFileKirim = $fileinfo->getFilename();
	//echo $nmFileKirim. "<br/>";
	$sumberfile = 'ftp_tempDownload/UnzipFiles/'.$nmFileKirim;
	// upload a file
	if (ftp_put($conn_id, $nmFileKirim, $sumberfile, FTP_BINARY)) {
	 echo "Terkirim $nmFileKirim\n <br/>";
	} else {
	 echo "Gagal mengirim $sumberfile\n <br/>";
   }
 }//loping membaca file DIR
// close the connection
ftp_close($conn_id);
?>
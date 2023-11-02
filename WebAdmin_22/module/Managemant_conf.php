<?php
$session_id='1'; //$session id
define ("MAX_SIZE","900000"); 
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

$valid_formats = array("jpg", "png", "gif","bmp","jpeg");
if(isset($_FILES["filUpload"])) {
    $uploaddir = "images/"; //a directory inside
        $filename = stripslashes($_FILES['filUpload']['name']);
        $size=filesize($_FILES['filUpload']['tmp_name']);
        //get the extension of the file in a lower case format
          $ext = getExtension($filename);
          $ext = strtolower($ext);
     	
         if(in_array($ext,$valid_formats))
         {
		   $newname=$uploaddir.$filename;           
           if (move_uploaded_file($_FILES['filUpload']['tmp_name'], $newname))  {
			   mysqli_select_db($Congis, $database_Confdbms);
	      	  mysqli_query($Congis, "UPDATE tb_setting SET LOGO='$newname' WHERE KD_SET=1");

			   
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! ';
          }       
       } else { 
	     	//echo 'Unknown extension!';
	   }    
   
}else { echo "Tidak ada log"; }

//==============================================================================

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "FormSetting")) {
  $updateSQL = sprintf("UPDATE tb_setting SET SINGKATAN_ORG='%s',NAMA_ORG='%s', ALAMAT='%s', TELPON='%s', EMAIL='%s', EMAIL_DOMAIN='%s', DOMAIN='%s', NAMA_PT='%s', ftp_id1='%s', ftp_id1Ui='%s',ftp_id1Ps='%s', ftp_id2='%s', ftp_id2Ui='%s',ftp_id2Ps='%s', ftp_id3='%s', ftp_id3Ui='%s', ftp_id3Ps='%s', ftpTemp_DIR='%s' WHERE KD_SET=%s",
                       $_POST['SINGKATAN_ORG'],
					   $_POST['NAMA_ORG'],
                       $_POST['ALAMAT'],
                       $_POST['TELPON'],
                       $_POST['EMAIL1'],
                       $_POST['EMAIL_DOMAIN'],
                       $_POST['DOMAIN'],
					   $_POST['NAMA_PT'],
					   $_POST['TxtFtpSrvA'],
					   $_POST['TxtIDFtpSrvA'],
                       $_POST['TxtPwdFtpSrvA'],
					   $_POST['TxtFtpSrvB'],
					   $_POST['TxtIDFtpSrvB'],
					   $_POST['TxtPwdFtpSrvB'],
					   $_POST['TxtFtpSrvC'],
					   $_POST['TxtIDFtpSrvC'],
					   $_POST['TxtPwdFtpSrvC'],
					   $_POST['TxtTempDirSrvC'],
                       $_POST['KD_SET']);
  $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  $tglNf = date("Y-m-d H:m:s");
  $wkt = time();
  $nmA = $_SESSION['NAMA'];
  mysqli_query($Congis,"INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU) VALUES ('15','Update setting Website info','$tglNf','$wkt','$nmA')");
  $updateGoTo = "WebAdmin/Manajemen-Web.jsp";
  header(sprintf("Location: %s", $updateGoTo));
}

?>


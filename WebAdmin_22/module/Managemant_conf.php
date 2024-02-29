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

$valid_formats = array("jpg", "png","jpeg");
if(isset($_FILES["filUpload"])) {
    $uploaddir = "images/"; //a directory inside
        $filename = stripslashes($_FILES['filUpload']['name']);
        $size=filesize($_FILES['filUpload']['tmp_name']);
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
  $updateSQL = sprintf("UPDATE tb_setting SET SINGKATAN_ORG=%s,NAMA_ORG=%s, ALAMAT=%s, TELPON=%s, EMAIL=%s, EMAIL_DOMAIN=%s, DOMAIN=%s, NAMA_PT=%s, ftp_id1=%s, ftp_id1Ui=%s,ftp_id1Ps=%s, ftp_id2=%s, ftp_id2Ui=%s,ftp_id2Ps=%s, ftp_id3=%s, ftp_id3Ui=%s, ftp_id3Ps=%s, ftpTemp_DIR=%s, webtema=%s WHERE KD_SET=%s",
                       GetSQLValueString($Congis,$_POST['SINGKATAN_ORG'], "text"),
					   GetSQLValueString($Congis,$_POST['NAMA_ORG'], "text"),
                       GetSQLValueString($Congis,$_POST['ALAMAT'],"text"),
                       GetSQLValueString($Congis,$_POST['TELPON'], "text"),
                       GetSQLValueString($Congis,$_POST['EMAIL1'], "text"),
                       GetSQLValueString($Congis,$_POST['EMAIL_DOMAIN'], "text"),
                       GetSQLValueString($Congis,$_POST['DOMAIN'], "text"),
					   GetSQLValueString($Congis,$_POST['NAMA_PT'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtFtpSrvA'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtIDFtpSrvA'], "text"),
                       GetSQLValueString($Congis,$_POST['TxtPwdFtpSrvA'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtFtpSrvB'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtIDFtpSrvB'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtPwdFtpSrvB'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtFtpSrvC'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtIDFtpSrvC'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtPwdFtpSrvC'], "text"),
					   GetSQLValueString($Congis,$_POST['TxtTempDirSrvC'], "text"),
					   GetSQLValueString($Congis,$_POST['CboThema'], "text"),
                       GetSQLValueString($Congis,$_POST['KD_SET'], "text"));				  
    $Result1 = mysqli_query($Congis, $updateSQL) or die(mysqli_error());
  	$wkt = time();
	$tglNf = date("Y-m-d H:i:s");
	$nmA = $P[0]["INISIAL"];
			$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,15, "int"),
			GetSQLValueString($Congis,"Updating setting WebPortal Config info ", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
	//membuat files config
	$json["INISIAL"] = $_POST['SINGKATAN_ORG'];
	$json["NAMA"] = $_POST['NAMA_ORG'];
	$json["ALAMAT"] = $_POST['ALAMAT'];
	$json["TELPON"] = $_POST['TELPON'];
	$json["EMAIL1"] = $_POST['EMAIL1'];
	$json["DOMAIN"] = $_POST['DOMAIN'];
	$json["TEMA"] = $_POST['CboThema'];
	$dataWrite = json_encode($json);
	$filepath = $conf["DataDir"]."WebPortal_config.json";		
	file_put_contents($filepath, $dataWrite);		
}
header("Location: $nama_folder/WebAdmin/Manajemen-Web.jsp");

?>


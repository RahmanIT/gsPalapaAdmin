<?php require_once('Connections/Confdbms.php'); ?>
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

$NamaFile = $_POST["NAMA"];
$kdf = $_POST['KD_FILE'];
$valid_formats = array("pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && $_FILES['filUpload']['type']=="application/pdf") 
{
	
$uploaddir = "download/"; //a directory inside
mysqli_select_db($Confdbms, $database_Confdbms);
$File = mysqli_result(mysqli_query($Confdbms, "SELECT FILE_NAME FROM tb_download WHERE KD_FILE=$kdf"), 0); 
unlink("download/".$File);
        $filename = stripslashes($_FILES['filUpload']['name']);
        $size=filesize($_FILES['filUpload']['tmp_name']);
        //get the extension of the file in a lower case format
          $ext = getExtension($filename);
          $ext = strtolower($ext);
     	
         if(in_array($ext,$valid_formats))
         {
		   $image_name=time().$filename;
		   $newname=$DataDir.$uploaddir.$image_name;
           
           if (move_uploaded_file($_FILES['filUpload']['tmp_name'], $newname))  {
	       		$tgl=date("Y-m-d H:m:s");
		   		mysqli_select_db($Confdbms, $database_Confdbms);
	      		mysqli_query($Confdbms, "UPDATE tb_download SET  FILE_NAME = '$image_name',FILE_SIZE ='$size' WHERE KD_FILE=$kdf");
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! ';
          }       
       } else { 
	     	echo 'Unknown extension!';
	   }    
   
}
mysqli_select_db($Confdbms, $database_Confdbms);
mysqli_query($Confdbms, "UPDATE tb_download SET NAMA_FILE='$NamaFile', TANGGAL'$tgl' WHERE KD_FILE=$kdf");
?>
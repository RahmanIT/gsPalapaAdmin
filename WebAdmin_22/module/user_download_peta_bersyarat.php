<?php
define ("MAX_SIZE","9000000"); 
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

$valid_formats = array("jpg","png","jpeg","docx","pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $uploaddir = "Lampiran/";
        $filename = stripslashes($_FILES['FileUpload']['name']);
        $size=filesize($_FILES['FileUpload']['tmp_name']);
          $ext = getExtension($filename);
          $ext = strtolower($ext);
         if(in_array($ext,$valid_formats))
         {
		   $image_name=time().$filename;
		   $newname=$uploaddir.$image_name;
           if (move_uploaded_file($_FILES['FileUpload']['tmp_name'], $newname))  {
	       		$namaFile =  $image_name;
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! <br/>';
			 $namaFile = "-";
          }       
       } else { 
	     	echo 'Unknown extension! <br/>';
			$namaFile = "-";
	   }    
}

if ((isset($_POST["MM_Pemohon"])) && ($_POST["MM_Pemohon"] == "DownloadPeta")) {
  $insertSQL = sprintf("INSERT INTO tb_user_petadwn(NAMA, EMAIL, PENGGUNA, KET, KEPERLUAN, TANGGAL, IP_ADDR, KD_PETA, EXTENSI, LAMPIRAN) VALUES (%s, %s, %s, %s, %s,%s, %s, %s, %s, %s)",
                        GetSQLValueString($Congis,$_POST['NAMA_USER'], "text"),
                        GetSQLValueString($Congis,$_POST['EMAIL_USER'], "text"),
                        GetSQLValueString($Congis,$_POST['Pengguna'], "text"),
                        GetSQLValueString($Congis,$_POST['INSTANSI'], "text"),
                        GetSQLValueString($Congis,$_POST['KEPERLUAN'], "text"),
                        GetSQLValueString($Congis,date("Y-m-d H:m:s"), "date"),
                        GetSQLValueString($Congis,$_SERVER['REMOTE_ADDR'], "text"),
                        GetSQLValueString($Congis,$_POST['KODE_FILE1'], "int"),
                        GetSQLValueString($Congis,$_POST['EXT_FILE1'], "text"),
                        GetSQLValueString($Congis,$namaFile, "text"));
  $Result1 = mysql_query($Congis, $insertSQL) or die(mysql_error());
  $NamaAlias = $_POST['NM_FILE1'].".".$_POST["EXT_FILE1"];
   echo '<div class="alert alert-success"><strong>Success! </strong> Permintaan anda akan kami proses dalam jangka waktu 5 hari kerja.</div>';

  	  $tglNf = date("Y-m-d H:i:s");
	  $wkt = time();
	  $nmA = $P[0]["INISIAL"];
	  		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
			GetSQLValueString($Congis,10, "int"),
			GetSQLValueString($Congis,"Permohonan peta $NamaAlias", "text"),
			GetSQLValueString($Congis,$tglNf, "date"),
			GetSQLValueString($Congis,$wkt, "text"),
			GetSQLValueString($Congis,$nmA, "text"));
			mysqli_query($Congis, $Query);
}
?>
<?php
$session_id='1'; //$session id
define ("MAX_SIZE","10000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$valid_formats = array("jpg","png","jpeg");
if($_FILES['filUpload']['type']=="image/jpeg" or $_FILES['filUpload']['type']=="image/jpg" or $_FILES['filUpload']['type']=="image/png"){
    $uploaddir = "files/"; //a directory inside
        $filename = stripslashes($_FILES['filUpload']['name']);
		echo $filename;
        $size=filesize($_FILES['filUpload']['tmp_name']);
          $ext = getExtension($filename);
          $ext = strtolower($ext);		  
         if(in_array($ext,$valid_formats)){
		   $image_name = time().$filename;
		   $newname = $conf["DataDir"].$uploaddir.$image_name;
		   echo $newname;
           if (move_uploaded_file($_FILES['filUpload']['tmp_name'], $newname))  {
	       		$tgl=date("Y-m-d H:m:s");				
					$Query = sprintf("INSERT INTO tb_fhoto_explor(FOTO,FILE_SIZE,TANGGAL,KD_USER) VALUES(%s,%s,%s,%s)",
								GetSQLValueString($Congis,$image_name, "text"),
								GetSQLValueString($Congis,$size,"text"),
								GetSQLValueString($Congis,$tgl, "date"),
								GetSQLValueString($Congis,$P[0]['KD_USER'], "int"));
	      		mysqli_query($Congis, $Query);
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! ';
          }       
       } else { 
	     	echo 'fromat file tidak support!';
	   }    
}
?>
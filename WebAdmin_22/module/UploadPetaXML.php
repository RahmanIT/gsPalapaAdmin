<?php
$session_id='1'; //$session id
define ("MAX_SIZE","900000"); 
function getExtension($str){
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$valid_formats = array("xml");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $uploaddir = "metadata/"; //a directory inside
        $filename = stripslashes($_FILES['UploadXML']['name']);
        $size=filesize($_FILES['UploadXML']['tmp_name']);
          $ext = getExtension($filename);
          $ext = strtolower($ext);
         if(in_array($ext,$valid_formats))
         {
		   $newname=$conf["DataDir"].$uploaddir.$filename; 
           if (move_uploaded_file($_FILES['UploadXML']['tmp_name'], $newname))  {
			   $_SESSION["fileXMl"] =$filename;  		
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! ';
          }       
       } else { 
	     	echo 'Unknown extension!';
	   }     
}
?>
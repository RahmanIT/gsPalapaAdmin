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

$valid_formats = array("jpg","png","jpeg","doc","docx","pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $uploaddir = "Lampiran/";
        $filename = stripslashes($_FILES['fileUpload1']['name']);
        $size=filesize($_FILES['fileUpload1']['tmp_name']);
          $ext = getExtension($filename);
          $ext = strtolower($ext);
         if(in_array($ext,$valid_formats))
         {
		   $image_name=time().$filename;
		   $newname=$uploaddir.$image_name;
           if (move_uploaded_file($_FILES['fileUpload1']['tmp_name'], $newname))  {
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
?>
<?php error_reporting(1);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!= "" && strlen($P[0]["NAMA"]) > 10){ 
$session_id='1'; //$session id
define ("MAX_SIZE","90000000"); 
function getExtension($str){
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$NamaFile = $_POST["NAMA"];
echo $_FILES['filUpload']['type'];
$valid_formats = array("pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && $_FILES['filUpload']['type']=="application/pdf"){
    $uploaddir = "download/"; //a directory inside
        $filename = stripslashes($_FILES['filUpload']['name']);
        $size=filesize($_FILES['filUpload']['tmp_name']);
          $ext = getExtension($filename);
          $ext = strtolower($ext);
         if(in_array($ext,$valid_formats))
         {
		   $image_name=time().$filename;
		   $newname=$conf["DataDir"].$uploaddir.$image_name; 
           if (move_uploaded_file($_FILES['filUpload']['tmp_name'], $newname))  {
	       		$tgl=date("Y-m-d H:m:s");
				$insertSQL = sprintf("INSERT INTO tb_download (NAMA_FILE,FILE_NAME,FILE_SIZE,TANGGAL) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($Congis,$NamaFile, "text"),
                       GetSQLValueString($Congis,$image_name, "text"),
                       GetSQLValueString($Congis,$size, "text"),
                       GetSQLValueString($Congis,$tgl, "date"));
			    echo $insertSQL;
				mysqli_query($Congis,$insertSQL);
	      		//mysqli_query($Congis, "INSERT INTO tb_download(NAMA_FILE,FILE_NAME,FILE_SIZE,TANGGAL) VALUES('$NamaFile','$image_name','$size','$tgl')");
	      } else  {
	         echo 'You have exceeded the size limit! Upload gagal! ';
          }       
       } else { 
	     	echo 'Unknown extension!';
	   }    
  }
}else { echo "kode";}?>
<?php 
$dt = date('Y_m_d_h_i');
$key =md5('gsAdmin'.$dt.'kalsel');
if ($segmen3 == $key){  
	if(isset($_SESSION['P'])){
		header("Content-Type:application/json");
		echo $_SESSION['P'];
	 }else{
	  echo 'NULL';
	}
}else{
  include('404.html');
}
?>
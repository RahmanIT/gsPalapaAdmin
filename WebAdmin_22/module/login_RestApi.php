<?php 
$dt = date('Y_m_d_h');
$key =md5($P[0]['KD_USER'].'gsAdmin'.$dt.'kalsel');
$taget = $conf["DataDir"].'sesion/'.$key.'.json';
file_put_contents($taget, $_SESSION['P']);
echo $key;
if ($segmen3 == $key){  
	if(isset($P)){
		$lok = $conf["SrvGeo"].'OneMap/?token='.$key;
		header("location:$lok");
		//header("Content-Type:application/json");
		//echo json_encode($P); 
	 }else{
	  echo 'NULL';
	}
}else{
  include('404.html');
}
?>
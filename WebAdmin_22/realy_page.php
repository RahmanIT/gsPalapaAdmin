<?php 
if(($P[0]['NAMA']!="") && ($P[0]["INISIAL"]<>"") && ($P[0]["ROLE"] > 1) && ($P[0]["ROLE"] < 4)){
	include('home_adm.php');
}else if ($segmen3== "login.aspx12"){
	include('login.php');
}else{
	include('index.php');
}
?>
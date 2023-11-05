<?php 
function generetkey($str1){
	$kunci = '979a218esekumpul';
	$hasil = "";
	for ($i = 0; $i < strlen($str1); $i++) {
		$karakter = substr($str1, $i, 1);
		$kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
		$karakter = chr(ord($karakter)+ord($kuncikarakter));
		$hasil .= $karakter;
	}
  return urlencode(base64_encode($hasil));
};
function deskripkey($string) {
	$key = "979a218esekumpul"; 
	$result = "";
	$string = base64_decode(urldecode($string));
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
};
?>
<?php //error_reporting(0);  
if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$namaTb = htmlspecialchars($_POST["tabelname"]);
$tglP = date('Y-m-d h:i:sP');
if(is_numeric($_POST["index"])){
  $ind = $_POST["index"];
}
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$query = "UPDATE \"WYPOINT\".\"$namaTb\" set verfikasi=true, dataupdate='$tglP' WHERE  idgps=$ind";
$result = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
$nmTbMD= $namaTb."_METADATA";
$nama = $P[0]["NAMA"];
$waktu = time();
$query = "UPDATE \"WYPOINT\".\"$nmTbMD\" set verfikasidate='$tglP', vefi_nama='$nama', vefi_waktu=$waktu WHERE  metadataid=$ind";
$result2 = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
if($result2){
  echo '<div class="alert alert-success" role="alert">berhasil meverfikasi '.$nmTbMD.' metadataid : '.$ind.'</div>';
}
pg_close($pgdb);
}?>
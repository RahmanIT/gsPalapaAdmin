<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$namaTb = htmlspecialchars($_POST["tabelname"]);
if(is_numeric($_POST["index"])){
  $query = 'DELETE FROM  "WYPOINT"."'.$namaTb.'" WHERE  "OneLandscpe_GPS_PT_25K".idgps='.$_POST["index"];
}
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$result = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
if($result){
  echo '<div class="alert alert-warning" role="alert">berhasil menghapus data '.$namaTb.' metadataid : '.$_POST["index"].'</div>';
}
pg_close($pgdb);
}?>
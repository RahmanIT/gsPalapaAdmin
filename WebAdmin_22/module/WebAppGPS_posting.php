<?php 
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$DataKey = htmlspecialchars($segmen3);
//$str1 = $x.'#'.$y.'#'.$namaFoto.'#'.$NamaObj.'#'.$Ket.'#'.$KsWIl.'#'.$Kab.'#'.$Kec.'#'.$Desa.'#'.$a.'#'.$b.'#'.$c.'#'.$d.'#'.$e.'#'.$ip;
require_once('WebAdmin_22/keygeneret.php');
$dt =  deskripkey($DataKey);
$datax = explode("#",$dt);
$x= $datax[0];
$y= $datax[1];
$foto = $datax[2];
$NamoDBj = $datax[3];
$ket = $datax[4];
$KsWIl= $datax[5];
$Kab = $datax[6];
$Kec= $datax[7];
$Desa= $datax[8];
$a= intval($datax[9]);
$b= floatval($datax[10]);
$c= floatval($datax[11]);
$d= floatval($datax[12]); 
$e= floatval($datax[13]);  
$ip = $datax[14]; 
$TabelNM = $datax[15]; 
$type = $datax[16];
include('library/function_toponimi.php');
$max_file_size = 2048*2048; // 200kb
$valid_exts = array('jpeg', 'jpg');
$sizes = array(1200=>800, 300=>400, 60=>60);

$NamaFls = explode("_",$TabelNM);
$wabapp = $NamaFls[0];

foreach ($sizes as $w => $h) {
  $files[] = resize($w,$h, $conf["DataDir"], $foto,$type,$wabapp);
};

$metadata = date('Y_m_d_his').$TabelNM;
$fotohtml = '<img src="'.$conf["Domain"].'/images/toponimi/'.$wabapp.'_300x400_'.$foto.'" width="100%">';
$waktu = time();
$tglP = date('Y-m-d h:i:sP');
$Query = "INSERT INTO  \"WYPOINT\".\"$TabelNM\" (geom, namobj, tanggal, kodepm, remark, foto, metadata) VALUES (ST_GeomFromText('POINT($x $y)', 4326), '$NamoDBj', '$tglP', '$KsWIl',  '$ket',  '$fotohtml', '$metadata')";
echo $Query;
$ps = pg_query($pgdb, $Query)or die('<div class="alert alert-danger" role="alert">'.pg_last_error().'</div>');

$TabelNMMd = $TabelNM.'_METADATA'; 
$QueryMeta = sprintf("INSERT INTO  \"WYPOINT\".\"$TabelNMMd\" (latitude, longitude, ipaddr, tgljam, waktu, namafile, metadata, wadmkd, wadmkc,wadmkk, akurasi, ketinggian, akurasielv, arah, kecepatan)  VALUES ( %s, %s, '%s', '%s', %s, '%s','%s', '%s', '%s', '%s', %s, %s, %s, %s, %s)", $y, $x, $ip,$tglP, $waktu, $foto, $metadata, $Desa, $Kec, $Kab, $a, $b, $c, $d, $e);

echo '<br>'.$QueryMeta;
pg_query($pgdb, $QueryMeta)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');

if($ps){
 echo '<div class="alert alert-danger" role="alert">berhasil menyimpan data '.$NamoDBj.' </div>';
}

pg_close($pgdb);
?>
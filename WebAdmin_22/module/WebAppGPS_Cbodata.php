<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
  header("Content-Type:application/json");
    if(is_numeric($_POST["kode"])){
	   $Kd = $_POST["kode"];
	};	
    $query_RsApp = "SELECT  `tb_modelling`.`KD_MODEL`,  `tb_modelling`.`NM_MODEL`,  `tb_modelling`.`KETERANGAN`,  `tb_modelling`.`INSTANSI`,  `tb_modelling`.`APP_URL`,  `tb_modelling`.`KD_USER`,  `tb_modelling`.`TGL_UPDATE`,  `tb_modelling`.`PAGE_SOURCE`,  `tb_modelling`.`PAGE_DAFULT`,  `tb_modelling`.`PAGE_NAME`,  `tb_modelling`.`LAT_Y`,  `tb_modelling`.`LONG_X`,  `tb_modelling`.`ZOOM_LEVEL`,  `tb_modelling`.`NM_TABEL`,  `tb_modelling`.`GPS_MODE` FROM   `tb_modelling` WHERE  `tb_modelling`.`KD_MODEL` =$Kd";
    $RsApp = mysqli_query($Congis, $query_RsApp) or die(mysqli_error());
    $row_RsApp = mysqli_fetch_assoc($RsApp);
   echo json_encode($row_RsApp); 
};?>
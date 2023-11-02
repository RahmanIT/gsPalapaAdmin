<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ 
$Eurty = sprintf("INSERT INTO tb_feature_lyr (KD_FEATURE, F_SERVICE, F_ROLE)values (%s,%s,%s)",
				GetSQLValueString($Congis,$_GET["Index"], "text"),
				GetSQLValueString($Congis,$_GET["Srv"], "text"),
				GetSQLValueString($Congis,$_GET["R"], "text"));
$Result1 = mysqli_query($Congis, $Eurty );
if(isset($Result1)){
  echo '<div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Data feature acces berhasil di tambahkan. <a href="#" class="alert-link">Saved</a>.
        </div>';
  	$tglNf = date("Y-m-d H:i:s");
	$wkt = time();
	$nmA = $P[0]["INISIAL"];
	$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,23, "int"),
		GetSQLValueString($Congis,"Menambahkan Feature Acces $_GET[Srv]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} 

}?>
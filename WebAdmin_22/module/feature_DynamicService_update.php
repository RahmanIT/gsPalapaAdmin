<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($_SESSION['MM_User']) > 15){ 
$query = sprintf("UPDATE tb_feature_lyr set F_SERVICE=%s, F_TYPE=%s WHERE KD_LYR=%s",
		GetSQLValueString($Congis,$_GET["Srv"], "text"),
		GetSQLValueString($Congis,$_GET["TY"], "text"),
		GetSQLValueString($Congis,$_GET["Index"], "int"));
$Result1 = mysqli_query($Congis, $query);
if(isset($Result1)){
  echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Data Layer Service berhasil di perbaharui. <a href="#" class="alert-link">Update Complite</a>.
        </div>';  
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,23, "int"),
		GetSQLValueString($Congis,"Editting Layer pendukung fature acces index $_GET[Index] menjadi $_GET[Srv]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} 
}?>
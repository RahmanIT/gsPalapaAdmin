<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ 
$Query =  sprintf("DELETE from  tb_feature_lyr WHERE KD_LYR=%s",GetSQLValueString($Congis,$_GET[Index], "int"));
$Result1 = mysqli_query($Congis,$Query);
if(isset($Result1)){
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Data Layer berhasil di hapus. <a href="#" class="alert-link">Deleted</a>.
        </div>'; 
		$tglNf = date("Y-m-d H:i:s");
		$wkt = time();
		$nmA = $P[0]["INISIAL"];
		$Query = sprintf("INSERT INTO tb_alert(KDNF, MSG_INFO, TANGGAL, WAKTU, USER_NAME) VALUES (%s,%s,%s,%s,%s)",
		GetSQLValueString($Congis,25, "int"),
		GetSQLValueString($Congis,"Menghapus Feature Acces $_GET[Index]", "text"),
		GetSQLValueString($Congis,$tglNf, "date"),
		GetSQLValueString($Congis,$wkt, "text"),
		GetSQLValueString($Congis,$nmA, "text"));
		mysqli_query($Congis, $Query);
} 
}?>
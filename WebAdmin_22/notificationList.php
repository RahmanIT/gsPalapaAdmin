<?php error_reporting(0);  
if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$maxRows_RsNotification = 20;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RsNotification = $Halaman * $maxRows_RsNotification;
$query_RsNotification = "SELECT tb_alert.Id,  tb_alert.MSG_INFO, tb_notifications.NF_ICON,  tb_alert.TANGGAL,  tb_alert.WAKTU,  tb_alert.USER_NAME FROM  tb_alert   INNER JOIN tb_notifications ON tb_alert.KDNF = tb_notifications.KDNF ORDER BY tb_alert.Id DESC ";
$query_limit_RsNotification = sprintf("%s LIMIT %d, %d", $query_RsNotification, $startRow_RsNotification, $maxRows_RsNotification);
$RsNotification = mysqli_query($Congis, $query_limit_RsNotification) or die(mysqli_error());
$row_RsNotification = mysqli_fetch_assoc($RsNotification);
if (isset($_GET['totalRows_RsNotification'])) {
  $totalRows_RsNotification = $_GET['totalRows_RsNotification'];
} else {
  $all_RsNotification = mysqli_query($Congis, $query_RsNotification);
  $totalRows_RsNotification = mysqli_num_rows($all_RsNotification);
}
$Total = ceil($totalRows_RsNotification/$maxRows_RsNotification)-1;
?>
<div class="table-responsive">
<table width="100%" class="table table-hover">
<thead>
  <tr>
    <td align="center">INDEX</td>
    <td align="center">ICON</td>
    <td align="center">Alert Info</td>
    <td align="center">TANGGAL</td>
    <td align="center">WAKTU</td>
    <td align="center">USER ID</td>
  </tr>
</thead>
<tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_RsNotification['Id']; ?></td>
      <td><span class="<?php echo $row_RsNotification['NF_ICON']; ?>"></span></td>
      <td align="left"><?php echo $row_RsNotification['MSG_INFO']; ?></td>
      <td><?php echo $row_RsNotification['TANGGAL']; ?></td>
      <td><?php  
	  $Dtk = time()-$row_RsNotification['WAKTU'];
	 if($Dtk < 60){
		  $Waktu = $Dtk." detik lalu";
	 }else if(($Dtk/3600)<1){
		  $Waktu = floor($Dtk/60)." menit lalu";
	 }else if(($Dtk/86400)<1){
		 $Waktu = floor($Dtk/3600)." jam lalu";
	 }else{
		 $Waktu = floor($Dtk/86400)." Hari lalu";
	 }	 
		 echo $Waktu;
	  ?></td>
      <td align="left"><?php echo $row_RsNotification['USER_NAME']; ?></td>
    </tr>
    <?php } while ($row_RsNotification = mysqli_fetch_assoc($RsNotification)); ?>
</tbody>
</table>
</div>
<?php } ?>
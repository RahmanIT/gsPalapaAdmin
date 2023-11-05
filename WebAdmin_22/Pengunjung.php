<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$maxRows_rsPengunjung = 25;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_rsPengunjung = $Halaman * $maxRows_rsPengunjung;
$query_rsPengunjung = "SELECT * FROM tstatistika ORDER BY Id DESC";
$query_limit_rsPengunjung = sprintf("%s LIMIT %d, %d", $query_rsPengunjung, $startRow_rsPengunjung, $maxRows_rsPengunjung);
$rsPengunjung = mysqli_query($Congis, $query_limit_rsPengunjung) or die(mysqli_error());
$row_rsPengunjung = mysqli_fetch_assoc($rsPengunjung);
if (isset($_GET['Total'])) {
  $Total = $_GET['Total'];
} else {
  $all_rsPengunjung = mysqli_query($Congis, $query_rsPengunjung);
  $Total = mysqli_num_rows($all_rsPengunjung);
}
$totalPages_rsPengunjung = ceil($Total/$maxRows_rsPengunjung)-1;
?>

<table width="100%" class="table table-hover">
<thead>
  <tr>
    <td height="21" align="center"><strong>Index</strong></td>
    <td align="center"><strong>Ip Addres</strong></td>
    <td align="center"><strong>Tanggal</strong></td>
    <td align="center"><strong>Hits</strong></td>
    <td align="center"><strong>Online Time</strong></td>
    <td align="center"><strong>Jam Masuk</strong></td>
  </tr>
</thead>
<tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsPengunjung['Id']; ?></td>
      <td><?php echo $row_rsPengunjung['ip']; ?></td>
      <td><?php echo $row_rsPengunjung['tanggal']; ?></td>
      <td><?php echo $row_rsPengunjung['hits']; ?></td>
      <td>
      <?php  
	  $Dtk = time()-$row_rsPengunjung['online'];
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
	  ?>
      </td>
      <td><?php echo $row_rsPengunjung['jam']; ?></td>
    </tr>
    <?php } while ($row_rsPengunjung = mysqli_fetch_assoc($rsPengunjung)); ?>
</tbody>
</table>
<?php
mysqli_free_result($rsPengunjung);
}
?>

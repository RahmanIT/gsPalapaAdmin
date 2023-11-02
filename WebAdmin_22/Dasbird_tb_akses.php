<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<?php
$tanggal = date("Y-m-d");
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$query_Recordset1 = "SELECT hits, ip, date_format(jam, '%H:%i') as jam FROM tstatistika ORDER BY Id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($Congis, $query_limit_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($Congis, $query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<div class="table-responsive">
 <table class="table table-bordered table-hover table-striped">
  <thead>
  <tr>
    <td>IP Addres</td>
    <td>Hits</td>
    <td>Waktu</td>
  </tr>
 </thead>
<tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['ip']; ?></td>
      <td><?php echo $row_Recordset1['hits']; ?></td>
      <td><?php echo $row_Recordset1['jam']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
   </tbody>
 </table>
</div>
 <?php 

$thn = date("Y") ;
$bln= date("m");
$dy = date("d") ;

$jlhP =  mysqli_result(mysqli_query($Congis, "SELECT COUNT(ip) FROM tstatistika WHERE YEAR(tanggal)=$thn and MONTH(tanggal)=$bln and DAY(tanggal)=$dy") , 0);  ?>
<script>
document.getElementById("JlhPengunjung").innerHTML = "<?php echo $jlhP; ?>";
</script>
<?php
mysqli_free_result($Recordset1);
}
?>

<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$maxRows_rsPendaftar = 10;
$pageNum_rsPendaftar = 0;
if (isset($_GET['pageNum_rsPendaftar'])) {
  $pageNum_rsPendaftar = $_GET['pageNum_rsPendaftar'];
}
$startRow_rsPendaftar = $pageNum_rsPendaftar * $maxRows_rsPendaftar;
$query_rsPendaftar = "SELECT tb_peta.NAMA, tb_user_petadwn.TANGGAL FROM  tb_user_petadwn INNER JOIN tb_peta ON tb_user_petadwn.KD_PETA = tb_peta.KD_PETA ORDER BY tb_user_petadwn.TANGGAL DESC";
$query_limit_rsPendaftar = sprintf("%s LIMIT %d, %d", $query_rsPendaftar, $startRow_rsPendaftar, $maxRows_rsPendaftar);
$rsPendaftar = mysqli_query($Congis, $query_limit_rsPendaftar) or die(mysqli_error());
$row_rsPendaftar = mysqli_fetch_assoc($rsPendaftar);
if (isset($_GET['totalRows_rsPendaftar'])) {
  $totalRows_rsPendaftar = $_GET['totalRows_rsPendaftar'];
} else {
  $all_rsPendaftar = mysqli_query($Congis, $query_rsPendaftar);
  $totalRows_rsPendaftar = mysqli_num_rows($all_rsPendaftar);
}
$totalPages_rsPendaftar = ceil($totalRows_rsPendaftar/$maxRows_rsPendaftar)-1;
?>
<div class="list-group">
   <?php if($totalRows_rsPendaftar>0){ do { ?>
   <a href="#" class="list-group-item">
      <i class="fa fa-globe  fa-fw"></i> <?php echo $row_rsPendaftar['NAMA']; ?>
      <span class="pull-right text-muted small"><em><?php echo $row_rsPendaftar['TANGGAL']; ?></em></span>
    </a>
     <?php } while ($row_rsPendaftar = mysqli_fetch_assoc($rsPendaftar));  }//end >0?>
</div>
<?php } ?>
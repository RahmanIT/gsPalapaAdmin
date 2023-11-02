<?php

$maxRows_RsDownTrafic = 10;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RsDownTrafic = $Halaman * $maxRows_RsDownTrafic;
$query_RsDownTrafic = "SELECT   `tb_download`.`NAMA_FILE`,   `tb_user_download`.`Id`,   `tb_user_download`.`NAMA`,   `tb_user_download`.`EMAIL`,   `tb_user_download`.`TANGGAL`,   `tb_user_download`.`IP_ADDR` FROM   `tb_user_download`   INNER JOIN `tb_download` ON `tb_user_download`.`KD_FILE` = `tb_download`.`KD_FILE` order by tb_user_download.Id DESC ";
$query_limit_RsDownTrafic = sprintf("%s LIMIT %d, %d", $query_RsDownTrafic, $startRow_RsDownTrafic, $maxRows_RsDownTrafic);
$RsDownTrafic = mysqli_query($Congis, $query_limit_RsDownTrafic) or die(mysqli_error());
$row_RsDownTrafic = mysqli_fetch_assoc($RsDownTrafic);

if (isset($_GET['totalRows_RsDownTrafic'])) {
  $totalRows_RsDownTrafic = $_GET['totalRows_RsDownTrafic'];
} else {
  $all_RsDownTrafic = mysqli_query($Congis, $query_RsDownTrafic);
  $totalRows_RsDownTrafic = mysqli_num_rows($all_RsDownTrafic);
}
$totalPages_RsDownTrafic = ceil($totalRows_RsDownTrafic/$maxRows_RsDownTrafic)-1;
?>

<table class="table table-bordered table-hover table-striped">
  <tr>
    <td align="center"><strong>ID</strong></td>
    <td align="center"><strong>NAMA</strong></td>
    <td align="center"><strong>EMAIL</strong></td>
    <td align="center"><strong>TANGGAL</strong></td>
    <td align="center"><strong>IP ADDR</strong></td>
    <td align="center"><strong>NAMA FILE</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_RsDownTrafic['Id']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['NAMA']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['EMAIL']; ?></td>
      <td><?php echo $row_RsDownTrafic['TANGGAL']; ?></td>
      <td><?php echo $row_RsDownTrafic['IP_ADDR']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['NAMA_FILE']; ?></td>
    </tr>
    <?php } while ($row_RsDownTrafic = mysqli_fetch_assoc($RsDownTrafic)); ?>
</table>
<?php
mysqli_free_result($RsDownTrafic);
?>

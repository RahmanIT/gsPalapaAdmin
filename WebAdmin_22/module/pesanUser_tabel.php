<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<?php 
$maxRows_RsPsnUser = 25;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RsPsnUser = $Halaman * $maxRows_RsPsnUser;
$query_RsPsnUser = "SELECT * FROM tb_pesan ORDER BY Id DESC";
$query_limit_RsPsnUser = sprintf("%s LIMIT %d, %d", $query_RsPsnUser, $startRow_RsPsnUser, $maxRows_RsPsnUser);
$RsPsnUser = mysqli_query($Congis, $query_limit_RsPsnUser) or die(mysqli_error());
$row_RsPsnUser = mysqli_fetch_assoc($RsPsnUser);

if (isset($_GET['Total'])) {
  $Total = $_GET['Total'];
} else {
  $all_RsPsnUser = mysqli_query($Congis, $query_RsPsnUser);
  $Total = mysqli_num_rows($all_RsPsnUser);
}
$totalPages_RsPsnUser = ceil($Total/$maxRows_RsPsnUser)-1;
?>

<table width="100%" class="table table-hover">
<thead>
  <tr>
    <td align="center"><strong>Id</strong></td>
    <td align="center"><strong>NAMA</strong></td>
    <td align="center"><strong>EMAIL</strong></td>
    <td align="center"><strong>SUBJEK</strong></td>
    <td align="center"><strong>TANGGAL</strong></td>
    <td align="center"><strong>IP_ADDR</strong></td>
  </tr>
</thead>
<tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_RsPsnUser['Id']; ?></td>
      <td align="left"><?php echo $row_RsPsnUser['NAMA']; ?></td>
      <td><?php echo $row_RsPsnUser['EMAIL']; ?></td>
      <td align="left"><?php echo $row_RsPsnUser['SUBJEK']; ?></td>
      <td><?php echo $row_RsPsnUser['TANGGAL']; ?></td>
      <td><?php echo $row_RsPsnUser['IP_ADDR']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="5" align="left" bgcolor="#EDFBFE"><?php echo $row_RsPsnUser['COMMEN']; ?></td>
      </tr>
    <?php } while ($row_RsPsnUser = mysqli_fetch_assoc($RsPsnUser)); ?>
</tbody>
</table>
<?php
mysqli_free_result($RsPsnUser);
}
?>

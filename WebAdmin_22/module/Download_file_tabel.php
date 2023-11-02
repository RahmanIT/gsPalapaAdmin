<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){   
$maxRows_RstDownload = 10;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RstDownload = $Halaman * $maxRows_RstDownload;
if($P[0]["ROLE"]==3){
	   $quetFt= " WHERE KD_USER=".$P[0]["KD_USER"];
	 }
	 if($P[0]["ROLE"]==2){
	   $quetFt= "";
	 }
$query_RstDownload = "SELECT * FROM tb_download $quetFt ORDER BY KD_FILE DESC";
$query_limit_RstDownload = sprintf("%s LIMIT %d, %d", $query_RstDownload, $startRow_RstDownload, $maxRows_RstDownload);
$RstDownload = mysqli_query($Congis, $query_limit_RstDownload) or die(mysqli_error());
$row_RstDownload = mysqli_fetch_assoc($RstDownload);
if (isset($_GET['total'])) {
  $total = $_GET['total'];
} else {
  $all_RstDownload = mysqli_query($Congis, $query_RstDownload);
  $total = mysqli_num_rows($all_RstDownload);
}
$totalPages_RstDownload = ceil($total/$maxRows_RstDownload)-1;
?>
<table width="100%" class="table table-hover">
 <thead>
  <tr>
    <td>NO</td>
    <td>NAMA FILES</td>
    <td>FILES</td>
    <td>TANGGAL UPLOAD</td>
    <td>&nbsp;</td>
  </tr>
</thead>
<tbody>
  <?php if($total>0){ do { ?>
    <tr>
      <td><?php echo $row_RstDownload['KD_FILE']; ?></td>
      <td><?php echo $row_RstDownload['NAMA_FILE']; ?></td>
      <td><?php echo $row_RstDownload['FILE_NAME']; ?></td>
      <td><?php echo $row_RstDownload['TANGGAL']; ?></td>
      <td>
       <button type="button" onclick="EditData('<?php echo $row_RstDownload['NAMA_FILE']; ?>',<?php echo $row_RstDownload['KD_FILE']; ?>)" class="btn btn-xs btn-warning">Edit</button>
       <button type="button" onclick="Hapus('<?php echo $row_RstDownload['NAMA_FILE']; ?>','FileDownload',<?php echo $row_RstDownload['KD_FILE']; ?>)" class="btn btn-xs btn-danger">Hapus</button> 
      </td>
    </tr>
    <?php } while ($row_RstDownload = mysqli_fetch_assoc($RstDownload)); ?>
    <?php } ?>
</table>
<?php
mysqli_free_result($RstDownload);
?>

<?php } ?>
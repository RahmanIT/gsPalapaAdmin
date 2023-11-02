<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$maxRows_RsPeta = 10;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RsPeta = $Halaman * $maxRows_RsPeta;
mysqli_select_db($Congis, $database_Congis);
$query_RsPeta = "SELECT KD_FEATURE, NM_FEATURE, KETERANGAN, TANGGAL, IMAGE FROM tb_feture ORDER BY KD_FEATURE DESC";
$RsPeta = mysqli_query($Congis, $query_RsPeta) or die(mysqli_error());
$row_RsPeta = mysqli_fetch_assoc($RsPeta);
$totalRows_RsPeta = mysqli_num_rows($RsPeta);
?>
<table width="100%" class="table table-hover">
 <thead>
   <tr>
    <td width="15%" align="center"><strong>IMAGES</strong></td>
    <td width="31%" align="center"><strong>NAMA</strong></td>
    <td width="19%" align="center"><strong>KETERANGAN</strong></td>
    <td width="16%" align="center"><strong>TANGGAL</strong></td>
    <td width="19%" align="center"><strong>KELOLA</strong></td>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
      <td><img name="" src="<?php echo $nama_folder."/images/peta/80x80_".$row_RsPeta['IMAGE']; ?>" width="80" height="80" alt="" style="background-color: #CCCCCC"></td>
      <td><?php echo $row_RsPeta['NM_FEATURE']; ?></td>
      <td align="center"><?php echo $row_RsPeta['KETERANGAN']; ?></td>
      <td align="center"><?php echo $row_RsPeta['TANGGAL']; ?></td>
      <td align="center">
      <a href="<?php echo $nama_folder."/NSDI/".$row_RsPeta['NM_FEATURE']; ?>" target="_blank">   
        <button type="button" class="btn btn-xs btn-success">Lihat</button> 
      </a>
      <a href="<?php echo $nama_folder."/WebAdmin/Edit-Feature.jsp/".$row_RsPeta['KD_FEATURE']; ?>">
        <button type="button" class="btn btn-xs btn-warning" >Edit</button>
      </a>
      <button type="button" onClick="Hapus('<?php echo $row_RsPeta['NM_FEATURE']; ?>','Feature',<?php echo $row_RsPeta['KD_FEATURE']; ?>)" class="btn btn-xs btn-danger">Hapus</button>               
      </td>
    </tr>
    <?php } while ($row_RsPeta = mysqli_fetch_assoc($RsPeta)); ?>
   </tbody>
</table>
<?php
mysqli_free_result($RsPeta);
}
?>

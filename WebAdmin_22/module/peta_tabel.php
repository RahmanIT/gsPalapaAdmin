<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$maxRows_RsPeta = 10;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
}else{
  $cari ='';
}
$startRow_RsPeta = $Halaman * $maxRows_RsPeta;
mysqli_select_db($Congis, $database_Congis);
$query_RsPeta = "SELECT KD_PETA, NAMA, TYPE_IG, MAP_TAG, TGL_MODIF, IMAGE FROM tb_peta WHERE MAP_TAG LIKE '%$cari%' ORDER BY KD_PETA DESC";
$query_limit_RsPeta = sprintf("%s LIMIT %d, %d", $query_RsPeta, $startRow_RsPeta, $maxRows_RsPeta);
$RsPeta = mysqli_query($Congis, $query_limit_RsPeta) or die(mysqli_error());
$row_RsPeta = mysqli_fetch_assoc($RsPeta);
if (isset($_GET['totalRows_RsPeta'])) {
  $totalRows_RsPeta = $_GET['totalRows_RsPeta'];
} else {
  $all_RsPeta = mysqli_query($Congis, $query_RsPeta);
  $totalRows_RsPeta = mysqli_num_rows($all_RsPeta);
}
$totalPages_RsPeta = ceil($totalRows_RsPeta/$maxRows_RsPeta)-1;
?>
<table width="100%" class="table table-hover">
 <thead>
   <tr>
    <td width="15%" align="center"><strong>IMAGES</strong></td>
    <td width="20%" align="center"><strong>NAMA</strong></td>
    <td width="19%" align="center"><strong>KATAKUNCI</strong></td>
    <td width="19%" align="center"><strong>TYPE IG</strong></td>
    <td width="16%" align="center"><strong>TGL MODIF</strong></td>
    <td width="19%" align="center"><strong>KELOLA</strong></td>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
      <td><img name="" src="<?php echo $nama_folder."/images/peta/80x80_".$row_RsPeta['IMAGE']; ?>" width="80" height="80" alt="" style="background-color:#CCCCCC; border:#09F solid 1px;"></td>
      <td><?php echo $row_RsPeta['NAMA']; ?></td>
      <td align="center"><?php echo $row_RsPeta['MAP_TAG']; ?></td>
      <td align="center"><?php echo $row_RsPeta['TYPE_IG']; ?></td>
      <td align="center"><?php echo $row_RsPeta['TGL_MODIF']; ?></td>
      <td align="center">
      <a href="<?php echo $nama_folder."/Katalog/Metadata/".$row_RsPeta['KD_PETA']; ?>" target="_blank">   
        <button type="button" class="btn btn-xs btn-success">Lihat</button> 
      </a>
      <a href="<?php echo $nama_folder."/WebAdmin/Edit-Metadata.jsp/".$row_RsPeta['KD_PETA']; ?>">
        <button type="button" class="btn btn-xs btn-warning" >Edit</button>
      </a>
      <button type="button" onClick="Hapus('<?php echo $row_RsPeta['NAMA']; ?>','Peta',<?php echo $row_RsPeta['KD_PETA']; ?>)" class="btn btn-xs btn-danger">Hapus</button>               
      </td>
    </tr>
    <?php } while ($row_RsPeta = mysqli_fetch_assoc($RsPeta)); ?>
   </tbody>
</table>
<?php
mysqli_free_result($RsPeta);
}
?>

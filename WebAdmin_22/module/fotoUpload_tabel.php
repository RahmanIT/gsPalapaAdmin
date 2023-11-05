<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$maxRows_RstFhotosExp = 12;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}
$startRow_RstFhotosExp = $Halaman * $maxRows_RstFhotosExp;
if($P[0]["ROLE"]==3){
   $quetFt= " WHERE KD_USER=".$P[0]["KD_USER"];
}
 if($P[0]["ROLE"]==2){
   $quetFt= "";
}
$query_RstFhotosExp = "SELECT * FROM tb_fhoto_explor $quetFt ORDER BY KD DESC";
$query_limit_RstFhotosExp = sprintf("%s LIMIT %d, %d", $query_RstFhotosExp, $startRow_RstFhotosExp, $maxRows_RstFhotosExp);
$RstFhotosExp = mysqli_query($Congis, $query_limit_RstFhotosExp) or die(mysqli_error());
$row_RstFhotosExp = mysqli_fetch_assoc($RstFhotosExp);
if (isset($_GET['totalRows_RstFhotosExp'])) {
  $totalRows_RstFhotosExp = $_GET['totalRows_RstFhotosExp'];
} else {
  $all_RstFhotosExp = mysqli_query($Congis, $query_RstFhotosExp);
  $totalRows_RstFhotosExp = mysqli_num_rows($all_RstFhotosExp);
}
$totalPages_RstFhotosExp = ceil($totalRows_RstFhotosExp/$maxRows_RstFhotosExp)-1;
?>

  <?php if($totalRows_RstFhotosExp>0){ do { ?>
  <div class="col-lg-4 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <img src="<?php echo $nama_folder."/files/".$row_RstFhotosExp['FOTO']; ?>" width="300" alt=""><br/>
                              <a href="<?php echo $nama_folder."/files/".$row_RstFhotosExp['FOTO']; ?>" target="_blank">
                              <button type="button" class="btn btn-sm btn-success">Lihat</button>
                              </a>
                            <button type="button" onClick="UrlFoto('<?php echo "/WebPortal/files/".$row_RstFhotosExp['FOTO']; ?>')" class="btn btn-sm btn-warning">URL</button>
                           <button type="button" onClick="Hapus('<?php echo $row_RstFhotosExp['FOTO']; ?>','FotoExp',<?php echo $row_RstFhotosExp['KD']; ?>)" class="btn btn-sm btn-danger">Hapus</button>
   						</div>
                      </div>
                </div>
    <?php } while ($row_RstFhotosExp = mysqli_fetch_assoc($RstFhotosExp)); ?>
<?php } else { echo "<h2>Belum ada data</h2>"; }?>
<?php
mysqli_free_result($RstFhotosExp);
}
?>

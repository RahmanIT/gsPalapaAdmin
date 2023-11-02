<?php 
$maxRows_RstFeature = 8;
$Page = 0;
if (isset($_GET['Page'])) {
  $Page = $_GET['Page'];
}
$startRow_RstFeature = $Page * $maxRows_RstFeature;
$query_RstFeature = "SELECT KD_FEATURE, NM_FEATURE, KETERANGAN, TANGGAL, IMAGE FROM tb_feture ORDER BY KD_FEATURE DESC";
$query_limit_RstFeature = sprintf("%s LIMIT %d, %d", $query_RstFeature, $startRow_RstFeature, $maxRows_RstFeature);
$RstFeature = mysqli_query($Congis,$query_limit_RstFeature) or die(mysqli_error());
$row_RstFeature = mysqli_fetch_assoc($RstFeature);

if (isset($_GET['totalRows_RstFeature'])) {
  $totalRows_RstFeature = $_GET['totalRows_RstFeature'];
} else {
  $all_RstFeature = mysqli_query($Congis, $query_RstFeature);
  $totalRows_RstFeature = mysqli_num_rows($all_RstFeature);
}
$totalPages_RstFeature = ceil($totalRows_RstFeature/$maxRows_RstFeature)-1;
?>
  <?php if($totalRows_RstFeature>0){ do { ?>
				<!-- Item Project and Filter Name -->
				<li class="item-thumbs col-lg-3 design" data-id="id-0" data-type="<?php echo $row_RstFeature['KD_FEATURE']; ?>">
				<!-- Fancybox - Gallery Enabled - Title - Full Image -->
				<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php echo $row_RstFeature['KETERANGAN']; ?>" href="<?php echo $nama_folder ?>/NSDI/<?php echo $row_RstFeature['NM_FEATURE']; ?>">
				<span class="overlay-img"></span>
				<span class="overlay-img-thumb font-icon-plus"></span>
				</a>
				<!-- Thumb Image and Description -->
				<img style="border:#3366FF solid 1px;" src="<?php echo $nama_folder ?>/images/peta/300x250_<?php echo $row_RstFeature['IMAGE']; ?>" alt="<?php echo $row_RstFeature['KETERANGAN']; ?>.">
                <center><a><b><?php echo $row_RstFeature['NM_FEATURE']; ?></b></a></center>
                </li>
				<!-- End Item Project -->  
  
    <?php } while ($row_RstFeature = mysqli_fetch_assoc($RstFeature)); 
	
  } else { ?>
	 		<div class="alert alert-info">
				<strong>Info!</strong> Untuk saat ini pemetaan partisipataif tidak tersedian, silahkan coba dilain waktu.
			</div>
	<?php }	?>
    <input name="TotalPageS" id="TotalPageS" type="hidden" value="<?php echo $totalPages_RstFeature; ?>" />
<?php
mysqli_free_result($RstFeature);
?>

<?php
$maxRows_RstPetaGalery = 9;
if (isset($_GET['Page'])) {
  $Page = $_GET['Page'];
}else{
  $Page = 0;
}

if ($_GET['d']<>"") {
  $f = "WHERE NAMA like '%".$_GET['d']."%' ";
}else{
  $f = "";
}

$startRow_RstPetaGalery = $Page * $maxRows_RstPetaGalery;
$query_RstPetaGalery = "SELECT KD_PETA, NAMA, SUMMARY, MAP_SERVER, TYPE_IG, IMAGE FROM tb_peta $f ORDER BY TYPE_IG, KD_PETA DESC ";
$query_limit_RstPetaGalery = sprintf("%s LIMIT %d, %d", $query_RstPetaGalery, $startRow_RstPetaGalery, $maxRows_RstPetaGalery);
$RstPetaGalery = mysql_query($query_limit_RstPetaGalery, $Congis) or die(mysql_error());
$row_RstPetaGalery = mysql_fetch_assoc($RstPetaGalery);

if (isset($_GET['totalRows_RstPetaGalery'])) {
  $totalRows_RstPetaGalery = $_GET['totalRows_RstPetaGalery'];
} else {
  $all_RstPetaGalery = mysql_query($query_RstPetaGalery);
  $totalRows_RstPetaGalery = mysql_num_rows($all_RstPetaGalery);
}
$totalPages_RstPetaGalery = ceil($totalRows_RstPetaGalery/$maxRows_RstPetaGalery)-1;$row_RstPetaGalery['NAMA']
?>
<?php if ($totalRows_RstPetaGalery>0){ ?>
  <?php do { ?>
  						<!-- Item Project and Filter Name -->
						<li class="item-thumbs col-lg-4 design" data-id="id-0" data-type="<?php echo $row_RstPetaGalery['TYPE_IG']; ?>">
						<!-- Fancybox - Gallery Enabled - Title - Full Image -->
						<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php echo $row_RstPetaGalery['NAMA']; ?>" href="<?php echo $nama_folder ?>/Katalog/Metadata/<?php echo $row_RstPetaGalery['KD_PETA']; ?>">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-icon-plus"></span>
						</a>
						<!-- Thumb Image and Description -->
						<img style="border:#3366FF solid 1px;" src="<?php echo $nama_folder ?>/images/peta/300x250_<?php echo $row_RstPetaGalery['IMAGE']; ?>" alt="<?php echo $row_RstPetaGalery['SUMMARY']; ?>.">
                        <center><a><b><?php echo $row_RstPetaGalery['NAMA']; ?></b></a></center>
                        </li>
						<!-- End Item Project -->
    
    <?php } while ($row_RstPetaGalery = mysql_fetch_assoc($RstPetaGalery));
  } else { echo"<div class='alert alert-warning'><strong>Peringatan!  </strong> Peta yang anda  cari tidak ditemukan.</div>";}; ?>
    <input name="TotalPageS" id="TotalPageS" type="hidden" value="<?php echo $totalPages_RstPetaGalery; ?>" />
<?php
mysql_free_result($RstPetaGalery);
?>

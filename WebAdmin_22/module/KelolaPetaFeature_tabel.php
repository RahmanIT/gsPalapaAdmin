<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
    <?php 
    $maxRows_RstFtLyr = 10;
    $Halaman = 0;
    if (isset($_GET['Halaman'])) {
      $Halaman = $_GET['Halaman'];
    }
    if (isset($_GET['cari'])) {
      $cari = $_GET['cari'];
    } else {
    $cari='';
    }
    $startRow_RstFtLyr = $Halaman * $maxRows_RstFtLyr;
    $query_RstFtLyr = "SELECT tb_feature_edit.KD_FT, tb_feature_edit.NM_FEATURE, tb_feature_edit.URL_FEATURE, tb_feature_edit.AKSES, tb_feature_edit.TANGGAL, tb_feature_edit.KD_USER, tb_admin.INISIAL FROM  tb_feature_edit INNER JOIN tb_admin ON tb_feature_edit.KD_USER = tb_admin.KD_USER WHERE tb_feature_edit.NM_FEATURE LIKE '%$cari%'";
    $query_limit_RstFtLyr = sprintf("%s LIMIT %d, %d", $query_RstFtLyr, $startRow_RstFtLyr, $maxRows_RstFtLyr);
    $RstFtLyr = mysqli_query($Congis, $query_limit_RstFtLyr) or die(mysqli_error());
    $row_RstFtLyr = mysqli_fetch_assoc($RstFtLyr);
    
    if (isset($_GET['totalRows_RstFtLyr'])) {
      $totalRows_RstFtLyr = $_GET['totalRows_RstFtLyr'];
    } else {
      $all_RstFtLyr = mysqli_query($Congis, $query_RstFtLyr);
      $totalRows_RstFtLyr = mysqli_num_rows($all_RstFtLyr);
    }
    $totalPages_RstFtLyr = ceil($totalRows_RstFtLyr/$maxRows_RstFtLyr)-1;
    ?>
    <div class="table-responsive">
    <table class="table table-hover table-striped">
    <thead>
      <tr>
        <td>NO</td>
        <td>GEOSPASIAL DATA</td>
        <td>TANGGAL DATA</td>
        <td>SUMBER</td>
        <td colspan="2">HAK AKSES</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     </thead>
    <tbody>
      <?php $n=1; do { ?>
        <tr>
          <td><?php echo $n + ($Halaman * $maxRows_RstFtLyr) ?></td>
          <td><a href="<?php echo $row_RstFtLyr['URL_FEATURE']; ?>" target="_blank"><?php echo $row_RstFtLyr['NM_FEATURE']; ?></a></td>
          <td><?php echo $row_RstFtLyr['TANGGAL']; ?></td>
          <td><?php echo $row_RstFtLyr['INISIAL']; ?></td>
          <td><?php echo $row_RstFtLyr['AKSES']; ?></td>
          <td><img src="<?php echo $nama_folder; ?>/images/useredit.png" onclick="EditFeature(<?php echo $row_RstFtLyr['KD_FT']; ?>,'<?php echo $row_RstFtLyr['NM_FEATURE']; ?>','<?php echo $row_RstFtLyr['URL_FEATURE']; ?>','<?php echo $row_RstFtLyr['AKSES']; ?>')" width="16" height="16" alt="Edit Hak Akses" /></td>
          <td><a href="<?php echo $nama_folder; ?>/FeatureEdittoTools.jsp/<?php echo $row_RstFtLyr['KD_FT']; ?>" target="_blank"><img src="<?php echo $nama_folder; ?>/images/nav_fullextent.png" width="16" height="16" alt="Open" /></a></td>
          <td><img src="<?php echo $nama_folder; ?>/images/nav_decline.png" onclick="HapusSHPpanel(<?php echo $row_RstFtLyr['KD_FT']; ?>,'<?php echo $row_RstFtLyr['NM_FEATURE']; ?>')" width="16" height="16" alt="Delete" /></td>
        </tr>
        <?php $n++;} while ($row_RstFtLyr = mysqli_fetch_assoc($RstFtLyr)); ?>
    </tbody>
    </table>
    </div>
    <?php
    mysqli_free_result($RstFtLyr);
    ?>
<?php } ?>
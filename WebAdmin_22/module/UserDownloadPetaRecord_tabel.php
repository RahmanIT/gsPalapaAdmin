<?php
$maxRows_RsDownTrafic = 10;
$Halaman = 0;
if (isset($_GET['Halaman'])) {
  $Halaman = $_GET['Halaman'];
}

if ($_GET['ft']=="F") {
  $SqlF = " WHERE tb_user_petadwn.LAMPIRAN <> '-'";
} else{
  $SqlF = "";
}

$startRow_RsDownTrafic = $Halaman * $maxRows_RsDownTrafic;
$query_RsDownTrafic = "SELECT tb_user_petadwn.ID, tb_user_petadwn.STS_K, tb_user_petadwn.NAMA, tb_user_petadwn.EMAIL, tb_user_petadwn.PENGGUNA, tb_user_petadwn.KET, tb_user_petadwn.TANGGAL, tb_user_petadwn.IP_ADDR, tb_peta.NAMA AS NAMA_PETA, tb_user_petadwn.LAMPIRAN FROM tb_user_petadwn INNER JOIN tb_peta ON tb_user_petadwn.KD_PETA = tb_peta.KD_PETA $SqlF ORDER  BY tb_user_petadwn.ID DESC";
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
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped">
  <tr>
    <td align="center"><strong>ID</strong></td>
    <td align="center"><strong>NAMA</strong></td>
    <td align="center"><strong>EMAIL</strong></td>
    <td align="center"><strong>PENGGUNA</strong></td>
    <td align="center"><strong>KETERANGAN</strong></td>
    <td align="center"><strong>TANGGAL</strong></td>
    <td align="center"><strong>IP ADDR</strong></td>
    <td align="center"><strong>NAMA PETA</strong></td>
    <td align="center"><strong>#</strong></td>
    <td align="center">Status</td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle"><?php echo $row_RsDownTrafic['ID']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['NAMA']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['EMAIL']; ?></td>
      <td align="left">
      <?php if ($row_RsDownTrafic['PENGGUNA']=="1"){ echo "Umum"; }
	        else if($row_RsDownTrafic['PENGGUNA']=="2"){ echo "Akademi"; }
			 else { echo "K/L/Pemda"; };
	   ?>
      </td>
      <td><?php echo $row_RsDownTrafic['KET']; ?></td>
      <td><?php echo $row_RsDownTrafic['TANGGAL']; ?></td>
      <td><?php echo $row_RsDownTrafic['IP_ADDR']; ?></td>
      <td align="left"><?php echo $row_RsDownTrafic['NAMA_PETA']; ?></td>
      <td align="left">
       <?php if($row_RsDownTrafic['LAMPIRAN']!="-"){ ?>
       <a href="<?php echo $nama_folder."/Lampiran/$row_RsDownTrafic[LAMPIRAN]"; ?>" target="_blank"><i class="fa fa-paperclip fa-fw"></i></a>
      <?php } else { echo"-"; } ?>
      </td>
      <td align="center" valign="middle">
      <?php if($row_RsDownTrafic['STS_K']=="1"){  ?>
      <button type="button" class="btn btn-warning btn-xs" onclick="FerifikasiP('<?php echo $row_RsDownTrafic["LAMPIRAN"]; ?>','<?php echo $row_RsDownTrafic['ID']; ?>')">Ferifikasi</button>
      <?php } else if($row_RsDownTrafic['STS_K']=="2"){  ?>
      <button type="button" class="btn btn-primary btn-xs" onclick="DlgKirimPeta('<?php echo $row_RsDownTrafic["EMAIL"]; ?>','<?php echo $row_RsDownTrafic["NAMA"]; ?>','<?php echo $row_RsDownTrafic['ID']; ?>')">Kirim</button>
      <?php } else if($row_RsDownTrafic['STS_K']=="5"){  ?>
      <button type="button" class="btn btn-success btn-xs">Succes</button>
      <?php } else if($row_RsDownTrafic['STS_K']=="4"){  ?>
      <button type="button" class="btn btn-danger btn-xs" onclick="FerifikasiP('<?php echo $row_RsDownTrafic["LAMPIRAN"]; ?>','<?php echo $row_RsDownTrafic['ID']; ?>')"">Fault</button>
      <?php } ?>
      </td>
    </tr>
    <?php } while ($row_RsDownTrafic = mysqli_fetch_assoc($RsDownTrafic)); ?>
</table>
</div>
<?php
mysqli_free_result($RsDownTrafic);
?>

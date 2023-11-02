<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$maxRows_rstShefile = 20;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	$startRow_rstShefile = $Halaman * $maxRows_rstShefile;
	
	$colname_rstShefile = "-1";
	if (isset($_GET['cari'])) {
	  $ftcari = $_GET['cari'];
	}
	$ftp_server = mysqli_result(mysqli_query($Congis, "SELECT ftp_id1 FROM tb_setting"), 0);
	$meID = $_SESSION['NmInisial'];
	$query_rstShefile = ("SELECT   tb_admin.INISIAL,  tb_shafile_zip.KD_USER, tb_shafile_zip.KD_FILE ,tb_shafile_zip.AKSES,   tb_shafile_zip.NAMA,  tb_shafile_zip.DIR,   tb_shafile_zip.FILE_NAME,   tb_shafile_zip.TANGGAL,   tb_shafile_zip.WAKTU FROM   tb_shafile_zip   INNER JOIN tb_admin ON tb_shafile_zip.KD_USER = tb_admin.KD_USER WHERE tb_shafile_zip.KETERANGAN LIKE '%$ftcari%' and tb_shafile_zip.AKSES='all' or tb_shafile_zip.AKSES LIKE '%$meID%'");
	$query_limit_rstShefile = sprintf("%s LIMIT %d, %d", $query_rstShefile, $startRow_rstShefile, $maxRows_rstShefile);
	$rstShefile = mysqli_query($Congis, $query_limit_rstShefile) or die(mysqli_error());
	$row_rstShefile = mysqli_fetch_assoc($rstShefile);
	
	if (isset($_GET['totalRows_rstShefile'])) {
	  $totalRows_rstShefile = $_GET['totalRows_rstShefile'];
	} else {
	  $all_rstShefile = mysqli_query($Congis, $query_rstShefile);
	  $totalRows_rstShefile = mysqli_num_rows($all_rstShefile);
	}
	$totalPages_rstShefile = ceil($totalRows_rstShefile/$maxRows_rstShefile)-1;
	?>
	<div class="table-responsive">
	<table width="100%" class="table table-hover">
	 <thead>
	  <tr>
		<td>NO</td>
		<td>NAMA</td>
		<td>KATEGORI</td>
		<td>TANGGAL</td>
		<td>WAKTU</td>
		<td colspan="2">HAK AKSES</td>
		<td>SUMBER</td>
		<td colspan="3">KELOLA</td>
		</tr>
	  </thead>
	  <tbody>
	  <?php $no=1; do { ?>
		<tr>
		  <td><?php echo $no+($Halaman*$maxRows_rstShefile); ?></td>
		  <td><?php echo $row_rstShefile['NAMA']; ?></td>
		  <td><?php echo $row_rstShefile['DIR']; ?></td>
		  <td><?php echo $row_rstShefile['TANGGAL']; ?></td>
		  <td><?php echo $row_rstShefile['WAKTU']; ?></td>
		  <td><?php echo $row_rstShefile['AKSES']; ?></td>
		  <?php if ($_SESSION['KdUser']==$row_rstShefile['KD_USER']){ ?>
		  <td><img src="<?php echo $nama_folder; ?>/images/useredit.png" title="Edit Hak Akses" onclick="EditOPakses(<?php echo $row_rstShefile['KD_FILE']; ?>,'<?php echo $row_rstShefile['AKSES']; ?>')" width="16" height="16" alt="Edit" /></td>
		  <td><?php echo $row_rstShefile['INISIAL']; ?></td>
		  <td align="center"><a href="<?php echo "ftp://".$_SESSION['NmInisial'].":".$_SESSION['ftpID']."@$ftp_server/".$row_rstShefile['DIR']."/".$row_rstShefile['FILE_NAME']; ?>"><img src="<?php echo $nama_folder; ?>/images/nav_fullextent.png" title="Download" width="16" height="16" alt="Unduh"></a></td>
		  <td align="center"><img src="<?php echo $nama_folder; ?>/images/database.png" title="Upload ke Geoserver" onclick="TfPanelOn('<?php echo $row_rstShefile['FILE_NAME']; ?>','<?php echo $row_rstShefile['DIR']; ?>')" width="16" height="16" alt="Publish" /></td>
		  <td align="center"><img src="<?php echo $nama_folder; ?>/images/nav_decline.png" title="Hapus" onclick="HapusSHPpanel(<?php echo $row_rstShefile['KD_FILE']; ?>,'<?php echo $row_rstShefile['FILE_NAME']; ?>','<?php echo $row_rstShefile['DIR']; ?>')" width="16" height="16" alt="Hapus" /></td>
			<?php }else { ?>
		  <td><img src="<?php echo $nama_folder; ?>/images/useredi_ds.png" title="Edit Hak Akses"  width="16" height="16" alt="Edit" /></td>
		  <td><?php echo $row_rstShefile['INISIAL']; ?></td>
		  <td align="center"><a href="<?php echo "ftp://".$_SESSION['NmInisial'].":".$_SESSION['ftpID']."@localhost/".$row_rstShefile['DIR']."/".$row_rstShefile['FILE_NAME']; ?>"><img src="<?php echo $nama_folder; ?>/images/nav_fullextent.png" title="Download" width="16" height="16" alt="Unduh"></a></td>
		  <td align="center"><img src="<?php echo $nama_folder; ?>/images/database_bw.png" title="Upload ke Geoserver"  width="16" height="16" alt="Publish" /></td>
		  <td align="center"><img src="<?php echo $nama_folder; ?>/images/nav_decline_bw.png" title="Hapus"  width="16" height="16" alt="Hapus" /></td>
			<?php }?>
		</tr>
		<?php $no++; } while ($row_rstShefile = mysqli_fetch_assoc($rstShefile)); ?>
	</tbody>
	</table>
	</div>
	<?php
	mysqli_free_result($rstShefile);
	?>
<?php } ?>
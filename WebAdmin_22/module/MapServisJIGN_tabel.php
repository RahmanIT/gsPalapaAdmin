<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 12){ ?>
	<?php 
	$maxRows_RstSrvs = 20;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	if (isset($_GET['cari'])) {
	  $ftcari = $_GET['cari'];
	}else{
	  $ftcari='';
	}
	
	$startRow_RstSrvs = $Halaman * $maxRows_RstSrvs;
	$query_RstSrvs = "SELECT tb_mapservis_jign.KD_SRV, tb_mapservis_jign.NM_SERVIS, tb_mapservis_jign.KD_JDSN, tb_mapservis_jign.URL_SERVIS, tb_mapservis_jign.KD_USER, tb_mapservis_jign.TYPE_SERVIS, tb_jdsn.NM_JDSN, tb_mapservis_jign.TANGGAL FROM  tb_jdsn INNER JOIN tb_mapservis_jign ON tb_mapservis_jign.KD_JDSN=tb_jdsn.KD_JDSN WHERE tb_mapservis_jign.NM_SERVIS LIKE '%$ftcari%' ";
	$query_limit_RstSrvs = sprintf("%s LIMIT %d, %d", $query_RstSrvs, $startRow_RstSrvs, $maxRows_RstSrvs);
	$RstSrvs = mysqli_query($Congis, $query_limit_RstSrvs) or die(mysqli_error());
	$row_RstSrvs = mysqli_fetch_assoc($RstSrvs);
	
	if (isset($_GET['totalRows_RstSrvs'])) {
	  $totalRows_RstSrvs = $_GET['totalRows_RstSrvs'];
	} else {
	  $all_RstSrvs = mysqli_query($Congis, $query_RstSrvs);
	  $totalRows_RstSrvs = mysqli_num_rows($all_RstSrvs);
	}
	$totalPages_RstSrvs = ceil($totalRows_RstSrvs/$maxRows_RstSrvs)-1;
	?>
	
	<table width="100%" class="table table-hover">
	 <thead>
	  <tr>
		<td width="4%">NO</td>
		<td width="30%">NAMA SERVIS</td>
		<td width="13%">TYPE </td>
		<td width="23%">SUMBER SERVER</td>
		<td width="20%">TANGGAL</td>
		<td width="5%" align="center">Edit</td>
		<td width="5%" align="center">Hapus</td>
	  </tr>
	</thead>
	<tbody>
	  <?php $i=1; do { ?>
		<tr>
		  <td><?php echo $i+($Halaman*$maxRows_RstSrvs) ?></td>
		  <td><?php echo $row_RstSrvs['NM_SERVIS']; ?></td>
		  <td><?php echo $row_RstSrvs['TYPE_SERVIS']; ?></td>
		  <td><?php echo $row_RstSrvs['NM_JDSN']; ?></td>
		  <td><?php echo $row_RstSrvs['TANGGAL']; ?></td>
		  <td align="center"><img onclick="EditFromWMS('<?php echo $row_RstSrvs['NM_SERVIS']; ?>','<?php echo $row_RstSrvs['TYPE_SERVIS']; ?>','<?php echo $row_RstSrvs['URL_SERVIS']; ?>','<?php echo $row_RstSrvs['KD_JDSN']; ?>','<?php echo $row_RstSrvs['KD_USER']; ?>','<?php echo $row_RstSrvs['KD_SRV']; ?>')" src="<?php echo $nama_folder; ?>/images/useredit.png" width="16" height="16" alt="Edit" /></td>
		  <td align="center"><img onclick="Hapus('<?php echo $row_RstSrvs['NM_SERVIS']; ?>', 'MapServisJIGN',<?php echo $row_RstSrvs['KD_SRV']; ?>)" src="<?php echo $nama_folder; ?>/images/nav_decline.png" width="16" height="16" alt="Delete" /></td>
		</tr>
		<?php $i++; } while ($row_RstSrvs = mysqli_fetch_assoc($RstSrvs)); ?>
	 </tbody>
	</table>
	<?php
	mysqli_free_result($RstSrvs);
	?>
<?php } ?>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$maxRows_Rs = 10;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	if (isset($_GET['cari'])) {
	  $cari = $_GET['cari'];
	} else {
	$cari='';
	}
	$startRow_Rs = $Halaman * $maxRows_Rs;
	$query_Rs = "SELECT * FROM layermap ORDER BY LYR_IDX ASC";
	$query_limit_Rs = sprintf("%s LIMIT %d, %d", $query_Rs, $startRow_Rs, $maxRows_Rs);
	$Rs = mysqli_query($Congis, $query_limit_Rs) or die(mysqli_error());
	$row_Rs = mysqli_fetch_assoc($Rs);
	if (isset($_GET['totalRows_Rs'])) {
	  $totalRows_Rs = $_GET['totalRows_Rs'];
	} else {
	  $all_Rs = mysqli_query($Congis, $query_Rs);
	  $totalRows_Rs = mysqli_num_rows($all_Rs);
	}
	$totalPages_Rs = ceil($totalRows_Rs/$maxRows_Rs)-1;
	?>	
	<table class="table table-hover table-striped">
	<thead>
	  <tr>
		<td align="center">Kode</td>
		<td align="center">Nama Layer</td>
		<td align="center">Visible</td>
		<td align="center">Index</td>
		<td align="center">Login</td>
		<td align="center">Typr</td>
		<td align="center"><strong>#</strong></td>
		</tr>
	 </thead>
	<tbody>
	  <?php do { ?>
		<tr>
		  <td><?php echo $row_Rs['Id']; ?></td>
		  <td align="left"><?php echo $row_Rs['LABEL']; ?></td>
		  <td><?php echo $row_Rs['VISIBLE']; ?></td>
		  <td><?php echo $row_Rs['LYR_IDX']; ?></td>
		  <td><?php echo $row_Rs['LOGIN_ST']; ?></td>
		  <td><?php echo $row_Rs['TYPE']; ?></td>
		  <td>
			<button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_Rs['LABEL']; ?>','<?php echo $row_Rs['URL']; ?>','<?php echo $row_Rs['TITLE']; ?>','<?php echo $row_Rs['TYPE']; ?>','<?php echo $row_Rs['VISIBLE']; ?>','<?php echo $row_Rs['LYR_IDX']; ?>','<?php echo $row_Rs['LOGIN_ST']; ?>',<?php echo $row_Rs['Id']; ?>,'<?php echo $row_Rs['LYNAME']; ?>')">Edit</button>
			<button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_Rs['LABEL']; ?>','Layer',<?php echo $row_Rs['Id']; ?>)">Hapus</button></td>
		  </tr>
		<?php } while ($row_Rs = mysqli_fetch_assoc($Rs)); ?>
	</tbody>
	</table>
	<?php  mysqli_free_result($Rs); ?>
<?php } ?>
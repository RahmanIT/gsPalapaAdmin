<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$maxRows_RstPeta = 10;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	$startRow_RstPeta = $Halaman * $maxRows_RstPeta;
	$query_RstPeta = "SELECT ID, NM_SERVICE,URL_SERVICE, TYPE_S, TANSPARAN, LEGEND, NO_IDX, START_OPT FROM tb_mapservice ORDER BY NO_IDX ASC";
	$query_limit_RstPeta = sprintf("%s LIMIT %d, %d", $query_RstPeta, $startRow_RstPeta, $maxRows_RstPeta);
	$RstPeta = mysqli_query($Congis, $query_limit_RstPeta) or die(mysqli_error());
	$row_RstPeta = mysqli_fetch_assoc($RstPeta);
	$totalRows_RstPeta = mysqli_num_rows($RstPeta);
	?>
	<table width="100%" class="table table-hover">
	 <thead>
	  <tr>
		<td width="58%" align="center"><strong>NAMA PETA</strong></td>
		<td width="18%" align="center"><strong>TYPE</strong></td>
		<td width="24%" align="center"><strong>KELOLA</strong></td>
	  </tr>
	</thead>
	<tbody>
	  <?php do { ?>
		<tr>
		  <td><?php echo $row_RstPeta['NM_SERVICE']; ?></td>
		  <td align="center"><?php echo $row_RstPeta['TYPE_S']; ?></td>
		  <td align="center">
			 <button type="button" onclick="EditData('<?php echo $row_RstPeta['NM_SERVICE']; ?>','<?php echo $row_RstPeta['URL_SERVICE']; ?>','<?php echo $row_RstPeta['TYPE_S']; ?>','<?php echo $row_RstPeta['LEGEND']; ?>','<?php echo $row_RstPeta['START_OPT']; ?>','<?php echo $row_RstPeta['NO_IDX']; ?>','<?php echo $row_RstPeta['TANSPARAN']; ?>',<?php echo $row_RstPeta['ID']; ?>)" class="btn btn-outline btn-warning btn-xs">Edit</button>
			 <button type="button" onclick="Hapus('<?php echo $row_RstPeta['NM_SERVICE']; ?>','MapService',<?php echo $row_RstPeta['ID']; ?>)" class="btn btn-outline btn-danger btn-xs">Hapus</button>
			 
		  </td>
		</tr>
		<?php } while ($row_RstPeta = mysqli_fetch_assoc($RstPeta)); ?>
	 </tbody>
	</table>
	<?php
	mysqli_free_result($RstPeta);
} ?>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$colname_Rs = "-1";
	if (isset($_GET['model'])) {
	  $colname_Rs = $_GET['model'];
	}
	$query_Rs = sprintf("SELECT * FROM tb_modelling_data WHERE KD_MODEL = %s ORDER BY MAPIDX ASC",$colname_Rs);
	$Rs = mysqli_query($Congis, $query_Rs) or die(mysqli_error());
	$row_Rs = mysqli_fetch_assoc($Rs);
	$totalRows_Rs = mysqli_num_rows($Rs);
	?>
	<table width="100%" border="0" cellpadding="2" cellspacing="0"  class="table table-striped">
	  <tr>
		<td width="92" align="center">Kode</td>
		<td width="544" align="center">Nama Peta</td>
		<td width="108" align="center">Type</td>
		<td width="101" align="center">Index</td>
		 <td width="157" align="center">#</td>
	  </tr>
	  <?php do { ?>
		<tr>
		  <td align="center"><?php echo $row_Rs['KDMAP']; ?></td>
		  <td><?php echo $row_Rs['NM_MAP']; ?></td>
		  <td align="center"><?php echo $row_Rs['TYPE']; ?></td>
		  <td align="center"><?php echo $row_Rs['MAPIDX']; ?></td>
		  <td align="center">
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData(<?php echo $row_Rs['KDMAP']; ?>,<?php echo $row_Rs['KD_MODEL']; ?>,'<?php echo $row_Rs['NM_MAP']; ?>','<?php echo $row_Rs['URL_MAP']; ?>','<?php echo $row_Rs['LY_NAME']; ?>','<?php echo $row_Rs['VISIBLE']; ?>','<?php echo $row_Rs['TYPE']; ?>',<?php echo $row_Rs['MAPIDX']; ?>,'<?php echo $row_Rs['LY_EXTEND']; ?>')">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_Rs['NM_MAP']; ?>','WebAppData',<?php echo $row_Rs['KDMAP']; ?>)">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_Rs = mysqli_fetch_assoc($Rs)); ?>
	</table>
<?php } ?>
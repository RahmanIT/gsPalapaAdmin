<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$colname_Rs = "-1";
	if (isset($_GET['model'])) {
	  $colname_Rs = $_GET['model'];
	}
	$query_Rs = sprintf("SELECT * FROM tb_modelling_group WHERE KD_MODEL = %s ORDER BY PRIORITAS ASC",$colname_Rs);
	$Rs = mysqli_query($Congis, $query_Rs) or die(mysqli_error());
	$row_Rs = mysqli_fetch_assoc($Rs);
	$totalRows_Rs = mysqli_num_rows($Rs);
	?>
	<table width="100%" border="0" cellpadding="2" cellspacing="0"  class="table table-striped">
	  <tr>
		<td width="92" align="center">Kode</td>
		<td align="center">Nama Group</td>
		<td align="center">Keterangan</td>
		<td align="center">Akses</td>
        <td align="center">Proiritas</td>
		 <td width="157" align="center">Tools</td>
	  </tr>
	  <?php do { ?>
		<tr>
		  <td align="center"><?php echo $row_Rs['KDGROUP']; ?></td>
		  <td><?php echo $row_Rs['NAMAGROUP']; ?></td>
		  <td><?php echo $row_Rs['KETERNGAN']; ?></td>
		  <td align="center"><?php echo $row_Rs['AKSES']; ?></td>
          <td align="center"><?php echo $row_Rs['PRIORITAS']; ?></td>
		  <td align="center">
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData(<?php echo $row_Rs['KDGROUP']; ?>,<?php echo $row_Rs['KD_MODEL']; ?>,'<?php echo $row_Rs['NAMAGROUP']; ?>','<?php echo $row_Rs['KETERNGAN']; ?>','<?php echo $row_Rs['AKSES']; ?>',<?php echo $row_Rs['PRIORITAS']; ?>)">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_Rs['NAMAGROUP']; ?>','WebAppData',<?php echo $row_Rs['KDGROUP']; ?>)">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_Rs = mysqli_fetch_assoc($Rs)); ?>
	</table>
<?php } ?>
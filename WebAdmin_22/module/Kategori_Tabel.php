<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	$query_rsKategori = "SELECT * FROM tb_kategori";
	$rsKategori = mysqli_query($Congis, $query_rsKategori) or die(mysqli_error());
	$row_rsKategori = mysqli_fetch_assoc($rsKategori);
	$totalRows_rsKategori = mysqli_num_rows($rsKategori);
	?>
	<div class="table-responsive">
	<table width="100%" class="table table-hover">
	 <thead>
	  <tr>
		<td align="center"><strong>KODE</strong></td>
		<td align="center"><strong>NAMA</strong></td>
		<td align="center"><strong>KETERANGAN</strong></td>
		<td align="center"><strong>ICON</strong></td>
		<td align="center">&nbsp;</td>
	  </tr>
	</thead>
	<tbody>
	  <?php do { ?>
		<tr>
		  <td><?php echo $row_rsKategori['KD_KATEGORI']; ?></td>
		  <td><?php echo $row_rsKategori['NAMA']; ?></td>
		  <td><?php echo $row_rsKategori['KETERANGAN']; ?></td>
		  <td><?php echo $row_rsKategori['KTG_ICON']; ?></td>
		  <td>
		   <button type="button" onclick="EditData('<?php echo $row_rsKategori['NAMA']; ?>','<?php echo $row_rsKategori['KETERANGAN']; ?>','<?php echo $row_rsKategori['KTG_ICON']; ?>',<?php echo $row_rsKategori['KD_KATEGORI']; ?>)" class="btn btn-xs btn-warning">Edit</button>
		   <button type="button" onclick="Hapus('<?php echo $row_rsKategori['NAMA']; ?>', 'Kategori',<?php echo $row_rsKategori['KD_KATEGORI']; ?>)" class="btn btn-xs btn-danger">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsKategori = mysqli_fetch_assoc($rsKategori)); ?>
	 </tbody>
	</table>
	</div>
	<?php
	mysqli_free_result($rsKategori);
	?>
<?php } ?>
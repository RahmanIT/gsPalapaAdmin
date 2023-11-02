<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$query_rsSlideSh = "SELECT ID_SLD,JUDUL, KETERANGAN, FOTO FROM tb_slideshow ORDER BY ID_SLD DESC";
	$rsSlideSh = mysqli_query($Congis, $query_rsSlideSh) or die(mysqli_error());
	$row_rsSlideSh = mysqli_fetch_assoc($rsSlideSh);
	$totalRows_rsSlideSh = mysqli_num_rows($rsSlideSh);
	?>
	<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td width="5%" align="center"><strong>Foto</strong></td>
		<td width="28%" align="center"><strong>Judul</strong></td>
		<td width="44%" align="center"><strong>Title</strong></td>
		<td width="20%" align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
	  <?php if ($totalRows_rsSlideSh>0){ ?>
	  <?php do { ?>
		<tr>
		  <td><img name="" src="<?php echo $nama_folder; ?>/images/slides/120x40_<?php echo $row_rsSlideSh['FOTO']; ?>" width="120" height="60" alt=""></td>
		  <td><?php echo $row_rsSlideSh['JUDUL']; ?></td>
		  <td><?php echo $row_rsSlideSh['KETERANGAN']; ?></td>
		  <td align="center" valign="middle">
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_rsSlideSh['JUDUL']; ?>','<?php echo $row_rsSlideSh['ID_SLD']; ?>','<?php echo $row_rsSlideSh['KETERANGAN']; ?>')">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_rsSlideSh['KETERANGAN']; ?>','Pembina',<?php echo $row_rsSlideSh['ID_SLD']; ?>)">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsSlideSh = mysqli_fetch_assoc($rsSlideSh)); ?>
	</table>
	<?php
	  } //end lebih dari 0
	mysqli_free_result($rsSlideSh);
	?>
<?php } ?>
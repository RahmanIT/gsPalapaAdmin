<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$query_rsSlideSh = "SELECT * FROM basemap_layer ORDER BY KDMAP DESC";
	$rsSlideSh = mysqli_query($Congis, $query_rsSlideSh) or die(mysqli_error());
	$row_rsSlideSh = mysqli_fetch_assoc($rsSlideSh);
	$totalRows_rsSlideSh = mysqli_num_rows($rsSlideSh);
	?>
	<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td width="5%" align="center"><strong>Foto</strong></td>
		<td width="28%" align="center"><strong>Nama</strong></td>
		<td width="44%" align="center"><strong>Type</strong></td>
		<td width="20%" align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
	  <?php if ($totalRows_rsSlideSh>0){ ?>
	  <?php do { ?>
		<tr>
		  <td><img name="" src="data:image/png;base64,<?php echo $row_rsSlideSh['FOTO_S']; ?>" width="120" height="60" alt=""></td>
		  <td><?php echo $row_rsSlideSh['NAMA']; ?></td>
		  <td><?php echo $row_rsSlideSh['OL_TYPE']; ?></td>
		  <td align="center" valign="middle">
            <button type="button" class="btn btn-xs btn-success" onclick="InfoData('<?php echo $row_rsSlideSh['NAMA']; ?>','<?php echo $row_rsSlideSh['URL']; ?>','<?php echo $row_rsSlideSh['LYNAME']; ?>','<?php echo $row_rsSlideSh['OL_TYPE']; ?>',<?php echo $row_rsSlideSh['KDMAP']; ?>,'<?php echo $row_rsSlideSh['FOTO_S']; ?>')">Info</button>
            <?php if($P[0]["ROLE"]==2){?>
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_rsSlideSh['NAMA']; ?>','<?php echo $row_rsSlideSh['URL']; ?>','<?php echo $row_rsSlideSh['LYNAME']; ?>','<?php echo $row_rsSlideSh['OL_TYPE']; ?>',<?php echo $row_rsSlideSh['KDMAP']; ?>,'<?php echo $row_rsSlideSh['FOTO_S']; ?>')">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_rsSlideSh['NAMA']; ?>','Basemap',<?php echo $row_rsSlideSh['KDMAP']; ?>)">Hapus</button>
		    <?php } ?>
          </td>
		</tr>
		<?php } while ($row_rsSlideSh = mysqli_fetch_assoc($rsSlideSh)); ?>
	</table>
	<?php
	  } //end lebih dari 0
	mysqli_free_result($rsSlideSh);
	?>
<?php } ?>
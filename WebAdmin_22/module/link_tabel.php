<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$query_rsLink = "SELECT * FROM tb_link";
	$rsLink = mysqli_query($Congis, $query_rsLink) or die(mysqli_error());
	$row_rsLink = mysqli_fetch_assoc($rsLink);
	$totalRows_rsLink = mysqli_num_rows($rsLink);
	?>
	<table width="100%" class="table table-hover">
	 <thead> 
		<tr>
		<td width="13%" align="center">NO</td>
		<td width="22%" align="center">NAMA</td>
		<td width="46%" align="center">URL</td>
		<td width="19%" align="center">#</td>
		</tr>
	</thead>
	<tbody>
	  <?php do { ?>
		<tr>
		  <td><?php echo $row_rsLink['KD_LINK']; ?></td>
		  <td><?php echo $row_rsLink['NAMA']; ?></td>
		  <td><?php echo $row_rsLink['URL']; ?></td>
		  <td>
		   <button type="button" onclick="EditData('<?php echo $row_rsLink['NAMA']; ?>','<?php echo $row_rsLink['URL']; ?>','<?php echo $row_rsLink['KD_LINK']; ?>')" class="btn btn-xs btn-warning">Edit</button>
		   <button type="button" onclick="Hapus('<?php echo $row_rsLink['NAMA']; ?>','Link',<?php echo $row_rsLink['KD_LINK']; ?>)" class="btn btn-xs btn-danger">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsLink = mysqli_fetch_assoc($rsLink)); ?>
	 </tbody>
	</table>
	<?php
	
} ?>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$query_rsPembina = "SELECT * from tb_jdsn ORDER BY KD_JDSN DESC";
	$rsPembina = mysqli_query($Congis, $query_rsPembina) or die(mysqli_error());
	$row_rsJdsn = mysqli_fetch_assoc($rsPembina);
	$totalRows_rsPembina = mysqli_num_rows($rsPembina);
	?>
	<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td align="center"><strong>FOTO</strong></td>
		<td align="center"><strong>NAMA</strong></td>
		<td align="center"><strong>KETERANGAN</strong></td>
		<td align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
	 <?php if($totalRows_rsPembina>0){?>
	  <?php do { ?>
		<tr>
		  <td><img src="data:image/png;base64,<?php echo $row_rsJdsn['FOTO_S']; ?>" width="60" alt="Logo SJ"></td>
		  <td><?php echo $row_rsJdsn['NM_JDSN']; ?></td>
		  <td><?php echo $row_rsJdsn['KETERANGAN']; ?></td>          
		  <td>
          <button type="button" class="btn btn-xs btn-success" onclick="InfoData('<?php echo $row_rsJdsn['NM_JDSN']; ?>','<?php echo $row_rsJdsn['WEB_JIGN']; ?>','<?php echo $row_rsJdsn['SERVICE_URL']; ?>','<?php echo $row_rsJdsn['KETERANGAN']; ?>',<?php echo $row_rsJdsn['KD_JDSN']; ?>,'<?php echo $row_rsJdsn['TYPE']; ?>','<?php echo $row_rsJdsn['KATEGORI']; ?>')">Info</button>
          <?php if($P[0]["ROLE"]==2){?>
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_rsJdsn['NM_JDSN']; ?>','<?php echo $row_rsJdsn['WEB_JIGN']; ?>','<?php echo $row_rsJdsn['SERVICE_URL']; ?>','<?php echo $row_rsJdsn['KETERANGAN']; ?>',<?php echo $row_rsJdsn['KD_JDSN']; ?>,'<?php echo $row_rsJdsn['TYPE']; ?>','<?php echo $row_rsJdsn['KATEGORI']; ?>')">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_rsJdsn['NM_JDSN']; ?>','jign',<?php echo $row_rsJdsn['KD_JDSN']; ?>)">Hapus</button>
		  <?php } ?>
          </td>          
		</tr>
		<?php } while ($row_rsJdsn = mysqli_fetch_assoc($rsPembina)); ?>
	</table>
	<?php
	 }//end Lebih dari 0
	mysqli_free_result($rsPembina);
	?>
<?php } ?>
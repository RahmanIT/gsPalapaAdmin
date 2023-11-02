<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$query_RsBinder = "SELECT * FROM tb_binder ORDER BY KD DESC";
	$RsBinder = mysqli_query($Congis, $query_RsBinder) or die(mysqli_error());
	$row_RsBinder = mysqli_fetch_assoc($RsBinder);
	$totalRows_RsBinder = mysqli_num_rows($RsBinder);
	?>
  <table width="100%" class="table table-hover">
	 <thead>
	   <tr>
		<td>FOTO</td>
		<td>Nama</td>
		<td>URL</td>
		<td>&nbsp;</td>
	  </tr>
	</thead>
	<tbody>
	  <?php do {
      $ImgUrl = $conf["DataDir"]."/images/binder/250x60_".$row_RsBinder['FOTO'];							
		$img68 = base64_encode(file_get_contents($ImgUrl));?>
		<tr>
		  <td><img name="" src="data:image/jpeg;base64,<?php echo $img68; ?>" width="250" height="60" alt="" style="background-color: #999999"></td>
		  <td><?php echo $row_RsBinder['Nama']; ?></td>
		  <td><?php echo $row_RsBinder['URL']; ?></td>
		  <td>
		   <button type="button" onclick="EditData('<?php echo $row_RsBinder['Nama']; ?>','<?php echo $row_RsBinder['URL']; ?>','<?php echo $row_RsBinder['FOTO']; ?>',<?php echo $row_RsBinder['KD']; ?>)" class="btn btn-xs btn-warning">Edit</button>
		   <button type="button" onclick="Hapus('<?php echo $row_RsBinder['Nama']; ?>','Binder',<?php echo $row_RsBinder['KD']; ?>)" class="btn btn-xs btn-danger">Hapus</button>      
		  </td>
		</tr>
		<?php } while ($row_RsBinder = mysqli_fetch_assoc($RsBinder)); ?>
	</table>
	<?php
	mysqli_free_result($RsBinder);
	?>
<?php } ?>
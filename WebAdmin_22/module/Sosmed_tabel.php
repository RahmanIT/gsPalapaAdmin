<?php if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){

	$query_rsWebApp = "SELECT * FROM tb_sosmed";
	$rsWebApp = mysqli_query($Congis, $query_rsWebApp) or die(mysqli_error());
	$row_rsWebApp = mysqli_fetch_assoc($rsWebApp);
	$totalRows_rsWebApp = mysqli_num_rows($rsWebApp); ?>
	<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td align="center"><strong>NO</strong></td>
		<td align="center"><strong>NAMA</strong></td>
        <td align="center"><strong>ICON</strong></td>
        <td align="center"><strong>URL</strong></td>
        <td align="center"><strong>AKTIF</strong></td>
		<td align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
	 <?php if($totalRows_rsWebApp>0){?>
	  <?php do { ?>
		<tr>
		  <td><?php echo $row_rsWebApp['KD_SOSMED']; ?></td>
		  <td><?php echo $row_rsWebApp['NAMA']; ?></td>
          <td><?php echo $row_rsWebApp['F_ICON']; ?></td>
          <td><?php echo $row_rsWebApp['URL']; ?></td>
          <td><?php echo $row_rsWebApp['AKTIF']; ?></td>
		  <td>
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_rsWebApp['NAMA']; ?>','<?php echo $row_rsWebApp['F_ICON']; ?>','<?php echo $row_rsWebApp['URL']; ?>',<?php echo $row_rsWebApp['KD_SOSMED']; ?>)">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_rsWebApp['NM_MODEL']; ?>','WebApp',<?php echo $row_rsWebApp['KD_MODEL']; ?>)">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsWebApp = mysqli_fetch_assoc($rsWebApp)); ?>
	</table>
	<?php
	 }//end Lebih dari 0
} ?>
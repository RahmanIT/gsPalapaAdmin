<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
	if($P[0]["ROLE"]==3){
	   $quetFt= sprintf("WHERE KD_USER=%s",GetSQLValueString($Congis,$P[0]["KD_USER"], "int"));
	 }
	 if($P[0]["ROLE"]==2){
	   $quetFt= "";
	 }
	$query_rsWebApp = "SELECT * FROM tb_modelling $quetFt ORDER BY KD_MODEL DESC";
	$rsWebApp = mysqli_query($Congis, $query_rsWebApp) or die(mysqli_error());
	$row_rsWebApp = mysqli_fetch_assoc($rsWebApp);
	$totalRows_rsWebApp = mysqli_num_rows($rsWebApp); ?>
	<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td align="center"><strong>FOTO</strong></td>
		<td align="center"><strong>KETERANGAN</strong></td>
		<td align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
	 <?php if($totalRows_rsWebApp>0){?>
	  <?php do { ?>
		<tr>
		  <td><img name="" src="data:image/png;base64,<?php echo $row_rsWebApp['IMG_MODEL']; ?>" width="120" height="75" alt=""></td>
		  <td><b><?php echo $row_rsWebApp['NM_MODEL']; ?></b><br><?php echo $row_rsWebApp['KETERANGAN']; ?></td>
		  <td>
		   <button type="button" class="btn btn-xs btn-warning" onclick="EditData('<?php echo $row_rsWebApp['NM_MODEL']; ?>','<?php echo $row_rsWebApp['KETERANGAN']; ?>','<?php echo $row_rsWebApp['INSTANSI']; ?>','<?php echo $row_rsWebApp['PAGE_SOURCE']; ?>','<?php echo $row_rsWebApp['APP_URL']; ?>','<?php echo $row_rsWebApp['PAGE_DAFULT']; ?>','<?php echo $row_rsWebApp['KD_MODEL']; ?>','<?php echo $row_rsWebApp['IMG_MODEL']; ?>','<?php echo $row_rsWebApp['PAGE_NAME']; ?>','<?php echo $row_rsWebApp['LAT_Y']; ?>','<?php echo $row_rsWebApp['LONG_X']; ?>','<?php echo $row_rsWebApp['ZOOM_LEVEL']; ?>',<?php echo $row_rsWebApp['KD_USER']; ?>)">Edit</button>
		   <button type="button" class="btn btn-xs btn-danger" onclick="Hapus('<?php echo $row_rsWebApp['NM_MODEL']; ?>','WebApp',<?php echo $row_rsWebApp['KD_MODEL']; ?>)">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsWebApp = mysqli_fetch_assoc($rsWebApp)); ?>
	</table>
	<?php
	 }//end Lebih dari 0
} ?>
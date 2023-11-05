<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php 
	$currentPage = $nama_folder."/WebAdmin/Pengumuman.html/";
	$maxRows_rsPengumuman = 10;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	$startRow_rsPengumuman = $Halaman * $maxRows_rsPengumuman;
	if($_SESSION['MM_RoleData']==3){
	   $quetFt= " WHERE KD_USER=".$_SESSION['KdUser'];
	 }
	 if($_SESSION['MM_RoleData']==2){
	   $quetFt= "";
	 }
	$query_rsPengumuman = "SELECT KD, JUDUL, CREATED, TANGGAL FROM tb_info $quetFt ORDER BY KD DESC";
	$query_limit_rsPengumuman = sprintf("%s LIMIT %d, %d", $query_rsPengumuman, $startRow_rsPengumuman, $maxRows_rsPengumuman);
	$rsPengumuman = mysqli_query($Congis, $query_limit_rsPengumuman) or die(mysqli_error());
	$row_rsPengumuman = mysqli_fetch_assoc($rsPengumuman);
	if (isset($_GET['Total'])) {
	  $Total = $_GET['Total'];
	} else {
	  $all_rsPengumuman = mysqli_query($Congis, $query_rsPengumuman);
	  $Total = mysqli_num_rows($all_rsPengumuman);
	}
	$totalPages_rsPengumuman = ceil($Total/$maxRows_rsPengumuman)-1;
	$queryString_rsPengumuman = "";
	if (!empty($_SERVER['QUERY_STRING'])) {
	  $params = explode("&", $_SERVER['QUERY_STRING']);
	  $newParams = array();
	  foreach ($params as $param) {
		if (stristr($param, "Halaman") == false && 
			stristr($param, "Total") == false) {
		  array_push($newParams, $param);
		}
	  }
	  if (count($newParams) != 0) {
		$queryString_rsPengumuman = "&" . htmlentities(implode("&", $newParams));
	  }
	}
	$queryString_rsPengumuman = sprintf("&Total=%d%s", $Total, $queryString_rsPengumuman);
	?>
	<table width="100%" class="table table-hover">
	  <thead>
	   <tr>
		<td align="center">JUDUL</td>
		<td align="center">CREATED</td>
		<td align="center">TANGGAL</td>
		<td align="center">&nbsp;</td>
	  </tr>
	</thead>
	<tbody>
	  <?php if($Total>0){ do { ?>
		<tr>
		  <td><?php echo $row_rsPengumuman['JUDUL']; ?></td>
		  <td align="center"><?php echo $row_rsPengumuman['CREATED']; ?></td>
		  <td align="center"><?php echo $row_rsPengumuman['TANGGAL']; ?></td>
		  <td>
			 <a href="<?php echo "/WebPortal/informasi/index.html" ?>" target="_blank">
				<button type="button" class="btn btn-xs btn-success">Lihat</button>
			 </a>
			 <a href="<?php echo $nama_folder."/WebAdmin/EditPengumuman/".$row_rsPengumuman['KD']; ?>"> 
				<button type="button" class="btn btn-xs btn-warning">Edit</button>
			 </a>
			  <button type="button" onClick="Hapus('<?php echo $row_rsPengumuman['JUDUL']; ?>','Pengumuman',<?php echo $row_rsPengumuman['KD']; ?>)" class="btn btn-xs btn-danger">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_rsPengumuman = mysqli_fetch_assoc($rsPengumuman)); ?>
        <?php } ?>
	</tbody>
	</table>
	 <?php
	mysqli_free_result($rsPengumuman);
	?>
<?php } ?>
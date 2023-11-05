<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$currentPage = $nama_folder."/WebAdmin/Agenda.html/";
	$maxRows_rsAgenda = 10;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	$startRow_rsAgenda = $Halaman * $maxRows_rsAgenda;
	$query_rsAgenda = "SELECT KD, ACARA, TANGGAL, TEMPAT FROM tb_agenda ORDER BY KD DESC";
	$query_limit_rsAgenda = sprintf("%s LIMIT %d, %d", $query_rsAgenda, $startRow_rsAgenda, $maxRows_rsAgenda);
	$rsAgenda = mysqli_query($Congis, $query_limit_rsAgenda) or die(mysqli_error());
	$row_rsAgenda = mysqli_fetch_assoc($rsAgenda);
	if (isset($_GET['Total'])) {
	  $Total = $_GET['Total'];
	} else {
	  $all_rsAgenda = mysqli_query($Congis, $query_rsAgenda);
	  $Total = mysqli_num_rows($all_rsAgenda);
	}
	$totalPages_rsAgenda = ceil($Total/$maxRows_rsAgenda)-1;
	$queryString_rsAgenda = "";
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
		$queryString_rsAgenda = "&" . htmlentities(implode("&", $newParams));
	  }
	}
	$queryString_rsAgenda = sprintf("&Total=%d%s", $Total, $queryString_rsAgenda);
	?>
	
					   <table class="table table-hover">
						 <thead>
						  <tr>
							<td align="center">ACARA</td>
							<td align="center">TANGGAL</td>
							<td align="center">TEMPAT</td>
							<td>&nbsp;</td>
						  </tr>
						  </thead>
							<tbody>
						  <?php do { ?>
							<tr>
							  <td><?php echo $row_rsAgenda['ACARA']; ?></td>
							  <td><?php echo $row_rsAgenda['TANGGAL']; ?></td>
							  <td><?php echo $row_rsAgenda['TEMPAT']; ?></td>
							  <td>  
							  <a href="<?php echo "/WebPortal/Agenda/index.html" ?>" target="_blank">   
							  <button type="button" class="btn btn-xs btn-success">Lihat</button> 
							  </a>
							  <a href="<?php echo $nama_folder."/WebAdmin/EditAgenda/".$row_rsAgenda['KD']; ?>">
							  <button type="button" class="btn btn-xs btn-warning" >Edit</button>
							  </a>
							  <button type="button" onClick="Hapus('<?php echo $row_rsAgenda['ACARA']; ?>','Agenda',<?php echo $row_rsAgenda['KD']; ?>)" class="btn btn-xs btn-danger">Hapus</button>
							  </td>
							</tr>
							<?php } while ($row_rsAgenda = mysqli_fetch_assoc($rsAgenda)); ?>
							</tbody>
						</table>
	 <?php
	mysqli_free_result($rsAgenda);
	?>
<?php } ?>
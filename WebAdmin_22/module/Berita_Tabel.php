<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
	$currentPage = $nama_folder."/TabelBerita.jsp/";
	$maxRows_RsBerita = 10;
	$Halaman = 0;
	if (isset($_GET['Halaman'])) {
	  $Halaman = $_GET['Halaman'];
	}
	$startRow_RsBerita = $Halaman * $maxRows_RsBerita;
	
	 if($_SESSION['MM_RoleData']==3){
	   $quetFt= " WHERE KD_USER=".$_SESSION['KdUser'];
	 }
	 if($_SESSION['MM_RoleData']==2){
	   $quetFt= "";
	 }
	$query_RsBerita = "SELECT tb_berita.KD_NEWS,tb_berita.FOTO, tb_berita.JUDUL, tb_berita.CREATED, tb_kategori.NAMA, tb_berita.TANGGAL FROM tb_berita INNER JOIN tb_kategori ON tb_kategori.KD_KATEGORI = tb_berita.KD_KATEGORI $quetFt order BY tb_berita.KD_NEWS DESC";
	$query_limit_RsBerita = sprintf("%s LIMIT %d, %d", $query_RsBerita, $startRow_RsBerita, $maxRows_RsBerita);
	$RsBerita = mysqli_query($Congis, $query_limit_RsBerita) or die(mysqli_error());
	$row_RsBerita = mysqli_fetch_assoc($RsBerita);
	
	if (isset($_GET['Total'])) {
	  $Total = $_GET['Total'];
	} else {
	  $all_RsBerita = mysqli_query($Congis, $query_RsBerita);
	  $Total = mysqli_num_rows($all_RsBerita);
	}
	$totalPages_RsBerita = ceil($Total/$maxRows_RsBerita)-1;
	
	$queryString_RsBerita = "";
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
		$queryString_RsBerita = "&" . htmlentities(implode("&", $newParams));
	  }
	}
	$queryString_RsBerita = sprintf("&Total=%d%s", $Total, $queryString_RsBerita);
	?>
	
	<table width="100%" class="table table-hover">
	  <thead>
	  <tr>
		<td width="8%" align="center"><strong>LABEL</strong></td>
		<td width="22%" align="center"><strong>JUDUL</strong></td>
		<td width="14%" align="center"><strong>CREATED</strong></td>
		<td width="15%" align="center"><strong>KATEGORI</strong></td>
		<td width="19%" align="center"><strong>TANGGAL</strong></td>
		<td width="22%" align="center"><strong>MANAGEMENT</strong></td>
	  </tr>
	</thead>
	<tbody>
	  <?php if($Total>0){ do { 
		$ImgUrl = $conf["DataDir"]."/images/berita/65x65_".$row_RsBerita['FOTO'];							
		$img68 = base64_encode(file_get_contents($ImgUrl));?>
		<tr>
		  <td><img name="" src="data:image/jpeg;base64,<?php echo $img68; ?>" width="60" height="60" alt="Image Label" style="background-color: #333333" /></td>
		  <td><?php echo $row_RsBerita['JUDUL']; ?></td>
		  <td><?php echo $row_RsBerita['CREATED']; ?></td>
		  <td align="center"><?php echo $row_RsBerita['NAMA']; ?></td>
		  <td align="center"><?php echo $row_RsBerita['TANGGAL']; ?></td>
		  <td align="center" valign="middle">
		  <?php $isi= $row_RsBerita["JUDUL"]; $str = str_replace(' ', '-', $isi);?>
		  <a href="<?php echo "/WebPortal/page/view/".$str.".html"; ?>" target="_blank">
		  <button type="button" class="btn btn-xs btn-success">Lihat</button>
		  </a>
		  <a href="<?php echo $nama_folder; ?>/WebAdmin/EditBerita/<?php echo $row_RsBerita['KD_NEWS']; ?>" >
		  <button type="button" class="btn btn-xs btn-warning">Edit</button>
		  </a>
		  <button type="button" onclick="Hapus('<?php echo $row_RsBerita['JUDUL']; ?>','Berita',<?php echo $row_RsBerita['KD_NEWS']; ?>)" class="btn btn-xs btn-danger">Hapus</button>
		  </td>
		</tr>
		<?php } while ($row_RsBerita = mysqli_fetch_assoc($RsBerita)); } //end total >0 ?>
		  </tbody>
		  </table>
		  
	<?php
	//mysqli_free_result($RsBerita);
 } ?>
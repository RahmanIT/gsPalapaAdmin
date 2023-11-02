<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$maxRows_RsAPP = 8;
	$Page = 0;
	if (isset($_GET['Page'])) {
	  $Page = $_GET['Page'];
	}
	$startRow_RsAPP = $Page * $maxRows_RsAPP;
	mysqli_select_db($Congis, $database_Congis);
	$query_RsAPP = "SELECT * FROM tb_modelling ORDER BY KD_MODEL DESC";
	$query_limit_RsAPP = sprintf("%s LIMIT %d, %d", $query_RsAPP, $startRow_RsAPP, $maxRows_RsAPP);
	$RsAPP = mysqli_query($Congis, $query_limit_RsAPP) or die(mysqli_error());
	$row_RsAPP = mysqli_fetch_assoc($RsAPP);
	if (isset($_GET['totalRows_RsAPP'])) {
	  $totalRows_RsAPP = $_GET['totalRows_RsAPP'];
	} else {
	  $all_RsAPP = mysqli_query($Congis, $query_RsAPP);
	  $totalRows_RsAPP = mysqli_num_rows($all_RsAPP);
	}
	$totalPages_RsAPP = ceil($totalRows_RsAPP/$maxRows_RsAPP)-1;
	?>
	<?php $no=1; do { ?>
					<?php  $warna= ($no% 2 == 1) ?  "#FFFFFF" : "#F0F5F9" ?>
					<span class="pullquote-left">
					   <?php  $isi= $row_RsAPP['NM_APP']; $str = str_replace(' ', '-', $isi);?>
					   <a href="<?php echo $nama_folder; ?>/JIGN/<?php echo $str;  ?>">
						 <img name="Foto" src="data:image/jpeg;base64,<?php echo $row_RsAPP['IMG_MODEL']; ?>" width="120" height="120" alt="" style="background-color: #CCCCCC; float:left; margin-right:15px;">
						<h4><?php echo $row_RsAPP['NM_MODEL']; ?></h4>
					  </a>
						<p><?php echo $row_RsAPP['KETERANGAN']; ?></p>
						<strong>Web Simpul</strong> : <a href="<?php echo $row_RsAPP['WEB_JIGN']; ?>" target="_blank"><?php echo $row_RsAPP['WEB_JIGN']; ?></a><br/>
						<strong>Map Services</strong> : <a href="<?php echo $row_RsAPP['SERVICE_URL']; ?>" target="_blank"><?php echo $row_RsAPP['SERVICE_URL']; ?></a><br/>
					  </span><hr>
					  <?php $no++; } while ($row_RsAPP = mysqli_fetch_assoc($RsAPP)); ?>
	   <input name="TotalPageS" id="TotalPageS" type="hidden" value="<?php echo $totalPages_RsAPP; ?>" />                
	<?php
	mysqli_free_result($RsAPP);
	?>
<?php } ?>
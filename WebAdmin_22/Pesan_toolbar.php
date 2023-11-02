<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$maxRows_rsPesanBox = 3;
$pageNum_rsPesanBox = 0;
if (isset($_GET['pageNum_rsPesanBox'])) {
  $pageNum_rsPesanBox = $_GET['pageNum_rsPesanBox'];
}
$startRow_rsPesanBox = $pageNum_rsPesanBox * $maxRows_rsPesanBox;
if($P[0]["ROLE"]==2 && $P[0]["EMAIL"]!=""){
$query_rsPesanBox = "SELECT * FROM tb_pesan ORDER BY Id DESC";
$query_limit_rsPesanBox = sprintf("%s LIMIT %d, %d", $query_rsPesanBox, $startRow_rsPesanBox, $maxRows_rsPesanBox);
$rsPesanBox = mysqli_query($Congis, $query_limit_rsPesanBox) or die(mysqli_error());
$row_rsPesanBox = mysqli_fetch_assoc($rsPesanBox);
if (isset($_GET['totalRows_rsPesanBox'])) {
  $totalRows_rsPesanBox = $_GET['totalRows_rsPesanBox'];
} else {
  $all_rsPesanBox = mysqli_query($Congis, $query_rsPesanBox);
  $totalRows_rsPesanBox = mysqli_num_rows($all_rsPesanBox);
}
$totalPages_rsPesanBox = ceil($totalRows_rsPesanBox/$maxRows_rsPesanBox)-1;
?>
<?php do { ?>
   <li class="message-preview">
          <a href="#">
             <div class="media">
                <span class="pull-left">
                   <img class="media-object" src="<?php echo $nama_folder."/images/avatar.png"; ?>" alt="User Icon">
                </span>
                   <div class="media-body">
                       <h5 class="media-heading">
                          <strong><?php echo $row_rsPesanBox['NAMA']; ?></strong>
                       </h5>
                    <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $row_rsPesanBox['TANGGAL']; ?> </p>
                    <?php 
						$title1= $row_rsPesanBox['COMMEN'];
			   			if (strlen($title) > 40){
							$title1 = substr($title, 0, 40);
							while (substr($title, -1)!=' ') $title = substr($title, 0, -1);
								$title1 = trim($title). '..';
							}
					?>
                   <p><?php echo $title1; ?>.</p>
               </div>
            </div>
          </a>
     </li>
<?php } while ($row_rsPesanBox = mysqli_fetch_assoc($rsPesanBox)); ?>
<li class="message-footer">
    <a href="<?php echo $nama_folder; ?>/WebAdmin/Pesan.html">Read All New Messages</a>
</li>
<?php
	};
}?>

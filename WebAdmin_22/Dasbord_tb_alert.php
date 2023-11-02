<?php error_reporting(0);  if($P[0]["ROLE"]==2 && $P[0]["EMAIL"]!=""){ ?>
<?php
$maxRows_RsAlert = 10;
$pageNum_RsAlert = 0;
if (isset($_GET['pageNum_RsAlert'])) {
  $pageNum_RsAlert = $_GET['pageNum_RsAlert'];
}
$startRow_RsAlert = $pageNum_RsAlert * $maxRows_RsAlert;
$query_RsAlert = "SELECT   tb_alert.Id,   tb_notifications.NF_ICON,   tb_notifications.KET,   tb_alert.TANGGAL FROM   tb_alert   INNER JOIN tb_notifications ON tb_alert.KDNF = tb_notifications.KDNF order by tb_alert.Id DESC";
$query_limit_RsAlert = sprintf("%s LIMIT %d, %d", $query_RsAlert, $startRow_RsAlert, $maxRows_RsAlert);
$RsAlert = mysqli_query($Congis, $query_limit_RsAlert) or die(mysqli_error());
$row_RsAlert = mysqli_fetch_assoc($RsAlert);
if (isset($_GET['totalRows_RsAlert'])) {
  $totalRows_RsAlert = $_GET['totalRows_RsAlert'];
} else {
  $all_RsAlert = mysqli_query($Congis, $query_RsAlert);
  $totalRows_RsAlert = mysqli_num_rows($all_RsAlert);
}
$totalPages_RsAlert = ceil($totalRows_RsAlert/$maxRows_RsAlert)-1;
?>
<div class="list-group">
    <?php do { ?>
    <a href="#" class="list-group-item">
        <i class="<?php echo $row_RsAlert['NF_ICON']; ?>"></i> <?php echo $row_RsAlert['KET']; ?>
        <span class="pull-right text-muted small"><em><?php echo $row_RsAlert['TANGGAL']; ?></em>
        </span>
    </a>
      <?php } while ($row_RsAlert = mysqli_fetch_assoc($RsAlert)); ?>
</div>
<?php } ?>
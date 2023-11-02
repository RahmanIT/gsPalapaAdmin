<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_RsNotfyToolBoar = "SELECT tb_notifications.NF_ICON, date_format(tb_alert.TANGGAL, '%H:%i:%s') as TANGGAL,tb_notifications.KET  FROM  tb_alert INNER JOIN tb_notifications ON tb_alert.KDNF = tb_notifications.KDNF ORDER BY tb_alert.Id DESC LIMIT 5";
$RsNotfyToolBoar = mysqli_query($Congis, $query_RsNotfyToolBoar) or die(mysqli_error());
$row_RsNotfyToolBoar = mysqli_fetch_assoc($RsNotfyToolBoar);
$totalRows_RsNotfyToolBoar = mysqli_num_rows($RsNotfyToolBoar);
do { ?> 
  <li>
      <a href="#"> <i class="<?php echo $row_RsNotfyToolBoar['NF_ICON']; ?>"></i> <?php echo $row_RsNotfyToolBoar['TANGGAL']; ?> <span class="label label-primary"><?php echo $row_RsNotfyToolBoar['KET']; ?></span></a>
  </li>
<?php } while ($row_RsNotfyToolBoar = mysqli_fetch_assoc($RsNotfyToolBoar)); 
mysqli_free_result($RsNotfyToolBoar);
}?>

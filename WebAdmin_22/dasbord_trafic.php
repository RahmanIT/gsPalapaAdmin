<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_rstChat = "SELECT  tstatistika.tanggal, COUNT(tstatistika.ip)AS IP_HOST, sum(tstatistika.hits) as HITS FROM  tstatistika GROUP BY  tstatistika.tanggal ORDER BY tstatistika.tanggal DESC LIMIT 30";
$rstChat = mysqli_query($Congis,$query_rstChat) or die(mysqli_error());
$row_rstChat = mysqli_fetch_assoc($rstChat);
$totalRows_rstChat = mysqli_num_rows($rstChat);
$data= "";
$LyArry = "";
$Lb=0;
 		do { 
          $data =   "{ tanggal: '$row_rstChat[tanggal]', host:$row_rstChat[IP_HOST], hits:$row_rstChat[HITS] }";		  
		  if($Lb < $totalRows_rstChat){  
		  		$LyArry .= $data.", "; 
		  } else{
			    $LyArry .= $data;
			  };
        $Lb++; 
    } while ($row_rstChat = mysqli_fetch_assoc($rstChat)); 

?>
<script>
    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [<?php  echo $LyArry; ?>],
        xkey: 'tanggal',
        ykeys: ['host', 'hits'],
        labels: ['Total User', 'Akses Halaman'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
</script>
<?php } ?>
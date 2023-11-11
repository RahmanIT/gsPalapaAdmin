<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$namaTb = htmlspecialchars($_POST["tabelname"]);
$DtLimit = $_POST["maxlist"];
$page = ($_POST["page"]-1);
$DtOfset =  ($DtLimit* $page);
$Limit = " LIMIT $DtLimit OFFSET $DtOfset";
$tb = explode("_",$namaTb);
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$query= 'SELECT * FROM "WYPOINT"."'.$namaTb.'" JOIN "WYPOINT"."'.$namaTb.'_METADATA" ON "'.$namaTb.'".idgps = "'.$namaTb.'_METADATA".metadataid ORDER BY idgps DESC '.$Limit;
$result = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
$n= 1;
?>
<table width="100%" class="table table-hover">
	 <thead> 
	   <tr>
		<td align="center"><strong>FOTO</strong></td>
		<td align="center"><strong>NAMA</strong></td>
        <td align="center"><strong>POSTING</strong></td>
		<td align="center"><strong>#</strong></td>
	  </tr>
	</thead>
	<tbody>
<?php 
	while ($row=pg_fetch_assoc($result)) {
		$Num = $n*$_POST["page"];
		echo '<tr>';
		echo '<td><img src="'.$nama_folder.'/images/toponimi/'.$tb[0].'_60x60_'.$row['namafile'].'" width="140" height="80" /></td>';
		echo "<td>$Num .<b>$row[namobj]</b></td>";
		echo "<td>$row[tanggal]<br>$row[wadmkd], Kec.$row[wadmkc], Kab.$row[wadmkk]</td>";
		echo '<td><button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#MetadataleModal" onclick="InfoData('.$row['idgps'].')">Verifikasi</button>
				  <button type="button" class="btn btn-xs btn-danger">Hapus</button></td>';
		echo '</tr>';
	$n++; }
  echo '</table>';
pg_close($pgdb);
} ?>
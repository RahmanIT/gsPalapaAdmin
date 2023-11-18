<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$namaTb = htmlspecialchars($_POST["tabelname"]);
$tb = explode("_",$namaTb);
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$query= 'SELECT * FROM "WYPOINT"."'.$namaTb.'" JOIN "WYPOINT"."'.$namaTb.'_METADATA" ON "'.$namaTb.'".idgps = "'.$namaTb.'_METADATA".metadataid WHERE  "'.$namaTb.'".idgps='.$_POST["idx"];
$result = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
$row=pg_fetch_assoc($result);
?>
<table width="100%" class="table">
  <tr>
    <td width="28%">Nama Objek </td>
    <td width="72%">: <?php echo $row["namobj"]; ?></td>
  </tr>
  <tr>
    <td>Tanggal Posting</td>
    <td>: <?php echo $row["tanggal"]; ?></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td>: <?php echo $row["remark"]; ?></td>
  </tr>
  <tr>
    <td>Kode Wilalyah</td>
    <td>: <?php echo $row["kodepm"]; ?></td>
  </tr>
  <tr>
    <td>Desa</td>
    <td>: <?php echo $row["wadmkd"]; ?></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td>: <?php echo $row["wadmkc"]; ?></td>
  </tr>
  <tr>
    <td>Kabupaten</td>
    <td>: <?php echo $row["wadmkk"]; ?></td>
  </tr>
  <tr>
    <td>Tanggal Metadata</td>
    <td>: <?php echo $row["tgljam"]; ?></td>
  </tr>
  <tr>
    <td>Koordinat </td>
    <td>[<?php echo $row["latitude"].','.$row["longitude"]; ?>]</td>
  </tr>
  <tr>
    <td>Akurasi</td>
    <td>: <?php echo $row["akurasi"]; ?></td>
  </tr>
  <tr>
    <td>Ketinggian</td>
    <td>: <?php echo $row["ketinggian"]; ?></td>
  </tr>
  <tr>
    <td>Akurasi Elevasi</td>
    <td>: <?php echo $row["akurasielv"]; ?></td>
  </tr>
  <tr>
    <td>Arah</td>
    <td>: <?php echo $row["arah"]; ?></td>
  </tr>
  <tr>
    <td>Kecepatan</td>
    <td>: <?php echo $row["kecepatan"]; ?></td>
  </tr>
  <tr>
    <td>Metadata</td>
    <td>: <?php echo $row["metadata"]; ?></td>
  </tr>
    <tr>
    <td>Nama File</td>
    <td>: <?php echo $row["namafile"]; ?></td>
  </tr>
  <tr>
    <td>Verfikasi</td>
    <td> <?php echo $row["verfikasidate"]; ?></td>
  </tr>
    <tr>
    <td>Verfikator</td>
    <td> <?php echo $row["vefi_nama"]; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo '<img src="'.$nama_folder.'/images/toponimi/'.$tb[0].'_1200x800_'.$row['namafile'].'" width="100%"  />'; ?></td>
  </tr>
</table>
<input name="DT_INDEX" type="hidden" id="DT_INDEX" value="<?php echo $_POST["idx"]; ?>" />
<?php pg_close($pgdb); }?>
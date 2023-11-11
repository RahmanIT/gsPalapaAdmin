<?php 
$source = $conf["SrvAPI"].'/rest/API/CSW/?kata='.$_GET['kata'];
$json = file_get_contents($source);
$data= json_decode($json, true);   
?>
<table class="table table-striped table-sm table-hover">
  <thead>
    <tr>
      <th scope="col">IMAGE</th>
      <th scope="col">LAYER INFO</th>
      <th scope="col">ADD</th>
    </tr>
  </thead>
  <tbody>
  <?php for($a=0; $a < count($data); $a++) { 
	$foto = str_replace(":","-",$data[$a]['layer']);
	$ImgUrl = $conf["SrvAPI"]."/ServiceThum/".$foto.".jpg";
    $img68 = base64_encode(file_get_contents($ImgUrl));
  ?>
  <tr>
      <th scope="row" width="15%"><img style='border:solid 1px #009999; margin:2px;' alt='Not fund image thumbnail' src='data:image/jpeg;base64,<?php echo $img68; ?>'  width='100' height='80'></th>
      <td><span style="color:#063;">[<?php echo $a+1; ?>] <?php print $data[$a]['nmobj']; ?></span> 
        <small>
      	<br>Instnasi : <?php print $data[$a]['instansi']; ?> 
        <br>Kategori :  <?php echo $data[$a]['kugi']; ?>
        </small></td>
      <td><button type="button" class="btn btn-success" onClick="AddDataOGC('<?php print $data[$a]['nmobj']; ?>','<?php print $data[$a]['url']; ?>','<?php print $data[$a]['layer']; ?>',<?php print $data[$a]['minx']; ?>,<?php print $data[$a]['miny']; ?>,<?php print $data[$a]['maxx']; ?>,<?php print $data[$a]['maxy']; ?>)">Add</button></td>
    </tr>
   <?php };?>
  </tbody>
</table>
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){  ?>
<div id="GroupBoxM<?php echo $_GET["Index"]; ?>">
<div class="form-group">
    <label>Peta Pendukung <?php echo $_GET["Index"]+1; ?></label>
    <input name="URLSERVICE_<?php echo $_GET["Index"]; ?>" class="form-control" type="text"  placeholder="URL Map Servis"  maxlength="255" />
 </div>
 <div class="form-group"> 
        <label><input name="F_TYPE_<?php echo $_GET["Index"]; ?>" type="radio" id="F_TYPE_0" value="dynamic" checked="checked" />Arcgis (Dynamic)</label>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="F_TYPE_<?php echo $_GET["Index"]; ?>" value="wms" id="F_TYPE_1" />GeoRSS (WMS)</label> &nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="F_TYPE_<?php echo $_GET["Index"]; ?>" value="kml" id="F_TYPE_2" />GoogleMap (KML)</label>
</div>
<div align="right"><a href="#" onclick="HapusFt('GroupBoxM<?php echo $_GET["Index"]; ?>')" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a></div>
<hr>
</div>
<?php echo '<div id="FrmBoxM'.($_GET["Index"]+1).'"></div>'; } ?>
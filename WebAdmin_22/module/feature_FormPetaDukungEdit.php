<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ ?>
<div id="GroupBoxM<?php echo $_GET["Index"]; ?>">
<div class="form-group">
    <label>Peta Pendukung <?php echo $_GET["Index"]+1; ?></label>
    <input id="URLSERVICE_<?php echo $_GET["Index"]; ?>" class="form-control" type="text"  placeholder="URL Map Servis"  maxlength="255" />
 </div>
 <div class="form-group"> 
 		<input id="TxtType<?php echo $_GET["Index"]; ?>" type="hidden" value="dynamic" /> 
        <label><input type="radio" name="F_TYPE_<?php echo $_GET["Index"]; ?>" onclick="TypeSrvDyn(<?php echo $_GET["Index"]; ?>,'dynamic')" value="dynamic" id="F_TYPE_0" checked="checked" />Arcgis (Dynamic)</label>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="F_TYPE_<?php echo $_GET["Index"]; ?>" onclick="TypeSrvDyn(<?php echo $_GET["Index"]; ?>,'wms')" value="wms" id="F_TYPE_1" />GeoRSS (WMS)</label> &nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="F_TYPE_<?php echo $_GET["Index"]; ?>" onclick="TypeSrvDyn(<?php echo $_GET["Index"]; ?>,'kml')" value="kml" id="F_TYPE_2" />GoogleMap (KML)</label>
</div>
<span id="InfoLyr<?php echo $_GET["Index"]; ?>"></span>
<div align="right">
	<img id="LoadingB_<?php echo $_GET["Index"]; ?>" src="<?php echo $nama_folder; ?>/images/loading_black.gif" width="16" height="11" style="display:none;" alt="Loading.." />
	<a href="#" id="CmdSimpanDyn<?php echo $_GET["Index"]; ?>" onclick="SimpanTileDynamic(<?php echo $_GET["Index"]; ?>)" class="btn btn-outline btn-success btn-xs"><i class="fa fa-save"></i> Simpan</a>
	<a href="#" onclick="HapusFt('GroupBoxM<?php echo $_GET["Index"]; ?>')" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a>
</div>
<hr>
</div>
<?php echo '<div id="FrmBoxM'.($_GET["Index"]+1).'"></div>'; } ?>
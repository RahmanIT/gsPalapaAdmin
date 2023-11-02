<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ ?>
<div class="form-group" id="GroupBox<?php echo $_GET["Index"]; ?>">
    <label>URL Feature <?php echo $_GET["Index"]+1; ?></label>
    <input id="URLPETA_<?php echo $_GET["Index"]; ?>" class="form-control" type="text"  placeholder="URL Feature Acces"  maxlength="255" />
    <span id="PsnUp<?php echo $_GET["Index"]; ?>"></span>
    <div align="right">
        <img id="Loading_<?php echo $_GET["Index"]; ?>" src="<?php echo $nama_folder; ?>/images/loading_black.gif" width="16" height="11" style="display:none;" alt="Loading.." />
    	<a href="#" id="CmdSimpanFt<?php echo $_GET["Index"]; ?>" onclick="SimpanTileFeature(<?php echo $_GET["Index"]; ?>)" class="btn btn-outline btn-success btn-xs"><i class="fa fa-save"></i> Simpan</a>
        <a href="#" onclick="HapusFt('GroupBox<?php echo $_GET["Index"]; ?>')" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a>
    </div>
   <hr>
</div>
<?php echo '<div id="FrmBox'.($_GET["Index"]+1).'"></div>'; } ?>
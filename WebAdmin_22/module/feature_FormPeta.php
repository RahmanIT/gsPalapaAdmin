<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ ?>
<div class="form-group" id="GroupBox<?php echo $_GET["Index"]; ?>">
    <label>URL Feature <?php echo $_GET["Index"]+1; ?></label>
    <input name="URLPETA_<?php echo $_GET["Index"]; ?>" class="form-control" type="text"  placeholder="URL Feature Acces"  maxlength="255" />
    <div align="right"><a href="#" onclick="HapusFt('GroupBox<?php echo $_GET["Index"]; ?>')" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a></div>
   <hr>
</div>
<?php echo '<div id="FrmBox'.($_GET["Index"]+1).'"></div>'; }?>
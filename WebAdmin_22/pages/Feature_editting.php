<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<?php
$query_RsFearueLIst = "SELECT * FROM tb_feture WHERE KD_FEATURE =$segmen4";
$RsFearueLIst = mysqli_query($Congis, $query_RsFearueLIst) or die(mysqli_error());
$row_RsFearueLIst = mysqli_fetch_assoc($RsFearueLIst);
$totalRows_RsFearueLIst = mysqli_num_rows($RsFearueLIst);

$query_RstFA = "SELECT F_SERVICE, KD_LYR FROM tb_feature_lyr WHERE KD_FEATURE = $segmen4 and F_TYPE = 'Feature' ORDER BY KD_LYR ASC";
$RstFA = mysqli_query($Congis, $query_RstFA) or die(mysqli_error());
$row_RstFA = mysqli_fetch_assoc($RstFA);
$totalRows_RstFA = mysqli_num_rows($RstFA);

;
$query_RstFD = "SELECT KD_LYR, F_TYPE, F_SERVICE FROM tb_feature_lyr WHERE KD_FEATURE = $segmen4 and F_TYPE <> 'Feature' ORDER BY KD_LYR ASC";
$RstFD = mysqli_query($Congis, $query_RstFD) or die(mysqli_error());
$row_RstFD = mysqli_fetch_assoc($RstFD);
$totalRows_RstFD = mysqli_num_rows($RstFD);
?>

<script>
function SimpanFeature(){ 			  
			       $("#preview").html();
			  
				   $("#FrmFeature").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					 window.location = "<?php echo $nama_folder; ?>/WebAdmin/Feature.jsp"
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
 };

function showPreview(ele)	{
		$('#imgAvatar').attr('src', ele.value); // for IE
        if (ele.files && ele.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function (e) {
                    $('#imgAvatar').attr('src', e.target.result);
            }
        reader.readAsDataURL(ele.files[0]);
       }
}


function AddPetaFrom(){
  var Fidx = document.getElementById("TxtIndxF").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FromFeatureLoadEdit.jsp/",
	data: "Index="+Fidx,
	cache: false,
	success: function(msg){
		 var ps = "FrmBox"+Fidx
		 document.getElementById(ps).innerHTML = msg;
		 document.getElementById("TxtIndxF").value = eval(Fidx)+1 ;
		$("#imageloadstatus").hide();
		}
	});
}

function AddPetaDukung(){
  var Fidy = document.getElementById("TxtIndxM").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FromMapServerLoadEdit.jsp/",
	data: "Index="+Fidy,
	cache: false,
	success: function(msg){
		 var ps = "FrmBoxM"+Fidy
		 document.getElementById(ps).innerHTML = msg;
		 document.getElementById("TxtIndxM").value = eval(Fidy)+1 ;
		$("#imageloadstatus").hide();
		}
	});
}

function UpdateFeature(x,d){
	var ld = "#Loading_"+x;
	var Txt = "URLPETA_"+x;
	var MsgUp = "PsnUp"+x;
	$(ld).show();
	var srv = document.getElementById(Txt).value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FeatueAcces-Update.jsp/",
	data: "Index="+d+"&Srv="+srv,
	cache: false,
	success: function(msg){
		 document.getElementById(MsgUp).innerHTML = msg;
		  $(ld).hide();
		}
	});
}

function UpdateDynamicLayer(x,d){
	var ld = "#LoadingB_"+x;
	var Txt = "URLSERVICE_"+x;
	var Tp = "TxtType"+x;
	var MsgUp = "InfoLyr"+x;
	$(ld).show();
	var srv = document.getElementById(Txt).value;
	var ty = document.getElementById(Tp).value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/DynamicService-Update.jsp/",
	data: "Index="+d+"&Srv="+srv+"&TY="+ty,
	cache: false,
	success: function(msg){
		 document.getElementById(MsgUp).innerHTML = msg;
		  $(ld).hide();
		}
	});
}

function SimpanTileFeature(y){
	var ld1 = "#Loading_"+y;
	var Txt1 = "URLPETA_"+y;
	var MsgUp1 = "PsnUp"+y;
	var mcd = "#CmdSimpanFt"+y;
	$(ld1).show();
	var srv1 = document.getElementById(Txt1).value;
	var r = document.getElementById("CboROle").value
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FeatureTile-add.jsp/",
	data: "Index=<?php echo $segmen4; ?>&Srv="+srv1+"&R="+r,
	cache: false,
	success: function(msg){
		 document.getElementById(MsgUp1).innerHTML = msg;
		 $(mcd).hide();
		  $(ld1).hide();
		}
	});
}

function SimpanTileDynamic(y){
	var ld1 = "#LoadingB_"+y;
	var Txt1 = "URLSERVICE_"+y;
	var MsgUp1 = "InfoLyr"+y;
	var mcd = "#CmdSimpanDyn"+y;
	var Tp = "TxtType"+y;
	$(ld1).show();
	var srv1 = document.getElementById(Txt1).value;
	var r = document.getElementById("CboROle").value;
	var ty = document.getElementById(Tp).value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/DynamicTile-add.jsp/",
	data: "Index=<?php echo $segmen4; ?>&Srv="+srv1+"&R="+r+"&TY="+ty,
	cache: false,
	success: function(msg){
		 document.getElementById(MsgUp1).innerHTML = msg;
		 $(mcd).hide();
		  $(ld1).hide();
		}
	});
}

function HapusTileDynamic(y,n){
	var ld1 = "#LoadingB_"+y;
	var BxFt = "GroupBoxM"+y;
	$(ld1).show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/DynamicTile-hapus.jsp/",
	data: "Index="+n,
	cache: false,
	success: function(msg){
		  $(ld1).hide();
		  document.getElementById(BxFt).innerHTML = msg;
		}
	});
}

function HapusTileFeature(y,n){
	var ld1 = "#LoadingB_"+y;
	var BxFt = "GroupBox"+y;
	$(ld1).show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/DynamicTile-hapus.jsp/",
	data: "Index="+n,
	cache: false,
	success: function(msg){
		  $(ld1).hide();
		  document.getElementById(BxFt).innerHTML = msg;
		}
	});
}

function HapusFt(t){
  document.getElementById(t).innerHTML = "";
}

function TypeSrvDyn(d, n){
 var t = "TxtType"+d;
 document.getElementById(t).value = n;
}
</script>
<style>
#imgAvatar
{
color:#cc0000;
width:auto;
width:400px;
}
</style>
<div class="container-fluid">
<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Edit Feature
                          <small> Lakukan Perubahan pada peta partisipatif</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.html">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-thumb-tack marker"></i><a href="../../WebAdmin/pages/Feature.jsp"> Feature Acces</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Editting
                          </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <form method="POST" name="FrmFeature" id="FrmFeature" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/EditFeature.jsp">
               <div id="preview"></div>
                <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div class="form-group">
                      			<label>Nama Feature</label>
                      			<input name="NM_FEATURE" class="form-control" type="text" value="<?php echo $row_RsFearueLIst['NM_FEATURE']; ?>" placeholder="Nama Feature"  maxlength="50" id="NM_FEATURE" />
               				</div>
              				<div class="form-group">
                  				<label>Keterangan</label>
                  				<textarea name="KETERANGAN" cols="50" rows="3" class="form-control" placeholder="Diskripsi Feature"><?php echo $row_RsFearueLIst['KETERANGAN']; ?></textarea>
               				</div>
                            <div class="form-group">
                            	<label>Role Data</label>
                            	<select name="CboROle" id="CboROle" class="form-control">
                            	  <option value="1" <?php if (!(strcmp(1, $row_RsFearueLIst['F_ROLE']))) {echo "selected=\"selected\"";} ?>>Publik</option>
                            	  <option value="2" <?php if (!(strcmp(2, $row_RsFearueLIst['F_ROLE']))) {echo "selected=\"selected\"";} ?>>PEMPROV</option>
                            	  <option value="3" <?php if (!(strcmp(3, $row_RsFearueLIst['F_ROLE']))) {echo "selected=\"selected\"";} ?>>PEMKAB/KOTA</option>
                            	  <option value="4" <?php if (!(strcmp(4, $row_RsFearueLIst['F_ROLE']))) {echo "selected=\"selected\"";} ?>>KHUSUS</option>
                            	</select>
                            </div>
                            <div class="form-group">
                            	<label>Image Koper</label>
       					 		<input name="filUpload" type="file" id="filUpload" OnChange="showPreview(this)">
                            </div>
                            <div class="form-group">
      								<center>
      									<img id="imgAvatar" src="<?php echo $nama_folder; ?>/images/peta/800x600_<?php echo $row_RsFearueLIst['../../WebAdmin/pages/IMAGE']; ?>" style="border:solid 1px #0066CC;"/>
        							</center>
      							</div>
                        </div>
                     </div>
               </div>               
               <!-- ========================================================================================== -->
               <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                       <div class="panel-body">
                       
                         <div class="form-group">
                        	<a href="#" onclick="AddPetaFrom()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambahkan Feature Acces</a>
                        	<input name="TxtIndxF" type="hidden" id="TxtIndxF" value="<?php echo $totalRows_RstFA; ?>" size="10" />
                         </div>
                               <?php $n=0; do { ?>
                               <div class="form-group" id="GroupBox<?php echo $n; ?>">
    								<label>URL Feature <?php echo $n+1; ?></label>
    								<input id="URLPETA_<?php echo $n; ?>" class="form-control" type="text"  placeholder="URL Feature Acces" value="<?php echo $row_RstFA['F_SERVICE']; ?>"  maxlength="255" />
    							 <span id="PsnUp<?php echo $n; ?>"></span>
                                 <div align="right">	
                                    <img id="Loading_<?php echo $n; ?>" src="<?php echo $nama_folder; ?>/images/loading_black.gif" width="16" height="11" style="display:none;" alt="Loading.." />
                                   	 <a href="#" onclick="UpdateFeature(<?php echo $n; ?>,<?php echo $row_RstFA['KD_LYR']; ?>)" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a>
                                     <a href="#" onclick="HapusTileFeature(<?php echo $n; ?>,<?php echo $row_RstFA['KD_LYR']; ?>)" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a>
                                   </div>
  									 <hr>
								</div>
                                 <?php $n++; } while ($row_RstFA = mysqli_fetch_assoc($RstFA)); ?>
						    <div id="FrmBox<?php echo $n; ?>"></div>
                      </div>
                  </div>
                 <!--------------------------------------------------------------------------->
                    <div class="panel panel-default">
                       <div class="panel-body">
                         <div class="form-group">
                        	<a href="#" onclick="AddPetaDukung()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambahkan Peta Dukung</a>
                        	 <input name="TxtIndxM" type="hidden" id="TxtIndxM" value="<?php echo $totalRows_RstFD; ?>" size="10" />
                         </div>
                           <?php $d=0; do { ?>
                           	<div id="GroupBoxM<?php echo $d; ?>">
							<div class="form-group">
    							<label>Peta Pendukung <?php echo $d+1; ?></label>
    							<input id="URLSERVICE_<?php echo $d; ?>" value="<?php echo $row_RstFD['F_SERVICE']; ?>" class="form-control" type="text"  placeholder="URL Map Servis"  maxlength="255" />
 							</div>
 							<div class="form-group">
                                <input id="TxtType<?php echo $d; ?>" type="hidden" value="<?php echo $row_RstFD['F_TYPE']; ?>" /> 
       						    <label><input <?php if (!(strcmp($row_RstFD['F_TYPE'],"dynamic"))) {echo "checked=\"checked\"";} ?> name="F_TYPE_<?php echo $d; ?>" type="radio" onclick="TypeSrvDyn(<?php echo $d; ?>,'dynamic')" value="dynamic" checked="checked" />Arcgis (Dynamic)</label>&nbsp;&nbsp;&nbsp;
        						<label><input <?php if (!(strcmp($row_RstFD['F_TYPE'],"wms"))) {echo "checked=\"checked\"";} ?> type="radio" name="F_TYPE_<?php echo $d; ?>" onclick="TypeSrvDyn(<?php echo $d; ?>,'wms')" value="wms" />GeoRSS (WMS)</label> &nbsp;&nbsp;&nbsp;
        						<label><input <?php if (!(strcmp($row_RstFD['F_TYPE'],"kml"))) {echo "checked=\"checked\"";} ?> type="radio" name="F_TYPE_<?php echo $d; ?>" onclick="TypeSrvDyn(<?php echo $d; ?>,'kml')" value="kml" />GoogleMap (KML)</label>
							</div>
                              <span id="InfoLyr<?php echo $d; ?>"></span>
							  <div align="right">
                                	<img id="LoadingB_<?php echo $n; ?>" src="<?php echo $nama_folder; ?>/images/loading_black.gif" width="16" height="11" style="display:none;" alt="Loading.." />
                           			<a href="#" onclick="UpdateDynamicLayer(<?php echo $d; ?>,<?php echo $row_RstFD['KD_LYR']; ?>)" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a>
                                    <a href="#" onclick="HapusTileDynamic('<?php echo $d; ?>',<?php echo $row_RstFD['KD_LYR']; ?>)" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</a>
                       		  </div>
							<hr>
							</div>
                             <?php $d++; } while ($row_RstFD = mysqli_fetch_assoc($RstFD)); ?>
							<div id="FrmBoxM<?php echo $d; ?>"></div>
                      </div>
                      <div class="panel-footer" align="right">
                            <img id="imageloadstatus" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" width="220" height="19" alt="Loading Upload.." />
                            <button type="button" onclick="SimpanFeature()" id="imageloadbutton" class="btn btn-success">Simpan</button>
                      </div>
                  </div> 
               </div>
				<input type="hidden" name="MM_insert" value="form1">
               </form>

<script>
document.getElementById("fature01").className = "active";
</script>
 <?php
mysqli_free_result($RsFearueLIst);
mysqli_free_result($RstFA);
mysqli_free_result($RstFD);
 } ?>
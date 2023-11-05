<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
if($P[0]["ROLE"]==3){
   $quetFt= " WHERE KD_USER=".GetSQLValueString($Congis,$P[0]["KD_USER"],"int");
}
 if($P[0]["ROLE"]==2){
   $quetFt= "";
}
$query_RsApp = "SELECT KD_MODEL, NM_MODEL FROM tb_modelling  $quetFt ORDER BY KD_MODEL DESC";
$RsApp = mysqli_query($Congis, $query_RsApp) or die(mysqli_error());
$row_RsApp = mysqli_fetch_assoc($RsApp);
$totalRows_RsApp = mysqli_num_rows($RsApp);
?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function SimpanPeta(){ 			  
   $("#preview").html();
   $("#FrmPeta").ajaxForm({target: '#preview', 
	 beforeSubmit:function(){ 
	console.log('ttest');
	$("#loding").show();
	 }, 
	success:function(){ 
	console.log('test');
	TampilkanTabel();
	$("#loding").hide();
	ClearBocForm();
	}, 
	error:function(){ 
	console.log('xtest');
	TampilkanTabel()
	 $("#loding").hide();
	} }).submit();
 };
 
function TampilkanTabel(){
  var pg = eval(document.getElementById("CboAp").value) ;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-WebAppData.jsp/",
	data: "model="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function TampilkanCSW(){
  var kata = document.getElementById("CARI").value;
   document.getElementById("DataApiCsw").innerHTML ='<img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>';	
	$.ajax({
	url: "<?php echo $nama_folder; ?>/CSW-geoservice/",
	data: "kata="+kata,
	cache: false,
	success: function(msg){
		 document.getElementById("DataApiCsw").innerHTML = msg;
		}
	});
};

function HalamanBerikutnya(){
	var hl = document.getElementById("Halaman").value; 
	document.getElementById("Halaman").value = eval(hl)+1;
	TampilkanTabel()
}

function HalamanSebelumnya(){
	var hl 	=document.getElementById("Halaman").value; 
	if(hl > 1){
		document.getElementById("Halaman").value  = eval(hl)-1;
		TampilkanTabel()
	}
}

function AddData(a,b,c){
	document.getElementById("NM_PETA").value = a;
	document.getElementById("URL_SERVICE").value= b;
	document.getElementById("LY_NAME").value = c;
}

function ClearBocForm(){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/WebAppData.jsp";
	document.getElementById("NM_PETA").value = "";
	document.getElementById("URL_SERVICE").value= "";
	document.getElementById("LY_NAME").value = "";
	document.getElementById("DEFAULT_SHW").value = "false";
	document.getElementById("TYPE_SERVICE").value = "OGC";
	document.getElementById("IDX_SERVICE").value = "";
	document.getElementById("LY_EXTD").value = "";
	document.getElementById("CmdSimpan").style.display = "inline";
	document.getElementById("CmdEdit").style.display = "none";
	document.getElementById("CmdBatal").style.display = "none";
}

function EditData(a,b,c,d,e,f,g,h,i){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/Edit-WebAppData.jsp";
	document.getElementById("KdID").value = a;
	document.getElementById("CboAp").value = b;
	document.getElementById("NM_PETA").value = c;
	document.getElementById("URL_SERVICE").value= d;
	document.getElementById("LY_NAME").value = e;
	document.getElementById("DEFAULT_SHW").value = f;
	document.getElementById("TYPE_SERVICE").value = g;
	document.getElementById("IDX_SERVICE").value = h;
	document.getElementById("LY_EXTD").value = i;
	document.getElementById("CmdSimpan").style.display = "none";
	document.getElementById("CmdEdit").style.display = "inline";
	document.getElementById("CmdBatal").style.display = "inline";
}

function AddDataOGC(nama,url,layer,xmin,ymin,xmax,ymax){
	document.getElementById("NM_PETA").value = nama;
	document.getElementById("URL_SERVICE").value= url;
	document.getElementById("LY_NAME").value = layer;
	document.getElementById("LY_EXTD").value = xmin+", "+ymin+", "+xmax+", "+ymax;
	$('#exampleModalScrollable').modal('hide')
}
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Web App Data
                            <small> Data geospasial untuk Web App GIS</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-thumb-tack marker"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/WebAppData.jsp">WebApp Data</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i>Kelula Layer App
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <form method="POST" name="FrmPeta" id="FrmPeta" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/WebAppData.jsp">
                <input name="KdID" id="KdID" type="hidden" value="0" />
                <div class="col-lg-5">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Tambahkan Peta
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                               <label>Nama App</label>
                             	<select name="CboAp" class="form-control" id="CboAp" onchange="TampilkanTabel()">
                             	  <?php do { ?>
										<option value="<?php echo $row_RsApp['KD_MODEL']?>"><?php echo $row_RsApp['NM_MODEL']?></option>
										 <?php
										} while ($row_RsApp = mysqli_fetch_assoc($RsApp));
										  $rows = mysqli_num_rows($RsApp);
										  if($rows > 0) {
											  mysqli_data_seek($RsApp, 0);
											  $row_RsApp = mysqli_fetch_assoc($RsApp);
										  }
										?>
                             	</select>
                             </div>
                            <div class="form-group row">
                      			<label class="col-sm-12 col-form-label">Nama Peta</label>   
                                <div class="col-sm-10">                             
                      			<input name="NM_PETA" id="NM_PETA" class="form-control" type="text" value="" placeholder="Nama Peta"  maxlength="40"  />
               					</div>
                                <div class="col-sm-2" align="left">
                                    <button class="btn btn-outline-success" type="button" id="CmdAddCSW" onclick="TampilkanCSW()" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fa fa-search"></i></button>
                                </div>                              	
                            </div>
                            <div class="form-group">
                      			<label>URL Map Service</label>
                      			<input name="URL_SERVICE" id="URL_SERVICE" class="form-control" type="text" value="" placeholder="URL Service"  maxlength="255" />
               				</div>
                            <div class="form-group">
                      			<label>Nama Layer</label>
                      			<input name="LY_NAME" id="LY_NAME" class="form-control" type="text" value="" placeholder="Nama Layer"  maxlength="255" />
               				</div>
                            
                            <div class="col-lg-6">
                            <div class="form-group">
                      			<label>Type  Service</label>
                      			<select name="TYPE_SERVICE" id="TYPE_SERVICE" class="form-control">
                      			  <option value="Esri" selected="selected" <?php if (!(strcmp("Esri", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Esri (Map Service)</option>
                      			  <option value="OGC" <?php if (!(strcmp("Tile", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Geoserver (OGC)</option>
                      			</select>
               				</div>
                              <div class="form-group">
                      				<label>Show Legenda</label>
                      				<select name="LEGEND_SHW" id="LEGEND_SHW" class="form-control">
                      				  <option value="true" selected="selected">Tampilkan</option>
                      				  <option value="false">Sembuyikan</option>
                      				</select>
           					  </div>
                                
                            </div><!--end box kecil didalam form -->
                            
                            <div class="col-lg-6">
                               <div class="form-group">
                      				<label>Opsi Start</label>
                   				 <select name="DEFAULT_SHW" id="DEFAULT_SHW" class="form-control">
                      				  <option value="true">Tampilkan Layer</option>
                      				  <option value="false" selected="selected">Sembuyikan Layer</option>
                      				</select>
           					  </div>
                            
                            	<div class="form-group">
                      				<label>Map Index</label>
                      				<input name="IDX_SERVICE" id="IDX_SERVICE" class="form-control" type="text" value="" placeholder="Urutan Peta"  maxlength="3" />
               					</div>
                                
                            </div>
                            <div class="form-group">
                      			<label>Extend Koordinat</label>
                      			<input name="LY_EXTD" id="LY_EXTD" class="form-control" type="text" value="" placeholder="NamaExtend Koordinat Layer"  maxlength="255" />
               				</div>
                        </div>
                        <div class="panel-footer">
                           <div align="right">                           
                            <button type="button" onclick="ClearBocForm()" style="display:none;" id="CmdBatal" class="btn btn-warning">Batal</button> 
                        	<button type="button" onclick="SimpanPeta()" id="CmdEdit" style="display:none;" class="btn btn-primary">Perbaharui</button>
                            <button type="button" onclick="SimpanPeta()" id="CmdSimpan" class="btn btn-success">Simpan</button>
                           </div>
                       </div>
                    </div>
                </div>
                <!------------------------------------------------------------------------------------------->  				
                <div class="col-lg-7">
                 <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a onClick="TampilkanTabel()" style="cursor:pointer; color:#FFFFFF;" align="center">Daftar Map Peta</a>
                        </div>
                        <div class="panel-body">
                            <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                    		<div id="linkList1"></div> 
                            <div id="preview"></div>		
                        </div>
                        <div class="panel-footer">
                           	<div align="right">
                              
          	   					<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              					<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              					<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
          					</div>
                        </div>
                  </div>
                </div>
                <input type="hidden" name="MM_insert" value="frmPeta">
               </form>
</div>
<!-- /#page-wrapper -->
<p>&nbsp;</p>
<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Data Geosapsial from Geoservice CSW API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
          <div class="row">
           <div class="col-sm-10">                             
            <input name="CARI" id="CARI" class="form-control" type="text" value="" placeholder="Cari dengan Nama Peta"  maxlength="40"  />
            </div>
            <div class="col-sm-2" align="left">
                <button class="btn btn-outline-success" type="button" onclick="TampilkanCSW()"><i class="fa fa-search"></i></button>
            </div>  
          </div>
          <div id="DataApiCsw" style="max-height:500px; overflow:auto; padding:5px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	TampilkanTabel();
	document.getElementById("AppGIs01").className = "active";
	document.getElementById("AppGIs").className = "collapse in";
</script>
<?php
mysqli_free_result($RsApp);
?>
<?php } ?>
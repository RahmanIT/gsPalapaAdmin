<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
if($P[0]["ROLE"]==3){
   $quetFt= " WHERE PAGE_SOURCE <> 'DerekLink.php' and  KD_USER=".GetSQLValueString($Congis,$P[0]["KD_USER"],"int");
}
 if($P[0]["ROLE"]==2){
   $quetFt= " WHERE PAGE_SOURCE <> 'DerekLink.php'";
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
	url: "<?php echo $nama_folder; ?>/Tabel-WebAppGroup.jsp/",
	data: "model="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
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
	document.getElementById("NAMAGROUP").value = a;
	document.getElementById("KETERNGAN").value= b;
	document.getElementById("AKSES").value = c;
}

function ClearBocForm(){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/WebAppGroup.jsp";
	document.getElementById("NAMAGROUP").value = "";
	document.getElementById("KETERNGAN").value= "";
	document.getElementById("AKSES").value = "";
	document.getElementById("PRIORITAS").value = "";
	document.getElementById("CmdSimpan").style.display = "inline";
	document.getElementById("CmdEdit").style.display = "none";
	document.getElementById("CmdBatal").style.display = "none";
}

function EditData(a,b,c,d,e,f){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/Edit-WebAppGroup.jsp";
	document.getElementById("KdID").value = a;
	document.getElementById("CboAp").value = b;
	document.getElementById("NAMAGROUP").value = c;
	document.getElementById("KETERNGAN").value= d;
	document.getElementById("AKSES").value = e;
	document.getElementById("PRIORITAS").value = f;
	document.getElementById("CmdSimpan").style.display = "none";
	document.getElementById("CmdEdit").style.display = "inline";
	document.getElementById("CmdBatal").style.display = "inline";
}

function AddDataOGC(nama,url,layer,xmin,ymin,xmax,ymax){
	document.getElementById("NAMAGROUP").value = nama;
	document.getElementById("KETERNGAN").value= url;
	document.getElementById("AKSES").value = layer;
	document.getElementById("LY_EXTD").value = xmin+", "+ymin+", "+xmax+", "+ymax;
	$('#exampleModalScrollable').modal('hide')
}
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Web Gis App Layers Group
                            <small> manajemant grouo dataset</small>
                             <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Layers_GisWebApp.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-thumb-tack marker"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/WebAppData.jsp">WebApp Data</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i>Layers Group
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <form method="POST" name="FrmPeta" id="FrmPeta" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/WebAppGroup.jsp">
                <input name="KdID" id="KdID" type="hidden" value="0" />
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambahkan Group Dataset layes
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                               <label>Aplikasi</label>
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

                            <div class="form-group">
                      			<label>Nama Group layers</label>
                      			<input name="NAMAGROUP" id="NAMAGROUP" class="form-control" type="text" value="" placeholder="Nama Group Layers"  maxlength="255" />
               				</div>
                            <div class="form-group">
                      			<label>Keterangan</label>
                      			<input name="KETERNGAN" id="KETERNGAN" class="form-control" type="text" value="" placeholder="Remark"  maxlength="255" />
               				</div>
                          <div class="form-group">
                      			<label>Mode Akses</label>
                      			<select name="AKSES" id="AKSES" class="form-control" >
                      			  <option value="BUKA">TERBUKA</option>
                      			  <option value="TUTUP">HANYA DINAS</option>
                   			  </select>
               				</div>
                           <div class="form-group">
                      			<label>Prioritas</label>
                      			<input name="PRIORITAS" id="PRIORITAS" class="form-control" type="number" value="" placeholder="No urut"  maxlength="255" />
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
                <div class="col-lg-8">
                 <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a onClick="TampilkanTabel()" style="cursor:pointer; color:#FFFFFF;" align="center">Daftar Greoup Layers</a>
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
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_RstAdmin = "SELECT KD_USER, INISIAL FROM tb_admin";
$RstAdmin = mysqli_query($Congis, $query_RstAdmin) or die(mysqli_error());
$row_RstAdmin = mysqli_fetch_assoc($RstAdmin);
$totalRows_RstAdmin = mysqli_num_rows($RstAdmin);
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
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-MapService.jsp/",
	data: "Halaman="+pg,
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

function ClearBocForm(){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/SimpanMapService.jsp";
	document.getElementById("NamaPeta").value = "";
	document.getElementById("AddrPeta").value ="";
	document.getElementById("IdxMap").value = "";
	document.getElementById("TrasnMap").value ="1.0"
	document.getElementById("CmdSimpan").style.display = "block";
	document.getElementById("CmdEdit").style.display = "none";
	document.getElementById("CmdBatal").style.display = "none";
}

function EditData(N,S,t,l,d,i,trn,kd){
	document.getElementById("FrmPeta").action = "<?php echo $nama_folder; ?>/Edit-MapService.jsp";
	document.getElementById("NamaPeta").value = N;
	document.getElementById("AddrPeta").value =S;
	document.getElementById("TYPE_SERVICE").value = t;
	document.getElementById("LEGEND_SHW").value =l;
	document.getElementById("DEFAULT_SHW").value = d;
	document.getElementById("IdxMap").value = i;
	document.getElementById("TrasnMap").value =trn;
	document.getElementById("KdID").value = kd;
	document.getElementById("CmdSimpan").style.display = "none";
	document.getElementById("CmdEdit").style.display = "block";
	document.getElementById("CmdBatal").style.display = "block";
}
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Map Service
                            <small> tambahkan peta kedalam simpul jaringan</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-thumb-tack marker"></i><a href="../../WebAdmin/pages/Feature.jsp">Map Service</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i>Manager
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <form method="POST" name="FrmPeta" id="FrmPeta" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/SimpanMapService.jsp">
                <input name="KdID" id="KdID" type="hidden" value="0" />
                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Tambahkan Peta
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                      			<label>Nama Peta</label>
                      			<input name="NM_PETA" id="NamaPeta" class="form-control" type="text" value="<?php echo $_GET['Nama']; ?>" placeholder="Nama Peta"  maxlength="40"  />
               				</div>
                            <div class="form-group">
                      			<label>URL Map Service</label>
                      			<input name="URL_SERVICE" id="AddrPeta" class="form-control" type="text" value="<?php echo $_GET['UrlS']; ?>" placeholder="URL Service"  maxlength="255" />
               				</div>
                            
                            <div class="col-lg-6">
                            <div class="form-group">
                      			<label>Type  Service</label>
                      			<select name="TYPE_SERVICE" id="TYPE_SERVICE" class="form-control">
                      			  <option value="Dynamic" selected="selected" <?php if (!(strcmp("Dynamic", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Dynamic</option>
                      			  <option value="Tile" <?php if (!(strcmp("Tile", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Tile Layer</option>
                      			  <option value="Feature" <?php if (!(strcmp("Feature", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Featue Acces</option>
                      			  <option value="WMS" <?php if (!(strcmp("WMS", $_GET['type']))) {echo "selected=\"selected\"";} ?>>GeoRSS (WMS)</option>
                      			  <option value="KML" <?php if (!(strcmp("KML", $_GET['type']))) {echo "selected=\"selected\"";} ?>>Google Earth (KML) </option>
                      			</select>
               				</div>
                              <div class="form-group">
                      				<label>Show Legenda</label>
                      				<select name="LEGEND_SHW" id="LEGEND_SHW" class="form-control">
                      				  <option value="true" selected="selected">Tampilkan</option>
                      				  <option value="false">Sembuyikan</option>
                      				</select>
           					  </div>
                              <div class="form-group">
                   				<label>Username</label>
                   			     <input name="USERNAME" id="USERNAME" class="form-control" type="text" value="" placeholder="User id Map Service"  maxlength="40"  />
               					</div>
                                <div class="form-group">
                      				<label>Password</label>
                      			   <input name="PWD" id="PWD" class="form-control" type="text" value="" placeholder="Password Map Service"  maxlength="40"  />
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
                      				<input name="IDX_SERVICE" id="IdxMap" class="form-control" type="text" value="" placeholder="Urutan Peta"  maxlength="3" />
               					</div>
                                <div class="form-group">
                      				<label>Transparansi</label>
                      				<input name="TRANSPARAN" id="TrasnMap" class="form-control" type="text" value="1.0" placeholder="Urutan Peta"  maxlength="3" />
               					</div>
                                <div class="form-group">
                                <strong>Publisher</strong>
                                 <select name="KD_USER" id="KD_USER" class="form-control" disabled="disabled">
                                   <?php
									do {  
									?>
                                   <option value="<?php echo $row_RstAdmin['KD_USER']?>"<?php if (!(strcmp($row_RstAdmin['KD_USER'], $_SESSION['KdUser']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RstAdmin['INISIAL']?></option>
                                   <?php
									} while ($row_RstAdmin = mysqli_fetch_assoc($RstAdmin));
									  $rows = mysqli_num_rows($RstAdmin);
									  if($rows > 0) {
										  mysqli_data_seek($RstAdmin, 0);
										  $row_RstAdmin = mysqli_fetch_assoc($RstAdmin);
									  }
									?>
                                 </select>
                                </div>
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
                <div class="col-lg-6">
                 <div class="panel panel-success">
                        <div class="panel-heading">
                            <a onClick="TampilkanTabel()" style="cursor:pointer; color:#666;" align="center">Daftar Map Peta</a>
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
<?php if($P[0]["ROLE"]=='2'){ ?>
<script>
document.getElementById("KD_USER").disabled = false;
</script>
<?php }?>
<script>
	TampilkanTabel();
	document.getElementById("Manage2").className = "active";
</script>        
<?php
mysqli_free_result($RstAdmin);
} ?>
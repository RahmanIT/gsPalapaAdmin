<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_rstDIR = "SELECT * FROM tb_shpfile_dir";
$rstDIR = mysqli_query($Congis, $query_rstDIR) or die(mysqli_error());
$row_rstDIR = mysqli_fetch_assoc($rstDIR);
$totalRows_rstDIR = mysqli_num_rows($rstDIR);

$query_RstUSer = "SELECT KD_USER, INISIAL FROM tb_admin";
$RstUSer = mysqli_query($Congis, $query_RstUSer) or die(mysqli_error());
$row_RstUSer = mysqli_fetch_assoc($RstUSer);
$totalRows_RstUSer = mysqli_num_rows($RstUSer);
?>
<style>
#AddFeture{
	position:fixed;
	height:auto;
	display:none;	 
}
#HapusPanel{
	position:fixed;
	height:auto;
	display:none;
	min-width:200px;
}
#TfPanel{
	position:fixed;
	height:auto;
	display:none;
	min-width:200px;
}
#LoadingH{
	display:none;
}
#CmdOke{
	display:none;
}
#CmdOke2{
	display:none;
}
</style>
<script src="<?php echo $nama_folder; ?>/js/jquery.wallform.js"></script>
<script>
function SimpanSHP(){ 			  
	$("#preview").html();
	
	$("#FrmAddPeta").ajaxForm({target: '#preview', 
	 beforeSubmit:function(){ 
	
	console.log('ttest');
	$("#LoadingUp").show();
	 }, 
	 
	success:function(){ 
	console.log('test');
	TampilkanTabel();
	$("#LoadingUp").hide();
	//ClearBocForm();
	BatalAdd()
	}, 
	error:function(){ 
	console.log('xtest');
	TampilkanTabel()
	 $("#LoadingUp").hide();
	} }).submit();
 };
 
 function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
  var cari = document.getElementById("Cari").value
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/uploadSHPtabel.jsp/",
	data: "Halaman="+pg+"&cari="+cari,
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
 
 function HapusFileSHP(){
	$("#LoadingH").show();
	document.getElementById("CmdBtl").style.display='none';
	document.getElementById("CmdHps").style.display='none';
	document.getElementById("CmdOke").style.display='inline';
	var i=document.getElementById("KdFIleDel").value;
    var d=document.getElementById("NmDirDel").value;
    var f=document.getElementById("NmFileDel").value; 
	$.ajax({
	url: "<?php echo $nama_folder; ?>/deleteSHP.jsp/",
	data: "p="+i+"&file="+f+"&dir="+d,
	cache: false,
	success: function(msg){
		 document.getElementById("IsiPesanHapus").innerHTML = msg;
		$("#LoadingH").hide();
		}
	});
}; 
 
function BerhasilHapus(){
	document.getElementById('HapusPanel').style.display='none';
	TampilkanTabel()
}
 
 function TrnasferFileSHP(){
	$("#PsnTransfer").html('<img src="<?php echo $nama_folder; ?>/images/loader.gif" width="220" height="19" alt="Loading.." />')
	document.getElementById("CmdBtl2").style.display='none';
	document.getElementById("CmdTrf2").style.display='none';
	document.getElementById("CmdOke2").style.display='inline';
    var d=document.getElementById("NmDirTf").value;
    var f=document.getElementById("NmFileTf").value; 
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TransmiterSHPunZip.jsp/",
	data: "p="+f+"&dr="+d,
	cache: false,
	success: function(msg){
		 document.getElementById("PsnTransfer").innerHTML = msg;
		}
	});
}; 


 function EditOpAksesSHP(){
	$("#LoadingUp").show(); 
	var d=document.getElementById("TxtAksesOP").value;
    var i=document.getElementById("TxtIdSHP").value; 
	$.ajax({
	url: "<?php echo $nama_folder; ?>/EditSHPaksesOP.jsp/",
	data: "kd="+i+"&data="+d,
	cache: false,
	success: function(msg){
		 //document.getElementById("PsnTransfer").innerHTML = msg;
		 document.getElementById("AddFeture").style.display= "none";
		 $("#LoadingUp").hide();
		 TampilkanTabel()
		}
	});
}; 
 </script>
<script>
function AddFeature(){
  var winW = window.innerWidth;
  document.getElementById("AddFeture").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("AddFeture").style.top = "100px";
  document.getElementById("AddFeture").style.display= "inherit";
    document.getElementById("f1").style.display='inline';
  document.getElementById("f2").style.display='inline';
  document.getElementById("f3").style.display='inline';
  document.getElementById("CmdUpdate").style.display='none';
  document.getElementById("CmdSimpan").style.display='inline';
}

function HapusSHPpanel(i,n,d){
  var winW = window.innerWidth;
  document.getElementById("HapusPanel").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("HapusPanel").style.top = "200px";
  document.getElementById("HapusPanel").style.display= "inherit";
  document.getElementById("IsiPesanHapus").innerHTML = "["+i+"] "+ n;
  document.getElementById("KdFIleDel").value = i;
  document.getElementById("NmDirDel").value = d;
  document.getElementById("NmFileDel").value = n; 
  document.getElementById("CmdBtl").style.display='inline';
  document.getElementById("CmdHps").style.display='inline';
  document.getElementById("CmdOke").style.display='none';
}

function TfPanelOn(f,d){
  var winW = window.innerWidth;
  document.getElementById("TfPanel").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("TfPanel").style.top = "100px";
  document.getElementById("TfPanel").style.display= "inherit";
  document.getElementById("PsnTransfer").innerHTML = d+'/'+f;
  document.getElementById("NmDirTf").value = d;
  document.getElementById("NmFileTf").value = f;
  document.getElementById("CmdBtl2").style.display='inline';
  document.getElementById("CmdTrf2").style.display='inline';
}

function BatalAdd(){
  document.getElementById("AddFeture").style.display= "none"
}
function EditOPakses(i,a){
  var winW = window.innerWidth;
  document.getElementById("AddFeture").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("AddFeture").style.top = "100px";
  document.getElementById("AddFeture").style.display= "inherit";
  document.getElementById("f1").style.display='none';
  document.getElementById("f2").style.display='none';
  document.getElementById("f3").style.display='none';
  document.getElementById("CmdUpdate").style.display='inline';
  document.getElementById("CmdSimpan").style.display='none';
  document.getElementById("TxtAksesOP").value=a;
  document.getElementById("TxtIdSHP").value=i;
}
	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Uplopload Peta<small> Upload peta kedalam derektory map service</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="../../WebAdmin/pages/UploadPeta.jsp">Upload Peta</a>
                            </li>
                            
                        </ol>
                    </div>
                </div> 

         		<!--============================================================================ -->
                <div class="col-lg-4 text-left">
				<button type="button" class="btn btn-primary" onClick="AddFeature()">Tambah Peta SHP <i class="fa fa-plus"></i></button><br/><br/>
                </div>
                <div class="col-lg-6 text left">
                       <div id="preview"></div>	
                </div>
                <!--============================================================================ -->
                <div class="col-lg-12 text-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Daftar File Peta</h3>
                        </div>
                        <div class="panel-body">
                             <div class="col-lg-4"> 
                                <div class="form-group input-group">
                                        <input name="CARI" id="Cari" type="text" class="form-control" placeholder="Cari Peta">
                                        <span class="input-group-btn"><button class="btn btn-default" onclick="TampilkanTabel()" type="button"><i class="fa fa-search"></i></button></span>
                                   </div>
                            </div> 
                            <!----------- BOX TENGAH loadng-->
                            <div class="col-lg-4" align="center"> 
                              <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                            </div> 
                            <!---------- Box Atas Kanan Navigasi Halaman----------------------------> 
                            <div class="col-lg-4" align="right"> 
                              	<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              					<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              					<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
                            </div>
                            <!-------------- Awal Box 12 ----------------->
                            <div class="col-lg-12">
                             <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                             <div id="linkList1"></div>
                            </div>
                            <!--------------- Akhir Box 12----------------->                            
                        </div>
                           <div class="panel-footer">
       						<table  border="0" cellpadding="6" cellspacing="5">
                              <tr>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/useredit.png" width="16" height="16" /> Edit Hak Akses </td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/nav_fullextent.png" width="16" height="16" /> Download File </td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/database.png" width="16" height="16" /> Salin ke Geoserver (Publis)</td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/nav_decline.png" width="16" height="16" /> Hapus File </td>
                              </tr>
                            </table>
                            </div>
                    </div>
                </div>                                           
</div>
  <!-- /#page-wrapper -->
<p>&nbsp;</p>

<script>
TampilkanTabel();
	function PIlihAll(){
		for (i = 0; i < document.getElementsByName("ChkOPakses").length; i++){
		  document.getElementsByName("ChkOPakses").item(i).checked=true;		
		}
		document.getElementById("TxtAksesOP").value='all';
	}
	
   function UnSelctAll(){
		for (i = 0; i < document.getElementsByName("ChkOPakses").length; i++){
		  document.getElementsByName("ChkOPakses").item(i).checked=false;  
		}
		 document.getElementById("TxtAksesOP").value='';
  }
  
  	function CkUnlyMe(){
	  UnSelctAll();	
	  var sid = "ChkOPakses_"+<?php echo $_SESSION['KdUser']; ?>;
	  //alert(sid);
	  document.getElementById(sid).checked=true; 
	  CekdataOPT();
	}
	
   function CekdataOPT(){
		var dt = "";
		var t=0;
	    for (i = 0; i < document.getElementsByName("ChkOPakses").length; i++){
		    if (document.getElementsByName("ChkOPakses").item(i).checked==true){
			  if(t>0){
				   dt = dt+", "+document.getElementsByName("ChkOPakses").item(i).value;
				 }else{
				   dt = document.getElementsByName("ChkOPakses").item(i).value;
				}	
			   t=t+1;
			  document.getElementById("TxtAksesOP").value =  dt;  
			}
		}
	}
</script>
                
             <!--============================================================================ -->
             <!--  FORM TABHAKAN FEATURE ACCES -->
                <form action="<?php echo $nama_folder; ?>/uploadSHP.jsp" method="post" enctype="multipart/form-data" id="FrmAddPeta" name="FrmAddPeta">
                 <div id="AddFeture" class="col-lg-4">
                   <div class="panel panel-primary">
                       <div class="panel-heading">
                            <h3 id="PnlTitle" class="panel-title">Upload Shapefile (ZIP)</h3>
                       </div>
                       <div class="panel-body">
                           <div id="f1" class="form-group">
                           		<label>Sumber File (.ZIP)</label>
                            	<input name="fileUploadSHP" onchange="CekNmFile()" id="fileUploadSHP" type="file" />
                           </div>
                          <div id="f2" class="form-group">
                           		<label>Penjelasan FIle</label>
                            	<textarea name="KetShapefile" class="form-control" id="KetShapefile" placeholder="Keterangan file/Kata Kunci"></textarea>
                           </div>
                           <div id="f3" class="form-group">
                            <label>Folder</label>
                             <select name="CboDIR" class="form-control" id="CboDIR">
                               <?php do {  ?>
                               <option value="<?php echo $row_rstDIR['DIR_NAME']?>"><?php echo $row_rstDIR['DIR_NAME']?></option>
                               <?php
								} while ($row_rstDIR = mysqli_fetch_assoc($rstDIR));
								  $rows = mysqli_num_rows($rstDIR);
								  if($rows > 0) {
									  mysqli_data_seek($rstDIR, 0);
									  $row_rstDIR = mysqli_fetch_assoc($rstDIR);
								  }
								?>
                             </select>     
                           </div>
                           
                              <div class="form-group">
                               <label>Hak Akses</label>
                               <input type="text" class="form-control" name="TxtAksesOP" id="TxtAksesOP" />
                              <div class="row"> 
                                  <div class="col-lg-8">
                                   <div style="overflow:auto; padding:3px; border:#06C solid 1px; max-height:100px;">
                                        <?php do { ?>
                                            <label><input type="checkbox" name="ChkOPakses" onclick="CekdataOPT()" value="<?php echo $row_RstUSer['INISIAL']; ?>" id="ChkOPakses_<?php echo $row_RstUSer['KD_USER']; ?>" /> <?php echo $row_RstUSer['INISIAL']; ?></label><br/>
                                        <?php } while ($row_RstUSer = mysqli_fetch_assoc($RstUSer)); ?>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <label><input type="radio" name="RadioGroup1" onclick="PIlihAll()" value="1"  />Sema</label><br />
                                    <label><input type="radio" name="RadioGroup1" onclick="UnSelctAll()" value="2"/>Bersihkan</label><br />
                                    <label><input type="radio" name="RadioGroup1" onclick="CkUnlyMe()" value="3"  checked="checked"/>Hanya Saya</label>
                                  </div>
                              </div><!--end row baris hak akses-->
                               
                             </div>

                       </div><!-- end body box-->
                       
                         <div class="panel-body" align="right">
                           <img id="LoadingUp" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Loading..." />
                           <button type="button" onClick="BatalAdd()" class="btn btn-warning">Close</button>
                           <button type="button" id="CmdSimpan" onClick="SimpanSHP()" class="btn btn-success">Simpan</button>
                           <button type="button" id="CmdUpdate" onClick="EditOpAksesSHP()" class="btn btn-primary">Update</button>
                           <input name="TxtIdSHP" id="TxtIdSHP" type="hidden" value="" />
                         </div>
                   </div>
          
                 </div>
                 </form>
                <!-- --------------------END featue from------------ -->
                                          
         
            
		        <!-- Panel HAPUS file SHP --------------- -->
                <div id="HapusPanel" class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Anda Yakin menghapus File</h3>
                            </div>
                            
                            <div class="panel-body">
                              <div id="IsiPesanHapus" style="font-weight:bold;"> Panel content</div>
                               <div align="center" id="LoadingH">
                                    <img  src="<?php echo $nama_folder; ?>/images/loading1.gif" width="100" height="100" alt="Loading..." />
								</div> 
                         </div>
                         
                         <div align="right" class="panel-footer">
						   <button type="button" id="CmdOke" class="btn btn-sm btn-success" onclick="BerhasilHapus()">Success</button>
                           <button type="button" id="CmdBtl" onclick="document.getElementById('HapusPanel').style.display='none';" class="btn btn-sm btn-warning">Batal</button>
                           <button type="button" id="CmdHps" onclick="HapusFileSHP()" class="btn btn-sm btn-danger">Hapus</button>
                        </div> 
                       <input id="KdFIleDel" type="hidden" value="" />
                       <input id="NmFileDel" type="hidden" value="" />
                       <input id="NmDirDel" type="hidden" value="" />       
              </div>
               <!-- Akhir Panel HAPUS file SHP --------------- -->
               
               <!-- Awal Panel transfer data shp ke server geoserver-->
				<div id="TfPanel" class="panel panel-primary">
                   <div class="panel-heading">
                      <h3 class="panel-title">Kirim ke Geoserver Folder</h3>
                   </div>
                   <div class="panel-body" id="PsnTransfer">
                   
                   </div>
                   <div align="right" class="panel-footer">
                   <button type="button" id="CmdBtl2" class="btn btn-sm btn-warning" onclick="document.getElementById('TfPanel').style.display='none';">Batal</button>
                   <button type="button" id="CmdTrf2" class="btn btn-sm btn-primary" onclick="TrnasferFileSHP()">Transfer</button>
                   <button type="button" id="CmdOke2" class="btn btn-sm btn-success" onclick="document.getElementById('TfPanel').style.display='none';">Success</button>
                   </div> 
                   <input id="NmFileTf" type="hidden" value="" />
                    <input id="NmDirTf" type="hidden" value="" />               
               </div><!--end div panel -->
<?php
mysqli_free_result($rstDIR);
mysqli_free_result($RstUSer);
} ?>     
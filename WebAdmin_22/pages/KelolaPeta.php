<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<?php
$query_RstUSer = "SELECT KD_USER, INISIAL FROM tb_admin";
$RstUSer = mysqli_query($Congis, $query_RstUSer) or die(mysqli_error());
$row_RstUSer = mysqli_fetch_assoc($RstUSer);
$totalRows_RstUSer = mysqli_num_rows($RstUSer);
?>

<style>
#AddFeture{
	position: fixed;
	height:auto;
	display:none;	 
}
#HapusPanel{
	position:fixed;
	height:auto;
	display:none;
	min-width:200px;
}
</style>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function SimpanFt(){ 			  
	$("#preview").html();
	  
	 $("#FrmAddPetaFeature").ajaxForm({target: '#preview', 
	  beforeSubmit:function(){ 		
		 console.log('ttest');
		$("#LoadingUp").show();
	 }, 
					 
 	 success:function(){ 
	    console.log('test');
		TampilkanTabel();
		$("#LoadingUp").hide();
		BatalAdd()
	}, 
	
	error:function(){ 
		console.log('xtest');
		TampilkanTabel()
	   $("#LoadingUp").hide();
   } }).submit();
 };

function AddFeature(){
  var winW = window.innerWidth;
  document.getElementById("AddFeture").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("AddFeture").style.top = "80px";
  document.getElementById("AddFeture").style.display= "inherit";
  document.getElementById("PnlTitle").innerHTML = "Tambahkan Feature Acces";
  document.getElementById("CmdSave").style.display="inline";
  document.getElementById("CmdUpd").style.display="none";
  document.getElementById("NmFeature").value='';
  document.getElementById("UrlFeature").value='';
  document.getElementById("TxtAksesOP").value='';
  document.getElementById("TxtKdFt").value="";
  document.getElementById("FrmAddPetaFeature").action="<?php echo $nama_folder; ?>/SimpanFeatureLayer.jsp";
 }
 
function BatalAdd(){
  document.getElementById("AddFeture").style.display= "none"
}

function HapusSHPpanel(i,n){
  var winW = window.innerWidth;
  document.getElementById("HapusPanel").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("HapusPanel").style.top = "200px";
  document.getElementById("HapusPanel").style.display= "inherit";
  document.getElementById("IsiPesanHapus").innerHTML = "["+i+"] "+ n;
  document.getElementById("KdFIleDel").value = i; 
  document.getElementById("CmdBtl").style.display='inline';
  document.getElementById("CmdHps").style.display='inline';
  document.getElementById("CmdOke").style.display='none';
}

function EditFeature(i,n,u,r){
  var winW = window.innerWidth;
  document.getElementById("AddFeture").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("AddFeture").style.top = "80px";
  document.getElementById("AddFeture").style.display= "inherit";
  document.getElementById("PnlTitle").innerHTML = "Edit Feature Acces";
  document.getElementById("NmFeature").value=n;
  document.getElementById("UrlFeature").value=u;
  document.getElementById("TxtAksesOP").value=r;
  document.getElementById("TxtKdFt").value=i;
  document.getElementById("CmdSave").style.display="none";
  document.getElementById("CmdUpd").style.display="inline";
  document.getElementById("FrmAddPetaFeature").action="<?php echo $nama_folder; ?>/UpdateFeatureLayer.jsp";
  
 }


 function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
  var cari = document.getElementById("Cari").value
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelFeatureLayer.jsp/",
	data: "Halaman="+pg+"&cari="+cari,
	cache: false,
	success: function(msg){
		 document.getElementById("DataTabelFeature").innerHTML = msg;
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
//-------------------------------------------
 function HapusFile(){
	$("#IsiPesanHapus").html('<img src="<?php echo $nama_folder; ?>/images/loading1.gif" width="100" height="100" />');
	document.getElementById("CmdBtl").style.display='none';
	document.getElementById("CmdHps").style.display='none';
	document.getElementById("CmdOke").style.display='inline';
	var i=document.getElementById("KdFIleDel").value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/HapusFeatureLayer.jsp/",
	data: "p="+i,
	cache: false,
	success: function(msg){
		 document.getElementById("IsiPesanHapus").innerHTML = msg;
		}
	});
}; 
function BerhasilHapus(){
	document.getElementById('HapusPanel').style.display='none';
	TampilkanTabel()
}
	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Feature Servis <small>Mengedit data tabel pada Map Service</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="../../WebAdmin/pages/KelolaPeta.jsp">Kelola Peta</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
   				<!--============================================================================ -->
                <div class="col-lg-4 text-left">
				<button type="button" class="btn btn-success" onClick="AddFeature()"> Tambah Data <i class="fa fa-plus"></i></button>
                </div>
                <div class="col-lg-6 text left">
                       <div id="preview"></div>	
                </div>
                <!--============================================================================ -->
                <div class="col-lg-12 text-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Daftar Feauture Services</h3>
                        </div>
                        <div class="panel-body">
                         <div class="col-lg-3"> 
                              <div class="form-group input-group">
                                    <input name="CARI" id="Cari" type="text" class="form-control" placeholder="Cari Peta">
                                    <span class="input-group-btn"><button class="btn btn-default" onclick="TampilkanTabel()" type="button"><i class="fa fa-search"></i></button></span>
                               </div>
                            </div> 
                            <!----------- BOX TENGAH loadng-->
                            <div class="col-lg-3" align="center"> 
                              <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                            </div> 
                            <!---------- Box Atas Kanan Navigasi Halaman----------------------------> 
                            <div class="col-lg-6" align="right"> 
                              	<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              					<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              					<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
                            </div>
                            <!-------------- Awal Box 12 ----------------->
                            <div id="DataTabelFeature" class="col-lg-12">
                              
                            </div>
                            <!--------------- Akhir Box 12----------------->
                            
                            
               <!--  FORM TABHAKAN FEATURE ACCES -->
                <form action="<?php echo $nama_folder; ?>/SimpanFeatureLayer.jsp" method="post" enctype="multipart/form-data" id="FrmAddPetaFeature" name="FrmAddPetaFeature">
                 <div id="AddFeture" class="col-lg-4">
                   <div class="panel panel-primary">
                       <div class="panel-heading">
                            <h3 id="PnlTitle" class="panel-title">Tambahkan Feature Acces</h3>
                       </div>
                       <div class="panel-body">
                             <div class="form-group">
                                <label>Nama Service</label>
                                <input name="NmFeature" type="text" id="NmFeature" class="form-control" placeholder="Nama Feature Acces" maxlength="50" />
                             </div>
                             <div class="form-group">
                                <label>URL Service</label>
                                <input name="UrlFeature" type="text" id="UrlFeature" class="form-control" placeholder="URL Feature Acces" />
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
                       </div><!-- end body box-->
                         <div class="panel-body" align="right">
                           <img id="LoadingUp" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Loading..." />
                           <button type="button" onClick="BatalAdd()" class="btn btn-warning">Close</button>
                           <button type="button" id="CmdSave" onClick="SimpanFt()" class="btn btn-success">Simpan</button>
                            <button type="button" id="CmdUpd" onClick="SimpanFt()" class="btn btn-primary">Update</button>
                            <input name="TxtKdFt" id="TxtKdFt" type="hidden" value="" />
                         </div>
                   </div>
          
                 </div>
                 </form>
                <!-- --------------------END featue from------------ -->
    
                        </div>
                    </div>
                  <div class="panel-footer">
       						<table  border="0" cellpadding="6" cellspacing="5">
                              <tr>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/useredit.png" width="16" height="16" /> Edit Hak Akses </td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/nav_fullextent.png" width="16" height="16" /> Buka Data Geospasial</td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $nama_folder; ?>/images/nav_decline.png" width="16" height="16" /> Hapus File </td>
                              </tr>
                            </table>
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

		        <!-- Panel HAPUS file SHP --------------- -->
                <div id="HapusPanel" class="panel panel-red">
                    <div class="panel-heading">
                         <h3 class="panel-title">Anda Yakin menghapus File</h3>
                    </div>
                    <div class="panel-body" id="IsiPesanHapus" style="font-weight:bold;"></div>
                    <div align="right" class="panel-footer">
					   <button type="button" id="CmdOke" class="btn btn-sm btn-success" onclick="BerhasilHapus()">Success</button>
                       <button type="button" id="CmdBtl" onclick="document.getElementById('HapusPanel').style.display='none';" class="btn btn-sm btn-warning">Batal</button>
                       <button type="button" id="CmdHps" onclick="HapusFile()" class="btn btn-sm btn-danger">Hapus</button>
                    </div> 
                    <input id="KdFIleDel" type="hidden" value="" />       
              </div>
               <!-- Akhir Panel HAPUS file SHP --------------- -->
<?php 
mysqli_free_result($RstUSer);
 } ?>
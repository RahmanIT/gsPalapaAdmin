<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function Unggah(){ 			  
   $("#form1").ajaxForm({target: '#infoSave', 
	 beforeSubmit:function(){ 
	
	console.log('ttest');
	$("#imageloadstatus").show();
	 $("#imageloadbutton").hide();
	 }, 
	success:function(){ 
	console.log('test');
	$("#infoSave").html("<div class='alert alert-success'><strong>Well done!</strong> Berhasil di upload.</div>")
	 TampilkanTabel();
	 $("#imageloadstatus").hide();
	 $("#imageloadbutton").show();
	}, 
	error:function(){ 
	console.log('xtest');
	 $("#imageloadstatus").hide();
	$("#imageloadbutton").show();
	} }).submit();
 };


function Verifikasi(){
   var pesan = '';		
        if (document.getElementById("filUpload").value== '') {
            pesan = '0';
			document.getElementById("infoFile").innerHTML= "<font color='#FF0000'><b>(Tiadak ada file)</b></font>";
        }else{ document.getElementById("infoFile").innerHTML='' }	
		
		 if (pesan != '') {
            return false;
        }else{
		 Unggah();
		}
}
function VerifikasiEdit(){
   var pesan = '';		
        if (document.getElementById("NAMA").value== '') {
            pesan = '0';
			document.getElementById("InfoNama").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoNama").innerHTML='' }	

		 if (pesan != '') {
            return false;
        }else{
		 Unggah();
		}
}

function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-FhotoExplor.jsp/",
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

function PosisiAwal(){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Upload-images-berita/"
 	document.getElementById("HederJudul").innerHTML = "Unaggah Foto"
	document.getElementById("CmdSave").style.display = "inline-block";
    document.getElementById("NAMA").value = "";
}

function ClaerInfo(){
 $("#infoSave").html()
}

function UrlFoto(nm){
  var winW = window.innerWidth;
  document.getElementById("PsnEdit").style.display= "block"
  document.getElementById("PsnEdit").style.width = "400px"
  document.getElementById("PsnEdit").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("PsnEdit").style.top = "200px";
  document.getElementById("PsnEdit").style.display= "inherit";
  document.getElementById("IsiPesanEdit").innerHTML = '<input  id="TxtNama" class="form-control" type="text"  size="30" />';
  document.getElementById("TxtNama").value = nm;
}

function TutupUrl(){
  document.getElementById("PsnEdit").style.display= "none";
}

	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script>

<style>
#imgAvatar
{
color:#cc0000;
width:auto;
border:#FFFFFF;
border-color:#FFFFFF;
border-width:2px;
height:60px;
background:#666666;
}
</style>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Upload Images
                            <small> tambahkan foto untuk di pasang pada halaman berita</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Berita.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-link"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Upload-Images.jsp">Upload</a>
                            </li>                         
                            <li class="active">
                                <i class="fa fa-pencil"></i> Edit
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
	          <div class="col-lg-4 text-left">
 	  					<div class="panel panel-default">
   							<div class="panel-body"> 
                              <h3 id="HederJudul">Unggah Foto</h3>
                              <div id="infoSave" onclick="ClaerInfo()"></div>
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="">                                                               
              					<div class="form-group">
                    				<label></label><span id="infoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div>                                                                
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right"> 									
                                    <button type="button" id="CmdSave" onClick="Verifikasi()" class="btn btn-lg btn-primary">Upload</button>                                    
                				</div>  
                                <input name="KD_FILE" id="KD_FILE" type="hidden" value="" />                                                      
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
  
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-12 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Fhoto</h3>
                                 	<div align="right">
          	   							<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              							<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              							<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
          							</div>
                               <div id="linkList1"></div> 
                 			</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
               
                
           </div>
            <!-- /.container-fluid -->
 </div>

  <!-- --------------------MESAGE --------------- -->
 <div id="PsnEdit" class="MsgHaspus">
   <div class="panel panel-yellow">
       <div class="panel-heading">
            <h3 class="panel-title">URL Foto</h3>
       </div>
       <div class="panel-body" id="IsiPesanEdit">
             Panel content
       </div>
       <div class="panel-body" align="right">
       <button type="button" onClick="TutupUrl()" class="btn btn-warning">Tutup</button>
       </div>
   </div>
 </div>
<!-- --------------------END MESAGE------------ --> 

<!-- /#page-wrapper -->
 <p>&nbsp;</p>
 <script>
   TampilkanTabel();
   PosisiAwal();
 </script>
 <?php } ?>
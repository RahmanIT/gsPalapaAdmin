<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!="" && strlen($P[0]["NAMA"]) > 15){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function Unggah(){ 			  
			       $("#preview").html();
			  
				   $("#form1").ajaxForm({target: '#infoSave', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
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
        if (document.getElementById("NAMA").value== '') {
            pesan = '0';
			document.getElementById("InfoNama").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoNama").innerHTML='' }	

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
	url: "<?php echo $nama_folder; ?>/TabelDownloadFile.jsp/",
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

function EditData(n,k){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Upload-pdf-update/"
	document.getElementById("NAMA").value = n;
	document.getElementById("KD_FILE").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit File"
	document.getElementById("CmdSave").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "inline-block";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Upload-pdf-save/"
 	document.getElementById("HederJudul").innerHTML = "Unggah File"
	document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "none";
	document.getElementById("CmdSave").style.display = "inline-block";
    document.getElementById("NAMA").value = "";
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
                           Upload
                            <small> dibagikan file ke publik</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home.html">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-link"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Unggah.jsp">Upload</a>
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
                              <h3 id="HederJudul">Unggah Files</h3>
                              <div id="infoSave"></div>
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="">
                                <div class="form-group">
                     				 <label>Nama File</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA" class="form-control" type="text" value="" placeholder="Nama Link" size="50" maxlength="255" />
               					</div>
                                
              					<div class="form-group">
                    				<label>Lampirkan File</label><span id="infoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div> 
                                                               
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
 									<button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
                                    <button type="button" id="CmdSave" onClick="Verifikasi()" class="btn btn-lg btn-primary">Upload</button>
                                    <button type="button" id="CmdUpdate"  onClick="VerifikasiEdit()" class="btn btn-lg btn-primary">Update</button>
                				</div>  
                                <input name="KD_FILE" id="KD_FILE" type="hidden" value="" />                              
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-8 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Unduhan</h3>
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
<!-- /#page-wrapper -->
 <p>&nbsp;</p>
 <script>
   TampilkanTabel();
   PosisiAwal();
   document.getElementById("down01").className = "active";
 </script>
 <?php }?>
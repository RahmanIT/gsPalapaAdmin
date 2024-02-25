<?php error_reporting(0);  if($P[0]["ROLE"]==2  && $P[0]["EMAIL"]!=""){ ?>
<style>
#imgAvatar
{
color:#cc0000;
width:auto;
height:60px;
width:250px;
}
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Binder
                <small> Gambar link inforasi terkait</small>
                <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Binder.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-link"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/link.html">Conten</a>
                </li>
                <li>
                    <i class="fa fa-link"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Binder.html">Binder</a>
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
                  <h3 id="HederJudul">Tambahkan Binder</h3>
                  <div id="infoSave"></div>
                  <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/Binder.jsp">
                    <div class="form-group">
                         <label>Nama Binder</label><span id="InfoNama"></span>
                         <input  name="NAMA" id="NAMA" onKeyPress="ClearInfo1()" class="form-control" type="text" value="" placeholder="Nama Link" size="50" maxlength="255" />
                    </div>
                    <div class="form-group">
                         <label>URL Target</label><span id="InfoUrl"></span>
                         <input  name="URL" id="URL" class="form-control" type="text" value="" placeholder="URL" size="50" maxlength="255" />
                    </div>  
                    
                    <div class="form-group">
                        <label>Image Binder</label> (250 X 60 Pixel)<span id="FotoFile"></span>
                        <div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                        <div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" OnChange="showPreview(this)" /></div>
                    </div> 

                     <div class="form-group">
                        <center>
                            <img id="imgAvatar" style="border:solid 1px #0066CC;"/>
                        </center>
                    </div>
                                                   
                     <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
                    <div class="box-footer" align="right">
                        <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
                        <button type="button" id="CmdSave" onClick="Verifikasi()" class="btn btn-lg btn-primary">Tambahkan</button>
                        <button type="button" id="CmdUpdate"  onClick="VerifikasiEdit()" class="btn btn-lg btn-primary">Update</button>
                    </div>  
                    <input name="KD" id="KD" type="hidden" value="" />                             
                  </form>
                  <p>&nbsp;</p>
                </div>
          </div>
   </div>
<!-- ========================================================================================== -->         
  <div class="col-lg-8 text-center">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Binder</h3>
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
 <script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script type="text/javascript">
function Unggah(){ 			  
   //$("#preview").html();
   $("#form1").ajaxForm({target: '#linkList1', 
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


function Verifikasi(){
   var pesan = '';		
        if (document.getElementById("NAMA").value== '') {
            pesan = '0';
			document.getElementById("InfoNama").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoNama").innerHTML='' }	

        if (document.getElementById("URL").value== '') {
            pesan = '0';
			document.getElementById("InfoUrl").innerHTML= "<font color='#FF0000'><b>(Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoUrl").innerHTML='' }

        if (document.getElementById("filUpload").value== '') {
            pesan = '0';
			document.getElementById("FotoFile").innerHTML= "<font color='#FF0000'><b> Sisipkan Gambar</b></font>";
        }else{ document.getElementById("FotoFile").innerHTML='' }	
		
		 if (pesan != '') {
            //alert('Maaf, ada kesalahan pengisian Formulir : \n'+pesan);
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

        if (document.getElementById("URL").value== '') {
            pesan = '0';
			document.getElementById("InfoUrl").innerHTML= "<font color='#FF0000'><b>(Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoUrl").innerHTML='' }
		
		 if (pesan != '') {
            //alert('Maaf, ada kesalahan pengisian Formulir : \n'+pesan);
            return false;
        }else{
		 Unggah();
		}
}

function TampilkanTabel(){
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelBinder.jsp/",
	data: "p=1",
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};


function ClearInfo1(){
  document.getElementById("infoSave").innerHTML ="";
}

function EditData(n,p,f,k){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-Binder.jsp"
	document.getElementById("NAMA").value = n;
	document.getElementById("URL").value = p;
	document.getElementById("imgAvatar").src = "<?php echo $nama_folder; ?>/images/binder/250x60_"+f;
	document.getElementById("KD").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit Binder"
	document.getElementById("CmdSave").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "inline-block";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/Binder.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Binder"
	document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "none";
	document.getElementById("CmdSave").style.display = "inline-block";
    document.getElementById("NAMA").value = "";
	document.getElementById("URL").value = "";
}

TampilkanTabel();
PosisiAwal();
document.getElementById("config01").className = "active";
document.getElementById("Manage1").className = "collapse in";
 </script>
 <?php } ?> 
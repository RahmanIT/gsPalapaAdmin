<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script>
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
		
		 if (pesan != '') {
            //alert('Maaf, ada kesalahan pengisian Formulir : \n'+pesan);
            return false;
        }else{
		 SimpanLink();
		}
}

function SimpanLink(){
	$("#loding").show();
	var k = document.getElementById("NAMA").value;
	var ura = document.getElementById("URL").value;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/link.jsp/",
	data: "name="+k+"&u="+ura,
	cache: false,
	success: function(msg){
		$("#loding").hide();
		TampilkanTabel();
		if(msg==1){
		  document.getElementById("infoSave").innerHTML = "<div class='alert alert-success'><strong>Berhasi!</strong> menyimpan link</div>";
		  ShCmd();
		   }else{
			 document.getElementById("infoSave").innerHTML = "<div class='alert alert-danger'><strong>Gagal !</strong> proses tidak merespon.</div>";
			}	
		}
	});
};

function UpdateLink(){
	$("#loding").show();
	var k = document.getElementById("NAMA").value;
	var ura = document.getElementById("URL").value;
	var d = document.getElementById("KD").value;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Edit-link.jsp/",
	data: "name="+k+"&u="+ura+"&s="+d,
	cache: false,
	success: function(msg){
		$("#loding").hide();
		TampilkanTabel();
		if(msg==1){
		  document.getElementById("infoSave").innerHTML = "<div class='alert alert-success'><strong>Berhasi!</strong> menperbaharui link</div>";
		  ShCmd();
		   }else{
			 document.getElementById("infoSave").innerHTML = "<div class='alert alert-danger'><strong>Gagal !</strong> proses tidak merespon.</div>";
			}	
		}
	});
};

function TampilkanTabel(){
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/linkTabel.jsp/",
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

function EditData(n,p,k){
	document.getElementById("NAMA").value = n;
	document.getElementById("URL").value = p;
	document.getElementById("KD").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit Link"
	document.getElementById("CmdSave").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "inline-block";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Link"
	document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "none";
	document.getElementById("CmdSave").style.display = "inline-block";
    document.getElementById("NAMA").value = "";
	document.getElementById("URL").value = "";
}
</script>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Link
                            <small> informasi link website terkait</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_DerekLInk.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-link"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/link.html">Conten</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Link
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
	          <div class="col-lg-4 text-left">
 	  					<div class="panel panel-default">
   							<div class="panel-body"> 
                              <h3 id="HederJudul">Form Link</h3>
                              <div id="infoSave"></div>
                              <form method="post" name="form1" action="">
                                <div class="form-group">
                     				 <label>Nama link</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA" onKeyPress="ClearInfo1()" class="form-control" type="text" value="" placeholder="Nama Link" size="50" maxlength="255" />
               					</div>
                                <div class="form-group">
                     				 <label>URL</label><span id="InfoUrl"></span>
                      				 <input  name="URL" id="URL" class="form-control" type="text" value="" placeholder="URL" size="50" maxlength="255" />
               					</div>  
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                     <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
 									 <button type="button" id="CmdSave" onClick="Verifikasi()" class="btn btn-lg btn-primary">Tambahkan Link</button>
                                     <button type="button" id="CmdUpdate"  onClick="UpdateLink()" class="btn btn-lg btn-primary">Update</button>
                				</div>                                
                                <input type="hidden" name="MM_insert" value="form1">
                                <input type="hidden" name="KD" id="KD" value="">
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-8 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Link</h3>
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
 	document.getElementById("config01").className = "active";
	document.getElementById("Manage1").className = "collapse in";
 TampilkanTabel()
 PosisiAwal()
 </script>
 <?php } ?> 
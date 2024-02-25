<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function Unggah(){ 			   
   $("#form1").ajaxForm({target: '#linkList1', 
	 beforeSubmit:function(){ 
	
	console.log('mulai simpan');
	$("#imageloadstatus").show();
	 $("#imageloadbutton").hide();
	 }, 
	success:function(){ 
	console.log('simpan berhasil');
	 TampilkanTabel();
	 PosisiAwal();
	 $("#imageloadstatus").hide();
	 $("#imageloadbutton").show();
	}, 
	error:function(){ 
	console.log('gagal posting kategori');
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

        if (document.getElementById("KET").value== '') {
            pesan = '0';
			document.getElementById("InfoKET").innerHTML= "<font color='#FF0000'><b>(Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoKET").innerHTML='' }

        if (document.getElementById("FaIcon").value== 0) {
            pesan = '0';
			document.getElementById("InfoICON").innerHTML= "<font color='#FF0000'><b> Sisipkan Gambar</b></font>";
        }else{ document.getElementById("InfoICON").innerHTML='' }	
		
		 if (pesan != '') {
            return false;
        }else{
		 	Unggah();
		}
}

function TampilkanTabel(){
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-Kategori.jsp/",
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
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-Kategori.jsp"
	document.getElementById("NAMA").value = n;
	document.getElementById("KET").value = p;
	document.getElementById("FaIcon").value = f;
	document.getElementById("KD").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit Kategori"
	document.getElementById("CmdSave").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "inline-block";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/Kategori.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Kategori"
	document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "none";
	document.getElementById("CmdSave").style.display = "inline-block";
    document.getElementById("NAMA").value = "";
	document.getElementById("KET").value = "";
}
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Kategori
                            <small> setting kategori informasi</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Kategori.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home.html">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-gear"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/Setting.html">Managemant</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> General
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <div class="col-lg-4 text-left">
                 <div class="panel panel-default">
                   <div class="panel-body">
                       <h3 id="HederJudul">Tambahkan Kategori</h3>
                       <div id="infoSave"></div>
                        <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/Kategori.jsp">
                                <div class="form-group">
                     				 <label>Nama Ketegori</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA" onKeyPress="ClearInfo1()" class="form-control" type="text" value="" placeholder="Nama Kategori" size="50" maxlength="255" />
               					</div>
                          <div class="form-group">
           				    <label>Keterangan</label><span id="InfoKET"></span>
               				   <textarea name="KET" id="KET" cols="50" class="form-control" placeholder="Keterangan / Diskripsi"></textarea>
           				  </div>  
                          <div class="form-group">
           				    <label>Icon</label><span id="InfoICON"></span>
                            <select name="FaIcon" class="form-control" id="FaIcon">
                              <option value="0"> --- PIlih Icon --- </option>
                              <option value="icon-file-alt icon-4x">Files</option>
                              <option value="icon-cogs icon-4x">Gear</option>
                              <option value="icon-trophy icon-4x">Tropy</option>
                              <option value="icon-exclamation-sign icon-4x">info</option>
                              
                              <option value="icon-calendar icon-4x">Calender</option>
                              <option value="icon-headphones icon-4x">Headphones</option>
                              <option value="icon-music icon-4x">Music</option>
                              <option value="icon-book icon-4x">Book</option>
                              <option value="icon-film icon-4x">Film</option>
                              <option value="icon-folder-open icon-4x">Folder Open</option>
                              <option value="icon-mortar-board icon-4x">Topi Toga</option>
                              <option value="icon-camera-retro icon-4x">Camera</option>
                              <option value="icon-comments icon-4x">Comments</option>
                              <option value="icon-group icon-4x">Group</option>
                            </select>
                          </div> 
                          
                          <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                    <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
 									<button type="button" id="CmdSave" onClick="Verifikasi()" class="btn btn-lg btn-primary">Tambahkan</button>
                                    <button type="button" id="CmdUpdate"  onClick="Verifikasi()" class="btn btn-lg btn-primary">Update</button>
                				</div>  
                                <input name="KD" id="KD" type="hidden" value="" />                              
                         
						</form>
                     </div>
                  </div>
                </div>
               <!------------------------------------------------------------------------------------------------>
              <div class="col-lg-8 text-center">
                <div class="panel panel-default">
                   <div class="panel-body">
                       <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Kategori</h3>
                       <div id="linkList1"></div> 
                   </div>
                </div>
              </div>
               <!-- ========================================================================================== -->        
 </div>
<p>&nbsp;</p> 
<script>
document.getElementById("config01").className = "active";
document.getElementById("Manage1").className = "collapse in";
TampilkanTabel();
PosisiAwal();
</script>   
<?php } ?> 
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script >
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
					 PosisiAwal();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
 };
 
function VerifikasiData(){

   var pesan = '';		
        if (document.getElementById("NAMA").value== '') {
            pesan = '0';
			document.getElementById("InfoNama").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoNama").innerHTML='' }
		
        if (document.getElementById("WEB_JIGN").value== '') {
            pesan = '0';
			document.getElementById("InfoWEB").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoWEB").innerHTML='' }	

		 if (document.getElementById("SERVICE_URL").value== '') {
            pesan = '0';
			document.getElementById("InfoSRV").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoSRV").innerHTML='' }	

		if (document.getElementById("KETERANGAN").value== '') {
            pesan = '0';
			document.getElementById("InfoKETERANGAN").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoKETERANGAN").innerHTML='' }	
//        if (document.getElementById("filUpload").value== '') {
//            pesan = '0';
//			document.getElementById("FotoFile").innerHTML= "<font color='#FF0000'><b> Lampirkan Foto</b></font>";
//        }else{ document.getElementById("FotoFile").innerHTML='' }	
		
		 if (pesan != '') {
            return false;
        }else{
		 Unggah()
		}
 }
</script>		

<script>
function TampilkanTabel(){
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-jign.jsp/",
	data: "p=1",
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function EditData(n,p,j,Nt,k,ty,ktg){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-jign.jsp"
	document.getElementById("NAMA").value = n;
	document.getElementById("WEB_JIGN").value = p;
	document.getElementById("SERVICE_URL").value =j;
	document.getElementById("KETERANGAN").value =Nt;
	document.getElementById("KD_JDSN").value = k;
	document.getElementById("CboType").value = ty;
	document.getElementById("Kategori").value = ktg;
	document.getElementById("HederJudul").innerHTML = "Edit JIGN"
	document.getElementById("CmdSave").innerHTML = "Upadate";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function InfoData(n,p,j,Nt,k,ty,ktg){
	document.getElementById("NAMA").value = n;
	document.getElementById("WEB_JIGN").value = p;
	document.getElementById("SERVICE_URL").value =j;
	document.getElementById("KETERANGAN").value =Nt;
	document.getElementById("KD_JDSN").value = k;
	document.getElementById("CboType").value = ty;
	document.getElementById("Kategori").value = ktg;
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/Jign.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan JIGN"
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	document.getElementById("CmdCancel").style.display = "none";
    document.getElementById("NAMA").value = "";
	document.getElementById("WEB_JIGN").value = "";
	document.getElementById("SERVICE_URL").value ="";
	document.getElementById("KETERANGAN").value ="";
	document.getElementById("CboType").value = "";
	document.getElementById("Kategori").value = "";
}
</script>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          JIGN
                            <small> data jaringan informasi geospasial nasional</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_ServerJIGN.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-globe"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/jdsn.jps">JIGN</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Daftar JIGN
                            </li>
                        </ol>
                    </div>
                </div>
   
               <!-- ========================================================================================== -->
	          <div class="col-lg-4 text-left">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h3 id="HederJudul">Tambahkan JIGN</h3>
                              	<div id="infoSave"></div>
                            </div>
   							<div class="panel-body"> 
                              
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/Ketum.jsp"> 
                                <div class="form-group">
                     				 <label>Nama Simpul</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA"  class="form-control" type="text" value="" placeholder="Nama Simmpul" maxlength="50" />
               					</div>
                                <div class="form-group">
                     				 <label>URL Web Geoportal</label><span id="InfoWEB"></span>
                      				 <input  name="WEB_JIGN" id="WEB_JIGN" class="form-control" type="text" value="" placeholder="Alamat Web Simpul" maxlength="255" />
               					</div> 
                                <div class="form-group">
                     				 <label>URL Map Server</label><span id="InfoSRV"></span>
                      				 <input  name="SERVICE_URL" id="SERVICE_URL" class="form-control" type="text" value="" placeholder="Map Server Simpul" maxlength="255" />
               					</div>
                                 <div class="form-group">
                                  <label>Server Type</label><span id="InfoCboType"></span>
                                   <select name="CboType" class="form-control" id="CboType">
                                     <option value="ESRI">Arcgis Server</option>
                                     <option value="OGC">Geoserver</option>
                                   </select>
                                 </div>
                                 <div class="form-group">
                                  <label>Server Kategori</label><span id="InfoKategori"></span>
                                   <select name="Kategori" class="form-control" id="Kategori">
                                     <option value="1">SJ Kemeterian/Lembaga</option>
                                     <option value="2">SJ Provinsi</option>
                                     <option value="3">SJ Kabupate/Kota</option>
                                   </select>
                                 </div>
                                <div class="form-group">
                   				  <label>Keterangan</label><span id="InfoKETERANGAN"></span>
                      				 <textarea name="KETERANGAN" class="form-control" id="KETERANGAN" placeholder="Keterangan Simpul"></textarea>
               					</div>
             					<div class="form-group">
                    				<label>Logo</label> (Maksimal 2 Mega Pixel)<span id="FotoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div> 
                                                                                 
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                    <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>                                     
 									<button type="button" id="CmdSave" onClick="VerifikasiData()" class="btn btn-lg btn-primary">Tambahkan</button>
                                    
                				</div>                                
		   						<input name="KD_JDSN" id="KD_JDSN" type="hidden" value="" />
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-8 text-center">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar JIGN</h3>
                            </div>
   							<div class="panel-body">                              
                               <div id="linkList1" style="overflow:auto;max-height:600px;"></div> 
                 			</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
                      
           
</div>
  <!-- /#page-wrapper -->
<p>&nbsp;</p>
<script>
    PosisiAwal()
	TampilkanTabel();
		 <?php if($P[0]["ROLE"]!=2){?>
	document.getElementById("CmdSave").style.display ='none';
	<?php } ?>
</script>
<?php } ?>
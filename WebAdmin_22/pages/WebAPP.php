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
		
        if (document.getElementById("Instnasi").value== '') {
            pesan = '0';
			document.getElementById("InfoInstnasi").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoInstnasi").innerHTML='' }	

		 if (document.getElementById("CboModule").value== '') {
            pesan = '0';
			document.getElementById("InfoModule").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoModule").innerHTML='' }	

		if (document.getElementById("KETERANGAN").value== '') {
            pesan = '0';
			document.getElementById("InfoKETERANGAN").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoKETERANGAN").innerHTML='' }	
		
		if (document.getElementById("AppPage").value== '') {
            pesan = '0';
			document.getElementById("InfoAppPage").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoAppPage").innerHTML='' }	
		
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
	url: "<?php echo $nama_folder; ?>/Tabel-WebApp.jsp/",
	data: "p=1",
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function EditData(a,b,c,d,e,f,g,h,i,j,k,l,m){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-WebApp.jsp"
	document.getElementById("NAMA").value = a;
	document.getElementById("KETERANGAN").value = b;
	document.getElementById("Instnasi").value =c;
	document.getElementById("CboModule").value =d;
	document.getElementById("AppURL").value = e;
	document.getElementById("AppPage").value = f;
	document.getElementById("KD_MODEL").value = g;
	document.getElementById("ImgLabel").src = "data:image/png;base64,"+h;
	document.getElementById("AppDir").value = i;
	document.getElementById("KOOR_Y").value = j;
	document.getElementById("KOOR_X").value = k;
	document.getElementById("ZOOM_LV").value = l;
	document.getElementById("CboSKPD").value = m;
	document.getElementById("HederJudul").innerHTML = "Edit WEB APP"
	document.getElementById("CmdSave").innerHTML = "Upadate";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/WebApp.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan WEB APP"
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("NAMA").value = "";
	document.getElementById("KETERANGAN").value = "";
	document.getElementById("Instnasi").value ="";
	document.getElementById("CboModule").value ="";
	document.getElementById("AppURL").value = "";
	document.getElementById("AppPage").value = "";
	document.getElementById("KD_MODEL").value = "";
	document.getElementById("ImgLabel").src = "";
}

function CekFungsiM(){
	if(document.getElementById("CboModule").value=='DerekLink.php'){
		document.getElementById("AppDir").value ="DIR";
		document.getElementById("AppDir").readOnly = true; 
		document.getElementById("KOOR_Y").value ="-2";
		document.getElementById("KOOR_Y").readOnly = true;
		document.getElementById("KOOR_X").value ="115;" 
		document.getElementById("KOOR_X").readOnly = true;
		document.getElementById("ZOOM_LV").value = "8";
		document.getElementById("ZOOM_LV").readOnly = true;
		document.getElementById("AppPage").value = "dereklink.jsp"; 
		document.getElementById("AppPage").readOnly = true; 
	  }else{
		document.getElementById("AppDir").readOnly = false; 
		document.getElementById("KOOR_Y").readOnly = false; 
		document.getElementById("KOOR_X").readOnly = false;
		document.getElementById("ZOOM_LV").readOnly= false;
		document.getElementById("AppPage").readOnly = false;
	};
};
</script>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          WEB APP
                            <small> Aplikasi Web Geospasial External</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-globe"></i><a href="../../WebAdmin/pages/jdsn.jps">WEB-APP</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Daftar APP
                            </li>
                        </ol>
                    </div>
                </div>
   
               <!-- ========================================================================================== -->
	          <div class="col-lg-4 text-left">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	 <h3 id="HederJudul">Tambahkan WEB APP</h3>
                              	<div id="infoSave"></div>
                            </div>
   							<div class="panel-body"> 
                             
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/WebApp.jsp"> 
                                <div class="form-group">
                     				 <label>Nama App</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA"  class="form-control" type="text" value="" placeholder="Nama Aplikasi" maxlength="50" />
               					</div>
                                <div class="form-group">
                   				  <label>Deskripsi</label><span id="InfoKETERANGAN"></span>
                      				 <textarea name="KETERANGAN" class="form-control" id="KETERANGAN" placeholder="Keterangan Aplikasi"></textarea>
               					</div>
                                <div class="form-group">
                     				 <label>Instansi</label><span id="InfoInstnasi"></span>
                      				 <input  name="Instnasi" id="Instnasi" class="form-control" type="text" value="" placeholder="Istansi Pemilik" maxlength="255" />
               					</div> 
                                
                                <div class="form-group">
                                	<label>Module</label><span id="InfoModule"></span>
                                  <select name="CboModule" class="form-control" id="CboModule" onchange="CekFungsiM()">
                                     <option value="MapGlobalData.php" selected="selected">GeoEx3</option>
                                     <option value="palapa.php">Palapa</option>
                                     <option value="GisWebApp" selected="selected">Gis Web App</option>
                                     <option value="DerekLink.php">Derek LINK</option>
                                     <option value="covid-19.php">Covid-19</option>
                                  </select>                                  
                                </div>
                                 <div class="form-group">
                                   <label>App URL</label><span id="InfoWEB"></span>
                      				 <input  name="AppURL" id="AppURL" class="form-control" type="text" value="" placeholder="URL derek Link" maxlength="255" />
                                 </div>
                                 <div class="form-group">
                                  <label>Page Default</label>
                                  <span id="InfoAppPage"></span>
                   				    <input  name="AppPage" id="AppPage" class="form-control" type="text" value="" placeholder="default page (index.jsp)" maxlength="255" />
                                 </div>
                                
                                <div class="col-lg-6">
                            <div class="form-group">
               			  	  <label>Folder App</label>
                                  <span id="InfoAppDir"></span>
                   				<input  name="AppDir" id="AppDir" class="form-control" type="text" value="" placeholder="Nama Folder App" maxlength="50" />
               				</div>
                              <div class="form-group">
                   				<label>Longitude (X)</label>
                   				  <input name="KOOR_X" id="KOOR_X" class="form-control" type="text" value="" placeholder="Longitude (X)"  maxlength="50" />
           					  </div>
                                
                            </div><!--end box kecil didalam form -->
                            
                            <div class="col-lg-6">
                               <div class="form-group">
                   				 <label>Zoom Level</label>
                   				 <select name="ZOOM_LV" id="ZOOM_LV" class="form-control">
                   				   <option value="16">Zoom 16 (Persil)</option>
                   				   <option value="15">Zoom 15 (RT)</option>
                   				   <option value="14">Zoom 14 (Desa)</option>
                   				   <option value="13">Zoom 13 (Kelurahan)</option>
                   				   <option value="12">Zoom 12 (Kecamatan)</option>
                   				   <option value="11">Zoom 11 (Antar Kecamatan</option>
                   				   <option value="10">Zoom 10 (Kota)</option>
                   				   <option value="9">Zoom 9 (Kabupaten)</option>
                   				   <option value="8">Zoom 8 (Provinsi)</option>
                   				   <option value="6">Zoom 6 (Negara)</option>
                                 </select>
           					  </div>
                            
                           	  <div class="form-group">
               				    <label>Latitude (Y)</label>
                   				  <input name="KOOR_Y" id="KOOR_Y" class="form-control" type="text" value="" placeholder="Latitude (Y)"  maxlength="50" />
               					</div>
                                
                            </div>
                                
             					<div class="form-group">
                                   <img name="ImgLabel" id="ImgLabel" src="" width="300" height="200" alt="Image Label App" style="background-color: #CCCCCC" /><br>
                    				<label>Image Label</label> (Maksimal 2 Mega Pixel)<span id="FotoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div> 
                                <div class="form-group">
                                	<label>SKPD</label><span id="InfoModule"></span>
                                  <select name="CboSKPD" class="form-control" id="CboSKPD" onchange="">
                                      <?php 
									  if($P[0]["ROLE"] == 3){
										   echo "<option value=".$P[0]['KD_USER']." selected=\"selected\">".$P[0]["NAMA"]."</option>";
										 }
										 if($P[0]["ROLE"]==2){
										    $sumber = $conf["SrvAPI"].'/rest/WaliData';
											 $konten = file_get_contents($sumber);
											 $data = json_decode($konten, true);
											  for($a=0; $a < count($data); $a++) {
												  echo "<option value=".$data[$a]['KD_USER'].">".$data[$a]['NAMA']."</option>";
											  }
										 }
									  
									  ?>
                                  </select>                                  
                                </div>
                                                                                 
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                    <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
 									<button type="button" id="CmdSave" onClick="VerifikasiData()" class="btn btn-lg btn-primary">Tambahkan</button>
                				</div>                                
		   						<input name="KD_MODEL" id="KD_MODEL" type="hidden" value="" />
                                
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-8 text-center">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Web GIS APP</h3>
                            </div>
   							<div class="panel-body">                              
                               <div id="linkList1"></div> 
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
	document.getElementById("AppGIs01").className = "active";
	document.getElementById("AppGIs").className = "collapse in";
</script>
<?php } ?>
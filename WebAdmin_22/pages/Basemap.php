<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script >
function Unggah(){ 			  
   $("#preview").html();
   $("#form1").ajaxForm({target: '#preview', 
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
		document.getElementById("InfoNAMA").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoNAMA").innerHTML='' }	
	if (document.getElementById("URL").value== '') {
		pesan = '0';
		document.getElementById("InfoURL").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoURL").innerHTML='' }		
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
	url: "<?php echo $nama_folder; ?>/Tabel-Basemap.jsp/",
	data: "p=1",
	cache: false,
	success: function(msg){
		 document.getElementById("preview").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function EditData(a,b,c,d,e,f){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-Basemap.jsp"
	document.getElementById("NAMA").value = a;
	document.getElementById("URL").value = b;
	document.getElementById("LyName").value = c;
	document.getElementById("MapType").value = d;
	document.getElementById("KDMAP").value = e;		
	document.getElementById("ImgBasemap").src= 'data:image/png;base64,'+f;
	document.getElementById("HederJudul").innerHTML = "Edit Peta Dasar"
	document.getElementById("CmdSave").innerHTML = "Upadate";
	document.getElementById("CmdCancel").style.display = "inline-block";
}
function InfoData(a,b,c,d,e,f){
	document.getElementById("NAMA").value = a;
	document.getElementById("URL").value = b;
	document.getElementById("LyName").value = c;
	document.getElementById("MapType").value = d;
	document.getElementById("KDMAP").value = e;		
	document.getElementById("ImgBasemap").src= 'data:image/png;base64,'+f;
}
function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/Basemap.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Peta Dasar"
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	document.getElementById("CmdCancel").style.display = "none";
     document.getElementById("NAMA").value = "";
	document.getElementById("URL").value = "";
	document.getElementById("LyName").value = "";
	document.getElementById("MapType").value = "";
	document.getElementById("KDMAP").value = "";	
	document.getElementById("ImgBasemap").src= "";
	document.getElementById("filUpload").src = "";	
}
TampilkanTabel();
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          BASEMAP
                            <small> Kelola peta dasar untuk Web GIS</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="../../WebAdmin/pages/SlideShow.jsp">Slide Show</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
   
               <!-- ========================================================================================== -->
	          <div class="col-lg-6 text-left">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h3 id="HederJudul">Tambahkan Slide</h3>
                              <div id="infoSave"></div>
                        	</div>
   							<div class="panel-body"> 
                              
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/Basemap.jsp"> 
                                <div class="form-group">
                     				 <label>Judul</label><span id="InfoNAMA"></span>
                      				 <input  name="NAMA" id="NAMA" class="form-control" type="text" value="" placeholder="Judul Slide" maxlength="255" />
               					</div>
                                 <div class="form-group">
                   				  <label>URL Service</label><span id="InfoURL"></span>
                      			  <textarea name="URL" class="form-control" id="URL" placeholder="URL Service"></textarea>
           					    </div>
                                <div class="form-group">
                   				  <label>Layer Name</label><span id="InfoLyName"></span>
                      			  <input  name="LyName" id="LyName" class="form-control" type="text" value="" placeholder="Nama Layer (for OGC)" maxlength="255" />
               					</div>
                               
                                <div class="form-group">
                                <label>Server Type</label><span id="InfoMapType"></span>
                                <select name="MapType" class="form-control" id="MapType" title="Type Map Server">
                                  <option value="ArcGISRest">Arcgis Server</option>
                                  <option value="Geoserver">Geoserver</option>
                                </select>
                                </div>
             					<div class="form-group">
                                    <img id="ImgBasemap" src="" width="150" height="100" alt="Basemap Image Preview" style="background-color: #CCCCCC" /><br>
                    				<label>Image Slide</label> (Maksimal 2 Mega Pixel)<span id="FotoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div> 
                                                                                 
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                    <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
 									<button type="button" id="CmdSave" onClick="VerifikasiData()" class="btn btn-lg btn-primary">Tambahkan</button>
                				</div>                                
		   						<input name="KDMAP" id="KDMAP" type="hidden" value="" />
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-6 text-center">
 	  					<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Peta Dasar</h3>
                            </div>
   							<div class="panel-body">
                              
                               <div id="preview" style="overflow:auto; max-height:600px;"></div> 
                 			</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
                      
           
</div>
  <!-- /#page-wrapper -->
<script>
//	document.getElementById("config01").className = "active";
//	document.getElementById("Manage1").className = "collapse in";
    PosisiAwal()
	 <?php if($P[0]["ROLE"]!=2){?>
	document.getElementById("CmdSave").style.display ='none';
	<?php } ?>
</script>
<?php } ?>
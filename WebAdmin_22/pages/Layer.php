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
		document.getElementById("InfoNAMA").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoNAMA").innerHTML='' }	
	if (document.getElementById("URL").value== '') {
		pesan = '0';
		document.getElementById("InfoURL").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoURL").innerHTML='' }	
	if (document.getElementById("LyIndex").value== '') {
		pesan = '0';
		document.getElementById("InfoLyIndex").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoLyIndex").innerHTML='' }
	if (document.getElementById("MapType").value== 'OGC' && document.getElementById("LyName").value=='') {
		pesan = '0';
		document.getElementById("InfoLyName").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoLyName").innerHTML='' }		
	 if (pesan != '') {
		return false;
	}else{
	 Unggah()
	}
 }

function TampilkanTabel(){
	var pg = eval(document.getElementById("Halaman").value)-1 ;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-Layer.jsp/",
	data: "Halaman="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};
function AddDataOGC(a,b,c){
	document.getElementById("NAMA").value = a;
	document.getElementById("URL").value= b;
	document.getElementById("LyName").value = c;
	document.getElementById("LyName2").value = a;
}

function TampilkanCSW(){
  var kata = document.getElementById("CARI").value;
   document.getElementById("DataApiCsw").innerHTML ='<img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>';	
	$.ajax({
	url: "<?php echo $nama_folder; ?>/CSW-geoservice/",
	data: "kata="+kata,
	cache: false,
	success: function(msg){
		 document.getElementById("DataApiCsw").innerHTML = msg;
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


function EditData(a,b,c,d,e,f,g,h,i){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-Layer.jsp"
	document.getElementById("NAMA").value = a;
	document.getElementById("URL").value = b;
	document.getElementById("LyName").value = c;
	document.getElementById("MapType").value = d;
	document.getElementById("CboVisible").value = e;
	document.getElementById("LyIndex").value = f;
	document.getElementById("CboLogin").value = g;
	document.getElementById("KDMAP").value = h;
	document.getElementById("LyName2").value = i;		
	document.getElementById("HederJudul").innerHTML = "Edit Layer"
	document.getElementById("CmdSave").innerHTML = "Upadate";
	document.getElementById("CmdCancel").style.display = "inline-block";
}
function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/Layer.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Layer"
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	document.getElementById("CmdCancel").style.display = "none";
    document.getElementById("NAMA").value = "";
	document.getElementById("URL").value = "";
	document.getElementById("LyName").value = "";
	document.getElementById("MapType").value = "OGC";
	document.getElementById("CboVisible").value = "false";
	document.getElementById("LyIndex").value = "";
	document.getElementById("CboLogin").value = "false";
	document.getElementById("KDMAP").value = "";
	document.getElementById("LyName2").value = "";
	document.getElementById("InfoNAMA").innerHTML='';
	document.getElementById("InfoURL").innerHTML='';
	document.getElementById("InfoLyIndex").innerHTML='';
	document.getElementById("InfoLyName").innerHTML='';
}
</script>
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
          LAYER
            <small> default peta tematik  Web GIS</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/WebPortal/WebAdmin/pages/home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa fa-pencil"></i><a href="/WebPortal/WebAdmin/pages/SlideShow.jsp"> Layer</a>
            </li>
            
        </ol>
    </div>
</div>

<!-- ========================================================================================== -->
<div class="col-lg-4 text-left">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 id="HederJudul">Tambahkan Slide</h3>
            </div>
            <div class="panel-body">                               
              <div id="infoSave"></div>
              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/pembina.jsp"> 
                <div class="form-group">
                     <label>Nama Layer</label><span id="InfoNAMA"></span>
                     <input  name="NAMA" id="NAMA" class="form-control" type="text" value="" placeholder="Judul Slide" maxlength="255" />
                </div>
                 <div class="form-group">
                  <label>URL Service</label><span id="InfoURL"></span>
                  <textarea name="URL" class="form-control" id="URL" placeholder="URL Service"></textarea>
                </div>
                <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Layer Param</label><span id="InfoLyName"></span>
                   <div class="col-sm-10">
                  <input  name="LyName" id="LyName" class="form-control" type="text" value="" placeholder="Nama Layer (for OGC)" maxlength="255"  readonly="readonly"/>
                    </div>
                    <div class="col-sm-2" align="left">
                        <button class="btn btn-success" type="button" id="CmdAddCSW" onclick="TampilkanCSW()" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fa fa-search"></i></button>
                    </div> 
                </div>
                <div class="form-group">
                  <label>Layer Native</label><span id="InfoLyName"></span>
                  <input  name="LyName2" type="text" class="form-control" id="LyName2" placeholder="Nama Layer (forom OGC Geoserver)" value="" maxlength="255"  />
                </div>                               
                <div class="form-group">
                <label>Layer Type</label><span id="InfoMapType"></span>
                <select name="MapType" class="form-control" id="MapType" title="Type Map Server">
                  <option value="ESRI">Arcgis Server</option>
                  <option value="OGC">Geoserver</option>
                </select>
                </div>
                <div class="form-group">
                <label>Opsi Startup</label><span id="InfoMapType"></span>
                <select name="CboVisible" class="form-control" id="CboVisible" title="Type Map Server">
                  <option value="true">Tampilkan</option>
                  <option value="false">Sembunyikan</option>
                </select>
                </div>
                <div class="form-group">
                  <label>Layer Index</label><span id="InfoLyIndex"></span>
                  <input  name="LyIndex" id="LyIndex" class="form-control" type="text" value="" placeholder="Nomor Urut Layer" maxlength="255" />
                </div>
                <div class="form-group">
                <label>Mode Akses Layer</label><span id="InfoMapType"></span>
                <select name="CboLogin" class="form-control" id="CboLogin" title="Type Map Server">
                  <option value="true">Harus Login</option>
                  <option value="false">Publik</option>
                </select>
                </div>
                <div class="form-group">
                    <div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
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
<div class="col-lg-8 text-center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Layer</h3>
            </div>
            <div class="panel-body">
               <div id="linkList1" style="overflow:auto; max-height:600px;"></div> 
            </div>
            <div class="panel-footer">
            <div align="right">
                <input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
                <input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
                <input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
            </div>
        </div>
      </div>
</div>
<!-- ========================================================================================== -->         
                      
           
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Data Geosapsial from Geoservice CSW API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
          <div class="row">
           <div class="col-sm-10">                             
            <input name="CARI" id="CARI" class="form-control" type="text" value="" placeholder="Cari dengan Nama Peta"  maxlength="40"  />
            </div>
            <div class="col-sm-2" align="left">
                <button class="btn btn-outline-success" type="button" onclick="TampilkanCSW()" ><i class="fa fa-search"></i></button>
            </div>  
          </div>
          <div id="DataApiCsw" style="max-height:500px; overflow:auto; padding:5px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <!-- /#page-wrapper -->
<script>
    TampilkanTabel();
    PosisiAwal();
</script>
<?php } ?>
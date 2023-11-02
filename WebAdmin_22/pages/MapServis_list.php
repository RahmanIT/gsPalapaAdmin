<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_RstJignServer = "SELECT KD_JDSN, NM_JDSN FROM tb_jdsn";
$RstJignServer = mysqli_query($Congis, $query_RstJignServer) or die(mysqli_error());
$row_RstJignServer = mysqli_fetch_assoc($RstJignServer);
$totalRows_RstJignServer = mysqli_num_rows($RstJignServer);

$query_RstOP = "SELECT KD_USER, NAMA FROM tb_admin ORDER BY KD_USER ASC";
$RstOP = mysqli_query($Congis, $query_RstOP) or die(mysqli_error());
$row_RstOP = mysqli_fetch_assoc($RstOP);
$totalRows_RstOP = mysqli_num_rows($RstOP);
?>
<style>
#ImportSRV{
	position:fixed;
	height:auto;
	display:none;
	min-width:300px;
	max-width:550px;
}
#AddWMS{
	position:fixed;
	height:auto;
	display:none;
	min-width:300px;
	max-width:475px;
}
#hsl{
	max-height:340px;
	overflow:auto;
}
#CmdUpdate{
	display:none;
}
</style>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script src="<?php echo $nama_folder; ?>/App/js/DragMoveDIV.js"></script>
<script>
function SimpanWMS(){ 			  
	var d= "SrvID"+ document.getElementById("TxtIdWMS").value
	$("#preview").html();
			  
	 $("#FmWMS").ajaxForm({target: '#preview', 
	  beforeSubmit:function(){ 
					
	  console.log('ttest');
	  $("#LoadingUp").show();
   }, 
					 
	success:function(){ 
	console.log('test');
	document.getElementById(d).className = "btn btn-success";
	document.getElementById(d).innerHTML = "Terimpan";
	//alert('Tersimpan');
	//TampilkanTabel();
	$("#LoadingUp").hide();
	}, 
	error:function(){ 
	console.log('xtest');
	TampilkanTabel()
	$("#LoadingUp").hide();
	} }).submit();
 };


function TampilkanMapService(){
      pg = document.getElementById("CboServer").value;
	  document.getElementById("hsl").innerHTML="";
	  $("#Loading2").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/MapServisJIGN_Lacak.jsp/",
	data: "Srv="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("hsl").innerHTML = msg;
		$("#Loading2").hide();
		}
	});	
};

function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
  var cari = document.getElementById("Cari").value
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelMapServisJIGN.jsp/",
	data: "Halaman="+pg+"&cari="+cari,
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

function TransferData(i,n,t,u,j,o){
 document.getElementById("NmWMS").value = n;
 document.getElementById("CboType").value = t;
 document.getElementById("UrlWMS").value= u;
 document.getElementById("JIGN").value = j;
 document.getElementById("WaliData").value = o;
 document.getElementById("TxtIdWMS").value = i;
 SimpanWMS();
}
function TransferDataOGC(i,nmobj,url,type,jign,wld,ntlyr,minx,miny,maxx,maxy,srsid,styl,schema){
 document.getElementById("NmWMS").value = nmobj;
 document.getElementById("CboType").value = type;
 document.getElementById("UrlWMS").value= url;
 document.getElementById("JIGN").value = jign;
 document.getElementById("WaliData").value = wld;
 document.getElementById("TxtIdWMS").value = i;
 document.getElementById("NtvLayer").value = ntlyr;
 document.getElementById("SRSID").value = srsid;
 document.getElementById("MINX").value = minx;
 document.getElementById("MINY").value = miny;
 document.getElementById("MAXX").value = maxx;
 document.getElementById("MAXY").value = maxy;
 document.getElementById("LYSTYLE").value = styl;
 document.getElementById("SCHEMA").value = schema;
 SimpanWMS();
}
function ShowImportSRV(){
  var winW = window.innerWidth;
  //document.getElementById("ImportSRV").style.left = (winW/2) - (400 * .4)+"px";
  document.getElementById("ImportSRV").style.right = 20+"px";
  document.getElementById("ImportSRV").style.top = "50px";
  document.getElementById("ImportSRV").style.display= "inherit";
    document.getElementById("f1").style.display='inline';
  document.getElementById("f2").style.display='inline';
  document.getElementById("f3").style.display='inline';
  document.getElementById("CmdUpdate").style.display='none';
  document.getElementById("CmdSimpan").style.display='inline';
}

function ShowFromWMS(){
  var winW = window.innerWidth;
  //document.getElementById("AddWMS").style.left = (winW/2) - (300 * .3)+"px";
  document.getElementById("AddWMS").style.left = "300px"
  document.getElementById("AddWMS").style.top = "100px";
  document.getElementById("AddWMS").style.display= "inherit";
  document.getElementById("CmdUpdateWMS").style.display='none';
  document.getElementById("CmdSimpanWMS").style.display='inline';
}

function CloseImport(){
  document.getElementById("ImportSRV").style.display='none';
  TampilkanTabel();
  
}

	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>


<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Data WMS <small>daftar map servis  server Kemeterian/Lembaga/Pemda</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="<?php echo $nama_folder; ?>/WebAdminServerMapService.jsp">GeoServer</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
 
                 <!------------------------------------------->
                <div class="col-lg-4 text-left">
				<button type="button" class="btn btn-success" onClick="ShowFromWMS()"> Tambah Data <i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-success" onClick="ShowImportSRV()"> Import  <i class="fa fa-download"></i></button><br/><br/>
                </div>
                <!--============================================================================ -->
                <div class="col-lg-12 text-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Kelola Map Servis JIGN</h3>
                        </div>
                        <div class="panel-body">                           
                            <div class="col-lg-3"> 
                              <div class="form-group input-group">
                                    <input name="CARI" id="Cari" type="text" class="form-control" placeholder="Cari Peta">
                                    <span class="input-group-btn"><button class="btn btn-primary" onclick="TampilkanTabel()" type="button"><i class="fa fa-search"></i></button></span>
                               </div>
                            </div>  
                            <!----------- BOX TENGAH loadng-->
                            <div class="col-lg-4" align="center"> 
                              <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                            </div> 
                            <!---------- Box Atas Kanan Navigasi Halaman----------------------------> 
                            <div class="col-lg-4" align="right"> 
                              <input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              					<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              					<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
                            
                            </div>
                            <!-------------- Awal Box 12 ----------------->
                            <div class="col-lg-12" id="linkList1"></div>
                            <!--------------- Akhir Box 12----------------->
                        </div>
                        <div class="panel-footer">
                            --
                            </div>
                    </div>
                </div>                                           
</div>
  <!-- /#page-wrapper -->
<p>&nbsp;</p>
<!--=====================  FROM ADD MAP SERVIS ===============================-->
<!-- Awal Panel transfer data shp ke server geoserver-->
<form action="<?php echo $nama_folder; ?>/SimpanMapServisJIGN.jsp" method="post" enctype="multipart/form-data" name="FmWMS" id="FmWMS">
<div id="AddWMS" class="panel panel-primary" style="z-index:6;">
   <div class="panel-heading" id="AddWMSheader" >
      <h3 class="panel-title">Add WMS</h3>
   </div>
   <div class="panel-body">
        <div class="col-lg-7">
             <label>Nama WMS</label>
             <input name="NmWMS" class="form-control" type="text" id="NmWMS" />
        </div>
        <div class="col-lg-5">
          <label>Type WMS</label>
            <select name="CboType" id="CboType" class="form-control" >
              <option value="Dynamic">Dynamic (MapServer)</option>
              <option value="WMS">GeoRSSLayer(WMS)</option>
              <option value="Feature">Feature Layer</option>
              <option value="KML">GoogleMap (KML)</option>
              <option value="ImageServer">ImageServer</option>
              <option value="FeatureServer">FeatureServer</option>
              <option value="GPServer">GPServer</option>
              <option value="OGC">Geoserver (WMS)</option>
            </select>
       </div>

   <div  class="col-lg-12">
        <label>URL WMS</label>
        <input name="UrlWMS" class="form-control" type="text" id="UrlWMS" />
   </div> 
   <div  class="col-lg-6">
     <label>JIGN Server</label>
     <select name="JIGN" class="form-control" id="JIGN" title="JIGN Server">
       <?php
            do {  
            ?>
       <option value="<?php echo $row_RstJignServer['KD_JDSN']?>"><?php echo $row_RstJignServer['NM_JDSN']?></option>
       <?php
    } while ($row_RstJignServer = mysqli_fetch_assoc($RstJignServer));
      $rows = mysqli_num_rows($RstJignServer);
      if($rows > 0) {
          mysqli_data_seek($RstJignServer, 0);
          $row_RstJignServer = mysqli_fetch_assoc($RstJignServer);
      }
    ?>
     </select>
   </div>
   <div  class="col-lg-6">
     <label>Wali Data</label>
     <select name="WaliData" class="form-control" id="WaliData" >
       <option value="0">Luar SKPD Init KlirIng</option>
       <?php do { ?>
       <option value="<?php echo $row_RstOP['KD_USER']?>"><?php echo $row_RstOP['NAMA']?></option>
       <?php
        } while ($row_RstOP = mysqli_fetch_assoc($RstOP));
          $rows = mysqli_num_rows($RstOP);
          if($rows > 0) {
              mysqli_data_seek($RstOP, 0);
              $row_RstOP = mysqli_fetch_assoc($RstOP);
          }
        ?>
     </select>
   </div> 
   <div  class="col-lg-8">
        <label>Native Layer</label>
        <input name="NtvLayer" class="form-control" type="text" id="NtvLayer" />
   </div> 
   <div  class="col-lg-4">
        <label>SRSID</label>
        <input name="SRSID" class="form-control" type="text" id="SRSID" />
   </div> 
   <div  class="col-lg-3">
        <label>Min X</label>
        <input name="MINX" class="form-control" type="text" id="MINX" />
   </div> 
   <div  class="col-lg-3">
        <label>Min Y</label>
        <input name="MINY" class="form-control" type="text" id="MINY" />
   </div> 
   <div  class="col-lg-3">
        <label>Max X</label>
        <input name="MAXX" class="form-control" type="text" id="MAXX" />
   </div> 
   <div  class="col-lg-3">
        <label>Max Y</label>
        <input name="MAXY" class="form-control" type="text" id="MAXY" />
   </div>   
 </div>
   <div align="right" class="panel-footer">
         <img id="LoadingUp" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Loading..." />
         <button type="button" onClick="document.getElementById('AddWMS').style.display='none'" class="btn btn-warning">Close</button>
         <button type="button" id="CmdSimpanWMS" onClick="SimpanWMS()" class="btn btn-success">Simpan</button>
         <button type="button" id="CmdUpdateWMS" onClick="EditWMS()" class="btn btn-primary">Update</button>
         <input name="TxtIdWMS" id="TxtIdWMS" type="hidden" value="" />
         <input name="LYSTYLE" id="LYSTYLE" type="hidden" value="" />
         <input name="SCHEMA" id="SCHEMA" type="hidden" value="" />
   </div>               
</div><!--end div panel -->
</form>
<!--======================================================================--> 

<!--=====================  FROM IHDEN SHOW ===============================-->
<!-- Awal Panel transfer data shp ke server geoserver-->
<div id="ImportSRV" class="panel panel-primary">
   <div class="panel-heading" id="ImportSRVheader">
      <h3 class="panel-title">Impot Map Servis dari JIGN Server</h3>
   </div>
   <div class="panel-body" id="PsnTransfer">
     <div class="form-group">
           <label>JIGN Server</label>
            <select name="CboServer" id="CboServer" onchange="TampilkanMapService()" class="form-control">
              <option value="none">Semua Data</option>
              <?php do { ?>
              <option value="<?php echo $row_RstJignServer['KD_JDSN']?>"><?php echo $row_RstJignServer['NM_JDSN']?></option>
              <?php
                } while ($row_RstJignServer = mysqli_fetch_assoc($RstJignServer));
                  $rows = mysqli_num_rows($RstJignServer);
                  if($rows > 0) {
                      mysqli_data_seek($RstJignServer, 0);
                      $row_RstJignServer = mysqli_fetch_assoc($RstJignServer);
                  }
                ?>
            </select>
   </div>
   <div  class="form-group">
        <img id="Loading2" style="display:none;" src="<?php echo $nama_folder; ?>/images/loading1.gif" width="100" height="100" alt="Loading..." />
        <div id="hsl"></div>
   </div>          
 </div>
   <div align="right" class="panel-footer">
         <img id="LoadingUp" align="middle" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Loading..." />
         <button type="button" onClick="CloseImport()" class="btn btn-warning">Close</button>
         <input name="TxtIdSHP" id="TxtIdSHP" type="hidden" value="" />
         <div id="preview"></div>
   </div>             
</div><!--end div panel -->
<!--======================================================================-->

<script>
dragElement(document.getElementById("AddWMS"));
dragElement(document.getElementById("ImportSRV"));
TampilkanTabel();
</script>
<?php
mysqli_free_result($RstOP);
mysqli_free_result($RstJignServer);
 } ?>
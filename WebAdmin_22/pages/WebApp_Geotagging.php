<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
              GPS WEB APP
                <small>Geotagging Data Aplikasi Web Geospasial External</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-globe"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/GeoTagging.jsp">WEB-APP</a>
                </li>
                <li class="active">
                    <i class="fa fa-pencil"></i> Daftar APP
                </li>
            </ol>
        </div>
    </div>
   <!-- ========================================================================================== -->
   <?php 
   if($P[0]["ROLE"]==3){
       $quetFt= " AND KD_USER=".GetSQLValueString($Congis,$P[0]["KD_USER"],"int");
    }
     if($P[0]["ROLE"]==2){
       $quetFt= "";
    }
    $query_RsApp = "SELECT KD_MODEL, NM_MODEL FROM tb_modelling WHERE PAGE_SOURCE='GisWebApp' $quetFt ORDER BY KD_MODEL DESC";
    $RsApp = mysqli_query($Congis, $query_RsApp) or die(mysqli_error());
    $row_RsApp = mysqli_fetch_assoc($RsApp);
    $totalRows_RsApp = mysqli_num_rows($RsApp);
   ?>
  <div class="col-lg-4 text-left">
            <div class="panel panel-primary">
                <div class="panel-heading">
                     <h3 id="HederJudul">Manajeman GPS</h3>
                    <div id="infoSave"></div>
                </div>
                    <div class="panel-body">                              
                      <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/ApplayCOnfigTabelGPS.jsp"> 
                        <div class="form-group">
                        <label>Nama App</label>
                        <select name="CboAp" class="form-control" id="CboAp" onchange="GetDataApp()">
                             <option value="0">-----Pilih Web BGIS-----</option>
                          <?php do { ?>
                                <option value="<?php echo $row_RsApp['KD_MODEL']?>"><?php echo $row_RsApp['NM_MODEL']?></option>
                                 <?php
                                } while ($row_RsApp = mysqli_fetch_assoc($RsApp));
                                  $rows = mysqli_num_rows($RsApp);
                                  if($rows > 0) {
                                      mysqli_data_seek($RsApp, 0);
                                      $row_RsApp = mysqli_fetch_assoc($RsApp);
                                  }
                                ?>
                        </select>
                     </div>                             
                     <div class="form-group mx-sm-3 mb-2">
                     <label>Nama Tabel</label><span id="InfoNama"></span>
                     <input  name="NAMA_TB" id="NAMA_TB"  class="form-control" type="text" value="" placeholder="Nama Tabel" maxlength="40" />                         
                     </div>	
                     <div class="form-group" align="right">
                         <div class="input-group-append">
                                <button class="btn btn-success" id="CdmBuatTabel" type="button"><i class="fa fa-table" aria-hidden="true"></i> Buat Tabel</button>
                          </div>
                      </div>	
                      <div class="form-group" id="InfoProcess"> </div>
                      <div class="form-group" id="Deskripsi"></div>	
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input custom-switch" id="customSwitch1" name="customSwitch1">
                          <label class="custom-control-label" for="customSwitch1"><i class="fa fa-location-arrow" aria-hidden="true"></i> Aktifkan Sistem GPS</label>
                        </div>
                     </div>                                       
                     <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
                    <div class="box-footer" align="right">
                        <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
                        <button type="button" id="CmdSave" onClick="VerifikasiData()" class="btn btn-lg btn-primary">Apply</button>
                    </div>                                                    
                  </form>
                  <p>&nbsp;</p>
                </div>
          </div>
   </div>
<!-- ========================================================================================== -->         
  <div class="col-lg-8 text-center">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Data Geotagging</h3>
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
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function GetDataApp(){
	$("#loding").show();
	var n = document.getElementById("CboAp").value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/GetDataAppID.jsp/",
	type: "POST",
	data: {kode:n},
	cache: false,
	success: function(msg){
		console.log(msg);
		if(msg["NM_TABEL"] == null){
		   document.getElementById("CdmBuatTabel").style.display = 'inline';
		   $('#NAMA_TB').val(msg["PAGE_NAME"]+'_GPS_PT_25K');
		}else{
			$('#NAMA_TB').val(msg["NM_TABEL"]);
		   document.getElementById("CdmBuatTabel").style.display = 'none';
		}
		if(msg["GPS_MODE"] == 'on'){
			document.getElementById('customSwitch1').checked = true;
		}else{
		 	document.getElementById('customSwitch1').checked = false;
		}
		$('#Deskripsi').html(msg["KETERANGAN"]);
		$("#loding").hide();
		}
	});
};

document.getElementById("CdmBuatTabel").onclick = function(){
    $("#loding").show();
	var n = document.getElementById("NAMA_TB").value;
	$.ajax({
	url: "<?php echo $nama_folder; ?>/BuatTabelGPS.jsp/",
	type: "POST",
	data: {tabelname:n},
	cache: false,
	success: function(msg){
		$('#InfoProcess').html(msg);
		$("#loding").hide();
		}
	});
};

function Unggah(){ 			  
   //$("#preview").html();
   $("#form1").ajaxForm({target: '#linkList1', 
	 beforeSubmit:function(){ 
		$("#imageloadstatus").show();
	 	$("#imageloadbutton").hide();
	 }, 
	success:function(){ 
	console.log('selesai');
	 	//TampilkanTabel();
	 	$("#imageloadstatus").hide();
	 	$("#imageloadbutton").show();
	 	PosisiAwal();
	}, 
	error:function(){ 
	console.log('error');
	 	$("#imageloadstatus").hide();
		$("#imageloadbutton").show();
	} }).submit();
 };
 
function VerifikasiData(){
   var pesan = '';		
	if (document.getElementById("NAMA_TB").value== '') {
		pesan = '0';
		document.getElementById("InfoNama").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
	}else{ document.getElementById("InfoNama").innerHTML='' }
	
	 if (pesan != '') {
		return false;
	}else{
	 Unggah()
	}
};

function PosisiAwal(){
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	//document.getElementById("CmdCancel").style.display = "none";
	document.getElementById("NAMA_TB").value = "";
	document.getElementById("InfoProcess").innerHTML = "";
	document.getElementById("Deskripsi").innerHTML = "";	
}

document.getElementById("AppGIs01").className = "active";
document.getElementById("AppGIs").className = "collapse in";
</script>

<?php } ?>
<?php
mysqli_select_db($Congis, $database_Congis);
$query_RstPeta = "SELECT tb_jdsn.KETERANGAN, tb_jdsn.WEB_JIGN, tb_peta.*  FROM tb_peta INNER JOIN tb_jdsn ON tb_peta.KD_JDSN = tb_jdsn.KD_JDSN WHERE tb_peta.KD_PETA = $segmen4";
$RstPeta = mysqli_query($Congis, $query_RstPeta) or die(mysqli_error());
$row_RstPeta = mysqli_fetch_assoc($RstPeta);
$totalRows_RstPeta = mysqli_num_rows($RstPeta);
$kdUser = $row_RstPeta['KD_USER'];
$query_RstWaliData = "SELECT * FROM tb_admin WHERE KD_USER = '$kdUser'";
$RstWaliData = mysqli_query($Congis, $query_RstWaliData) or die(mysqli_error());
$row_RstWaliData = mysqli_fetch_assoc($RstWaliData);
$totalRows_RstWaliData = mysqli_num_rows($RstWaliData);
?>

<style>
/* FILE FORM*/
#dlOverlyFiles{
	display: none;
	opacity: .3;
	position: fixed;
	top: 0px;
	left: 0px;
	background:#666666;
	width: 100%;
	z-index: 10;
}
#FrmFileUp{
	display: none;
	position: fixed;
	background:#6C9DE6;
	border-radius:7px; 
	width:360px;
	z-index: 10;
}
#FrmFileUp > div{ background:#FFF; margin:8px; }
#FrmFileUp > div > #FilesUpHedingBox{ background:#3892BC; font-size:19px; padding:10px; color:#FFF; }
#FrmFileUp > div > #FilesBody{ background:#FFF; padding:20px; color:#000; }
#FrmFileUp > div > #FilesUpBawah{ background:#333; padding:10px; text-align:right; }

.BoxFrom{
	display:block;
	color:#000000;
	padding:3px;
	margin:5px;
	border-radius:3px;
}
.tagn{
	cursor:pointer;
}
</style>
<script>
function ShowForm(f){
		var winW = window.innerWidth;
	    var winH = window.innerHeight;
		var dialogoverlay = document.getElementById('dlOverlyFiles');
	    var dialogbox = document.getElementById('FrmFileUp');
		document.getElementById("Formulir").style.display = "block"
		document.getElementById("Hasil").innerHTML="";
		dialogoverlay.style.display = "block";
	    dialogoverlay.style.height = winH+"px";
		dialogbox.style.left = (winW/2) - (360 * .5)+"px";
	    dialogbox.style.top = "150px";
	    dialogbox.style.display = "block";
		document.getElementById('FilesUpHedingBox').innerHTML = f+"<img src='<?php echo $nama_folder; ?>/images/cancel.png' onClick='CloseFrmFileUp()' style='float:right;' width='24' height='24' alt='CLose'>";
	}
function CloseFrmFileUp(){
		document.getElementById('FrmFileUp').style.display = "none";
		document.getElementById('dlOverlyFiles').style.display = "none";
}
function AmbilKode(k,s){
 document.getElementById("KODE_FILE").value = k;
 ShowForm(s);
}

function VerifPermohonan(){
var x = document.getElementById("EMAIL_USER").value;
   var pesan = '';		
        if (document.getElementById("NAMA_USER").value== '') {
            pesan = '0';
			document.getElementById("VerfNama").innerHTML= "<font color='#FF0000'><b> Nama harus diisi</b></font>";
        }else{ document.getElementById("VerfNama").innerHTML='' }
		
		if (document.getElementById("EMAIL_USER").value == '') {
			pesan = '0';
			document.getElementById("VerfEmail").innerHTML= "<font color='#FF0000'><b> Email harus diisi</b></font>";
        }else{ document.getElementById("VerfEmail").innerHTML='';
			var atpos = x.indexOf("@");
        	var dotpos = x.lastIndexOf(".");
           if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		   		document.getElementById("VerfEmail").innerHTML= "<font color='#FF0000'><b>Format Emali Salah</b></font>";
		   		pesan += 'error';
		   		return false;
          		}else{ document.getElementById("infoEmail").innerHTML='' }
		}
		if (document.getElementById("INSTANSI").value== '') {
            pesan = '0';
			document.getElementById("VerfInstansi").innerHTML= "<font color='#FF0000'><b> Nama instansi harus diisi.</b></font>";
        }else{ document.getElementById("VerfInstansi").innerHTML='' }
		
		if (document.getElementById("KEPERLUAN").value== '') {
            pesan = '0';
			document.getElementById("VerfKeperluan").innerHTML= "<font color='#FF0000'><b> Kenapa anda perlu peta ini ?</b></font>";
        }else{ document.getElementById("VerfKeperluan").innerHTML='' }
		
		if (document.getElementById("FileUpload").value== '') {
            pesan = '0';
			document.getElementById("VerfLampiran").innerHTML= "<font color='#FF0000'><b> Lampirkan Suarat Permohonan</b></font>";
        }else{ document.getElementById("VerfLampiran").innerHTML='' }
		
		 if (pesan != '') {
			 document.getElementById("CkOke").checked = false;
			 $("#CmdKirim").hide();
             return false;
        }else{
		   $("#CmdKirim").show(); 
		}
 }
 

function KirimPermohonan(){		  			  
	$("#form1").ajaxForm({target: '#InfoDownload', 
	beforeSubmit:function(){ 
					
	console.log('ttest');
	$("#LoadingP").show();
	$("#CmdKirim").hide();
	}, 
	success:function(){ 
	console.log('test');
	document.getElementById("FrmSyarat").style.display = "none";
	document.getElementById("InfoDownload").innerHTML = '<div class="alert alert-success"><strong>Success! </strong> Permintaan anda akan kami proses dalam jangka waktu 3 hari kerja.<br/> Untuk melihat tracking permohonan kunjungi link  <a href="<?php echo $nama_folder; ?>/Pemohon.html" target="_blank"><b>Status Permohonan Peta</b></a></div>'; 
	$("#LoadingP").hide();
	$("#CmdKirim").show();
	ClearTextBox()
	}, 
	error:function(){ 
	console.log('xtest');
	$("#LoadingP").hide();
	$("#CmdKirim").show();
	} }).submit();
 };

</script>
<div id="dlOverlyFiles" ondblclick="CloseFrmFileUp()"></div>
<div id="FrmFileUp">
  <div>
    <div id="FilesUpHedingBox"></div>
     <div id="FilesBody">
       <img id="imageloadstatus" src="<?php echo $nama_folder; ?>/images/loading1.gif" style="display:none;" width="100" height="100" alt="Loading...">  
       <form action="<?php echo $nama_folder."file:///D|/06 PROJECT/LOCALHOST_7/Download-Peta.jsp"; ?>" id="FrmDownload"  method="post">
       <div id="Formulir">
         	<b>Silahkan Isi Data Berikut </b><br/>
        	<span id="infoNama"></span>
         	<input name="NAMA" id="NAMA" class="BoxFrom" placeholder="Masukkan Nama Anda" type="text" size="38" maxlength="45">
        	<span id="infoEmail"></span>
        	<input name="EMAIL" id="EMAIL" class="BoxFrom" placeholder="Email valid anda..." type="text" size="38" maxlength="100">
            <select name="JnsPengguna" id="JnsPengguna" class="BoxFrom" onchange="CekValueP()">
              <option value="1">Masyaraka/Umum</option>
              <option value="2">Akademik</option>
              <option value="3">Kemeterian/Lembaga/Pemda</option>
            </select>
            <span id="infoKET"></span>
            <input name="KET" style="display:none" id="KET" class="BoxFrom" placeholder="Nama Instansi/K/L/Institusi/Universitas" type="text" value="Masyarakat" size="38" maxlength="45">
          
        </div>
       		<input type="hidden" name="KODE_FILE" id="KODE_FILE" value="">
			<input type="hidden" name="NM_FILE" id="NM_FILE" value="<?php echo $row_RstPeta['NAMA']; ?>">
			<input type="hidden" name="PATH_FILE" id="PATH_FILE" value="">
			<input type="hidden" name="EXT_FILE" id="EXT_FILE" value="">
			<input type="hidden" name="MM_insert" value="frmDownloadPeta">
		</form>
        <span id="Hasil"></span>
    </div>
   		<div id="FilesUpBawah"><input name="Button" id="imageloadbutton" type="button" class="btn btn-theme" onClick="VerifikasiData()" value="Download"></div>
   </div> 
</div>



<h2><?php echo $row_RstPeta['NAMA']; ?></h2>
<div class="row">
	<div class="col-lg-4">
		<img src="<?php echo $nama_folder; ?>/images/peta/300x250_<?php echo $row_RstPeta['../../library/pages/IMAGE']; ?>" style="border:#0066FF solid 1px;" alt="">
	</div>
    <div class="col-lg-6">
      <small>
      <?php 
	  	$dateA = date_create($row_RstPeta['TANGGAL']);
		$dateB = date_create($row_RstPeta['TGL_MODIF']);
		$namaBulan = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
	  	$bln1 = date_format($dateA, 'n');
		$thn1 = date_format($dateA, 'Y');
		$bln2 = date_format($dateB, 'n');
		$thn2 = date_format($dateB, 'Y');
	  ?>
      <dl class="dl-horizontal">
      	<dt>Tanggal Dibuat: </dt><dd><?php echo $namaBulan[$bln1].", ".$thn1; ?></dd>
      	<dt>Dibuat :</dt><dd><?php echo $row_RstPeta['PEMBUAT']; ?></dd>
      	<dt>Terkahir Update : </dt><dd><?php echo $namaBulan[$bln2].", ".$thn2; ?></dd>
        <dt>Sumber Data : </dt><dd><?php echo $row_RstPeta['SMB_DATA']; ?></dd>
        <dt>Contek Person : </dt><dd><?php echo $row_RstWaliData['NM_OP']; ?></dd>
        <dt>Alamat Kantor : </dt><dd><?php echo $row_RstWaliData['ADDR_KANTOR']; ?></dd>
        <dt>Telpon : </dt><dd><?php echo $row_RstWaliData['TELPON']; ?></dd>
        
      </dl>
      </small>
    </div>
</div>
<br/>
<div class="row">
	<a href="<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>?f=lyr&amp;v=9.3" class="btn btn-theme"><i class="fa fa-download"></i> MapService </a>
	<a href="<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>/kml/mapImage.kmz" class="btn btn-theme"><i class="fa fa-map-marker"></i> KML </a>
	<a href="<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>/WMSServer?request=GetCapabilities&amp;service=WMS" class="btn btn-theme"><i class="fa fa-download"></i> WMS </a>
	<a href="<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>/info/metadata" class="btn btn-theme"><i class="fa fa-code"></i> XML</a>
	<!--<a href="<?php echo "http://www.arcgis.com/home/webmap/viewer.html?url=" ?><?php echo $row_RstPeta['MAP_SERVER']; ?>&source=sd" class="btn btn-theme"><i class="fa fa-globe"></i> Esri Map </a>-->
</div>
<dt>Export and View</dt>
<br/>
	<a href="<?php echo $nama_folder; ?>/ExportMapService/<?php echo $segmen4 ?>" target="_blank" class="btn btn-primary"><i class="fa fa-share"></i> Export To Image </a>
	<a href="<?php echo $nama_folder; ?>/GeoVista/?AddMap=<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-map-marker"></i> View In Geovista </a>

<hr>
<dt>Download Peta Kartografi</dt>
  <dd><br/>
      <span id="InfoDownload" ondblclick="ClearWarning()"></span>
      
     <!---------------BATAS AWAL FROM -----------------------> 
      <div id="FrmSyarat" style="display:none" class="row">
      <ul>
        <li>Isikan biodata sesuai formulir berikut</li>
        <li>Lampirkan surat permohonan (Memilki kop suat, tanggal, bertandatangan [<i>polpen biru</i>])</li>
        <li>Permohonan akan di peroses selama 3 hari kerja</li>
        <li>Peta akan kami emailkan ke alamat yang anda isikan di kolom EMAIL</li>
      </ul>
      <form id="form1" name="form1" method="post"  action="<?php echo $nama_folder; ?>/Permohonan-Peta.jsp">
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
  			<tr>
    			<td width="20%" align="right" valign="middle"><em><strong>Nama : </strong></em></td>
    			<td width="80%"><span id="VerfNama"></span><input name="NAMA_USER" id="NAMA_USER" class="BoxFrom" placeholder="Masukkan Nama Anda" type="text" size="38" maxlength="45"></td>
 		   	</tr>
  			<tr>
   				 <td align="right" valign="middle"><em><strong> Email : </strong></em></td>
    			 <td><span id="VerfEmail"></span><input name="EMAIL_USER" id="EMAIL_USER" class="BoxFrom" placeholder="Email valid anda..." type="text" size="38" maxlength="100"></td>
 			</tr>
  			<tr>
    			<td align="right" valign="middle"><em><strong>Pengguna : </strong></em></td>
    			<td>
    				<select name="Pengguna" id="Pengguna" class="BoxFrom" onchange="CekValueS()">
              			<option value="1">Masyaraka/Umum</option>
              			<option value="2">Akademik</option>
              			<option value="3">Kemeterian/Lembaga/Pemda</option>
      				</select>
    			</td>
  			</tr>
 		 <tr >
    		<td align="right" valign="middle"><em id="LbInstansi" style="display:none"><strong>Instansi :</strong></em></td>
    		<td>
    			<span id="VerfInstansi"></span>
    			<input name="INSTANSI" id="INSTANSI" style="display:none" class="BoxFrom" placeholder="Nama Instansi/K/L/Institusi/Universitas" type="text" value="Masyarakat" size="38" maxlength="255">
    		</td>
  		</tr> 
  		<tr>
    		<td align="right" valign="middle"><em><strong>Keperluan :</strong></em></td>
    		<td><span id="VerfKeperluan"></span><input name="KEPERLUAN" id="KEPERLUAN" class="BoxFrom" placeholder="Kenapa anda perlu peta ini...?" type="text" size="38" maxlength="100"></td>
  		</tr>
  		<tr>
    		<td align="right" valign="middle"><em><strong>Lampiran :</strong></em></td>
    		<td>
    			<span id="VerfLampiran"></span>
    			<input type="file" name="FileUpload" id="FileUpload" class="BoxFrom" /></td>
  		</tr>
  		<tr>
    		<td align="left" valign="middle">&nbsp;</td>
    		<td align="left" valign="middle">
    			<input name="CkOke" type="checkbox" id="CkOke" onchange="VerifPermohonan()" />
      			<label for="CkOke">Saya menyetujui sesuai ketentuan undang-undang yang berlaku </label>
    		</td>
    	</tr>
  		<tr>
    		<td align="left" valign="middle">&nbsp;</td>
    		<td align="left" valign="middle">
    			<img id="LoadingP" src="<?php echo $nama_folder; ?>/images/loader.gif" style="display:none;" width="220" height="19" alt="Loading..." />
    			<button type="button"  id="CmdKirim" class="btn btn-warning" style="display:none;" onclick="KirimPermohonan()" value=""><i class="fa fa-check"></i> Kirim Permohonan</button>
    		</td>
 		 </tr>
	</table>
		<input type="hidden" name="KODE_FILE1" id="KODE_FILE1" value="<?php echo $row_RstPeta['KD_PETA']; ?>">
		<input type="hidden" name="NM_FILE1" id="NM_FILE1" value="<?php echo $row_RstPeta['NAMA']; ?>">
		<input type="hidden" name="EXT_FILE1" id="EXT_FILE1" value="">
		<input type="hidden" name="MM_Pemohon" value="DownloadPeta">
	</form>
	</div>
	<!---------------BATAS AKHIR FROM ----------------------->
  	<div class="row">
  	<a onclick="Download('<?php echo $row_RstPeta['R_JPG']; ?>','<?php echo $row_RstPeta['JPG']; ?>','jpg')" class="btn btn-success"><i class="fa fa-picture-o"></i> Peta JPG </a>
	<a onclick="Download('<?php echo $row_RstPeta['R_PDF']; ?>','<?php echo $row_RstPeta['PDF']; ?>','pdf')" class="btn btn-success"><i class="fa fa-file"></i> Peta PDF </a>
    <a onclick="Download('<?php echo $row_RstPeta['R_PNG']; ?>','<?php echo $row_RstPeta['PDF']; ?>','png')" class="btn btn-success"><i class="fa fa-picture-o"></i> Peta PNG </a>
    </div>
  </dd>
<hr>
<dl>
	<dt>Ringkasan </dt>
		<dd><?php echo $row_RstPeta['SUMMARY']; ?> .</dd>
       <hr>
    <dt>Abstrak </dt>
		<dd><?php echo $row_RstPeta['ABSTRAK']; ?></dd>
 <hr>
	<dt>Map Server</dt>
		<dd><a href="<?php echo $row_RstPeta['../../library/pages/WEB_JIGN']; ?>" target="_blank"><?php echo $row_RstPeta['KETERANGAN']; ?></a></dd>
    <dt>Map Service</dt>
        <dd><a href="<?php echo $row_RstPeta['../../library/pages/MAP_SERVER']; ?>" target="_blank"><?php echo $row_RstPeta['MAP_SERVER']; ?></a></dd>
	<hr>	
    <dt>Propertis</dt>
    	<dd>Georeferen : <?php echo $row_RstPeta['GEO_REFERENCE']; ?> </dd>
		<dd>Bujur Barat : <?php echo $row_RstPeta['BB']; ?> </dd>
        <dd>Bujur Timur : <?php echo $row_RstPeta['BT']; ?> </dd>
        <dd>Lintang Utara : <?php echo $row_RstPeta['LU']; ?> </dd>
        <dd>Lintang Selatan : <?php echo $row_RstPeta['LS']; ?> </dd>
	</dl>
<hr>


<?php
mysqli_free_result($RstPeta);

mysqli_free_result($RstWaliData);
?>
<script>
function KirimData(){
	$("#Formulir").hide()		  			  
	$("#FrmDownload").ajaxForm({target: '#Hasil', 
	beforeSubmit:function(){ 
					
	console.log('ttest');
	$("#imageloadstatus").show();
	$("#imageloadbutton").hide();
	}, 
	success:function(){ 
	console.log('test');
	document.getElementById("Formulir").style.display = "none"
	$("#imageloadstatus").hide();
	$("#imageloadbutton").show();
	ClearTextBox()
	}, 
	error:function(){ 
	console.log('xtest');
	$("#imageloadstatus").hide();
	$("#imageloadbutton").show();
	} }).submit();
 };
 
function Download(f,u,e){
	ClearWarning();
	if (f=='-'){
	  	$("#PATH_FILE").val("");
	  	$("#FrmSyarat").hide();	
	  	$("#InfoDownload").html('<div class="alert alert-warning"><strong>Peringantan ! </strong> format peta yang anda inginkan tidak tersedia .</div>');
	} else if(f=='x') {
	  	$("#PATH_FILE1").val(u);
	  	$("#EXT_FILE1").val(e);
	  	$("#FrmSyarat").show();
	  	$("#InfoDownload").html('<div class="alert alert-danger"><strong>Peta Bersyarat!</strong> Ajukan surat permohonan permintaan peta kepada wali data, untuk mendapatkan peta ini.</div>');
	} else {
	 	$("#PATH_FILE").val(u);
		$("#EXT_FILE").val(e);
		$("#FrmSyarat").hide();
	    AmbilKode(<?php echo $row_RstPeta['KD_PETA']; ?>,'<?php echo $row_RstPeta['NAMA']; ?>');
	    $("#InfoDownload").html('<div class="alert alert-info"><strong>Peta Tersedia!</strong> Silahkan isikan data pada formulir untuk mendownload peta.</div>');
	}
}

function ClearWarning(){
	$("#InfoDownload").html('');
	}

function CekValueP(){
  if(document.getElementById("JnsPengguna").value=='1'){
	 document.getElementById("KET").style.display = "none";
	 document.getElementById("KET").value = "Masyarakat";
 }else{
	document.getElementById("KET").style.display = "block";
	document.getElementById("KET").value = "";
  }
}
function CekValueS(){
  if(document.getElementById("Pengguna").value=='1'){
	 document.getElementById("INSTANSI").style.display = "none";
	 document.getElementById("LbInstansi").style.display = "none";
	 document.getElementById("INSTANSI").value = "Masyarakat";
 }else{
	document.getElementById("INSTANSI").style.display = "block";
	document.getElementById("LbInstansi").style.display = "block";
	document.getElementById("INSTANSI").value = "";
  }
}


function VerifikasiData(){
var x = document.getElementById("EMAIL").value;
   var pesan = '';		
        if (document.getElementById("NAMA").value== '') {
            pesan = '0';
			document.getElementById("infoNama").innerHTML= "<font color='#FF0000'><b> (Nama harus diisi)</b></font>";
        }else{ document.getElementById("infoNama").innerHTML='' }
		
		if (document.getElementById("EMAIL").value == '') {
			pesan = '0';
			document.getElementById("infoEmail").innerHTML= "<font color='#FF0000'><b> (Email harus diisi)</b></font>";
        }else{ document.getElementById("infoEmail").innerHTML='';
			var atpos = x.indexOf("@");
        	var dotpos = x.lastIndexOf(".");
           if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		   		document.getElementById("infoEmail").innerHTML= "<font color='#FF0000'><b>Format Emali Salah</b></font>";
		   		pesan += 'error';
		   		return false;
          		}else{ document.getElementById("infoEmail").innerHTML='' }
		}
		if (document.getElementById("KET").value== '') {
            pesan = '0';
			document.getElementById("infoKET").innerHTML= "<font color='#FF0000'><b> (Nama instansi harus diisi)</b></font>";
        }else{ document.getElementById("infoKET").innerHTML='' }
		 if (pesan != '') {
            return false;
        }else{
		    KirimData();
		}
 }
 
function ClearTextBox(){
 document.getElementById("EMAIL").value="";
 document.getElementById("NAMA").value="";
 document.getElementById("KET").value="Masyarakat";
}

function HideDownloadL(){
 document.getElementById("Hasil").innerHTML="";
}

</script>
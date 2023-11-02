<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script>
function TampilkanTabel(){
	var pg = eval(document.getElementById("Halaman").value)-1 ;
	var F = document.getElementById("FtVal").value; 
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/DownloadPetaTrafic.jsp/",
	data: "Halaman="+pg+"&ft="+F,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function FilterValue(){
if ($("#FtVal").val()=="F"){
		$("#FtVal").val("");
	}else{
		$("#FtVal").val("F");
	}

}

function FilterData(){
  FilterValue();
  TampilkanTabel();
}

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

function FerifikasiP(psn,i){
  document.getElementById("IdFeri").value = i;	
  var winW = window.innerWidth;
  $("#CmdTerima").show();
  $("#CmdTolak").show();
  $("#CmdKirim").hide();
  document.getElementById("PsnJudul").innerHTML = "Verfikasi Data & Surat";
  document.getElementById("PsnFeri").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("PsnFeri").style.top = "200px";
  document.getElementById("PsnFeri").style.display= "inherit";
  document.getElementById("IsiPesanF").innerHTML = 'Periksa Berkas berikut <br><a href="<?php echo $nama_folder; ?>/Lampiran/'+psn+'"  target="_blank"><b>'+psn+'</b></a>';
}

function TutupBoxFeri(){
  document.getElementById("PsnFeri").style.display= "none"
}

function ProsesFeri(J){
	var idx = document.getElementById("IdFeri").value
	TutupBoxFeri();
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/"+J+"/",
	data: "Index="+idx,
	cache: false,
	success: function(msg){
		TampilkanTabel();
		}
	});
};
</script>

 <input id="IdFeri" type="hidden" value="0" />
 <input id="IdEmail" type="hidden" value="0" />
 <input id="IdNama" type="hidden" value="0" />
<div class="container-fluid">
 <!-- Page Heading -->
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Pengunduh Peta
                            <small> Siapa saja yang telah mengunduh peta</small>
                        </h1>
                        <ol class="breadcrumb">
						   <li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.jsp">Dashboard</a>
                            </li>
                			<li class="active">
                                <i class="fa fa-globe"></i>  <a href="../../WebAdmin/pages/Download-Peta.jsp">Download Peta</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
           <!-- ========================================================================================== -->                    
 	          <div class="col-lg-12 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Pengunduh</h3>
                       <div class="row">
                       <div class="col-lg-8 text-left">
                       <input name="CkFIlter" id="CkFIlter" type="checkbox" onchange="FilterData()" />
                       <label for="CkFIlter">Tampilkan data berlampiran </label>
                       <input id="FtVal" type="hidden" value="" />
                      </div>
                       <div class="col-lg-4 text-rihgt">
          	   				<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              				<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              				<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
         				</div>
                      </div>  
                        <br/>
                               <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                               <div id="linkList1"></div> 
                 			</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->  
</div>
          
</div><!-- /#page-wrapper -->
<p>&nbsp;</p>
 <!-- --------------------MESAGE --------------- -->
 <div id="PsnFeri" class="MsgHaspus">
   <div class="panel panel-primary">
       <div class="panel-heading">
            <h3 id="PsnJudul" class="panel-title">Ferifikasi Data</h3>
       </div>
       <div class="panel-body" id="IsiPesanF">
             Panel content
       </div>
       <div class="panel-body" align="right">
        <button type="button" onClick="TutupBoxFeri()" class="btn btn-warning">Tutup</button>
        <button type="button" id="CmdTerima" onClick="ProsesFeri('Veri')" class="btn btn-success">Terima</button>
        <button type="button" id="CmdTolak" onClick="ProsesFeri('Tolak')" class="btn btn-danger">Tolak</button>
        <button type="button" id="CmdKirim" onClick="KirimPeta()" class="btn btn-success">Kirim</button>
       </div>
   </div>
 </div>
<!-- --------------------END MESAGE------------ --> 

<script>
	TampilkanTabel()
	$("#CmdKirim").hide();

function DlgKirimPeta(Em,Nm,i){
  document.getElementById("IdFeri").value = i;	
  document.getElementById("IdEmail").value =Em;
  document.getElementById("IdNama").value  = Nm;
  $("#CmdTerima").hide();
  $("#CmdTolak").hide();
  $("#CmdKirim").show(); 
  var winW = window.innerWidth;
  document.getElementById("PsnJudul").innerHTML = "Kirim Peta Kepada";
  document.getElementById("PsnFeri").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("PsnFeri").style.top = "200px";
  document.getElementById("PsnFeri").style.display= "inherit";
  document.getElementById("IsiPesanF").innerHTML = 'Nama Pemohon :<b>'+Nm+'</b><br/>Email Tujuan : <b>'+Em+'</b>';
}
function KirimPeta(){
	var idx = document.getElementById("IdFeri").value
	var Eml = document.getElementById("IdEmail").value
	var Nma = document.getElementById("IdNama").value
	TutupBoxFeri();
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Kirim/"+Eml+"/"+Nma+"/"+idx+"/",
	data: "Index="+idx,
	cache: false,
	success: function(msg){
		TampilkanTabel();
		AlertInfoKirim(msg)
		}
	});
};

function AlertInfoKirim(Psn){
  $("#CmdTerima").hide();
  $("#CmdTolak").hide();
  $("#CmdKirim").hide(); 
  var winW = window.innerWidth;
  document.getElementById("PsnJudul").innerHTML = "Info Pengiriman";
  document.getElementById("PsnFeri").style.left = (winW/2) - (500 * .5)+"px";
  document.getElementById("PsnFeri").style.top = "200px";
  document.getElementById("PsnFeri").style.display= "inherit";
  document.getElementById("IsiPesanF").innerHTML = Psn;
}
</script>
<?php }?>
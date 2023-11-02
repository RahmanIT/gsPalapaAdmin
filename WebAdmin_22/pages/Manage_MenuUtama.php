<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/layout/scripts/jquery.wallform.js"></script>
<script>
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
					 PosisiAwal()
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
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

        if (document.getElementById("URL").value== '') {
            pesan = '0';
			document.getElementById("InfoKET").innerHTML= "<font color='#FF0000'><b>(Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoKET").innerHTML='' }
		
		 if (pesan != '') {
            return false;
        }else{
		 	Unggah();
		}
}

function TampilkanTabel(){
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Tabel-MenuUtama.jsp/",
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
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-MenuUtama.jsp"
	document.getElementById("NAMA").value = n;
	document.getElementById("URL").value = p;
	document.getElementById("KD").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit Menu Utama"
	document.getElementById("CmdSave").style.display = "none";
	document.getElementById("CmdUpdate").style.display = "inline-block";
	document.getElementById("CmdCancel").style.display = "inline-block";
}

function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/MenuUtama.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Menu Utama"
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
                          Menu Utma
                            <small> setting menu level 1</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.html">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-gear"></i><a href="../../WebAdmin/pages/Setting.html">Managemant</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Menu Utama
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <div class="col-lg-4 text-left">
                 <div class="panel panel-default">
                   <div class="panel-body">
                       <h3 id="HederJudul">Tambahkan Menu</h3>
                       <div id="infoSave"></div>
                        <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/MenuUtama.jsp">
                                <div class="form-group">
                     				 <label>Nama Menu</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA" onKeyPress="ClearInfo1()" class="form-control" type="text" value="" placeholder="Nama Menu" size="50" maxlength="20" />
               					</div>
                          <div class="form-group">
           				    <label>URL</label><span id="InfoKET"></span>
               				   <input name="URL" type="text" class="form-control" id="URL" placeholder="Url Target" value="" size="50" />
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
                       <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Menu Utama</h3>
                       <div id="linkList1"></div> 
                   </div>
                </div>
              </div>
               <!-- ========================================================================================== -->        
 </div>
<p>&nbsp;</p> 
<script>
TampilkanTabel();
PosisiAwal();
document.getElementById("Manage1").className = "collapse in";
</script>    
<?php } ?>
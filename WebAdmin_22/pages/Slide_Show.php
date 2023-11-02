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
        if (document.getElementById("KETERANGAN").value== '') {
            pesan = '0';
			document.getElementById("InfoKet").innerHTML= "<font color='#FF0000'><b> (Wajid diisi)</b></font>";
        }else{ document.getElementById("InfoKet").innerHTML='' }
		
        		
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
	url: "<?php echo $nama_folder; ?>/TabelSlide.jsp/",
	data: "p=1",
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function EditData(J,k,l){
	document.getElementById("form1").action = "<?php echo $nama_folder; ?>/Edit-Pembina.jsp"
	document.getElementById("KETERANGAN").value = l;
	document.getElementById("JUDUL").value = J;
	document.getElementById("ID_SLD").value = k;
	document.getElementById("HederJudul").innerHTML = "Edit Slide"
	document.getElementById("CmdSave").innerHTML = "Upadate";
	document.getElementById("CmdCancel").style.display = "inline-block";
}
function PosisiAwal(){
    document.getElementById("form1").action ="<?php echo $nama_folder; ?>/pembina.jsp"
 	document.getElementById("HederJudul").innerHTML = "Tambahkan Slide"
	document.getElementById("CmdSave").innerHTML = "Tambahkan";
	document.getElementById("CmdCancel").style.display = "none";
    document.getElementById("KETERANGAN").value = "";
	document.getElementById("filUpload").src = "";
}
</script>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Kelola Slide Show Home<small></small>
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
	          <div class="col-lg-4 text-left">
 	  					<div class="panel panel-default">
   							<div class="panel-body"> 
                              <h3 id="HederJudul">Tambahkan Slide</h3>
                              <div id="infoSave"></div>
                              <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/pembina.jsp"> 
                                <div class="form-group">
                     				 <label>Judul</label><span id="InfoJudul"></span>
                      				 <input  name="JUDUL" id="JUDUL" class="form-control" type="text" value="" placeholder="Judul Slide" maxlength="255" />
               					</div>
                                <div class="form-group">
                     				 <label>Keterangan</label><span id="InfoKet"></span>
                      				 <input  name="KETERANGAN" id="KETERANGAN" class="form-control" type="text" value="" placeholder="Keterangan Slide" maxlength="255" />
               					</div>
                                
             					<div class="form-group">
                    				<label>Image Slide</label> (Maksimal 2 Mega Pixel)<span id="FotoFile"></span>
                      				<div id='imageloadstatus' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                     				<div id='imageloadbutton'><input type="file" class="form-control" name="filUpload" id="filUpload" /></div>
               					</div> 
                                                                                 
                                 <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
 								<div class="box-footer" align="right">
                                    <button type="button" id="CmdCancel" onclick="PosisiAwal()" class="btn btn-lg btn-warning">Batal</button>
 									<button type="button" id="CmdSave" onClick="VerifikasiData()" class="btn btn-lg btn-primary">Tambahkan</button>
                				</div>                                
		   						<input name="ID_SLD" id="ID_SLD" type="hidden" value="" />
                              </form>
                              <p>&nbsp;</p>
   							</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
 	          <div class="col-lg-8 text-center">
 	  					<div class="panel panel-default">
   							<div class="panel-body">
                              <h3 onClick="TampilkanTabel()" style="cursor:pointer;">Daftar Slide</h3>
                               <div id="linkList1"></div> 
                 			</div>
                      </div>
               </div>
           <!-- ========================================================================================== -->         
                      
           
</div>
  <!-- /#page-wrapper -->
<p>&nbsp;</p>
<script>
	document.getElementById("config01").className = "active";
	document.getElementById("Manage1").className = "collapse in";
    PosisiAwal()
	TampilkanTabel();
</script>
<?php } ?>
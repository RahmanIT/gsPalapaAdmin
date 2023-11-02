<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>
<script>
function SimpanFeature(){ 			  
			       $("#preview").html();
			  
				   $("#FrmFeature").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					 window.location = "<?php echo $nama_folder; ?>/WebAdmin/Feature.jsp"
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
 };

function showPreview(ele)	{
		$('#imgAvatar').attr('src', ele.value); // for IE
        if (ele.files && ele.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function (e) {
                    $('#imgAvatar').attr('src', e.target.result);
            }
        reader.readAsDataURL(ele.files[0]);
       }
}


function AddPetaFrom(){
  var Fidx = document.getElementById("TxtIndxF").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FromFeatureLoad.jsp/",
	data: "Index="+Fidx,
	cache: false,
	success: function(msg){
		 var ps = "FrmBox"+Fidx
		 document.getElementById(ps).innerHTML = msg;
		 document.getElementById("TxtIndxF").value = eval(Fidx)+1 ;
		$("#imageloadstatus").hide();
		}
	});
}

function AddPetaDukung(){
  var Fidy = document.getElementById("TxtIndxM").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/FromMapServerLoad.jsp/",
	data: "Index="+Fidy,
	cache: false,
	success: function(msg){
		 var ps = "FrmBoxM"+Fidy
		 document.getElementById(ps).innerHTML = msg;
		 document.getElementById("TxtIndxM").value = eval(Fidy)+1 ;
		$("#imageloadstatus").hide();
		}
	});
}

function HapusFt(t){
  document.getElementById(t).innerHTML = "";
}
</script>
<style>
#imgAvatar
{
color:#cc0000;
width:auto;
width:400px;
}
</style>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Add Feature
                            <small> Tambahkan peta partisipatif kedalam portal</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.html">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-thumb-tack marker"></i><a href="../../WebAdmin/pages/Feature.jsp"> Feature Acces</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Add
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <form method="POST" name="FrmFeature" id="FrmFeature" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/SimpanFeature.jsp">
               <div id="preview"></div>
                <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div class="form-group">
                      			<label>Nama Feature</label>
                      			<input name="NM_FEATURE" class="form-control" type="text" value="" placeholder="Nama Feature"  maxlength="50" id="NM_FEATURE" />
               				</div>
              				<div class="form-group">
                  				<label>Keterangan</label>
                  				<textarea name="KETERANGAN" cols="50" rows="3" class="form-control" placeholder="Diskripsi Feature"></textarea>
               				</div>
                            <div class="form-group">
                            	<label>Role Data</label>
                            	<select name="CboROle" class="form-control">
                              		<option value="1">Publik</option>
                              		<option value="2">PEMPROV</option>
                              		<option value="3">PEMKAB/KOTA</option>
                              		<option value="4">KHUSUS</option>
                            	</select>
                            </div>
                            <div class="form-group">
                            	<label>Image Koper</label>
       					 		<input name="filUpload" type="file" id="filUpload" OnChange="showPreview(this)">
                            </div>
                            <div class="form-group">
      								<center>
      									<img id="imgAvatar" style="border:solid 1px #0066CC;"/>
        							</center>
      							</div>
                        </div>
                     </div>
               </div>               
               <!-- ========================================================================================== -->
               <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                       <div class="panel-body">
                         <div class="form-group">
                        	<a href="#" onclick="AddPetaFrom()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambahkan Feature Acces</a>
                        	<input name="TxtIndxF" type="hidden" id="TxtIndxF" value="0" size="10" />
                         </div>
                           
                          <div id="FrmBox0"></div>
                        
                      </div>
                  </div>
                 <!--------------------------------------------------------------------------->
                    <div class="panel panel-default">
                       <div class="panel-body">
                         <div class="form-group">
                        	<a href="#" onclick="AddPetaDukung()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambahkan Peta Dukung</a>
                        	 <input name="TxtIndxM" type="hidden" id="TxtIndxM" value="0" size="10" />
                         </div>  
                         
                          <div id="FrmBoxM0"></div>
                        
                      </div>
                      <div class="panel-footer" align="right">
                            <img id="imageloadstatus" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" width="220" height="19" alt="Loading Upload.." />
                            <button type="button" onclick="SimpanFeature()" id="imageloadbutton" class="btn btn-success">Simpan</button>
                      </div>
                  </div> 
               </div>
				<input type="hidden" name="MM_insert" value="form1">
               </form>
<script>
document.getElementById("fature01").className = "active";
</script>
<?php } ?>
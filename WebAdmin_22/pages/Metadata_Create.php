<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_RsJDSN = "SELECT KD_JDSN, NM_JDSN FROM tb_jdsn";
$RsJDSN = mysqli_query($Congis, $query_RsJDSN) or die(mysqli_error());
$row_RsJDSN = mysqli_fetch_assoc($RsJDSN);
$totalRows_RsJDSN = mysqli_num_rows($RsJDSN);

$query_RstOP = "SELECT KD_USER, NAMA FROM tb_admin";
$RstOP = mysqli_query($Congis, $query_RstOP) or die(mysqli_error());
$row_RstOP = mysqli_fetch_assoc($RstOP);
$totalRows_RstOP = mysqli_num_rows($RstOP);

$query_RstFolder = "SELECT Id, DIR_NAME FROM tb_shpfile_dir";
$RstFolder = mysqli_query($Congis, $query_RstFolder) or die(mysqli_error());
$row_RstFolder = mysqli_fetch_assoc($RstFolder);
$totalRows_RstFolder = mysqli_num_rows($RstFolder);
?>

<link rel="stylesheet" href="<?php echo $nama_folder ?>/js/jquery-ui.css" type="text/css" />
<script src="<?php echo $nama_folder; ?>/js/jquery-ui.js"></script>
<script src="<?php echo $nama_folder; ?>/js/jquery.wallform.js"></script>
<script>
function Unggah(){ 			  
			       $("#preview").html();
			  
				   $("#FrmMetaData").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 ReadXMLPath();
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
 };

function ReadXMLPath(){
 document.getElementById("TxtXMLPath").value ="<?php echo $_SESSION["fileXMl"]; ?>";
 TampilkanMetadata()
}

function TampilkanMetadata(){
	
  var xL = document.getElementById("TxtXMLPath").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Metadata-Load.jsp/",
	data: "file="+xL,
	cache: false,
	success: function(msg){
		 document.getElementById("preview").innerHTML = msg;
		$("#imageloadstatus").hide();
		 OnTgl()
		}
	});
};

function OnTgl(){
	$("#TANGGAL").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: $.datepicker.ATOM
	});	
	
		$("#TGL_UPDATE").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: $.datepicker.ATOM
	});	
};
</script><div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           META DATA
                            <small>Tambahkan Katalog data spasial</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-map=marker"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Metadata.jsp">Peta</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-code"></i>Metadata
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->         
      <!--========================================================================================= -->
      <div class="col-lg-12 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
         <section class="content">
            <form method="POST" name="FrmMetaData" id="FrmMetaData" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/UploadPetaXML.php">
        		 <img id="imageloadstatus" style="display:none;" src="<?php echo $nama_folder; ?>/images/loader.gif" width="220" height="19" alt="Loading Upload.." />
			<div class="form-group">
		    <label>Upload Meta Data</label>
       		<input   name="UploadXML" class="form-control" id="UploadXML" type="file" />
            <input id="TxtXMLPath" name="TxtXMLPath" type="hidden" />
   			</div>
            <div class="form-group" align="right">
             <input name="Upload" class="btn btn-warning" onclick="ReadXMLPath()" type="button" value="Reload XML" />
            <input name="Upload" id="imageloadbutton" class="btn btn-primary" onclick="Unggah()" type="button" value="Unggah" />
            </div> 
        	</form>
            
           
        <section class="content">
        <!-------------------------------------------------------------------------------- -->
     	</div>
   	</div>
	</div>        
	<!--======================================================================================== -->
      <form method="POST" name="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/SimpanPeta.jsp">
      <div class="col-lg-6 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
         <section class="content">
    		<div id="preview"></div> 
        <section class="content">
     	</div>
   	</div>
	</div>  
     <!--========================================================================================= -->
	<div class="col-lg-6 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
		<!-------------------------------------------------------------------------------- -->                        
        <!-- Main content -->
      	  <section class="content">
          <!-- Default box -->
        
            <div class="form-group">
			    <label>Map Service</label>
                <input name="MAP_SERVER" type="text" class="form-control" value="<?php echo $_GET['UrlS']; ?>" placeholder="Server/arcgis/rest/service" size="50" />
			  </div>
              <div class="form-group">
                <label>Wali Data</label>
       		    <select name="PEMBUAT" class="form-control" id="PEMBUAT">
       		      <?php
do {  
?>
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
             <div class="form-group">
                <label>Kategori Data</label>
       		    <select name="CboDIR" class="form-control" id="CboDIR">
       		      <?php
				do {  
				?>
       		      <option value="<?php echo $row_RstFolder['DIR_NAME']?>"><?php echo $row_RstFolder['DIR_NAME']?></option>
       		      <?php
				} while ($row_RstFolder = mysqli_fetch_assoc($RstFolder));
				  $rows = mysqli_num_rows($RstFolder);
				  if($rows > 0) {
					  mysqli_data_seek($RstFolder, 0);
					  $row_RstFolder = mysqli_fetch_assoc($RstFolder);
				  }
				?>
       		    </select>
   			 </div>
             <div class="form-group">
			    <label>Dibuat</label>
                <input name="INISIAL" type="text" class="form-control" value="" placeholder="Nama Singkat Instansi" />
			  </div>
            <div class="form-group">
     			<label>Peta Format JPG</label>
                <input name="JPG" id="JPG"  class="form-control" type="file" value="-" />
           <table cellpadding="5">
                <tr>
                  <td><label><input name="RdJPG" type="radio" id="RdPDF_0" value="-" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input type="radio" name="RdJPG" value="a" id="RdPDF_1" />Tersedia &nbsp;</label></td>
                  <td><label><input type="radio" name="RdJPG" value="x" id="RdPDF_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
           </div> 
			<div class="form-group">
       		   <label>Peta Format PDF</label>
   			    <input name="PDF" id="PDF"  class="form-control" type="file" value="-" />
            <table cellpadding="5">
                <tr>
                  <td><label><input name="RdPDF" type="radio" id="RdPDF_0" value="-" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input type="radio" name="RdPDF" value="a" id="RdPDF_1" />Tersedia &nbsp;</label></td>
                  <td><label><input type="radio" name="RdPDF" value="x" id="RdPDF_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
            </div>
            <div class="form-group">
       		   <label>Peta Format PNG</label>
   			    <input name="PNG" id="PNG"  class="form-control" type="file" value="-"/>
            <table cellpadding="5">
                <tr>
                  <td><label><input type="radio" name="RdPNG" value="-" id="RdPNG_0" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input type="radio" name="RdPNG" value="a" id="RdPNG_1" />Tersedia &nbsp;</label></td>
                  <td><label><input type="radio" name="RdPNG" value="x" id="RdPNG_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
            </div>
              
                    <div class="form-group">
         				<label>Sumber Simpul</label>
                        <select name="KD_JDSN" class="form-control">
                          <?php
							do {  
							?>
                          <option value="<?php echo $row_RsJDSN['KD_JDSN']?>"><?php echo $row_RsJDSN['NM_JDSN']?></option>
                          <?php
							} while ($row_RsJDSN = mysqli_fetch_assoc($RsJDSN));
							  $rows = mysqli_num_rows($RsJDSN);
							  if($rows > 0) {
								  mysqli_data_seek($RsJDSN, 0);
								  $row_RsJDSN = mysqli_fetch_assoc($RsJDSN);
							  }
							?>
                        </select>
       					
   					</div>
                    <div class="form-group" >
         				<label>Type IG</label>
       					 <select name="TYPE_IG" class="form-control">
       					   <option value="KL">Kementerian Lembaga</option>
       					   <option value="PROV">Pemeritah Provinsi</option>
       					   <option value="KAB">Pemerintah Kab/Kota</option>
       					 </select>
   					</div>
                    
                                                 
                   <div class="form-group">
         				<label>Image Thum</label>
       					 <input name="filUpload" type="file" id="filUpload">
   					</div>
                  
                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Simpan Peta</button>
                  </div>
                  <input type="hidden" name="MM_insert" value="form1">
          </section>                   
		<!-------------------------------------------------------------------------------- -->
     </div>
   </div>
</div>        
<!--======================================================================================== -->
 </form>
</div>
<!-- /#page-wrapper -->
<p>&nbsp;</p>
<script>
	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>
<?php
mysqli_free_result($RsJDSN);
mysqli_free_result($RstOP);
mysqli_free_result($RstFolder);
} ?>
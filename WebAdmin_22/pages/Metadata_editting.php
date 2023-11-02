<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ;
$query_RsJDSN = "SELECT KD_JDSN, NM_JDSN FROM tb_jdsn";
$RsJDSN = mysqli_query($Congis, $query_RsJDSN) or die(mysqli_error());
$row_RsJDSN = mysqli_fetch_assoc($RsJDSN);
$totalRows_RsJDSN = mysqli_num_rows($RsJDSN);

$query_RstKatalog = "SELECT KD_PETA,SUMMARY, ABSTRAK,BB,BT,LU,LS, NAMA, MAP_SERVER, PDF,R_PDF, JPG,R_JPG,PNG,R_PNG, KD_JDSN, TYPE_IG, PEMBUAT, SMB_DATA, TANGGAL, IMAGE, ID_REC, XML_FILE FROM tb_peta WHERE KD_PETA = $segmen4";
$RstKatalog = mysqli_query($Congis, $query_RstKatalog) or die(mysqli_error());
$row_RstKatalog = mysqli_fetch_assoc($RstKatalog);
$totalRows_RstKatalog = mysqli_num_rows($RstKatalog);

$_SESSION["fileXMl"] = $row_RstKatalog['XML_FILE'];
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
		}
	});
};

function ReadXMLPathOld(){
 document.getElementById("TxtXMLPath").value ="<?php echo $_SESSION["fileXMl"]; ?>";
 MetadataOld()
}

function MetadataOld(){
  var xL = document.getElementById("TxtXMLPath").value;
	$("#imageloadstatus").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Metadata-Old.jsp/",
	data: "file="+xL,
	cache: false,
	success: function(msg){
		 document.getElementById("preview").innerHTML = msg;
		$("#imageloadstatus").hide();
		}
	});
};

$(function(){
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
});
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
                                <i class="fa fa-map-marker"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Metadata.jsp">Peta</a>
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
      <form method="POST" name="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/UpdatePeta.jsp">
      <div class="col-lg-6 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
         <section class="content">
    		<div id="preview">
            <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  METADATA XML READ  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ --> 
              		<?php
   			$fileXml = "metadata/".$_SESSION["fileXMl"];
    		$mythme = simplexml_load_file($fileXml);
			echo "<h3>".$_SESSION["fileXMl"]."</h3>";
		?>
		<input name="XML_FILE" type="hidden" value="<?php echo $_SESSION["fileXMl"]; ?>" />
		<div class="form-group">
  			 <label>Nama Peta</label>
  			 <input name="NAMA" id="NAMA" class="form-control" type="text" value="<?php echo $mythme->Esri[0]->DataProperties->itemProps->itemName; ?>" placeholder="Nama Peta" size="50" maxlength="50" />
		</div>
		<div class="form-group">
   			<label>Nama Peta</label>
   			<input name="JUDUL" id="JUDUL" class="form-control" type="text" value="<?php echo $row_RstKatalog['NAMA']; ?>" placeholder="Nama Peta" size="50" maxlength="50" />
		</div>
		<div class="form-group">
   			<label>Summary</label>
  			<textarea name="SUMMARY" id="SUMMARY" cols="50" class="form-control" placeholder="Ringkasan Peta"><?php echo $row_RstKatalog['SUMMARY']; ?></textarea>
		</div>
		<div class="form-group">
  			<label>Abstrak</label>
    		<textarea name="ABSTRAK" cols="50" rows="5" class="form-control" placeholder="Abstrak"><?php echo $row_RstKatalog['ABSTRAK']; ?></textarea>
		</div>
		<div class="form-group">
    		<label>Sumber Data</label>
    		<input name="SMB_DATA" id="SMB_DATA" class="form-control" type="text" value="<?php  echo $smbDt = $mythme->dataIdInfo[0]->idCredit; ?>" placeholder="Sumber Data" size="50" maxlength="255" />
		</div>
		<!--------------------------------------------- -->
		<div class="col-lg-4 text-left">
			<div class="form-group">
    			<label>Bujur Barat</label>
    			<input type="text" name="BB" id="BB" class="form-control" value="<?php echo $row_RstKatalog['BB']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Bujur Timur</label>
    			<input type="text" name="BT" id="BT" class="form-control" value="<?php echo $row_RstKatalog['BT']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Lintang Utara</label>
    			<input type="text" name="LU" id="LU" class="form-control" value="<?php echo $row_RstKatalog['LU']; ?>" />
			</div>
        	<div class="form-group">
    			<label>Lintang Selatan</label>
    			<input type="text" name="LS" id="LS" class="form-control" value="<?php echo $row_RstKatalog['LS']; ?>"  />
      		</div>                    
		</div>
		<!--------------------------------------------- -->    
		<div class="col-lg-8 text-left">
      		<div class="form-group">
    			<label>Type Koordinat</label>
    			<input name="TYPE" id="TYPE" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->DataProperties->coordRef->type; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Georeferensi</label>
    			<input type="text" name="GEO_REFERENCE" id="GEO_REFERENCE" class="form-control" value="<?php echo $mythme->Esri[0]->DataProperties->coordRef->geogcsn; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Max Skala</label>
    			<input id="MAX_SKALA" name="MAX_SKALA" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->scaleRange->minScale; ?>" />
      		</div> 
      		<div class="form-group">
    			<label>Min Skala</label>
    			<input id="MIN_SKALA" name="MIN_SKALA" type="text" class="form-control" value="<?php echo $mythme->Esri[0]->scaleRange->maxScale; ?>"/>
      		</div>                  
		</div>
		<div class="form-group">
    		<label>Keyword</label>
    		<input name="MAP_TAG" type="text" id="MAP_TAG" class="form-control" value="<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[0]; ?>,<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[1]; ?>,<?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[2]; ?>, <?php echo $mythme->dataIdInfo[0]->searchKeys->keyword[3]; ?>" size="35" />
		</div>
		<div class="form-group">
    		<label>ID Record</label>
    		<input type="text" name="ID_REC" id="ID_REC" class="form-control" value="<?php echo $mythme->mdFileID[0]; ?>" size="35" />
		</div>
		<?php  
			$str1=$mythme->Esri[0]->CreaDate; 
			$tgl = substr($str1, 6,2);
			$bln = substr($str1, 4,2);
			$thn = substr($str1, 0,4);
	
			$str2=$mythme->Esri[0]->ModDate;
			$tgl2 = substr($str2, 6,2);
			$bln2 = substr($str2, 4,2);
			$thn2 = substr($str2, 0,4); 
		?>
    		<!--------------------------------------------- -->
               <div class="col-lg-6 text-left">
				<div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TANGGAL" id="TANGGAL" placeholder="Tanggal Pembuatan" class="form-control" value="<?php echo $thn."-".$bln."-".$tgl;  ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
               </div>
              <!--------------------------------------------- -->
               <div class="col-lg-6 text-left">
                  <div class="form-group">
                    <label>Update Terakhir:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TGL_UPDATE" id="TGL_UPDATE" placeholder="Tanggal Update" class="form-control" value="<?php echo $thn2."-".$bln2."-".$tgl2;  ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
  				 </div>
              <!--------------------------------------------- -->
				<img name="Img" src="data:image/jpeg;base64,<?php echo $mythme->Binary[0]->Thumbnail->Data; ?>" width="450"  alt="">
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->        
            </div> 
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
			    <label>Service</label>
                <input name="MAP_SERVER" type="text" class="form-control" placeholder="Server/arcgis/rest/service" value="<?php echo $row_RstKatalog['MAP_SERVER']; ?>" size="50" />
			  </div>
              <div class="form-group">
         		<label>Pembuat</label>
       		    <input name="PEMBUAT"  class="form-control" type="text" value="<?php echo $row_RstKatalog['PEMBUAT']; ?>" placeholder="Pembuata Peta" size="50" maxlength="100" />
   			 </div>
             <div class="form-group">
   			   <label>JPG URL</label>
       		    <input name="JPG"  class="form-control" type="text" value="<?php echo $row_RstKatalog['JPG']; ?>" placeholder="ftp_dir/file.jpg" size="50" maxlength="255" />
           <table cellpadding="5">
                <tr>
                  <td><label><input  <?php if (!(strcmp($row_RstKatalog['R_JPG'],"-"))) {echo "checked=\"checked\"";} ?> name="RdJPG" type="radio" id="RdPDF_0" value="-" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input  <?php if (!(strcmp($row_RstKatalog['R_JPG'],"a"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdJPG" value="a" id="RdPDF_1" />Tersedia &nbsp;</label></td>
                  <td><label><input  <?php if (!(strcmp($row_RstKatalog['R_JPG'],"x"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdJPG" value="x" id="RdPDF_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
           </div> 
			<div class="form-group">
   		      <label>PDF URL</label>
   			    <input name="PDF"  class="form-control" type="text" value="<?php echo $row_RstKatalog['PDF']; ?>" placeholder="ftp_dir/file.pdf" size="50" maxlength="255" />
            <table cellpadding="5">
                <tr>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PDF'],"-"))) {echo "checked=\"checked\"";} ?> name="RdPDF" type="radio" id="RdPDF_0" value="-" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PDF'],"a"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdPDF" value="a" id="RdPDF_1" />Tersedia &nbsp;</label></td>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PDF'],"x"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdPDF" value="x" id="RdPDF_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
            </div>
            <div class="form-group">
   		      <label>PNG URL</label>
   			    <input name="PNG"  class="form-control" type="text" value="<?php echo $row_RstKatalog['PNG']; ?>" placeholder="ftp_dir/file.png" size="50" maxlength="255" />
            <table cellpadding="5">
                <tr>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PNG'],"-"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdPNG" value="-" id="RdPNG_0" checked="checked" />Tidak Ada &nbsp; </label></td>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PNG'],"a"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdPNG" value="a" id="RdPNG_1" />Tersedia &nbsp;</label></td>
                  <td><label><input <?php if (!(strcmp($row_RstKatalog['R_PNG'],"x"))) {echo "checked=\"checked\"";} ?> type="radio" name="RdPNG" value="x" id="RdPNG_2" />Bersyarat &nbsp;</label></td>
                </tr>
            </table>
            </div>
              
                    <div class="form-group">
         				<label>Sumber Simpul</label>
                        <select name="KD_JDSN" class="form-control">
                          <?php
do {  
?>
                          <option value="<?php echo $row_RsJDSN['KD_JDSN']?>"<?php if (!(strcmp($row_RsJDSN['KD_JDSN'], $row_RstKatalog['KD_JDSN']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RsJDSN['NM_JDSN']?></option>
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
       					   <option value="KL" <?php if (!(strcmp("KL", $row_RstKatalog['TYPE_IG']))) {echo "selected=\"selected\"";} ?>>Kementerian Lembaga</option>
       					   <option value="PROV" <?php if (!(strcmp("PROV", $row_RstKatalog['TYPE_IG']))) {echo "selected=\"selected\"";} ?>>Pemeritah Provinsi</option>
       					   <option value="KAB" <?php if (!(strcmp("KAB", $row_RstKatalog['TYPE_IG']))) {echo "selected=\"selected\"";} ?>>Pemerintah Kab/Kota</option>
       					 </select>
   					</div>
                    
                                                 
                   <div class="form-group">
         				<label>Image Thum</label>
       					 <input name="filUpload" type="file" id="filUpload">
                         <img src="<?php echo $nama_folder; ?>/images/peta/300x250_<?php echo $row_RstKatalog['../../WebAdmin/pages/IMAGE']; ?>" >
   					</div>
                  
                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Update Metadata</button>
                  </div>
                  <input type="hidden" name="KD_PETA" value="<?php echo $row_RstKatalog['KD_PETA']; ?>">
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
//ReadXMLPathOld();
	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>
<?php
mysqli_free_result($RsJDSN);
mysqli_free_result($RstKatalog);
 } ?>
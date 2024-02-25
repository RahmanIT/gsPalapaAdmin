<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_rsKtg = "SELECT KD_KATEGORI, NAMA FROM tb_kategori";
$rsKtg = mysqli_query($Congis, $query_rsKtg) or die(mysqli_error());
$row_rsKtg = mysqli_fetch_assoc($rsKtg);
$totalRows_rsKtg = mysqli_num_rows($rsKtg);

$query_RsBeritaEdt = "SELECT * FROM tb_berita WHERE KD_NEWS = $segmen4";
$RsBeritaEdt = mysqli_query($Congis, $query_RsBeritaEdt) or die(mysqli_error());
$row_RsBeritaEdt = mysqli_fetch_assoc($RsBeritaEdt);
$totalRows_RsBeritaEdt = mysqli_num_rows($RsBeritaEdt);
?>
<style>
#imgAvatar
{
color:#cc0000;
width:auto;
border:#FFFFFF;
border-color:#FFFFFF;
border-width:2px;
height:300px;
background:#666666;
}
</style>

<div class="container-fluid">
     <!-- Page Heading -->
    <div class="row">
          <div class="col-lg-12">
                        <h1 class="page-header">
                           Tulis Berita
                            <small>dan Upload gambar</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Berita.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-file-text"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Berita.jsp">Berita</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Edit Berita
                            </li>
                        </ol>
                    </div>
    </div><!-- /.row -->
<!--========================================================================================= -->
	<div class="col-lg-12 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
		<!-------------------------------------------------------------------------------- -->                        
        <!-- Main content -->
      <section class="content">
          <!-- Default box -->
        <div  class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editing Berita</h3>
            </div>
           
                <!-- form start -->
              <form role="form" action="<?php echo $nama_folder; ?>/Update-Berita.jsp" enctype="multipart/form-data"  method="POST" name="form1" id="form1">
             <div class="box-body">
              	<div class="form-group">
                      <label>Judul</label>
                      <input name="JUDUL" class="form-control" type="text" value="<?php echo $row_RsBeritaEdt['JUDUL']; ?>" placeholder="Judul Berita" size="50" maxlength="100" />
               </div>
              <div class="form-group">
                  <label>Abstrak</label>
                      <textarea name="ABSTRAK" cols="50" rows="3" class="form-control" placeholder="Uraian Singkat Berita"><?php echo $row_RsBeritaEdt['ABSTRAK']; ?></textarea>
               </div>
               <div class="form-group">
                      <label>Rincian Berita</label>
                      <textarea name="ISI" id='ISI' cols="50" rows="20"><?php echo $row_RsBeritaEdt['ISI']; ?></textarea>
               </div> 
                             
               <div class="form-group">
               <label>Kategori Berita</label>
                 <select name="KD_KATEGORI" class="form-control">
                   <?php
do {  
?>
                   <option value="<?php echo $row_rsKtg['KD_KATEGORI']?>"<?php if (!(strcmp($row_rsKtg['KD_KATEGORI'], $row_RsBeritaEdt['KD_KATEGORI']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsKtg['NAMA']?></option>
                   <?php
} while ($row_rsKtg = mysqli_fetch_assoc($rsKtg));
  $rows = mysqli_num_rows($rsKtg);
  if($rows > 0) {
      mysqli_data_seek($rsKtg, 0);
	  $row_rsKtg = mysqli_fetch_assoc($rsKtg);
  }
?>
                 </select>
                 </div>
                
               <div class="form-group">
                      <label>Image/Foto</label> (Maksimal 2 Mega Pixel)
                      <input name="filUpload" id="filUpload" class="form-control" type="file" size="100" OnChange="showPreview(this)"/>
               </div>  
                <div class="form-group">
                <?php 
				  $ImgUrl = $DataDir."/images/berita/800x450_".$row_RsBeritaEdt['FOTO'];							
				  $img68 = base64_encode(file_get_contents($ImgUrl));
				?>
                  <img id="imgAvatar" src="data:image/jpeg;base64,<?php echo $img68; ?>"  alt="Image Label Preview" />
                </div>
 
              <div class="form-group">
                      <label>Penulis</label>
                     <input type="text" class="form-control" name="CREATED" value="<?php echo $P[0]["OPERATOR"]; ?>" size="32" />
               </div> 
                
               <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TANGGAL" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" value="<?php echo date("Y-m-d H:m:s") ?>">
                    </div><!-- /.input group -->
                  </div>
              
              </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Update Berita</button>
                  </div>
                  <input type="hidden" name="KD_NEWS" value="<?php echo $row_RsBeritaEdt['KD_NEWS']; ?>" />
                <input type="hidden" name="MM_update" value="form1" />
              </form>
           </div>
       </section>                   
		<!-------------------------------------------------------------------------------- -->
     </div>
   </div>
</div>        
<!--======================================================================================== -->
</div><!-- end  container-fluid-->    

       <p>&nbsp;</p>     
        
 <script src="<?php echo $nama_folder; ?>/Libs/ckeditor/ckeditor.js"></script>
<script>

			CKEDITOR.replace( 'ISI', {
				allowedContent:
					'h1 h2 h3 p blockquote strong em;' +
					'a[!href];' +
					'img(left,right)[!src,alt,width,height];' +
					'table tr th td caption;' +
					'span{!font-family};' +
					'span{!color};' +
					'span(!marker);' +
					'del ins'
			} );

</script>

<script>
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

	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";;
</script>    
<?php
mysqli_free_result($rsKtg);
mysqli_free_result($RsBeritaEdt);
 } ?>      
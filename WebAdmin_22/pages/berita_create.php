<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_rsKtg = "SELECT KD_KATEGORI, NAMA FROM tb_kategori";
$rsKtg = mysqli_query($Congis, $query_rsKtg) or die(mysqli_error());
$row_rsKtg = mysqli_fetch_assoc($rsKtg);
$totalRows_rsKtg = mysqli_num_rows($rsKtg);
?>
<link rel="stylesheet" href="<?php echo $nama_folder; ?>/Libs/ckeditor/sample.css">
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
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-file-text"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/Berita.jsp">Berita</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Buat Berita
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
              <h3 class="box-title">Posting Berita Baru</h3>
            </div>
           
                <!-- form start -->
              <form role="form" action="<?php echo $nama_folder; ?>/berita.jsp" enctype="multipart/form-data"  method="post" name="form1" id="form1">
             <div class="box-body">
              	<div class="form-group">
                      <label>Judul</label>
                      <input name="JUDUL" class="form-control" type="text" value="" placeholder="Judul Berita" size="50" maxlength="100" />
               </div>
              <div class="form-group">
                  <label>Abstrak</label>
                      <textarea name="ABSTRAK" cols="50" rows="3" class="form-control" placeholder="Uraian Singkat Berita"></textarea>
               </div>
               <div class="form-group">
                      <label>Rincian Berita</label>
                      <textarea name="ISI" id='ISI' cols="50" rows="20"></textarea>
               </div> 
                             
               <div class="form-group">
               <label>Kategori Berita</label>
                 <select name="KD_KATEGORI" class="form-control">
                      <?php
						do {  ?>
                      <option value="<?php echo $row_rsKtg['KD_KATEGORI']?>"><?php echo $row_rsKtg['NAMA']?></option>
                      <?php
						} while ($row_rsKtg = mysqli_fetch_assoc($rsKtg));
 						 $rows = mysqli_num_rows($rsKtg);
  						if($rows > 0) {
     					 mysqli_data_seek($rsKtg, 0);
	  					$row_rsKtg = mysqli_fetch_assoc($rsKtg);
 						}?>
                    </select>
                 </div>
                
               <div class="form-group">
                      <label>Image/Foto</label> (Maksimal 2 Mega Pixel)
                      <input name="filUpload" id="filUpload" class="form-control" type="file" size="100" />
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
                      <input type="text" name="TANGGAL" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" value="<?php echo date("Y-m-d H:m:s"); ?>">
                    </div><!-- /.input group -->
                  </div>
              
              </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Publikasikan</button>
                  </div>
                <input type="hidden" name="MM_insert" value="form1" />
                <input name="txtKeyB" type="hidden" value="43kfr02738@geoportalkalsel" />
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

	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script> 
<?php
mysqli_free_result($rsKtg);
} ?>
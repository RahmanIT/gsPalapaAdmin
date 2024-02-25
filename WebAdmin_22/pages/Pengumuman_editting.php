<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_rsInfo = "SELECT KD, JUDUL, ISI FROM tb_info WHERE KD = $segmen4";
$rsInfo = mysqli_query($Congis, $query_rsInfo) or die(mysqli_error());
$row_rsInfo = mysqli_fetch_assoc($rsInfo);
$totalRows_rsInfo = mysqli_num_rows($rsInfo);
?>
<script type="text/javascript" src="<?php echo $nama_folder; ?>/Libs/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<div class="container-fluid">         
          
         <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Pengumuman
                            <small> bagikan informasi ke publik</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Pengumuman.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-info-circle"></i><a href="<?php echo $nama_folder; ?>/Pengumuman.html">Info</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Pengumuman
                            </li>
                        </ol>
                    </div>
                </div>
  		 <!-- end Page Heading -->
         
<!--========================================================================================= -->
	<div class="col-lg-8 text-left">
 	  <div class="panel panel-default">
   		<div class="panel-body">
		<!-------------------------------------------------------------------------------- -->                        
        <!-- Main content -->
      <section class="content">
          <!-- Default box -->
                    <form method="post" name="form1" action="<?php echo $nama_folder; ?>/Update-Pengumuman.jsp/">
    				<div class="form-group">
         				<label>Judul</label>
       					 <input name="JUDUL"  class="form-control" type="text" value="<?php echo $row_rsInfo['JUDUL']; ?>" placeholder="Judul Acara" size="50" maxlength="100" />
   					</div>
    				<div class="form-group">
          				<label>Keterangan</label>
              			<textarea name="ISI" cols="50" rows="10" class="form-control" placeholder="Rincian Acara"><?php echo $row_rsInfo['ISI']; ?></textarea> 
    				</div>
                    
    				<div class="box-footer" align="right">
        				 <button type="submit" class="btn btn-primary">Update Pengumuman</button>
   					 </div>
  					<input type="hidden" name="CREATED" value="<?php echo $_SESSION["NAMA"]; ?>">
  					<input type="hidden" name="TANGGAL" value="<?php echo date("Y-m-d H:m:s") ?>">
                    <input type="hidden" name="KD" value="<?php echo $row_rsInfo['KD']; ?>">
  					<input type="hidden" name="MM_update" value="form2">
				</form>
			</section>                   
		<!-------------------------------------------------------------------------------- -->
     </div>
   </div>
</div>        
<!--======================================================================================== -->
</div><!-- end  container-fluid-->

<script>
	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script>
<?php
mysqli_free_result($rsInfo);
} ?>
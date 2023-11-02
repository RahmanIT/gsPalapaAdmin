<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
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
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-info-circle"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/Pengumuman.html">Info</a>
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
                    <form method="post" name="form1" action="<?php echo $nama_folder; ?>/pengumuman.jsp/">
    				<div class="form-group">
         				<label>Judul</label>
       					 <input name="JUDUL"  class="form-control" type="text" value="" placeholder="Judul Pengumuman" size="50" maxlength="100" />
   					</div>
    				<div class="form-group">
          				<label>Keterangan</label>
              			<textarea name="ISI" cols="50" rows="10" class="form-control" placeholder="Rincian Pengeumuman"></textarea> 
    				</div>
                    
    				<div class="box-footer" align="right">
        				 <button type="submit" class="btn btn-primary">Posting Pengumuman</button>
   					 </div>
  					<input type="hidden" name="CREATED" value="<?php echo $_SESSION["NAMA"]; ?>">
  					<input type="hidden" name="TANGGAL" value="<?php echo date("Y-m-d H:m:s") ?>">
  					<input type="hidden" name="MM_insert" value="form1">
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
<?php } ?>
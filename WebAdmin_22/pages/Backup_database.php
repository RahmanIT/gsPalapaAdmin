<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Backup <small>backup basisidata Webportal</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="../../WebAdmin/pages/Backupdb.jsp">Backup DB</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
 
                <!--============================================================================ -->
                <div class="col-lg-12 text-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-database"></i> Arsip Basisdata</h3>
                        </div>
                        <div class="panel-body">
                           
                             <div class="col-lg-4"> 
                              <div class="form-group">
                      			
               				  </div>
                         
                            </div> 
                            <!----------- BOX TENGAH loadng-->
                            <div class="col-lg-4" align="center"> 
                              <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                            </div> 
                            <!---------- Box Atas Kanan Navigasi Halaman----------------------------> 
                            <div class="col-lg-4" align="right"> 
                              
                            </div>
                            <!-------------- Awal Box 12 ----------------->
                            <div class="col-lg-12" id="linkList1"></div>
                            <!--------------- Akhir Box 12----------------->
                            
                        </div>
                    </div>
                </div>                                           
</div>
  <!-- /#page-wrapper -->
<p>&nbsp;</p>
<script>
	document.getElementById("config01").className = "active";
	document.getElementById("Manage1").className = "collapse in";
</script>
<?php } ?>
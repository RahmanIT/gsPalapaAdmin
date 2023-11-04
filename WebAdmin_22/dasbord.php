<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>  
  <div class="container-fluid">
 <!-- Page Heading -->
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Dasbord
                            <small> Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
							<li class="active">
                                <i class="fa fa-dashboard"></i>  <a href="../WebAdmin/home">Dashboard</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!--============================================================================ -->

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">                                       
                                        <?php $User1  = mysqli_result(mysqli_query($Congis, "SELECT COUNT(ip) FROM tstatistika"), 0); echo $User1; // ?>
                                       
                                        </div>
                                        <div>Pengunjung!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Pengunjung.html" >
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-code fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php $User2  = mysqli_result(mysqli_query($Congis, "SELECT COUNT(NAMA) FROM tb_peta"), 0); echo $User2; // ?>
                                        </div>
                                        <div>Metadata!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Metadata.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-map-marker fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                          <?php $User3  = mysqli_result(mysqli_query($Congis, "SELECT count(KD_FILE) FROM tb_shafile_zip"), 0); echo $User3; // ?>
                                        </div>
                                        <div>Shapefile!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/UploadPeta.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-download fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge">
                                         <?php $Dwn4  = mysqli_result(mysqli_query($Congis, "SELECT count(*) FROM tb_user_download"), 0); echo $Dwn4; // ?>
                                         </div>
                                        
                                        <div>Download!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Download-trafic.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                
<!--============================================================================ -->                 
        		    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-globe fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge">
                                         <?php $Dwn4  = mysqli_result(mysqli_query($Congis, "SELECT count(ID) FROM tb_mapservice"), 0); echo $Dwn4; // ?>
                                         </div>
                                        
                                        <div>MapServis</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Peta.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>  
                   <!------------------------------------------------------->
        		    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-thumb-tack fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge">
                                         <?php $Dwn4  = mysqli_result(mysqli_query($Congis, "SELECT count(KD_LYR) FROM tb_feature_lyr"), 0); echo $Dwn4; // ?>
                                         </div>
                                        
                                        <div>Feature</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Feature.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>  
                   <!------------------------------------------------------->                     
       		    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-thumb-tack fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge">
                                         <?php $Dwn4  = mysqli_result(mysqli_query($Congis, "SELECT count(ID) FROM tb_user_petadwn"), 0); echo $Dwn4; // ?>
                                         </div>
                                        
                                        <div>Kartografi</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Feature.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>  
                   <!------------------------------------------------------->                     
       		    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge">
                                         <?php $Dwn4  = mysqli_result(mysqli_query($Congis, "SELECT count(KD_LYR) FROM tb_feature_lyr"), 0); echo $Dwn4; // ?>
                                         </div>
                                        
                                        <div>Giga Byte</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Feature.jsp">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>  
                   <!------------------------------------------------------->                     

 <!--============================================================================ -->
<div class="col-lg-12 text-left">
    <div class="panel panel-primary">
        <div class="panel-heading">
             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Traffic Kunjungan</h3>
        </div>
		<div class="panel-body">
             <div id="morris-area-chart"></div>
        </div>
	</div>
</div>
<!--################################################################################################################ -->  
<div class="col-lg-4 text-left">
    <div class="panel panel-success">
        <div class="panel-heading">
             <h3 class="panel-title"><i class="fa fa-download fa-fw"></i>Peta Diunduh</h3>
        </div>
       <div class="panel-body">
             <?php include('Dasbord_tb_pendaftar.php'); ?>
          <div class="text-right">
          	 <a href="<?php echo $nama_folder; ?>/WebAdmin/Download-Peta.jsp">Lihat Semua Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
       </div>
   </div>
</div>
 <!--============================================================================ -->
<div class="col-lg-4 text-left">
    <div class="panel panel-warning">
        <div class="panel-heading">
             <h3 class="panel-title"><i class="fa fa-bell fa-fw"></i>Riwayat Website</h3>
         </div>
       <div class="panel-body">
              <?php include('Dasbord_tb_alert.php'); ?>
           <div class="text-right">
          	 <a href="<?php echo $nama_folder; ?>/WebAdmin/Notification.html">Lihat Semua Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
       </div>
   </div>
</div>
 <!--============================================================================ -->
<div class="col-lg-4 text-center">
    <div class="panel panel-danger">
    	<div class="panel-heading">
             <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i>Pengunjung</h3>
         </div>
       <div class="panel-body">
           <?php include('Dasbird_tb_akses.php'); ?>
          <div class="text-right">
          	 <a href="<?php echo $nama_folder; ?>/WebAdmin/Pengunjung.html">Lihat Semua Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
       </div>

   </div>
</div>         
<!--################################################################################################################ -->
</div>
          
</div><!-- /#page-wrapper -->

<p>&nbsp;</p>

<script src="<?php echo $nama_folder; ?>/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo $nama_folder; ?>/js/plugins/flot/flot-data.js"></script>
<script>
document.getElementById("Dasbord01").className = "active";
</script>
<?php include('dasbord_trafic.php'); 
}?>   
<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_RstGeoServer = "SELECT SRV_ID, GeoServerName FROM tb_geoserver";
$RstGeoServer = mysqli_query($Congis, $query_RstGeoServer) or die(mysqli_error());
$row_RstGeoServer = mysqli_fetch_assoc($RstGeoServer);
$totalRows_RstGeoServer = mysqli_num_rows($RstGeoServer);
$query_RstGeoServer = "SELECT SRV_ID, GeoServerName FROM tb_geoserver";
$RstGeoServer = mysqli_query($Congis, $query_RstGeoServer) or die(mysqli_error());
$row_RstGeoServer = mysqli_fetch_assoc($RstGeoServer);
$totalRows_RstGeoServer = mysqli_num_rows($RstGeoServer);
?>
<style>
#AddFeture{
	position: fixed;
	height:auto;
	display:none;	 
}
</style>
<script>
function TampilkanMapService(){
  var pg = document.getElementById("CboServer").value;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/ServerMapServiceData.jsp/",
	data: "Srv="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};
	document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Data Geospasial <small>daftar map servis yang ada di geodatabse server</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa fa-pencil"></i><a href="../../WebAdmin/pages/ServerMapService.jsp">GeoServer</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
 
                <!--============================================================================ -->
                <div class="col-lg-12 text-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Kelola Map Servis</h3>
                        </div>
                        <div class="panel-body">
                           
                             <div class="col-lg-4"> 
                              <div class="form-group">
                      			<select name="CboServer" id="CboServer" onchange="TampilkanMapService()" class="form-control">
                      			  <option value="none">Pilih Geo Server</option>
                      			  <?php do { ?>
                      			  <option value="<?php echo $row_RstGeoServer['SRV_ID']?>"><?php echo $row_RstGeoServer['GeoServerName']?></option>
                      			  <?php
									} while ($row_RstGeoServer = mysqli_fetch_assoc($RstGeoServer));
									  $rows = mysqli_num_rows($RstGeoServer);
									  if($rows > 0) {
										  mysqli_data_seek($RstGeoServer, 0);
										  $row_RstGeoServer = mysqli_fetch_assoc($RstGeoServer);
									  }
									?>
                                </select>
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
<?php
mysqli_free_result($RstGeoServer);
 } ?>
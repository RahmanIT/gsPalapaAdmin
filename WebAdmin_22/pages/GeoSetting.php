<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_rsSetting = "SELECT * FROM st_geovista WHERE Id = 1";
$rsSetting = mysqli_query($Congis,$query_rsSetting) or die(mysqli_error());
$row_rsSetting = mysqli_fetch_assoc($rsSetting);
$totalRows_rsSetting = mysqli_num_rows($rsSetting);
?>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Pengaturan Map
                            <small> configurasi Geovista Web GIS</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-gear"></i><a href="../../WebAdmin/pages/MapSetting.jsp">Geovista</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> General
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <form action="<?php echo $nama_folder; ?>/Geovista-Seting/save" method="POST" enctype="multipart/form-data" name="FormSetting">
               <div class="col-lg-6 text-left">
                    <div class="panel panel-danger">
                    	<div class="panel-heading">
                            Pengaturan Default Aplikasi Geovista Web GIS
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
              					<div class="form-group">
                      				<label>Nama Aplikasi</label>
                     				 <input name="NAMA_APP" class="form-control" type="text" value="<?php echo $row_rsSetting['G_NAME']; ?>" placeholder="Nama Aplikasi" size="50" maxlength="100" />
               					</div> 
               					<div class="form-group">
                      				<label>Diskripsi Aplikasi</label>
                     				 <input name="DISKRIP_APP" type="text" class="form-control" id="SDISKRIP_APP" placeholder="Keterangan Aplikasi" value="<?php echo $row_rsSetting['G_DISKRIPTION']; ?>" size="50" maxlength="100" />
               					</div>                                   
                                <div class="col-lg-6 text-left">
                                    <div class="form-group">
                                        <label>Latitude (X)</label>
                                         <input name="C_LAT" class="form-control" type="text" value="<?php echo $row_rsSetting['C_LAT']; ?>" placeholder="Latitude" size="50" maxlength="25" />
                                    </div>                                
                                </div>
                                <div class="col-lg-6 text-left">
                                    <div class="form-group">
                                        <label>Longitude (Y)</label>
                                         <input name="C_LONG" class="form-control" type="text" value="<?php echo $row_rsSetting['C_LONG']; ?>" placeholder="Longitude" size="50" maxlength="25" />
                                    </div> 
                                </div>
                                
                                <div class="col-lg-6 text-left">
                                <label>Zoom Level</label>
                                <select name="C_ZOOM" class="form-control">
                                  <option value="4" <?php if (!(strcmp(4, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 4</option>
                                  <option value="5" <?php if (!(strcmp(5, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 5</option>
                                  <option value="6" <?php if (!(strcmp(6, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 6</option>
                                  <option value="7" <?php if (!(strcmp(7, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 7</option>
                                  <option value="8" <?php if (!(strcmp(8, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 8</option>
                                  <option value="9" <?php if (!(strcmp(9, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 9</option>
                                  <option value="10" <?php if (!(strcmp(10, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 10</option>
                                  <option value="11" <?php if (!(strcmp(11, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 11</option>
                                  <option value="12" <?php if (!(strcmp(12, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 12</option>
								  <option value="12" <?php if (!(strcmp(13, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 13</option>
								  <option value="12" <?php if (!(strcmp(14, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 14</option>
								  <option value="12" <?php if (!(strcmp(15, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 15</option>
								  <option value="12" <?php if (!(strcmp(16, $row_rsSetting['C_ZOOM']))) {echo "selected=\"selected\"";} ?>>Level 16</option>
                                </select>
                                </div>
                                
               					<div class="col-lg-6 text-left">
                                <label>Peta Dasar</label> 
               					<select name="BASEMAP" class="form-control">
               					  <option value="topo" <?php if (!(strcmp("topo", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Topographic</option>
               					  <option value="hybrid" <?php if (!(strcmp("hybrid", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Imagery with Labels</option>
               					  <option value="satellite" <?php if (!(strcmp("satellite", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Imagery</option>
               					  <option value="gray" <?php if (!(strcmp("gray", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Dark Gray Canvas</option>
               					  <option value="oceans" <?php if (!(strcmp("oceans", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Oceans</option>
               					  <option value="osm" <?php if (!(strcmp("osm", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>OpenStreetMap</option>
               					  <option value="national-geographic" <?php if (!(strcmp("national-geographic", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>National Geographic</option>
               					  <option value="rbi" <?php if (!(strcmp("rbi", $row_rsSetting['BASEMAP']))) {echo "selected=\"selected\"";} ?>>Rupa Bumi Indonesia</option>
                                </select>
                                </div>                                                                                      
                         </div>
                          <br>
                         <div class="form-group">
                            <label>Batas Admin Desa URL</label>
                             <input name="DESA_URL" type="text" class="form-control" id="DESA_URL" placeholder="URL API Batas Desa" value="<?php echo $row_rsSetting['DESA_URL']; ?>" size="50" maxlength="255" />
                        </div>
                        <div class="form-group">
                            <label>Batas Admin Desa Layer Name</label>
                             <input name="DESA_PARAM" type="text" class="form-control" id="DESA_PARAM" placeholder="Layer Name Batas Desa" value="<?php echo $row_rsSetting['DESA_PARAM']; ?>" size="50" maxlength="255" />
                        </div>  
                        <hr />
                        <div class="form-group">
                            <label>Batas Admin Kecamatan URL</label>
                             <input name="KECAMATAN_URL" type="text" class="form-control" id="KECAMATAN_URL" placeholder="URL API Batas Kecamatan" value="<?php echo $row_rsSetting['KECAMATAN_URL']; ?>" size="50" maxlength="255" />
                        </div>
                        <div class="form-group">
                            <label>Batas Admin Kecamatan Layer Name</label>
                             <input name="KECAMATAN_PARAM" type="text" class="form-control" id="KECAMATAN_PARAM" placeholder="Layer Name Batas Kecamatan" value="<?php echo $row_rsSetting['KECAMATAN_PARAM']; ?>" size="50" maxlength="255" />
                        </div>  
                        <hr />
                        <div class="form-group">
                            <label>Batas Admin Kecamatan URL</label>
                             <input name="KABUPATEN_URL" type="text" class="form-control" id="KABUPATEN_URL" placeholder="URL API Batas Kabupaten" value="<?php echo $row_rsSetting['KABUPATEN_URL']; ?>" size="50" maxlength="255" />
                        </div>
                        <div class="form-group">
                            <label>Batas Admin Kecamatan Layer Name</label>
                             <input name="KABUPATEN_PARAM" type="text" class="form-control" id="KABUPATEN_PARAM" placeholder="Layer Name Batas Kabupaten" value="<?php echo $row_rsSetting['KABUPATEN_PARAM']; ?>" size="50" maxlength="255" />
                        </div>   
                   </div>
                      <div class="panel-footer" align="right">
                           &nbsp;
                      </div>
                </div>
                
             </div> 
               <!------------------------------------------------------------------------------------------------>
                <div class="col-lg-6 text-left">
                	<div class="panel panel-danger">
                        <div class="panel-heading">
                            Peta Dasar Rupa Bumi Indonesia
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                      				<label>Nama Peta Dasar</label>
               				  <input name="DF_BASENAME" type="text" class="form-control" id="DF_BASENAME" placeholder="BaseMap Name" value="<?php echo $row_rsSetting['DF_BASENAME']; ?>" size="50" maxlength="100" />
               				</div>
                            <div class="form-group">
                      				<label>URL Peta Dasar</label>
                     				<input name="DF_BASEMAP" type="text" class="form-control" id="DF_BASEMAP" placeholder="BaseMap Service url" value="<?php echo $row_rsSetting['DF_BASEMAP']; ?>" size="50" maxlength="100" />
               				</div>
                            <div class="form-group">
                            	<img src="data:image/png;base64,<?php echo $row_rsSetting['DF_BASEMAPIMG']; ?>" width="150" height="100" />
                                <input name="filUpload" id="filUpload" type="file" />
                            </div>
                          </div>                           
                        <div class="panel-footer" align="right">
                             <button type="submit" class="btn btn-lg btn-primary">Update Setting</button>
                        </div>
                    </div>
                	
                </div> 
               <!--============================================================================================ -->
               <input type="hidden" name="MM_update2" value="FormSetting" />
               <input type="hidden" name="KD" value="<?php echo $row_rsSetting['Id']; ?>" />
               </form>
</div>


<p>&nbsp;</p>

<script>
document.getElementById("vista01").className = "active";
document.getElementById("Manage2").className = "collapse in";
</script>
<?php
mysqli_free_result($rsSetting);
 } ?>
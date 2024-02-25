<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$query_rsSetting = "SELECT * FROM tb_setting WHERE KD_SET = 1";
$rsSetting = mysqli_query($Congis, $query_rsSetting) or die(mysqli_error());
$row_rsSetting = mysqli_fetch_assoc($rsSetting);
$totalRows_rsSetting = mysqli_num_rows($rsSetting);
?>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Management
                            <small> setting informasi dasar website</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_WebPortal.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/pages/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-gear"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/pages/Setting.html">Managemant</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> General
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <form action="<?php echo $nama_folder; ?>/Managemant_conf.php" method="POST" enctype="multipart/form-data" name="FormSetting">
               <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="box-body">
              					<div class="form-group">
                      				<label>Nama Bidang</label>
                     				 <input name="NAMA_ORG" class="form-control" type="text" value="<?php echo $row_rsSetting['NAMA_ORG']; ?>" placeholder="Nama Bidang" size="50" maxlength="100" />
               					</div> 
               					<div class="form-group">
                      				<label>Nama Singkat Lembaga</label>
                     				 <input name="SINGKATAN_ORG" type="text" class="form-control" id="SINGKATAN_ORG" placeholder="Nama Singkat Organisasi" value="<?php echo $row_rsSetting['SINGKATAN_ORG']; ?>" size="50" maxlength="100" />
               					</div>   
               					<div class="form-group">
                      				<label>Alamat Instansi</label>
                     				 <input name="ALAMAT" class="form-control" type="text" value="<?php echo $row_rsSetting['ALAMAT']; ?>" placeholder="Alamat Organisasi" size="50" maxlength="100" />
               					</div>  
               					<div class="form-group">
                      				<label>Telpon</label>
                     				 <input name="TELPON" class="form-control" type="text" value="<?php echo $row_rsSetting['TELPON']; ?>" placeholder="Alamat Organisasi" size="50" maxlength="100" />
               					</div>                                                                                                                              
                         </div>
                   </div>
                </div>
                </div> 
               <!------------------------------------------------------------------------------------------------>
                <div class="col-lg-6 text-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="box-body">
              					<div class="form-group">
                      				<label>Email</label>
                     				 <input name="EMAIL1" class="form-control" type="text" value="<?php echo $row_rsSetting['EMAIL']; ?>" placeholder="Email Organisasi" size="50" maxlength="100" />
               					</div> 
               					<div class="form-group">
                      				<label>Email Domain</label>
                     				 <input name="EMAIL_DOMAIN" class="form-control" type="text" value="<?php echo $row_rsSetting['EMAIL_DOMAIN']; ?>" placeholder="Email Domain" size="50" maxlength="100" />
               					</div>   
               					<div class="form-group">
                      				<label>Domain Name</label>
                     				 <input name="DOMAIN" class="form-control" type="text" value="<?php echo $row_rsSetting['DOMAIN']; ?>" placeholder="Alamat Organisasi" size="50" maxlength="100" />
               					</div>  
               					<div class="form-group">
                      				<label>Nama Organisasi</label>
                     				 <input name="NAMA_PT" class="form-control" type="text" value="<?php echo $row_rsSetting['NAMA_PT']; ?>" placeholder="Alamat Organisasi" size="50" maxlength="100" />
               					</div>                                                                                                                              
                         </div>
                         </div>
                   </div>
                </div>
               <!-- ========================================================================================== -->
					<div class="col-lg-3 text-left">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                     				 <label>Server DB</label>
                      				<input name="TxtFtpSrvA" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id1']; ?>" />
               					</div>
                                <div class="form-group">
                     				 <label>Default ID</label>
                      				<input name="TxtIDFtpSrvA" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id1Ui']; ?>" />
               					</div>
                                <div class="form-group">
                     				 <label>Default Password</label>
                      				<input name="TxtPwdFtpSrvA" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id1Ps']; ?>" />
               					</div>   
                            </div>
                        </div>
                    </div>               
               <!---------------------------------------------------------------------------------------------- -->
					<div class="col-lg-3 text-left">
                        <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
               				    <label>Geoserver</label>
                   				  <input name="TxtFtpSrvB" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id2']; ?>" />
               					</div>
                              <div class="form-group">
               				    <label>Default ID</label>
                   				  <input name="TxtIDFtpSrvB" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id2Ui']; ?>" />
               					</div>
                              <div class="form-group">
               				    <label>Default Password</label>
                   				  <input name="TxtPwdFtpSrvB" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id2Ps']; ?>" />
               					</div>   
                            </div>
                        </div>
                    </div>               
               <!---------------------------------------------------------------------------------------------- -->
            	<div class="col-lg-3 text-left">
                        <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
               				    <label>Geoservice</label>
                   				  <input name="TxtFtpSrvC" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id3']; ?>" />
               					</div>
                              <div class="form-group">
               				    <label>Default ID</label>
                   				  <input name="TxtIDFtpSrvC" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id3Ui']; ?>" />
               					</div>
                              <div class="form-group">
               				    <label>Default Password</label>
                   				  <input name="TxtPwdFtpSrvC" type="text" class="form-control" value="<?php echo $row_rsSetting['ftp_id3Ps']; ?>" />
               				  </div> 
                                                               
                            </div>
                        </div>
                    </div>               
               <!---------------------------------------------------------------------------------------------- -->
					<div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                               <img name="" src="<?php echo $nama_folder; ?>/<?php echo $row_rsSetting['LOGO']; ?>" width="60" height="60" alt="" />
                                <div class="form-group">
                     				 <label>Logo</label>
                      				<input name="filUpload" id="filUpload" class="form-control" type="file" size="100" />
               					</div>  
                                <div class="form-group">
               				    <label>Temp Local Folder</label>
                   				  <input name="TxtTempDirSrvC" type="text" class="form-control" value="<?php echo $row_rsSetting['ftpTemp_DIR']; ?>" />
               					</div>  
                            </div>
                        </div>
                    </div>               
               <!---------------------------------------------------------------------------------------------- -->
               <div class="col-lg-12 text-right">
                     <div class="panel panel-default">
                         <div class="panel-body">
                                <button type="submit" class="btn btn-lg btn-primary">Update Setting</button>
                         </div>
                     </div>
                 </div>
               <!--============================================================================================ -->
               <input type="hidden" name="MM_update" value="FormSetting" />
               <input type="hidden" name="KD_SET" value="1" />
           </form>
</div>
<p>&nbsp;</p>

<script>
document.getElementById("config01").className = "active";
document.getElementById("Manage1").className = "collapse in";
</script>
<?php
 } ?>
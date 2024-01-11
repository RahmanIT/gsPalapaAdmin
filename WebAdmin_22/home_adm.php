<?php
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
   $_SESSION['P'] = NULL;
  $_SESSION['MM_User'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['MM_RoleData'] = NULL;
  $_SESSION['NAMA_USER'] = NULL;
  $_SESSION['NAMA'] = NULL;
  $_SESSION['NO_ANGGOTA'] = NULL;
  $_SESSION['AKT'] = NULL;
  $_SESSION['KdUser']= NULL;
   unset($_SESSION['P']);
  unset($_SESSION['MM_User']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['MM_RoleData']);
  unset($_SESSION['NAMA_USER']);
  unset($_SESSION['NAMA']);
  unset($_SESSION['NO_ANGGOTA']);
  unset($_SESSION['AKT']);
  unset($_SESSION['KdUser']);

  $logoutGoTo = "/WebAdmin/login";
  if ($logoutGoTo) {
    	?>
		<script type="text/javascript">
		  window.location = "<?php echo $nama_folder; ?>/home";
		 </script>
  	<?php
	exit;
  }
}

if(($P[0]['NAMA']!="") && ($P[0]["INISIAL"]<>"") && ($P[0]["ROLE"] > 1) && ($P[0]["ROLE"] < 4)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="SJIG Prov Kalsel">
	<link rel="shortcut icon" href="<?php echo $nama_folder; ?>/images/geoportal.png" />
    <title>C-Panel Web Admin</title>
    <!-- Bootstrap Core CSS -->
    <style>
	 .MsgHaspus{
		 position: fixed;
		 max-width:300px;
		 height:auto;
		 display:none;
		 background:#FFF;	 
	 }
	</style>
    <link href="<?php echo $nama_folder; ?>/Libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $nama_folder; ?>/Libs/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo $nama_folder; ?>/Libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.js"></script>
<script>
function Hapus(ps,nm,k){
  var winW = window.innerWidth;
  $("#CmdEditPwd").hide();
  $("#CmdOkeDel").show();
  document.getElementById("PnlTitle").innerHTML = "Hapus Data";
  document.getElementById("KodeHapus").value =k;
  document.getElementById("NamaHapus").value = nm;
  document.getElementById("PsnHapus").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("PsnHapus").style.top = "200px";
  document.getElementById("PsnHapus").style.display= "inherit";
  document.getElementById("IsiPesanHapus").innerHTML = "Anda yakin menghapus <b>"+ ps+"<b>";
}

function EditSandi(){
  var winW = window.innerWidth;
  $("#CmdEditPwd").show();
  $("#CmdOkeDel").hide();
  document.getElementById("PnlTitle").innerHTML = "Edit Sandi";
  document.getElementById("PsnHapus").style.left = (winW/2) - (300 * .5)+"px";
  document.getElementById("PsnHapus").style.top = "200px";
  document.getElementById("PsnHapus").style.display= "inherit";
  document.getElementById("IsiPesanHapus").innerHTML = '<input id="TxtNewPwd" class="form-control" type="text"  size="30" />';
}

function BatalHapus(){
  document.getElementById("PsnHapus").style.display= "none"
}

function HapusData(){
	BatalHapus();
	var p = document.getElementById("KodeHapus").value;
	var Nm = document.getElementById("NamaHapus").value;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/Hapus-"+Nm+".jsp/",
	data: "p="+p,
	cache: false,
	success: function(msg){
		if(msg==0){
		  TampilkanTabel();
		}
		$("#loding").hide();
		}
	});
};

function EditDataSandi(){
	var Nm = document.getElementById("TxtNewPwd").value;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/AdminSandi.jsp/",
	data: "Snd="+Nm,
	cache: false,
	success: function(msg){
		document.getElementById("IsiPesanHapus").innerHTML = msg;
		$("#CmdEditPwd").hide();
		$("#loding").hide();
		}
	});
};
</script> 
</head>
<body>
<input name="KodeHapus" id="KodeHapus" type="hidden" value="0">
<input name="NamaHapus" id="NamaHapus" type="hidden" value="0">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Web Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i> <b class="caret"></b></a>
                    <?php 
					    $str1 = date('Ymd')."#".date('H')."#".$P[0]['EMAIL']."#".$P[0]['KD_USER']."#";
					    $kunci = '979a218e0632df2935317f98d47956c7';						
						for ($i = 0; $i < strlen($str1); $i++) {
							$karakter = substr($str1, $i, 1);
							$kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
							$karakter = chr(ord($karakter)+ord($kuncikarakter));
							$hasil .= $karakter;
						}
						$keyL = urlencode(base64_encode($hasil));
					?>
                    <ul class="dropdown-menu message-dropdown">
                        <li>
                            <a href="<?php echo $conf["GeoServisDomain"]; ?>/ReLogin/index?key=<?php echo $keyL; ?>" target="_blank"><i class="fa fa-fw fa-globe"></i>Geo Servis</a>
                        </li>
                        <li>
                            <a href="/WebPortal/GeoVista/" target="_blank"><i class="fa fa-fw fa-globe"></i>Geovista</a>
                        </li>
<?php /*?>                        <li>
                            <a href="http://sip.kalsel-sdi.web.id/Trasmisi/login?key=<?php echo $keyL; ?>" target="_blank"><i class="fa fa-fw fa-globe"></i>Spasial Anlisis</a>
                        </li><?php */?>
                        <li>
                            <a href="<?php echo $conf["Geoserver"]; ?>/web" target="_blank"><i class="fa fa-fw fa-tasks"></i>Geoserver A</a>
                        </li>
                        <li>
                            <a href="https://geoportal.kalselprov.go.id/arcgis/rest/services/Kalsel" target="_blank"><i class="fa fa-fw fa-tasks"></i>Arcgis Server</a>
                        </li>
                        <li>
                            <a href="/WebPortal/" target="_blank"><i class="fa fa-fw fa-th-large"></i>WebPortal</a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php include('Pesan_toolbar.php');  ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                       <?php include('Alert_toolbar.php'); ?>
                          <li class="divider"></li>
                        <li>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Notification.html">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['MM_User']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/EditProfile.jsp"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li>
                            <a onClick="EditSandi()"><i class="fa fa-fw fa-key"></i>Ganti Password</a>
                        </li>
                        <?php if($P[0]["ROLE"]==2){?>
                        <li>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Pesan.html"><i class="fa fa-fw fa-envelope"></i>Pesan Masuk</a>
                        </li>
                        <li>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/Manajemen-Web.jsp"><i class="fa fa-fw fa-gear"></i> Pengaturan</a>
                        </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $nama_folder; ?>/WebAdmin/home.html/?doLogout=true"><i class="fa fa-fw fa-power-off"></i> Keluar C-Panel</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
 		           <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                  <li id="Dasbord01" class="">
                        <a href="<?php echo $nama_folder."/WebAdmin/"; ?>home.jsp"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                  </li>
                  <li id="peta02" class="">
                        <a  href="<?php echo $nama_folder."/WebAdmin/"; ?>JDSN.jsp"><i class="fa fa-fw fa-tasks"></i>Server JDSN</a>
                  </li>  
                  <li id="Basemap" class="">
                        <a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Basemap.jsp"><i class="fa fa-fw fa-th-large"></i>Basemap</a>
                  </li> 
                  <?php if($P[0]["ROLE"]==2){?>
                  <li id="Basemap" class="">
                        <a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Layer.jsp"><i class="fa fa-fw fa-map-marker"></i>Layer</a>
                  </li>  
                  <li id="vista01" class="">
                    <a href="javascript:;" data-toggle="collapse" data-target="#Manage2"><i class="fa fa-fw fa-globe"></i>Geovista<i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="Manage2" class="collapse">
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Peta.jsp"><i class="fa fa-fw fa-map-marker"></i>Publikasi Peta</a></li> 
                            <?php if($P[0]["ROLE"]==2){?>
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Setting-Map.jsp"><i class="fa fa-fw fa-wrench"></i>Pengaturan Map</a></li> 
                            <?php } ?>
                            
                        </ul>
                   </li>
                  <?php }?>
                 <li id="AppGIs01" class="">
                    <a href="javascript:;" data-toggle="collapse" data-target="#AppGIs"><i class="fa fa-fw fa-database"></i>Web APP<i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="AppGIs" class="collapse">
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>WebApp.jsp"><i class="fa fa-fw fa-map-marker"></i>GIS App</a></li> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>WebAppData.jsp"><i class="fa fa-fw fa-wrench"></i>GIS App Layers</a></li> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>GeoTagging.jsp"><i class="fa fa-fw fa-wrench"></i>GeoTagging</a></li> 
                        </ul>
                   </li>
                   <li id="config02">
                   <a href="javascript:;" data-toggle="collapse" data-target="#Manage3"><i class="fa fa-fw fa-file"></i>Web Berita<i class="fa fa-fw fa-caret-down"></i></a>
                       <ul id="Manage3" class="collapse">
                             <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Berita.jsp"><i class="fa fa-fw fa-file-text"></i>Berita</a></li>
                             <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Pengumuman.html"><i class="fa fa-fw fa-info"></i>Pengumuman</a></li>
                              <?php if($P[0]["ROLE"]==2){?> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Agenda.html"><i class="fa fa-fw fa-calendar"></i>Agenda</a></li>                             
                            <?php }?>
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Upload-Images.jsp"><i class="fa fa-fw fa-image"></i>Upload Image</a></li> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Unggah.jsp"><i class="fa fa-fw fa-download"></i>Download</a></li>  
                       </ul>                                           
                   </li>
                    <?php if($P[0]["ROLE"]==2){?> 
                   <li id="data02" class="">
                    <a href="javascript:;" data-toggle="collapse" data-target="#Data2"><i class="fa fa-fw fa-cloud"></i>Data Spasial<i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="Data2" class="collapse">
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>ServerMapService.jsp"><i class="fa fa-fw fa-map-marker"></i>GeoServer</a></li> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>UploadPeta.jsp"><i class="fa fa-fw fa-wrench"></i>Upload SHP</a></li> 
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>KelolaPeta.jsp"><i class="fa fa-fw fa-globe"></i>Geospasial Edit</a></li>
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Metadata.jsp"><i class="fa fa-fw fa-code"></i>Metadata</a></li>
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>MapServis.jsp"><i class="fa fa-fw fa-map-marker"></i>WMS</a></li> 
                  			<li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>Feature.jsp"><i class="fa fa-fw fa-thumb-tack"></i>Peta Open Publik</a></li>
                        </ul>
                   </li>               
                   <li id="config01">
                    <a href="javascript:;" data-toggle="collapse" data-target="#Manage1"><i class="fa fa-fw fa-gear"></i>Configurasi Web<i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="Manage1" class="collapse">
                           
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Manajemen-Web.jsp"><i class="fa fa-fw fa-gear"></i>Pengaturan Web</a></li>
                            <li><a  href="<?php echo $nama_folder."/WebAdmin/"; ?>SlideShow.jsp"><i class="fa fa-fw fa-th-large"></i>Slide Show</a></li> 
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Manajemen-kategori.jsp" ><i class="fa fa-fw fa-th-list"></i>Kategori</a></li>
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Binder.html"><i class="fa fa-fw fa-tasks"></i>Binder</a></li>
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>link.html"><i class="fa fa-fw fa-link"></i>Link</a></li>
                             <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>SosialMedia.jsp"><i class="fa fa-fw fa-instagram"></i>Sosial Media</a></li>
                            
                           <?php /*?> <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Manajemen-Users.jsp"><i class="fa fa-fw fa-user"></i>User Admin</a></li><?php */?>
                            <li><a href="<?php echo $nama_folder."/WebAdmin/"; ?>Backupdb.jsp" ><i class="fa fa-fw fa-database"></i>Backup DB</a></li>
                        </ul>
                    </li>   
				<?php }?>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
   
        <div id="page-wrapper">

             <?php 
				switch ($segmen3) { 	
			//=====================  UNIT KLIRING ========================	
				case "KelolaPeta.jsp" : 
	 				include('pages/KelolaPeta.php'); 
					break;	
				case "UploadPeta.jsp" : 
	 				include('pages/UploadPetaSHPzip.php'); 
					
					break;		
				case "ServerMapService.jsp" : 
	 				include('pages/Server_MapService.php'); 
					break;		
				
				case "MapServis.jsp" : 
	 				include('pages/MapServis_list.php'); 
					break;
				case "WebApp.jsp" : 
	 				include('pages/WebAPP.php'); 
					break;
				case "Basemap.jsp" : 
	 				include('pages/Basemap.php'); 
					break;
				case "Layer.jsp" : 
	 				include('pages/Layer.php'); 
					break;	
		//=====================  WEB MANAJEMANT ========================
			case "SosialMedia.jsp" : 
	 		    	include('pages/Manage_Sosmed.php'); 
					break;		
			
			  case "SlideShow.jsp" : 
	 				include('pages/Slide_Show.php'); 
					break;
			  case "JDSN.jsp" : 
	 				include('pages/jign.php'); 
					break;	
				case "Metadata.jsp" : 
	 				include('pages/Metadata_list.php'); 
					break;
				case "Add-Metadata.jsp" : 
	 				include('pages/Metadata_Create.php'); 
					break;
				case "Edit-Metadata.jsp" : 
	 				include('pages/Metadata_editting.php'); 
					break;

				case "Feature.jsp" : 
	 				include('pages/Feature.php'); 
					break;
				case "Add-Feature.jsp" : 
	 				include('pages/Feature_Add.php'); 
					break;
				case "Edit-Feature.jsp" : 
	 				include('pages/Feature_editting.php'); 
					break;
					
			  case "Berita.jsp" : 
	 				include('pages/berita_list.php'); 
					break; 
			  case "Tulis-Berita.jsp" : 
	 				include('pages/berita_create.php'); 
					break; 
			  case "EditBerita" : 
	 				include('pages/berita_editting.php'); 
					break;
										
			  case "Agenda.html" : 
	 				include('pages/agenda_list.php'); 
					break;
			  case "Buat-Agenda.html" : 
	 				include('pages/agenda_create.php'); 
					break;
			  case "EditAgenda" : 
	 				include('pages/agenda_editting.php'); 
					break;					
		     case "Pengumuman.html" : 
	 		    	include('pages/Pengumuman_list.php'); 
					break;
			 case "Buat-Pengumuman.html" : 
	 		    	include('pages/Pengumuman_create.php'); 
					break;
			 case "EditPengumuman" : 
	 		    	include('pages/Pengumuman_editting.php'); 
					break;
				
		    case "Peta.jsp" : 
	 		    	include('pages/PetaServis.php'); 
					break;
			case "WebAppData.jsp" : 
	 		    	include('pages/WebAppData.php'); 
					break;			
					
			 case "link.html" : 
	 		    	include('pages/link_list.php'); 
					break;

			 case "Binder.html" : 
	 		    	include('pages/binder_list.php'); 
					break;

			 case "Unggah.jsp" : 
	 		    	include('pages/Download_file.php'); 
					break;
				 
			 case "Manajemen-Web.jsp" : 
	 		    	include('pages/Manage_Setting.php'); 
					break;	
			case "Manajemen-kategori.jsp" : 
	 		    	include('pages/Manage_Kategoori.php'); 
					break;		 
			case "Manajement-MenuUtama.jsp" : 
	 		    	include('pages/Manage_MenuUtama.php'); 
					break;					
			case "Manajement-SubMenu.jsp" : 
	 		    	include('pages/Manage_SubMenui.php'); 
					break;
			case "Manajement-Sosmed.jsp" : 
	 		    	include('pages/Manage_Sosmed.php'); 
					break;	
												
			case "Pengunjung.html" : 
	 		    	include('pages/Pengunjung_id.php'); 
					break;	
			case "Pesan.html" : 
	 		    	include('pages/Pesan_user.php'); 
					break;	
			case "Notification.html" : 
	 		    	include('pages/NotifcationApp.php'); 
					break;						
													
			case "Upload-Images.jsp" : 
	 		    	include('pages/Upload_images.php'); 
					break;								
			case "Manajemen-Users.jsp" : 
	 		    	include('../backup/CODE_OLD/Manage_Users.php'); 
					break;			
			case "Download-trafic.jsp" : 
	 		    	include('pages/UserDownloadFileRecord.php'); 
					break;
			case "Download-Peta.jsp" : 
	 		    	include('pages/UserDownloadPetaRecord.php'); 
					break;							
			case "Setting-Map.jsp" : 
	 		    	include('pages/GeoSetting.php'); 
					break;
			case "EditProfile.jsp" : 
	 		    	include('pages/ProfileEdit.php'); 
					break;
			case "Backupdb.jsp" : 
	 		    	include('pages/Backup_database.php'); 
					break;
			
			case "GeoTagging.jsp" : 
	 		    	include('pages/WebApp_Geotagging.php'); 
					break;
																 
			default;
      			include('dasbord.php');
			}?> 
  <!-- --------------------MESAGE --------------- -->
 <div id="PsnHapus" class="MsgHaspus">
   <div class="panel panel-red">
       <div class="panel-heading">
            <h3 id="PnlTitle" class="panel-title">Hapus Data</h3>
       </div>
       <div class="panel-body" id="IsiPesanHapus">
             Panel content
       </div>
       <div class="panel-body" align="right">
       <button type="button" onClick="BatalHapus()" class="btn btn-warning">Close</button>
       <button type="button" id="CmdOkeDel" onClick="HapusData()" class="btn btn-danger">Oke</button>
        <button type="button" id="CmdEditPwd" onClick="EditDataSandi()" class="btn btn-danger">Update Sandi</button>
       </div>
   </div>
 </div>
<!-- --------------------END MESAGE------------ --> 
           
    </div>
    <!-- /#wrapper -->
</div>
    <!-- jQuery -->
    <script src="<?php echo $nama_folder; ?>/Libs/js/bootstrap.min.js"></script>
</body>
</html><?php } ?>
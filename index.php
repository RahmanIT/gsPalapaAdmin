<?php
if (!isset($_SESSION)) {
  session_start();
}
//error_reporting(0);
date_default_timezone_set('Asia/Makassar');
$url = explode("/",$_SERVER["REQUEST_URI"]);
$segmen1   = $url[1];
$segmen2   = $url[2];
$segmen3   = $url[3];
$segmen4   = $url[4];
$segmen5   = $url[5];
$segmen6   = $url[6];
require_once('app/Controller/_config.php');
$nama_folder = $conf["Folder"];
if(isset($_SESSION['P'])){
	$P = json_decode($_SESSION['P'], true);
}
require_once('Connections/Congis.php');

switch ($segmen2) {
case "files" : 
	 include('WebAdmin_22/library/file_render_FOTO.php'); 
	break;

case "images" : 
	 include('WebAdmin_22/library/file_render_FOTO_imges.php'); 
	break;

case "download" : 
	 include('WebAdmin_22/library/file_render_download.php'); 
	break;	
		
//---------------------------------------
case "Upload-pdf-save" : 
	 include('library/Download_post.php'); 
	break;
	
case "Upload-pdf-update" : 
	 include('library/Download_update.php'); 
	break;	

//================== GS-PALAPA ADMIN ==================
case "Upload-images-berita" : 
	 include('WebAdmin_22/module/UploadFhoto.php'); 
	break;
	
case "Geovista-Seting" : 
	 include('WebAdmin_22/module/Managemant_vista.php'); 
	break;	

case "FeatureKatalog.jsp" : 
	 include('WebAdmin_22/module/feature_Katalog.php'); 
	break;	
 
case "WebAdmin" : 
	 include('WebAdmin_22/realy_page.php'); 
	break;
case "simpe_login.jsp" : 
	 include('WebAdmin_22/module/login_admin.php'); 
	break;

case "basisdesa" : 
	include('library/CariLokasiDesa2.php'); 
	break;

case "_proxy" : 
	include('GeoserviceView/urlendoce.php'); 
	break;
//-----------  MENU WMS -------------------
case "MapServisJIGN_Lacak.jsp" : 
	 include('WebAdmin_22/module/MapServisJIGN_Lacak.php'); 
	break;
		
case "SimpanMapServisJIGN.jsp" : 
	 include('WebAdmin_22/module/MapServisJIGN_simpan.php'); 
	break;	

case "Hapus-MapServisJIGN.jsp" : 
	 include('WebAdmin_22/module/MapServisJIGN_Hapus.php'); 
	break;	
case "UpdateMapServisJIGN.jsp" : 
	 include('WebAdmin_22/module/MapServisJIGN_Update.php'); 
	break;	
//-------------------- FEATURE LAYER  --------------------
case "FeatureEdittoTools.jsp" : 
	 include('WebAdmin_22/FeauteEdittor.php'); 
	break;
case "TabelFeatureLayer.jsp" : 
	 include('WebAdmin_22/module/KelolaPetaFeature_tabel.php'); 
	break;
case "SimpanFeatureLayer.jsp" : 
	 include('WebAdmin_22/module/KelolaPetaFeaure_simpan.php'); 
	break;
case "HapusFeatureLayer.jsp" : 
	 include('WebAdmin_22/module/KelolaPetaFeature_delete.php'); 
	break;
case "UpdateFeatureLayer.jsp" : 
	 include('WebAdmin_22/module/KelolaPetaFeature_edit.php'); 
	break;	
//-------------------- UPLOAD FILE SHP ZIP -------------------
case "uploadSHP.jsp" : 
	 include('WebAdmin_22/module/shp_ftp_upload.php'); 
	break;
case "uploadSHPtabel.jsp" : 
	 include('WebAdmin_22/module/shp_ftp_upload_tabel.php'); 
	break;	
case "deleteSHP.jsp" : 
	 include('WebAdmin_22/module/shp_ftp_delete.php'); 
	break;
case "TransmiterSHPunZip.jsp" : 
	 include('WebAdmin_22/ftp_trnasmiter/ftpZipExtrakTransmit.php'); 
	break;	
case "EditSHPaksesOP.jsp" : 
	 include('WebAdmin_22/module/shp_ftp_UpdateAkses.php'); 
	break;		
//-------------------- MAP SERVIS JIGN ----------------
case "TabelMapServisJIGN.jsp" : 
	 include('WebAdmin_22/module/MapServisJIGN_tabel.php'); 
	break;	
//----------------------------------------------------
case "berita.jsp" : 
	 include('WebAdmin_22/module/berita_post.php'); 
	break;
case "TabelBerita.jsp" : 
	 include('WebAdmin_22/module/Berita_Tabel.php'); 
	break;
case "Update-Berita.jsp" : 
	 include('WebAdmin_22/module/berita_update.php'); 
	break;
case "Hapus-Berita.jsp" : 
	 include('WebAdmin_22/module/Berita_delete.php'); 
	break;
//----------------------------------------------------
case "TabelPeta.jsp" : 
	 include('WebAdmin_22/module/peta_tabel.php'); 
	break;
case "SimpanPeta.jsp" : 
	 include('WebAdmin_22/module/Peta_post.php'); 
	break;
case "UpdatePeta.jsp" : 
	 include('WebAdmin_22/module/Peta_Update.php'); 
	break;
case "Hapus-Peta.jsp" : 
	 include('WebAdmin_22/module/Peta_delete.php'); 
	break;
//----------------------------------------------------	
case "agenda.jsp" : 
	 include('WebAdmin_22/module/agenda_post.php'); 
	break;
case "TabelAgenda.jsp" : 
	 include('WebAdmin_22/module/agenda_tabel.php'); 
	break;
case "Hapus-Agenda.jsp" : 
	 include('WebAdmin_22/module/agenda_delete.php'); 
	break;
case "Update-Agenda.jsp" : 
	 include('WebAdmin_22/module/agenda_update.php'); 
	break;
//----------------------------------------------------	
	
case "pengumuman.jsp" : 
	 include('WebAdmin_22/module/Pengumuman_post.php'); 
	break;
case "TabelPengumuman.jsp" : 
	 include('WebAdmin_22/module/Pengumuman_tabel.php'); 
	break;
case "Hapus-Pengumuman.jsp" : 
	 include('WebAdmin_22/module/Pengumuman_delete.php'); 
	break;
case "Update-Pengumuman.jsp" : 
	 include('WebAdmin_22/module/Pengumuman_update.php'); 
	break;
//----------------------------------------------------
case "link.jsp" : 
	 include('WebAdmin_22/module/link_save.php'); 
	break;
case "linkTabel.jsp" : 
	 include('WebAdmin_22/module/link_tabel.php'); 
	break;
case "Edit-link.jsp" : 
	 include('WebAdmin_22/module/link_update.php'); 
	break;
case "Hapus-Link.jsp" : 
	 include('WebAdmin_22/module/link_delete.php'); 
	break;
//----------------------------------------------------
case "pembina.jsp" : 
	 include('WebAdmin_22/module/SlideShow_post.php'); 
	break;
case "TabelSlide.jsp" : 
	 include('WebAdmin_22/module/SlideShow_tabel.php'); 
	break;
case "Edit-Pembina.jsp" : 
	 include('WebAdmin_22/module/SlideShow_edit.php'); 
	break;
case "Hapus-Pembina.jsp" : 
	 include('WebAdmin_22/module/SlideShow_delete.php'); 
//----------------------------------------------------
case "Jign.jsp" : 
	 include('WebAdmin_22/module/jdsn_post.php'); 
	break;
case "Tabel-jign.jsp" : 
	 include('WebAdmin_22/module/jdsn_tabel.php'); 
	break;
case "Edit-jign.jsp" : 
	 include('WebAdmin_22/module/jdsn_edit.php'); 
	break;
case "Hapus-jign.jsp" : 
	 include('WebAdmin_22/module/jdsn_delete.php'); 
	break;

//----------------------------------------------------
case "Binder.jsp" : 
	 include('WebAdmin_22/module/binder_post.php'); 
	break;
case "TabelBinder.jsp" : 
	 include('WebAdmin_22/module/binder_tabel.php'); 
	break;
case "Edit-Binder.jsp" : 
	 include('WebAdmin_22/module/binder_update.php'); 
	break;
case "Hapus-Binder.jsp" : 
	 include('WebAdmin_22/module/binder_delete.php'); 
	break;
//----------------------------------------------------
case "TabelDownloadFile.jsp" : 
	 include('WebAdmin_22/module/Download_file_tabel.php'); 
	break;
case "Hapus-FileDownload.jsp" : 
	 include('WebAdmin_22/module/Download_file_delete.php'); 
	break;	

//----------------------------------------------------	
case "Tabel-Kategori.jsp" : 
	 include('WebAdmin_22/module/Kategori_Tabel.php'); 
	break;
case "Kategori.jsp" : 
	 include('WebAdmin_22/module/Kategori_post.php'); 
	break;
case "Edit-Kategori.jsp" : 
	 include('WebAdmin_22/module/Kategori_update.php'); 
	break;
case "Hapus-Kategori.jsp" : 
	 include('WebAdmin_22/module/Kategori_delete.php'); 
	break;
//----------------------------------------------------	
//case "Tabel-MenuUtama.jsp" : 
//	 include('WebAdmin/module/MenuUtama_tabel.php'); 
//	break;
//case "MenuUtama.jsp" : 
//	 include('WebAdmin/module/MenuUtama_post.php'); 
//	break;
//case "Edit-MenuUtama.jsp" : 
//	 include('WebAdmin/module/MenuUtama_update.php'); 
//	break;	
//case "Hapus-MenuUtama.jsp" : 
//	 include('WebAdmin/module/MenuUtama_delete.php'); 
//	break;
////----------------------------------------------------
//case "Tabel-SubMenu.jsp" : 
//	 include('WebAdmin/module/SubMenu_tabel.php'); 
//	break;
//case "SubMenu.jsp" : 
//	 include('WebAdmin/module/SubMenu_post.php'); 
//	break;	
//case "Edit-SubMenu.jsp" : 
//	 include('WebAdmin/module/Submenu_update.php'); 
//	break;	
//case "Hapus-SubMenu.jsp" : 
//	 include('WebAdmin/module/SubMenu_delete.php'); 
//	break;	
//----------------------------------------------------
//case "Tabel-Sosmed.jsp" : 
//	 include('WebAdmin/module/Sosmed_tabel.php'); 
//	break;	
//case "Sosmed.jsp" : 
//	 include('WebAdmin/module/Sosmed_post.php'); 
//	break;	
//case "Edit-Sosmed.jsp" : 
//	 include('WebAdmin/module/Sosmed_update.php'); 
//	break;	
//case "Hapus-Sosmed.jsp" : 
//	 include('WebAdmin/module/Sosmed_delete.php'); 
//	break;	

//case "Upadte-sambutan.jsp" : 
//	 include('WebAdmin/module/info_pendaftaran_post.php'); 
//	break;
//----------------------------------------------------	
case "Tabel-Pengunjung.jsp" : 
	 include('WebAdmin_22/Pengunjung.php'); 
	break;
case "Tabel-Pesan.jsp" : 
	 include('WebAdmin_22/module/pesanUser_tabel.php'); 
	break;
case "Tabel-Notifcation.jsp" : 
	 include('WebAdmin_22/notificationList.php'); 
	break;

case "UserDownload.jsp" : 
	 include('WebAdmin_22/module/user_download.php'); 
	break;

case "Kirim-Pesan.jsp" : 
	 include('WebAdmin_22/module/Koment_post.php'); 
	break;		
//----------------------------------------------------	
case "Tabel-FhotoExplor.jsp" : 
	 include('WebAdmin_22/module/fotoUpload_tabel.php'); 
	break;	
case "Hapus-FotoExp.jsp" : 
	 include('WebAdmin_22/module/fotoUpload_delete.php'); 
	break;

case "DownloadTrafic.jsp" : 
	 include('WebAdmin_22/module/UserDownloadFileRecord_tabel.php'); 
	break;
case "DownloadPetaTrafic.jsp" : 
	 include('WebAdmin_22/module/UserDownloadPetaRecord_tabel.php'); 
	break;
//----------------------------------------------------
case "Metadata-Load.jsp" : 
	 include('WebAdmin_22/module/Metadata_read.php'); 
	break;
case "Metadata-Old.jsp" : 
	 include('WebAdmin_22/module/Metadata_read_editting.php'); 
	break;	
//----------------------------------------------------
case "FromFeatureLoad.jsp" : 
	 include('WebAdmin_22/module/feature_FormPeta.php'); 
	break;
case "FromFeatureLoadEdit.jsp" : 
	 include('WebAdmin_22/module/feature_FormPetaEdit.php'); 
	break;
case "SimpanFeature.jsp" : 
	 include('WebAdmin_22/module/feature_post.php'); 
	break;
case "Tabel-Feature.jsp" : 
	 include('WebAdmin_22/module/feature_tabel.php'); 
	break;
case "Hapus-Feature.jsp" : 
	 include('WebAdmin_22/module/feature_delete.php'); 
	break;
case "FromMapServerLoad.jsp" : 
	 include('WebAdmin_22/module/feature_FormPetaDukung.php'); 
	break;
case "FromMapServerLoadEdit.jsp" : 
	 include('WebAdmin_22/module/feature_FormPetaDukungEdit.php'); 
	break;
	
case "FeatueAcces-Update.jsp" : 
	 include('WebAdmin_22/module/feature_acces_update.php'); 
	break;
case "DynamicService-Update.jsp" : 
	 include('WebAdmin_22/module/feature_DynamicService_update.php'); 
	break;
	
case "FeatureTile-add.jsp" : 
	 include('WebAdmin_22/module/fature_TileLayer_add.php'); 
	break;
case "DynamicTile-add.jsp" : 
	 include('WebAdmin_22/module/feature_dynamic_add.php'); 
	break;

case "DynamicTile-hapus.jsp" : 
	 include('WebAdmin_22/module/feature_dynamic_delete.php'); 
	break;
//----------------------------------------------------

case "TabelDownloadFile.jsp" : 
	 include('WebAdmin_22/module/Download_file_tabel.php'); 
	break;
case "Hapus-FileDownload.jsp" : 
	 include('WebAdmin_22/module/Download_file_delete.php'); 
	break;
//----------------------------------------------------
case "Veri" : 
	 include('WebAdmin_22/module/user_download_verifikasi.php'); 
	break;
case "Tolak" : 
	 include('WebAdmin_22/module/user_download_tolak.php'); 
	break;
case "Kirim" : 
	 include('WebAdmin_22/module/user_download_kirim.php'); 
	break;	

//----------------------------------------------------
case "SimpanMapService.jsp" : 
	 include('WebAdmin_22/module/MapService_post.php'); 
	break;
case "Edit-MapService.jsp" : 
	 include('WebAdmin_22/module/MapService_update.php'); 
	break;
case "Tabel-MapService.jsp" : 
	 include('WebAdmin_22/module/MapService_tabel.php'); 
	break;
case "Hapus-MapService.jsp" : 
	 include('WebAdmin_22/module/MapService_delete.php'); 
	break;	
	
//----- Menu Geoserver ---------------------------------------
case "ServerMapServiceData.jsp" : 
	 include('WebAdmin_22/pages/ServerMapServiceData.php'); 
	break;
//------------Web APP----------------------------------------
case "WebApp.jsp" : 
	 include('WebAdmin_22/module/WebApp_post.php'); 
	break;
case "Tabel-WebApp.jsp" : 
	 include('WebAdmin_22/module/WebApp_tabel.php'); 
	break;
case "Edit-WebApp.jsp" : 
	 include('WebAdmin_22/module/WebApp_edit.php'); 
	break;
case "Hapus-WebApp.jsp" : 
	 include('WebAdmin_22/module/WebApp_delete.php'); 
	break;
//------------Web APP DATA----------------------------------------
case "WebAppData.jsp" : 
	 include('WebAdmin_22/module/WebAppData_post.php'); 
	break;
case "Tabel-WebAppData.jsp" : 
	 include('WebAdmin_22/module/WebAppData_tabel.php'); 
	break;
case "Edit-WebAppData.jsp" : 
	 include('WebAdmin_22/module/WebAppData_edit.php'); 
	break;
case "Hapus-WebAppData.jsp" : 
	 include('WebAdmin_22/module/WebAppData_delete.php'); 
	break;
//------------BASEMAP LAYER----------------------------------------
case "Basemap.jsp" : 
	 include('WebAdmin_22/module/Basemap_post.php'); 
	break;
case "Tabel-Basemap.jsp" : 
	 include('WebAdmin_22/module/Basemap_tabel.php'); 
	break;
case "Edit-Basemap.jsp" : 
	 include('WebAdmin_22/module/Basemap_edit.php'); 
	break;
case "Hapus-Basemap.jsp" : 
	 include('WebAdmin_22/module/Basemap_delete.php'); 
	break;
//------------LAYER MAP GIS-----------------------
case "Layer.jsp" : 
	 include('WebAdmin_22/module/Layer_post.php'); 
	break;
case "Tabel-Layer.jsp" : 
	 include('WebAdmin_22/module/Layer_tabel.php'); 
	break;
case "Edit-Layer.jsp" : 
	 include('WebAdmin_22/module/Layer_edit.php'); 
	break;
case "Hapus-Layer.jsp" : 
	 include('WebAdmin_22/module/Layer_delete.php'); 
	break;
	
//----------------------------------------------------
case "PetaKatalog.jsp" : 
	 include('WebAdmin_22/module/KatalogPetaGalery.php'); 
	break;
case "Download-Peta.jsp" : 
	 include('WebAdmin_22/module/user_download_peta.php'); 
	break;
case "Permohonan-Peta.jsp" : 
	 include('WebAdmin_22/module/user_download_peta_bersyarat.php'); 
	break;
	
case "KirimPesan.jsp" : 
	 include('WebAdmin_22/module/Koment_post.php'); 
	break;

case "BackupDB.jps" : 
	 include('WebAdmin_22/pages/BackupDbSQL.php'); 
	break;	
	
case "BackupSQLList.jsp" : 
	 include('WebAdmin_22/module/BackupDbSQL_list.php'); 
	break;

case "rest-auth" : 
	 include('WebAdmin_22/module/login_RestApi.php'); 
	break;

//----------------------------------------------------
case "GetDataAppID.jsp" : 
	 include('WebAdmin_22/module/WebAppGPS_Cbodata.php'); 
	break;

case "BuatTabelGPS.jsp" : 
	 include('WebAdmin_22/module/WebAppGPS_CreateTabelpg.php'); 
	break;

case "ApplayCOnfigTabelGPS.jsp" : 
	 include('WebAdmin_22/module/WebAppGPS_appy.php'); 
	break;

case "PushDataWypointGPS" : 
	 include('WebAdmin_22/module/WebAppGPS_posting.php'); 
	break;

//----------------------------------------------------
	
default;
      include('404.html');
}
?>
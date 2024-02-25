<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<?php
$query_rsAgendaEdt = sprintf("SELECT `tb_agenda`.* FROM `tb_agenda` WHERE KD=%s",GetSQLValueString($Congis,$segmen4, "int"));
$rsAgendaEdt = mysqli_query($Congis, $query_rsAgendaEdt) or die(mysqli_error());
$row_rsAgendaEdt = mysqli_fetch_assoc($rsAgendaEdt);
$totalRows_rsAgendaEdt = mysqli_num_rows($rsAgendaEdt);
?>
<link rel="stylesheet" href="<?php echo $nama_folder ?>/layout/scripts/jquery-ui.css" type="text/css" />
<script src="<?php echo $nama_folder; ?>/layout/scripts/jquery-ui.js"></script>
<script>
$(function(){
	$("#TANGGAL").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: $.datepicker.ATOM
	});	
	
		$("#TGL_SELESAI").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: $.datepicker.ATOM
	});	
});
	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Edit Agenda
                            <small>recana kerja dan kegiatan</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Agenda.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder."/WebAdmin/home"; ?>">Dashboard</a>
                            </li>
                            <li>
                              <i class="fa fa-info-circle"></i>  <a href="<?php echo $nama_folder."/WebAdmin/Agenda.html"; ?>">Agenda</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Buat Agenda
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->



<div class="col-lg-8 text-left">
 <div class="panel panel-default">
   <div class="panel-body">
<!-------------------------------------------------------------------------------- -->                        
        <!-- Main content -->
        
          <!-- Default box -->
        <div  class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Posting Agenda Baru</h3>
            </div>
            <div class="box-body">
                <!-- form start -->
              <form role="form" action="<?php echo $nama_folder; ?>/Update-Agenda.jsp"  method="post" name="form2" id="form2">
                  <div class="box-body">
             
              <div class="form-group">
                      <label>Judul Acara</label>
                      <input name="ACARA" class="form-control" type="text" value="<?php echo $row_rsAgendaEdt['ACARA']; ?>" placeholder="Judul Acara" size="50" maxlength="100" />
               </div>
              <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="KET" cols="50" rows="3" class="form-control" placeholder="Rincian Acara"><?php echo $row_rsAgendaEdt['KET']; ?></textarea>
               </div>
               
                 <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="TANGGAL" type="text" class="form-control" id="TANGGAL" placeholder="Tanggal Mulai" value="<?php echo $row_rsAgendaEdt['TANGGAL']; ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
                  
                  <div class="form-group">
                    <label>Selesai Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="TGL_SELESAI" type="text" class="form-control" id="TGL_SELESAI" placeholder="Tangggal Selsai" value="<?php echo $row_rsAgendaEdt['TGL_SELESAI']; ?>"  >
                    </div><!-- /.input group -->
                  </div>   
                   <div class="form-group">
                    <label>Waktu Mulai:</label> (HH:MM:SS)
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="WAKTU" type="text" class="form-control" placeholder="Jam Mulai" value="<?php echo $row_rsAgendaEdt['WAKTU']; ?>"  >
                    </div><!-- /.input group -->
                  </div>   
                   <div class="form-group">
                    <label>Waktu Selsai:</label> (HH:MM:SS)
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="SELESAI" type="text" class="form-control" placeholder="Jam Selsai" value="<?php echo $row_rsAgendaEdt['SELESAI']; ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" >
                    </div><!-- /.input group -->
                  </div>   
              
                 
                <input type="hidden" name="MM_update" value="form2" />
                <input type="hidden" name="KD" value="<?php echo $row_rsAgendaEdt['KD']; ?>" />
              <div class="form-group">
                      <label>Tempat Acara</label>
                     <input type="text" class="form-control" name="TEMPAT" value="<?php echo $row_rsAgendaEdt['TEMPAT']; ?>" size="32" />
               </div> 
               <div class="form-group">
                    <label>Link Instagram</label> 
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-instagram text-danger"></i></div>
                      <input name="TxtIG" type="text" class="form-control" placeholder="Link Instagram" value="<?php echo $row_rsAgendaEdt['INSTAGRAM']; ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Link Instagram</label> 
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-youtube-play text-danger"></i></div>
                      <input name="TxtYOTUBE" type="text" class="form-control" placeholder="Link Yotube" value="<?php echo $row_rsAgendaEdt['YOTUBE']; ?>" >
                    </div>
               </div>
               

                             
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Update Agenda</button>
                  </div>
              </form>
          </div>
                          
    
<!-------------------------------------------------------------------------------- -->
     </div>
   </div>
</div>        
  </div>
            <!-- /.container-fluid -->
  </div>
<?php
mysqli_free_result($rsAgendaEdt);
} ?>
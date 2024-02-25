<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<link rel="stylesheet" href="<?php echo $nama_folder ?>/Libs/js/jquery-ui.css" type="text/css" />
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery-ui.js"></script>
<script>
	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
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
</script>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Agenda
                            <small>recana kerja dan kegiatan</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Agenda.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home">Dashboard</a>
                            </li>
                            <li>
                              <i class="fa fa-info-circle"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/Agenda.html">Agenda</a>
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
              <form role="form" action="<?php echo $nama_folder; ?>/agenda.jsp/"  method="post" name="form2" id="form2">
                  <div class="box-body">
             
              <div class="form-group">
                      <label>Judul Acara</label>
                      <input name="ACARA" class="form-control" type="text" value="" placeholder="Judul Acara" size="50" maxlength="100" />
               </div>
              <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="KET" cols="50" rows="3" class="form-control" placeholder="Rincian Acara"></textarea>
               </div>
               
                 <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TANGGAL" id="TANGGAL" placeholder="Tanggal Mulai" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div><!-- /.input group -->
                  </div>
                  
                  <div class="form-group">
                    <label>Selesai Tanggal:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="TGL_SELESAI" id="TGL_SELESAI" placeholder="Tangggal Selsai" class="form-control"  >
                    </div><!-- /.input group -->
                  </div>   
                   <div class="form-group">
                    <label>Waktu Mulai:</label> (HH:MM:SS)
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="WAKTU" placeholder="Jam Mulai" class="form-control"  >
                    </div><!-- /.input group -->
                  </div>   
                   <div class="form-group">
                    <label>Waktu Selsai:</label> (HH:MM:SS)
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="SELESAI" placeholder="Jam Selsai" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" >
                    </div><!-- /.input group -->
                  </div>   
              
                 
                <input type="hidden" name="MM_insert" value="form2" />
              <div class="form-group">
                      <label>Tempat Acara</label>
                     <input type="text" class="form-control" name="TEMPAT" value="" size="32" />
               </div> 
                

                             
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="right">
                    <button type="submit" class="btn btn-primary">Simpan Agenda</button>
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

<?php } ?>

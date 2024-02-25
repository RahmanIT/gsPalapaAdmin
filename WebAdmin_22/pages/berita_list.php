<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script>
function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelBerita.jsp/",
	data: "Halaman="+pg,
	cache: false,
	success: function(msg){
		 document.getElementById("linkList1").innerHTML = msg;
		$("#loding").hide();
		}
	});
};

function HalamanBerikutnya(){
	var hl = document.getElementById("Halaman").value; 
	document.getElementById("Halaman").value = eval(hl)+1;
	TampilkanTabel()
}

function HalamanSebelumnya(){
	var hl 	=document.getElementById("Halaman").value; 
	if(hl > 1){
		document.getElementById("Halaman").value  = eval(hl)-1;
		TampilkanTabel()
	}
}

</script>

<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Manajeman Berita
                            <small> kelola berita anda</small>
                            <a class="btn btn-info" href="<?php echo $nama_folder; ?>/panduan/Setting_Berita.pdf" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> Panduan</a>
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file-text"></i> Berita
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
  <p><a href="<?php echo $nama_folder; ?>/WebAdmin/Tulis-Berita.jsp"><button type="button" class="btn btn-lg btn-primary">Tulis Berita</button></a></p>
  <h2 onClick="TampilkanTabel()" style="cursor:pointer;" align="center">Daftar Berita</h2> 
          <div align="right">
          	   <input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              <input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              <input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
         </div>
        		<div class="panel-body">
                     <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                    <div id="linkList1"></div> 
                </div>
</div>
 <p>&nbsp;</p> 
<script>
	TampilkanTabel();
	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script>        
<?php } ?>
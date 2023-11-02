<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script>
function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelAgenda.jsp/",
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
                           Info
                            <small>Agenda kerja tahunan</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-info-circle"></i><a href="../../WebAdmin/pages/info.html">Info</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Agenda
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <p><a href="<?php echo $nama_folder; ?>/WebAdmin/Buat-Agenda.html"><button type="button" class="btn btn-lg btn-primary">Buat Agenda</button></a></p>
  				<h2 onClick="TampilkanTabel()" style="cursor:pointer;" align="center">Daftar Agenda</h2> 
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
<!-- /#page-wrapper -->
<p>&nbsp;</p>

<script>
	TampilkanTabel();
	document.getElementById("config02").className = "active";
	document.getElementById("Manage3").className = "collapse in";
</script>  
<?php } ?>      
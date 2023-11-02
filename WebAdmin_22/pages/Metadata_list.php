<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
<script>
function TampilkanTabel(){
  var pg = eval(document.getElementById("Halaman").value)-1 ;	
  var cr = document.getElementById("Cari").value;
	$("#loding").show();
	$.ajax({
	url: "<?php echo $nama_folder; ?>/TabelPeta.jsp/",
	data: "Halaman="+pg+"&cari="+cr,
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
                           META DATA
                            <small>Katalog data spasial</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $nama_folder; ?>/WebAdmin/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-map=marker"></i><a href="<?php echo $nama_folder; ?>/WebAdmin/Metadata.jsp">Peta</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i>Metadata
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <p><a href="<?php echo $nama_folder; ?>/WebAdmin/Add-Metadata.jsp"><button type="button" class="btn btn-success">Tambahkan Metadata <i class="fa fa-plus"></i> </button></a></p><br/>
                
                <div class="panel panel-primary">
                   <div class="panel-heading">
                         <h3 class="panel-title">Daftar Metadata</h3>
                   </div>
                   <div class="panel-body">
                     <!--awal Panel BODY----------------->
                     <div class="col-lg-4"> 
                                <div class="form-group input-group">
                                        <input name="CARI" id="Cari" type="text" class="form-control" placeholder="Cari Peta">
                                        <span class="input-group-btn"><button class="btn btn-default" onclick="TampilkanTabel()" type="button"><i class="fa fa-search"></i></button></span>
                                   </div>
                            </div> 
                            <!----------- BOX TENGAH loadng-->
                            <div class="col-lg-4" align="center"> 
                              <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>
                            </div> 
                            <!---------- Box Atas Kanan Navigasi Halaman----------------------------> 
                            <div class="col-lg-4" align="right"> 
                              	<input name="CmdBackPage"  onclick="HalamanSebelumnya()" type="button" value="&lt;&lt;" />
              					<input name="Halaman" type="text" id="Halaman" value="1" size="2" maxlength="3" style="text-align:center;" />
              					<input name="CmdNexPage"  onclick="HalamanBerikutnya()"  type="button" value="&gt;&gt;" />
                            </div>  
                           <!------------------------------------------->
                           <div id="linkList1" class="col-lg-12"></div> 
                    <!---end Penel BODT------------------>   
                   </div>
               </div>
</div>
<!-- /#page-wrapper -->
<p>&nbsp;</p>

<script>
	TampilkanTabel();
		document.getElementById("data02").className = "active";
	document.getElementById("Data2").className = "collapse in";
</script>     
<?php } ?>   
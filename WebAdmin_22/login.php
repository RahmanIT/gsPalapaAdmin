<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Admin Portal</title>
<link rel="shortcut icon" href="<?php echo $nama_folder; ?>/images/geoportal.png" />
<link href="<?php echo $nama_folder; ?>/Libs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $nama_folder; ?>/Libs/css/sb-admin.css" rel="stylesheet">
<link href="<?php echo $nama_folder; ?>/Libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>
body{
	margin-top:10%;

}
.judul{
	font-family:Verdana, Geneva, sans-serif;
	font-size:32px;
	font-weight:bold;
	color:#0E63EF;
}
.SubJudul{
	font-family:Tahoma;
	font-size:13px;
	color:#FF0;
}
.BoxLogin{
	max-width:330px;
	background:#FFF;
	border-radius:5px;
	padding:10px;
	text-align:left;
}
.BoxForm{
	max-width:280px;
}
</style>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.min.js"></script>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery-ui.js"></script>
<script src="<?php echo $nama_folder; ?>/Libs/js/jquery.wallform.js"></script>

<?php if( $_SESSION['LoginFaildC'] < 4 ){ ?>
<script >
function ProsesFrom(){
	$("#FormLogin").ajaxForm({target: '#InfoJava1', 
	 beforeSubmit:function(){ 	
		console.log('ttest');
		$("#loding").show();
	    },		  
	    success:function(){ 
	    console.log('test');
		 RelayPage()
		$("#loding").hide();
	    }, 		
        error:function(){ 
	    console.log('xtest');
	    $("#loding").hide();
	   } }).submit();	   		
 }
 
function RelayPage(){
 if (document.getElementById("InfoJava1").innerHTML==101) {
   window.location = "<?php echo $nama_folder."/WebAdmin/home" ?>";	
 }
  if (document.getElementById("InfoJava1").innerHTML=='<h1 style="color:#F00"> Halaman Terblokir</h1>') {
   window.location = "<?php echo $nama_folder."/home" ?>";	
 }
} 
 
function ClearInfoL(){
document.getElementById("InfoJava1").innerHTML="";
} 
</script>

<?php if($segmen4=="token"){
	    $hasil = '';
	$str = base64_decode(urldecode($segmen5));
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)-ord($kuncikarakter));
        $hasil .= $karakter;
    }
 $keyL = explode("#",$hasil);}?>
<?php } ?>

</head>
<body >
<div align="center">
					<table  border="0" align="center" cellpadding="3" cellspacing="0">
  						<tr>
    						<td rowspan="2"><img src="<?php echo$nama_folder; ?>/images/geoportal.png" alt="" width="67" height="67" /></td>
    						<td align="center"><font class="judul">Web Admin</font></td>
  						</tr>
  						<tr>
    						<td align="center"><font class="SubJudul">Sistem Manajemant Website</font></td>
  						</tr>
					</table>
 					<br/>

<?php if( $_SESSION['LoginFaildC'] < 4 ){ ?>  
<div class="BoxLogin" >
  <div id="InfoJava1" align="center"></div>
  
         		<div class="panel panel-info">
    				<div class="panel-heading">
       					<h3 class="panel-title">Silahkan Login</h3>
    				</div>
        	   			
    			<div class="panel-body">
                <form action="<?php echo $nama_folder; ?>/simpe_login.jsp" method="POST" name="FormLogin" id="FormLogin">
          			<div class="form-group">
         				<div class="form-group input-group">
    						<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> 
       						<input name="EMAIL" onfocus="ClearInfoL()" id="EMAIL" class="form-control" value="<?php echo $keyL[2]; ?>" type="text" placeholder="Email" maxlength="100" />
         				</div>
       			   </div>

          			<div class="form-group">
         				<div class="form-group input-group">
    						<span class="input-group-addon"><i class="fa fa-key"></i></span> 
       						<input name="PWD" onfocus="ClearInfoL()" id="PWD" class="form-control" type="password" value="<?php echo $keyL[3]; ?>" placeholder="Sandi" maxlength="100" />
         				</div>
       			  </div>
                  
                  <div class="boxFooter">
                    	<div class="checkbox"><label><input type="checkbox" value="1">Ingat saya </label></div>
                         <div id="loding" style="display:none; float:left;"><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Londing.." /></div>
                    	<div align="right"><button type="button" onclick="ProsesFrom()" class="btn btn-primary"> Masuk </button></div> 
                  </div>
                  <input name="txtKey" type="hidden" value="c3r091vekf2sslsgeoportalkalsel" />
                </form>   
   			    </div><!-- end  panel body -->
		  </div>
	
 </div>
</div> 
<?php if($keyL[0]==date("Ymd") && $keyL[1]==date("H")){echo '<script> ProsesFrom();</script>'; }?>          
     <?php } else { ?>
       <h1 style="color:#F00"> Halaman Terblokir</h1>
	 <?php }?>
</body>
</html>

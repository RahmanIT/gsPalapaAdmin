<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ 
$colname_RstOP = "-1";
if (isset($_SESSION['KdUser'])) {
  $colname_RstOP = $_SESSION['KdUser'];
}
$query_RstOP = sprintf("SELECT * FROM tb_admin WHERE KD_USER = %s",$colname_RstOP);
$RstOP = mysqli_query($Congis, $query_RstOP) or die(mysqli_error());
$row_RstOP = mysqli_fetch_assoc($RstOP);
$totalRows_RstOP = mysqli_num_rows($RstOP);
?>
<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Admin
                            <small> setting siapa saja dapat masuk ke C-Panel</small>
                        </h1>
                        <ol class="breadcrumb">
							<li>
                                <i class="fa fa-dashboard"></i>  <a href="../../WebAdmin/pages/home.jsp">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-gear"></i><a href="../../WebAdmin/pages/Setting.html">Managemant</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> User
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               <!-- ========================================================================================== -->
               <div class="col-lg-12 text-left">
                 <div class="panel panel-primary">
                       <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Profil</h3>
                        </div>
                 
                   <div class="panel-body">
                       <div id="infoSave"></div>
                       <form method="post" name="form1" id="form1" enctype="multipart/form-data" action="<?php echo $nama_folder; ?>/Edit_profileUser.php">
                           <!--Pembagi BOx -->
                         <div class="col-lg-6 text-left"> 
                           <div class="form-group">
                     				 <label>Nama Unit Klirng</label><span id="InfoNama"></span>
                      				 <input  name="NAMA" id="NAMA" onKeyPress="ClearInfo1()" class="form-control" type="text" value="<?php echo $row_RstOP['NAMA']; ?>" placeholder="Nama Unit Kliring" maxlength="255" />
               				</div>
                          <div class="form-group">
           				    <label>Email</label><span id="InfoKET"></span>
               				   <input name="EMAIL" type="text" class="form-control" id="EMAIL" placeholder="Alamat Email" value="<?php echo $row_RstOP['EMAIL']; ?>"  />
           				  </div> 
                          <div class="form-group">
       				       <label>Inisial</label><span id="InfoKET"></span>
               				   <input name="INISIAL" type="text" class="form-control" id="INISIAL" placeholder="Nama Singkat" value="<?php echo $row_RstOP['INISIAL']; ?>"  />
           				  </div>
                          <div class="form-group">
       				       <label>Nama Operator</label><span id="InfoKET"></span>
               				   <input name="NM_OP" type="text" class="form-control" id="NM_OP" placeholder="Nama Operator" value="<?php echo $row_RstOP['NM_OP']; ?>">
           				  </div> 
                           
                         </div><!-- end box 6 pembagi form-->
                         <!-------------------------------------------------------------------------->
                         
                         <div class="col-lg-6 text-left">
                         <div class="form-group">
       				       <label>Telpon</label><span id="InfoKET"></span>
               				   <input name="TELPON" type="text" class="form-control" id="TELPON" placeholder="Telpon Operator" value="<?php echo $row_RstOP['TELPON']; ?>"  />
           				  </div> 
                          <div class="form-group">
       				       <label>Alamat Kantor</label><span id="InfoKET"></span>
               				   <textarea name="ADDR_KANTOR" class="form-control" id="ADDR_KANTOR" placeholder="Alamat Kantor"><?php echo $row_RstOP['ADDR_KANTOR']; ?></textarea>
           				  </div> 
                          <div class="form-group">
                           <img src="<?php echo $nama_folder; ?>/images/users/300x300_<?php echo $row_RstOP['../../WebAdmin/pages/OP_FOTO']; ?>" id="FOTO_OP" width="200px" height="200px" style="border:dashed 1px" />
                           </div>
                         <div class="form-group">
       				       <label>Logo/Fhoto</label><span id="InfoKET"></span>
               				   <input name="filUpload" type="file" class="form-control" id="filUpload"  />
           				  </div>   
                         </div><!-- end box 6 pembagi form--> 
                       
                       </div> <!--end body from-->
						 
                                <div id='loding' style='display:none'><img src="<?php echo $nama_folder; ?>/images/loader.gif" alt="Uploading...."/></div>                             
                               <input name="KD" id="KD" type="hidden" value="" /> 
                              <div class="panel-footer" align="right">
                                      <button type="submit" id="CmdUpdate" class="btn btn-lg btn-primary">Update</button>
                		   </div> 
                   </div>
                </div>
               <!------------------------------------------------------------------------------------------------>
               <!-- ========================================================================================== -->        
 </form>
 </div>
<p>&nbsp;</p> 
<?php
mysqli_free_result($RstOP);
} ?>
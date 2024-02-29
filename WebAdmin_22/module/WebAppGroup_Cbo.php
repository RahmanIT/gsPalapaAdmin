<?php error_reporting(1);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){ ?>
	<?php
	$colname_Rs = "-1";
	if (isset($_GET['model'])) {
	  $colname_Rs = $_GET['model'];
	}
	$query_Rs = sprintf("SELECT KDGROUP,NAMAGROUP FROM tb_modelling_group WHERE KD_MODEL = %s ORDER BY PRIORITAS ASC",GetSQLValueString($Congis,$colname_Rs, "text"));
	$Rs = mysqli_query($Congis, $query_Rs) or die(mysqli_error());
	$row_Rs = mysqli_fetch_assoc($Rs);
	$totalRows_Rs = mysqli_num_rows($Rs);
	do{
		echo '<option value="'.$row_Rs['KDGROUP'].'">'.$row_Rs['NAMAGROUP'].'</option>';
		} while ($row_Rs = mysqli_fetch_assoc($Rs));
} ?>
<?php 
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$namaTb = htmlspecialchars($_POST["tabelname"]);
$query= 'SELECT * FROM "WYPOINT"."'.$namaTb.'" ORDER BY idgps DESC';
$result = pg_query($pgdb, $query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');

pg_close($pgdb);
?>
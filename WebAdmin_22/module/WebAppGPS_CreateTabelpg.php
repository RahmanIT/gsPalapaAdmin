<?php
$pgdb = pg_connect("host='".$confg["pg_server"]."' port='".$confg["pg_poth"]."' dbname='GPS' user='".$confg["pg_user"]."' password='".$confg["pg_pass"]."'");
$namaTb = htmlspecialchars($_POST["tabelname"]);
$Query = 'CREATE TABLE IF NOT EXISTS "WYPOINT"."'.$namaTb.'" ( idgps serial NOT NULL,  geom geometry(Point,4326) NOT NULL,  namobj character varying(100) COLLATE pg_catalog."default",    tanggal timestamp without time zone NOT NULL,   kodepm character varying(15) COLLATE pg_catalog."default",   remark character varying(254) COLLATE pg_catalog."default" NOT NULL,   dataupdate timestamp without time zone,    foto character varying COLLATE pg_catalog."default" NOT NULL,    metadata character varying(50) COLLATE pg_catalog."default",   CONSTRAINT "'.$namaTb.'_pkey" PRIMARY KEY (idgps)) TABLESPACE pg_default; ALTER TABLE "WYPOINT"."'.$namaTb.'" OWNER to postgres;';
$result = pg_query($pgdb, $Query)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
if($result){
   echo '<div class="alert alert-success" role="alert">Berhasil membuat tabel <b>WYPOINT.'.$namaTb.'</b> </div>';
}
$namaTbMd = $_POST["tabelname"].'_METADATA';
$queryMd = ' CREATE TABLE IF NOT EXISTS "WYPOINT"."'.$namaTbMd.'" (
    id serial NOT NULL,
    userid integer,
    latitude double precision NOT NULL,
    longitude double precision NOT NULL,
    prjid integer ,
    sesi_name character varying(30) COLLATE pg_catalog."default",
    email character varying(100) COLLATE pg_catalog."default",
    nama character varying(100) COLLATE pg_catalog."default",
    ipaddr character varying(24) COLLATE pg_catalog."default",
    waktu integer NOT NULL,
    dms character varying(50) COLLATE pg_catalog."default",
    namafile character varying(150) COLLATE pg_catalog."default" NOT NULL,
    metadata character varying(50) COLLATE pg_catalog."default" NOT NULL,
    metadataid serial NOT NULL,
    tgljam timestamp without time zone,
    wadmkd character varying(50) COLLATE pg_catalog."default",
    wadmkc character varying(50) COLLATE pg_catalog."default",
    wadmkk character varying(50) COLLATE pg_catalog."default",
	akurasi double precision,
    ketinggian double precision,
    akurasielv double precision,
    arah double precision,
    kecepatan double precision,
    CONSTRAINT "'.$namaTbMd.'_pkey" PRIMARY KEY (metadataid)
) TABLESPACE pg_default;
ALTER TABLE "WYPOINT"."'.$namaTbMd.'"  OWNER to postgres;';

$result1 = pg_query($pgdb, $queryMd)or die('<div class="alert alert-warning" role="alert">'.pg_last_error().'</div>');
if($result1){
   echo '<div class="alert alert-success" role="alert">Berhasil membuat tabel <b>WYPOINT.'.$namaTbMd.'</b> </div>';
}
pg_close($pgdb);
?>
<?php

include "../../../config_sistem.php";
$SQL = "select * from $database.laporanid";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$namaclient = $baris["nama"];
$jalamclient = $baris["alamat"];
$telponclient = $baris["telpon"];

?>
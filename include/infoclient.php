<?
include "../include/globalx.php";
$SQL = "select * from laporanid";
$hasil = mysql_query($SQL);
$baris = mysql_fetch_array($hasil);
$namaclient = $baris["nama"];
$jalamclient = $baris["alamat"];
$telponclient = $baris["telpon"];
?>
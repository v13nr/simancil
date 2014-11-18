<?php
include("../include/globalx.php");
include ("../../accounting/include/globalx.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$split = explode("-", $id);
/*
$sql = "select qty from $database.bahanjadi  where id = '".$split[1]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$qtySebelumnya = $baris[0];

$sql = "select saldo from $database.pesanan  where nomor = '".$split[3]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$saldoSebelumnya = $baris[0];
*/

$sql = "update $database.project_detail set qty = '".$split[0]."' where id = '".$split[1]."'";
mysql_query($sql, $dbh_jogjaide);



}
?>
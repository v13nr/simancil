<?php
include("../include/globalx.php");
include ("../../accounting/include/globalx.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$split = explode("-", $id);

$sql = "select qtyin from $database.po  where id = '".$split[1]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$qtySebelumnya = $baris[0];
$sql = "select saldo from $database.pesanan  where nomor = '".$split[3]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$saldoSebelumnya = $baris[0];

$sql = "update $database.po set qtyin = '".$split[0]."' where id = '".$split[1]."'";
mysql_query($sql, $dbh_jogjaide);


$SQLu = "UPDATE $database.pesanan SET saldo = saldo + (($split[4] * ($split[0] - $qtySebelumnya))) WHERE  nomor = '$split[3]'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
			

}
?>
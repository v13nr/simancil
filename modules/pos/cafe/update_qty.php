<?php
include("../include/globalx.php");
include ("../../accounting/include/globalx.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$split = explode("-", $id);

$sql = "select qtyout from $database.mutasi  where id = '".$split[1]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$qtySebelumnya = $baris[0];
$sql = "select saldo from $database.piutang  where nomor = '".$split[3]."'";
$hasil = mysql_query($sql, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$saldoSebelumnya = $baris[0];

$sql = "update $database.mutasi set qtyout = '".$split[0]."' where id = '".$split[1]."'";
mysql_query($sql, $dbh_jogjaide);

$sql = "update $database.stock set qtyout =  qtyout + ($split[0] - $qtySebelumnya) where kodebrg = '$split[2]'";
mysql_query($sql, $dbh_jogjaide);

$SQLu = "UPDATE $database.piutang SET saldo = saldo + (($split[4] * ($split[0] - $qtySebelumnya))) WHERE  nomor = '$split[3]'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
			
//update jurnal
$SQLu = "UPDATE $database.jurnal_srb SET jumlah = jumlah + (($split[4] * ($split[0] - $qtySebelumnya))) WHERE  mutasi_id = '$split[1]'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
}
?>
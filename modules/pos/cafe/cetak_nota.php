<?php session_start() ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }

input.kanan{ text-align:right; }
.style1 {color: #FFFFFF}
</style>

</head>

<body onload="window.print()">
<?php
	include "../include/globalx.php";
	include "../include/functions.php";
	$nonota = $_GET['nonota'];
	//$split = explode("/",$nonota);
	//$nota = $split[1];
	$SQL = "SELECT SUM(harga * qtyout - (harga * qtyout * disc/100)) FROM mutasi WHERE model = 'INV' and nomor = '".$nonota."' AND status = 1";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	$baris = mysql_fetch_array($hasil);
	$total = $baris[0];
?>
<form method="post" action="../../../cafe/cetak_nota.php?id=<?=$nonota?>">
<table width="100%" border="0">
  <tr>
    <td colspan="3"><table width="100%" border="0">

		<?php
				$s = "select * from laporanid where id = 1";
				$h = mysql_query($s);
				$b = mysql_fetch_array($h);
				$SQL = "select * from logo limit 1";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$row = mysql_fetch_array($hasil);
		?>
      <tr>
        <td colspan="4" align="center"><img src="../../core/admin/foto/<?=$row['foto']?>" width="100" /><br /><strong><?=SITE_TITLE?></strong></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><?=$b["alamat"]?> </td>
      </tr>
      <tr>
        <td colspan="4" align="center">ID = <?=$nonota?> : <?php
		$SQLt = "select tgl, meja_id from mutasi WHERE model = 'INV' and nomor = '".$nonota."'";
		//echo $SQLt; exit();
		$hasilt = mysql_query($SQLt);
		$barist = mysql_fetch_array($hasilt);
		echo baliktglindo($barist["tgl"]);
		?> / <?=$_SESSION["sess_name"]?><br />
		<?php
				$SQLm = "select nama from meja  WHERE  id = '".$barist["meja_id"]."'";
		//echo $SQLm; exit();
		$hasilm = mysql_query($SQLm);
		$barism = mysql_fetch_array($hasilm);
		echo $barism["nama"];
		?>
		</td>
      </tr>
	  <?php
$SQL = "SELECT * FROM mutasi WHERE model = 'INV' and nomor = '".$nonota."' AND status = 1";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	while($baris = mysql_fetch_array($hasil)){;
?>
      <tr>
        <td colspan="4">
          <?=$baris["namabrg"];?></td>
        </tr>
      <tr>
        <td width="19%" align="right"><?=number_format($baris["qtyout"]);?></td>
        <td width="34%" align="right"><?=number_format($baris["harga"]);?></td>
        <td width="47%" align="right"><?=number_format($baris["harga"]*$baris["qtyout"]-($baris["harga"]*$baris["qtyout"]*$baris["disc"]/100));?></td>
      </tr>
	  <?php } ?>
    </table></td>
    </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="965" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>Total </td>
    <td>:</td>
    <td align="right"><?=$_POST["total"]?></td>
  </tr>
  <tr>
    <td>Bayar</td>
    <td>:</td>
    <td align="right"><?=$_POST["bayar"]?></td>
  </tr>
  <tr>
    <td>Kembali</td>
    <td>:</td>
    <td align="right"><?=$_POST["kembali"]?></td>
  </tr>
</table>
</form>
</body>
</html>

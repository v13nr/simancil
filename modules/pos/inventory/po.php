<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.tengah {
	text-align: center;
}
.tengah {
	text-align: center;
	font-size: 18px;
}
.duaempat {
	font-size: 24px;
}
.tg {
	text-align: center;
}
.tg {
	text-align: center;
}
.kn {
	text-align: right;
}
.kn {
	text-align: right;
}
</style>
</head>

<body onload="window.print();">
<HR />
<?php

include("../include/infoclient.php");
include("../../../otentik.php");
include_once("../../../config_sistem.php");

?>

<table width="100%" border="0" align="center">
  <tr>
    <td class="tengah"><?php echo strtoupper($namaclient);?><br />
    <?php echo strtoupper($jalamclient);?><br /><?php echo $telponclient;?></td>
  </tr>
</table>
<hr />
<table width="100%" border="0" align="center">
  <tr>
    <td class="tengah duaempat">PURCHASE ORDER <?php echo $_GET["nomer"];?></td>
  </tr>
</table>
<p><br />
</p>
<?php
	$SQL = "select * FROM supplier where kode = '". $_GET["id"] ."'";
	$hasil = mysql_query($SQL) or die($SQL);
	$baris = mysql_fetch_array($hasil);
	
?>
<p>KEPADA YTH.<BR />
<?php echo strtoupper($baris["nama"]); ?>
<BR />
<?php echo strtoupper($baris["alamat"]); ?>,<?php echo $baris["telp"]; ?></p>
<p>BERSAMA DENGAN INI KAMI SAMPAIKAN PEMESANAN BARANG<BR />
</p>
<table width="100%" border="1" style="border-collapse:collapse">
  <tr>
    <td width="6%" style="text-align: center; font-weight: bold;">NO</td>
    <td width="46%" style="text-align: center"><strong>NAMA BARANG</strong></td>
    <td width="13%" style="text-align: center"><strong>SATUAN</strong></td>
    <td width="7%" style="text-align: center"><strong>QTY</strong></td>
    <td width="13%" style="text-align: center"><strong>HARGA</strong></td>
    <td width="15%" style="text-align: center"><strong>TOTAL</strong></td>
  </tr>
  <?php
  	$SQL = "SELECT MAX(id) FROM po2 WHERE kode_supplier = '". $_GET["id"] ."'";
	$hasil=mysql_query($SQL);
	$baris = mysql_fetch_array($hasil);
	$last = $baris[0];
	
	$SQL = "SELECT * FROM po2 A, po2_detail B WHERE A.id = B.po_id AND po_id='$last'";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
		$tanggal = $baris["tanggal"];
		$total = $total + $baris["jumlah"];
  ?>
  <tr>
    <td><?php echo ++$no;?></td>
    <td><?php echo $baris["namabarang"];?></td>
    <td class="tg"><?php echo $baris["satuan"];?></td>
    <td class="tg"><?php echo $baris["qty"];?></td>
    <td class="kn"><?php echo number_format($baris["harga"],2);?></td>
    <td class="kn"><?php echo number_format($baris["jumlah"],2);?></td>
  </tr>
 <?php
	}
 ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><span class="kn"><?php echo number_format($total,2);?></span></td>
  </tr>
</table>
<p>Tanggal, <?php echo $tanggal;?> </p>
</body>
</html>
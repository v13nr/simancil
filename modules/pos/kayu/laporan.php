<?php 
session_start();


include ("../include/globalx.php");
include ("../../accounting/include/globalx.php");
include ("../include/functions.php");
include ("otentik_inv.php");


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<H3>LAPORAN PENJUALAN KAYU</H3>
<table width="1144" border="1" style="border-collapse:collapse">
  <tr>
    <td width="87"><div align="center">TANGGAL</div></td>
    <td width="95"><div align="center">NONOTA</div></td>
    <td width="174"><div align="center">JENIS KAYU </div></td>
    <td colspan="3"><div align="center">UKURAN</div></td>
    <td width="75"><div align="center">BATANG</div></td>
    <td width="94"><div align="center">KUBIKASI</div></td>
    <td width="104"><div align="center">HARGA</div></td>
    <td width="109"><div align="center">NILAI</div></td>
    <td width="109"><div align="center">DP</div></td>
    <td width="121"><div align="center">NETTO</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="34">&nbsp;</td>
    <td width="33">&nbsp;</td>
    <td width="33">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php

  $SQL = "SELECT * FROM mutasi";
  $hasil = mysql_query($SQL) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
  ?>
  <tr>
    <td align="center"><?php echo baliktglindo($baris["tgl"]);?></td>
    <td align="center"><?php echo ($baris["nota"]);?></td>
    <td><?php echo ($baris["namabrg"]);?></td>
    <td align="center"><?php echo ($baris["ukuran1"]);?></td>
    <td align="center"><?php echo ($baris["ukuran2"]);?></td>
    <td align="center"><?php echo ($baris["ukuran3"]);?></td>
     <td align="center"><?php echo ($baris["batang"]);?></td>
    <td align="center"><?php echo ($baris["ukuran1"]*$baris["ukuran2"]*$baris["ukuran3"]*$baris["batang"]);?></td>
   <td align="right"><?php echo number_format($baris["harga"]);?></td>
    <td align="right"><?php echo number_format($baris["ukuran1"]*$baris["ukuran2"]*$baris["ukuran3"]*$baris["batang"]*$baris["harga"]);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
	}
  ?>
  
  
</table>
</body>
</html>

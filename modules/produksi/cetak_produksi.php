<?php  session_start(); ?>
<?php  include "otentik_admin.php"; include ("include/functions.php");
include ("include/globalx.php");?>
<?php 
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Data Produksi -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
Gudang = <?php  echo $_POST["gudang"];?>
<table width="90%" border="1" style="border-collapse:collapse">
  <tr>
    <td><div align="center">No</div></td>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Jumlah</div></td>
    <td><div align="center">Jenis</div></td>
  </tr>
  <?php 
  	$SQL = "select * from produksi_detail a where a.tanggal BETWEEN '".baliktgl($_POST["tgl_awal"])."' AND '".baliktgl($_POST["tgl_akhir"])."' AND gudang = '".$_POST["gudang"]."' order by tanggal, jenis asc";
	$hasil = mysql_query($SQL, $dbh_produksi) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
  ?>
  <tr>
    <td align="right"><?php  echo ++$no?></td>
    <td align="center"><?php  echo baliktglindo($baris["tanggal"])?></td>
    <td align="center"><?php  echo ($baris["produksi"])?></td>
    <td align="center"><?php  
	$SQLc = "select nama from jenis where kode = '".$baris["jenis"]."'";
	$hasilc = mysql_query($SQLc);
	$barisc = mysql_fetch_array($hasilc);
	echo $barisc[0];?></td>
  </tr>
  <?php  } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

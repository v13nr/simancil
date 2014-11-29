<?php  session_start(); ?><?php 
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

?>
<?php 
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "HPP -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HPP</title>
</head>

<body>
<div align="center">HARGA POKOK PENJUALAN (HPP) <BR /><?php  echo $namaclient; ?><br />Periode <?php  echo $_SESSION["periode"];?>
</div>
<br />

<table width="70%" border="0" style="border-collapse:collapse" align="center">
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Barang Jadi Awal </td>
    <td width="16%"><div align="right"></div></td>
    <td width="12%"><div align="right"></div></td>
    <td width="13%"><div align="right"></div></td>
    <td width="10%"><div align="right"><?php  echo number_format($_SESSION["AL6-1116"],2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Harga Pokok Produksi </strong></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Awal Barang Dalam Proses </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1115"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Awal Bahan Baku &amp; Pembantu </td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Pembelian Bahan Baku dan Pembantu </td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1113_rd"]+$_SESSION["AL6-1114_rd"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Retur Pembelian</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Ongkos angkut Pembelian </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="44%">Pembelian Bersih </td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+($_SESSION["AL6-1113_rd"]+$_SESSION["AL6-1114_rd"]),2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tersedia untuk dipakai </td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+($_SESSION["AL6-1113_rd"]+$_SESSION["AL6-1114_rd"]),2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Akhir bahan Baku &amp; Pembantu </td>
    <td><div align="right"></div></td>
    <td><div align="right"><u><?php  echo number_format($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"],2,'.',','); ?></u></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pemakaian Bahan Baku </td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format(($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - ($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"]),2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Upah Tenaga Kerja Langsung </td>
    <td><div align="right"></div></td>
    <td><div align="right">
      <?php  
	//total debet beben upah tenaga kerja langsung - upah harian - thr
	echo number_format($_SESSION["BP1-5113_borongan"],2,'.',','); ?>
    </div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jumlah Beban Produksi </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format(($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - ($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+$_SESSION["BP1-5113_borongan"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Barang Tersedia </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1115"]+($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - ($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+$_SESSION["BP1-5113_borongan"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Barang Dalam Proses Akhir </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1115_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Harga Pokok Produksi </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1115"]+($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - ($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+$_SESSION["BP1-5113_borongan"]-$_SESSION["AL6-1115_rr"],2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">Tenaga Kerja Tak Langsung </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5113_tk_taklangsung"],2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Beban Overhead Pabrik </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Listrik, Air, dan Telepon </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5211_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban sparepart mesin &amp; pemeliharaan </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5212_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban material </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5214_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban sparepart kendaraan &amp; pemeliharaan </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5213_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban penjualan/pengiriman </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5215_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban penyusutan aktiva tetap </td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5221_rr"]+$_SESSION["BP1-5222_rr"]+$_SESSION["BP1-5224_rr"]+$_SESSION["BP1-5225_rr"],2,'.',','); ?></div></td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>TOTAL BEBAN OVERHEAD PABRIK </td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
    <td><div align="right"><?php  echo number_format($_SESSION["BP1-5211_rr"]+$_SESSION["BP1-5212_rr"]+$_SESSION["BP1-5214_rr"]+$_SESSION["BP1-5213_rr"]+$_SESSION["BP1-5215_rr"]+($_SESSION["BP1-5221_rr"]+$_SESSION["BP1-5222_rr"]+$_SESSION["BP1-5224_rr"]+$_SESSION["BP1-5225_rr"]),2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Harga Pokok Barang Tersedia Dijual </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1116"]+
	$_SESSION["AL6-1115"]+
	($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - 
	($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+
	$_SESSION["BP1-5113_borongan"]-$_SESSION["AL6-1115_rr"]+$_SESSION["BP1-5113_tk_taklangsung"]+$_SESSION["BP1-5211_rr"]+$_SESSION["BP1-5212_rr"]+$_SESSION["BP1-5214_rr"]+$_SESSION["BP1-5213_rr"]+$_SESSION["BP1-5215_rr"]+
	($_SESSION["BP1-5221_rr"]+$_SESSION["BP1-5222_rr"]+$_SESSION["BP1-5224_rr"]+$_SESSION["BP1-5225_rr"]),2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">Persediaan Akhir Barang Jadi </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1116_rr"],2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">HARGA POKOK PENJUALAN </td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php  echo number_format($_SESSION["AL6-1116"]+
	$_SESSION["AL6-1115"]+
	($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - 
	($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+
	$_SESSION["BP1-5113_borongan"]-$_SESSION["AL6-1115_rr"]+$_SESSION["BP1-5113_tk_taklangsung"]+$_SESSION["BP1-5211_rr"]+$_SESSION["BP1-5212_rr"]+$_SESSION["BP1-5214_rr"]+$_SESSION["BP1-5213_rr"]+$_SESSION["BP1-5215_rr"]+
	($_SESSION["BP1-5221_rr"]+$_SESSION["BP1-5222_rr"]+$_SESSION["BP1-5224_rr"]+$_SESSION["BP1-5225_rr"])-$_SESSION["AL6-1116_rr"],2,'.',','); 
	
	$_SESSION["hppa"] = $_SESSION["AL6-1116"]+
	$_SESSION["AL6-1115"]+
	($_SESSION["AL6-1113"]+$_SESSION["AL6-1114"]+$_SESSION["AL6-1113_rd"]) - 
	($_SESSION["AL6-1113_rr"]+$_SESSION["AL6-1114_rr"])+
	$_SESSION["BP1-5113_borongan"]-$_SESSION["AL6-1115_rr"]+$_SESSION["BP1-5113_tk_taklangsung"]+$_SESSION["BP1-5211_rr"]+$_SESSION["BP1-5212_rr"]+$_SESSION["BP1-5214_rr"]+$_SESSION["BP1-5213_rr"]+$_SESSION["BP1-5215_rr"]+
	($_SESSION["BP1-5221_rr"]+$_SESSION["BP1-5222_rr"]+$_SESSION["BP1-5224_rr"]+$_SESSION["BP1-5225_rr"])-$_SESSION["AL6-1116_rr"];
	?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
</table>
</body>
</html>

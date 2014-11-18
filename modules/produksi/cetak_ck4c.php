<? include "otentik_admin.php"; include ("include/functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <p>REKAPITULASI PRODUKSI HASIL TEMBAKAU</p>
  <p>Periode <?php echo $_POST["tgl_awal"]?> s/d  <?php echo $_POST["tgl_akhir"]?>   </p>
</div>
<table width="100%" border="1">
  <tr>
    <td rowspan="2"><div align="center">No</div>      <div align="center"></div></td>
    <td rowspan="2"><div align="center">Merek</div>      <div align="center"></div></td>
    <td><div align="center">Jenis</div></td>
    <td rowspan="2"><div align="center">isi</div>      <div align="center"></div></td>
    <td rowspan="2"><div align="center">Seri</div>      <div align="center"></div></td>
    <td colspan="2"><div align="center">Tarif</div>      <div align="center"></div></td>
    <td><div align="center">HJE</div></td>
    <td><div align="center">Jumlah Produksi </div></td>
  </tr>
  <tr>
    <td><div align="center">HT</div></td>
    <td><div align="center">Ad</div></td>
    <td><div align="center">Spesifik </div></td>
    <td><div align="center">( Rp. )</div></td>
    <td><div align="center">(btg/gram)</div></td>
  </tr>
  <?php
  		$SQL = "SELECT *, SUM(c.produksi) as total FROM nas_produksi.produksi_detail c, nas_produksi.stock a LEFT join nas_produksi.jenis b ON a.jenis = b.kode  WHERE a.kodebrg = c.merek AND a.status = 1 AND c.tanggal BETWEEN '".baliktgl($_POST["tgl_awal"])."' AND '".baliktgl($_POST["tgl_akhir"])."' GROUP BY a.kodebrg";
		$hasil = mysql_query($SQL) or die(mysql_error());
		while($baris=mysql_fetch_array($hasil)){
  ?>
  <tr>
    <td align="center"><?=++$no?></td>
    <td><?php echo $baris["namabrg"] ?></td>
    <td><div align="center"><?php echo $baris["nama"] ?></div></td>
    <td><div align="center"><?php echo $baris["isi"] ?></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center"><?php echo number_format($baris["hargaeceran"]) ?></div></td>
    <td><div align="center"><?php echo number_format($baris["total"]) ?></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

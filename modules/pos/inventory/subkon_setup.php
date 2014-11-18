<?
@session_start(); include "otentik_inv.php"; 
include ("../include/globalx.php");
include ("../include/functions.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
</head>

<body>
<table width="90%" border="1">
  <?php
  	$SQLh = "SELECT  * From subkon WHERE id = ". $_GET["id"];
	$hasilh = mysql_query($SQLh);
	$barish = mysql_fetch_array($hasilh);
  ?>
  <tr>
    <td rowspan="2"><?=$barish["nama"];?></td>
    <td>Tipe/Luas</td>
    <td>Blok</td>
    <td>Nilai Kontrak </td>
    <td colspan="3" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><?=$barish["tipe_luas"];?></td>
    <td><?=$barish["blok"];?></td>
    <td align="right"><?=number_format($barish["kontrak"]);?></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>Keterangan</td>
    <td>Jumlah</td>
    <td>Pinjaman Material </td>
    <td>Pek. Tambahan </td>
    <td>Sisa</td>
    <td>Todo</td>
  </tr>
  <?php
  
  	$SQL = "SELECT * FROM subkon_detail WHERE subkon_id = '". $_GET["id"] ."' order by id ASC";
	$hasil = mysql_query($SQL);
  	while($baris = mysql_fetch_array($hasil)){
  ?>
  <form method="post" action="submission_inv.php">
  <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
  <input type="hidden" name="id_detail" value="<?=$baris["id"]?>" />
  <input type="hidden" name="cmd" value="upd_subkon_detail" />
  <tr>
    <td><input type="text" name="tanggal" id="tanggal" size="10" class="required" title="*" value="<?=baliktglindo($baris["tanggal"])?>"  />
          <a href="javascript:showCalendar('tanggal')"></a></td>
    <td><?=$baris["keterangan"]?></td>
    <td align="right"><input type="text" name="jumlah" value="<?=number_format($baris["jumlah"])?>" /></td>
    <td align="right"><input type="text" name="material"  value="<?=number_format($baris["material"])?>" /></td>
    <td align="right"><input type="text" name="tambahan" value="<?=number_format($baris["tambahan"])?>"  /></td>
    <td align="right"><input type="text" name="sisa" value="<?php echo number_format($baris["sisa"]); $total = $total + $baris["sisa"];?>" /></td>
    <td align="center"><input type="submit" value="Update" /></td>
  </tr>
  </form>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?=number_format($total)?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>

</html>

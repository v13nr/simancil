<?
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Data Jurnal -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<?php
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";
?>
<table width="1000" border="1" style="border-collapse:collapse">
  	<tr>
  	  <td colspan="7"><div align="center">JURNAL PERIODE <?=$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir']?></div></td>
  </tr>
  	<tr>
		<td width="5%"><div align="center">No.</div></td>
		<td width="8%"><div align="center">Tanggal</div></td>
		<td width="10%"><div align="center">Nobukti</div></td>
		<td width="8%"><div align="center">Norek</div></td>
		<td width="44%"><div align="center">Keterangan</div></td>
		<td width="12%"><div align="center">Debet</div></td>
		<td width="13%"><div align="center">Kredit</div></td>
	</tr>
	<?php
	$SQL = "SELECT * FROM jurnal_srb where id <> ''";
	if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
		$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
	}
	if($_POST['divisi']<>""){
		$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
	}
	if($_POST['user']<>""){
		$SQL = $SQL . " AND user_id = '".$_POST['user']."'";
	}
	$SQL = $SQL . " ORDER BY tanggal ASC";
	$hasil = mysql_query($SQL);

while($baris = mysql_fetch_array($hasil)){
?>
  <tr>
    <td align="right"><?=++$no?></td>
    <td align="center"><?=baliktglindo($baris['tanggal'])?></td>
    <td align="center"><?=nobukti($baris['nobukti'])?></td>
    <td align="center"><?=noreknn($baris['kd'])?></td>
    <td><?=$baris['ket']?></td>
    <td align="right"><?=number_format($baris['jumlah'],2,',','.')?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=noreknn($baris['kk'])?></td>
    <td><?=$baris['ket2']?></td>
    <td>&nbsp;</td>
    <td align="right"><?=number_format($baris['jumlah'],2,',','.')?></td>
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
  </tr>
</table>

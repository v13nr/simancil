<?php 
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "CSCK -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<?php  include "otentik_admin.php"; 
include "include/globalx.php";
include "include/functions.php";

include_once './includes/config.inc.php';

$db = db_connect();
$rokok = $db->get_rows("SELECT * FROM stock a LEFT JOIN jenis b ON a.jenis = b.kode ORDER BY kodebrg ASC");

?>
<script language="javascript">
function viksel(delUrl) {
	if (confirm("Apakah akan mengekspor ke Excell ?")) {
			//var password;
			//var pass1 = "kafet4"; // place password here
			//password=prompt("Please enter your password:","");
			//if (password==pass1) {
				document.location = delUrl;
			//}
		}
}
</script>
<body onLoad="viksel('cetak_csck1_excell.php');">

<table width="100%" border="1" style="border-collapse:collapse">
  <tr>
    <td width="5%" rowspan="7"><div align="center">Nomor</div></td>
    <td width="8%" rowspan="7"><div align="center">Tanggal</div></td>
    <td width="11%" rowspan="7"><div align="center">Uraian Kegiatan </div></td>
    <td colspan="3"><div align="center">Merek</div>      <div align="center"></div>      <div align="center"></div></td>
	<?php  foreach($rokok as $k=>$v): ?>
    	<td width="9" colspan="2"><?php  echo $v['namabrg']; ?></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Jenis</div>      <div align="center"></div>      <div align="center"></div></td>
    <?php  foreach($rokok as $k=>$v): ?>
    	<td width="9%" colspan="2"><?php  echo ($v['nama']); ?></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Isi</div>      <div align="center"></div>      <div align="center"></div></td>
     <?php  foreach($rokok as $k=>$v): ?>
    	<td width="9%" colspan="2"><?php  echo number_format($v['isi']); ?></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td colspan="3"><div align="center">HJE</div>      <div align="center"></div>      <div align="center"></div></td>
    <?php  foreach($rokok as $k=>$v): ?>
    	<td width="9%" colspan="2"><?php  echo number_format($v['hargaeceran']); ?></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Tarif</div>      <div align="center"></div>      <div align="center"></div></td>
    <?php  foreach($rokok as $k=>$v): ?>
    	<td width="9%" colspan="2"><?php  echo $v['tarif']; ?></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td width="6%"><div align="center">SKT</div></td>
    <td width="7%"><div align="center">SKM</div></td>
    <td width="6%"><div align="center">Lain</div></td>
	<?php  foreach($rokok as $k=>$v): ?>    	
		<td align="center">Blm Dilekati</td>
		<td align="center">Tlah Dilekati</td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td><div align="center">Btg</div></td>
    <td><div align="center">Btg</div></td>
    <td><div align="center">gr</div></td>
    <?php  foreach($rokok as $k=>$v): ?>    	
		<td align="center">Bungkus</td>
		<td align="center">Bungkus</td>
	<?php  endforeach; ?>
  </tr>
  <?php 
  		$split = isset($_GET["bulan"]) ? explode('-',$_GET["bulan"]) : explode('-','1-2010');
  		$SQLt = "SELECT DISTINCT tanggal FROM produksi_detail WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."'";
		$hasilt = mysql_query($SQLt);
		while($barist = mysql_fetch_array($hasilt)){
  
  ?>
  
  <tr>
    <td rowspan="5" valign="top"><div align="center"><?php  echo ++$no?></div></td>
    <td rowspan="5" valign="top"><div align="center"><?php  echo baliktglindo($barist["tanggal"]); ?></div></td>
    <td>Sisa</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<?php  foreach($rokok as $k=>$v): ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td>Produksi (+) </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<?php  foreach($rokok as $k=>$v): ?>
    	<td width="9%">&nbsp;</td>
	    <td><div align="center"><?php  
		$SQLf = "SELECT produksi FROM produksi_detail WHERE merek = '".$v['kodebrg']."' AND jenis = '".$v['jenis']."' AND tanggal = '".$barist["tanggal"]."'";
		$hasilf = mysql_query($SQLf);
		$barisf = mysql_fetch_array($hasilf);
		echo $barisf[0]; ?>
		</div></td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td>Jumlah</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php  foreach($rokok as $k=>$v): ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td>Pengeluaran (-) </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php  foreach($rokok as $k=>$v): ?>
		<td><div align="center">
		  <?php  
		$SQLf = "SELECT produksi FROM produksi_detail WHERE merek = '".$v['kodebrg']."' AND jenis = '".$v['jenis']."' AND tanggal = '".$barist["tanggal"]."'";
		$hasilf = mysql_query($SQLf);
		$barisf = mysql_fetch_array($hasilf);
		echo $barisf[0]; ?>
        </div></td>
		<td>&nbsp;</td>
	<?php  endforeach; ?>
  </tr>
  <tr>
    <td>Pengeluaran Lain </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php  foreach($rokok as $k=>$v): ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php  endforeach; ?>
  </tr>
  
  <?php  } ?>
</table>
</body>
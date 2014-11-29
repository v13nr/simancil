<?php  @session_start(); include "otentik_inv.php"; 
include ("../include/globalx.php");
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body onload="window.print()">
<table width="90%" border="1" style="border-collapse:collapse" align="center">
  <tr>
    <td rowspan="2"><div align="center">No.</div>      <div align="center"></div></td>
    <td rowspan="2"><div align="center">Nama Subkon </div>      <div align="center"></div></td>
    <td rowspan="2"><div align="center">Tipe</div>      <div align="center"></div></td>
    <td rowspan="2"><div align="center">Blok</div>      <div align="center"></div></td>
    <td colspan="9"><div align="center">BOBOT</div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div></td>
    <td><div align="center">Sudah</div></td>
  </tr>
  <tr>
    <td><div align="center">Tgl</div></td>
    <td><div align="center">30</div></td>
    <td><div align="center">Tgl</div></td>
    <td><div align="center">60</div></td>
    <td><div align="center">Tgl</div></td>
    <td><div align="center">95</div></td>
    <td><div align="center">Tgl</div></td>
    <td><div align="center">5</div></td>
    <td><div align="center">Sisa</div></td>
    <td><div align="center">Terbayar</div></td>
  </tr>
  <?php 
  	$SQL = "select * from subkon";
	$hasil = mysql_query($SQL);
	while($baris=mysql_fetch_array($hasil)){
  ?>
  
  <tr>
    <td align="center"><?php  echo ++$no;?></td>
    <td><?php  echo $baris["nama"]?></td>
    <td><?php  echo $baris["tipe_luas"]?></td>
    <td><?php  echo $baris["blok"]?></td>
	<?php  
			$SQLc = "SELECT * FROM subkon_detail WHERE subkon_id = '". $baris["id"] ."' order by id asc";
			$hasilc = mysql_query($SQLc);
			while($barisc = mysql_fetch_array($hasilc)){
	?>
    <td align="center"><?php  if($barisc["tanggal"]=='0000-00-00') { echo ""; } else { echo baliktglindo($barisc["tanggal"]); } ?></td>
    <td align="right"><?php  echo number_format($barisc["jumlah"])?></td>
	<?php  } ?>
	<?php  
			$SQLc2 = "SELECT SUM(sisa) as sisa, SUM(jumlah) as jumlah FROM subkon_detail WHERE subkon_id = '". $baris["id"] ."' order by id asc";
			$hasilc2 = mysql_query($SQLc2);
			while($barisc2 = mysql_fetch_array($hasilc2)){
	?>
    <td align="right"><?php  echo number_format($barisc2["jumlah"]); $total_jumlah = $total_jumlah + $barisc2["jumlah"];?></td>
    <td align="right"><?php  echo number_format($barisc2["sisa"]); $total_sisa = $total_sisa + $barisc2["sisa"];?></td>
	<?php  } ?>
  </tr>
  <?php  } ?>
  <tr>
    <td align="center">&nbsp;</td>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php  echo number_format($total_jumlah); ?></td>
    <td align="right"><?php  echo number_format($total_sisa); ?></td>
  </tr>
</table>
</body>
</html>

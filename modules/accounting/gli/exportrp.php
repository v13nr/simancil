<? session_start();
include "otentik_gli.php"; 
include ("../include/functions.php");
include ("../include/infoclient.php");
?>
<?
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Data Rekening Pembantu - " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
b { font-weight:bold;}
h4 { font-size:36px}
</style>
	<table width="1000" border="0" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="32" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="101" class="style3"><div align="center" class="style4">No. Rekening </div></td>
      <td width="272" class="style3"><div align="center" class="style4">Nama Rekening </div></td>
      <td width="38" class="style3"><div align="center" class="style4">Type</div></td>
	  <td width="92" class="style3"><div align="center" class="style4">Saldo Awal </div></td>
      <td width="108" class="style3"><div align="center" class="style4">Debet</div></td>
      <td width="118" class="style3"><div align="center" class="style4">Kredit</div></td>
	  <td width="103" class="style3"><div align="center" class="style4">Saldo Akhir</div></td>
    </tr>
	<?
		$SQL = "select * FROM $database.rekening WHERE status = 1" ;
		if($_GET['c_no']<>""){
			$SQL = $SQL . " AND noinduk LIKE '%".$_GET['c_no']."%'";
		}
		if($_GET['c_nama']<>""){
			$SQL = $SQL . " AND nama LIKE '%".$_GET['c_nama']."%'";
		}
		if($_GET['c_jk']<>""){
			$SQL = $SQL . " AND jkel = '".$_GET['c_jk']."'";
		}
		if($_GET['c_dep']<>""){
			$SQL = $SQL . " AND departemen = '".$_GET['c_dep']."'";
		}

		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$id = 0;
	?>
	<? 
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3"><?=++$No?></td>
	  <td class="style3" align="center"><?=$row['norek']?></td>
      <td class="style3"><?=$row['namarek']?></td>
      <td class="style3" align="center"><?=$row['tipe']?></td>
	  <td class="style3" align="center"><?=number_format($row['saldoawal'],2,',','.')?></td>
      <td class="style3" align="center"><?=number_format($row['debet'],2,',','.')?></td>
      <td class="style3" align="center"><?=number_format($row['kredit'],2,',','.')?></td>
	  <td class="style3" align="center"><?=number_format($row['saldoakhir'],2,',','.')?></td>
    </tr>
	<?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
  </table>
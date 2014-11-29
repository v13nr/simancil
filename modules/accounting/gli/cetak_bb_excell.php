<?php  session_start(); 
?>
<?php 
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Buku Besar -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?><?php 
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="80%%" border="1" style="border-collapse:collapse">
  <tr>
    <td><div align="center"><strong>No</strong></div></td>
    <td><div align="center"><strong>Tanggal</strong></div></td>
    <td><div align="center"><strong>No Bukti </strong></div></td>
    <td><div align="center"><strong>Uraian</strong></div></td>
    <td><div align="center"><strong>Debet</strong></div></td>
    <td><div align="center"><strong>Kredit</strong></div></td>
    <td><div align="center"><strong>Saldo</strong></div></td>
    <td><div align="center"><strong>User</strong></div></td>
  </tr>
	<?php 
			$SQLinduk = "SELECT * FROM rekening WHERE substr(norek, -4) <> '0000'";
			if($_POST['norek'] <> ""){
				$SQLinduk = $SQLinduk . " AND norek = '".$_POST['norek']."'";
			}
			$SQLinduk = $SQLinduk . " ORDER BY norek";
			$hasilinduk = mysql_query($SQLinduk);
			while($barisinduk = mysql_fetch_array($hasilinduk)){
			

	?>
	
    <tr>
      <td colspan="3" align="center"><div align="right"><b><?php  echo $barisinduk["namarek"].' - '.noreknn($barisinduk["norek"]);?></b></div></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?php 
	
			
			//saldo awal
			$SQL = "SELECT saldoawal FROM rekening WHERE norek = '". $barisinduk['norek'] ."'";
			$hasil = mysql_query($SQL);
			$barissa = mysql_fetch_array($hasil);
			$SQL = "SELECT SUM(jumlah) FROM jurnal_srb where kd = '".$barisinduk['norek']."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
			$hasil = mysql_query($SQL);
			$baris = mysql_fetch_array($hasil);
			$sa_debet = $baris[0];
			$SQL = "SELECT SUM(jumlah) FROM jurnal_srb where kk = '".$barisinduk['norek']."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
			$hasil = mysql_query($SQL);
			$baris = mysql_fetch_array($hasil);
			$sa_kredit = $baris[0];
			
			if($barisinduk['tipe']=="A"){
				$saldoawal = $barissa['saldoawal'] - $sa_debet - $sa_kredit;
			} 
			if($barisinduk['tipe']=="P"){
				$saldoawal = $barissa['saldoawal'] - $sa_kredit - $sa_debet;
			} 
			if($barisinduk['tipe']=="R"){
				$saldoawal = $barissa['saldoawal'] - $sa_kredit - $sa_debet;
			} 
			
			
				//menyimpan masing masing norek di session
				$sess_norek = $barisinduk['norek'];
				$_SESSION[$sess_norek] = $sess_norek;
				
				
				
				//menyimpan saldo awal masing masing norek di session
				$sess_norek_a = $saldoawal;
				$_SESSION[$sess_norek_a] = $sess_norek_a;
				//echo $_SESSION[$sess_norek] .'=' . $_SESSION[$sess_norek_a]; exit();
				
				
				//transaksi
				$SQL = "SELECT * FROM jurnal_srb where (kd = '".$barisinduk['norek']."' OR kk = '".$barisinduk['norek']."')";
				if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
					$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
				}
				if($_POST['divisi']<>""){
					$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
				}
				$SQL = $SQL . " ORDER BY tanggal ASC";
				$hasil = mysql_query($SQL);
				
				//saldo awal
	?>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Saldo Awal</td>
    <td align="right"><?php  echo $barisinduk["saldonormal"] == "D" ? number_format($saldoawal,2,'.',',') : '0,00'; $saldoawal_d = $saldoawal;	$saldoawal_k = 0; ?></td>
    <td align="right"><?php  echo ($barisinduk["saldonormal"] == "K") ? number_format($saldoawal,2,'.',',') : '0,00'; $saldoawal_k = $saldoawal; $saldoawal_d = 0; ?></td>
    <td align="right"><?php  echo number_format($saldoawal,2,'.',',')?></td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  $sr_debet = 0;
	$sr_kredit = 0;
	$no = 0;
  	while($baris = mysql_fetch_array($hasil)){
		$_SESSION[$sess_norek] =  $_SESSION[$sess_norek_a];
		//looping
		
		?>
  <tr>
    <td><?php  echo ++$no?></td>
    <td><div align="center">
      <?php  echo baliktglindo($baris['tanggal']); ?>
    </div></td>
    <td align="center"><?php  echo nobukti($baris['nobukti']) ?></td>
    <td><?php  echo $baris['ket']?></td>
    <td><div align="right">
      <?php  
	  if($baris['kd'] == $barisinduk['norek']){
		  echo  number_format($baris['jumlah'],2,'.',',');
	  
	  	$sr_debet = $sr_debet + $baris['jumlah'];
			
			if($barisinduk['tipe']=="A"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="P"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R"  && $barisinduk['saldonormal']=="D"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R"  && $barisinduk['saldonormal']=="K"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			
			$_SESSION[$sess_norek.'_rr'] = $saldoawal;
	}		
	  ?>
    </div></td>
    <td><div align="right">
      <?php  
	  if($baris['kk'] == $barisinduk['norek']){
	  echo  number_format($baris['jumlah'],2,'.',',');
	  	$sr_kredit = $sr_kredit + $baris['jumlah'];
			
			if($barisinduk['tipe']=="A"){
				$saldoawal = $saldoawal - $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="P"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R" && $barisinduk['saldonormal']=="D"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			if($barisinduk['tipe']=="R" && $barisinduk['saldonormal']=="K"){
				$saldoawal = $saldoawal + $baris['jumlah'];
			} 
			$_SESSION[$sess_norek.'_rr'] = $saldoawal;
	  }
	  ?>
    </div></td>
    <td><div align="right">
      <?php  echo number_format($saldoawal,2,'.',',')?>
    </div></td>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?php  } ?>
  <tr>
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

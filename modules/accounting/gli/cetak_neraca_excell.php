<? session_start(); ?>
<?
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Neraca Saldo -  Tanggal cetak : " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<?php
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

$SQL = "DELETE FROM $database.dbfn WHERE generate < concat(subdate(current_date, 2), ' 23:59:59')";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?php


	$SQLdel = "DELETE FROM $database.dbfn WHERE id = '".$a."'";
	$hasildel = mysql_query($SQLdel, $dbh_jogjaide);
	
//1. loop rek
$SQLrek = "SELECT *, debet as debet, kredit as kredit FROM $database.rekening WHERE status = 1";
$hasilrek = mysql_query($SQLrek, $dbh_jogjaide);
while($barisrek = mysql_fetch_array($hasilrek)) {

	// insert nore ke dbfn
	$SQLi = "INSERT INTO $database.dbfn(norek, namarek, debet, kredit, saldoawal, saldoakhir, tipe, id, periode, divisi, saldonormal) VALUES('".$barisrek['norek']."', '".$barisrek['namarek']."', ".$barisrek['debet'].", ".$barisrek['kredit'].", '".$barisrek['saldoawal']."', '".$barisrek['saldoakhir']."', '".$barisrek['tipe']."', '".$a."', '".$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir']."', '".$divisi."', '".$barisrek['saldonormal']."')";
	$hasili = mysql_query($SQLi, $dbh_jogjaide);
	
	//2. cari adebet; perhatikan kurang dari tgl yg direquest
	$SQLadebet = "SELECT SUM(jumlah) FROM $database.jurnal_srb WHERE kd = '".$barisrek[0]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLadebet = $SQLadebet . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet = mysql_query($SQLadebet, $dbh_jogjaide) or die($SQLadebet);
	$barisadebet = mysql_fetch_array($hasiladebet);
	//
	$SQLadebet_mem = "SELECT SUM(debet) FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLadebet_mem = $SQLadebet_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet_mem = mysql_query($SQLadebet_mem, $dbh_jogjaide) or die($SQLadebet_mem);
	$barisadebet_mem = mysql_fetch_array($hasiladebet_mem);
	
	$adebet = $barisadebet[0] + $barisadebet_mem[0];
	
	//3. cari akredit; perhatikan kurang dari tgl yg direquest
	$SQLakredit = "SELECT SUM(jumlah) FROM $database.jurnal_srb WHERE kk = '".$barisrek[0]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLakredit = $SQLakredit . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit = mysql_query($SQLakredit, $dbh_jogjaide);
	$barisakredit = mysql_fetch_array($hasilakredit);
	
	$SQLakredit_mem = "SELECT SUM(kredit) FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND b.tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLakredit_mem = $SQLakredit_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit_mem = mysql_query($SQLakredit_mem, $dbh_jogjaide);
	$barisakredit_mem= mysql_fetch_array($hasilakredit_mem);
	
	$akredit = $barisakredit[0] + $barisakredit_mem[0];
	
	if($barisrek['tipe']=="A"){
		$saldoawal = $adebet - $akredit;
	} 
	if($barisrek['tipe']=="P"){
		$saldoawal =  $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R"){
		$saldoawal =  $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R2"){
		$saldoawal =  $akredit - $adebet;
	} 
	
	//4. update saldo awal di rek laporan; perhatikan penambahan saldo 
	$SQLawal = "UPDATE $database.dbfn SET saldoawal = $saldoawal + ".$barisrek['saldoawal']." WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawal = mysql_query($SQLawal, $dbh_jogjaide);
	
	//debet
	//2. cari jumlah total debet per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetd = "SELECT SUM(jumlah) FROM $database.jurnal_srb WHERE kd = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetd = $SQLadebetd . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetd = mysql_query($SQLadebetd, $dbh_jogjaide) or die($SQLadebetd);
	$barisadebetd = mysql_fetch_array($hasiladebetd);
	
		$SQLadebetd_mem = "SELECT SUM(a.debet) as debet FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
		if($_POST['divisi']<>""){
			$SQLadebetd_mem = $SQLadebetd_mem . " AND divisi = '".$_POST['divisi']."'";
		}
		$hasiladebetd_mem = mysql_query($SQLadebetd_mem, $dbh_jogjaide) or die($SQLadebetd_mem);
		$barisadebetd_mem = mysql_fetch_array($hasiladebetd_mem);
		//if($barisrek[0]=='1110001') { echo $SQLadebetd_mem; die(); }
	$adebetd = $barisadebetd[0] + $barisadebetd_mem[0];
	
	$SQLawald = "UPDATE $database.dbfn SET debet = '".$adebetd."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawald = mysql_query($SQLawald, $dbh_jogjaide);
	
	//cari jumlah total kredit per akun; perhatikan tgl sesuai yg direquest
	$SQLadebetk = "SELECT SUM(jumlah) FROM $database.jurnal_srb WHERE kk = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetk = $SQLadebetk . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk = mysql_query($SQLadebetk, $dbh_jogjaide) or die($SQLadebetk);
	$barisadebetk = mysql_fetch_array($hasiladebetk);
	
	$SQLadebetk_mem = "SELECT SUM(a.kredit) as kredit FROM $database.jurnal a, $database.jurnal_header b WHERE a.buyer_id = b.id AND a.coa = '".$barisrek[0]."' AND (b.tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetk_mem = $SQLadebetk_mem . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk_mem = mysql_query($SQLadebetk_mem, $dbh_jogjaide) or die($SQLadebetk_mem);
	$barisadebetk_mem = mysql_fetch_array($hasiladebetk_mem);
	
	$adebetk = $barisadebetk[0] + $barisadebetk_mem[0];
	
	$SQLawalk = "UPDATE $database.dbfn SET kredit = '".$adebetk."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawalk = mysql_query($SQLawalk, $dbh_jogjaide);
	
	
} // end while loop rek



//=============================================================================


$a = session_id();
?>
<body>
<table width="70%" align="center" border="1" style="border-collapse:collapse">
  <tr>
    <td width="8%"><div align="center">Norek</div></td>
    <td width="39%"><div align="center">Uraian</div></td>
    <td width="4%"><div align="center"></div></td>
    <td width="17%"><div align="center">Debet</div></td>
    <td width="16%"><div align="center">Kredit</div></td>
    <td width="16%"><div align="center"></div></td>
  </tr>

  <tr>
    <td colspan="2">AKTIVA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <?php
 	//looping aktiva
	
	$total_k_aktiva = 0;
	$SQL = "SELECT * FROM $database.dbfn WHERE id = '".$a."' AND (tipe = 'A' OR norek LIKE 'AP%') ORDER BY norek";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	while($baris = mysql_fetch_array($hasil)){
?>
		<?php
				if(substr($baris['norek'],0,2) == 'AP'){
					$d_aktiva = $d_aktiva -  $baris['debet'];
					$k_aktiva = $k_aktiva - $baris['kredit'];
					$sr_aktiva = $sr_aktiva - ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
					$total_k_aktiva = $total_k_aktiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
				} else {
					$d_aktiva = $d_aktiva +  $baris['debet'];
					$k_aktiva = $k_aktiva + $baris['kredit'];
					$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);
					$total_d_aktiva = $total_d_aktiva +($baris['saldoawal']+$baris['debet']-$baris['kredit']);
				}
				

		?>
  <?php
	if(substr($baris['norek'],-4)=="0000"){
	
?>
  <tr>
    <td>&nbsp;</td>
    <td>
      <strong><?=$baris['namarek']?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <?php } else {
 ?>
 <tr>
    <td><div align="center">
      <?=noreknn($baris['norek'])?>
    </div></td>
    <td><?=$baris['namarek']?></td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo (substr($baris['norek'],0,2) != 'AP') ? minuss(($baris['saldoawal']+$baris['debet']-$baris['kredit']))  : "0.00"; ?></div></td>
    <td><div align="right"><?php echo (substr($baris['norek'],0,2) == 'AP') ? minuss(($baris['saldoawal']-$baris['debet']+$baris['kredit']))  : "0.00"; ?></div></td>
    <td>&nbsp;</td>
  </tr>
 <?php
  } } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <?=number_format($total_d_aktiva,2,'.',',')?>
    </div></td>
    <td><div align="right">
      <?=number_format($total_k_aktiva,2,'.',',')?>
    </div></td>
    <td><div align="right">
      <?=number_format($total_d_aktiva - $total_k_aktiva,2,'.',',')?>
    </div></td>
  </tr>
 	
        <tr>
          <td colspan="2">PASSIVA</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		
 <?php
 
//looping pasiva
$SQL = "SELECT * FROM $database.dbfn WHERE  id = '".$a."' AND (tipe = 'P' || tipe = 'R' ||tipe = 'R2') AND norek NOT LIKE 'AP%' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $d_passiva +  $baris['debet'];
	$k_passiva = $k_passiva + $baris['kredit'];
	$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);

?> 	
  		<? if(substr($baris['norek'],-4)=="0000"){		
		?>       <tr>
          <td>&nbsp;</td>
          <td><strong><?=$baris['namarek']?></strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		<?php } else { 
				if ($baris['saldonormal'] == 'D'){
					$d_aktiva = $d_aktiva +  $baris['debet'];
					$k_aktiva = $k_aktiva + $baris['kredit'];
					$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);
					$total_d_passiva = $total_d_passiva +($baris['saldoawal']+$baris['debet']-$baris['kredit']);
				}
				if($baris['saldonormal'] == 'K'){
					$d_aktiva = $d_aktiva -  $baris['debet'];
					$k_aktiva = $k_aktiva - $baris['kredit'];
					$sr_aktiva = $sr_aktiva - ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
					$total_k_passiva = $total_k_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
				}
		?>
		
        <tr>
          <td><div align="center">
            <?=noreknn($baris['norek'])?>
          </div></td>
          <td><?=$baris['namarek']?></td>
          <td>&nbsp;</td>
          <td><div align="right"><?php echo ($baris['saldonormal'] == 'D') ? number_format($baris['saldoawal']+$baris['debet']-$baris['kredit'],2,'.',',') : "0.00"; ?></div></td>
          <td><div align="right"><?php echo ($baris['saldonormal'] == 'K')  ? number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',',') : "0.00"; ?></div></td>
          <td>&nbsp;</td>
        </tr>
		<?php } } ?>
		
		
		<?php
		

//rugi laba
		
		++$no;
		$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		$ketrl = "";
		if(substr($sr_passiva,0,1) == "0"){
			$ketrl = "NIHIL";
		}
		elseif(substr($sr_passiva,0,1) == "-"){
			$ketrl = "RUGI";
		}
		else{
			$ketrl = "LABA";
		}
		
		$SQL = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE  id = '".$a."' AND tipe LIKE 'R%'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		
			$sa_passiva = $sa_passiva + $baris['saldoawal'];
			$d_passiva = $baris['debet'];
			$k_passiva = $baris['kredit'];
			$Laba = $baris['saldoawal']-$baris['debet']+$baris['kredit'];
			
			$_SESSION["laba"] = $Laba;
	
	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <?=number_format($total_d_passiva,2,'.',',')?>
    </div></td>
    <td><div align="right">
      <?=number_format($total_k_passiva,2,'.',',')?>
    </div></td>
    <td><div align="right">
      <?=number_format($total_k_passiva-$total_d_passiva,2,'.',',')?>
    </div></td>
  </tr>
</table>
</body>
</html>

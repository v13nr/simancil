<?php  session_start(); ?><?php   
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging
$barisPerHalaman = 30;

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN NERACA', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

// header
$a = session_id();
$SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  '3110%' AND norek NOT LIKE '3210%' AND id = '".$a."'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['periode'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['divisi'], 0, 0, 'L');

$pdf->setFont('Arial','',8);
$pdf->setY(57);
//$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Awal', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Saldo', 1, 0, 'C');

//looping aktiva LANCAR
	$y = 62;
	$pdf->setY($y);
	$pdf->cell(75,5,'AKTIVA LANCAR', 0, 0, 'L');	
	$y = $y + 5;
	$jml_alancar=0;
$SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  'MO1-%' AND norek NOT LIKE 'MO2-%'  AND id = '".$a."' and tipe = 'A' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'AL' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
while($baris = mysql_fetch_array($hasil)){
	
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	$pdf->cell(15,5,'', 0, 0, 'C');
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 3)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		$pdf->cell(28,5,number_format($barisc['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_alancar= $jml_alancar + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
	$y = $y + 5;
} // end loop aktiva lancar
	
	$pdf->setY($y);
	
		$pdf->cell(75,5,'JUMLAH AKTIVA LANCAR', 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,minuss($jml_alancar), 0, 0, 'R');

	$y = $y + 5;
	$pdf->setY($y);		
	$y = $y + 5;
	
//looping aktiva TETAP
	$pdf->setY($y);
	$pdf->cell(75,5,'AKTIVA TETAP', 0, 0, 'L');
	$y = $y + 5;
	
	
$SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  'MO1-%' AND norek NOT LIKE 'MO2-%'  AND id = '".$a."' and tipe = 'A' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'AT' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
while($baris = mysql_fetch_array($hasil)){
	
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	$pdf->cell(15,5,'', 0, 0, 'C');
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 3)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		$pdf->cell(28,5,number_format($barisc['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_atetap = $jml_atetap = $barisc['saldoawal']+$barisc['debet']-$barisc['kredit'];
	$y = $y + 5;
} // end loop aktiva tetap

$pdf->setY($y);
	
		$pdf->cell(75,5,'JUMLAH AKTIVA TETAP', 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,minuss($jml_atetap), 0, 0, 'R');

	$y = $y + 5;
	$pdf->setY($y);		
	$y = $y + 5;
	
$pdf->setY($y);
$pdf->cell(75,5,'JUMLAH AKTIVA', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_aktiva,2,'.',','), 1, 0, 'R');

$y = $y + 6;
$pdf->setY($y);
	$y = $y + 5;
	
	$pdf->setY($y);
	$y = $y + 5;
	
//looping kewajiban lancar
	$pdf->cell(75,5,'KEWAJIBAN LANCAR', 0, 0, 'L');	
	$jml_klancar=0;

$SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  'MO1%' AND norek NOT LIKE 'MO2%'  and norek LIKE 'KL%' AND id = '".$a."' and tipe = 'P' AND substr(norek,-4) = '0000' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	$pdf->cell(15,5,'', 0, 0, 'C');
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek NOT LIKE  'MO1-%' AND norek NOT LIKE 'MO2-%'  AND norek LIKE '".substr($baris['norek'], 0 ,4)."%' AND norek LIKE 'KL%' and id = '".$a."' ";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		$pdf->cell(28,5,number_format($barisc['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_passiva = $sa_passiva + $barisc['saldoawal'];
		$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','),0, 0, 'R');
		$d_passiva = $d_passiva +  $barisc['debet'];
		$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_passiva = $k_passiva + $barisc['kredit'];
		$pdf->cell(28,5,number_format($barisc['saldoawal']-$barisc['debet']+$barisc['kredit'],2,'.',','), 0, 0, 'R');
		$sr_passiva = $sr_passiva + ($barisc['saldoawal']-$barisc['debet']+$barisc['kredit']);
		$jml_klancar=$jml_klancar+ ($barisc['saldoawal']-$barisc['debet']+$barisc['kredit']);
	$y = $y + 5;
} // end loop kewajiban ancara

$pdf->setY($y);
	
		$pdf->cell(75,5,'JUMLAH KEWAJIBAN LANCAR', 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,minuss($jml_klancar), 0, 0, 'R');

	$y = $y + 5;
	$pdf->setY($y);		
	$y = $y + 5;

	$pdf->setY($y);
	$y = $y + 5;
	
//looping kewajiban lancar
	$pdf->cell(75,5,'MODAL SENDIRI', 0, 0, 'L');	
	$jml_klancar=0;

//rugi laba

$pdf->setY($y);
/*
$SQL = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE id = '".$a."' and tipe LIKE 'R%'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
//$pdf->cell(8,5,++$no, 1, 0, 'C');
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
*/

$SQLm = "SELECT SUM(saldoawal) as saldoawalm1, SUM(debet) as debetm1, SUM(kredit) as kreditm1 FROM $database.dbfn WHERE norek LIKE  'MO1-%' AND norek  LIKE 'MO2-%'  and id = '".$a."' ";
		$hasilm = mysql_query($SQLm, $dbh_jogjaide) or die($SQLm);
		$barism = mysql_fetch_array($hasilm);
		
		//perhitungan modal
		//$Modal = $barism["saldoawalm1"] +  $barism["debetm1"] +  $barism["kreditm1"] + $_SESSION["laba"];
		
	$pdf->cell(15,5,'', 0, 0, 'C');
	$pdf->cell(60,5,Modal, 0, 0, 'L');
	$pdf->cell(28,5,number_format($_SESSION["modalAwal"],2,'.',','), 0, 0, 'R');
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
	$d_passiva = $d_passiva +  $baris['debet'];
	$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
	$k_passiva = $k_passiva + $baris['kredit'];
	$pdf->cell(28,5,number_format($_SESSION["modalAkhir"],2,'.',','), 0, 0, 'R');

$y =$y + 5;


$pdf->setY($y);
	
		$pdf->cell(75,5,'JUMLAH MODAL SENDIRI', 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,number_format($_SESSION["modalAkhir"],2,'.',','), 0, 0, 'R');

	$y = $y + 5;
	$pdf->setY($y);		
	$y = $y + 5;
	
$pdf->setY($y);
$y =$y + 5;

$pdf->setY($y);
$pdf->cell(75,5,'JUMLAH KEWAJIBAN DAN MODAL', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva+$_SESSION["modalAwal"],2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva+$_SESSION["modalAkhir"],2,'.',','), 1, 0, 'R');
$pdf->Output();
?>
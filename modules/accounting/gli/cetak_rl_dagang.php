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
$pdf->cell(190,6,'LAPORAN  LABA RUGI', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

// header
$a = session_id();
$SQL = "SELECT * FROM $database.dbfn WHERE id = '".$a."'";
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
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Awal', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Saldo', 1, 0, 'C');

$barisPerHalaman = 42;
$no = 0;

//looping aktiva
$y = 62;
$sr_passiva = 0;
$SQL = "SELECT * FROM $database.dbfn WHERE tipe = 'R' AND id = '".$a."' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	++$no;
	$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
	if(substr($baris['norek'],-4)=="0000"){
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
	} else {
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_passiva = $sa_passiva + $baris['saldoawal'];
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$d_passiva = $d_passiva +  $baris['debet'];
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$k_passiva = $k_passiva + $baris['kredit'];
		$pdf->cell(28,5,minuss($baris['saldoawal']-$baris['debet']+$baris['kredit']), 0, 0, 'R');
		$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		
	}
	$y = $y + 5;
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(57);
		//$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(60,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'Awal', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(28,5,'Saldo', 1, 0, 'C');		
		$y = 62;
	}
} // end loop aktiva

$pdf->setY($y);
++$no;
$pdf->cell(75,5,'TOTAL RUGI LABA OPERASIONAL', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva,2,'.',','), 1, 0, 'R');

//==== RL NON OP
$y = $y + 6; 
$sr_passiva_R2 = 0;
$SQL = "SELECT * FROM $database.dbfn WHERE tipe = 'R2' AND id = '".$a."' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	//$pdf->cell(8,5,++$no, 1, 0, 'C');
	++$no;
	$pdf->cell(15,5,noreknn($baris['norek']), 0, 0, 'C');
	if(substr($baris['norek'],-3)=="000"){
		$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
		$pdf->cell(28,5,'', 0, 0, 'R');
	} else {
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$sa_passiva_R2 = $sa_passiva_R2 + $baris['saldoawal'];
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$d_passiva_R2 = $d_passiva_R2 +  $baris['debet'];
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$k_passiva_R2 = $k_passiva_R2 + $baris['kredit'];
		$pdf->cell(28,5,minuss($baris['saldoawal']-$baris['debet']+$baris['kredit']), 0, 0, 'R');
		$sr_passiva_R2 = $sr_passiva_R2 + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
		
	}
	$y = $y + 5;
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(57);
		//$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(60,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'Awal', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(28,5,'Saldo', 1, 0, 'C');		
		$y = 62;
	}
} // end loop aktiva

$pdf->setY($y);
++$no;
$pdf->cell(75,5,'TOTAL RUGI LABA NON OPERASIONAL', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva_R2,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,minuss($sr_passiva_R2,2,'.',','), 1, 0, 'R');

$y= $y + 6;
$pdf->setY($y);
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

$pdf->cell(75,5,$ketrl, 1, 0, 'C');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,'', 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva + $sr_passiva_R2,2,'.',','), 1, 0, 'R');

$pdf->Output();
?>
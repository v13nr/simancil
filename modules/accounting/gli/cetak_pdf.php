<?php  session_start(); ?><?php 
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/terbilang.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

$SQL = "select * from $database.jurnal_srb where sub = '".$_GET['divisi']."'  and bulan = '".$_GET['bulan']."' and nobukti = '".$_GET['nobukti']."'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
	if($baris["jenis"]=="Kredit"){
		$norek = $baris["kk"];
			$SQLc = "SELECT namarek FROM rekening WHERE norek = '".$baris["kk"]."'";
			$hasilc = mysql_query($SQLc, $dbh_jogjaide);
			$barisc = mysql_fetch_array($hasilc);
		$namarek = $barisc[0];
		$uraian = $baris["ket2"];
		$jeniskas = "KELUAR";
	}
	if($baris["jenis"]=="Debet"){
		$norek = $baris["kd"];
			$SQLc = "SELECT namarek FROM rekening WHERE norek = '".$baris["kd"]."'";
			$hasilc = mysql_query($SQLc, $dbh_jogjaide);
			$barisc = mysql_fetch_array($hasilc);
		$namarek = $barisc[0];
		$uraian = $baris["ket"];
		$jeniskas = "MASUK";
	}	

$pdf->setY(14);
$pdf->setFont('Arial','',10);
$pdf->cell(30,6,'DIVISI', 1, 0, 'C');
$pdf->setFont('Arial','B',12);
$pdf->cell(125,6,'SLIP TRANSAKSI ', 1, 0, 'C');
$pdf->setFont('Arial','',10);
$pdf->cell(35,6,'TANGGAL', 1, 0, 'C');
$pdf->setY(20);	
$pdf->cell(30,6,$_GET['divisi'], 1, 0, 'C');
$pdf->cell(30,6,$norek, 1, 0, 'L');
$pdf->cell(95,6,$namarek, 1, 0, 'L');
$pdf->cell(35,6,$_GET['tanggal'], 1, 0, 'C');
$pdf->setY(26);	
$pdf->cell(30,6,'', 1, 0, 'C');
$pdf->cell(30,6,'Uraian', 1, 0, 'L');
$pdf->cell(95,6,$uraian, 1, 0, 'L');
$pdf->setFont('Arial','B',10);
$pdf->cell(35,6,'No. '.$_GET['divisi'].'/'.nobukti($_GET['nobukti']).'/'.substr($_GET['bulan'],0,2), 1, 0, 'C');
$pdf->setY(35);	
$pdf->cell(10,6,'NO.', 1, 0, 'C');
$pdf->cell(20,6,'NOREK', 1, 0, 'C');
$pdf->cell(40,6,'NAMA', 1, 0, 'L');
$pdf->cell(85,6,'URAIAN', 1, 0, 'L');
$pdf->cell(35,6,'JUMLAH', 1, 0, 'C');
$pdf->setFont('Arial','',10);

$SQL = "select * from $database.jurnal_srb where sub = '".$_GET['divisi']."'   and bulan = '".$_GET['bulan']."'  and nobukti = '".$_GET['nobukti']."'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$y = 41;
$total = 0;

while($baris = mysql_fetch_array($hasil)){
	//looping
	$pdf->setY($y);	
	$pdf->cell(10,6,++$no.'.', 1, 0, 'C');
	if($baris["jenis"]=="Kredit"){
		$pdf->cell(20,6,$baris["kd"], 1, 0, 'C');
			$SQLc = "SELECT namarek FROM rekening WHERE norek = '".$baris["kd"]."'";
			$hasilc = mysql_query($SQLc, $dbh_jogjaide);
			$barisc = mysql_fetch_array($hasilc);
		$pdf->cell(160,6,$barisc[0], 1, 0, 'L');
		$y = $y+6;		
		$pdf->setY($y);	
		$pdf->cell(10,6,'', 1, 0, 'C');
		$pdf->cell(20,6,'Ket :', 1, 0, 'R');
		$pdf->cell(115,6,$baris["ket"], 1, 0, 'L');		
	}
	if($baris["jenis"]=="Debet"){
		$pdf->cell(20,6,$baris["kk"], 1, 0, 'C');
			$SQLc = "SELECT namarek FROM rekening WHERE norek = '".$baris["kk"]."'";
			$hasilc = mysql_query($SQLc, $dbh_jogjaide);
			$barisc = mysql_fetch_array($hasilc);
		$pdf->cell(160,6,$barisc[0], 1, 0, 'L');
		$y = $y+6;		
		$pdf->setY($y);	
		$pdf->cell(10,6,'', 1, 0, 'C');
		$pdf->cell(20,6,'Ket :', 1, 0, 'R');
		$pdf->cell(115,6,$baris["ket2"], 1, 0, 'L');		
	}	
	$pdf->cell(10,6,'Rp.', 1, 0, 'L');
	$pdf->cell(35,6,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R');
	$total = $total + $baris['jumlah'];
	$y = $y+6;
}
//total
$pdf->setY($y);
$pdf->cell(10,6,'', 1, 0, 'C');
$pdf->cell(20,6,'', 1, 0, 'C');
$pdf->cell(40,6,'', 1, 0, 'L');
$pdf->cell(75,6,'TOTAL', 1, 0, 'R');			
$pdf->cell(10,6,'Rp.', 1, 0, 'L');
$pdf->cell(35,6,number_format($total,2,'.',','), 1, 0, 'R');

$y = $y + 6;
$pdf->setY($y);
$pdf->cell(190,6,'Terbilang : '.terbilang($total).' Rupiah.', 1, 0, 'L');			

$y = $y + 16;
$pdf->setY($y);
$pdf->cell(40,6,'Mengetahui', 0, 0, 'C');
$pdf->cell(50,6,'Kasir', 0, 0, 'C');
$pdf->cell(50,6,'Admin', 0, 0, 'C');
$pdf->cell(50,6,'Menerima', 0, 0, 'C');

$pdf->Output();
?>
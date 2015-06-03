<?php  session_start(); ?><?php 
if(isset($_POST["excell"])){
	header("location: cetak_jurnal_excell.php");
}
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging
$barisPerHalaman = 25;

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN JURNAL', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
	$divisi = "ALL";
	if($_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
$pdf->cell(50,6,': '.$divisi, 0, 0, 'L');

$pdf->setFont('Arial','',7);
$pdf->setY(52);
$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(90,5,'Uraian', 1, 0, 'C');
$pdf->cell(25,5,'Debet', 1, 0, 'C');
$pdf->cell(25,5,'Kredit', 1, 0, 'C');

$SQL = "SELECT A.*, (SELECT COUNT(id)+1 from jurnal_srb B WHERE B.nobukti = A.nobukti) AS child FROM jurnal_srb A 
where A.id <> ''";
if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
	$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
}
if($_POST['divisi']<>""){
	$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
}
if($_POST['user']<>""){
	$SQL = $SQL . " AND user_id = '".$_POST['user']."'";
}
$SQL = $SQL . "  group by nobukti ORDER BY id, jenis ASC";
$hasil = mysql_query($SQL);
//die($SQL);

$y = 57;
while($baris = mysql_Fetch_array($hasil)){
	//looping
	
	if($baris['jenis']=="Debet") {
		//cari apakah debet > 1
		$SQLcd = "select * from jurnal_srb WHERE nobukti = '".$baris["nobukti"]."'";
		$hasilcd = mysql_query($SQLcd) or die(mysql_error());
		$jumcd = mysql_num_rows($hasilcd);
		$Nocd = 1;
		if( $jumcd > 1){
			while($bariscd = mysql_fetch_array($hasilcd)){
				$pdf->setY($y);
				$pdf->cell(8,5,($Nocd == 1)? ++$no :"", 1, 0, 'C');
				++$No;
				$pdf->cell(15,5,($Nocd == 1)? baliktglindo($baris['tanggal']) : "", 1, 0, 'C');
				$pdf->cell(15,5,($Nocd == 1)? substr($baris['jenis'],0,1).'/'.$bariscd['nobukti'] : "", 1, 0, 'C');
				$Nocd++;
			
				if($bariscd['jenis']=="Debet") {
					$pdf->cell(15,5,$bariscd['kd'], 1, 0, 'C');
				}
				if($bariscd['jenis']=="Kredit") {
					$pdf->cell(15,5,$bariscd['kk'], 1, 0, 'C');
				}
						
				$pdf->cell(90,5,substr($bariscd['ket'],0,100), 1, 0, 'L');
				$sqlj = "select (jumlah) from jurnal_srb where id = '".$bariscd['id']."'";
				$hasilj = mysql_query($sqlj) or die(mysql_error());
				$barisj = mysql_fetch_array($hasilj);
				$pdf->cell(25,5,number_format($barisj[0],2,'.',','), 1, 0, 'R');
				$TOTAL = $TOTAL + $barisj[0];
				$pdf->cell(25,5,'0.00', 1, 0, 'R');
				$y = $y + 5;
			}
		} else {
			$pdf->setY($y);
			$pdf->cell(8,5,++$no, 1, 0, 'C');
			++$No;
			$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
			$pdf->cell(15,5,substr($baris['jenis'],0,1).'/'.nobukti($baris['nobukti']), 1, 0, 'C');
		
			if($baris['jenis']=="Debet") {
				$pdf->cell(15,5,$baris['kd'], 1, 0, 'C');
			}
			if($baris['jenis']=="Kredit") {
				$pdf->cell(15,5,$baris['kk'], 1, 0, 'C');
			}
					
			$pdf->cell(90,5,substr($baris['ket'],0,100), 1, 0, 'L');
			$sqlj = "select sum(jumlah) from jurnal_srb where nobukti = '".$baris['nobukti']."'";
			$hasilj = mysql_query($sqlj) or die(mysql_error());
			$barisj = mysql_fetch_array($hasilj);
			$pdf->cell(25,5,number_format($barisj[0],2,'.',','), 1, 0, 'R');
			$TOTAL = $TOTAL + $barisj[0];
			$pdf->cell(25,5,'0.00', 1, 0, 'R');
			$y = $y + 5;
		}
	}
	
	//anak
	$SQLkr = "SELECT * FROM jurnal_srb where id <> '' and nobukti = '".$baris['nobukti']."' order by id ";
	$hasilkr = mysql_query($SQLkr) or die(mysql_error());
	$i=0;
	while($bariskr = mysql_fetch_array($hasilkr)){
		
		++$No;
		$pdf->setY($y);
		if($i==0 && $baris['jenis']=="Kredit") {
			$pdf->cell(8,5,++$no, 1, 0, 'C');
			$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
			$pdf->cell(15,5,substr($baris['jenis'],0,1).'/'.($baris['nobukti']), 1, 0, 'C');
		} else {
			$pdf->cell(8,5,'', 1, 0, 'C');
			$pdf->cell(15,5,'', 1, 0, 'C');
			$pdf->cell(15,5,'', 1, 0, 'C');
		}
		$i++;
		
		if($baris['jenis']=="Debet") {
			$pdf->cell(15,5,$bariskr['kk'], 1, 0, 'C');
			$pdf->cell(90,5,substr($bariskr['ket2'],0,100), 1, 0, 'L');
		}

		if($baris['jenis']=="Kredit") {
			$pdf->cell(15,5,$bariskr['kd'], 1, 0, 'C');
			$pdf->cell(90,5,substr($bariskr['ket'],0,100), 1, 0, 'L');
		}
		
		if($baris['jenis']=="Kredit") {
			$pdf->cell(25,5,number_format($bariskr['jumlah'],2,'.',','), 1, 0, 'R');
			$pdf->cell(25,5,'0.00', 1, 0, 'R');
		} else {
			$pdf->cell(25,5,'0.00', 1, 0, 'R');
			$pdf->cell(25,5,number_format($bariskr['jumlah'],2,'.',','), 1, 0, 'R');			
		}
		$y = $y + 5;
	}
	
	if($baris['jenis']=="Kredit") {
		$pdf->setY($y);
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
	
		if($baris['jenis']=="Debet") {
			$pdf->cell(15,5,$baris['kd'], 1, 0, 'C');
			$pdf->cell(90,5,substr($baris['ket'],0,100), 1, 0, 'L');
		}
		if($baris['jenis']=="Kredit") {
			$pdf->cell(15,5,$baris['kk'], 1, 0, 'C');
			$pdf->cell(90,5,substr($baris['ket2'],0,100), 1, 0, 'L');
		}
		
		$sqlj = "select sum(jumlah) from jurnal_srb where nobukti = '".$baris['nobukti']."'";
		$hasilj = mysql_query($sqlj) or die(mysql_error());
		$barisj = mysql_fetch_array($hasilj);
		$pdf->cell(25,5,'0.00', 1, 0, 'R');
		$pdf->cell(25,5,number_format($barisj[0],2,'.',','), 1, 0, 'R');
		$TOTAL = $TOTAL + $barisj[0];
		$y = $y + 5;
	}
	
	//paging
	if(($No % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(52);
		$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
		$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(90,5,'Uraian', 1, 0, 'C');
		$pdf->cell(25,5,'Debet', 1, 0, 'C');
		$pdf->cell(25,5,'Kredit', 1, 0, 'C');
		$y = 57;
	} // end if paging
} // end looping jurnal

$pdf->setY($y);
$pdf->cell(8,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(90,5,'TOTAL', 1, 0, 'R');
$pdf->cell(25,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');
$pdf->cell(25,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');

$pdf->Output();
?>
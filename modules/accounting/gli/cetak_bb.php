<?php  session_start(); 
if(isset($_POST["excell"])){
	header("location: cetak_bb_excell.php");
}
?>
<?php 
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

	periode($_POST['tgl_akhir']);
	$_SESSION["tgl_awal"] = $_POST["tgl_awal"];
	$_SESSION["tgl_akhir"] = $_POST["tgl_akhir"];
	
date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();

$SQLinduk = "SELECT * FROM rekening WHERE substr(norek, -4) <> '0000'";
if($_POST['norek'] <> ""){
	$SQLinduk = $SQLinduk . " AND norek = '".$_POST['norek']."'";
}
$SQLinduk = $SQLinduk . " ORDER BY norek";
$hasilinduk = mysql_query($SQLinduk);
while($barisinduk = mysql_fetch_array($hasilinduk)){

	$pdf->AddPage();
	
	//inisialisasi baris untuk paging
	$barisPerHalaman = 30;
	
	$pdf->setY(14);
	$pdf->setFont('Arial','',12);
	$pdf->cell(190,6,'LAPORAN BUKU BESAR', 0, 0, 'C');
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
	$_SESSION["periode"] = $_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir'];
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
	$pdf->setY(50);
	$pdf->cell(20,6,'Rekening ', 0, 0, 'L');
		$SQL = "SELECT namarek FROM rekening WHERE norek = '".$barisinduk['norek']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
	$pdf->cell(50,6,': '.$baris[0].' - '.noreknn($barisinduk['norek']), 0, 0, 'L');
	
	$pdf->setFont('Arial','',8);
	$pdf->setY(57);
	$pdf->cell(8,5,'No.', 1, 0, 'C');
	$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
	$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
	$pdf->cell(50,5,'Uraian', 1, 0, 'C');
	$pdf->cell(28,5,'Debet', 1, 0, 'C');
	$pdf->cell(28,5,'Kredit', 1, 0, 'C');
	$pdf->cell(30,5,'Saldo', 1, 0, 'C');
	$pdf->cell(19,5,'User', 1, 0, 'C');
	
	//saldo awal
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
	
	$y = 62;
	//saldo awal
	$pdf->setY($y);
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(50,5,'Saldo Awal', 1, 0, 'L');
		if($barisinduk["saldonormal"] == "D"){
			$pdf->cell(28,5,number_format($saldoawal,2,'.',','), 1, 0, 'R');
			$pdf->cell(28,5,'', 1, 0, 'R'); //kredit
			$saldoawal_d = $saldoawal;
			$saldoawal_k = 0;
		} 
		if($barisinduk["saldonormal"] == "K"){
			$pdf->cell(28,5,'', 1, 0, 'R');
			$pdf->cell(28,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //kredit
			$saldoawal_k = $saldoawal;
			$saldoawal_d = 0;
		}
		$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
		$pdf->cell(19,5,'', 1, 0, 'C');
		
	$y = 67;
	$sr_debet = 0;
	$sr_kredit = 0;
	while($baris = mysql_fetch_array($hasil)){
		$_SESSION[$sess_norek] =  $_SESSION[$sess_norek_a];
		//looping
		$pdf->setY($y);
		$pdf->cell(8,5,++$no, 1, 0, 'C');
		$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
		$pdf->cell(15,5,(substr($baris['nobukti'],0,3) == "GGE")? substr($baris['nobukti'],-4) : "", 1, 0, 'C');
		$pdf->cell(50,5,substr($baris['ket'],0,30), 1, 0, 'L');
		if($baris['kd'] == $barisinduk['norek']){
			$pdf->cell(28,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R'); //debet
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
			$pdf->cell(28,5,'0.00', 1, 0, 'R'); //kredit
		}

		if($baris['kk'] == $barisinduk['norek']){
			$pdf->cell(28,5,'0.00', 1, 0, 'R'); //debet
			$pdf->cell(28,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R'); //kredit
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
		
		
			$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
		
		
//			$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$baris['user_id'];
	//		$hasiluser= mysql_query($SQLuser);
		//	$barisuser = mysql_fetch_array($hasiluser);
		$pdf->cell(19,5,$barisuser[0], 1, 0, 'C');
		$y = $y + 5;
		
		//paging
		
		if(($no % $barisPerHalaman) == 0){
			$pdf->AddPage();
			$pdf->setY(52);
			$pdf->cell(8,5,'No.', 1, 0, 'C');
			$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
			$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
			$pdf->cell(50,5,'Uraian', 1, 0, 'C');
			$pdf->cell(28,5,'Debet', 1, 0, 'C');
			$pdf->cell(28,5,'Kredit', 1, 0, 'C');
			$pdf->cell(30,5,'Saldo', 1, 0, 'C');
			$pdf->cell(19,5,'User', 1, 0, 'C');
			$y = 57;
		} // end if paging */
	} // end looping jurnal
	
	
	$pdf->setY($y);
		
	if($barisinduk['tipe']=="A"){
		$rr = $barissa['saldoawal'] + $sr_debet - $sr_debet;
	} 
	if($barisinduk['tipe']=="P"){
		$rr = $barissa['saldoawal'] + $sr_kredit - $sr_debet;
	} 
	if($barisinduk['tipe']=="R"){
		$rr = $barissa['saldoawal'] + $sr_kredit - $sr_debet;
	} 	
		$_SESSION[$sess_norek] =  $_SESSION[$sess_norek_a];
		$_SESSION[$sess_norek.'_rd'] =  $sr_debet;
		$_SESSION[$sess_norek.'_rk'] =  $sr_kredit;
	
	//rekening upah tenaga kerja
	//BP1-5113
	if($barisinduk['norek']=="BP1-5113"){
		$_SESSION["BP1-5113_tdebet"] = $sr_debet;
		//upah tenaga kerja langsung = upah borongan
		$SQLb = "SELECT SUM(jumlah) FROM jurnal_srb WHERE ket LIKE 'Upah Borongan Unit%' ";
		$SQLb = $SQLb . " AND kd = 'BP1-5113' AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
		$hasilb = mysql_query($SQLb)or die(mysql_error());
		$barisb = mysql_fetch_array($hasilb);
		$_SESSION["BP1-5113_borongan"] = $barisb[0];
		$SQLb = "SELECT SUM(jumlah) FROM jurnal_srb WHERE ket NOT LIKE 'Upah Borongan Unit%' ";
		$SQLb = $SQLb . " AND kd = 'BP1-5113'  AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
		$hasilb = mysql_query($SQLb);
		$barisb = mysql_fetch_array($hasilb);
		$_SESSION["BP1-5113_tk_taklangsung"] = $barisb[0];
	}
	
		$pdf->cell(8,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(15,5,'', 1, 0, 'C');
		$pdf->cell(50,5,'TOTAL', 1, 0, 'L');
		$pdf->cell(28,5,number_format($sr_debet + $saldoawal_d,2,'.',','), 1, 0, 'R'); //debet
		$pdf->cell(28,5,number_format($sr_kredit + $saldoawal_k,2,'.',','), 1, 0, 'R'); //kredit
		$pdf->cell(30,5,number_format($saldoawal,2,'.',','), 1, 0, 'R'); //saldo
		$pdf->cell(19,5,'', 1, 0, 'C');
} // end while loop rekening
$pdf->Output();
?>
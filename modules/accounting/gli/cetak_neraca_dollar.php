<?php 

//=============================================================================
//proses perhitungan neraca
$a = session_id();
	$divisi = "ALL";
	if($_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
	$SQLdel = "DELETE FROM dbfn WHERE id = '".$a."'";
	$hasildel = mysql_query($SQLdel);
	
//1. loop rek
$SQLrek = "SELECT * FROM rekening WHERE status = 1";
$hasilrek = mysql_query($SQLrek);
while($barisrek = mysql_fetch_array($hasilrek)) {

	// insert nore ke dbfn
	$SQLi = "INSERT INTO dbfn(idn, norek, namarek, tipe, id, periode, divisi) VALUES('', '".$barisrek['norek']."', '".$barisrek['namarek']."', '".$barisrek['tipe']."', '".$a."', '".$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir']."', '".$divisi."')";
	$hasili = mysql_query($SQLi);
	
	//2. cari adebet
	$SQLadebet = "SELECT SUM(dollar) FROM jurnal_srb WHERE kd = '".$barisrek[0]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLadebet = $SQLadebet . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebet = mysql_query($SQLadebet) or die($SQLadebet);
	$barisadebet = mysql_fetch_array($hasiladebet);
	$adebet = $barisadebet[0];
	//3. cari akredit
	$SQLakredit = "SELECT SUM(dollar) FROM jurnal_srb WHERE kk = '".$barisrek[0]."' AND tanggal < '".baliktgl($_POST['tgl_awal'])."'";
	if($_POST['divisi']<>""){
		$SQLakredit = $SQLakredit . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasilakredit = mysql_query($SQLakredit);
	$barisakredit = mysql_fetch_array($hasilakredit);
	$akredit = $barisakredit[0];
	
	if($barisrek['tipe']=="A"){
		$saldoawal = $adebet - $akredit;
	} 
	if($barisrek['tipe']=="P"){
		$saldoawal = $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R"){
		$saldoawal = $akredit - $adebet;
	} 
	if($barisrek['tipe']=="R2"){
		$saldoawal = $akredit - $adebet;
	} 
	
	//4. update saldo awal di rek
	$SQLawal = "UPDATE dbfn SET saldoawal = '".$saldoawal."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawal = mysql_query($SQLawal);
	
	//debet
	//2. cari adebet
	$SQLadebetd = "SELECT SUM(dollar) FROM jurnal_srb WHERE kd = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetd = $SQLadebetd . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetd = mysql_query($SQLadebetd) or die($SQLadebetd);
	$barisadebetd = mysql_fetch_array($hasiladebetd);
	$adebetd = $barisadebetd[0];
	$SQLawald = "UPDATE dbfn SET debet = '".$adebetd."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawald = mysql_query($SQLawald);
	/*
	if($barisrek[0]=="1010002"){
		echo $SQLadebetd."<br>";
		echo $adebetd;
		exit();
	}
	*/
	
	$SQLadebetk = "SELECT SUM(dollar) FROM jurnal_srb WHERE kk = '".$barisrek[0]."' AND (tanggal BETWEEN '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."')";
	if($_POST['divisi']<>""){
		$SQLadebetk = $SQLadebetk . " AND divisi = '".$_POST['divisi']."'";
	}
	$hasiladebetk = mysql_query($SQLadebetk) or die($SQLadebetk);
	$barisadebetk = mysql_fetch_array($hasiladebetk);
	$adebetk = $barisadebetk[0];
	$SQLawalk = "UPDATE dbfn SET kredit = '".$adebetk."' WHERE norek = '".$barisrek['norek']."' AND id = '".$a."'";
	$hasilawalk = mysql_query($SQLawalk);
	
	
} // end while loop rek



//=============================================================================


$a = session_id();

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN NERACA MUTASI', 0, 0, 'C');
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

$pdf->setFont('Arial','',8);
$pdf->setY(57);
//$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(60,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Awal', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(28,5,'Saldo', 1, 0, 'C');

$barisPerHalaman = 40;
$no = 0;

//looping aktiva
$y = 62;
$SQL = "SELECT * FROM dbfn WHERE id = '".$a."' AND tipe = 'A' ORDER BY norek";
$hasil = mysql_query($SQL);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	$sa_aktiva = $sa_aktiva + $baris['saldoawal'];
	$d_aktiva = $d_aktiva +  $baris['debet'];
	$k_aktiva = $k_aktiva + $baris['kredit'];
	$sr_aktiva = $sr_aktiva + ($baris['saldoawal']+$baris['debet']-$baris['kredit']);

	
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-3)=="000"){
			//$pdf->cell(8,5,++$no, 1, 0, 'C');
			++$no;
			$pdf->cell(15,5,$baris['norek'], 0, 0, 'C');
			$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$y = $y + 5;
		} 
	} else {
		//$pdf->cell(8,5,++$no, 1, 0, 'C');
		++$no;
		$pdf->cell(15,5,$baris['norek'], 0, 0, 'C');
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['saldoawal']+$baris['debet']-$baris['kredit'],2,'.',','), 0, 0, 'R');
		$y = $y + 5;
	}
	
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
$pdf->cell(75,5,'TOTAL AKTIVA', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_aktiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_aktiva,2,'.',','), 1, 0, 'R');

//looping pasiva
$y = $y + 6;
$SQL = "SELECT * FROM dbfn WHERE  id = '".$a."' AND tipe = 'P' ORDER BY norek";
$hasil = mysql_query($SQL);
while($baris = mysql_fetch_array($hasil)){
	$pdf->setY($y);
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$d_passiva = $d_passiva +  $baris['debet'];
	$k_passiva = $k_passiva + $baris['kredit'];
	$sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);
	
		
	if($baris['saldoawal']=="0.00" && $baris['debet']=="0.00" && $baris['kredit']=="0.00") {
		if(substr($baris['norek'],-3)=="000"){
			//$pdf->cell(8,5,++$no, 1, 0, 'C');
			++$no;
			$pdf->cell(15,5,$baris['norek'], 0, 0, 'C');
			$pdf->cell(60,5,$baris['namarek'], 0, 0, 'L');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$pdf->cell(28,5,'', 0, 0, 'R');
			$y = $y + 5;
		} 
	} else {
		//$pdf->cell(8,5,++$no, 1, 0, 'C');
		++$no;
		$pdf->cell(60,5,'        '.$baris['namarek'], 0, 0, 'L');
		$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['debet'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
		$pdf->cell(28,5,number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');	
		$y = $y + 5;
	}
		
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
} // end loop passiva

//rugi laba
$pdf->setY($y);
$SQL = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM dbfn WHERE  id = '".$a."' AND tipe LIKE 'R%'";
$hasil = mysql_query($SQL);
$baris = mysql_fetch_array($hasil);
//$pdf->cell(8,5,++$no, 1, 0, 'C');
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
	$pdf->cell(15,5,'', 0, 0, 'C');
	$pdf->cell(60,5,$ketrl, 0, 0, 'L');
	$pdf->cell(28,5,number_format($baris['saldoawal'],2,'.',','), 0, 0, 'R');
	$sa_passiva = $sa_passiva + $baris['saldoawal'];
	$pdf->cell(28,5,number_format($baris['debet'],2,'.',','),0, 0, 'R');
	$d_passiva = $d_passiva +  $baris['debet'];
	$pdf->cell(28,5,number_format($baris['kredit'],2,'.',','), 0, 0, 'R');
	$k_passiva = $k_passiva + $baris['kredit'];
	$pdf->cell(28,5,number_format($baris['saldoawal']-$baris['debet']+$baris['kredit'],2,'.',','), 0, 0, 'R');
	
$y =$y + 5;

$pdf->setY($y);
$pdf->cell(75,5,'TOTAL PASSIVA', 1, 0, 'C');
$pdf->cell(28,5,number_format($sa_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($d_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($k_passiva,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($sr_passiva,2,'.',','), 1, 0, 'R');
$pdf->Output();
?>
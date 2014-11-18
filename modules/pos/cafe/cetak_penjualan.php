<? session_start(); ?><?php
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/terbilang.php");
include("../include/infoclient.php");
include "otentik_inv.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

$SQLj = "SELECT * FROM mutasi WHERE status = 1 AND sub = '".$_SESSION["sess_tipe"]."' AND model = 'INV' AND nomor = '".$_GET['nomor']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj);
		$nRecord = 1;
		$row=mysql_fetch_array($hasilj);

$pdf->setFont('Arial','',10);		
$pdf->setY(14);
$pdf->cell(115,6,$namaclient, 0, 0, 'L');
$pdf->cell(15,6,'Kepada : ', 0, 0, 'L');
$pdf->cell(30,6,$row['nama'], 0, 0, 'L');
$pdf->setY(19);
$pdf->cell(130,6,$jalamclient , 0, 0, 'L');
$pdf->cell(30,6,$row['alamat'], 0, 0, 'L');
$pdf->setY(24);
$pdf->cell(130,6,$telponclient, 0, 0, 'L');
$pdf->cell(30,6,$row['kota'].', '.$row['tlp'], 0, 0, 'L');
$pdf->setY(32);

$pdf->cell(30,6,'', 0, 0, 'C');
$pdf->setFont('Arial','B',12);
$pdf->cell(130,6,'FAKTUR PENJUALAN', 0, 0, 'C');
$pdf->setFont('Arial','',10);
$pdf->cell(30,6,'', 0, 0, 'C');
$pdf->setY(38);	
$pdf->cell(30,6,$_GET['divisi'], 0, 0, 'C');
$pdf->cell(30,6,$norek, 0, 0, 'L');
$pdf->cell(100,6,$namarek, 0, 0, 'L');
$pdf->cell(30,6,$_GET['tanggal'], 0, 0, 'C');
$pdf->setY(42);	
$pdf->setFont('Arial','B',10);
$pdf->cell(30,6,'No Faktur. INV/'.$_SESSION["sess_tipe"].'/'.nobukti($_GET['nomor']), 0, 0, 'L');
$pdf->setY(48);	
$pdf->cell(10,6,'NO.', 1, 0, 'C');
$pdf->cell(70,6,'NAMA BARANG', 1, 0, 'L');
$pdf->cell(15,6,'QTY', 1, 0, 'C');
$pdf->cell(30,6,'HARGA', 1, 0, 'C');
$pdf->cell(30,6,'DISC', 1, 0, 'C');
$pdf->cell(35,6,'JUMLAH', 1, 0, 'C');

$pdf->setFont('Arial','',10);
$y = 54;

$SQLj = "SELECT * FROM mutasi WHERE status = 1 AND sub = '".$_SESSION["sess_tipe"]."' AND model = 'INV' AND nomor = '".$_GET['nomor']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) {

$pdf->setY($y);			
$pdf->cell(10,6,++$no, 1, 0, 'C');
$pdf->cell(70,6,$row['namabrg'], 1, 0, 'L');
$pdf->cell(15,6,number_format($row['qtyout']), 1, 0, 'C');
$pdf->cell(30,6,number_format($row['harga']), 1, 0, 'R');
$pdf->cell(30,6,number_format($row['discrp']), 1, 0, 'R');
$pdf->cell(35,6,number_format($row['kredit']), 1, 0, 'R');
$total = $total + $row['kredit'];
$y = $y + 6;
		
		} }

$pdf->setY($y);			
$pdf->cell(10,6,'', 1, 0, 'C');
$pdf->cell(70,6,'', 1, 0, 'L');
$pdf->cell(15,6,'', 1, 0, 'C');
$pdf->cell(30,6,'', 1, 0, 'R');
$pdf->cell(30,6,'', 1, 0, 'R');
$pdf->cell(35,6,number_format($total), 1, 0, 'R');

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
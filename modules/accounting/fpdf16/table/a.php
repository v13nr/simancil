<?php
//require('../assets/fpdf16/fpdf.php');

$host ="localhost";
    $user="root";
    $password="999";
    $database="jopustaka";
    mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	
//Table Base Classs
	require_once("class.fpdf_table.php");
	
	//Class Extention for header and footer	
	require_once("header_footer.inc");
	
	//Table Defintion File
	require_once("table_def.inc");
	
	$pdf = new pdf_usage("L");		
	$pdf->Open();
	$pdf->SetAutoPageBreak(true, 20);
    $pdf->SetMargins(20, 20, 20);
	$pdf->AddPage();
	$pdf->AliasNbPages(); 
	
	$columns = 7; //five columns

//$pdf = new FPDF("L");
//$pdf->AddPage();
//$pdf->Image('../assets/images/logo.jpg',5,5,20,0,'','http://www.jogjaide.web.id/');
	
	
	//Initialize the table class
	$pdf->tbInitialize($columns, true, true);
	
	//set the Table Type
	$pdf->tbSetTableType($table_default_table_type);
	
	$header_type1[0]['WIDTH'] = 20;
	$header_type1[1]['WIDTH'] = 30;
	$header_type1[2]['WIDTH'] = 40;
	$header_type1[3]['WIDTH'] = 40;
	$header_type1[4]['WIDTH'] = 20;
	
$pdf->setFont('Arial','B',12);
$pdf->setXY(25,20); 
$pdf->cell(30,6,'Laporan Daftar Anggota Perpustakaan');

$y_initial = 41;
$y_axis1 = 35;
$pdf->setFont('Arial','',10);
$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(25);

$pdf->cell(10,6,'No.',1,0,'C',1);
$pdf->cell(25,6,'Kode Anggota',1,0,'C',1);
$pdf->cell(50,6,'Nama',1,0,'C',1);
$pdf->cell(50,6,'Tgl. Lahir',1,0,'C',1);
$pdf->cell(30,6,'No. Identitas',1,0,'C',1);
$pdf->cell(75,6,'Alamat',1,0,'C',1);
$pdf->cell(20,6,'No. Telpon',1,0,'C',1);

$y = $y_initial + $row;
$no = 0;
$row = 6;

$sql = mysql_query("SELECT * FROM anggota WHERE kode <> '' ORDER BY nama ASC");
$no = 0;
$row = 6;
while ($daftar = mysql_fetch_array($sql))
{
$no++;
$pdf->setY($y);
$pdf->setX(25);
$pdf->cell(10,6,$no,1,0,'C');
$pdf->cell(25,6,$daftar[kode],1,0,'L');
$pdf->cell(50,6,$daftar[nama],1,0,'L');
$pdf->cell(50,6,$daftar[tgllahir],1,0,'L');
$pdf->cell(30,6,$daftar[identitas],1,0,'L');

$pdf->cell(75,6,$daftar[alamat],1,0,'L');
//$pdf->MultiCell(75, 6, $daftar[alamat], 'L');	
$pdf->cell(20,6,$daftar[telpon],1,0,'L');
$y = $y + $row;
}
	
//output the table data to the pdf
	$pdf->tbOuputData();
	
	//draw the Table Border
	$pdf->tbDrawBorder();	

	$pdf->Output();
?>
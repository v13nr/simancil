<? session_start(); ?><?php  
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
$pdf->cell(190,6,'LAPORAN PERUBAHAN MODAL', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');


// header
$a = session_id();
$SQL = "SELECT * FROM $database.dbfn WHERE id = '".$a."' LIMIT 1";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['periode'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
$pdf->cell(50,6,': '.$baris['divisi'], 0, 0, 'L');

$pdf->setY(60);
$SQL = " SELECT SUM(saldoawal+kredit-debet) FROM $database.dbfn WHERE norek LIKE 'MO1%' AND id = '".$a."'";
$hasil = mysql_query($SQL);
$baris = mysql_fetch_array($hasil);
$modalawal = $baris[0];
$pdf->cell(38,5,'Modal Awal', 0, 0, 'L');
$pdf->cell(130,5,minuss($modalawal), 0, 0, 'R');
$pdf->setY(65);
$pdf->cell(38,5,'Laba Rugi', 0, 0, 'L');
$laba = $_SESSION["laba"];
$pdf->cell(130,5, minuss($laba), 0, 0, 'R');
$pdf->setY(70);
$SQL = " SELECT SUM(saldoawal+kredit-debet) FROM $database.dbfn WHERE norek LIKE 'MO2%'  AND id = '".$a."'";
$hasil = mysql_query($SQL);
$baris = mysql_fetch_array($hasil);
$prive = $baris[0];
$pdf->cell(38,5,'Prive', 0, 0, 'L');
$pdf->cell(130,5,minuss($prive), 0, 0, 'R');
$pdf->setY(75);
$pdf->cell(38,5,'Modal Akhir', 0, 0, 'L');

$modalakhir = $modalawal + $laba - $prive;
$pdf->cell(130,5,minuss($modalakhir), 0, 0, 'R');
$pdf->setY(380);

$_SESSION["modalAkhir"] = $modalakhir;
$_SESSION["modalAwal"] = $modalawal;

$pdf->Output();
?>
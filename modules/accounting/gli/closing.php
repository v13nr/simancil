<? session_start(); ?>
<style type="text/css">
<!--
body {
	background-image: url(../images/ok.jpg);
	background-repeat: repeat;
}
.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }
-->
</style>
<?php  
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";




$a = session_id();
$SQL = "SELECT * FROM $database.dbfn WHERE id = '".$a."' LIMIT 1";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);

$SQLt = "SELECT * FROM $database.closing ORDER BY id DESC LIMIT 1";
$hasilt = mysql_query($SQLt, $dbh_jogjaide);
$barist = mysql_fetch_array($hasilt);


//01/12/2011 s/d 31/01/2012
$tgla = substr($baris["periode"],6,4)."-".substr($baris["periode"],3,2)."-".substr($baris["periode"],0,2);
$tglb = substr($baris["periode"],21,4)."-".substr($baris["periode"],18,2)."-".substr($baris["periode"],15,2);
$tglc = substr($barist["periode"],6,4)."-".substr($barist["periode"],3,2)."-".substr($barist["periode"],0,2);
$tgld = substr($barist["periode"],21,4)."-".substr($barist["periode"],18,2)."-".substr($barist["periode"],15,2);


//validasi tutup buku
//berpotongan :
//jika c lebih dari sd a dan kurang dari sd b
//jika d lebih dari sd a dan kurang dari sd b
$berpotongan = 0;
if ($tglc >= $tgla && $tglc<= $tglb){
	$berpotongan = 1;

}
if ($tgld >= $tgla && $tgld<= $tglb){
	$berpotongan = 1;
}


$periode = $baris["periode"];
echo 'Periode aktif = '.$periode. '. Laba = Rp. '. number_format($_SESSION["laba"]) .' <br>';
echo '<form method="POST" action="">';
if($berpotongan != "1") { echo '<input type="submit" name="closing" value="Tutup">'; }
echo '<form>';
echo '<br><br><br>';

if(isset($_POST['closing']) && $berpotongan != '1') {
	$SQL = "insert into closing(id, periode, laba, user)values('','". $periode  ."','". number_format($_SESSION["laba"]) ."', '". $_SESSION["sess_user_id"] ."')";
	$hasil = mysql_query($SQL);
	
		
		
		
		/*
			setelah satu bulan (1 periode) dihitung L/R maka ditutup dengan dmikian rek. pendapatan, beban, prive
			sudah ditutup ((artinya ketiga akun itu saldonya menjadi NOL karena sudah dipindahkan ke akun MODAL) 
			ini dilihat pada lap. perubahan modal.
		
		//pemindahan 
		jika laba (+) maka menambah modal 3110101
		jika rugi (-) maka mengurangi modal 3110101
		laba/rugi ada pada saat eksekusi neraca mutasi
		
		*/
		$laba = $_SESSION["laba"];
		if($laba < 0){
		
		//modal di kredit vs 3140001
		$SQL = "UPDATE rekening SET kredit = kredit + ". ($_SESSION["laba"] * -1) ." where norek = '3110101'";
		$hasil = mysql_query($SQL);
		echo $SQL."<br>";
		$SQL = "UPDATE rekening SET debet = debet + ". ($_SESSION["laba"] * -1) ." where norek = '3140001'";
		$hasil = mysql_query($SQL);
		echo $SQL."<br>";
		
		} else {
		
		//modal di debet  vs 3140001
		$SQL = "UPDATE rekening SET debet = debet + ". $_SESSION["laba"] ." where norek = '3110101'";
		echo $SQL."<br>";
		$hasil = mysql_query($SQL);
		$SQL = "UPDATE rekening SET kredit = kredit + ". $_SESSION["laba"] ." where norek = '3140001'";
		echo $SQL."<br>";
		$hasil = mysql_query($SQL);
		
		}
}

$SQL = "UPDATE rekening SET saldoawal = saldoawal + ". $_SESSION["laba"] ." where norek = '3110101'";
$hasil = mysql_query($SQL);

//just data retrieving
$SQL = "SELECT * FROM closing";
$hasil = mysql_query($SQL);

echo '<table width="1000" border="0" bgcolor="#000000" cellspacing="1">';
echo '<tr height="30" background="../images/impactg.png">';
	echo '<td align="center" class="style4">Nomor</td>';
	echo '<td align="center" class="style4">Periode</td>';
	echo '<td align="center" class="style4">Laba</td>';
	echo '<td align="center" class="style4">User</td>';
echo '</tr>';
$nRecord = 1;

while($baris = mysql_fetch_array($hasil)){

echo '<tr '; if (($nRecord % 2)==0) { echo 'bgcolor="#e4e4e4"'; }  else { echo 'bgcolor="#FFFFCC"'; } echo '>';
	echo '<td align="center">'. $baris["id"] .'</td>';
	echo '<td align="center">'. $baris["periode"]  .'</td>';
	echo '<td align="right">'. $baris["laba"]  .'</td>';
	echo '<td align="center">'. $baris["user"]  .'</td>';
echo '</tr>';
$nRecord++;
}
echo '</table>';
?>
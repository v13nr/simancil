<? session_start(); ?><?php  
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";
$a = session_id();
$SQL = "SELECT * FROM $database.dbfn WHERE id = '".$a."'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
?>
<script language="javascript">
function viksel(delUrl) {
	if (confirm("Apakah akan mengekspor ke Excell ?")) {
			//var password;
			//var pass1 = "kafet4"; // place password here
			//password=prompt("Please enter your password:","");
			//if (password==pass1) {
				document.location = delUrl;
			//}
		}
}
</script>
<body onLoad="viksel('cetak_neraca99_excell.php');">
<div align="center">NERACA<br> <?=$namaclient;?><br>
  <?=$baris['periode'];?>
</div>
<table width="100%" border="1">
  <tr>
    <td width="48%">AKTIVA</td>
    <td width="2%">&nbsp;</td>
    <td width="50%"><div align="right">PASSIVA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="1">
      <tr>
        <td colspan="2" valign="top">AKTIVA LANCAR </td>
        <td width="39%">&nbsp;</td>
      </tr>
	  <?php
	  //looping aktiva LANCAR
	$jml_alancar=0;
	$SQL = "SELECT * FROM $database.dbfn WHERE  id = '".$a."' and tipe = 'A' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'AL' AND substr(norek,0,2) != 'AP' ORDER BY norek";
	$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 4)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		//$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		//$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		//$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_alancar= $jml_alancar + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
	?>
      <tr>
        <td width="11%">&nbsp;</td>
        <td width="50%"><?php echo $baris['namarek']; ?></td>
        <td><div align="right"><?php echo minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']); ?></div></td>
      </tr>
	  <? }  ?>
      <tr>
        <td colspan="2">JUMLAH AKTIVA LANCAR </td>
        <td><div align="right"><?php echo '<b>'.number_format($jml_alancar,2,'.',',') . '</b>'; ?></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">AKTIVA TETAP </td>
        <td>&nbsp;</td>
      </tr>
	  <?php
	  
	  //looping aktiva TETAP
		$jml_atetap=0;
	  $SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  'MO1-%' AND norek NOT LIKE 'MO2-%'  AND id = '".$a."' and tipe = 'A' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'AT' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 3)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		//$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		//$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		//$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_atetap= $jml_atetap + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
?>
      <tr>
        <td>&nbsp;</td>
        <td><?php echo $baris['namarek']; ?></td>
        <td><div align="right"><?php echo minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']); ?></div></td>
      </tr>
	  <? } ?>
      <tr>
        <td colspan="2">JUMLAH AKTIVA TETAP </td>
        <td><div align="right"><?php echo '<b>'.number_format($jml_atetap,2,'.',',') . '</b>'; ?></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>AKUMULASI PENYUSUTAN </td>
        <td><div align="right">
		
		
		 <?php
	  
	  //looping aktiva TETAP
		$jml_ap=0;
	  	
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE 'AP%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		//$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		//$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		//$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_ap= $jml_ap + ($barisc['saldoawal']-$barisc['debet']+$barisc['kredit']);
		$jml_ap = $jml_ap * -1;
		echo minuss($jml_ap,2,'.',',');
?>
		
		</div></td>
      </tr>
      <tr>
        <td colspan="2">NILAI BUKU AKTIVA TETAP </td>
        <td><div align="right"><?php echo '<b>'.number_format(($jml_atetap - ($jml_ap * -1) ),2,'.',',') . '</b>'; ?></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">JUMLAH AKTIVA </td>
        <td><div align="right"><?php echo '<b>'.number_format(($jml_alancar + $jml_atetap - ($jml_ap * -1) ),2,'.',',') . '</b>'; ?></div></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td valign="top"><table width="100%" border="1">
      <tr>
        <td colspan="2">KEWAJIBAN LANCAR </td>
        <td width="39%">&nbsp;</td>
      </tr>
      <?php
	  //looping KW LANCAR
	$jml_alancar=0;
	$SQL = "SELECT * FROM $database.dbfn WHERE  norek NOT LIKE  'MO1-%' AND norek NOT LIKE 'MO2-%'  AND id = '".$a."' and tipe = 'P' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'KL' ORDER BY norek";
	$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 4)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		//$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_klancar= $jml_klancar + ($barisc['saldoawal']-$barisc['debet']+$barisc['kredit']);
	?>
      <tr>
        <td width="11%">&nbsp;</td>
        <td width="50%"><?php echo $baris['namarek']; ?></td>
        <td><div align="right"><?php echo minuss($barisc['saldoawal']-$barisc['debet']+$barisc['kredit']); ?></div></td>
      </tr>
      <? }  ?>
      <tr>
        <td colspan="2">JUMLAH KEWAJIBAN LANCAR </td>
        <td><div align="right"><?php echo '<b>'.number_format($jml_klancar,2,'.',',') . '</b>'; ?></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">MODAL SENDIRI </td>
        <td>&nbsp;</td>
      </tr>
      <?php
	  
	  //looping aktiva TETAP
		$jml_atetap=0;
	  $SQL = "SELECT * FROM $database.dbfn WHERE  norek  LIKE  'MO1%'  AND id = '".$a."' and tipe = 'P' AND substr(norek,-4) = '0000' AND substr(norek,1,2) = 'MO' ORDER BY norek";
$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
	while($baris = mysql_fetch_array($hasil)){
		$SQLc = "SELECT SUM(saldoawal) as saldoawal, SUM(debet) as debet, SUM(kredit) as kredit FROM $database.dbfn WHERE norek LIKE '".substr($baris['norek'], 0, 4)."%' AND id = '".$a."'";
		$hasilc = mysql_query($SQLc, $dbh_jogjaide);
		$barisc = mysql_fetch_array($hasilc);
		
		$sa_aktiva = $sa_aktiva + $barisc['saldoawal'];
		//$pdf->cell(28,5,number_format($barisc['debet'],2,'.',','), 0, 0, 'R');
		$d_aktiva = $d_aktiva +  $barisc['debet'];
		//$pdf->cell(28,5,number_format($barisc['kredit'],2,'.',','), 0, 0, 'R');
		$k_aktiva = $k_aktiva + $barisc['kredit'];
		//$pdf->cell(28,5,minuss($barisc['saldoawal']+$barisc['debet']-$barisc['kredit'],2,'.',','), 0, 0, 'R');
		
		$sr_aktiva = $sr_aktiva + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
		$jml_atetap= $jml_atetap + ($barisc['saldoawal']+$barisc['debet']-$barisc['kredit']);
?>
      <tr>
        <td>&nbsp;</td>
        <td><?php echo $baris['namarek']; ?></td>
        <td><div align="right"><?php echo number_format($_SESSION["modalAkhir"],2,'.',','); ?></div></td>
      </tr>
      <? } ?>
      <tr>
        <td colspan="2">JUMLAH MODAL SENDIRI </td>
        <td><div align="right"><b><?php echo number_format($_SESSION["modalAkhir"],2,'.',','); ?></b></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">JUMLAH KEWAJIBAN DAN MODAL SENDIRI</td>
        <td><div align="right"><?php echo '<b>'.number_format($_SESSION["modalAkhir"] + $jml_klancar,2,'.',',') . '</b>'; ?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?php 
	require_once "../include/globalx.php";
	include("../include/infoclient.php");
	$tahun = $_POST["tahun"];
?>
<body>
<div align="center">DAFTAR AKTIVA TETAP<BR /> <?php  echo $namaclient;?> <br /> Per 31 Desember <?php  echo $tahun;?></div>
<table width="100%" border="1">
  <tr>
    <td><div align="center">JENIS</div></td>
    <td><div align="center">TAHUN</div></td>
    <td rowspan="2"><div align="center">JML</div>      <div align="center"></div></td>
    <td><div align="center">TARIF</div></td>
    <td><div align="center">HARGA</div></td>
    <td><div align="center">NILAI BUKU </div></td>
    <td><div align="center">PENYUSUTAN</div></td>
    <td colspan="2"><div align="center">AKM. PENYUSUTAN </div></td>
    <td><div align="center">NILAI BUKU </div></td>
  </tr>
  <tr>
    <td><div align="center">AKTIVA TETAP </div></td>
    <td><div align="center">PEROLEHAN</div></td>
    <td><div align="center">%</div></td>
    <td><div align="center">PEROLEHAN</div></td>
    <td><div align="center">Th. <?php  echo $tahun-1;?></div></td>
    <td><div align="center">Th.
        <?php  echo $tahun;?>
    </div></td>
    <td><div align="center">Th.
        <?php  echo $tahun-1;?>
    </div></td>
    <td><div align="center">Th.
        <?php  echo $tahun;?>
</div></td>
    <td><div align="center">Th.
        <?php  echo $tahun;?>
</div></td>
  </tr>
  <?php 
  		$SQL = "SELECT *, YEAR(tgl) AS tahun FROM $database.aktiva WHERE status = 1 AND YEAR(tgl) <= '".$tahun."'";
  		$hasil = mysql_query($SQL, $dbh_jogjaide);
		while($baris=mysql_fetch_array($hasil)){
		
		
		//akm - 1
		$tahunc = $tahun - 1;
		$SQLc = "SELECT SUM(jumlah) as jumlah FROM $database.jurnal_srb WHERE aktiva_id = '".$baris["id"]."' AND YEAR(tanggal) <= ".$tahunc;
		//echo $SQLc;
		$hasilc = mysql_query($SQLc, $dbh_jogjaide)or die(mysql_error());
		$barisc = mysql_fetch_array($hasilc);
		$akm_min_1 =  ($barisc[0]); 

		//akm 
		$tahunc = $tahun;
		$SQLc = "SELECT SUM(jumlah) as jumlah FROM $database.jurnal_srb WHERE aktiva_id = '".$baris["id"]."' AND YEAR(tanggal) <= ".$tahunc;
		//echo $SQLc;
		$hasilc = mysql_query($SQLc, $dbh_jogjaide)or die(mysql_error());
		$barisc = mysql_fetch_array($hasilc);
		$akm =  ($barisc[0]); 

  ?>
  <tr>
    <td><?php  echo $baris["nama"]; ?></td>
    <td><div align="center"><?php  echo $baris["tahun"]; ?></div></td>
    <td>&nbsp;</td>
    <td><div align="center"><?php  echo $baris["tarif"]; ?>%</div></td>
    <td><div align="right"><?php  echo number_format($baris["nilai"]); $nilaiperolehan = $baris["nilai"];?></div></td>
    <td><div align="right">
      <?php  
	echo number_format($nilaiperolehan - $akm_min_1,2,",","."); ?>
    </div></td>
    <td><div align="right">
      <?php  
	$tahunc = $tahun;
	$SQLc = "SELECT jumlah FROM $database.jurnal_srb WHERE aktiva_id = '".$baris["id"]."' AND YEAR(tanggal) = ".$tahunc;
	//echo $SQLc;
	$hasilc = mysql_query($SQLc, $dbh_jogjaide)or die(mysql_error());
	$barisc = mysql_fetch_array($hasilc);
	echo number_format($barisc[0],2,".",","); ?>
    </div></td>
    <td><div align="right">
      <?php  
	echo number_format($akm_min_1,2,",","."); ?>
    </div></td>
    <td><div align="right">
      <?php  
	echo number_format($akm,2,",","."); ?>
    </div></td>
    <td><div align="right"><?php  echo number_format($baris["nilai"] - $akm,2,",","."); ?></div></td>
  </tr>
  <?php  } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

<?php  session_start() ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
* { font: 11px/12px Verdana, sans-serif; letter-spacing: 2px }
.nomornota {
	font: 16px Arial;
}
input.kanan{ text-align:right; }
.style1 {color: #FFFFFF}
</style>

</head>

<body onload="window.print()">
<?php 
date_default_timezone_set("Asia/Jakarta");
	include "../include/globalx.php";
	include "../include/functions.php";
	$nonota = $_GET['nota'];
	//$split = explode("/",$nonota);
	//$nota = $split[1];
	$SQL = "SELECT SUM(harga * qtyout - (harga * qtyout * disc/100)) FROM mutasi WHERE model = 'INV' and nomor = '".$nonota."' AND status = 1";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	$baris = mysql_fetch_array($hasil);
	$total = $baris[0];
?>
<form method="post" action="../../../cafe/cetak_nota.php?id=<?php  echo $nonota?>">

<table border=0 style="border-collapse:collapse;" width="350px">
	<tbody>
		<tr>
    <td colspan="3"><table width="100%" border="1" style="border-collapse:collapse;" >

		<?php 
				$s = "select * from laporanid where id = 1";
				$h = mysql_query($s);
				$b = mysql_fetch_array($h);
				$SQL = "select * from logo limit 1";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$row = mysql_fetch_array($hasil);
		?>
      <tr>
        <td colspan="8" align="center"><strong><img src="../../../images/logo.jpg" width="100px"></strong>
		<br>
		<strong>Spesialis Aki Mobil & Motor</strong>
		<br>
		Outlet 103<br>
		Hp. 0822 2020 2121
		<br>
		
		
		<?php
		
			function auto1($nomor){
				$panjang = strlen($nomor);
				switch ($panjang){
					case "1" :
						return "00000".$nomor;	
					break;
					case "2" :
						return "0000".$nomor;	
					break;
					case "3" :
						return "000".$nomor;	
					break;
					case "4" :
						return "00".$nomor;	
					break;
					case "5" :
						return "0".$nomor;	
					break;
					case "6" :
						return $nomor;	
					break;
					default :
						return $nomor;	
					break;
				}
			}
		
		echo "<span class='nomornota'>". auto1($_GET["nota"]) ."</span>";
		?>
		
		</td>
      </tr>
    
      <tr style="height:20px;">
        <td width="10%" align="center">Qty</td>
        <td width="90%" colspan="4" >ITEM</td>
        <td width="45%" align="right">HARGA</td>
        <td width="45%" align="right">JUMLAH</td>
      </tr>

		
			  <?php 
			  $jumlah_baris_kosong = 5;
$SQL = "SELECT * FROM mutasi WHERE model = 'INV' and nomor = '".$nonota."' AND status = 1";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	while($baris = mysql_fetch_array($hasil)){;
?>	
      <tr style="height:20px;">
        <td width="10%" align="center"><?php  echo number_format($baris["qtyout"]);?></td>
        <td width="90%" colspan="4" ><b><?php  echo $baris["namabrg"];?></b></td>
        <td width="45%" align="right"><?php  echo number_format($baris["harga"]);?></td>
        <td width="45%" align="right"><?php  echo number_format($baris["harga"]*$baris["qtyout"]-($baris["harga"]*$baris["qtyout"]*$baris["disc"]/100));?></td>
      </tr>
	  <?php  
	  $total = $total + ($row['qtyout']*$row['harga']-($baris["harga"]*$baris["qtyout"]*$baris["disc"]/100));
	  } ?>
	  
	  <?php
		for($i=0;$i<=$jumlah_baris_kosong; $i++){
			
	  
	  ?>
	  
		<tr style="height:20px;">
			<td> </td>
			<td colspan="3"> </td>
			<td align="right" colspan="2"> &nbsp</td>
			<td align="right">&nbsp; </td>
		</tr>
		
	  <?php
		}
	  ?>
		<tr style="height:20px;">
			<td> </td>
			<td colspan="3"> </td>
			<td align="right" colspan="2"> TOTAL</td>
			<td align="right"><?php echo number_format($total);?> </td>
		</tr>
		
	</tbody>
</table>
<br>
<?php echo date('d-m-Y H:i');?>


<table width="100%" border="0">
 
  <tr>
    <td width="92">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="965" align="right">&nbsp;</td>
  </tr>
  
</table>
</form>
</body>
</html>

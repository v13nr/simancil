<?php 
include "../include/globalx.php";
include "../include/functions.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="659">
	<tr>
		<td colspan="3"><strong>SUMMARY PRODUCT REPORT</strong></td>
	</tr>
	<tr>
	  <td>PERIODE</td>
	  <td>:</td>
	  <td><?php  echo $_POST['tgl_awal']?> s/d <?php  echo $_POST['tgl_akhir']?></td>
  </tr>
	<tr>
		<td width="87">SHIFT</td>
		<td width="8">:</td>
		<td width="548"><?php  
			$SQL = "select * from ml_user b where id = '". $_POST['shift'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			if($_POST['shift'] <> ""){ echo $baris["nama"]; } else { echo "ALL";}
		?></td>
	</tr>
</table>
<form method="post" action="summary_produk_cetak2.php">
<input type="hidden" name="shift" value="<?php  echo $_POST['shift']?>" />
<input type="hidden" name="tgl_awal" value="<?php  echo $_POST['tgl_awal']?>" />
<input type="hidden" name="tgl_akhir" value="<?php  echo $_POST['tgl_akhir']?>" />
<table width="100%" border="1">
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cetak" /></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">No.</td>
    <td width="44%">Produk</td>
    <td width="26%">Total Terjual </td>
    <td width="13%">Total Discount Rp. </td>
    <td width="13%" align="right">Nilai</td>
  </tr>
  <?php  
  		$SQL = "SELECT * from stock";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		while($baris=mysql_fetch_array($hasil)){
			
			$sqlk = "SELECT SUM(qtyout) as jumlah FROM mutasi where kodebrg = '". $baris["kodebrg"] ."' AND status = 1";
				if($_POST['shift']<>""){
					$sqlk = $sqlk . " AND user_id = '".$_POST['shift']."'";
				}
				
				$sqlk = $sqlk . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
				//echo $sqlk;
				$hasilk = mysql_query($sqlk);
				$barisk = mysql_fetch_array($hasilk);
				
				if($barisk["jumlah"]>0){
				?>
									
									
					  <tr>
						<td><?php  echo ++$no?></td>
						<td><?php  echo $baris["namabrg"] ?></td>
						<td>
							<?php  
									
									echo $barisk["jumlah"];
							?>	</td>
						<td align="right"><?php 
								$sqld = "SELECT SUM(qtyout*harga*disc/100) as jumlah FROM mutasi where kodebrg = '". $baris["kodebrg"] ."' AND status = 1";
									if($_POST['shift']<>""){
										$sqld = $sqld . " AND user_id = '".$_POST['shift']."'";
									}
									
									$sqld = $sqld . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
									//echo $sqlk;
									$hasild = mysql_query($sqld);
									$barisd = mysql_fetch_array($hasild);
								echo number_format($barisd["jumlah"]);
								
								//$totalp = $totalp + ($baris["harga"] * $baris["qtyout"]);
						?></td>
						<td align="right"><?php 
								$sqld = "SELECT SUM(qtyout*harga-(qtyout*harga*disc/100)) as jumlah FROM mutasi where kodebrg = '". $baris["kodebrg"] ."' AND status = 1";
									if($_POST['shift']<>""){
										$sqld = $sqld . " AND user_id = '".$_POST['shift']."'";
									}
									
									$sqld = $sqld . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
									//echo $sqlk;
									$hasild = mysql_query($sqld);
									$barisd = mysql_fetch_array($hasild);
								echo number_format($barisd["jumlah"]);
								$totalp = $totalp + $barisd["jumlah"];
								//$totalp = $totalp + ($baris["harga"] * $baris["qtyout"]);
						?></td>
					  </tr>
				
				
				<?php
					
					
					
				}
  ?>
  <?php  } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php  echo number_format($totalp)?></td>
  </tr>
</table>
</form>
</body>
</html>

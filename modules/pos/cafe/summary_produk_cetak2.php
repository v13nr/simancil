<?php 
include "../include/globalx.php";
include "../include/functions.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body onload="window.print()">
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
<table width="100%" border="1" bordercolor="#FFFFFF">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%">No.</td>
    <td width="47%">Produk</td>
    <td width="13%">Total Terjual </td>
    <td width="33%" align="right">Nilai</td>
  </tr>
  <?php  
  		$SQL = "SELECT * from stock";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		while($baris=mysql_fetch_array($hasil)){
  ?>
  <?php  
				$sqlw = "SELECT SUM(qtyout) as jumlah FROM mutasi where kodebrg = '". $baris["kodebrg"] ."' AND status = 1";
				if($_POST['shift']<>""){
					$sqlw = $sqlw . " AND user_id = '".$_POST['shift']."'";
				}
				
				$sqlw = $sqlw . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
				//echo $sqlk;
				$hasilw = mysql_query($sqlw);
				$barisw = mysql_fetch_array($hasilw);
				if($barisw["jumlah"]<> 0){
		?>
  <tr>
    <td><?php  echo ++$no?></td>
    <td><?php  echo $baris["namabrg"] ?></td>
    <td align="center"><?php  
				$sqlk = "SELECT SUM(qtyout) as jumlah FROM mutasi where kodebrg = '". $baris["kodebrg"] ."' AND status = 1";
				if($_POST['shift']<>""){
					$sqlk = $sqlk . " AND user_id = '".$_POST['shift']."'";
				}
				
				$sqlk = $sqlk . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
				//echo $sqlk;
				$hasilk = mysql_query($sqlk);
				$barisk = mysql_fetch_array($hasilk);
				echo $barisk["jumlah"];
		?>    </td>
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
  <?php  } // end if
  } //end whikle ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php  echo number_format($totalp)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p class="style1">tes</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

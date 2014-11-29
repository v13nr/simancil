<?php  
include "globalx.php";
//menuAkses(64);
date_default_timezone_set('Asia/Shanghai');
$tanggal = date('d-m-Y');
$ok = isset($_GET['tes']) ? "OKK" : "NOT READY";
//echo $ok;
 ?>
<html>
<head><meta/><title></title>
<?php 
	$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : 5;
	$tahunx = isset($_POST["tahun"]) ? $_POST["tahun"] : 2012;
	$prosentase = isset($_POST["prosentase"]) ? $_POST["prosentase"] : "80";
	$awal = isset($_POST["awal"]) ? $_POST["awal"] : 0;
	$akhir = isset($_POST["akhir"]) ? $_POST["akhir"] : 0;
	$sum = "SUM(totalpenjualan) * ". $prosentase ." / 100";
	$count = "COUNT(id) * ". $prosentase ." / 100";
	$total = 0;
	$totalpro = 0;
?>
</head>
<body>
<form method="POST" action="">
	<table>
		<tr>
			<td>Bulan</td>
			<td>&nbsp;</td>
			<td>
				<select name="bulan">
					<option value="1" <?php  if($bulan=="1"){ echo 'selected="selected"';} ?>>&nbsp;Januari&nbsp;</option>
					<option value="2" <?php  if($bulan=="2"){ echo 'selected="selected"';} ?>>&nbsp;Februari&nbsp;</option>
					<option value="3" <?php  if($bulan=="3"){ echo 'selected="selected"';} ?>>&nbsp;Maret&nbsp;</option>
					<option value="4" <?php  if($bulan=="4"){ echo 'selected="selected"';} ?>>&nbsp;April&nbsp;</option>
					<option value="5" <?php  if($bulan=="5"){ echo 'selected="selected"';} ?>>&nbsp;Mei&nbsp;</option>
					<option value="6" <?php  if($bulan=="6"){ echo 'selected="selected"';} ?>>&nbsp;Juni&nbsp;</option>
					<option value="7" <?php  if($bulan=="7"){ echo 'selected="selected"';} ?>>&nbsp;Juli&nbsp;</option>
					<option value="8" <?php  if($bulan=="8"){ echo 'selected="selected"';} ?>>&nbsp;Agustus&nbsp;</option>
					<option value="9" <?php  if($bulan=="9"){ echo 'selected="selected"';} ?>>&nbsp;September&nbsp;</option>
					<option value="10" <?php  if($bulan=="10"){ echo 'selected="selected"';} ?>>&nbsp;Oktober&nbsp;</option>
					<option value="11" <?php  if($bulan=="11"){ echo 'selected="selected"';} ?>>&nbsp;Nopember&nbsp;</option>
					<option value="12" <?php  if($bulan=="12"){ echo 'selected="selected"';} ?>>&nbsp;Desember&nbsp;</option>

				</select>
			</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>&nbsp;</td>
			<td>
				<select name="tahun">
					<?php 
						$tahun = date('Y');
						echo $tahun;
						for ($i=2012; $i<=$tahun+5;$i++){
					?>
					<option value="<?php  echo $i;?>" <?php  if($tahunx==$i){ echo 'selected="selected"';} ?>><?php  echo $i;?></option>
					<?php  } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Prosentase (%)</td>
			<td>&nbsp;</td>
			<td><input type="text" name="prosentase" id="prosentase" size="5" value="<?php  echo $prosentase;?>" /></td>
		</tr>
		<tr>
			<td>Range</td>
			<td>&nbsp;</td>
			<td><input type="radio" name="range" value="all" checked="true">All</td>
		</tr>
		<tr>
			<td>Range</td>
			<td>&nbsp;</td>
			<td><input type="radio" name="range" value="range" <?php  if($_POST["range"]=="range"){ echo 'checked="true"'; }?>>Antara</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;</td>
			<td><input type="text" name="awal" size="10" value="<?php  echo $awal; ?>">&nbsp;s/d&nbsp;<input type="akhir" name="akhir" size="10" value="<?php  echo $akhir;?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;</td>
			<td><input type="submit" value="Hitung !" name="hitung"/></td>
		</tr>

	</table>
</form>
Catatan : Harap dieksekusi ketika traffic jaringan dalam keaadaan sepi. *Disarankan untuk dieksekusi langsung di server Lokal.
<?php 
	if(isset($_POST["hitung"])){
		$SQL = "SELECT SUM(totalpenjualan) as rekap, " .$sum. " AS prosen FROM v_penjualan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
		if(isset($_POST["range"]) && $_POST["range"]=="range"){
			$SQL = $SQL . " AND totalpenjualan >= '".$_POST["awal"]."' AND totalpenjualan <= '".$_POST["akhir"]."'";
		}
		//echo $SQL;
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$totalpro = $baris["prosen"];
?>

	<table border="1">
		<TR>
			<TD>Jumlah Transaksi Tunai</TD>
			<TD>Nilai Transaksi Penjualan Tunai</TD>
			<TD>Jumlah Transaksi Tunai Terprosentase</TD>
			<TD>Nilai Transaksi Tunai Terprosentase</TD>
		</TR>
		<TR>
			<TD align="right">
				<?php 
					$SQLnota = "SELECT COUNT(id), ". $count ." FROM v_penjualan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND status = 1";
					if(isset($_POST["range"]) && $_POST["range"]=="range"){
						$SQLnota = $SQLnota . " AND totalpenjualan >= '".$_POST["awal"]."' AND totalpenjualan <= '".$_POST["akhir"]."'";
					}
					
					$hasilnota = mysql_query($SQLnota);
					$barisnota = mysql_fetch_array($hasilnota);
					echo number_format($barisnota[0]);
				?>
			</TD>
			<TD align="right"><?php  echo number_format($baris["rekap"]); ?></TD>
			<TD align="right"><?php  echo number_format($barisnota[1]); ?></TD>
			<TD align="right"> <?php  echo number_format($baris["prosen"]); ?></TD>
		</TR>
	</table>

<br><br>
<table border="1">
	<TR>	
		<TD>Nomor Nota</TD>
		<TD>Tanggal Random</TD>
		<TD>Item</TD>
		<TD>Harga</TD>
		<TD>Qty</TD>
		<TD>Jumlah</TD>
	</TR>
<?php 
	$SQL = "SELECT * FROM penjualan_detail WHERE MONTH(input) = '$bulan' AND YEAR(input) = '$tahun' AND status = 1 ";
	if(isset($_POST["range"]) && $_POST["range"]=="range")
	$SQL = $SQL . "   AND buyer_id IN(SELECT id FROM penjualan WHERE jumlah >= '".$_POST["awal"]."' AND jumlah <= '".$_POST["akhir"]."')";
	$SQL = $SQL . "  ORDER by RAND(), input ASC";
	$hasil = mysql_query($SQL);
	while ($baris = mysql_fetch_array($hasil)) {
?>
	<TR>	
		<TD><?php  echo $baris["buyer_id"];?></TD>
		<TD><?php  echo $baris["input"];?></TD>
		<TD><?php  echo $baris["name"];?></TD>
		<TD align="right"><?php  echo number_format($baris["price"]);?></TD>
		<TD align="center"><?php  echo $baris["count"];?></TD>
		<TD align="right"> <?php  echo number_format($baris["jumlah"]); $total = $total +  $baris["jumlah"];?></TD>
	</TR>
<?php  if( $total >= $totalpro) { break; }  } ?>
	<TR>	
		<TD></TD>
		<TD></TD>
		<TD></TD>
		<TD></TD>
		<TD>Total</TD>
		<TD><?php  echo number_format($total); ?></TD>
	</TR>
</table>

<?php  } // end ada post hitung ?>
</body>
</html>

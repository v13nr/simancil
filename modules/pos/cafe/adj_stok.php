<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
	include "../../../config_sistem.php";
	include "../../../otentik_admin.php";
	
	if(isset($_POST["simpan"])){
		$selisih = $_POST["selisih"];
		if($selisih > 0){
			//masuk qtyin
			$SQL = "INSERT INTO stok_adj SET
					id = '',
					keterangan = '". $_POST["keterangan"] ."',
					kdbarang = '". $_POST["kdbarang"] ."',
					namabarang = '". $_POST["namabarang"] ."',
					selisih = '". $_POST["selisih"] ."',
					stok_awal = '". $_POST["stok_awal"] ."',
					qtyin = '". $selisih ."',
					qtyout = 0,
					stok_koreksi = '". $_POST["stok_koreksi"] ."'";
				$hasil = mysql_query($SQL);
				$SQL = "update stock set qtyin =  qtyin + ".$_POST["selisih"]." WHERE kodebrg = '".$_POST["kdbarang"]."'";
				$hasil = mysql_query($SQL);
		} elseif($selisih == 0){
			
		} else {
			//masuk qtyout
			$SQL = "INSERT INTO stok_adj SET
					id = '',
					keterangan = '". $_POST["keterangan"] ."',
					kdbarang = '". $_POST["kdbarang"] ."',
					namabarang = '". $_POST["namabarang"] ."',
					selisih = '". $_POST["selisih"] ."',
					stok_awal = '". $_POST["stok_awal"] ."',
					qtyout = '". $selisih * -1 ."',
					qtyin = 0,
					stok_koreksi = '". $_POST["stok_koreksi"] ."'";
				$hasil = mysql_query($SQL);
				$SQL = "update stock set qtyout =  qtyout -  ".$_POST["selisih"]." WHERE kodebrg = '".$_POST["kdbarang"]."'";
				$hasil = mysql_query($SQL);
			
		}
	}
?>
<script language="javascript">
	function hitung(){
		stok_awal = (document.getElementById("stok_awal").value) * 1;
		stok_koreksi = (document.getElementById("stok_koreksi").value) * 1;
		document.getElementById("selisih").value = (stok_koreksi-stok_awal);
	}
</script>
</head>

<body>
<form method="post" action="">
<table width="400" border="0">
  <tr>
    <td width="28%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
  </tr>
  <tr>
    <td>Kode Barang</td>
    <td>&nbsp;</td>
    <td><input type="text" name="kdbarang" readonly="readonly" value="<?php echo $_GET["kdbarang"]; ?>" /></td>
  </tr>
  <tr>
    <td>Nama Barang</td>
    <td>&nbsp;</td>
    <td><?php 
		$SQLc = "select namabrg, SUM(qtyin-qtyout) AS stok_awal from stock where kodebrg = '". $_GET["kdbarang"] ."'";
		$hasilc = mysql_query($SQLc) or die($SQLc);
		$barisc = mysql_fetch_array($hasilc);?>
        <input type="text" name="namabarang" readonly="readonly" value="<?php echo $barisc[0];?>" /></td>
  </tr>
  <tr>
    <td>Stok Tercatat</td>
    <td>&nbsp;</td>
    <td><input type="text" name="stok_awal" id="stok_awal" readonly="readonly"  value="<?php echo $barisc[1];?>" /></td>
  </tr>
  <tr>
    <td>Stok Koreksi</td>
    <td>&nbsp;</td>
    <td><input type="text" name="stok_koreksi" id="stok_koreksi" onkeyup="hitung();" /></td>
  </tr>
  <tr>
    <td>Selisih</td>
    <td>&nbsp;</td>
    <td><input type="text" name="selisih" id="selisih" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td>&nbsp;</td>
    <td><textarea name="keterangan" cols="25" rows="4"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="Update" name="simpan" /></td>
  </tr>
</table>
</form>
</body>
</html>
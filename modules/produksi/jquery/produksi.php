<?php 
include "globalx.php";
include "../include/functions.php";


//menuAkses(62);
date_default_timezone_set('Asia/Shanghai');
$tanggal = date('d-m-Y');
$ok = isset($_GET['tes']) ? "OKK" : "NOT READY";
//echo $ok;
 ?>
 <?php
	if(isset($_GET["submit"])){
		$id = $_GET['nng'];
		$item = $_GET['nngqty'];
		$nama = $_GET['nngnama'];
		$satuan = $_GET['nngsatuan'];
		$harga = $_GET['nngharga'];
		$banyaknya = count($id);
		$split = isset($_GET["bulan"]) ? explode('-',$_GET["bulan"]) : explode('-','1-2010');
		$SQL = "DELETE FROM produksi_detail WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."' AND jenis = '". $_GET["jenis"]."' AND merek = '". $_GET["merek"]."' AND gudang = '". $_GET["gudang"]."'";
		$hasil = mysql_query($SQL) or die(mysql_error());	
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "insert into produksi_detail(tanggal, produksi, jenis, merek, gudang) VALUES 
			('".$id[$i]."', '".$harga[$i]."', '". $_GET["jenis"] ."', '". $_GET["merek"] ."', '". $_GET["gudang"] ."')";
			//echo $SQL."<br>";
			$hasil=mysql_query($SQL) or die(mysql_error());
		}
	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	background-image: url(../images/bg.png);
}
-->
</style>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="kalendar_files/jsCalendar.js"></script>
<link href="kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery-1.2.3.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
		$("#dk").change(onSelectChange);
	

	function onSelectChange(){
		$("#divAlert").html("OKKKKKKKKKKKKKKKKKKKKKK");
		window.location = "http://www.google.com/";
	}
	 $(function(){
      // bind change event to select
	var str = $('#dynamic_select').val();
	var n=str.split("=");
	  var vNIP = n[1];
	  $.get('ajax-cari.php?cari=supplier&mode=cp',{id: vNIP},
		function(nokartu){
		  if(nokartu.length > 0){ 
			$('input[@name=cp]').val(nokartu);
		  }else {
		   $('input[@name=cp]').val("");
		   }
		}
	  );
	$('#dynamic_select').bind('change', function () {
		var url = "produksi.php?bulan="+$(this).val()+"&jenis="+$('#jenis').val()+"&merek="+$('#merek').val()+"&gudang="+$('#gudang').val(); // get selected value
		if (url) { // require a URL
		window.location = url; // redirect
		}
		return false;
	});
	$('#gudang').bind('change', function () {
		var url = "produksi.php?gudang="+$(this).val()+"&jenis="+$('#jenis').val()+"&bulan="+$('#dynamic_select').val()+"&merek="+$('#merek').val(); // get selected value
		if (url) { // require a URL
		window.location = url; // redirect
		}
		return false;
	});
	$('#merek').bind('change', function () {
		var url = "produksi.php?merek="+$(this).val()+"&jenis="+$('#jenis').val()+"&bulan="+$('#dynamic_select').val()+"&gudang="+$('#gudang').val(); // get selected value
		if (url) { // require a URL
		window.location = url; // redirect
		}
		return false;
	});
	$('#jenis').bind('change', function () {
		var url = "produksi.php?bulan="+$('#dynamic_select').val()+"&jenis="+$(this).val()+"&merek="+$('#merek').val()+"&gudang="+$('#gudang').val(); // get selected value
		if (url) { // require a URL
		window.location = url; // redirect
		}
		return false;
	});
    });
});
	</script>
</head>

<form method="get" action="produksi.php">
<input type="hidden" value="<?=$_GET["bulan"]?>" name="bulan">
<table class="x1" align="center" border="1" style="border-collapse:collapse; border-color:#666666">
  
  <input type="hidden" name="nobukti" value="<?=$_GET['nobukti']?>" />
  <input type="hidden" name="bulan" value="<?=$_GET['bulan']?>" />
  
  <tr>
    <td><strong>Bulan</strong> : </td>
    <td><select name="tahun"  id="dynamic_select" class="required">
          <?php
						$tahun = $_POST["tahun"];
						$tahunx = date('Y');
						//echo $tahun;
						for ($i=2010; $i<=$tahunx+1;$i++){
							for ($j=1; $j<=12;$j++){
					?>
          <option value="<?php echo $j.'-'.$i;?>" <?php if($_GET["bulan"]==$j.'-'.$i){ echo 'selected="selected"';} ?>><?php echo $j.'-'.$i;?></option>
          <?php } 
		  } ?>
        </select>
        <div id="divAlert"></div>	</td>
		<td><strong>Jenis</strong> : </td>
		<td><select name="jenis" id="jenis" >
          <?php
				$SQLj = "select * from jenis";
				$hasilj = mysql_query($SQLj) or die(mysql_error());
				while($barisj=mysql_fetch_array($hasilj)){
		?>
          <option value="<?=$barisj["kode"]?>" <?php if($_GET["jenis"]==$barisj["kode"]) { ?> selected="selected" <? } ?>>
          <?=$barisj["nama"]?>
          </option>
          <?php } ?>
        </select></td>
		<td><strong>Merek</strong> : </td>
		<td><select name="merek" id="merek" ><?php
				$SQLj = "select * from stock";
				$hasilj = mysql_query($SQLj) or die(mysql_error());
				while($barisj=mysql_fetch_array($hasilj)){
		?>
          <option value="<?=$barisj["kodebrg"]?>" <?php if($_GET["merek"]==$barisj["kodebrg"]) { ?> selected="selected" <? } ?>>
          <?=$barisj["namabrg"]?>
          </option>
          <?php } ?>
		  </select></td>
		  <td><strong>Gudang</strong> : </td>
		  <td><select name="gudang" id="gudang" >
		    <?php
				$SQLj = "select * from gudang";
				$hasilj = mysql_query($SQLj) or die(mysql_error());
				while($barisj=mysql_fetch_array($hasilj)){
		?>
            <option value="<?=$barisj["kode"]?>" <?php if($_GET["gudang"]==$barisj["kode"]) { ?> selected="selected" <? } ?>>
            <?=$barisj["nama"]?>
            </option>
            <?php } ?>
          </select>
		  </td>
  </tr>
</table>
<p>
  <?php $id = isset($_GET["id"]) ? $_GET["id"] : "0"; ?>
</p>
<p>
  <table border="1">
  
  <?php
	
	$col = 5;
	$split = isset($_GET["bulan"]) ? explode('-',$_GET["bulan"]) : explode('-','1-2010');
	$SQLv = "SELECT * FROM produksi_detail WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."'  AND jenis = '". $_GET["jenis"]."'  AND merek = '". $_GET["merek"]."'   AND gudang = '". $_GET["gudang"]."' order by tanggal";
	$SQL = "SELECT * FROM produksi WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."' order by tanggal";
	$hasilv = mysql_query($SQLv);
	if(mysql_num_rows($hasilv) > 0){
		$SQL = "SELECT * FROM produksi_detail WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."'  AND jenis = '". $_GET["jenis"]."'   AND merek = '". $_GET["merek"]."'    AND gudang = '". $_GET["gudang"]."' order by tanggal";
	}
	
	if(isset($_GET["submit"])){
		$SQL = "SELECT * FROM produksi_detail WHERE MONTH(tanggal) = '".$split[0]."' AND YEAR(tanggal) = '".$split[1]."'  AND jenis = '". $_GET["jenis"]."'   AND merek = '". $_GET["merek"]."'  AND gudang = '". $_GET["gudang"]."' order by tanggal";
	}
	$hasil = mysql_query($SQL) or die(mysql_error());
	
	echo "<table align=\"center\"><tr>";
	$cnt = 0;
	while ($baris = mysql_fetch_array($hasil)) {
	  if ($cnt >= $col) {
		echo "</tr><tr>";
		$cnt = 0;
	  }
	  $cnt++;
//	  echo '<td>Tanggal</td><td>Jumlah</td>	</tr><tr>';
	  echo '<input type="hidden" name="nng[]" value="'.$baris["tanggal"].'">
			<input type="hidden" name="nngnama[]" value="'.$baris["jenis"].'">
			<input type="hidden" name="nngsatuan[]" value="'.$baris["satuan"].'">
			<td>'.baliktglindo($baris["tanggal"]).'</td>
			<td><input type="text" name="nngharga[]" id="nngharga" size="10" value="'.$baris["produksi"].'"></td>
			<td>&nbsp;</td>';
	}
	echo "</tr>
	<tr><td colspan=10 align='right'><input type='submit' value='Submit' name='submit' /></td></tr>
	</table>";
?>
  
</p>
</form>

 
 
</body>
</html>

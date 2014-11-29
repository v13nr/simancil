<?php  
include "globalx.php";
menuAkses(62);
date_default_timezone_set('Asia/Shanghai');
$tanggal = date('d-m-Y');
$ok = isset($_GET['tes']) ? "OKK" : "NOT READY";
//echo $ok;
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
.style1 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
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
		var url = $(this).val(); // get selected value
		if (url) { // require a URL
		window.location = url; // redirect
		}
		return false;
	});
    });
});
	</script>
</head>

<form method="post" action="proses.php">
<input type="hidden" value="bahanbaku_masuk" name="cmd">
<table class="x1">
  
  <input type="hidden" name="nobukti" value="<?php  echo $_GET['nobukti']?>" />
  <input type="hidden" name="bulan" value="<?php  echo $_GET['bulan']?>" />
  <tr>
        <td>Tanggal</td>
        <td><input type="text" value="<?php  echo $tanggal;?>" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu" value="<?php  echo $_GET['tgl_transaksi']?>" <?php  if($_GET['tgl_transaksi']<>""){?> readonly="true" <?php  } ?> />
		<?php  if($_GET['tgl_transaksi']==""){?>
          <a href="javascript:showCalendar('tgl_transaksi')"><img src="kalendar_files/calendar_icon.gif" border="0"></a></td>
		  <?php  } ?>
      </tr>
  <tr>
    <td>Supplier</td>
    <td>
		<select name="dk" id="dynamic_select" class="required" title="*">
			<option value="str_bahan_masuk.php?id=0">-Pilih-</option>
			<?php 
				$SQL = "SELECT * FROM supplier WHERE status = 1";
				$hasil = mysql_query($SQL);
				while($baris = mysql_fetch_array($hasil)){
			?>
			<option value="<?php  echo "str_bahan_masuk.php?id=".$baris["id"];?>" <?php  $nih = isset($_GET["id"]) ? "selected" : ""; if($_GET["id"]==$baris["id"]) {echo $nih;};?>><?php  echo $baris["nama"];?></option>
			<?php  } ?>
		</select>
        <div id="divAlert"></div>
	</td>
  </tr>
	<tr><td>Contact Person</td>
	<td><input type="text" name="cp" id="cp" readonly="true" /></td>
	</tr>
</table>
<?php  $id = isset($_GET["id"]) ? $_GET["id"] : "0"; ?>
<table border="1">
<tr>
	<td>Nama Bahan Baku</td>
	<td>Satuan</td>
	<td>Harga Terakhir</td>
	<td>QTY</td>
</tr>
<?php 
	$SQL = "SELECT a.* FROM bahan_baku a, mapping_bb b, mapping_bb_detail c WHERE b.id = c.buyer_id AND a.id = c.bb_id AND b.supp_id = '".$id."'";
	$hasil = mysql_query($SQL);
	while($baris=mysql_fetch_array($hasil)){
?>
<tr>
	<input type="hidden" name="nng[]" value="<?php  echo $baris["id"];?>">
	<input type="hidden" name="nngnama[]" value="<?php  echo $baris["nama"];?>">
	<input type="hidden" name="nngsatuan[]" value="<?php  echo $baris["satuan"];?>">
	<td><?php  echo $baris["nama"];?></td>
	<td><?php  echo $baris["satuan"];?></td>
	<td><input type="text" name="nngharga[]" id="nngharga" value="<?php  echo $baris["hargaterakhir"];?>"></td>
	<td><input type="text" name="nngqty[]" id="nngqty" value="0"></td>
</tr>

<?php  } ?>
<tr>
	<td colspan="3"></td>
	<td><input type="submit" value="Simpan" /></td>
</tr>
</table>
</form>
</body>
</html>

<?php 
include "../../../otentik.php";
include "../../../config_sistem.php";

date_default_timezone_set('Asia/Shanghai');
$tanggal = date('d-m-Y');
//echo $ok;

if(isset($_POST["cmd"]) && $_POST["cmd"] == "add_po"){
	
	$str = $_POST['dk'];
		$supp_id = split('=',$str);
		//13-12-2012
		$tgl = substr($_POST['tgl_transaksi'],6,4) . "-" . substr($_POST['tgl_transaksi'],3,2) . "-" . substr($_POST['tgl_transaksi'],0,2);
		$SQL = "INSERT INTO po2(tanggal, nomer, kode_supplier, cp)
			VALUES(
				'".$tgl."',
				'".$_POST["nomer"]."',
				'".$supp_id[1]."',
				'".$_POST['cp']."'
			)";
		$hasil = mysql_query($SQL);
		$po_id = mysql_insert_id();
		
		$id = $_POST['nng'];  //id barang
		$item = $_POST['nngqty'];  //qtyorder
		$nama = $_POST['nngnama']; //namabarang
		$satuan = $_POST['nngsatuan'];
		$harga = $_POST['nngharga'];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "INSERT INTO po2_detail(po_id, kdbarang, namabarang, harga, qty, satuan, jumlah) VALUES(
			'".$po_id."',
			'".$id[$i]."',
			'".$nama[$i]."',
			'".$harga[$i]."',
			'".$item[$i]."',
			'".$satuan[$i]."',
			'".$item[$i] * $harga[$i]."'
			)";
			$hasil=mysql_query($SQL) or die($SQL);
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
<script type="text/javascript" src="../../../assets/kalendar_files/jsCalendar.js"></script>
<link href="../../../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../../assets/jquery.js"></script>
<script type="text/javascript" src="../../../assets/jquery-1.2.3.min.js"></script>

<script src="../../../assets/jquery.loader.js"></script>
<link href="../../../assets/jquery.loader.css" rel="stylesheet" /></script>
  
  <link href="../../../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="../../../assets/thickbox/thickbox.js"></script>
	<script type="text/javascript">
	 $(document).ready(function(){  
  
  tb_init('a.thickbox, area.thickbox, input.thickbox');//pass where to apply thickbox
  imgLoader = new Image();// preload image
  imgLoader.src = "loader.gif";
});
$(document).ready(function(){
	
	 $(function(){
      // bind change event to select
	var str = $('#dynamic_select').val();
	var n=str.split("=");
	  var vNIP = n[1];
	  $.get('cari.php?cari=supplier&mode=cp',{id: vNIP},
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

 $(function(){
	  
    $("#simpan").click(function(){
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "po_quick.php?action=add", 
           type: "post", //form method
           data: $("#tes").serialize(),
           //dataType:"json", 
           beforeSend:function(){
             $(".loading").html("<span style=\"font: red\">Please wait....</span>");
           },
           success:function(result){
             if(result.status){
             }else{
             }
			 $.loader('setContent', '<div>Datas received !<br /> Still processing ...</div>');
			$('#test3response').fadeIn(4000, function(){$.loader('close');});
			 alert("Data Telah Tersimpan");
             $(".loading").html("");
			 thickBoxPopup3();
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 				
  });
  
  function thickBoxPopup3(){
	 var str = $('#dynamic_select').val();
	var n=str.split("=");
	  var vNIP = n[1];
	tb_show('Purchase Order', 'po.php?id='+vNIP+'&nomer='+ $('#nomer').val() +'TB_iframe=true&height=380&width=720', null);
}
	</script>
</head>
<body>
<form method="post" action="" id="tes">
<input type="hidden" value="add_po" name="cmd">
<table class="x1">
  
  <input type="hidden" name="nobukti" value="<?=$_GET['nobukti']?>" />
  <input type="hidden" name="bulan" value="<?=$_GET['bulan']?>" />
  <tr>
    <td>Nomor</td>
    <td><input type="text" name="nomer" id="nomer" class="required"/></td>
  </tr>
  <tr>
        <td>Tanggal</td>
        <td><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu" value="<?=$_GET['tgl_transaksi']?>" <? if($_GET['tgl_transaksi']<>""){?> readonly="true" <? } ?> />
		<? if($_GET['tgl_transaksi']==""){?>
          <a href="javascript:showCalendar('tgl_transaksi')"><img src="../../../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
		  <? } ?>
    </tr>
  <tr>
    <td>Supplier</td>
    <td>
		<select name="dk" id="dynamic_select" class="required" title="*">
			<option value="po_quick.php?id=0">-Pilih-</option>
			<?php
				$SQL = "SELECT * FROM supplier WHERE status = 1";
				$hasil = mysql_query($SQL);
				while($baris = mysql_fetch_array($hasil)){
			?>
			<option value="<?php 
			echo "po_quick.php?id=".$baris["kode"];?>" <?php $nih = isset($_GET["id"]) ? "selected" : ""; if($_GET["id"]==$baris["kode"]) {echo $nih;};?>><?php echo $baris["nama"];?></option>
			<?php } ?>
		</select>
        <div id="divAlert"></div>
	</td>
  </tr>
	<tr><td>Contact Person</td>
	<td><input type="text" name="cp" id="cp" readonly="true" /></td>
	</tr>
</table>
<?php $id = isset($_GET["id"]) ? $_GET["id"] : "0"; ?><span class="loading"></span><div id="test3response"></div>
<table border="1" style="border-collapse:collapse">
<tr>
	<td>Nama Barang</td>
	<td>Satuan</td>
	<td>Stok Terakhir</td>
	<td>Harga Terakhir</td>
	<td>QTY Order</td>
</tr>
<?php
	$SQL = "SELECT a.kodebrg, a.namabrg, a.modal, satuank, qtyin, qtyout  FROM stock a, supplier b WHERE b.kode = a.supplier_id AND b.kode = '".$id."'";
	$hasil = mysql_query($SQL) or die($SQL);
	while($baris=mysql_fetch_array($hasil)){
?>
<tr>
	<input type="hidden" name="nng[]" value="<?php echo $baris["kodebrg"];?>">
	<input type="hidden" name="nngnama[]" value="<?php echo $baris["namabrg"];?>">
	<input type="hidden" name="nngsatuan[]" value="<?php echo $baris["satuank"];?>">
	<td><?php echo $baris["namabrg"];?></td>
	<td><?php echo $baris["satuank"];?></td>
	<td><?php echo $baris["qtyin"]-$baris["qtyout"];?></td>
	<td><input type="text" name="nngharga[]" id="nngharga" value="<?php echo $baris["modal"];?>"></td>
	<td><input type="text" name="nngqty[]" id="nngqty" value="0"></td>
</tr>

<? } ?>
<tr>
	<td colspan="4"></td>
	<td><input type="button" value="Simpan" id="simpan" /></td>
</tr>
</table>
</form>
</body>
</html>

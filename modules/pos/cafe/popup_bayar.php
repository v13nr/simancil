<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
* { font: 20px/30px Verdana, sans-serif; }

input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script type="text/javascript">
 window.onload = function() {
  document.getElementById("bayar").focus();
}
function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
function hitung(){
		total = clearNum(document.getElementById("total").value) * 1;
		bayar = clearNum(document.getElementById("bayar").value) * 1;
		document.getElementById("kembali").value = formatCurrency(bayar-total);
	}
	function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}
$(document).ready(function(){	
    $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
});

jQuery(document).ready(function() {        
    setTimeout(function(){
        $('#bayar').focus();   
    },200);
});
 </script>
</head>

<body>
<?php 
	include "../include/globalx.php";
	$nonota = $_GET['nonota'];
	//$split = explode("/",$nonota);
	//$nota = $split[1];
	$SQL = "SELECT SUM(harga * qtyout-(harga * qtyout * disc/100)) FROM mutasi WHERE model = 'INV' and nomor = '".$nonota."' and status =1";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	$baris = mysql_fetch_array($hasil);
	$total = $baris[0];
?>
<form method="post" action="cetak_nota.php?nonota=<?php  echo $nonota?>">
<table width="452" border="0">
  <tr>
    <td colspan="3"><div align="center">PEMBAYARAN<br />
	ID = <?php  echo $nonota?>
	</div></td>
  </tr>
  <tr>
    <td width="113">Total  </td>
    <td width="7">:</td>
    <td align="right" width="172"><input type="text" name="total" class="required kanan"  id="total" value="<?php  echo number_format($total)?>" readonly="true" /></td>
  </tr>
  <tr>
    <td>Bayar</td>
    <td>:</td>
    <td align="right"><input type="text" name="bayar" id="bayar" class="required kanan" onKeyUp="hitung()"  /></td>
  </tr>
  <tr>
    <td>Kembali</td>
    <td>:</td>
    <td align="right"><input type="text" name="kembali"  class="required kanan" readonly="true" id="kembali" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="CETAK" /></td>
  </tr>
</table>
</form>
</body>
</html>

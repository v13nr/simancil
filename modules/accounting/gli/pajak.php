<?php  session_start();
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" language="javascript">
	function clearNum(number){
		while(String(number).indexOf(',') > -1){
		 number = String(number).replace(',','');
		}
		return number;
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
	function hitung(){
		lr_sbl_pajak = (document.getElementById("lr_sbl_pajak").value) * 1;
		if(lr_sbl_pajak<1){
			alert("Sesi Habis");
			document.getElementById("lr_sbl_pajak").focus();
		}
		bb_gajipimpinan = (document.getElementById("bb_gajipimpinan").value) * 1;
		bb_sumbangan = (document.getElementById("bb_sumbangan").value) * 1;
		bb_pajak_penghsl = (document.getElementById("bb_pajak_penghsl").value) * 1;
		bb_rt_kantor = (document.getElementById("bb_rt_kantor").value) * 1;
		lr_fiskal = (document.getElementById("lr_fiskal").value) * 1;
		tarif_1 = (document.getElementById("tarif_1").value) * 1;
		tkp = (document.getElementById("tkp").value) * 1;
		
		pdpt_kena_pajak_bulat = (document.getElementById("pdpt_kena_pajak_bulat").value) * 1;
		document.getElementById("total_koreksi_fis").value = (bb_gajipimpinan + bb_sumbangan  + bb_pajak_penghsl + bb_rt_kantor);
		document.getElementById("lr_fiskal").value = lr_sbl_pajak +
		(bb_gajipimpinan + bb_sumbangan  + bb_pajak_penghsl + bb_rt_kantor);
		document.getElementById("pdpt_kena_pajak").value = lr_fiskal - tkp;
		document.getElementById("tarif_hit").value = (pdpt_kena_pajak_bulat - 50000000);
		document.getElementById("tarif_2").value = (pdpt_kena_pajak_bulat - 50000000) * 15/100;
		document.getElementById("pph_terhutang").value = tarif_1 + document.getElementById("tarif_2").value * 1;
	}
	
function selectrm(rm){
	   window.parent.selectrm(rm);
	   window.parent.tb_remove();
   }
   
   function simpanRegister(){
		xrm = $('#pph_terhutang').val();
		selectrm(xrm);
   }
</script>
<script type="text/javascript" src="../assets/jquery-1.2.3.min.js"></script>
</head>

<body>
<?php 
	$SQL = "SELECT tahun from periode WHERE aktif = 1";
	$hasil = mysql_query($SQL);
	$baris = mysql_fetch_array($hasil);
?>
Tahun Fiskal : <?php  echo $baris[0];?>
<?php 
	$SQLu = "SELECT * FROM pajak_detail WHERE tahun =".$baris[0];
	$hasilu = mysql_query($SQLu);
	$barisu = mysql_fetch_array($hasilu);
?>
<form method="post" action="submission_gli.php">
<input type="hidden" name="tahun" value="<?php  echo $baris[0]; ?>" />
<input type="hidden" name="cmd"  value="upd_pajak" />
<table width="90%" border="1">
  <tr>
    <td colspan="6">Laba(Rugi) sebelum Pajak </td>
    <td width="10%">&nbsp;</td>
    <td width="10%"><input type="text" name="lr_sbl_pajak"  id="lr_sbl_pajak" value="<?php  echo $_SESSION["laba_sebelum_pajak"];  ?>" readonly="true" />   </td>
  </tr>
  <tr>
    <td colspan="6">Koreksi Fiskal </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">Beban Gaji Pimpinan </td>
    <td><input type="text" name="bb_gajipimpinan"  onKeyUp="hitung()"  id="bb_gajipimpinan"  value="<?php  echo $barisu["bb_gajipimpinan"]; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">Beban Sumbangan </td>
    <td><input type="text" name="bb_sumbangan"  onKeyUp="hitung()"   id="bb_sumbangan"  value="<?php  echo $barisu["bb_sumbangan"]; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">Beban Pajak Penghasilan </td>
    <td><input type="text" name="bb_pajak_penghsl"  onKeyUp="hitung()"   id="bb_pajak_penghsl"  value="<?php  echo $barisu["bb_pajak_penghsl"]; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td colspan="5">Beban RT Kantor </td>
    <td><input type="text" name="bb_rt_kantor"  id="bb_rt_kantor"  onKeyUp="hitung()"  value="<?php  echo $barisu["bb_rt_kantor"]; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><div align="center"><em>Total Koreksi Fiskal </em></div></td>
    <td>&nbsp;</td>
    <td><input type="text" name="total_koreksi_fis"  id="total_koreksi_fis" value="<?php  echo $barisu["total_koreksi_fis"]; ?>" readonly="true" /></td>
  </tr>
  <tr>
    <td colspan="6">Laba(Rugi) Fiskal </td>
    <td>&nbsp;</td>
    <td><input type="text" name="lr_fiskal" id="lr_fiskal"  value="<?php  echo $barisu["lr_fiskal"]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">TKP (K/3) </td>
    <td>&nbsp;</td>
    <td><input type="text" name="tkp"   id="tkp"  value="<?php  echo $barisu["tkp"]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">Pendapatan Kena Pajak </td>
    <td>&nbsp;</td>
    <td><input type="text" name="pdpt_kena_pajak"  id="pdpt_kena_pajak"  value="<?php  echo $barisu["pdpt_kena_pajak"]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6">Pendapatan Kena Pajak pembulatan </td>
    <td>&nbsp;</td>
    <td><input type="text" name="pdpt_kena_pajak_bulat"   id="pdpt_kena_pajak_bulat" onkeyup="hitung()"  value="<?php  echo $barisu["pdpt_kena_pajak_bulat"]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2">Tarif:</td>
    <td width="7%">50.000.000</td>
    <td width="4%">x</td>
    <td width="9%">5%</td>
    <td width="5%">=</td>
    <td><input type="text" name="tarif_1"   id="tarif_1"  value="2500000" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><input type="text" name="tarif_hit"   id="tarif_hit"  value="<?php  echo $barisu["tarif_1"]; ?>" /></td>
    <td>x</td>
    <td>15%</td>
    <td>=</td>
    <td><input type="text" name="tarif_2"  id="tarif_2"  value="<?php  echo $barisu["tarif_2"]; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td colspan="6">PPh terhutang </td>
    <td>&nbsp;</td>
    <td><input type="text" name="pph_terhutang" id="pph_terhutang"  value="<?php  echo $barisu["pph_terhutang"]; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td><input type="submit" value="Simpan" /><input type="button" value="Selesai" onClick="simpanRegister(); return false;"/></td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </form>
</body>
</html>

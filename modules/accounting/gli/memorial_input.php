<?php 
	include "../../../modules/core/include/globalx.php";
	include "otentik_gli.php";
 
 include ("../include/functions.php");
 
cekAkses($_SESSION["sess_user_id"], 'memorial_input');

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
  <head>
    <title>Accounting Application</title>
	
<style type="text/css">
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
</style>

	<link  href="../assets/gl/style.css" rel="stylesheet" type="text/css">
	<link  href="../assets/gl/format.css"  rel="stylesheet" type="text/css">
	<link  href="../assets/gl/table.css"  rel="stylesheet" type="text/css">
	<link  href="../assets/gl/data.css"  rel="stylesheet" type="text/css">
	<script type="text/javascript" src='../assets/jquery.js'></script>	
	<script type='text/javascript' src='../assets/gl/custom_functions.js'></script>  </head>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#frmMemorial").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>

<body bgcolor="#C2CCE7">
<table class="" cellpadding="0" cellspacing="0" width="84%%">
	<tr>
		<td height="715" class="row_top"><script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">

<script type='text/javascript' src='../assets/thickbox/thickbox.js'></script>
<link  href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

<form id="frmMemorial" action="akuntansi_submission.php" method="post" onsubmit="return validate(this);">
<?php  if($_GET['id']==""){?>
	<input type="hidden" name="cmd" value="add_memorial">
<?php  } else {?>
	<input type="hidden" name="cmd" value="upd_memorial">
<?php  }?>
<script type="text/javascript">
//<![CDATA[
//<!--
function validate(form)
{
var error = '';
var to_focus = null;
if (form.debtur_id.value == '') {
error += 'The Nama Debtur field is required.\n';
if (to_focus == null) to_focus = form.debtur_id;
}
if (form.tgl_transaksi.value == '') {
error += 'The Tanggal transaksi field is required.\n';
if (to_focus == null) to_focus = form.tgl_transaksi;
}
if (form.branch_id.value == '') {
error += 'The Cabang field is required.\n';
if (to_focus == null) to_focus = form.branch_id;
}
if (error.length > 0) {
alert(error);
to_focus.focus();
return false;
}

}

//-->
//]]>
</script><table style="margin-left:3em" width="100%" align="center">
  <tr>
    <td width="140">Tanggal transaksi</td>
    <td width="22">:</td>
    <td width="100"><input type="text" name="tgl_transaksi" value="" id="tgl_transaksi" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu"  />
      <a href="javascript:showCalendar('tgl_transaksi')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a><a href="javascript:showCalendar('tgl_transaksi')"></a></td>
	  <td width="94"> Keterangan </td>
	  <td width="465"><input type="text" name="information" size="50"></td>
  </tr>
</table>
<table  border="1" style="border-collapse:collapse"  width="84%" align="center" class="data_tabel_list">
   <thead>
     <tr>

	    <th width="6%" class="data_col_title">?</th> 
	    <th width="3%" class="data_col_title">No</th>
	    <th width="11%" class="data_col_title">COA</th>
	    <th width="28%" class="data_col_title">Keterangan</th>
	    <th width="9%" class="data_col_title">Jumlah</th>
	    <th width="6%" class="data_col_title">D/K</th>

	    <th width="11%" class="data_col_title">UU</th>
	    <th width="16%" class="data_col_title">No. Bukti </th>
     </tr>
   </thead>
   <tbody id="transBody">  
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(1)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>

     		<input type="hidden" name="index[]" value="1" />     	</td>
     	<td class="data_col_item" align="center">1</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_1" id="coa_skada_1" size="12"  />
<input type="hidden" name="coa_id_1" value="4" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_1" id="description_1" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_1" id="jumlah_1" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_1">

<option value="">-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_1">
<option value="">- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_1" id="no_referensi_1" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(2)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="2" />     	</td>
     	<td class="data_col_item" align="center">2</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_2" id="coa_skada_2" size="12"  />

<input type="hidden" name="coa_id_2" value="5" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_2" id="description_2" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_2" id="jumlah_2" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_2">
<option value="">-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_2">

<option value="">- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_2" id="no_referensi_2" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(3)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>

     		<input type="hidden" name="index[]" value="3" />     	</td>
     	<td class="data_col_item" align="center">3</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_3" value="" id="coa_skada_3" size="12"  />
     	<input type="hidden" name="coa_id_3" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_3" value="" id="description_3" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_3" value="" id="jumlah_3" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_3">

<option value="">-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_3">
<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_3" value="" id="no_referensi_3" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(4)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="4" />     	</td>
     	<td class="data_col_item" align="center">4</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_4" value="" id="coa_skada_4" size="12"  />

<input type="hidden" name="coa_id_4" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_4" value="" id="description_4" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_4" value="" id="jumlah_4" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_4">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_4">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_4" value="" id="no_referensi_4" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(5)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>

     		<input type="hidden" name="index[]" value="5" />     	</td>
     	<td class="data_col_item" align="center">5</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_5" value="" id="coa_skada_5" size="12"  />
<input type="hidden" name="coa_id_5" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_5" value="" id="description_5" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_5" value="" id="jumlah_5" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_5">

<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_5">
<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_5" value="" id="no_referensi_5" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(6)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="6" />     	</td>
     	<td class="data_col_item" align="center">6</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_6" value="" id="coa_skada_6" size="12"  />

<input type="hidden" name="coa_id_6" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_6" value="" id="description_6" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_6" value="" id="jumlah_6" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_6">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_6">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_6" value="" id="no_referensi_6" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(7)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>

     		<input type="hidden" name="index[]" value="7" />     	</td>
     	<td class="data_col_item" align="center">7</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_7" value="" id="coa_skada_7" size="12"  />
<input type="hidden" name="coa_id_7" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_7" value="" id="description_7" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_7" value="" id="jumlah_7" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_7">

<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_7">
<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_7" value="" id="no_referensi_7" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(8)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="8" />     	</td>
     	<td class="data_col_item" align="center">8</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_8" value="" id="coa_skada_8" size="12"  />

<input type="hidden" name="coa_id_8" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_8" value="" id="description_8" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_8" value="" id="jumlah_8" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_8">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_8">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_8" value="" id="no_referensi_8" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(9)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>

     		<input type="hidden" name="index[]" value="9" />     	</td>
     	<td class="data_col_item" align="center">9</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_9" value="" id="coa_skada_9" size="12"  />
<input type="hidden" name="coa_id_9" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_9" value="" id="description_9" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_9" value="" id="jumlah_9" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_9">

<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_9">
<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_9" value="" id="no_referensi_9" size="18"  /></td>
     </tr>
          <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">10</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_10" value="" id="coa_skada_10" size="12"  />

<input type="hidden" name="coa_id_10" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_10" value="" id="description_10" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_10" value="" id="jumlah_10" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_10">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_10">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_10" value="" id="no_referensi_10" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">11</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_11" value="" id="coa_skada_11" size="12"  />

<input type="hidden" name="coa_id_11" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_11" value="" id="description_11" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_11" value="" id="jumlah_11" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_11">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_11">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_11" value="" id="no_referensi_11" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">12</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_12" value="" id="coa_skada_12" size="12"  />

<input type="hidden" name="coa_id_12" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_12" value="" id="description_12" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_12" value="" id="jumlah_12" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_12">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_12">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_12" value="" id="no_referensi_12" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">13</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_13" value="" id="coa_skada_13" size="12"  />

<input type="hidden" name="coa_id_13" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_13" value="" id="description_13" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_13" value="" id="jumlah_13" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_13">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_13">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_13" value="" id="no_referensi_13" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">14</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_14" value="" id="coa_skada_14" size="12"  />

<input type="hidden" name="coa_id_14" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_14" value="" id="description_14" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_14" value="" id="jumlah_14" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_14">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_14">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_14" value="" id="no_referensi_14" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">15</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_15" value="" id="coa_skada_15" size="12"  />

<input type="hidden" name="coa_id_15" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_15" value="" id="description_15" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_15" value="" id="jumlah_15" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_15">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_15">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_15" value="" id="no_referensi_15" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">16</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_16" value="" id="coa_skada_16" size="12"  />

<input type="hidden" name="coa_id_16" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_16" value="" id="description_16" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_16" value="" id="jumlah_16" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_16">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_16">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_16" value="" id="no_referensi_16" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">17</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_17" value="" id="coa_skada_17" size="12"  />

<input type="hidden" name="coa_id_17" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_17" value="" id="description_17" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_17" value="" id="jumlah_17" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_17">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_17">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_17" value="" id="no_referensi_17" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">18</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_18" value="" id="coa_skada_18" size="12"  />

<input type="hidden" name="coa_id_18" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_18" value="" id="description_18" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_18" value="" id="jumlah_18" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_18">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_18">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_18" value="" id="no_referensi_18" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">19</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_19" value="" id="coa_skada_19" size="12"  />

<input type="hidden" name="coa_id_19" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_19" value="" id="description_19" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_19" value="" id="jumlah_19" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_19">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_19">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_19" value="" id="no_referensi_19" size="18"  /></td>
     </tr>
	 <tr>
     	<td class="data_col_item" align="center">
     		<a href="javascript:;" onClick="emptyData(10)" title="Delete Data"><img src="../assets/gl/delete.png"  border="0" /></a>
     		<input type="hidden" name="index[]" value="10" />     	</td>
     	<td class="data_col_item" align="center">20</td>
     	<td class="data_col_item" align="center"><input type="text" name="coa_skada_20" value="" id="coa_skada_20" size="12"  />

<input type="hidden" name="coa_id_20" value="" /></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="description_20" value="" id="description_20" size="40"  /></td>
     	<td class="data_col_item input_right input_jumlah" align="center"><input type="text" name="jumlah_20" value="" id="jumlah_20" size="10"  /></td>
     	<td class="data_col_item" align="center"><select name="dk_20">
<option value="" >-</option>
<option value="debet">D</option>
<option value="kredit">K</option>
</select></td>
     	<td class="data_col_item" align="center"><select name="untush_id_20">

<option value="" >- select -</option>
<?php 
	$SQL = "select * From $database.divisi where status = 1";
	$hasil = mysql_query($SQL);
	while($baris = mysql_fetch_array($hasil)){
?>
<option value="<?php  echo $baris["subdiv"]; ?>"><?php  echo $baris["namadiv"]; ?></option>
<?php  } ?>
</select></td>
     	<td class="data_col_item upperCase" align="center"><input type="text" name="no_referensi_20" value="" id="no_referensi_20" size="18"  /></td>
     </tr>
   </tbody>
   <tfoot>
   	 <tr>

   	    <td colspan="8">
   	    	Total Debet: <span id="totalDebet" style="font-weight:bold"></span> 
   	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
   	    	Total Kredit: <span id="totalKredit" style="font-weight:bold"></span>   	    </td>
   	 </tr>
   </tfoot> 
</table>
<br />
<div align="center">
<input type="submit" name="submit" value="Simpan" onClick="return checkRow();" />
</div>
</form><a href="pilihcoa.php?dir=setup&mod=coa&section=popup&width=350&height=300&TB_iframe=1" class="thickbox" style="display:none" id="coaPopup" title="Cari COA"></a>
<script language="javascript">
//setupNumber('.input_jumlah input',true);
//setupNumber('#totalJumlah',false);
var currentIndex = 0;
var lastID = $('input[name^=coa_id_]').size();
var activePeriod = [["12","2009"],["1","2010"],["2","2010"],["3","2010"],["4","2010"],["8","2010"],["7","2010"],["9","2010"]];
function pickCOA(id,skada,untush,name){
	$('input[name=coa_id_'+currentIndex+']').val(id);
	$('input[name=coa_skada_'+currentIndex+']').val(skada);
	$('select[name=untush_id_'+currentIndex+'] option').each(function(){
		if(this.value == untush) $(this).attr('selected','selected');
		else $(this).removeAttr('selected');
	});
	if($('input[name=description_'+currentIndex+']').val() == '')
		$('input[name=description_'+currentIndex+']').val(name);
	tb_remove();
}
function showCOA(index){
	currentIndex = index;
	$('#coaPopup').click();
}
$('input[name^=coa_skada_]').focus(function(){
	var index = $(this).attr('name').replace('coa_skada_','');
	showCOA(index);
});
$('input[name^=jumlah_]').blur(function(){
	getTotalTransaction('.input_jumlah input');
});
$('select[name^=dk_]').change(function(){
	getTotalTransaction('.input_jumlah input');
});
function emptyData(index){
	if(confirm('Ingin menghapus baris ini?')){
		$('input[name=description_'+index+']').val('');
		$('input[name=jumlah_'+index+']').val('');
		$('input[name=coa_skada_'+index+']').val('');
		$('input[name=coa_id_'+index+']').val('');
		$('input[name=no_referensi_'+index+']').val('');
		$('select[name=dk_'+index+'] option').removeAttr('selected');
		$('select[name=untush_id_'+index+'] option').removeAttr('selected');
		getTotalTransaction('.input_jumlah input');
	}
}
function checkRow(){
	var _month = $('#tgl_transaksi').val().substring(3,5);
	var _year = $('#tgl_transaksi').val().substring(6,10);
	if(_month.charAt(0) == '0') _month = _month.substring(1,2);
	var periodFound = false;
	$(activePeriod).each(function(){
		if(this[0] == _month && this[1] == _year){
			periodFound = true;
			return;
		}
	});
	if(!periodFound){
		//alert('Periode dari tanggal transaksi tidak berlaku');
		//return false;
	}
	var x = 1;
	var emptyRow = 1;
	var send = true;
	$('input[name^=coa_id_]').each(function(){
		if(this.value != ''){
			if($('input[name=description_'+x+']').val() == ''){
				alert('Keterangan pada baris ke-'+x+' jangan kosong');
				send = false;
			}else if($('input[name=jumlah_'+x+']').val() == ''){
				alert('Jumlah pada baris ke-'+x+' jangan kosong');
				send = false;
			}else if($('select[name=dk_'+x+'] option:selected').val() == ''){
				alert('Jenis transaksi pada baris ke-'+x+' jangan kosong');
				send = false;
			}else if($('select[name=untush_id_'+x+'] option:selected').val() == ''){
				alert('Unit usaha pada baris ke-'+x+' jangan kosong');
				send = false;
			}
		}else{
			emptyRow++;
		}
		x++;
	});
	
	if(x == emptyRow){
		alert('Detail transaksi tidak boleh kosong');
		return false;
	} 

	var totalDebet = 0;
	var totalKredit = 0;
	$('input[name^=jumlah_]').each(
		function(){
			if($(this).val() != '') {
				var x = $(this).attr('name').replace('jumlah_','');
				var dk = $('select[name=dk_'+x+'] option:selected').val();
				if(dk == 'debet') totalDebet += parseFloat(clearNum($(this).val()));
				else totalKredit += parseFloat(clearNum($(this).val()));
			}
		}
	);
	if(totalDebet != totalKredit){
		alert('Total debet dan total kredit tidak sama');
		send = false;
	}

	if(send){
		$('input[name^=jumlah_]').each(
			function(){
				$(this).val(clearNum($(this).val()));
			}		
		);
	}
	return send;
}

</script>

</body>
</html>